<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan Saya - Febia Nibras Kalsel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { nibras: { magenta: '#E32184', gray: '#EEEEEE', text: '#706f6c' } },
                    fontFamily: { sans: ['Poppins', 'sans-serif'] }
                }
            }
        }
    </script>
</head>
<body class="text-gray-800 bg-gray-50 flex flex-col min-h-screen">
    @include('layouts.navbar')

    <main class="flex-grow pt-[100px] mb-20 px-6 lg:px-16 container mx-auto max-w-5xl">
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Pesanan Saya</h1>
            <p class="text-gray-500">Pantau status pesanan Anda di sini.</p>
        </div>

        @if($orders->isEmpty())
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada pesanan</h3>
                <p class="text-gray-500 mb-8">Anda belum melakukan pemesanan apa pun saat ini.</p>
                <a href="{{ route('produk') }}" class="inline-block bg-nibras-magenta text-white px-8 py-3 rounded-full font-bold shadow-lg shadow-pink-200 hover:scale-105 transition-transform">Belanja Sekarang</a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($orders as $order)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:border-nibras-magenta transition-colors group">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-pink-50 rounded-xl flex items-center justify-center text-nibras-magenta shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <div class="flex items-center gap-3 mb-1">
                                    <h3 class="font-bold text-gray-900">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h3>
                                    @php
                                        $statusClasses = [
                                            'Menunggu Konfirmasi' => 'bg-amber-100 text-amber-700 border-amber-200',
                                            'Diproses' => 'bg-blue-100 text-blue-700 border-blue-200',
                                            'Dikirim' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                                            'Selesai' => 'bg-green-100 text-green-700 border-green-200',
                                            'Dibatalkan' => 'bg-red-100 text-red-700 border-red-200',
                                        ];
                                        $class = $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                                    @endphp
                                    <span class="px-3 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider border {{ $class }}">
                                        {{ $order->status }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }} • {{ $order->items->count() }} Produk</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between md:justify-end gap-6 border-t md:border-t-0 pt-4 md:pt-0">
                            <div class="text-right">
                                <p class="text-xs text-gray-400 uppercase tracking-widest mb-0.5">Total Tagihan</p>
                                <p class="text-lg font-bold text-nibras-magenta">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            </div>
                            <a href="{{ route('orders.show', $order->id) }}" class="p-2 bg-gray-50 text-gray-400 rounded-lg hover:bg-nibras-magenta hover:text-white transition-all group-hover:shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            </div>
        @endif
    </main>

    @include('layouts.footer')
</body>
</html>

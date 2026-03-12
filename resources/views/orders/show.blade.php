<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pesanan #{{ $order->id }} - Febia Nibras Kalsel</title>
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
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('orders.index') }}" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-gray-400 hover:text-nibras-magenta shadow-sm border border-gray-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Pesanan</h1>
                <p class="text-sm text-gray-500">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }} • {{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-left">
            <!-- Left: Items & Status -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-nibras-magenta" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Status Pesanan
                    </h3>
                    
                    <div class="relative pl-8 space-y-8 before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-0.5 before:bg-gray-100">
                        @php
                            $statuses = ['Menunggu Konfirmasi', 'Diproses', 'Dikirim', 'Selesai'];
                            $currentIndex = array_search($order->status, $statuses);
                            if ($order->status == 'Dibatalkan') $statuses = ['Dibatalkan'];
                        @endphp

                        @foreach($statuses as $index => $status)
                            @php
                                $isCompleted = $currentIndex !== false && $index <= $currentIndex;
                                $isCurrent = $currentIndex !== false && $index == $currentIndex;
                            @endphp
                            <div class="relative">
                                <div class="absolute -left-[27px] top-1 w-4 h-4 rounded-full border-2 {{ $isCompleted ? 'bg-nibras-magenta border-nibras-magenta' : 'bg-white border-gray-200' }} z-10 transition-colors">
                                    @if($isCompleted)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white mx-auto mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="{{ $status == 'Dibatalkan' ? 'text-red-600' : ($isCompleted ? 'text-gray-900' : 'text-gray-400') }}">
                                    <p class="font-bold text-sm">{{ $status }}</p>
                                    @if($isCurrent)
                                        <p class="text-xs mt-1 text-nibras-magenta font-medium animate-pulse">Pesanan Anda saat ini sedang berada di tahap ini.</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Items Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50">
                        <h3 class="font-bold text-gray-900">Rincian Produk</h3>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @foreach($order->items as $item)
                        <div class="p-6 flex items-center gap-4">
                            <div class="w-20 h-24 bg-gray-50 rounded-lg overflow-hidden shrink-0 border border-gray-100">
                                @php
                                    $product = \App\Models\Product::find($item->product_id);
                                    $image = $product ? $product->images->first() : null;
                                @endphp
                                @if($image)
                                    <img src="{{ Storage::url($image->image_path) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow">
                                <h4 class="font-bold text-gray-900 leading-tight mb-1">{{ $item->product_name }}</h4>
                                <p class="text-xs text-gray-500 mb-2 uppercase tracking-widest">Ukuran: {{ $item->size }} • {{ $item->quantity }}x</p>
                                <p class="text-sm font-bold text-nibras-magenta">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right hidden sm:block">
                                <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Subtotal</p>
                                <p class="font-bold text-gray-900">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="bg-gray-50 p-6 flex flex-col gap-2">
                        <div class="flex justify-between text-sm text-gray-500 font-medium">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold text-gray-900 pt-2 border-t border-gray-200">
                            <span>Total Tagihan</span>
                            <span class="text-nibras-magenta">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Shipping Info -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-nibras-magenta" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Informasi Pengiriman
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Penerima</p>
                            <p class="text-sm font-bold text-gray-900">{{ $order->customer_name }}</p>
                            <p class="text-xs text-gray-500">{{ $order->customer_phone }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Alamat Lengkap</p>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $order->customer_address }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-pink-50 rounded-2xl p-6 border border-pink-100">
                    <h4 class="font-bold text-nibras-magenta text-sm mb-2 italic">Butuh bantuan?</h4>
                    <p class="text-xs text-pink-700 leading-relaxed mb-4">Jika ada kendala dengan pesanan Anda, silakan hubungi admin kami melalui WhatsApp.</p>
                    @php
                        $msg = "Halo Admin, saya ingin bertanya tentang pesanan saya #ORD-" . str_pad($order->id, 5, '0', STR_PAD_LEFT);
                        $adminWa = "6282148882473";
                    @endphp
                    <a href="https://wa.me/{{ $adminWa }}?text={{ urlencode($msg) }}" target="_blank" class="flex items-center justify-center gap-2 w-full py-2.5 bg-nibras-magenta text-white rounded-xl font-bold text-xs shadow-lg shadow-pink-200 transition-transform hover:scale-105">
                        Chat Admin
                    </a>
                </div>
            </div>
        </div>
    </main>

    @include('layouts.footer')
</body>
</html>

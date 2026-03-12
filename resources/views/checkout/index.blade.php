<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout Pengiriman - Febia Nibras Kalsel</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
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

    <main class="flex-grow pt-[100px] pb-16 px-6 lg:px-16 max-w-7xl mx-auto w-full">
        
        <div class="mb-8 flex items-center justify-between">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Checkout Pengiriman</h1>
        </div>

        <form action="{{ route('checkout.process') }}" method="POST" class="flex flex-col lg:flex-row gap-8">
            @csrf
            
            <!-- Left: Formulir Data Diri dan Ongkir -->
            <div class="w-full lg:w-2/3 flex flex-col gap-6">
                <!-- Form Data Diri -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">1. Data Penerima</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-nibras-magenta focus:border-nibras-magenta" placeholder="Masukkan nama lengkap penerima">
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP / WhatsApp</label>
                            <input type="text" name="phone" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-nibras-magenta focus:border-nibras-magenta" placeholder="Contoh: 081234567890">
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                            <textarea name="address" required rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-nibras-magenta focus:border-nibras-magenta" placeholder="Nama Jalan, RT/RW, Patokan rumah..."></textarea>
                        </div>
                    </div>
                </div>



                <a href="{{ route('cart.index') }}" class="inline-block mt-4 text-sm font-medium text-gray-500 hover:text-nibras-magenta transition-colors">
                    &larr; Kembali ke Keranjang
                </a>
            </div>

            <!-- Right: Order Summary -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-28">
                    <h2 class="text-lg font-bold text-gray-900 mb-6 border-b border-gray-100 pb-4">Ringkasan Pembayaran</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal ({{ $totalQty }} Produk)</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Estimasi Berat</span>
                            <span class="font-medium text-gray-900">{{ number_format($totalWeight, 0, ',', '.') }} gram</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mb-8">
                        <span class="text-base font-bold text-gray-900">Total Keseluruhan</span>
                        <span class="text-2xl font-black text-nibras-magenta drop-shadow-sm">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" class="w-full bg-nibras-magenta text-white h-14 rounded-md font-bold hover:bg-pink-700 transition-all shadow-md flex items-center justify-center gap-3 hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-pink-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Selesaikan Pesanan
                    </button>
                    
                    <p class="text-xs text-gray-400 text-center mt-4">Pesanan Anda akan segera diproses setelah konfirmasi.</p>
                </div>
            </div>
            
            <!-- Hidden Data Cart Items For WA Template -->
            <div id="cart_wa_items" class="hidden">
                @foreach($cartItems as $item)
                    - {{ $item->product->name }} (Ukuran: {{ $item->size }}) - {{ $item->quantity }} pcs x {{ $item->product->variants->where('size', $item->size)->first()->price ?? $item->product->price }}
                @endforeach
            </div>

        </form>
    </main>

    <!-- Footer -->
    @include('layouts.footer')


</body>
</html>

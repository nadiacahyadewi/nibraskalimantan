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
                    fontFamily: { 
                        sans: ['Poppins', 'sans-serif'],
                        brand: ['Pacifico', 'cursive']
                    }
                }
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <style>
        .container-glow {
            box-shadow: 0 0 40px rgba(227, 33, 132, 0.08);
        }
    </style>
</head>
<body class="text-gray-800 bg-[#F8F8F8] flex flex-col min-h-screen font-sans">

    @include('layouts.navbar')

    <main class="flex-grow pt-[100px] pb-16 px-6 lg:px-16 max-w-7xl mx-auto w-full">
        
        <div class="mb-10 text-center md:text-left">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 tracking-tight">Pesan <span class="font-brand text-nibras-magenta">Sekarang</span></h1>
            <p class="text-gray-500 mt-2">Lengkapi data untuk mengirimkan pesanan Anda via WhatsApp.</p>
        </div>

        <form action="{{ route('checkout.process') }}" method="POST" class="flex flex-col lg:flex-row gap-8">
            @csrf
            
            <!-- Left: Formulir Data Diri -->
            <div class="w-full lg:w-2/3 flex flex-col gap-8">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 container-glow">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-nibras-magenta text-white flex items-center justify-center text-sm">1</span>
                        Data Penerima
                    </h2>
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
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap (Provinsi, Kota, Kecamatan, Jalan, No Rumah)</label>
                            <textarea name="address" required rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-nibras-magenta focus:border-nibras-magenta" placeholder="Alamat lengkap tujuan pengiriman..."></textarea>
                        </div>
                    </div>
                </div>

                <a href="{{ route('cart.index') }}" class="inline-block mt-4 text-sm font-medium text-gray-500 hover:text-nibras-magenta transition-colors">
                    &larr; Kembali ke Keranjang
                </a>
            </div>

            <!-- Right: Order Summary -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 sticky top-28 container-glow">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 border-b border-gray-100 pb-4">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal ({{ $totalQty }} Produk)</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format($baseSubtotal, 0, ',', '.') }}</span>
                        </div>
                        @php
                            $totalSavings = $baseSubtotal - $subtotal;
                        @endphp
                        @if($totalSavings > 0)
                        <div class="flex justify-between text-green-600">
                            <span>Hemat Produk</span>
                            <span class="font-medium">- Rp {{ number_format($totalSavings, 0, ',', '.') }}</span>
                        </div>
                        @endif
                    </div>

                    <div class="flex justify-between items-center mb-8 p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <span class="text-base font-bold text-gray-900">Total Harga</span>
                        <span class="text-2xl font-black text-nibras-magenta drop-shadow-sm">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" id="submit-button" class="w-full bg-[#25D366] text-white h-14 rounded-full font-bold hover:bg-[#128C7E] transition-all shadow-xl shadow-green-900/20 flex items-center justify-center gap-3 hover:shadow-2xl hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-green-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        Pesan via WhatsApp
                    </button>
                    
                    <p class="text-xs text-gray-400 text-center mt-4">Anda akan diarahkan ke WhatsApp untuk konfirmasi pesanan dan ongkos kirim.</p>
                </div>
            </div>
            
        </form>
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const btn = document.getElementById('submit-button');
            btn.innerHTML = '<div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div> Memproses...';
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            // Form akan submit secara normal dan controller mereturn redirect()->away(waUrl)
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Febia Nibras Kalsel</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        nibras: {
                            magenta: '#E32184',
                            gray: '#EEEEEE',
                            text: '#706f6c',
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        brand: ['Pacifico', 'cursive'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #F8F8F8; overflow-x: hidden; }
        html { overflow-x: hidden; }
        .container-glow { box-shadow: 0 0 40px rgba(0, 0, 0, 0.08); }
    </style>
</head>
<body class="text-gray-800">

    <div class="w-full bg-white min-h-screen relative flex flex-col overflow-x-hidden">
        <!-- Header via Include -->
        @include('layouts.navbar')

        <!-- Main Content -->
        <main class="flex-grow -mt-[70px] md:-mt-[88px]">
            <!-- Banner Section -->
            <section class="w-full relative overflow-hidden shadow-inner flex items-center justify-start bg-pink-50">
                <!-- Full Background Image -->
                <img src="{{ asset('assets/bakcground.png') }}" alt="Promo Nibras Kalimantan" class="w-full h-auto object-cover min-h-[500px] md:min-h-0">
                
                <!-- Text Content Overlay -->
                <div class="absolute inset-0 z-10 flex flex-col justify-center px-6 lg:px-24 w-full h-full pt-[80px] md:pt-[100px]">
                    <div class="max-w-xl md:max-w-2xl lg:max-w-3xl">
                        <span class="block text-gray-600 font-semibold text-lg mb-4 tracking-wide">Katalog Produk</span>
                        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 text-nibras-magenta leading-tight" style="font-family: 'Times New Roman', Times, serif;">
                            Busana Muslim <br/>
                            Modern & Elegan
                        </h1>
                        <p class="text-gray-600 text-lg md:text-xl mb-10 leading-relaxed max-w-lg hidden sm:block">
                            Temukan koleksi busana muslim terbaik dari Nibras Kalimantan untuk Anda dan keluarga tercinta.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row flex-wrap gap-4 relative z-30 mb-8 md:mb-16">
                            <a href="#produk" class="bg-nibras-magenta text-white px-8 py-3.5 rounded-full font-bold shadow-lg hover:bg-pink-700 hover:scale-105 transition-all duration-300 w-full sm:w-auto text-center flex items-center justify-center gap-2">
                                Belanja Sekarang 
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                            <a href="#koleksi" class="bg-white border-2 border-nibras-magenta text-nibras-magenta px-8 py-3.5 rounded-full font-bold shadow-md hover:bg-gray-50 hover:scale-105 transition-all duration-300 w-full sm:w-auto text-center flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg>
                                Lihat Koleksi
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Kategori Shortcut Section -->
            <section class="py-6 md:py-12 bg-pink-50/30 overflow-hidden">
                <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-16 text-center">
                    <h2 class="text-xl md:text-3xl font-bold text-gray-800 mb-4 md:mb-8">Kategori Pilihan</h2>
                    <div class="grid grid-cols-4 gap-2 md:gap-6">
                        <!-- Shortcut 1 -->
                        <a href="{{ url('/produk') }}?kategori=gamis" class="group block bg-white rounded-xl md:rounded-2xl p-2 md:p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-transparent hover:border-nibras-magenta hover:-translate-y-1 flex flex-col items-center justify-center">
                            <div class="w-10 h-10 md:w-16 md:h-16 bg-pink-100 text-nibras-magenta rounded-full flex items-center justify-center mb-2 md:mb-4 group-hover:bg-nibras-magenta group-hover:text-white transition-colors duration-300">
                                <svg class="w-5 h-5 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <h3 class="font-bold text-gray-800 group-hover:text-nibras-magenta transition-colors text-[9px] sm:text-[10px] md:text-base leading-tight">Gamis<span class="hidden md:inline"> Wanita</span></h3>
                        </a>
                        <!-- Shortcut 2 -->
                        <a href="{{ url('/produk') }}?kategori=koko" class="group block bg-white rounded-xl md:rounded-2xl p-2 md:p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-transparent hover:border-nibras-magenta hover:-translate-y-1 flex flex-col items-center justify-center">
                            <div class="w-10 h-10 md:w-16 md:h-16 bg-pink-100 text-nibras-magenta rounded-full flex items-center justify-center mb-2 md:mb-4 group-hover:bg-nibras-magenta group-hover:text-white transition-colors duration-300">
                                <svg class="w-5 h-5 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="font-bold text-gray-800 group-hover:text-nibras-magenta transition-colors text-[9px] sm:text-[10px] md:text-base leading-tight">Baju Koko</h3>
                        </a>
                        <!-- Shortcut 3 -->
                        <a href="{{ url('/produk') }}?kategori=anak" class="group block bg-white rounded-xl md:rounded-2xl p-2 md:p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-transparent hover:border-nibras-magenta hover:-translate-y-1 flex flex-col items-center justify-center">
                            <div class="w-10 h-10 md:w-16 md:h-16 bg-pink-100 text-nibras-magenta rounded-full flex items-center justify-center mb-2 md:mb-4 group-hover:bg-nibras-magenta group-hover:text-white transition-colors duration-300">
                                <svg class="w-5 h-5 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="font-bold text-gray-800 group-hover:text-nibras-magenta transition-colors text-[9px] sm:text-[10px] md:text-base leading-tight">Baju Anak</h3>
                        </a>
                        <!-- Shortcut 4 -->
                        <a href="{{ url('/produk') }}?kategori=sarimbit" class="group block bg-white rounded-xl md:rounded-2xl p-2 md:p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-transparent hover:border-nibras-magenta hover:-translate-y-1 flex flex-col items-center justify-center">
                            <div class="w-10 h-10 md:w-16 md:h-16 bg-pink-100 text-nibras-magenta rounded-full flex items-center justify-center mb-2 md:mb-4 group-hover:bg-nibras-magenta group-hover:text-white transition-colors duration-300">
                                <svg class="w-5 h-5 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <h3 class="font-bold text-gray-800 group-hover:text-nibras-magenta transition-colors text-[9px] sm:text-[10px] md:text-base leading-tight">Sarimbit</h3>
                        </a>
                    </div>
                </div>
            </section>
            
            <!-- Promo Banner Section -->
            <section class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 mb-8 sm:mb-16">
                <div class="w-full flex justify-center">
                    <img src="{{ asset('assets/promobg.png') }}" alt="Promo Spesial Nibras" class="w-full h-auto rounded-xl sm:rounded-2xl shadow-xl hover:shadow-2xl transition-shadow duration-300">
                </div>
            </section>

            <!-- Product Section -->
            <section id="produk" class="px-6 lg:px-16 py-16 md:py-24 bg-gray-50">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4 tracking-tight">Koleksi Unggulan & Terlaris</h2>
                    <div class="w-24 h-1.5 bg-nibras-magenta mx-auto rounded-full"></div>
                    <p class="text-gray-500 mt-4 max-w-2xl mx-auto text-lg hover:text-gray-700 transition-colors">Beberapa produk terfavorit, kekinian, dan paling banyak dicari oleh pelanggan kami saat ini.</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 gap-y-8 md:gap-y-10">
                    
                    @forelse($products as $p)
                        <div class="group relative bg-white transition-all duration-300 hover:shadow-lg rounded-md overflow-hidden flex flex-col h-full border border-transparent hover:border-gray-100 pb-3">
                            <!-- Image Area -->
                            <div class="relative aspect-[3/4] w-full bg-gray-50/50 overflow-hidden">
                                @if($p->images->count() > 0)
                                    <a href="{{ route('product.show', $p->id) }}">
                                        <img src="{{ $p->images->first()->url }}" 
                                             alt="{{ $p->name }}" 
                                             class="w-full h-full object-cover relative z-10 group-hover:scale-105 transition-transform duration-500 ease-in-out {{ $p->total_stock <= 0 ? 'grayscale opacity-60' : '' }}">
                                    </a>
                                @else
                                    <a href="{{ route('product.show', $p->id) }}" class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </a>
                                @endif

                                <!-- Discount Badge -->
                                @if($p->has_discount)
                                    <div class="absolute top-3 left-0 z-20">
                                        @php
                                            // Menghitung % diskon sederhana untuk display
                                            $original = (int)str_replace(['Rp', '.', ','], '', $p->original_min_price);
                                            $current = (int)str_replace(['Rp', '.', ','], '', $p->min_price);
                                            $percent = $original > 0 ? round((($original - $current) / $original) * 100) : 0;
                                        @endphp
                                        <div class="bg-[#ff4057] text-white px-2 py-0.5 rounded-r-md font-bold text-[10px] sm:text-xs shadow-sm">
                                            {{ $percent > 0 ? 'DISKON ' . $percent . '%' : 'SALE' }}
                                        </div>
                                    </div>
                                @endif

                                <!-- Wishlist Icon -->
                                <button class="absolute top-3 right-3 z-20 text-gray-500 hover:text-[#ff4057] transition-colors focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 sm:w-6 sm:h-6 drop-shadow-sm">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>
                                </button>

                                @if($p->total_stock <= 0)
                                    <!-- Out of Stock Badge -->
                                    <div class="absolute inset-0 z-20 flex items-center justify-center bg-white/50 backdrop-blur-[2px]">
                                        <div class="bg-gray-800 text-white px-4 py-1.5 font-bold text-xs uppercase tracking-widest shadow-md">
                                            Habis
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="pt-4 px-3 text-center flex-grow flex flex-col justify-between relative z-30">
                                <h3 class="text-[10px] sm:text-[11px] md:text-xs font-medium text-gray-600 mb-2 uppercase tracking-wider line-clamp-2 leading-relaxed">
                                    <a href="{{ route('product.show', $p->id) }}" class="hover:text-nibras-magenta transition-colors">
                                        {{ $p->name }}
                                    </a>
                                </h3>
                                
                                <div class="mt-auto flex flex-col items-center justify-center pt-1">
                                    @if($p->has_discount)
                                        <div class="flex items-center justify-center gap-1.5 flex-wrap">
                                            <span class="text-[10px] sm:text-[11px] md:text-xs text-gray-400 line-through">{{ $p->original_min_price }}</span>
                                            <span class="text-xs sm:text-sm md:text-base font-bold text-[#de232c]">{{ $p->min_price }}</span>
                                        </div>
                                    @else
                                        <span class="text-xs sm:text-sm md:text-base font-bold text-gray-800">{{ $p->min_price }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 md:col-span-3 lg:col-span-4 text-center py-12">
                            <p class="text-gray-500">Belum ada koleksi produk tersedia.</p>
                        </div>
                    @endforelse

                </div>

                <!-- Button to Products Page -->
                <div class="mt-16 flex justify-center">
                    <a href="{{ url('/produk') }}" class="px-8 py-3 bg-white text-nibras-magenta border-2 border-nibras-magenta hover:bg-nibras-magenta hover:text-white font-bold rounded-full transition-all duration-300 shadow-sm hover:shadow-pink-500/30 flex items-center gap-2 group">
                        Lihat Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </section>
        </main>

        <!-- Footer -->
        @include('layouts.footer')
    </div>

    <script>
        // Mobile Menu Toggle logic is now handled in layouts/navbar.blade.php
    </script>
    
    <!-- SweetAlert2 for Success Messages -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#E32184',
                    confirmButtonText: 'Tutup'
                });
            @endif
        });
    </script>
</body>
</html>


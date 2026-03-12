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
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F8F8F8;
        }
        .container-glow {
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>
<body class="text-gray-800">

    <div class="w-full bg-white min-h-screen relative flex flex-col overflow-x-hidden">
        <!-- Header via Include -->
        @include('layouts.navbar')

        <!-- Main Content -->
        <main class="flex-grow pt-[70px] md:pt-[88px]">
            <!-- Banner Section -->
            <section class="w-full relative bg-gradient-to-r from-nibras-magenta to-pink-800 text-white overflow-hidden shadow-inner flex flex-col justify-end">
                <div class="absolute inset-0 opacity-20 mix-blend-overlay">
                    <img src="https://picsum.photos/1920/600?blur=2" alt="Background" class="w-full h-full object-cover">
                </div>
                <div class="absolute inset-0 opacity-30">
                    <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                        <defs><pattern id="a" patternUnits="userSpaceOnUse" width="40" height="40"><path d="M0 40L40 0H20L0 20M40 40V20L20 40" fill="currentColor" fill-opacity=".1"/></pattern></defs>
                        <rect width="100%" height="100%" fill="url(#a)"/>
                    </svg>
                </div>
                <div class="relative z-10 px-6 lg:px-24 py-12 md:py-16 max-w-4xl pb-12 md:pb-16 text-center md:text-left mt-8 md:mt-0">
                    <span class="inline-block py-1 px-4 rounded-full bg-white/20 backdrop-blur-sm text-xs md:text-sm font-semibold tracking-wider mb-6 md:mb-8 border border-white/30 uppercase shadow-sm">Koleksi Terbaru 2026</span>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 md:mb-6 leading-tight drop-shadow-lg tracking-tight">Menjual Perlengkapan <br class="hidden md:block"/><span class="font-brand text-pink-200 font-light drop-shadow-md">Baju Muslim & Muslimah</span></h1>
                    <div class="w-24 md:w-32 h-1.5 bg-gradient-to-r from-white to-pink-300 mb-6 md:mb-8 rounded-full mx-auto md:mx-0"></div>
                    <ul class="text-sm sm:text-base md:text-lg lg:text-xl space-y-3 md:space-y-4 opacity-100 font-medium drop-shadow-md text-left inline-block">
                        <li class="flex items-center gap-2 md:gap-3"><svg class="w-5 md:w-6 h-5 md:h-6 text-pink-200 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg> Menerima Pemesanan Agen & Reseller Resmi</li>
                        <li class="flex items-center gap-2 md:gap-3"><svg class="w-5 md:w-6 h-5 md:h-6 text-pink-200 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg> Melayani Pembelian Baju Seragaman Partai Besar</li>
                        <li class="flex items-start gap-2 md:gap-3"><svg class="w-5 md:w-6 h-5 md:h-6 text-pink-200 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg> <span class="leading-relaxed">Brand Unggulan: Ethica, Endomoda, Lubi, Raunapride, Aurany...</span></li>
                    </ul>
                    <div class="mt-8 md:mt-12 flex flex-col sm:flex-row flex-wrap gap-4 relative z-30 justify-center md:justify-start">
                        <a href="#produk" class="bg-white text-nibras-magenta px-6 md:px-8 py-3 md:py-3.5 rounded-full font-bold shadow-xl shadow-pink-900/50 hover:bg-gray-50 hover:scale-105 transition-all duration-300 w-full sm:w-auto text-center">Lihat Koleksi</a>
                        <a href="{{ url('/tentang') }}" class="bg-transparent border-2 border-white text-white px-6 md:px-8 py-3 md:py-3.5 rounded-full font-bold hover:bg-white/10 hover:scale-105 transition-all duration-300 w-full sm:w-auto text-center">Hubungi Admin</a>
                    </div>
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
                    <div class="group relative bg-white transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 overflow-hidden flex flex-col h-full rounded-2xl border border-gray-100">
                        <!-- Image Area -->
                        <div class="relative aspect-[3/4] w-full bg-gray-100 overflow-hidden">
                            @if($p->images->count() > 0)
                                <img src="{{ Storage::url($p->images->first()->image_path) }}" 
                                     alt="{{ $p->name }}" 
                                     class="w-full h-full object-cover relative z-10 group-hover:scale-110 group-hover:rotate-1 transition-transform duration-700 ease-in-out {{ $p->total_stock <= 0 ? 'grayscale opacity-60' : '' }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-200">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif

                            @if($p->total_stock <= 0)
                                <!-- Out of Stock Badge -->
                                <div class="absolute inset-0 z-20 flex items-center justify-center">
                                    <div class="bg-gray-900/80 backdrop-blur-sm text-white px-6 py-2 rounded-lg font-bold text-sm tracking-widest uppercase shadow-xl transform -rotate-12 border border-white/20">
                                        Habis
                                    </div>
                                </div>
                            @else
                                <!-- Overlay CTA -->
                                <a href="{{ route('product.show', $p->id) }}" class="absolute inset-0 bg-nibras-magenta/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20 flex items-center justify-center backdrop-blur-[2px]">
                                    <span class="bg-white text-nibras-magenta px-6 py-2.5 rounded-full font-bold shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Lihat Detail</span>
                                </a>
                            @endif
                        </div>
                        
                        <div class="p-5 md:p-6 text-center flex-grow flex flex-col justify-start relative z-30 bg-white">
                            <h3 class="text-xs sm:text-sm font-bold text-gray-900 mb-2 tracking-widest group-hover:text-nibras-magenta transition-colors break-words leading-snug">
                                <a href="{{ route('product.show', $p->id) }}">
                                    <span aria-hidden="true" class="absolute inset-0 z-40"></span>
                                    {{ $p->name }}
                                </a>
                            </h3>
                            <div class="mb-3">
                                <span class="text-[9px] sm:text-[10px] font-bold text-gray-500 bg-gray-100 rounded-sm px-2 py-0.5 border border-gray-200 uppercase tracking-widest">{{ $p->color ?? 'Sesuai Gambar' }}</span>
                            </div>
                            <div class="mt-auto pt-4 border-t border-gray-50 flex flex-col justify-end h-full">
                                <p class="text-xl font-bold text-nibras-magenta mb-1">{{ $p->price_range }}</p>
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest line-clamp-1 mb-1" title="{{ $p->categoryData ? $p->categoryData->name : ($p->category ?? 'Tanpa Kategori') }}">
                                    {{ $p->categoryData ? $p->categoryData->name : ($p->category ?? '-') }}
                                </p>
                                @if($p->brand)
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest bg-gray-50 rounded-sm inline-block px-1.5 py-0.5 mx-auto border border-gray-100">{{ $p->brand->name }}</p>
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
        // Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');

            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        });
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

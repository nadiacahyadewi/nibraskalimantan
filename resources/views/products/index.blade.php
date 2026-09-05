<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Katalog Lengkap Febia Nibras Kalsel - Tersedia berbagai macam gamis, baju koko, busana anak, dan sarimbit keluarga.">
    <meta name="keywords" content="katalog nibras, produk nibras, busana muslim, gamis nibras, koko nibras, sarimbit keluarga, busana muslim kalsel, febia nibras, nibras kalimantan selatan">
    <meta name="author" content="Febia Nibras Kalsel">
    <meta name="robots" content="index, follow">
    
    <title>Katalog Produk | Febia Nibras Kalsel</title>
    
    <!-- PWA -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#E32184">
    <link rel="apple-touch-icon" href="{{ asset('assets/pwa-icon.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
        <!-- Start right after header without the hero banner -->
        <main class="flex-grow pt-[100px] md:pt-[120px]">
            <!-- Product Section -->
            <section id="produk" class="px-6 lg:px-16 pb-16 md:pb-24 bg-gray-50 min-h-screen">
                <div class="text-center mb-10">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4 tracking-tight">Semua Koleksi</h2>
                    <div class="w-24 h-1.5 bg-nibras-magenta mx-auto rounded-full"></div>
                    <p class="text-gray-500 mt-4 max-w-2xl mx-auto text-lg hover:text-gray-700 transition-colors">Telusuri seluruh katalog produk terbaik kami di sini.</p>
                </div>

                <div class="flex flex-col md:flex-row gap-8 items-start">
                    
                    <!-- Sidebar Filter -->
                    <aside class="w-full md:w-1/4 lg:w-64 flex-shrink-0 bg-white border border-gray-100 shadow-sm rounded-xl overflow-hidden sticky top-32">
                        <form action="{{ url('/produk') }}" method="GET" id="filter-form">
                            <!-- Hidden search input to preserve search query -->
                            @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                            <!-- Hidden sort input to preserve sorting -->
                            <input type="hidden" name="sort" id="sort-hidden" value="{{ request('sort', 'terbaru') }}">
                            
                            <div class="p-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                                <h3 class="font-bold text-gray-800 text-lg">Saring</h3>
                                <a href="{{ url('/produk') }}" class="text-xs bg-pink-100 text-nibras-magenta px-3 py-1.5 rounded-md font-semibold hover:bg-nibras-magenta hover:text-white transition-colors">
                                    Hapus Semua
                                </a>
                            </div>

                            <!-- Brand Accordion (sebagai pengganti Grup di referensi gambar) -->
                            <div class="border-b border-gray-100" x-data="{ open: true }">
                                <button type="button" @click="open = !open" class="w-full flex justify-between items-center p-4 text-left font-bold text-gray-800 hover:text-nibras-magenta transition-colors focus:outline-none">
                                    <span>Brand</span>
                                    <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                <div x-show="open" x-collapse>
                                    <div class="px-4 pb-4 space-y-2.5 max-h-48 overflow-y-auto custom-scrollbar">
                                        @foreach($brands as $brand)
                                            <label class="flex items-center space-x-3 cursor-pointer group">
                                                <input type="checkbox" name="brand_id[]" value="{{ $brand->id }}" onchange="document.getElementById('filter-form').submit()"
                                                    {{ in_array($brand->id, $selectedBrand) ? 'checked' : '' }} 
                                                    class="w-4 h-4 rounded border-gray-300 text-nibras-magenta focus:ring-nibras-magenta transition-all">
                                                <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $brand->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Kategori Accordion -->
                            <div class="border-b border-gray-100" x-data="{ open: true }">
                                <button type="button" @click="open = !open" class="w-full flex justify-between items-center p-4 text-left font-bold text-gray-800 hover:text-nibras-magenta transition-colors focus:outline-none">
                                    <span>Kategori</span>
                                    <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                <div x-show="open" x-collapse>
                                    <div class="px-4 pb-4 space-y-2.5 max-h-60 overflow-y-auto custom-scrollbar">
                                        @foreach($categories as $cat)
                                            <label class="flex items-center space-x-3 cursor-pointer group">
                                                <input type="checkbox" name="category_id[]" value="{{ $cat->id }}" onchange="document.getElementById('filter-form').submit()"
                                                    {{ in_array($cat->id, $selectedCategory) ? 'checked' : '' }}
                                                    class="w-4 h-4 rounded border-gray-300 text-nibras-magenta focus:ring-nibras-magenta transition-all">
                                                <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $cat->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </form>
                    </aside>

                    <!-- Main Content (Products Grid) -->
                    <div class="flex-1 w-full">
                        <!-- Top Bar: Result count and Sorting -->
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 bg-white p-3 md:p-4 rounded-xl shadow-sm border border-gray-100 gap-4">
                            <div class="text-sm text-gray-600 font-medium">
                                Menampilkan <span class="font-bold text-gray-900">{{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}</span> produk dari total <span class="font-bold text-gray-900">{{ $products->total() }}</span> produk
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-sm font-bold text-gray-800">Urutan</span>
                                <select onchange="document.getElementById('sort-hidden').value = this.value; document.getElementById('filter-form').submit();" class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:border-nibras-magenta focus:ring-1 focus:ring-nibras-magenta bg-white cursor-pointer shadow-sm">
                                    <option value="terbaru" {{ $sort == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="terlama" {{ $sort == 'terlama' ? 'selected' : '' }}>Terlama</option>
                                    <option value="nama_a_z" {{ $sort == 'nama_a_z' ? 'selected' : '' }}>Nama (A - Z)</option>
                                    <option value="nama_z_a" {{ $sort == 'nama_z_a' ? 'selected' : '' }}>Nama (Z - A)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Grid -->
                        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6 gap-y-8 md:gap-y-10">
                            @forelse($products as $p)
                                <div class="group relative bg-white transition-all duration-300 hover:shadow-lg rounded-xl overflow-hidden flex flex-col h-full border border-transparent hover:border-gray-100 pb-3">
                                    <!-- Image Area -->
                                    <div class="relative aspect-[3/4] w-full bg-gray-50/50 overflow-hidden rounded-t-xl">
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

                                        <!-- Brand Badge (Like the image reference N'BRS) -->
                                        @if($p->brand)
                                            <div class="absolute top-0 right-0 z-20">
                                                <div class="bg-gray-800 text-white px-2 py-1 rounded-bl-lg font-bold text-[10px] sm:text-xs shadow-sm uppercase tracking-wider">
                                                    {{ $p->brand->name }}
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Discount Badge -->
                                        @if($p->has_discount)
                                            <div class="absolute top-3 left-0 z-20">
                                                @php
                                                    $original = (int) str_replace(['Rp', '.', ','], '', $p->original_min_price);
                                                    $current = (int) str_replace(['Rp', '.', ','], '', $p->min_price);
                                                    $percent = $original > 0 ? round((($original - $current) / $original) * 100) : 0;
                                                @endphp
                                                <div class="bg-[#ff4057] text-white px-2 py-0.5 rounded-r-md font-bold text-[10px] sm:text-xs shadow-sm">
                                                    {{ $percent > 0 ? 'DISKON ' . $percent . '%' : 'SALE' }}
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Wishlist / Favorite Icon -->
                                        @php
                                            $isFav = in_array($p->id, $favoriteProductIds ?? []);
                                        @endphp
                                        <button type="button"
                                                onclick="toggleFavorite(event, {{ $p->id }})"
                                                data-product-id="{{ $p->id }}"
                                                class="favorite-btn {{ $isFav ? 'active text-[#ff4057]' : 'text-gray-400' }} hover:text-[#ff4057] absolute bottom-3 right-3 z-20 w-8 h-8 rounded-full bg-white/90 backdrop-blur-sm shadow-sm flex items-center justify-center transition-all duration-200 focus:outline-none hover:scale-110"
                                                title="{{ $isFav ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" 
                                                fill="{{ $isFav ? 'currentColor' : 'none' }}" 
                                                viewBox="0 0 24 24" 
                                                stroke-width="1.5" 
                                                stroke="currentColor" 
                                                class="w-5 h-5 drop-shadow-sm transition-transform duration-200 {{ $isFav ? 'fill-[#ff4057] text-[#ff4057]' : 'text-gray-400' }}">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                            </svg>
                                        </button>

                                        @if($p->total_stock <= 0)
                                            <!-- Out of Stock Badge -->
                                            <div class="absolute inset-0 z-20 flex items-center justify-center bg-white/50 backdrop-blur-[2px]">
                                                <div class="bg-gray-800 text-white px-4 py-1.5 font-bold text-xs uppercase tracking-widest shadow-md rounded-md">
                                                    Habis
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="pt-4 px-3 text-center flex-grow flex flex-col justify-between relative z-30">
                                        <h3 class="text-[11px] md:text-sm font-bold text-gray-800 mb-2 uppercase tracking-wide line-clamp-2 leading-relaxed">
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
                                <div class="col-span-2 md:col-span-3 lg:col-span-4 text-center py-20 bg-white rounded-xl shadow-sm border border-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="text-xl text-gray-500 font-medium">Belum ada produk yang cocok dengan filter ini.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Custom Pagination UI -->
                <div class="mt-12 flex justify-end">
                    @if ($products->hasPages())
                        <div class="flex items-center justify-center space-x-2 font-medium">
                            <!-- Previous Page Link -->
                            @if ($products->onFirstPage())
                                <span class="px-4 py-2 text-gray-400 bg-gray-50 border border-gray-200 rounded-md cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                                </span>
                            @else
                                <a href="{{ $products->previousPageUrl() }}" class="px-4 py-2 text-nibras-magenta bg-white border border-gray-200 rounded-md hover:bg-pink-50 hover:border-nibras-magenta transition-colors shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                                </a>
                            @endif

                            <!-- Pagination Elements -->
                            @for ($i = 1; $i <= $products->lastPage(); $i++)
                                @if ($i == $products->currentPage())
                                    <span class="px-4 py-2 text-white bg-nibras-magenta border border-nibras-magenta rounded-md shadow-md">{{ $i }}</span>
                                @else
                                    <a href="{{ $products->url($i) }}" class="px-4 py-2 text-gray-700 bg-white border border-gray-200 rounded-md hover:text-nibras-magenta hover:bg-pink-50 hover:border-nibras-magenta transition-colors shadow-sm">{{ $i }}</a>
                                @endif
                            @endfor

                            <!-- Next Page Link -->
                            @if ($products->hasMorePages())
                                <a href="{{ $products->nextPageUrl() }}" class="px-4 py-2 text-nibras-magenta bg-white border border-gray-200 rounded-md hover:bg-pink-50 hover:border-nibras-magenta transition-colors shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                                </a>
                            @else
                                <span class="px-4 py-2 text-gray-400 bg-gray-50 border border-gray-200 rounded-md cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                                </span>
                            @endif
                        </div>
                    @endif
                </div>
            </section>
        </main>

        <!-- Footer -->
        @include('layouts.footer')

        <!-- Scroll to Top Button -->
        <button id="scrollToTopBtn" class="fixed bottom-6 right-6 md:bottom-10 md:right-10 z-50 bg-nibras-magenta text-white p-3 rounded-full shadow-lg shadow-pink-900/30 opacity-0 invisible transition-all duration-300 hover:bg-pink-700 hover:scale-110 focus:outline-none translate-y-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>
    </div>

    <script>
        // Scroll to Top Logic
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                scrollToTopBtn.classList.remove('opacity-0', 'invisible', 'translate-y-4');
                scrollToTopBtn.classList.add('opacity-100', 'visible', 'translate-y-0');
            } else {
                scrollToTopBtn.classList.add('opacity-0', 'invisible', 'translate-y-4');
                scrollToTopBtn.classList.remove('opacity-100', 'visible', 'translate-y-0');
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>

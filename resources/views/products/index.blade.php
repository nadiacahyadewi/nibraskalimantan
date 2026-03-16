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
        <!-- Start right after header without the hero banner -->
        <main class="flex-grow pt-[100px] md:pt-[120px]">
            <!-- Product Section -->
            <section id="produk" class="px-6 lg:px-16 pb-16 md:pb-24 bg-gray-50 min-h-screen">
                <div class="text-center mb-10">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4 tracking-tight">Semua Koleksi</h2>
                    <div class="w-24 h-1.5 bg-nibras-magenta mx-auto rounded-full"></div>
                    <p class="text-gray-500 mt-4 max-w-2xl mx-auto text-lg hover:text-gray-700 transition-colors">Telusuri seluruh katalog produk terbaik kami di sini.</p>
                </div>

                <!-- Search and Filters moved to Navbar -->
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <p class="text-xl text-gray-500 font-medium">Belum ada produk di kategori ini.</p>
                        </div>
                    @endforelse

                </div>

                <!-- Custom Pagination UI -->
                <div class="mt-16">
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
    </div>

    <script>
        // Mobile Menu Toggle logic is now handled in layouts/navbar.blade.php
    </script>
</body>
</html>

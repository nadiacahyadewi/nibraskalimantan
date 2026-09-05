<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Beli {{ $product->name }} di Febia Nibras Kalsel. Dapatkan harga terbaik {{ $product->price_range }}. Kualitas original dari Nibras.">
    <meta name="keywords" content="{{ $product->name }}, {{ $product->categoryData ? $product->categoryData->name : ($product->category ?? 'Busana Muslim') }}, {{ $product->brand ? $product->brand->name : 'Nibras' }}, febia nibras, busana muslim kalimantan selatan">
    <meta name="author" content="Febia Nibras Kalsel">
    <meta name="robots" content="index, follow">
    
    <title>{{ $product->name }} - Febia Nibras Kalsel</title>

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
    <style>
        body { overflow-x: hidden; }
        html { overflow-x: hidden; }
    </style>
</head>
<body class="text-gray-800 bg-gray-50 flex flex-col min-h-screen">

    <!-- Header via Include -->
    @include('layouts.navbar')

    <main class="flex-grow pt-[100px] pb-16 px-6 lg:px-16">
        
        <!-- Breadcrumbs -->
        <nav class="flex text-sm text-gray-500 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ url('/') }}" class="hover:text-nibras-magenta transition-colors">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <a href="{{ url('/produk') }}" class="hover:text-nibras-magenta transition-colors">Produk</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <a href="{{ url('/produk?category_id=' . ($product->category_id ?? '')) }}" class="hover:text-nibras-magenta transition-colors">{{ $product->categoryData ? $product->categoryData->name : ($product->category ?? 'Tanpa Kategori') }}</a>
                    </div>
                </li>
                <li aria-current="page" class="min-w-0 flex-1">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="text-gray-800 font-medium truncate">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex flex-col lg:flex-row">
                
                <!-- Left: Image Gallery -->
                <div class="w-full lg:w-5/12 p-6 lg:p-10 border-b lg:border-b-0 lg:border-r border-gray-100 flex flex-col gap-4 items-center">
                    <!-- Main Image -->
                    <div class="aspect-[3/4] w-full max-w-sm bg-gray-100 rounded-xl overflow-hidden relative group shadow-sm border border-gray-100">
                        @if($product->images->count() > 0)
                            <img id="main-image" src="{{ $product->images->first()->url }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500">
                            
                            @if($product->images->count() > 1)
                                <!-- Navigation Arrows -->
                                <button type="button" onclick="prevImage()" class="absolute left-1 md:left-2 top-1/2 -translate-y-1/2 bg-transparent md:bg-white/90 md:hover:bg-white text-gray-800 md:p-2 rounded-full shadow-none md:shadow-md opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-all duration-300 focus:outline-none z-20 hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-8 h-8 md:w-4 md:h-4 drop-shadow-[0_2px_4px_rgba(255,255,255,0.8)] md:drop-shadow-none"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
                                </button>
                                <button type="button" onclick="nextImage()" class="absolute right-1 md:right-2 top-1/2 -translate-y-1/2 bg-transparent md:bg-white/90 md:hover:bg-white text-gray-800 md:p-2 rounded-full shadow-none md:shadow-md opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-all duration-300 focus:outline-none z-20 hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-8 h-8 md:w-4 md:h-4 drop-shadow-[0_2px_4px_rgba(255,255,255,0.8)] md:drop-shadow-none"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                                </button>
                            @endif
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-200">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Thumbnails -->
                    @if($product->images->count() > 1)
                    <div class="grid grid-cols-4 gap-3 md:gap-4 mt-2 w-full max-w-sm">
                        @foreach($product->images as $index => $image)
                        <button onclick="changeImage('{{ $image->url }}')" class="aspect-[3/4] rounded-lg overflow-hidden border-2 {{ $index == 0 ? 'border-nibras-magenta' : 'border-transparent hover:border-gray-300' }} relative focus:outline-none transition-colors thumbnail-btn">
                            <img src="{{ $image->url }}" class="w-full h-full object-cover opacity-80 hover:opacity-100 transition-opacity">
                        </button>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Right: Product Details -->
                <div class="w-full lg:w-7/12 p-6 lg:p-10 flex flex-col">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xs font-bold text-nibras-magenta tracking-widest uppercase">{{ $product->categoryData ? $product->categoryData->name : ($product->category ?? 'Tanpa Kategori') }}</span>
                        @if($product->brand)
                            <span class="text-[10px] font-bold text-gray-400 tracking-widest uppercase border border-gray-200 px-2 py-0.5 rounded">{{ $product->brand->name }}</span>
                        @endif
                    </div>
                    <div class="flex items-start justify-between gap-4 mb-4">
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $product->name }}</h1>
                        @php
                            $isFav = in_array($product->id, $favoriteProductIds ?? []);
                        @endphp
                        <button type="button"
                                onclick="toggleFavorite(event, {{ $product->id }})"
                                data-product-id="{{ $product->id }}"
                                class="favorite-btn {{ $isFav ? 'active text-[#ff4057]' : 'text-gray-400' }} hover:text-[#ff4057] p-2.5 rounded-full border border-gray-200 hover:border-red-200 hover:bg-pink-50/50 shadow-sm transition-all focus:outline-none flex-shrink-0"
                                title="{{ $isFav ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 fill="{{ $isFav ? 'currentColor' : 'none' }}" 
                                 viewBox="0 0 24 24" 
                                 stroke-width="1.5" 
                                 stroke="currentColor" 
                                 class="w-6 h-6 transition-transform duration-200 {{ $isFav ? 'fill-[#ff4057] text-[#ff4057]' : 'text-gray-400' }}">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </button>
                    </div>
                    
                    <div class="flex flex-col gap-1 mb-6">
                        <div class="flex items-center gap-3">
                            <span id="display-price" class="text-2xl md:text-3xl font-bold text-nibras-magenta">{{ $product->price_range }}</span>
                            <span id="original-price" class="text-lg text-gray-400 line-through hidden"></span>
                        </div>
                        <div class="flex items-center text-sm space-x-3">
                            <span id="display-stock" class="bg-pink-50 text-nibras-magenta px-2.5 py-1 rounded-md font-semibold font-mono">Stok: {{ $product->total_stock }}</span>
                            @if($product->total_stock <= 0)
                                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full font-bold text-xs uppercase tracking-wider border border-red-200 shadow-sm animate-pulse">Habis</span>
                            @endif
                        </div>
                    </div>

                    <div class="text-gray-600 mb-8 leading-relaxed whitespace-pre-wrap">{{ $product->description }}</div>

                    <hr class="border-gray-100 mb-8">

                    <!-- Colors -->
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3">Warna:</h3>
                        <div class="flex mb-3">
                            <span class="bg-gray-100 text-gray-800 px-3 py-1 font-medium text-sm rounded-md">{{ $product->color ?? 'Sesuai Gambar' }}</span>
                        </div>
                    </div>

                    <!-- Sizes -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-sm font-semibold text-gray-900">Ukuran:</h3>
                        </div>
                        <div class="grid grid-cols-4 sm:grid-cols-5 md:flex md:flex-wrap gap-2 sm:gap-3">
                            @foreach($product->variants as $variant)
                                @if($variant->stock > 0)
                                    <button type="button" 
                                            class="relative px-2 py-2 border-2 border-gray-200 rounded-md text-sm font-medium hover:border-nibras-magenta hover:text-nibras-magenta transition-colors focus:outline-none text-gray-600 size-btn" 
                                            onclick="selectSize(this, '{{$variant->size}}', {{ $variant->price }}, {{ $variant->stock }}, {{ $variant->discount_price ?? 0 }})">
                                        {{ $variant->size }}
                                        @if($variant->has_discount)
                                            <span class="absolute -top-2 -right-1 bg-red-500 text-white text-[7px] px-1 rounded-full font-bold shadow-sm">Disc</span>
                                        @endif
                                    </button>
                                @else
                                    <button type="button" class="px-2 py-2 border-2 border-gray-200 rounded-md text-sm font-medium text-gray-300 cursor-not-allowed bg-gray-50 focus:outline-none relative overflow-hidden group" disabled title="Habis">
                                        <div class="absolute inset-0 flex items-center justify-center w-full h-full rotate-45 transform">
                                            <div class="w-full h-px bg-gray-300"></div>
                                        </div>
                                        <span class="relative z-10">{{ $variant->size }}</span>
                                    </button>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <!-- Quantity & Add to Cart -->
                    <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm" onsubmit="return validateCartForm()">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="size" id="form-size" value="">
                        <input type="hidden" name="redirect_to_cart" id="redirect_to_cart" value="0">
                        
                        <div class="flex flex-col sm:flex-row gap-4 mt-8 pt-6 border-t border-gray-100">
                            <!-- Quantity -->
                            <div class="flex items-center border-2 border-gray-200 rounded-md w-full sm:w-32 h-12">
                                <button type="button" class="px-4 text-gray-500 hover:text-nibras-magenta focus:outline-none font-bold text-lg" onclick="updateQty(-1)">-</button>
                                <input type="number" name="qty" id="qty" value="1" min="1" max="10" class="w-full text-center text-gray-900 font-semibold focus:outline-none bg-transparent appearance-none">
                                <button type="button" class="px-4 text-gray-500 hover:text-nibras-magenta focus:outline-none font-bold text-lg" onclick="updateQty(1)">+</button>
                            </div>
 
                            <!-- Add to Cart -->
                            <button type="submit" onclick="document.getElementById('redirect_to_cart').value='0'"
                                    class="flex-1 bg-white text-nibras-magenta border-2 border-nibras-magenta h-12 rounded-md font-semibold hover:bg-pink-50 transition-colors shadow-sm flex items-center justify-center gap-2 group {{ $product->total_stock <= 0 ? 'opacity-50 cursor-not-allowed grayscale' : '' }}"
                                    {{ $product->total_stock <= 0 ? 'disabled' : '' }}>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 group-hover:scale-110 transition-transform">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                {{ $product->total_stock <= 0 ? 'Stok Habis' : 'Masuk Keranjang' }}
                            </button>
                        </div>
                        
                        <!-- Buy Now -->
                        <button type="submit" onclick="document.getElementById('redirect_to_cart').value='1'"
                                class="w-full mt-3 bg-nibras-magenta text-white h-12 rounded-md font-semibold hover:bg-pink-700 transition-colors shadow-md flex items-center justify-center gap-2 group {{ $product->total_stock <= 0 ? 'opacity-50 cursor-not-allowed grayscale' : '' }}"
                                {{ $product->total_stock <= 0 ? 'disabled' : '' }}>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 group-hover:translate-x-1 transition-transform">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                            {{ $product->total_stock <= 0 ? 'Stok Habis' : 'Beli Sekarang' }}
                        </button>

                        <!-- Tanya via WA (2 Admin) -->
                        @php
                            $wa_admin_1 = \App\Models\Setting::where('key', 'wa_admin_1')->value('value') ?? '6289523195549';
                            $wa_admin_2 = \App\Models\Setting::where('key', 'wa_admin_2')->value('value') ?? '6282148882473';
                        @endphp
                        <div class="flex gap-3 mt-3 w-full">
                            <button type="button" onclick="buyNowWA('{{ $wa_admin_1 }}')"
                                    class="flex-1 bg-green-500 text-white h-12 rounded-md font-semibold text-sm hover:bg-green-600 transition-colors shadow-md flex items-center justify-center gap-2 group px-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="group-hover:scale-110 transition-transform flex-shrink-0" viewBox="0 0 16 16">
                                    <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c-.003 1.396.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c.003-3.625 2.952-6.575 6.575-6.575a6.56 6.56 0 0 1 4.646 1.928 6.56 6.56 0 0 1 1.923 4.651c-.003 3.625-2.952 6.575-6.575 6.575z"/>
                                </svg>
                                Admin 1
                            </button>
                            <button type="button" onclick="buyNowWA('{{ $wa_admin_2 }}')"
                                    class="flex-1 bg-green-500 text-white h-12 rounded-md font-semibold text-sm hover:bg-green-600 transition-colors shadow-md flex items-center justify-center gap-2 group px-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="group-hover:scale-110 transition-transform flex-shrink-0" viewBox="0 0 16 16">
                                    <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c-.003 1.396.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c.003-3.625 2.952-6.575 6.575-6.575a6.56 6.56 0 0 1 4.646 1.928 6.56 6.56 0 0 1 1.923 4.651c-.003 3.625-2.952 6.575-6.575 6.575z"/>
                                </svg>
                                Admin 2
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <script>
        // Gallery Logic
        const productImages = @json($product->images->pluck('url'));
        let currentImageIndex = 0;

        function updateMainImage() {
            if(productImages.length === 0) return;
            const src = productImages[currentImageIndex];
            document.getElementById('main-image').src = src;
            
            // Update active state on thumbnails
            document.querySelectorAll('.thumbnail-btn').forEach(btn => {
                if (btn.querySelector('img').src.includes(src)) {
                    btn.classList.add('border-nibras-magenta');
                    btn.classList.remove('border-transparent');
                } else {
                    btn.classList.remove('border-nibras-magenta');
                    btn.classList.add('border-transparent');
                }
            });
        }

        function changeImage(src) {
            const index = productImages.findIndex(url => url.includes(src) || src.includes(url));
            if (index !== -1) {
                currentImageIndex = index;
                updateMainImage();
            }
        }

        function nextImage() {
            if(productImages.length <= 1) return;
            currentImageIndex = (currentImageIndex + 1) % productImages.length;
            updateMainImage();
        }

        function prevImage() {
            if(productImages.length <= 1) return;
            currentImageIndex = (currentImageIndex - 1 + productImages.length) % productImages.length;
            updateMainImage();
        }

        // Quantity counter
        function updateQty(change) {
            const input = document.getElementById('qty');
            let val = parseInt(input.value) + change;
            if(val < 1) val = 1;
            
            // Optional: Limit maximum logic based on active selected size stock
            if(val > 10) val = 10;
            
            input.value = val;
        }

        let selectedSize = null;

        function selectSize(btn, size, price, stock, discountPrice) {
            selectedSize = size;
            document.getElementById('form-size').value = size;
            
            const displayPriceEl = document.getElementById('display-price');
            const originalPriceEl = document.getElementById('original-price');
            
            if (discountPrice > 0) {
                displayPriceEl.innerText = 'Rp ' + parseInt(discountPrice).toLocaleString('id-ID');
                originalPriceEl.innerText = 'Rp ' + parseInt(price).toLocaleString('id-ID');
                originalPriceEl.classList.remove('hidden');
            } else {
                displayPriceEl.innerText = 'Rp ' + parseInt(price).toLocaleString('id-ID');
                originalPriceEl.classList.add('hidden');
            }

            document.getElementById('display-stock').innerText = 'Stok: ' + stock;

            // Reset all active styles
            document.querySelectorAll('.size-btn').forEach(b => {
                b.classList.remove('border-nibras-magenta', 'text-nibras-magenta', 'bg-pink-50');
                b.classList.add('border-gray-200', 'text-gray-600');
            });

            // Set active styles for the clicked button
            btn.classList.add('border-nibras-magenta', 'text-nibras-magenta', 'bg-pink-50');
            btn.classList.remove('border-gray-200', 'text-gray-600');
            
            // Reset qty to 1
            document.getElementById('qty').value = 1;
        }

        function validateCartForm() {
            if (!selectedSize) {
                alert('Silakan pilih ukuran terlebih dahulu.');
                return false;
            }
            return true;
        }

        function buyNowWA(phone) {
            if (!selectedSize) {
                alert('Silakan pilih ukuran terlebih dahulu.');
                return;
            }
            
            const name = "{{ $product->name }}";
            const qty = document.getElementById('qty').value;
            const message = `Halo Admin Nibras, saya ingin bertanya tentang:\n\nProduk: ${name}\nUkuran: ${selectedSize}\nJumlah: ${qty}`;
            
            const baseUrl = `https://wa.me/${phone}`;
            
            window.open(`${baseUrl}?text=${encodeURIComponent(message)}`, '_blank');
        }

        // Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');

            if (btn && menu) {
                btn.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                });
            }

            // Hide number input spin buttons
            const style = document.createElement('style');
            style.innerHTML = `
                input[type=number]::-webkit-inner-spin-button, 
                input[type=number]::-webkit-outer-spin-button { 
                    -webkit-appearance: none; 
                    margin: 0; 
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>

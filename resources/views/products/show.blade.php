<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="text-gray-800 font-medium line-clamp-1">{{ $product->name }}</span>
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
                            <img id="main-image" src="{{ Storage::url($product->images->first()->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
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
                        <button onclick="changeImage('{{ Storage::url($image->image_path) }}')" class="aspect-[3/4] rounded-lg overflow-hidden border-2 {{ $index == 0 ? 'border-nibras-magenta' : 'border-transparent hover:border-gray-300' }} relative focus:outline-none transition-colors thumbnail-btn">
                            <img src="{{ Storage::url($image->image_path) }}" class="w-full h-full object-cover opacity-80 hover:opacity-100 transition-opacity">
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
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                    
                    <div class="flex items-center gap-4 mb-6">
                        <span id="display-price" class="text-2xl md:text-3xl font-bold text-nibras-magenta">{{ $product->price_range }}</span>
                        <div class="flex items-center text-sm border-l-2 border-gray-200 pl-4 space-x-3">
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
                        <div class="flex flex-wrap gap-2 sm:gap-3">
                            @foreach($product->variants as $variant)
                                @if($variant->stock > 0)
                                    <button type="button" class="px-4 py-2 border-2 border-gray-200 rounded-md text-sm font-medium hover:border-nibras-magenta hover:text-nibras-magenta transition-colors focus:outline-none text-gray-600 size-btn" onclick="selectSize(this, '{{$variant->size}}', {{ $variant->price }}, {{ $variant->stock }})">{{ $variant->size }}</button>
                                @else
                                    <button type="button" class="px-4 py-2 border-2 border-gray-200 rounded-md text-sm font-medium text-gray-300 cursor-not-allowed bg-gray-50 focus:outline-none relative overflow-hidden group" disabled title="Habis">
                                        <div class="absolute inset-0 flex items-center justify-center w-full h-full rotate-45 transform">
                                            <div class="w-full h-px bg-gray-300"></div>
                                        </div>
                                        <span class="relative z-10 hover:text-gray-300">{{ $variant->size }}</span>
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
                        
                        <div class="flex flex-col sm:flex-row gap-4 mt-8 pt-6 border-t border-gray-100">
                            <!-- Quantity -->
                            <div class="flex items-center border-2 border-gray-200 rounded-md w-full sm:w-32 h-12">
                                <button type="button" class="px-4 text-gray-500 hover:text-nibras-magenta focus:outline-none font-bold text-lg" onclick="updateQty(-1)">-</button>
                                <input type="number" name="qty" id="qty" value="1" min="1" max="10" class="w-full text-center text-gray-900 font-semibold focus:outline-none bg-transparent appearance-none">
                                <button type="button" class="px-4 text-gray-500 hover:text-nibras-magenta focus:outline-none font-bold text-lg" onclick="updateQty(1)">+</button>
                            </div>

                            <!-- Add to Cart -->
                            <button type="submit" 
                                    class="flex-1 bg-nibras-magenta text-white h-12 rounded-md font-semibold hover:bg-pink-700 transition-colors shadow-md flex items-center justify-center gap-2 group {{ $product->total_stock <= 0 ? 'opacity-50 cursor-not-allowed grayscale' : '' }}"
                                    {{ $product->total_stock <= 0 ? 'disabled' : '' }}>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 group-hover:scale-110 transition-transform">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                {{ $product->total_stock <= 0 ? 'Stok Habis' : 'Masuk Keranjang' }}
                            </button>
                        </div>
                    </form>

                    <!-- Buy Now -->
                    <button onclick="{{ $product->total_stock <= 0 ? 'return' : 'buyNowWA()' }}" 
                            class="w-full mt-3 bg-gray-900 text-white h-12 rounded-md font-semibold hover:bg-gray-800 transition-colors shadow flex items-center justify-center gap-2 {{ $product->total_stock <= 0 ? 'opacity-50 cursor-not-allowed grayscale' : '' }}"
                            {{ $product->total_stock <= 0 ? 'disabled' : '' }}>
                        Beli Sekarang (WhatsApp)
                    </button>

                </div>
            </div>
        </div>
        
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <script>
        // Gallery Image Changer
        function changeImage(src) {
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

        function selectSize(btn, size, price, stock) {
            selectedSize = size;
            document.getElementById('form-size').value = size;
            
            // Format price to Rp X.XXX.XXX
            let formattedPrice = 'Rp ' + parseInt(price).toLocaleString('id-ID');
            document.getElementById('display-price').innerText = formattedPrice;
            document.getElementById('display-stock').innerText = 'Stok: ' + stock;

            // Reset all active styles
            document.querySelectorAll('.size-btn').forEach(b => {
                b.classList.remove('border-nibras-magenta', 'text-nibras-magenta', 'bg-pink-50');
                b.classList.add('border-gray-200', 'text-gray-600');
            });

            // Set active styles for the clicked button
            btn.classList.add('border-nibras-magenta', 'text-nibras-magenta', 'bg-pink-50');
            btn.classList.remove('border-gray-200', 'text-gray-600');
            
            // Reset qty to 1 and change max
            document.getElementById('qty').value = 1;
        }

        function validateCartForm() {
            if (!selectedSize) {
                alert('Silakan pilih ukuran terlebih dahulu.');
                return false;
            }
            return true;
        }

        function buyNowWA() {
            if (!selectedSize) {
                alert('Silakan pilih ukuran terlebih dahulu.');
                return;
            }
            
            const name = "{{ $product->name }}";
            const qty = document.getElementById('qty').value;
            const message = `Halo Admin Nibras, saya ingin memesan:\n\nProduk: ${name}\nUkuran: ${selectedSize}\nJumlah: ${qty}\n\nApakah stoknya masih tersedia?`;
            
            // Replace with actual admin number
            const phone = "6282148882473"; 
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

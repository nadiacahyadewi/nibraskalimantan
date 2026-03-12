<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Keranjang Belanja - Febia Nibras Kalsel</title>

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
        
        <div class="mb-8 flex items-center justify-between">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Keranjang Belanja</h1>
            <span id="cart-count-badge" class="text-sm font-medium text-gray-500 bg-white px-3 py-1 rounded-full shadow-sm">{{ $totalQty }} Item</span>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Left: Cart Items -->
            <div class="w-full lg:w-2/3 flex flex-col gap-4" id="cart-items-container">
                @foreach($cartItems as $item)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 md:p-6 flex flex-col sm:flex-row gap-4 relative group cart-item">
                    
                    <!-- Hidden Forms for Update and Delete -->
                    <form id="remove-form-{{ $item->id }}" action="{{ route('cart.remove', $item->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>

                    <form id="update-form-{{ $item->id }}" action="{{ route('cart.update', $item->id) }}" method="POST" class="hidden">
                        @csrf
                        <input type="hidden" name="quantity" id="update-form-qty-{{ $item->id }}" value="{{ $item->quantity }}">
                    </form>

                    <!-- Delete Button -->
                    <button onclick="document.getElementById('remove-form-{{ $item->id }}').submit()" class="absolute right-4 top-4 text-gray-400 hover:text-red-500 transition-colors focus:outline-none z-10" title="Hapus Item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Product Image -->
                    <div class="w-24 h-32 md:w-28 md:h-36 flex-shrink-0 rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
                        @if($item->product->images->isNotEmpty())
                            <img src="{{ Storage::url($item->product->images->first()->image_path) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">No Img</div>
                        @endif
                    </div>

                    <!-- Product Data -->
                    <div class="flex flex-col flex-grow pt-1">
                        <a href="{{ url('/produk/'. $item->product->id) }}" class="text-lg font-bold text-gray-900 hover:text-nibras-magenta transition-colors line-clamp-1 pr-8">{{ $item->product->name }}</a>
                        <p class="text-sm text-gray-500 mb-3 mt-1">Ukuran: {{ $item->size }}</p>
                        
                        <div class="mt-auto flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            @php
                                $variant = $item->product->variants->where('size', $item->size)->first();
                                $itemPrice = $variant ? $variant->price : $item->product->price;
                            @endphp
                            <span class="text-lg font-bold text-nibras-magenta">Rp {{ number_format($itemPrice, 0, ',', '.') }}</span>
                            
                            <!-- Quantity Adjuster -->
                            <div class="flex items-center border border-gray-200 rounded-md w-32 h-10 bg-white">
                                <button onclick="updateCartQty('{{ $item->id }}', {{ $item->quantity - 1 }})" class="px-3 text-gray-500 hover:text-nibras-magenta focus:outline-none font-bold outline-none" {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                <span class="w-full text-center text-gray-900 text-sm font-semibold">{{ $item->quantity }}</span>
                                <button onclick="updateCartQty('{{ $item->id }}', {{ $item->quantity + 1 }})" class="px-3 text-gray-500 hover:text-nibras-magenta focus:outline-none font-bold outline-none">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Empty State (Hidden by default if items exist) -->
                <div id="empty-cart-message" class="{{ count($cartItems) > 0 ? 'hidden' : 'flex' }} bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center flex-col items-center justify-center min-h-[300px]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                    <h2 class="text-xl font-bold text-gray-900 mb-2">Keranjang Anda Kosong</h2>
                    <p class="text-gray-500 mb-6">Sepertinya Anda belum menambahkan produk apapun ke keranjang.</p>
                    <a href="{{ url('/produk') }}" class="px-6 py-2 bg-nibras-magenta text-white font-semibold rounded-md hover:bg-pink-700 transition-colors">Mulai Belanja</a>
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-28">
                    <h2 class="text-lg font-bold text-gray-900 mb-6 border-b border-gray-100 pb-4">Ringkasan Belanja</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span id="summary-count-text">Total Harga ({{ $totalQty }} Barang)</span>
                            <span class="font-medium text-gray-900" id="summary-subtotal">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Diskon Produk</span>
                            <span class="font-medium text-green-600">- Rp 0</span>
                        </div>
                    </div>

                    <hr class="border-gray-100 my-4">

                    <div class="flex justify-between items-center mb-8">
                        <span class="text-base font-bold text-gray-900">Total Tagihan</span>
                        <span class="text-xl font-bold text-nibras-magenta" id="summary-total">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <div id="checkout-container" class="{{ count($cartItems) > 0 ? '' : 'hidden' }}">
                        <a href="{{ route('checkout') }}" class="w-full bg-nibras-magenta text-white h-12 rounded-md font-bold hover:bg-pink-700 transition-all shadow-md flex items-center justify-center gap-2 hover:shadow-lg focus:outline-none">
                            Lanjutkan
                        </a>
                    </div>
                    
                    <a href="{{ url('/produk') }}" class="block text-center w-full mt-4 text-sm font-medium text-nibras-magenta hover:underline">
                        Kembali Berbelanja
                    </a>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <script>
        // JS Functionality for Dummy Cart

        // Format currency function
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number).replace('Rp', 'Rp ').replace(',00', '');
        }

        // Submit form for tracking qty updates
        function updateCartQty(id, qty) {
            if (qty < 1) return;
            document.getElementById('update-form-qty-' + id).value = qty;
            document.getElementById('update-form-' + id).submit();
        }

        // Mobile Menu Toggle logic
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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Produk Favorit - Febia Nibras Kalsel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 
                        nibras: { 
                            magenta: '#E32184', 
                            gray: '#EEEEEE', 
                            text: '#706f6c' 
                        } 
                    },
                    fontFamily: { sans: ['Poppins', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        .heart-bounce {
            animation: heartPop 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        @keyframes heartPop {
            0% { transform: scale(1); }
            50% { transform: scale(1.35); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body class="text-gray-800 bg-gray-50 flex flex-col min-h-screen">
    @include('layouts.navbar')

    <main class="flex-grow pt-[90px] md:pt-[110px] mb-20 px-4 sm:px-6 lg:px-16 container mx-auto max-w-7xl">
        <!-- Breadcrumbs -->
        <nav class="flex text-xs md:text-sm text-gray-500 mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-nibras-magenta transition-colors">Beranda</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-gray-800 font-medium md:ml-2">Produk Favorit</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 pb-6 border-b border-gray-200">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-pink-50 flex items-center justify-center text-red-500 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-red-500" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Produk Favorit Saya</h1>
                        <p class="text-gray-500 text-xs md:text-sm mt-0.5">Daftar busana muslim pilihan yang Anda simpan.</p>
                    </div>
                </div>
            </div>
            @if($favorites->total() > 0)
                <div class="text-sm font-medium text-gray-600 bg-white px-4 py-2 rounded-full border border-gray-200 shadow-sm self-start sm:self-auto flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-nibras-magenta"></span>
                    <span id="fav-total-text">{{ $favorites->total() }} Produk Tersimpan</span>
                </div>
            @endif
        </div>

        <!-- Content -->
        @if($favorites->isEmpty())
            <div id="empty-state" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-10 md:p-16 text-center max-w-xl mx-auto my-12">
                <div class="w-24 h-24 bg-pink-50 text-nibras-magenta rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner animate-pulse">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Produk Favorit</h2>
                <p class="text-gray-500 text-sm md:text-base leading-relaxed mb-8">
                    Tekan ikon hati (<span class="text-red-500 font-bold">♥</span>) pada produk busana muslim yang Anda sukai untuk menyimpannya di sini agar mudah ditemukan kembali saat ingin berbelanja.
                </p>
                <a href="{{ route('produk') }}" class="inline-flex items-center gap-2 bg-nibras-magenta text-white px-8 py-3.5 rounded-full font-semibold shadow-lg shadow-pink-200 hover:bg-pink-700 hover:scale-105 transition-all">
                    <span>Jelajahi Koleksi Produk</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        @else
            <div id="favorites-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 gap-y-8 md:gap-y-10">
                @foreach($favorites as $fav)
                    @php
                        $p = $fav->product;
                    @endphp
                    @if($p)
                        <div id="fav-card-{{ $p->id }}" class="group relative bg-white transition-all duration-300 hover:shadow-lg rounded-md overflow-hidden flex flex-col h-full border border-transparent hover:border-gray-100 pb-3">
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
                                            $original = (int)str_replace(['Rp', '.', ','], '', $p->original_min_price);
                                            $current = (int)str_replace(['Rp', '.', ','], '', $p->min_price);
                                            $percent = $original > 0 ? round((($original - $current) / $original) * 100) : 0;
                                        @endphp
                                        <div class="bg-[#ff4057] text-white px-2 py-0.5 rounded-r-md font-bold text-[10px] sm:text-xs shadow-sm">
                                            {{ $percent > 0 ? 'DISKON ' . $percent . '%' : 'SALE' }}
                                        </div>
                                    </div>
                                @endif

                                <!-- Love / Favorite Button (Active Red) -->
                                <button type="button"
                                        onclick="handleFavoriteRemove(event, {{ $p->id }})"
                                        class="favorite-btn active group/fav absolute top-3 right-3 z-20 w-8 h-8 rounded-full bg-white/90 backdrop-blur-sm shadow-sm flex items-center justify-center text-red-500 hover:scale-110 transition-all focus:outline-none"
                                        title="Hapus dari favorit"
                                        data-product-id="{{ $p->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-red-500 text-red-500 heart-icon drop-shadow-sm transition-transform">
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
                                <div>
                                    <span class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1 block truncate">
                                        {{ $p->categoryData ? $p->categoryData->name : ($p->category ?? 'Busana Muslim') }}
                                    </span>
                                    <h3 class="text-[11px] sm:text-xs md:text-sm font-medium text-gray-800 mb-2 uppercase tracking-wider line-clamp-2 leading-relaxed">
                                        <a href="{{ route('product.show', $p->id) }}" class="hover:text-nibras-magenta transition-colors">
                                            {{ $p->name }}
                                        </a>
                                    </h3>
                                </div>
                                
                                <div class="mt-auto flex flex-col items-center justify-center pt-2">
                                    @if($p->has_discount)
                                        <div class="flex items-center justify-center gap-1.5 flex-wrap mb-3">
                                            <span class="text-[10px] sm:text-[11px] md:text-xs text-gray-400 line-through">{{ $p->original_min_price }}</span>
                                            <span class="text-xs sm:text-sm md:text-base font-bold text-[#de232c]">{{ $p->min_price }}</span>
                                        </div>
                                    @else
                                        <span class="text-xs sm:text-sm md:text-base font-bold text-gray-800 mb-3">{{ $p->min_price }}</span>
                                    @endif

                                    <a href="{{ route('product.show', $p->id) }}" 
                                       class="w-full bg-pink-50 text-nibras-magenta hover:bg-nibras-magenta hover:text-white py-2 px-3 rounded-md text-xs font-semibold transition-colors duration-200 flex items-center justify-center gap-1">
                                        <span>Lihat Produk</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="mt-10">
                {{ $favorites->links() }}
            </div>
        @endif
    </main>

    <!-- Toast Notification -->
    <div id="toast-notification" class="fixed bottom-6 right-6 z-50 transform translate-y-20 opacity-0 transition-all duration-300 pointer-events-none">
        <div class="bg-gray-900/90 backdrop-blur-sm text-white px-4 py-3 rounded-xl shadow-xl flex items-center gap-3 border border-gray-800 text-sm">
            <span id="toast-icon" class="text-red-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
            </span>
            <span id="toast-message" class="font-medium"></span>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        function showToast(message, isFav = true) {
            const toast = document.getElementById('toast-notification');
            const toastMsg = document.getElementById('toast-message');
            const toastIcon = document.getElementById('toast-icon');
            
            if (!toast || !toastMsg) return;
            
            toastMsg.innerText = message;
            if (isFav) {
                toastIcon.className = 'text-red-400';
            } else {
                toastIcon.className = 'text-gray-400';
            }

            toast.classList.remove('translate-y-20', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');

            setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 2500);
        }

        function updateFavBadges(count) {
            const badges = document.querySelectorAll('.favorite-badge');
            const pills = document.querySelectorAll('.favorite-pill');
            const totalText = document.getElementById('fav-total-text');

            badges.forEach(badge => {
                badge.innerText = count;
                if (count > 0) {
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            });

            pills.forEach(pill => {
                pill.innerText = count;
                if (count > 0) {
                    pill.classList.remove('hidden');
                } else {
                    pill.classList.add('hidden');
                }
            });

            if (totalText) {
                totalText.innerText = count + ' Produk Tersimpan';
            }
        }

        function handleFavoriteRemove(event, productId) {
            event.preventDefault();
            event.stopPropagation();

            const card = document.getElementById('fav-card-' + productId);
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            fetch("{{ route('favorites.toggle') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message, false);
                    updateFavBadges(data.count);

                    if (card) {
                        card.style.transition = 'all 0.4s ease';
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.9)';
                        setTimeout(() => {
                            card.remove();
                            const grid = document.getElementById('favorites-grid');
                            if (grid && grid.children.length === 0) {
                                location.reload();
                            }
                        }, 400);
                    }
                }
            })
            .catch(err => {
                console.error('Error removing favorite:', err);
            });
        }
    </script>
</body>
</html>

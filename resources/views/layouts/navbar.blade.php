@php
    $globalCategories = \App\Models\Category::all();
    $globalBrands = \App\Models\Brand::all();
    $currentCategory = request('category_id');
    $currentBrand = request('brand_id');
@endphp

        <!-- Header -->
        <header class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 px-6 lg:px-16 py-4 flex flex-col md:flex-row justify-between items-center transition-all gap-6 shadow-sm">
            <!-- Mobile Left: Profile/Login | Mobile Center: Logo | Mobile Right: Cart & Hamburger -->
            
            <div class="flex items-center justify-between w-full md:w-auto relative">
                <!-- Mobile Only: Profile / Login on the left -->
                <div class="md:hidden flex items-center">
                    @auth
                        <div class="relative">
                            <button id="mobile-profile-button" class="text-black hover:text-nibras-magenta transition-colors focus:outline-none flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                                    <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                                </svg>
                                <svg class="w-3 h-3 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            
                            <!-- Mobile Profile Dropdown -->
                            <div id="mobile-profile-dropdown" class="hidden absolute left-0 mt-2 w-48 bg-white border border-gray-100 rounded-md shadow-lg py-1 z-[60]">
                                <div class="px-4 py-2 border-b border-gray-100 text-sm">
                                    <p class="font-medium text-gray-800">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
                                </div>
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ url('/admin/dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">Dashboard Admin</a>
                                @endif
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">Pesanan Saya</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50 transition-colors">Keluar</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-black hover:text-nibras-magenta transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endauth
                </div>

                <!-- Logo: Centered on mobile, Left on Desktop -->
                <a href="{{ url('/') }}" class="absolute left-1/2 -translate-x-1/2 md:static md:translate-x-0 hover:opacity-80 transition-opacity flex-shrink-0 z-10">
                    <img src="{{ asset('assets/logo.png') }}" alt="Nibras Kalimantan" class="h-8 md:h-12 object-contain">
                </a>
                
                <!-- Mobile Only: Cart & Menu on the right -->
                <div class="md:hidden flex items-center gap-3 relative z-10">
                    <a href="{{ url('/keranjang') }}" class="relative text-black hover:text-nibras-magenta transition-colors flex items-center justify-center">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        @if((isset($cartItemsCount) ? $cartItemsCount : 0) > 0)
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">
                                {{ $cartItemsCount }}
                            </span>
                        @endif
                    </a>
                    <button id="mobile-menu-button" class="text-gray-800 hover:text-nibras-magenta focus:outline-none ml-1">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Navbar (Desktop) -->
            <nav class="hidden md:flex flex-1 justify-center space-x-6 md:space-x-10 text-lg font-medium items-center w-full md:w-auto mt-4 md:mt-0">
                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'text-nibras-magenta hover:text-pink-700' : 'text-gray-800 hover:text-nibras-magenta' }} transition-colors px-2 py-1">
                    Home
                </a>
                <a href="{{ url('/produk') }}" class="{{ request()->is('produk') ? 'text-nibras-magenta hover:text-pink-700' : 'text-gray-800 hover:text-nibras-magenta' }} transition-colors px-2 py-1">
                    Produk
                </a>

                <a href="{{ url('/tentang') }}" class="{{ request()->is('tentang') ? 'text-nibras-magenta hover:text-pink-700' : 'text-gray-800 hover:text-nibras-magenta' }} transition-colors px-2 py-1">
                    Tentang Kami
                </a>
                
            </nav>

            <!-- Search & Profile -->
            <div class="hidden md:flex items-center gap-4 lg:gap-8 justify-end w-auto">
                <!-- Search (Hidden on Mobile) -->
                <form action="{{ url('/produk') }}" method="GET" class="relative flex w-full max-w-lg hidden lg:flex">
                    <!-- Dropdown Button -->
                    <div class="relative flex items-center h-full group z-[60]">
                        <button type="button" class="h-full border border-gray-300 rounded-l-md border-r-0 pl-4 pr-3 py-2 text-sm bg-gray-50 focus:outline-none text-gray-700 font-medium flex items-center gap-1 hover:bg-gray-100 transition-colors">
                            Filter
                            <svg class="w-4 h-4 ml-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <!-- Dropdown Panel -->
                        <div class="absolute top-[100%] left-0 mt-1 w-64 bg-white border border-gray-100 rounded-md shadow-lg p-4 transition-all duration-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible cursor-default z-[70]">
                            <div class="mb-3">
                                <label class="block text-xs font-semibold text-gray-500 mb-1">Pilih Kategori</label>
                                <select name="category_id" class="w-full border border-gray-300 rounded-md px-2 py-1.5 text-sm focus:border-nibras-magenta focus:outline-none bg-white">
                                    <option value="">Semua Kategori</option>
                                    @foreach($globalCategories as $cat)
                                        <option value="{{ $cat->id }}" {{ $currentCategory == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-xs font-semibold text-gray-500 mb-1">Pilih Brand</label>
                                <select name="brand_id" class="w-full border border-gray-300 rounded-md px-2 py-1.5 text-sm focus:border-nibras-magenta focus:outline-none bg-white">
                                    <option value="">Semua Brand</option>
                                    @foreach($globalBrands as $brand)
                                        <option value="{{ $brand->id }}" {{ $currentBrand == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="w-full bg-nibras-magenta text-white py-1.5 rounded-md text-sm font-medium hover:bg-pink-700 transition-colors">Terapkan Filter</button>
                        </div>
                    </div>

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Produk..." class="flex-grow border border-gray-300 border-l-0 pl-4 pr-3 py-2 text-sm focus:outline-none focus:border-nibras-magenta min-w-[200px]">
                    <button type="submit" class="bg-nibras-magenta text-white px-4 py-2 rounded-r-md text-sm font-medium hover:bg-pink-700 transition-colors">Cari</button>
                </form>

                <!-- Desktop Icons & Profile -->
                <div class="flex items-center gap-6">
                    <!-- Cart -->
                    <a href="{{ url('/keranjang') }}" class="relative text-black hover:text-nibras-magenta transition-colors group flex items-center justify-center pt-1">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 transform group-hover:scale-105 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        @if((isset($cartItemsCount) ? $cartItemsCount : 0) > 0)
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">
                                {{ $cartItemsCount }}
                            </span>
                        @endif
                    </a>

                    @auth
                        <!-- Profile Authenticated -->
                        <div class="relative group">
                            <a href="{{ Auth::user()->role === 'admin' ? url('/admin/dashboard') : url('/') }}" class="flex items-center gap-2 group cursor-pointer" title="Dashboard">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-9 h-9 text-black group-hover:text-nibras-magenta transition-colors">
                                    <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-black font-medium text-[16px] group-hover:text-nibras-magenta transition-colors hidden sm:block">{{ strtok(Auth::user()->name, " ") }}</span>
                            </a>
                            <div class="absolute right-0 top-full pt-2 w-48 hidden group-hover:block z-50">
                                <div class="bg-white border border-gray-100 rounded-md shadow-lg py-1">
                                    <div class="px-4 py-2 border-b border-gray-100 text-sm">
                                        <p class="font-medium text-gray-800">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
                                    </div>
                                    <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">Pesanan Saya</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50 transition-colors">Keluar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Profile Guest -->
                        <a href="{{ route('login') }}" class="flex items-center gap-2 group">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-9 h-9 text-black group-hover:text-nibras-magenta transition-colors">
                                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-black font-medium text-[16px] group-hover:text-nibras-magenta transition-colors hidden sm:block">Masuk</span>
                        </a>
                    @endauth
                </div>
            </div>
            
            <!-- Mobile Menu Dropdown (Hidden by default) -->
            <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-white border-t border-gray-100 shadow-lg px-6 py-4 flex flex-col gap-4 text-base font-medium z-40 md:hidden">
                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'text-nibras-magenta hover:text-pink-700' : 'text-gray-800 hover:text-nibras-magenta' }} py-2 border-b border-gray-50">Home</a>
                <a href="{{ url('/produk') }}" class="{{ request()->is('produk') ? 'text-nibras-magenta hover:text-pink-700' : 'text-gray-800 hover:text-nibras-magenta' }} py-2 border-b border-gray-50">Produk</a>
                @auth
                    <a href="{{ route('orders.index') }}" class="{{ request()->is('pesanan*') ? 'text-nibras-magenta hover:text-pink-700' : 'text-gray-800 hover:text-nibras-magenta' }} py-2 border-b border-gray-50">Pesanan Saya</a>
                @endauth
                <a href="{{ url('/tentang') }}" class="{{ request()->is('tentang') ? 'text-nibras-magenta hover:text-pink-700' : 'text-gray-800 hover:text-nibras-magenta' }} py-2 border-b border-gray-50">Tentang Kami</a>
                


                <!-- Mobile Search Box & Filters -->
                <form action="{{ url('/produk') }}" method="GET" class="flex flex-col gap-2 w-full mt-2">
                    <!-- Mobile Filter Accordion -->
                    <div class="border border-gray-300 rounded-md bg-white overflow-hidden relative">
                        <button type="button" onclick="toggleMobileFilter()" class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-50 hover:bg-gray-100 transition-colors">
                            Filter Produk
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div id="mobile-filter-panel" class="hidden flex-col p-4 border-t border-gray-200 bg-white">
                            <div class="mb-4">
                                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wide">Kategori</label>
                                <select name="category_id" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-nibras-magenta focus:ring-1 focus:ring-nibras-magenta bg-white text-gray-700">
                                    <option value="">Semua Kategori</option>
                                    @foreach($globalCategories as $cat)
                                        <option value="{{ $cat->id }}" {{ $currentCategory == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wide">Brand</label>
                                <select name="brand_id" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-nibras-magenta focus:ring-1 focus:ring-nibras-magenta bg-white text-gray-700">
                                    <option value="">Semua Brand</option>
                                    @foreach($globalBrands as $brand)
                                        <option value="{{ $brand->id }}" {{ $currentBrand == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="w-full bg-gray-900 hover:bg-black text-white rounded-md py-2.5 text-sm font-medium transition-colors">Terapkan Filter</button>
                        </div>
                    </div>

                    <div class="relative w-full">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Produk..." class="w-full border border-gray-300 rounded-md pl-4 pr-12 py-2.5 text-sm focus:outline-none focus:border-nibras-magenta focus:ring-1 focus:ring-nibras-magenta">
                        <button type="submit" class="absolute right-0 top-0 h-full bg-nibras-magenta text-white px-4 rounded-r-md hover:bg-pink-700 transition-colors flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                        </button>
                    </div>
                </form>
            </div>
        </header>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Mobile Menu Toggling
                const mobileMenuBtn = document.getElementById('mobile-menu-button');
                const mobileMenu = document.getElementById('mobile-menu');
                
                if (mobileMenuBtn && mobileMenu) {
                    mobileMenuBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        mobileMenu.classList.toggle('hidden');
                        // Close profile dropdown if open
                        const mobileProfileDropdown = document.getElementById('mobile-profile-dropdown');
                        if (mobileProfileDropdown) mobileProfileDropdown.classList.add('hidden');
                    });
                }

                // Mobile Profile Toggling
                const mobileProfileBtn = document.getElementById('mobile-profile-button');
                const mobileProfileDropdown = document.getElementById('mobile-profile-dropdown');
                
                if (mobileProfileBtn && mobileProfileDropdown) {
                    mobileProfileBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        mobileProfileDropdown.classList.toggle('hidden');
                        // Close mobile menu if open
                        if (mobileMenu) mobileMenu.classList.add('hidden');
                    });
                }

                // Close menus when clicking outside
                document.addEventListener('click', (e) => {
                    if (mobileMenu && !mobileMenu.contains(e.target) && e.target !== mobileMenuBtn) {
                        mobileMenu.classList.add('hidden');
                    }
                    if (mobileProfileDropdown && !mobileProfileDropdown.contains(e.target) && e.target !== mobileProfileBtn) {
                        mobileProfileDropdown.classList.add('hidden');
                    }
                });
            });
            
            function toggleMobileFilter() {
                const panel = document.getElementById('mobile-filter-panel');
                if (panel) panel.classList.toggle('hidden');
            }
        </script>

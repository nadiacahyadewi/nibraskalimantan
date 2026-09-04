@php
    $globalCategories = \App\Models\Category::all();
    $globalBrands = \App\Models\Brand::all();
    $currentCategory = request('category_id');
    $currentBrand = request('brand_id');
@endphp

        <!-- Header -->
        <header id="main-navbar" class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-b from-white via-white/90 to-transparent px-6 lg:px-16 py-4 flex flex-col md:flex-row justify-between items-center transition-all duration-300 gap-6 border-transparent">
            <!-- Mobile Left: Profile/Login | Mobile Center: Logo | Mobile Right: Cart & Hamburger -->
            
            <div class="flex items-center justify-between w-full md:w-auto relative">
                <!-- Mobile Left: Hamburger & Profile -->
                <div class="md:hidden flex items-center gap-2">
                    <button id="mobile-menu-button" class="text-gray-800 hover:text-nibras-magenta focus:outline-none">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                    
                    <!-- Mobile Profile Removed -->
                </div>

                <!-- Logo: Centered on mobile, Left on Desktop -->
                <a href="{{ url('/') }}" class="absolute left-1/2 -translate-x-1/2 md:static md:translate-x-0 hover:opacity-80 transition-opacity flex-shrink-0 z-10">
                    <img src="{{ asset('assets/logo.png') }}" alt="Nibras Kalimantan" class="h-8 md:h-12 object-contain">
                </a>
                
                <!-- Mobile Right: Cart & Profile -->
                <div class="md:hidden flex items-center gap-4 relative z-10">
                    <!-- Keranjang (Mobile) -->
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

                    <!-- Profile (Mobile) -->
                    @auth
                        <div class="relative">
                            <button id="mobile-profile-button" class="relative text-black hover:text-nibras-magenta transition-colors flex items-center justify-center focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                            </button>
                            
                            <!-- Mobile Profile Dropdown -->
                            <div id="mobile-profile-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-md shadow-lg py-1 z-[60]">
                                <div class="px-4 py-2 border-b border-gray-100 text-sm">
                                    <p class="font-medium text-gray-800">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
                                </div>
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ url('/admin/dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">Dashboard Admin</a>
                                @endif
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">Edit Profil</a>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">Pesanan Anda</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50 transition-colors">Keluar</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ url('/login') }}" class="relative text-black hover:text-nibras-magenta transition-colors flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Navbar (Desktop) -->
            <nav class="hidden md:flex flex-1 justify-center space-x-6 md:space-x-10 text-lg font-medium items-center w-full md:w-auto mt-4 md:mt-0">
                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'text-nibras-magenta hover:text-pink-700' : 'text-gray-800 hover:text-nibras-magenta' }} transition-colors px-2 py-1 relative after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-nibras-magenta after:transition-transform after:duration-300 hover:after:origin-bottom-left hover:after:scale-x-100 {{ request()->is('/') ? 'after:scale-x-100 after:origin-bottom-left' : '' }}">
                    Beranda
                </a>
                <a href="{{ url('/produk') }}" class="{{ request()->is('produk') ? 'text-nibras-magenta hover:text-pink-700' : 'text-gray-800 hover:text-nibras-magenta' }} transition-colors px-2 py-1 relative after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-nibras-magenta after:transition-transform after:duration-300 hover:after:origin-bottom-left hover:after:scale-x-100 {{ request()->is('produk') ? 'after:scale-x-100 after:origin-bottom-left' : '' }}">
                    Koleksi
                </a>
                
                <div class="relative group">
                    <button class="text-gray-800 group-hover:text-nibras-magenta transition-colors px-2 py-1 flex items-center gap-1 focus:outline-none relative after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-nibras-magenta after:transition-transform after:duration-300 group-hover:after:origin-bottom-left group-hover:after:scale-x-100">
                        Kategori
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <!-- Mega Menu Dropdown -->
                    <div class="absolute left-1/2 -translate-x-1/2 mt-2 w-max max-w-[90vw] bg-white border border-gray-100 shadow-xl rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 z-50 overflow-hidden">
                        <div class="p-6 flex gap-8">
                            <!-- Kategori Column -->
                            <div class="min-w-[200px]">
                                <div class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 px-2 border-b border-gray-100 pb-2">Kategori</div>
                                @if(isset($globalCategories) && $globalCategories->count() > 0)
                                    <div class="grid grid-cols-2 gap-x-6 gap-y-1">
                                        @foreach($globalCategories as $cat)
                                            <a href="{{ url('/produk?category_id=' . $cat->id) }}" class="block px-2 py-1.5 text-sm uppercase text-gray-700 hover:text-nibras-magenta hover:bg-pink-50 rounded-md transition-colors">
                                                {{ $cat->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="block px-2 py-1.5 text-sm text-gray-500 italic">Belum ada kategori</span>
                                @endif
                            </div>

                            <!-- Brand Column -->
                            <div class="min-w-[150px] border-l border-gray-100 pl-8">
                                <div class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 px-2 border-b border-gray-100 pb-2">Brand</div>
                                @if(isset($globalBrands) && $globalBrands->count() > 0)
                                    <div class="flex flex-col gap-1">
                                        @foreach($globalBrands as $brand)
                                            <a href="{{ url('/produk?brand_id=' . $brand->id) }}" class="block px-2 py-1.5 text-sm uppercase text-gray-700 hover:text-nibras-magenta hover:bg-pink-50 rounded-md transition-colors">
                                                {{ $brand->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="block px-2 py-1.5 text-sm text-gray-500 italic">Belum ada brand</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <a href="{{ url('/tentang') }}" class="{{ request()->is('tentang') ? 'text-nibras-magenta hover:text-pink-700' : 'text-gray-800 hover:text-nibras-magenta' }} transition-colors px-2 py-1 relative after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-nibras-magenta after:transition-transform after:duration-300 hover:after:origin-bottom-left hover:after:scale-x-100 {{ request()->is('tentang') ? 'after:scale-x-100 after:origin-bottom-left' : '' }}">
                    Tentang Kami
                </a>
            
            </nav>

            <!-- Search & Profile -->
            <div class="hidden md:flex items-center gap-4 lg:gap-6 justify-end w-auto">
                <!-- Search Form (Desktop) -->
                <form action="{{ url('/produk') }}" method="GET" class="relative hidden md:flex items-center">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Produk..." class="border border-gray-300 rounded-full pl-4 pr-10 py-1.5 text-sm focus:outline-none focus:border-nibras-magenta focus:ring-1 focus:ring-nibras-magenta w-48 xl:w-64 transition-all">
                    <button type="submit" class="absolute right-2 text-gray-500 hover:text-nibras-magenta p-1 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                </form>

                <!-- Desktop Icons & Profile -->
                <div class="flex items-center gap-4">
                    <!-- Cart -->
                    <a href="{{ url('/keranjang') }}" class="relative text-black hover:text-nibras-magenta transition-colors group flex items-center justify-center p-1">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transform group-hover:scale-105 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        @if((isset($cartItemsCount) ? $cartItemsCount : 0) > 0)
                            <span class="absolute top-0 -right-1 bg-nibras-magenta text-white text-[9px] font-bold w-4 h-4 rounded-full flex items-center justify-center shadow">
                                {{ $cartItemsCount }}
                            </span>
                        @endif
                    </a>

                    <!-- Desktop Profile -->
                    @auth
                        <div class="relative group">
                            <button class="relative text-black hover:text-nibras-magenta transition-colors flex items-center justify-center p-1 focus:outline-none">
                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transform group-hover:scale-105 transition-transform">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                            </button>
                            <!-- Profile Dropdown -->
                            <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-md shadow-lg py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-[60]">
                                <div class="px-4 py-2 border-b border-gray-100 text-sm">
                                    <p class="font-medium text-gray-800">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
                                </div>
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ url('/admin/dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">Dashboard Admin</a>
                                @endif
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">Edit Profil</a>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">Pesanan Anda</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50 transition-colors">Keluar</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ url('/login') }}" class="relative text-black hover:text-nibras-magenta transition-colors group flex items-center justify-center p-1">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transform group-hover:scale-105 transition-transform">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </a>
                    @endauth
                </div>
            </div>
            
            <!-- Mobile Menu Dropdown (Hidden by default) -->
            <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-white border-t border-gray-100 shadow-lg px-6 py-4 flex flex-col gap-4 text-base font-medium z-40 md:hidden overflow-y-auto max-h-[calc(100vh-80px)]">
                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'text-nibras-magenta hover:text-pink-700' : 'text-gray-800 hover:text-nibras-magenta' }} py-2 border-b border-gray-50">Beranda</a>
                <a href="{{ url('/produk') }}" class="{{ request()->is('produk') ? 'text-nibras-magenta hover:text-pink-700' : 'text-gray-800 hover:text-nibras-magenta' }} py-2 border-b border-gray-50">Koleksi</a>
                
                <!-- Mobile Kategori Accordion -->
                <div class="border-b border-gray-50">
                    <button type="button" id="mobile-kategori-btn" class="w-full text-left py-2 flex items-center justify-between text-gray-800 hover:text-nibras-magenta focus:outline-none">
                        Kategori
                        <svg id="mobile-kategori-icon" class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div id="mobile-kategori-menu" class="hidden flex-col mt-2 pb-2">
                        <div class="flex gap-4 w-full">
                            <!-- Kolom Kategori -->
                            <div class="flex-1 pl-2 pr-2 border-r border-gray-100">
                                <div class="py-1 text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Kategori</div>
                                <div class="flex flex-col space-y-1">
                                    @if(isset($globalCategories) && $globalCategories->count() > 0)
                                        @foreach($globalCategories as $cat)
                                            <a href="{{ url('/produk?category_id=' . $cat->id) }}" class="block py-1.5 text-sm uppercase text-gray-600 hover:text-nibras-magenta pl-2 border-l-2 border-transparent hover:border-nibras-magenta transition-colors">
                                                {{ $cat->name }}
                                            </a>
                                        @endforeach
                                    @else
                                        <span class="block py-1.5 text-sm text-gray-500 italic pl-2">Belum ada kategori</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Kolom Brand -->
                            <div class="flex-1 pr-2">
                                <div class="py-1 text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Brand</div>
                                <div class="flex flex-col space-y-1">
                                    @if(isset($globalBrands) && $globalBrands->count() > 0)
                                        @foreach($globalBrands as $brand)
                                            <a href="{{ url('/produk?brand_id=' . $brand->id) }}" class="block py-1.5 text-sm uppercase text-gray-600 hover:text-nibras-magenta pl-2 border-l-2 border-transparent hover:border-nibras-magenta transition-colors">
                                                {{ $brand->name }}
                                            </a>
                                        @endforeach
                                    @else
                                        <span class="block py-1.5 text-sm text-gray-500 italic pl-2">Belum ada brand</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('/tentang') }}" class="{{ request()->is('tentang') ? 'text-nibras-magenta hover:text-pink-700' : 'text-gray-800 hover:text-nibras-magenta' }} py-2 border-b border-gray-50">Tentang Kami</a>
            
                <!-- Mobile Search Box -->
                <form action="{{ url('/produk') }}" method="GET" class="flex flex-col gap-2 w-full mt-2 mb-2">
                    <div class="relative w-full">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Produk..." class="w-full border border-gray-300 rounded-md pl-4 pr-12 py-2.5 text-sm focus:outline-none focus:border-nibras-magenta focus:ring-1 focus:ring-nibras-magenta">
                        <button type="submit" class="absolute right-0 top-0 h-full bg-nibras-magenta text-white px-4 rounded-r-md hover:bg-pink-700 transition-colors flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                        </button>
                    </div>
                </form>
                
                <!-- Mobile Guest Menu Removed -->
            </div>
        </header>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Navbar Scroll Effect
                const navbar = document.getElementById('main-navbar');
                
                function checkScroll() {
                    if (window.scrollY > 20) {
                        // Saat discroll: Solid putih dengan bayangan
                        navbar.classList.remove('bg-gradient-to-b', 'from-white', 'via-white/90', 'to-transparent', 'border-transparent');
                        navbar.classList.add('bg-white', 'shadow-md', 'border-gray-100');
                    } else {
                        // Paling atas: Gradient membaur
                        navbar.classList.add('bg-gradient-to-b', 'from-white', 'via-white/90', 'to-transparent', 'border-transparent');
                        navbar.classList.remove('bg-white', 'shadow-md', 'border-gray-100');
                    }
                }
                
                window.addEventListener('scroll', checkScroll);
                checkScroll(); // Check on load

                // Mobile Menu Toggling
                const mobileMenuBtn = document.getElementById('mobile-menu-button');
                const mobileMenu = document.getElementById('mobile-menu');
                
                if (mobileMenuBtn && mobileMenu) {
                    mobileMenuBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        mobileMenu.classList.toggle('hidden');
                    });
                }

                // Mobile Kategori Toggle
                const mobileKategoriBtn = document.getElementById('mobile-kategori-btn');
                const mobileKategoriMenu = document.getElementById('mobile-kategori-menu');
                const mobileKategoriIcon = document.getElementById('mobile-kategori-icon');
                
                if (mobileKategoriBtn && mobileKategoriMenu) {
                    mobileKategoriBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        mobileKategoriMenu.classList.toggle('hidden');
                        mobileKategoriMenu.classList.toggle('flex');
                        mobileKategoriIcon.classList.toggle('rotate-180');
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

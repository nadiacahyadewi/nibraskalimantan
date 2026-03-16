<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel - Febia Nibras Kalsel')</title>

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
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #F3F4F6; }
    </style>
</head>
<body class="text-gray-800 flex h-screen overflow-hidden">

    <!-- Mobile Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 hidden md:hidden transition-opacity"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-white shadow-lg flex flex-col h-full z-30 absolute md:relative -translate-x-full md:translate-x-0 transition-transform duration-300">
        <div class="h-16 flex items-center justify-center border-b border-gray-100 px-4">
            <span class="text-nibras-magenta font-brand text-2xl tracking-tight leading-none">Nibra's Admin</span>
        </div>
        
        <nav class="flex-grow p-4 space-y-2 overflow-y-auto">
            <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->is('admin/dashboard') ? 'bg-pink-50 text-nibras-magenta font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-nibras-magenta' }} rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->is('admin/products*') ? 'bg-pink-50 text-nibras-magenta font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-nibras-magenta' }} rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Kelola Produk
            </a>
            <a href="{{ route('admin.category_brand.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->is('admin/category_brand*') || request()->is('admin/categories*') || request()->is('admin/brands*') ? 'bg-pink-50 text-nibras-magenta font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-nibras-magenta' }} rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Kategori & Brand
            </a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->is('admin/orders*') ? 'bg-pink-50 text-nibras-magenta font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-nibras-magenta' }} rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Kelola Pesanan
            </a>
            <a href="{{ route('admin.finance.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->is('admin/finance*') ? 'bg-pink-50 text-nibras-magenta font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-nibras-magenta' }} rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Kelola Keuangan
            </a>
        </nav>
        
        <div class="p-4 border-t border-gray-100">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Panel
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-full overflow-hidden relative">
        <!-- Topbar -->
        <header class="h-16 bg-white shadow-sm flex items-center justify-between px-4 md:px-8 z-10 w-full gap-2">
            <div class="flex items-center gap-2 md:gap-3 whitespace-nowrap">
                <button id="mobile-menu-btn" class="md:hidden p-2 text-gray-600 hover:text-nibras-magenta focus:outline-none rounded-md hover:bg-gray-50 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <h2 class="text-lg md:text-xl font-semibold text-gray-800">
                    @yield('header_title', 'Admin Panel')
                </h2>
            </div>
            <div class="flex items-center gap-3 md:gap-4 overflow-hidden">
                <span class="text-sm font-medium text-gray-600 truncate max-w-[100px] md:max-w-none">
                    <span class="hidden md:inline">Halo, </span>{{ Auth::user()->name ?? 'Admin' }}
                </span>
                <div class="w-8 h-8 rounded-full bg-nibras-magenta text-white flex items-center justify-center font-bold shadow flex-shrink-0">
                    A
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="flex-1 overflow-y-auto p-4 md:p-8 relative bg-gray-50">
            @yield('content')
        </div>
    </main>

    <!-- Interactive Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const mobileBtn = document.getElementById('mobile-menu-btn');

            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                if (sidebar.classList.contains('-translate-x-full')) {
                    overlay.classList.add('hidden');
                } else {
                    overlay.classList.remove('hidden');
                }
            }

            if (mobileBtn) mobileBtn.addEventListener('click', toggleSidebar);
            if (overlay) overlay.addEventListener('click', toggleSidebar);
        });
    </script>
    @stack('scripts')
</body>
</html>

@extends('layouts.admin_layout')

@section('title', 'Admin Dashboard - Febia Nibras Kalsel')
@section('header_title', 'Dashboard Overview')

@section('content')
<!-- Background decors -->
<div class="absolute -top-40 -right-40 w-96 h-96 bg-pink-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 pointer-events-none"></div>

<div class="max-w-7xl mx-auto space-y-8 relative z-10">
    <!-- Welcome Card -->
    <div class="relative bg-nibras-magenta rounded-2xl p-8 text-white shadow-lg shadow-pink-200 flex flex-col md:flex-row justify-between items-start md:items-center overflow-hidden transition-all duration-500 hover:shadow-xl">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/bakcground.png') }}" class="w-full h-full object-cover object-[center_30%]" alt="Dashboard Background">
            <div class="absolute inset-0 bg-gradient-to-r from-pink-900/90 to-nibras-magenta/80"></div>
        </div>

        <div class="relative z-10 w-full flex flex-col md:flex-row justify-between items-center gap-6">
            <!-- Left Side: Greeting -->
            <div class="text-center md:text-left">
                <h3 class="text-3xl md:text-4xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h3>
                <p class="text-pink-100 text-sm md:text-base opacity-90 mb-4 md:mb-0">Pantau performa toko dan kelola pesanan pelanggan Anda dalam satu genggaman.</p>
            </div>
            
            <!-- Right Side: Clock & Date -->
            <div class="flex flex-col items-center md:items-end gap-1">
                <div class="flex items-center gap-2 text-pink-50 text-sm font-medium mb-1 drop-shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span id="current-date">Memuat tanggal...</span>
                </div>
                <div class="flex flex-row gap-4 items-center drop-shadow-md">
                    <div class="flex flex-col items-center md:items-end">
                        <span id="clock-wib" class="text-xl md:text-2xl font-bold tracking-wider">00:00:00</span>
                        <span class="text-[10px] uppercase tracking-widest text-pink-200">WIB</span>
                    </div>
                    <div class="h-8 w-px bg-white/40"></div>
                    <div class="flex flex-col items-center md:items-start">
                        <span id="clock-wit" class="text-xl md:text-2xl font-bold tracking-wider">00:00:00</span>
                        <span class="text-[10px] uppercase tracking-widest text-pink-200">WITA</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between bg-gray-50/50">
            <h4 class="font-bold text-gray-800">Akses Cepat</h4>
        </div>
        <div class="p-6 grid grid-cols-2 sm:grid-cols-4 gap-4">
            <a href="{{ route('admin.products.create') }}" class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-pink-50 text-gray-600 hover:text-nibras-magenta transition-all group">
                <div class="p-3 bg-gray-50 rounded-lg group-hover:bg-white shadow-sm transition-all border border-transparent group-hover:border-pink-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <span class="text-[10px] font-bold text-center uppercase tracking-tight">Tambah Produk</span>
            </a>
            <a href="{{ route('admin.category_brand.index') }}" class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-blue-50 text-gray-600 hover:text-blue-600 transition-all group">
                <div class="p-3 bg-gray-50 rounded-lg group-hover:bg-white shadow-sm transition-all border border-transparent group-hover:border-blue-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                </div>
                <span class="text-[10px] font-bold text-center uppercase tracking-tight">Kategori & Brand</span>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-indigo-50 text-gray-600 hover:text-indigo-600 transition-all group">
                <div class="p-3 bg-gray-50 rounded-lg group-hover:bg-white shadow-sm transition-all border border-transparent group-hover:border-indigo-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <span class="text-[10px] font-bold text-center uppercase tracking-tight">Pengaturan Web</span>
            </a>
            <a href="{{ route('admin.finance.index') }}" class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-green-50 text-gray-600 hover:text-green-600 transition-all group">
                <div class="p-3 bg-gray-50 rounded-lg group-hover:bg-white shadow-sm transition-all border border-transparent group-hover:border-green-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-[10px] font-bold text-center uppercase tracking-tight">Cek Keuangan</span>
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Products Stat -->
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 group hover:border-blue-500 transition-all duration-300 hover:shadow-md relative overflow-hidden">
            <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <svg class="w-24 h-24 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <div class="flex items-center justify-between mb-2">
                <div class="p-2.5 rounded-xl bg-blue-50 text-blue-500 transition-colors group-hover:bg-blue-500 group-hover:text-white relative z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 font-medium uppercase tracking-wider relative z-10">Total Produk</p>
            <p class="text-2xl font-bold text-gray-800 relative z-10">{{ $totalProducts }}</p>
        </div>

        <!-- Categories Stat -->
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 group hover:border-purple-500 transition-all duration-300 hover:shadow-md relative overflow-hidden">
            <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <svg class="w-24 h-24 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
            </div>
            <div class="flex items-center justify-between mb-2">
                <div class="p-2.5 rounded-xl bg-purple-50 text-purple-500 transition-colors group-hover:bg-purple-500 group-hover:text-white relative z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 font-medium uppercase tracking-wider relative z-10">Total Kategori</p>
            <p class="text-2xl font-bold text-gray-800 relative z-10">{{ $totalCategories }}</p>
        </div>

        <!-- Brands Stat -->
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 group hover:border-orange-500 transition-all duration-300 hover:shadow-md relative overflow-hidden sm:col-span-2 lg:col-span-1">
            <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition-opacity">
                <svg class="w-24 h-24 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <div class="flex items-center justify-between mb-2">
                <div class="p-2.5 rounded-xl bg-orange-50 text-orange-500 transition-colors group-hover:bg-orange-500 group-hover:text-white relative z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 font-medium uppercase tracking-wider relative z-10">Total Brand</p>
            <p class="text-2xl font-bold text-gray-800 relative z-10">{{ $totalBrands }}</p>
        </div>
    </div>

    <!-- Main Content Panels -->
    <div class="grid grid-cols-1 gap-8">
        
        <!-- Recent Products -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between bg-gray-50/50">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-red-50 text-red-500 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h4 class="font-bold text-gray-800">Stok yang Sedang Menipis</h4>
                </div>
                <a href="{{ route('admin.products.index') }}" class="text-xs font-semibold text-nibras-magenta hover:text-pink-700">Kelola Produk &rarr;</a>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    @forelse($lowStockProducts as $p)
                    <div class="group border border-gray-100 rounded-xl overflow-hidden hover:border-nibras-magenta transition-all hover:shadow-md bg-gray-50/30 flex flex-col">
                        <div class="relative aspect-square w-full bg-gray-100 overflow-hidden">
                            @if($p->images->count() > 0)
                                <img src="{{ $p->images->first()->url }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute top-2 right-2 bg-white/90 backdrop-blur text-[9px] font-bold px-2 py-1 rounded-md text-gray-700 shadow-sm">
                                Stok: <span class="{{ $p->total_stock > 0 ? 'text-green-600' : 'text-red-500' }}">{{ $p->total_stock }}</span>
                            </div>
                        </div>
                        <div class="p-3 flex flex-col flex-grow">
                            <span class="text-[10px] text-gray-400 font-medium uppercase tracking-wider mb-1">{{ $p->categoryData->name ?? 'Uncategorized' }}</span>
                            <h5 class="text-sm font-bold text-gray-800 line-clamp-1 group-hover:text-nibras-magenta transition-colors mb-2">{{ $p->name }}</h5>
                            <div class="mt-auto">
                                <span class="text-xs font-bold text-gray-900">Rp {{ number_format($p->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-8 text-center text-gray-400">
                        <p class="text-sm">Belum ada produk terdaftar.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function updateDashboardClocks() {
        const now = new Date();
        
        // Format Hari, Tanggal Bulan Tahun
        const optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', timeZone: 'Asia/Jakarta' };
        document.getElementById('current-date').textContent = now.toLocaleDateString('id-ID', optionsDate);
        
        // Format Waktu WIB (UTC+7)
        const optionsWIB = { timeZone: 'Asia/Jakarta', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
        document.getElementById('clock-wib').textContent = now.toLocaleTimeString('id-ID', optionsWIB);
        
        // Format Waktu WITA (UTC+8)
        const optionsWITA = { timeZone: 'Asia/Makassar', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
        document.getElementById('clock-wit').textContent = now.toLocaleTimeString('id-ID', optionsWITA);
    }
    
    // Initial call & Interval
    updateDashboardClocks();
    setInterval(updateDashboardClocks, 1000);
</script>
@endpush

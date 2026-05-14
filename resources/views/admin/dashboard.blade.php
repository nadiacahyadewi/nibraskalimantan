@extends('layouts.admin_layout')

@section('title', 'Admin Dashboard - Febia Nibras Kalsel')
@section('header_title', 'Dashboard Overview')

@section('content')
<!-- Background decors -->
<div class="absolute -top-40 -right-40 w-96 h-96 bg-pink-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 pointer-events-none"></div>

<div class="max-w-7xl mx-auto space-y-8 relative z-10">
    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-nibras-magenta to-pink-600 rounded-2xl p-8 text-white shadow-lg shadow-pink-200 flex justify-between items-center relative overflow-hidden transition-all duration-500 hover:shadow-xl hover:scale-[1.01]">
        <div class="absolute right-0 top-0 opacity-10">
            <svg width="200" height="200" viewBox="0 0 24 24" fill="currentColor"><path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"/></svg>
        </div>
        <div class="relative z-10">
            <h3 class="text-2xl md:text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h3>
            <p class="text-pink-100 text-sm md:text-base opacity-90">Pantau performa toko dan kelola pesanan pelanggan Anda dalam satu genggaman.</p>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="hidden md:flex relative z-10 bg-white text-nibras-magenta px-6 py-2 rounded-lg font-semibold hover:bg-gray-50 transition-all shadow items-center gap-2 group">
            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            Lihat Website
        </a>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Pending Confirmation Stat -->
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-orange-100 group hover:border-orange-500 transition-all duration-300">
            <div class="flex items-center justify-between mb-2">
                <div class="p-2.5 rounded-xl bg-orange-50 text-orange-600 transition-colors group-hover:bg-orange-600 group-hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <p class="text-xs text-gray-400 font-medium">Perlu Konfirmasi</p>
            <p class="text-xl font-bold text-gray-800">{{ $pendingConfirmation }}</p>
        </div>

        <!-- Orders Stat -->
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 group hover:border-nibras-magenta transition-all duration-300">
            <div class="flex items-center justify-between mb-2">
                <div class="p-2.5 rounded-xl bg-blue-50 text-blue-600 transition-colors group-hover:bg-blue-600 group-hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            </div>
            <p class="text-xs text-gray-400 font-medium">Pesanan Aktif</p>
            <p class="text-xl font-bold text-gray-800">{{ $activeOrders }}</p>
        </div>

        <!-- Products Stat -->
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 group hover:border-nibras-magenta transition-all duration-300">
            <div class="flex items-center justify-between mb-2">
                <div class="p-2.5 rounded-xl bg-pink-50 text-nibras-magenta transition-colors group-hover:bg-nibras-magenta group-hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
            </div>
            <p class="text-xs text-gray-400 font-medium">Total Produk</p>
            <p class="text-xl font-bold text-gray-800">{{ $totalProducts }}</p>
        </div>

        <!-- Customers Stat -->
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 group hover:border-nibras-magenta transition-all duration-300">
            <div class="flex items-center justify-between mb-2">
                <div class="p-2.5 rounded-xl bg-purple-50 text-purple-600 transition-colors group-hover:bg-purple-600 group-hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
            <p class="text-xs text-gray-400 font-medium">Pelanggan</p>
            <p class="text-xl font-bold text-gray-800">{{ number_format($totalCustomers) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Orders -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between bg-gray-50/50">
                <h4 class="font-bold text-gray-800">Pesanan Terbaru</h4>
                <a href="{{ route('admin.orders.index') }}" class="text-xs font-semibold text-nibras-magenta hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/30 text-[10px] uppercase tracking-wider text-gray-400">
                            <th class="px-6 py-3 font-bold">Pelanggan</th>
                            <th class="px-6 py-3 font-bold">Total</th>
                            <th class="px-6 py-3 font-bold">Status</th>
                            <th class="px-6 py-3 font-bold">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm">
                        @forelse($recentOrders as $order)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-pink-100 text-nibras-magenta flex items-center justify-center font-bold text-xs uppercase">
                                        {{ substr($order->user->name ?? 'G', 0, 1) }}
                                    </div>
                                    <span class="font-semibold text-gray-700 truncate max-w-[120px]">{{ $order->user->name ?? 'Guest' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-800">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'Menunggu Konfirmasi' => 'bg-yellow-50 text-yellow-600',
                                        'Menunggu Pembayaran' => 'bg-gray-50 text-gray-600',
                                        'Dibayar' => 'bg-blue-50 text-blue-600',
                                        'Diproses' => 'bg-indigo-50 text-indigo-600',
                                        'Dikirim' => 'bg-purple-50 text-purple-600',
                                        'Selesai' => 'bg-green-50 text-green-600',
                                        'Dibatalkan' => 'bg-red-50 text-red-600',
                                    ];
                                    $badgeClass = $statusColors[$order->status] ?? 'bg-gray-50 text-gray-600';
                                @endphp
                                <span class="text-[10px] px-2.5 py-1 rounded-full font-bold {{ $badgeClass }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-400">{{ $order->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">Belum ada pesanan terbaru.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top Selling Products -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between bg-gray-50/50">
                <h4 class="font-bold text-gray-800">Produk Terlaris</h4>
            </div>
            <div class="p-4 space-y-4">
                @forelse($topProducts as $item)
                <div class="flex items-center gap-4 group cursor-pointer">
                    <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0 border border-gray-50 group-hover:border-nibras-magenta transition-colors">
                        @if($item->product && $item->product->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-grow min-w-0">
                        <p class="text-sm font-semibold text-gray-700 truncate group-hover:text-nibras-magenta transition-colors">{{ $item->product->name ?? 'Unknown Product' }}</p>
                        <p class="text-xs text-gray-400">{{ $item->total_sold }} terjual</p>
                    </div>
                    <div class="text-nibras-magenta">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path></svg>
                    </div>
                </div>
                @empty
                <p class="text-sm text-center text-gray-400 py-8">Belum ada data penjualan.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Customers -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between bg-gray-50/50">
                <h4 class="font-bold text-gray-800">Pelanggan Terbaru</h4>
            </div>
            <div class="p-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                @forelse($recentCustomers as $customer)
                <div class="flex items-center gap-3 p-3 rounded-xl border border-gray-50 hover:bg-pink-50/30 hover:border-pink-100 transition-all cursor-default">
                    <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center font-bold">
                        {{ substr($customer->name, 0, 1) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-gray-700 truncate">{{ $customer->name }}</p>
                        <p class="text-[10px] text-gray-400">{{ $customer->email }}</p>
                    </div>
                </div>
                @empty
                <p class="col-span-2 text-sm text-center text-gray-400 py-4">Belum ada pelanggan baru.</p>
                @endforelse
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
                <a href="{{ route('admin.orders.index') }}" class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-indigo-50 text-gray-600 hover:text-indigo-600 transition-all group">
                    <div class="p-3 bg-gray-50 rounded-lg group-hover:bg-white shadow-sm transition-all border border-transparent group-hover:border-indigo-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <span class="text-[10px] font-bold text-center uppercase tracking-tight">Semua Pesanan</span>
                </a>
                <a href="{{ route('admin.finance.index') }}" class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-green-50 text-gray-600 hover:text-green-600 transition-all group">
                    <div class="p-3 bg-gray-50 rounded-lg group-hover:bg-white shadow-sm transition-all border border-transparent group-hover:border-green-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-[10px] font-bold text-center uppercase tracking-tight">Cek Keuangan</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@extends('layouts.admin_layout')

@section('title', 'Kelola Pesanan - Admin Panel')
@section('header_title', 'Kelola Pesanan')

@section('content')
<div class="px-6 py-8">
    <div class="mb-8 flex flex-col gap-6">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Kelola Pesanan</h2>
                <p class="text-sm text-gray-500 mt-1">Daftar pesanan masuk dari pelanggan.</p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                <!-- Search and Filter Form -->
                <form action="{{ route('admin.orders.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3 w-full">
                    <input type="hidden" name="tab" value="{{ $tab }}">
                    
                    <div class="flex flex-col sm:flex-row gap-3 w-full">
                        <div class="relative flex-grow sm:max-w-xs">
                            <input type="text" name="search" value="{{ $search }}" placeholder="Nama/ID/HP..." 
                                   class="w-full pl-10 pr-20 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-nibras-magenta/20 focus:border-nibras-magenta transition-all">
                            <div class="absolute left-3 top-2.5 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <button type="submit" class="absolute right-1 top-1 bottom-1 bg-nibras-magenta text-white px-3 rounded-md text-xs font-semibold hover:bg-pink-700 transition-colors">
                                Cari
                            </button>
                        </div>
                        
                        <select name="status" onchange="this.form.submit()" 
                                class="w-full sm:w-48 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-nibras-magenta/20 focus:border-nibras-magenta transition-all">
                            <option value="">Semua Status</option>
                            @php
                                $statuses = ['Menunggu Pembayaran', 'Dibayar', 'Menunggu Konfirmasi', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'];
                            @endphp
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ $statusFilter == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Tabs -->
        <div class="border-b border-gray-200 overflow-x-auto">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <a href="{{ route('admin.orders.index', ['tab' => 'active']) }}" 
                   class="{{ strtolower($tab) === 'active' ? 'border-nibras-magenta text-nibras-magenta' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                    Pesanan Aktif
                </a>
                <a href="{{ route('admin.orders.index', ['tab' => 'history']) }}" 
                   class="{{ strtolower($tab) === 'history' ? 'border-nibras-magenta text-nibras-magenta' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                    Riwayat Pesanan
                </a>
            </nav>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-700 border border-green-200 rounded-lg flex items-start gap-3">
            <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <div>
                <h4 class="text-sm font-semibold">Berhasil</h4>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-500 border-b border-gray-100 text-sm">
                        <th class="py-4 px-6 font-semibold">ID Pesanan</th>
                        <th class="py-4 px-6 font-semibold">Tanggal</th>
                        <th class="py-4 px-6 font-semibold">Nama Pelanggan</th>
                        <th class="py-4 px-6 font-semibold">Total Nilai</th>
                        <th class="py-4 px-6 font-semibold">Status</th>
                        <th class="py-4 px-6 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-4 px-6">
                                <span class="font-medium text-gray-900">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="py-4 px-6 text-gray-600 text-sm">
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-medium text-gray-900">{{ $order->customer_name }}</div>
                                <div class="text-xs text-gray-500">{{ $order->customer_phone }}</div>
                            </td>
                            <td class="py-4 px-6 font-semibold text-gray-900">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-6">
                                @php
                                    $statusColor = match($order->status) {
                                        'Menunggu Konfirmasi' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                        'Diproses' => 'bg-blue-100 text-blue-700 border-blue-200',
                                        'Dikirim' => 'bg-nibras-magenta/10 text-nibras-magenta border-nibras-magenta/20',
                                        'Selesai' => 'bg-green-100 text-green-700 border-green-200',
                                        'Dibatalkan' => 'bg-red-100 text-red-700 border-red-200',
                                        default => 'bg-gray-100 text-gray-700 border-gray-200'
                                    };
                                @endphp
                                <span class="px-3 py-1 text-xs font-semibold rounded-full border {{ $statusColor }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-50 text-nibras-magenta hover:bg-nibras-magenta hover:text-white rounded-md text-sm font-medium transition-colors border border-gray-200 hover:border-nibras-magenta">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 px-6 text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                {{ $tab === 'history' ? 'Belum ada riwayat pesanan.' : 'Belum ada pesanan aktif.' }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($orders->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

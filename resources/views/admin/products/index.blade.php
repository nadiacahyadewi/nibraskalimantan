@extends('layouts.admin_layout')

@section('title', 'Kelola Produk - Admin Panel')
@section('header_title', 'Daftar Produk')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    
    @if(session('success'))
    <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif
    
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
        <div class="w-full lg:w-auto">
            <h3 class="text-2xl font-bold text-gray-800">Kelola Produk</h3>
            <p class="text-gray-500 text-sm mt-1">Daftar semua produk yang tersedia di toko.</p>
        </div>
        
        <div class="w-full lg:w-auto flex flex-col sm:flex-row gap-3">
            <!-- Search and Filter Form -->
            <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                <div class="relative w-full sm:w-64">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama produk..." 
                           class="w-full pl-10 pr-20 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-nibras-magenta/20 focus:border-nibras-magenta transition-all">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <button type="submit" class="absolute right-1 top-1 bottom-1 bg-nibras-magenta text-white px-3 rounded-md text-xs font-semibold hover:bg-pink-700 transition-colors">
                        Cari
                    </button>
                </div>
                
                <select name="category" onchange="this.form.submit()" 
                        class="w-full sm:w-48 px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-nibras-magenta/20 focus:border-nibras-magenta transition-all">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </form>

            <a href="{{ route('admin.products.create') }}" class="bg-nibras-magenta text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-pink-700 transition-colors flex items-center justify-center gap-2 shadow-sm whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span class="inline">Tambah Produk</span>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto overflow-y-hidden">
            <table class="w-full text-left border-collapse min-w-[700px]">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 text-xs uppercase tracking-wider">
                        <th class="p-4 font-semibold">Produk</th>
                        <th class="p-4 font-semibold">Kategori</th>
                        <th class="p-4 font-semibold">Harga</th>
                        <th class="p-4 font-semibold text-center">Total Stok</th>
                        <th class="p-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($products as $product)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="p-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-lg bg-gray-100 border border-gray-200 overflow-hidden flex-shrink-0">
                                    @if($product->images->count() > 0)
                                        <img src="{{ $product->images->first()->url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="max-w-[150px] sm:max-w-[200px] md:max-w-xs">
                                    <p class="font-semibold text-gray-800 text-sm truncate" title="{{ $product->name }}">{{ $product->name }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5 truncate">Warna: {{ $product->color ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 text-sm text-gray-600">
                            <span class="px-2 py-1 bg-pink-50 text-nibras-magenta rounded-md text-xs font-medium">{{ $product->categoryData->name ?? $product->category ?? 'Tanpa Kategori' }}</span>
                        </td>
                        <td class="p-4">
                            <div class="flex flex-col gap-1">
                                <span class="text-sm font-medium text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                @if($product->variants->whereNotNull('discount_price')->where('discount_price', '>', 0)->count() > 0)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-green-100 text-green-700 w-fit">
                                        DISKON
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex flex-col items-center">
                                <span class="text-sm font-bold {{ $product->total_stock > 10 ? 'text-green-600' : ($product->total_stock > 0 ? 'text-orange-500' : 'text-red-500') }}">
                                    {{ $product->total_stock }}
                                </span>
                            <span class="text-xs text-gray-500 mt-1 cursor-pointer hover:text-nibras-magenta transition-colors underline decoration-dotted" 
                                  data-product-name="{{ $product->name }}"
                                  data-product-variants="{{ $product->variants->toJson() }}"
                                  onclick="showStockModal(this)" 
                                  title="Klik untuk lihat detail stok">Lihat Detail Stok</span>
                            </div>
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex items-center justify-end gap-2">

                                <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Product">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete Product">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                <p>Belum ada produk terdaftar.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($products->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Stock Modal -->
<div id="stockModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" aria-hidden="true" onclick="closeStockModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100 relative z-10">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-gray-100">
                <div class="flex justify-between items-center pr-2">
                    <h3 class="text-lg leading-6 font-semibold text-gray-900" id="stockModalTitle">Detail Stok Produk</h3>
                    <button type="button" onclick="closeStockModal()" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-nibras-magenta transition-colors">
                        <span class="sr-only">Close modal</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="px-4 py-5 sm:p-6 bg-gray-50">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
                    <table class="w-full text-left border-collapse" id="stockModalTable">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 text-xs uppercase tracking-wider">
                                <th class="py-3 px-4 font-semibold w-2/3">Ukuran / Varian</th>
                                <th class="py-3 px-4 font-semibold text-right w-1/3">Stok</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100" id="stockModalTableBody">
                            <!-- Rows will be populated by JS -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bg-white px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                <button type="button" onclick="closeStockModal()" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-nibras-magenta text-base font-medium text-white hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-nibras-magenta sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function showStockModal(element) {
        const productName = element.getAttribute('data-product-name');
        const variantsJson = element.getAttribute('data-product-variants');

        document.getElementById('stockModalTitle').innerText = 'Stok: ' + productName;
        let variants = [];
        try {
            variants = JSON.parse(variantsJson);
        } catch(e) {
            console.error("Gagal membaca data varian", e);
        }
        const tableBody = document.getElementById('stockModalTableBody');
        tableBody.innerHTML = '';
        
        if (variants.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="2" class="py-4 px-4 text-center text-gray-500 text-sm">Tidak ada varian stok tercatat.</td></tr>';
        } else {
            variants.forEach(variant => {
                const tr = document.createElement('tr');
                tr.className = 'hover:bg-gray-50 transition-colors';
                
                const stock = parseInt(variant.stock) || 0;
                let stockColorClass = 'text-red-500';
                if(stock > 10) stockColorClass = 'text-green-600';
                else if(stock > 0) stockColorClass = 'text-orange-500';
                
                tr.innerHTML = `
                    <td class="py-3 px-4 text-sm text-gray-800 font-medium">${variant.size || variant.name || '-'}</td>
                    <td class="py-3 px-4 text-sm text-right font-bold ${stockColorClass}">${stock}</td>
                `;
                tableBody.appendChild(tr);
            });
        }
        
        document.getElementById('stockModal').classList.remove('hidden');
    }

    function closeStockModal() {
        document.getElementById('stockModal').classList.add('hidden');
    }

    // Close modal on Escape key press
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeStockModal();
        }
    });

</script>
@endpush

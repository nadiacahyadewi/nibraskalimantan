<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Produk - Admin Panel</title>

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
            <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-nibras-magenta rounded-lg transition-colors font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 bg-pink-50 text-nibras-magenta rounded-lg transition-colors font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Kelola Produk
            </a>
            <a href="{{ route('admin.category_brand.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-nibras-magenta rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Kategori & Brand
            </a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-nibras-magenta rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Kelola Pesanan
            </a>
            <a href="{{ route('admin.finance.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-nibras-magenta rounded-lg transition-colors">
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
                    Daftar Produk
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
            <div class="max-w-7xl mx-auto space-y-6">
                
                @if(session('success'))
                <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
                @endif
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Kelola Produk</h3>
                        <p class="text-gray-500 text-sm mt-1">Daftar semua produk yang tersedia di toko.</p>
                    </div>
                    <a href="{{ route('admin.products.create') }}" class="bg-nibras-magenta text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-pink-700 transition-colors flex items-center gap-2 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Produk Baru
                    </a>
                </div>

                <!-- Products Table -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
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
                                                    <img src="{{ Storage::url($product->images->first()->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-800 text-sm">{{ $product->name }}</p>
                                                <p class="text-xs text-gray-500 mt-0.5">Warna: {{ $product->color ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-sm text-gray-600">
                                        <span class="px-2 py-1 bg-pink-50 text-nibras-magenta rounded-md text-xs font-medium">{{ $product->categoryData->name ?? $product->category ?? 'Tanpa Kategori' }}</span>
                                    </td>
                                    <td class="p-4 text-sm font-medium text-gray-800">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
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
        </div>
    </main>

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
</body>
</html>

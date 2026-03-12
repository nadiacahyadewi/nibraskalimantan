<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Produk - Admin Panel</title>

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
            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-nibras-magenta rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Kelola Pesanan
            </a>
            <a href="{{ route('admin.category_brand.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-nibras-magenta rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Kategori & Brand
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
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.products.index') }}" class="text-gray-500 hover:text-nibras-magenta">Produk</a>
                    <span class="text-gray-400">/</span>
                    <h2 class="text-lg md:text-xl font-semibold text-gray-800">Edit Produk</h2>
                </div>
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
            <div class="max-w-4xl mx-auto">
                
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 relative" role="alert">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="font-semibold text-gray-800">Formulir Edit Produk</h3>
                    </div>
                    
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Basic Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required class="w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-nibras-magenta focus:border-nibras-magenta sm:text-sm">
                            </div>
                            
                            <div class="space-y-1">
                                <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                                <select name="category_id" id="category_id" class="w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-nibras-magenta focus:border-nibras-magenta sm:text-sm">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-1">
                                <label for="brand_id" class="block text-sm font-medium text-gray-700">Brand</label>
                                <select name="brand_id" id="brand_id" class="w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-nibras-magenta focus:border-nibras-magenta sm:text-sm">
                                    <option value="">-- Pilih Brand --</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-1">
                                <label for="price" class="block text-sm font-medium text-gray-700">Harga Dasar Tampilan (Rp) <span class="text-red-500">*</span></label>
                                <input type="number" name="price" id="price" value="{{ old('price', (int)$product->price) }}" required min="0" step="1000" class="w-full bg-gray-50 text-gray-500 border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-nibras-magenta focus:border-nibras-magenta sm:text-sm" readonly title="Harga dasar otomatis disinkronisasi dari varian Anda">
                            </div>

                            <div class="space-y-1">
                                <label for="color" class="block text-sm font-medium text-gray-700">Warna</label>
                                <input type="text" name="color" id="color" value="{{ old('color', $product->color) }}" class="w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-nibras-magenta focus:border-nibras-magenta sm:text-sm">
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="space-y-1">
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Produk</label>
                            <textarea name="description" id="description" rows="4" class="w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-nibras-magenta focus:border-nibras-magenta sm:text-sm">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <hr class="border-gray-100">

                        <!-- Product Variants (Sizes & Prices) -->
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-sm font-medium text-gray-900">Variasi Ukuran & Harga <span class="text-red-500">*</span></h4>
                                <button type="button" id="add-variant-btn" class="text-xs bg-pink-50 text-nibras-magenta hover:bg-pink-100 px-3 py-1.5 rounded-md font-medium transition-colors flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    Tambah Ukuran Baru
                                </button>
                            </div>
                            
                            <div class="overflow-x-auto border border-gray-200 rounded-lg">
                                <table class="w-full text-sm text-left">
                                    <thead class="bg-gray-50 border-b border-gray-200">
                                        <tr>
                                            <th class="px-4 py-3 font-medium text-gray-700 w-1/3">Nama Ukuran/Varian (Misal: XS-L)</th>
                                            <th class="px-4 py-3 font-medium text-gray-700 w-1/3">Harga Khusus (Rp)</th>
                                            <th class="px-4 py-3 font-medium text-gray-700 w-1/4">Stok</th>
                                            <th class="px-4 py-3 font-medium text-center text-gray-700 w-16">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="variants-container" class="divide-y divide-gray-100">
                                        @if($product->variants->count() > 0)
                                            @foreach($product->variants as $index => $variant)
                                            <tr class="variant-row">
                                                <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $variant->id }}">
                                                <td class="px-4 py-3">
                                                    <input type="text" name="variants[{{ $index }}][size]" value="{{ old('variants.'.$index.'.size', $variant->size) }}" required placeholder="Contoh: All Size" class="w-full border border-gray-300 rounded-md py-1.5 px-3 focus:outline-none focus:border-nibras-magenta text-sm">
                                                </td>
                                                <td class="px-4 py-3">
                                                    <input type="number" name="variants[{{ $index }}][price]" value="{{ old('variants.'.$index.'.price', (int)$variant->price) }}" required min="0" step="1000" placeholder="Contoh: 150000" class="w-full border border-gray-300 rounded-md py-1.5 px-3 focus:outline-none focus:border-nibras-magenta text-sm variant-price">
                                                </td>
                                                <td class="px-4 py-3">
                                                    <input type="number" name="variants[{{ $index }}][stock]" value="{{ old('variants.'.$index.'.stock', $variant->stock) }}" required min="0" class="w-full border border-gray-300 rounded-md py-1.5 px-3 focus:outline-none focus:border-nibras-magenta text-sm">
                                                </td>
                                                <td class="px-4 py-3 text-center">
                                                    <button type="button" class="remove-variant-btn text-red-500 hover:text-red-700 p-1 rounded transition-colors" title="Hapus">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr class="variant-row">
                                                <td class="px-4 py-3">
                                                    <input type="text" name="variants[0][size]" required placeholder="Contoh: All Size" class="w-full border border-gray-300 rounded-md py-1.5 px-3 focus:outline-none focus:border-nibras-magenta text-sm">
                                                </td>
                                                <td class="px-4 py-3">
                                                    <input type="number" name="variants[0][price]" required min="0" step="1000" placeholder="Contoh: 150000" class="w-full border border-gray-300 rounded-md py-1.5 px-3 focus:outline-none focus:border-nibras-magenta text-sm variant-price">
                                                </td>
                                                <td class="px-4 py-3">
                                                    <input type="number" name="variants[0][stock]" required min="0" value="0" class="w-full border border-gray-300 rounded-md py-1.5 px-3 focus:outline-none focus:border-nibras-magenta text-sm">
                                                </td>
                                                <td class="px-4 py-3 text-center">
                                                    <button type="button" class="remove-variant-btn text-red-500 hover:text-red-700 p-1 rounded transition-colors" title="Hapus">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Tambahkan setidaknya satu ukuran. Jika produk tidak memiliki ukuran berbeda, Anda bisa mengisinya dengan "All Size" atau "Satu Ukuran". Harga Dasar produk di atas otomatis mensinkronisasi harga termurah dari tabel varian ini.</p>
                        </div>

                        <hr class="border-gray-100">

                        <!-- Foto Produk -->
                        <div class="space-y-3 pt-2">
                            <label class="block text-sm font-medium text-gray-700">Foto Produk Baru (Maksimal 4 Foto)</label>
                            @php
                                $existingImages = $product->images;
                            @endphp
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @for($i = 1; $i <= 4; $i++)
                                    @php
                                        $hasExisting = $i <= $existingImages->count();
                                        $existingImage = $hasExisting ? $existingImages[$i-1] : null;
                                    @endphp
                                <div class="relative group aspect-[4/5] sm:aspect-square rounded-xl border-2 border-dashed {{ $hasExisting ? 'border-transparent' : 'border-gray-300' }} bg-gray-50 flex flex-col items-center justify-center overflow-hidden hover:border-nibras-magenta transition-all" id="box-{{ $i }}">
                                    
                                    @if($hasExisting)
                                    <input type="checkbox" name="remove_images[]" value="{{ $existingImage->id }}" id="remove-img-{{ $i }}" class="hidden">
                                    @endif

                                    <input type="file" name="images[]" id="input-{{ $i }}" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10 {{ $hasExisting ? 'hidden' : '' }}" accept="image/jpeg,image/png,image/webp" onchange="previewSlotImage(this, '{{ $i }}')">
                                    
                                    <div class="text-gray-400 flex flex-col items-center pointer-events-none transition-opacity {{ $hasExisting ? 'hidden' : '' }}" id="icon-{{ $i }}">
                                        <svg class="h-8 w-8 mb-2 text-gray-300 group-hover:text-nibras-magenta transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        <span class="text-xs font-semibold text-gray-500 group-hover:text-nibras-magenta transition-colors">Foto {{ $i }}</span>
                                    </div>
                                    
                                    <img id="preview-{{ $i }}" src="{{ $hasExisting ? Storage::url($existingImage->image_path) : '' }}" class="absolute inset-0 w-full h-full object-cover z-0 {{ $hasExisting ? '' : 'hidden' }}">
                                    
                                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-20 {{ $hasExisting ? '' : 'hidden' }} backdrop-blur-sm" id="overlay-{{ $i }}">
                                        <button type="button" id="btn-hapus-{{ $i }}" class="text-white text-sm font-medium flex items-center gap-1.5 hover:text-red-400 bg-white/10 hover:bg-white/20 px-4 py-2 rounded-lg transition-colors border border-white/20 shadow-sm" onclick="{{ $hasExisting ? "removeExisting('$i')" : "clearSlot('$i')" }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                                @endfor
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Format: PNG, JPG (maks. 2MB tiap foto). Foto pertama (1) otomatis jadi foto utama.</p>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                            <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">Batal</a>
                            <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors shadow-sm">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

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

            // 4-Box Image Preview Global Method
            window.previewSlotImage = function(input, slotId) {
                const preview = document.getElementById('preview-' + slotId);
                const icon = document.getElementById('icon-' + slotId);
                const overlay = document.getElementById('overlay-' + slotId);
                const box = document.getElementById('box-' + slotId);

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                        icon.classList.add('hidden');
                        overlay.classList.remove('hidden');
                        input.classList.add('hidden'); // Sembunyikan input supaya tombol Batal bisa di-click
                        box.classList.remove('border-gray-300');
                        box.classList.add('border-transparent');
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    window.clearSlot(slotId);
                }
            };

            window.clearSlot = function(slotId) {
                const input = document.getElementById('input-' + slotId);
                const preview = document.getElementById('preview-' + slotId);
                const icon = document.getElementById('icon-' + slotId);
                const overlay = document.getElementById('overlay-' + slotId);
                const box = document.getElementById('box-' + slotId);

                input.value = '';
                input.classList.remove('hidden'); // Munculkan kembali input zone
                preview.src = '';
                preview.classList.add('hidden');
                icon.classList.remove('hidden');
                overlay.classList.add('hidden');
                box.classList.remove('border-transparent');
                box.classList.add('border-gray-300');
            };

            window.removeExisting = function(slotId) {
                // Centang checkbox hidden supaya gambar eksisting dihapus di server
                const removeCheckbox = document.getElementById('remove-img-' + slotId);
                if (removeCheckbox) removeCheckbox.checked = true;

                // Reset UI kotak menjadi state kosong / siap upload file baru
                window.clearSlot(slotId);

                // Ubah action tombol hapus menjadi clearSlot untuk file yang baru di-upload (kalau user berubah pikiran lagi)
                const btn = document.getElementById('btn-hapus-' + slotId);
                btn.setAttribute('onclick', "clearSlot('" + slotId + "')");
            };

            // Variants Dynamic Table Logic
            const variantsContainer = document.getElementById('variants-container');
            const addVariantBtn = document.getElementById('add-variant-btn');

            if (addVariantBtn) {
                addVariantBtn.addEventListener('click', function() {
                    const idx = Date.now(); // Gunakan timestamp sebagai index unik untuk baris baru
                    const row = document.createElement('tr');
                    row.className = 'variant-row';
                    row.innerHTML = `
                        <td class="px-4 py-3">
                            <input type="text" name="variants[${idx}][size]" required placeholder="Contoh: XL-3XL" class="w-full border border-gray-300 rounded-md py-1.5 px-3 focus:outline-none focus:border-nibras-magenta text-sm">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="variants[${idx}][price]" required min="0" step="1000" placeholder="Contoh: 150000" class="w-full border border-gray-300 rounded-md py-1.5 px-3 focus:outline-none focus:border-nibras-magenta text-sm variant-price">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" name="variants[${idx}][stock]" required min="0" value="0" class="w-full border border-gray-300 rounded-md py-1.5 px-3 focus:outline-none focus:border-nibras-magenta text-sm">
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button type="button" class="remove-variant-btn text-red-500 hover:text-red-700 p-1 rounded transition-colors" title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </td>
                    `;
                    variantsContainer.appendChild(row);
                });

                variantsContainer.addEventListener('click', function(e) {
                    if (e.target.closest('.remove-variant-btn')) {
                        const row = e.target.closest('.variant-row');
                        if (variantsContainer.querySelectorAll('.variant-row').length > 1) {
                            row.remove();
                            // Trigger perhitungan ulang base price setelah baris dihapus
                            const event = new Event('input', { bubbles: true });
                            variantsContainer.dispatchEvent(event);
                        } else {
                            alert('Minimal harus ada 1 ukuran/varian produk!');
                        }
                    }
                });
                
                // Auto sync "Harga Dasar" parameter
                variantsContainer.addEventListener('input', function(e) {
                    if (e.target.classList.contains('variant-price') || e.type === 'input') {
                        const basePriceInput = document.getElementById('price');
                        let minPrice = Infinity;
                        
                        document.querySelectorAll('.variant-price').forEach(input => {
                            if (input.value && !isNaN(input.value)) {
                                const val = parseFloat(input.value);
                                if (val < minPrice) minPrice = val;
                            }
                        });
                        
                        if (minPrice !== Infinity) {
                            basePriceInput.value = minPrice;
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>

@extends('layouts.admin_layout')

@section('title', 'Tambah Produk Baru - Admin Panel')
@section('header_title', 'Tambah Produk Baru')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.products.index') }}" class="text-gray-400 hover:text-nibras-magenta transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h3 class="text-2xl font-bold text-gray-800">Tambah Produk</h3>
                <p class="text-gray-500 text-sm mt-1">Lengkapi informasi produk di bawah ini.</p>
            </div>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-nibras-magenta flex items-center gap-2 text-sm font-medium transition-colors">
            Kembali ke Daftar
        </a>
    </div>

    @if($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Terjadi kesalahan pada input data:</h3>
                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="product-form" class="space-y-6 pb-12">
        @csrf
        
        <!-- Basic Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                <h4 class="font-semibold text-gray-800">Informasi Dasar</h4>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" required value="{{ old('name') }}" placeholder="Contoh: Sarimbit Nibras 2024" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-nibras-magenta focus:ring-1 focus:ring-nibras-magenta outline-none transition-all">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="category_id" id="category_id" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-nibras-magenta focus:ring-1 focus:ring-nibras-magenta outline-none transition-all bg-white">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="brand_id" class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                        <select name="brand_id" id="brand_id" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-nibras-magenta focus:ring-1 focus:ring-nibras-magenta outline-none transition-all bg-white">
                            <option value="">Pilih Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga Dasar Tampilan (Rp)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-medium">Rp</span>
                            <input type="text" name="price" id="price" value="{{ old('price') }}" readonly class="w-full pl-12 pr-4 py-2 rounded-lg border border-gray-200 bg-gray-50 text-gray-500 cursor-not-allowed outline-none currency-input" title="Harga dasar otomatis disinkronisasi dari varian Anda">
                        </div>
                    </div>
                    <div>
                        <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Warna</label>
                        <input type="text" name="color" id="color" value="{{ old('color') }}" placeholder="Contoh: Maroon" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-nibras-magenta focus:ring-1 focus:ring-nibras-magenta outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Produk</label>
                    <textarea name="description" id="description" rows="4" placeholder="Detail bahan, fitur, dll." class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-nibras-magenta focus:ring-1 focus:ring-nibras-magenta outline-none transition-all">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Product Variants -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                <h4 class="font-semibold text-gray-800">Variasi Ukuran & Stok</h4>
                <button type="button" id="add-variant-btn" class="text-sm text-nibras-magenta hover:text-pink-700 font-semibold flex items-center gap-1 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Ukuran
                </button>
            </div>
            <div class="p-0">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50/50 border-b border-gray-100 hidden md:table-header-group">
                        <tr>
                            <th class="px-6 py-3 font-medium text-gray-700">Ukuran/Varian</th>
                            <th class="px-6 py-3 font-medium text-gray-700">Harga Jual (Rp)</th>
                            <th class="px-6 py-3 font-medium text-gray-700">Harga Diskon (Rp)</th>
                            <th class="px-6 py-3 font-medium text-gray-700">Harga Modal (Rp)</th>
                            <th class="px-6 py-3 font-medium text-gray-700 w-40 text-center">Stok</th>
                            <th class="px-6 py-3 font-medium text-center text-gray-700 w-16">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="variants-container" class="divide-y divide-gray-100 block md:table-row-group">
                        @php $variantData = old('variants') ?? [['size' => '', 'price' => '', 'discount_price' => '', 'purchase_price' => '', 'stock' => 0]]; @endphp
                        
                        @foreach($variantData as $index => $variant)
                        <tr class="variant-row group hover:bg-gray-50/50 transition-colors block md:table-row border-b md:border-b-0 border-gray-100 p-4 md:p-0">
                            <!-- Mobile-only header with actions -->
                            <td class="md:hidden flex justify-between items-center mb-4">
                                <span class="font-bold text-gray-800">Varian #{{ $index + 1 }}</span>
                                <button type="button" class="remove-variant-btn text-red-500 p-2 bg-red-50 rounded-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </td>

                            <td class="px-0 md:px-6 py-2 md:py-3 block md:table-cell">
                                <label class="block md:hidden text-xs font-semibold text-gray-500 mb-1">Ukuran / Varian</label>
                                <input type="text" name="variants[{{ $index }}][size]" value="{{ $variant['size'] }}" required placeholder="Contoh: XL" class="w-full px-3 py-1.5 rounded-md border border-gray-200 focus:border-nibras-magenta outline-none text-sm">
                            </td>
                            <td class="px-0 md:px-6 py-2 md:py-3 block md:table-cell">
                                <label class="block md:hidden text-xs font-semibold text-gray-500 mb-1">Harga Jual (Rp)</label>
                                <input type="text" name="variants[{{ $index }}][price]" value="{{ $variant['price'] }}" required placeholder="0" class="w-full px-3 py-1.5 rounded-md border border-gray-200 focus:border-nibras-magenta outline-none text-sm variant-price-input currency-input">
                            </td>
                            <td class="px-0 md:px-6 py-2 md:py-3 block md:table-cell">
                                <label class="block md:hidden text-xs font-semibold text-gray-500 mb-1">Harga Diskon (Rp)</label>
                                <input type="text" name="variants[{{ $index }}][discount_price]" value="{{ $variant['discount_price'] ?? '' }}" placeholder="Opsional" class="w-full px-3 py-1.5 rounded-md border border-gray-200 focus:border-nibras-magenta outline-none text-sm variant-discount-input currency-input">
                            </td>
                            <td class="px-0 md:px-6 py-2 md:py-3 block md:table-cell">
                                <label class="block md:hidden text-xs font-semibold text-gray-500 mb-1">Harga Modal (Rp)</label>
                                <input type="text" name="variants[{{ $index }}][purchase_price]" value="{{ $variant['purchase_price'] }}" required placeholder="0" class="w-full px-3 py-1.5 rounded-md border border-gray-200 focus:border-nibras-magenta outline-none text-sm currency-input">
                            </td>
                            <td class="px-0 md:px-6 py-2 md:py-3 block md:table-cell">
                                <label class="block md:hidden text-xs font-semibold text-gray-500 mb-1">Stok</label>
                                <input type="number" name="variants[{{ $index }}][stock]" value="{{ $variant['stock'] }}" required min="0" class="w-full md:w-32 px-4 py-2 rounded-md border-2 border-gray-200 focus:border-nibras-magenta outline-none text-base font-bold text-center mx-auto">
                            </td>
                            <td class="px-6 py-3 text-center hidden md:table-cell">
                                <button type="button" class="remove-variant-btn text-gray-400 hover:text-red-500 transition-colors p-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 bg-gray-50/30">
                <p class="text-[11px] text-gray-400 leading-relaxed">
                    * Tambahkan setidaknya satu ukuran. Jika produk tidak memiliki ukuran berbeda, isi dengan "All Size". <br>
                    * Harga Dasar produk di atas otomatis mensinkronisasi harga termurah dari tabel varian.
                </p>
            </div>
        </div>

        <!-- Product Images -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                <h4 class="font-semibold text-gray-800">Foto Produk</h4>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    @for($i = 1; $i <= 4; $i++)
                        <div class="relative group aspect-[3/4] rounded-xl border-2 border-dashed border-gray-200 bg-gray-50 flex flex-col items-center justify-center overflow-hidden hover:border-nibras-magenta transition-all" id="box-{{ $i }}">
                            <input type="file" name="images[]" id="input-{{ $i }}" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*" onchange="previewSlotImage(this, '{{ $i }}')">
                            
                            <div class="text-gray-400 flex flex-col items-center pointer-events-none transition-opacity" id="icon-{{ $i }}">
                                <svg class="h-8 w-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                <span class="text-[10px] font-bold uppercase tracking-wider">Upload Foto {{ $i }}</span>
                            </div>
                            
                            <img id="preview-{{ $i }}" src="" class="absolute inset-0 w-full h-full object-cover z-0 hidden">
                            
                            <div class="absolute inset-0 bg-black/60 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-20 hidden backdrop-blur-[2px]" id="overlay-{{ $i }}">
                                <button type="button" class="text-white text-xs font-bold flex items-center gap-1.5 bg-red-500 hover:bg-red-600 px-4 py-2 rounded-full transition-all transform hover:scale-105" onclick="clearSlot('{{ $i }}')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    Hapus
                                </button>
                            </div>
                        </div>
                    @endfor
                </div>
                <p class="text-[11px] text-gray-400 mt-4">* Foto pertama (1) otomatis jadi foto utama. Format: JPG, PNG, WEBP (Maks 2MB).</p>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-2.5 rounded-lg text-sm font-semibold text-gray-500 hover:bg-gray-100 transition-colors">
                Batal
            </a>
            <button type="submit" class="bg-nibras-magenta text-white px-8 py-2.5 rounded-lg text-sm font-bold hover:bg-pink-700 transition-all shadow-lg shadow-pink-100 transform active:scale-95">
                Simpan Produk
            </button>
        </div>
        
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variants Management
        const variantsContainer = document.getElementById('variants-container');
        const addVariantBtn = document.getElementById('add-variant-btn');

        if (addVariantBtn) {
            addVariantBtn.addEventListener('click', function() {
                const idx = Date.now();
                const row = document.createElement('tr');
                row.className = 'variant-row group hover:bg-gray-50/50 transition-colors block md:table-row border-b md:border-b-0 border-gray-100 p-4 md:p-0';
                row.innerHTML = `
                    <td class="md:hidden flex justify-between items-center mb-4">
                        <span class="font-bold text-gray-800">Varian Baru</span>
                        <button type="button" class="remove-variant-btn text-red-500 p-2 bg-red-50 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </td>
                    <td class="px-0 md:px-6 py-2 md:py-3 block md:table-cell">
                        <label class="block md:hidden text-xs font-semibold text-gray-500 mb-1">Ukuran / Varian</label>
                        <input type="text" name="variants[${idx}][size]" required placeholder="Contoh: XXL" class="w-full px-3 py-1.5 rounded-md border border-gray-200 focus:border-nibras-magenta outline-none text-sm">
                    </td>
                    <td class="px-0 md:px-6 py-2 md:py-3 block md:table-cell">
                        <label class="block md:hidden text-xs font-semibold text-gray-500 mb-1">Harga Jual (Rp)</label>
                        <input type="text" name="variants[${idx}][price]" required placeholder="0" class="w-full px-3 py-1.5 rounded-md border border-gray-200 focus:border-nibras-magenta outline-none text-sm variant-price-input currency-input">
                    </td>
                    <td class="px-0 md:px-6 py-2 md:py-3 block md:table-cell">
                        <label class="block md:hidden text-xs font-semibold text-gray-500 mb-1">Harga Diskon (Rp)</label>
                        <input type="text" name="variants[${idx}][discount_price]" placeholder="Opsional" class="w-full px-3 py-1.5 rounded-md border border-gray-200 focus:border-nibras-magenta outline-none text-sm variant-discount-input currency-input">
                    </td>
                    <td class="px-0 md:px-6 py-2 md:py-3 block md:table-cell">
                        <label class="block md:hidden text-xs font-semibold text-gray-500 mb-1">Harga Modal (Rp)</label>
                        <input type="text" name="variants[${idx}][purchase_price]" required placeholder="0" class="w-full px-3 py-1.5 rounded-md border border-gray-200 focus:border-nibras-magenta outline-none text-sm currency-input">
                    </td>
                    <td class="px-0 md:px-6 py-2 md:py-3 block md:table-cell">
                        <label class="block md:hidden text-xs font-semibold text-gray-500 mb-1">Stok</label>
                        <input type="number" name="variants[${idx}][stock]" required min="0" value="0" class="w-full md:w-32 px-4 py-2 rounded-md border-2 border-gray-200 focus:border-nibras-magenta outline-none text-base font-bold text-center mx-auto">
                    </td>
                    <td class="px-6 py-3 text-center hidden md:table-cell">
                        <button type="button" class="remove-variant-btn text-gray-400 hover:text-red-500 transition-colors p-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </td>
                `;
                variantsContainer.appendChild(row);
            });

            variantsContainer.addEventListener('click', function(e) {
                if (e.target.closest('.remove-variant-btn')) {
                    const rows = variantsContainer.querySelectorAll('.variant-row');
                    if (rows.length > 1) {
                        e.target.closest('.variant-row').remove();
                        syncBasePrice();
                    } else {
                        alert('Minimal harus ada 1 varian produk!');
                    }
                }
            });

            variantsContainer.addEventListener('input', function(e) {
                if (e.target.classList.contains('currency-input')) {
                    formatCurrency(e.target);
                }
                if (e.target.classList.contains('variant-price-input') || e.target.classList.contains('variant-discount-input')) {
                    syncBasePrice();
                }
            });

            // Format existing inputs on load
            document.querySelectorAll('.currency-input').forEach(input => {
                formatCurrency(input);
            });

            // Strip formatting before submit
            const productForm = document.getElementById('product-form');
            if (productForm) {
                productForm.addEventListener('submit', function(e) {
                    this.querySelectorAll('.currency-input').forEach(input => {
                        input.value = input.value.replace(/\./g, '');
                    });
                });
            }
        }

        function formatCurrency(input) {
            let value = input.value.replace(/\D/g, '');
            if (value !== "") {
                input.value = new Intl.NumberFormat('id-ID').format(value);
            } else {
                input.value = "";
            }
        }

        function syncBasePrice() {
            const basePriceInput = document.getElementById('price');
            let minPrice = Infinity;
            
            document.querySelectorAll('.variant-row').forEach(row => {
                const priceInput = row.querySelector('.variant-price-input');
                const discountInput = row.querySelector('.variant-discount-input');
                
                if (priceInput && (priceInput.value || discountInput.value)) {
                    const priceVal = priceInput.value.replace(/\./g, '');
                    const discountVal = discountInput ? discountInput.value.replace(/\./g, '') : '';
                    
                    const price = parseFloat(priceVal);
                    const discount = parseFloat(discountVal);
                    
                    let effective = price;
                    if (!isNaN(discount) && discount > 0) {
                        effective = discount;
                    }
                    
                    if (!isNaN(effective) && effective < minPrice) {
                        minPrice = effective;
                    }
                }
            });

            if (minPrice !== Infinity) {
                basePriceInput.value = new Intl.NumberFormat('id-ID').format(minPrice);
            } else {
                basePriceInput.value = "";
            }
        }

        // Image Management
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
                    input.classList.add('hidden');
                    box.classList.remove('border-gray-200');
                    box.classList.add('border-transparent');
                }
                reader.readAsDataURL(input.files[0]);
            }
        };

        window.clearSlot = function(slotId) {
            const input = document.getElementById('input-' + slotId);
            const preview = document.getElementById('preview-' + slotId);
            const icon = document.getElementById('icon-' + slotId);
            const overlay = document.getElementById('overlay-' + slotId);
            const box = document.getElementById('box-' + slotId);

            input.value = '';
            input.classList.remove('hidden');
            preview.src = '';
            preview.classList.add('hidden');
            icon.classList.remove('hidden');
            overlay.classList.add('hidden');
            box.classList.remove('border-transparent');
            box.classList.add('border-gray-200');
        };
    });
</script>
@endpush

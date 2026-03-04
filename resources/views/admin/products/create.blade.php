<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Produk Baru - Admin Panel</title>

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
                    <h2 class="text-lg md:text-xl font-semibold text-gray-800">Tambah Baru</h2>
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
                        <h3 class="font-semibold text-gray-800">Formulir Tambah Produk</h3>
                    </div>
                    
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                        @csrf
                        
                        <!-- Basic Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-nibras-magenta focus:border-nibras-magenta sm:text-sm">
                            </div>
                            
                            <div class="space-y-1">
                                <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                                <input type="text" name="category" id="category" value="{{ old('category') }}" class="w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-nibras-magenta focus:border-nibras-magenta sm:text-sm">
                            </div>

                            <div class="space-y-1">
                                <label for="price" class="block text-sm font-medium text-gray-700">Harga (Rp) <span class="text-red-500">*</span></label>
                                <input type="number" name="price" id="price" value="{{ old('price') }}" required min="0" step="1000" class="w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-nibras-magenta focus:border-nibras-magenta sm:text-sm">
                            </div>

                            <div class="space-y-1">
                                <label for="color" class="block text-sm font-medium text-gray-700">Warna</label>
                                <input type="text" name="color" id="color" value="{{ old('color') }}" class="w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-nibras-magenta focus:border-nibras-magenta sm:text-sm">
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="space-y-1">
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Produk</label>
                            <textarea name="description" id="description" rows="4" class="w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-nibras-magenta focus:border-nibras-magenta sm:text-sm">{{ old('description') }}</textarea>
                        </div>

                        <hr class="border-gray-100">

                        <!-- Stock by Size -->
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 mb-4">Jumlah Stok per Ukuran</h4>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
                                @foreach(['xs', 's', 'm', 'l', 'xl', 'xxl'] as $size)
                                <div class="space-y-1">
                                    <label for="size_{{ $size }}" class="block text-xs font-medium text-gray-500 uppercase">{{ $size }}</label>
                                    <input type="number" name="size_{{ $size }}" id="size_{{ $size }}" value="{{ old('size_'.$size, 0) }}" min="0" class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-nibras-magenta focus:border-nibras-magenta sm:text-sm text-center">
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <hr class="border-gray-100">

                        <!-- Images Upload -->
                        <div class="space-y-3 pt-2">
                            <label class="block text-sm font-medium text-gray-700">Foto Produk Baru (Maksimal 4 Foto)</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @for($i = 1; $i <= 4; $i++)
                                <div class="relative group aspect-[4/5] sm:aspect-square rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 flex flex-col items-center justify-center overflow-hidden hover:border-nibras-magenta transition-all">
                                    <input type="file" name="images[]" id="input-{{ $i }}" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/jpeg,image/png,image/webp" onchange="previewSlotImage(this, '{{ $i }}')">
                                    
                                    <div class="text-gray-400 flex flex-col items-center pointer-events-none transition-opacity" id="icon-{{ $i }}">
                                        <svg class="h-8 w-8 mb-2 text-gray-300 group-hover:text-nibras-magenta transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        <span class="text-xs font-semibold text-gray-500 group-hover:text-nibras-magenta transition-colors">Foto {{ $i }}</span>
                                    </div>
                                    
                                    <img id="preview-{{ $i }}" class="absolute inset-0 w-full h-full object-cover hidden z-0">
                                    
                                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-20 hidden backdrop-blur-sm" id="overlay-{{ $i }}">
                                        <button type="button" class="text-white text-sm font-medium flex items-center gap-1.5 hover:text-red-400 bg-white/10 hover:bg-white/20 px-4 py-2 rounded-lg transition-colors border border-white/20 shadow-sm" onclick="clearSlot('{{ $i }}')">
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
                            <button type="submit" class="px-5 py-2.5 bg-nibras-magenta text-white rounded-lg text-sm font-medium hover:bg-pink-700 transition-colors shadow-sm">Simpan Produk</button>
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

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                        icon.classList.add('hidden');
                        overlay.classList.remove('hidden');
                        input.classList.add('hidden'); // Sembunyikan input supaya tombol Hapus bisa di-click
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

                input.value = '';
                input.classList.remove('hidden'); // Munculkan kembali input zone
                preview.src = '';
                preview.classList.add('hidden');
                icon.classList.remove('hidden');
                overlay.classList.add('hidden');
            };
        });
    </script>
</body>
</html>

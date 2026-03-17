@extends('layouts.admin_layout')

@section('title', 'Kelola Kategori & Brand - Admin Panel')
@section('header_title', 'Kelola Kategori & Brand')

@section('content')
<div class="max-w-6xl mx-auto">

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm flex items-center gap-3" role="alert">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="block sm:inline font-medium text-sm">{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm flex items-center gap-3" role="alert">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            <span class="block sm:inline font-medium text-sm">{{ session('error') }}</span>
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm" role="alert">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- KATEGORI KONTEN -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col h-[600px]">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center sm:flex-row flex-col sm:gap-0 gap-3">
                <h3 class="font-semibold text-gray-800 text-lg flex items-center gap-2">
                    <svg class="w-5 h-5 text-nibras-magenta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    Kategori
                </h3>
                <button onclick="openModal('categoryModal', 'tambah')" class="bg-nibras-magenta hover:bg-pink-700 text-white px-3 py-1.5 rounded-lg text-sm font-medium transition-colors shadow-sm flex items-center gap-1.5 whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Kategori
                </button>
            </div>
            
            <div class="flex-1 overflow-y-auto p-0">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50 sticky top-0 z-10 border-b border-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">Nama Kategori</th>
                            <th scope="col" class="px-6 py-3 font-medium text-center">Produk</th>
                            <th scope="col" class="px-6 py-3 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($categories as $category)
                        <tr class="hover:bg-pink-50/30 transition-colors">
                            <td class="px-6 py-4 text-gray-800 font-medium">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-center text-gray-500">
                                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-md text-xs font-semibold">{{ $category->products_count }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <button onclick="openModal('categoryModal', 'edit', {{ $category->id }}, '{{ $category->name }}')" class="text-blue-600 hover:text-blue-800 hover:bg-blue-50 p-1.5 rounded-md transition-colors mr-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 hover:bg-red-50 p-1.5 rounded-md transition-colors" {{ $category->products_count > 0 ? 'disabled' : '' }} title="{{ $category->products_count > 0 ? 'Tidak bisa dihapus (sedang digunakan)' : 'Hapus' }}">
                                        <svg class="w-4 h-4 {{ $category->products_count > 0 ? 'opacity-50' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                Belum ada kategori yang ditambahkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- BRAND KONTEN -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col h-[600px]">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center sm:flex-row flex-col sm:gap-0 gap-3">
                <h3 class="font-semibold text-gray-800 text-lg flex items-center gap-2">
                    <svg class="w-5 h-5 text-nibras-magenta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    Brand
                </h3>
                <button onclick="openModal('brandModal', 'tambah')" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg text-sm font-medium transition-colors shadow-sm flex items-center gap-1.5 whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Brand
                </button>
            </div>
            
            <div class="flex-1 overflow-y-auto p-0">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50 sticky top-0 z-10 border-b border-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">Nama Brand</th>
                            <th scope="col" class="px-6 py-3 font-medium text-center">Produk</th>
                            <th scope="col" class="px-6 py-3 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($brands as $brand)
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="px-6 py-4 text-gray-800 font-medium">{{ $brand->name }}</td>
                            <td class="px-6 py-4 text-center text-gray-500">
                                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-md text-xs font-semibold">{{ $brand->products_count }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <button onclick="openModal('brandModal', 'edit', {{ $brand->id }}, '{{ $brand->name }}')" class="text-blue-600 hover:text-blue-800 hover:bg-blue-50 p-1.5 rounded-md transition-colors mr-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus brand ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 hover:bg-red-50 p-1.5 rounded-md transition-colors" {{ $brand->products_count > 0 ? 'disabled' : '' }} title="{{ $brand->products_count > 0 ? 'Tidak bisa dihapus (sedang digunakan)' : 'Hapus' }}">
                                        <svg class="w-4 h-4 {{ $brand->products_count > 0 ? 'opacity-50' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                Belum ada brand yang ditambahkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Kategori -->
<div id="categoryModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity backdrop-blur-sm"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900" id="categoryModalTitle">Tambah Kategori</h3>
                    <button type="button" onclick="closeModal('categoryModal')" class="text-gray-400 hover:text-gray-500 p-1 rounded-md hover:bg-gray-200 transition-colors">
                        <span class="sr-only">Close</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" /></svg>
                    </button>
                </div>
                <form id="categoryForm" action="{{ route('admin.categories.store') }}" method="POST" class="p-6">
                    @csrf
                    <div id="categoryFormMethod"></div>
                    <div class="space-y-4">
                        <div>
                            <label for="category_name" class="block text-sm font-medium leading-6 text-gray-900">Nama Kategori <span class="text-red-500">*</span></label>
                            <div class="mt-2">
                                <input type="text" name="name" id="category_name" required class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-nibras-magenta sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 sm:mt-8 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="inline-flex w-full justify-center rounded-lg bg-nibras-magenta px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-pink-700 sm:ml-3 sm:w-auto transition-colors focus:ring-2 focus:ring-nibras-magenta focus:ring-offset-2">Simpan</button>
                        <button type="button" onclick="closeModal('categoryModal')" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Brand -->
<div id="brandModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity backdrop-blur-sm"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900" id="brandModalTitle">Tambah Brand</h3>
                    <button type="button" onclick="closeModal('brandModal')" class="text-gray-400 hover:text-gray-500 p-1 rounded-md hover:bg-gray-200 transition-colors">
                        <span class="sr-only">Close</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" /></svg>
                    </button>
                </div>
                <form id="brandForm" action="{{ route('admin.brands.store') }}" method="POST" class="p-6">
                    @csrf
                    <div id="brandFormMethod"></div>
                    <div class="space-y-4">
                        <div>
                            <label for="brand_name" class="block text-sm font-medium leading-6 text-gray-900">Nama Brand <span class="text-red-500">*</span></label>
                            <div class="mt-2">
                                <input type="text" name="name" id="brand_name" required class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 sm:mt-8 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="inline-flex w-full justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 sm:ml-3 sm:w-auto transition-colors focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">Simpan</button>
                        <button type="button" onclick="closeModal('brandModal')" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Modal Logic
    function openModal(modalId, action, id = null, name = '') {
        const modal = document.getElementById(modalId);
        const title = document.getElementById(modalId + 'Title');
        const form = document.getElementById(modalId.replace('Modal', 'Form'));
        const methodDiv = document.getElementById(modalId.replace('Modal', 'FormMethod'));
        const nameInput = document.getElementById(modalId.replace('Modal', '_name'));
        
        const isCategory = modalId === 'categoryModal';
        const baseTypeTitle = isCategory ? 'Kategori' : 'Brand';
        const routePrefix = isCategory ? '/admin/categories' : '/admin/brands';

        if (action === 'tambah') {
            title.textContent = `Tambah ${baseTypeTitle}`;
            form.action = routePrefix;
            methodDiv.innerHTML = '';
            nameInput.value = '';
        } else if (action === 'edit') {
            title.textContent = `Edit ${baseTypeTitle}`;
            form.action = `${routePrefix}/${id}`;
            methodDiv.innerHTML = '<input type="hidden" name="_method" value="PUT">';
            nameInput.value = name;
        }

        modal.classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
@endpush

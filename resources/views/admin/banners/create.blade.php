@extends('layouts.admin_layout')

@section('title', 'Tambah Banner')
@section('header_title', 'Tambah Banner')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h3 class="text-xl font-bold text-gray-800">Tambah Banner Baru</h3>
        <p class="text-gray-500 text-sm mt-1">Unggah gambar baru untuk promo banner Anda.</p>
    </div>
    <a href="{{ route('admin.banners.index') }}" class="text-gray-600 hover:text-nibras-magenta text-sm font-medium transition-colors flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-3xl">
    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
        @csrf
        
        <div class="space-y-6">
            <!-- Judul Banner -->
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Judul Banner (Opsional)</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Contoh: Promo Ramadhan" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-pink-100 focus:border-nibras-magenta transition-colors outline-none @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gambar Banner -->
            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-1">Gambar Banner <span class="text-red-500">*</span></label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors relative cursor-pointer" onclick="document.getElementById('image').click()">
                    <div class="space-y-1 text-center" id="upload-placeholder">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600 justify-center">
                            <span class="relative cursor-pointer bg-transparent rounded-md font-medium text-nibras-magenta hover:text-pink-700 focus-within:outline-none">
                                <span>Pilih gambar</span>
                            </span>
                            <p class="pl-1">atau drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, JPEG maksimal 2MB</p>
                    </div>
                    <img id="image-preview" src="#" alt="Preview" class="hidden absolute inset-0 w-full h-full object-cover rounded-lg">
                </div>
                <input id="image" name="image" type="file" class="hidden" accept="image/*" onchange="previewImage(this)">
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-6">
                <!-- Urutan -->
                <div class="w-1/2">
                    <label for="order" class="block text-sm font-semibold text-gray-700 mb-1">Urutan</label>
                    <input type="number" name="order" id="order" value="{{ old('order', 0) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-pink-100 focus:border-nibras-magenta transition-colors outline-none @error('order') border-red-500 @enderror">
                    <p class="text-xs text-gray-500 mt-1">Angka lebih kecil akan tampil lebih dulu.</p>
                </div>

                <!-- Status -->
                <div class="w-1/2 flex flex-col justify-center">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status Aktif</label>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-nibras-magenta"></div>
                        <span class="ml-3 text-sm font-medium text-gray-700">Tampilkan Banner</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-5 border-t border-gray-100 flex justify-end">
            <button type="submit" class="bg-nibras-magenta hover:bg-pink-700 text-white px-6 py-2.5 rounded-lg text-sm font-medium transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                Simpan Banner
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('image-preview').classList.remove('hidden');
                document.getElementById('upload-placeholder').style.opacity = '0';
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
</script>
@endpush
@endsection

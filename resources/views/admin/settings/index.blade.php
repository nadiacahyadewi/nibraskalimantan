@extends('layouts.admin_layout')

@section('title', 'Pengaturan Web - Admin Panel')
@section('header_title', 'Pengaturan Web')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Pengaturan Web</h2>
            <p class="text-sm text-gray-500 mt-1">Atur nomor WhatsApp admin dan alamat toko.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 relative shadow-sm flex items-start gap-3">
        <svg class="w-5 h-5 text-green-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 md:p-8">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="wa_admin_1" class="block text-sm font-medium text-gray-700 mb-2">Nomor WhatsApp Admin 1 (Penerima Checkout Utama)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <input type="text" name="wa_admin_1" id="wa_admin_1" value="{{ old('wa_admin_1', $admin1) }}" required
                                class="pl-10 w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-nibras-magenta focus:border-nibras-magenta transition-colors"
                                placeholder="Contoh: 6289523195549">
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Nomor ini akan digunakan sebagai nomor tujuan saat pembeli menekan tombol 'Pesan via WhatsApp' di halaman Checkout.</p>
                        @error('wa_admin_1')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="wa_admin_2" class="block text-sm font-medium text-gray-700 mb-2">Nomor WhatsApp Admin 2</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <input type="text" name="wa_admin_2" id="wa_admin_2" value="{{ old('wa_admin_2', $admin2) }}" required
                                class="pl-10 w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-nibras-magenta focus:border-nibras-magenta transition-colors"
                                placeholder="Contoh: 6282148882473">
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Nomor ini akan digunakan sebagai nomor opsional 'Tanya Admin 2' di halaman Produk.</p>
                        @error('wa_admin_2')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat Toko</label>
                    <textarea name="alamat" id="alamat" rows="2" required
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-nibras-magenta focus:border-nibras-magenta transition-colors"
                        placeholder="Masukkan alamat lengkap toko...">{{ old('alamat', $alamat ?? '') }}</textarea>
                    <p class="mt-2 text-xs text-gray-500">Alamat lengkap toko Anda.</p>
                    @error('alamat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="tentang_kami" class="block text-sm font-medium text-gray-700 mb-2">Teks Tentang Kami (Deskripsi Toko)</label>
                    <textarea name="tentang_kami" id="tentang_kami" rows="4" required
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-nibras-magenta focus:border-nibras-magenta transition-colors"
                        placeholder="Deskripsi singkat tentang Nibras Kalimantan...">{{ old('tentang_kami', $tentang_kami ?? '') }}</textarea>
                    <p class="mt-2 text-xs text-gray-500">Teks ini akan ditampilkan di bagian 'Tentang Kami' dan juga di bagian bawah halaman web (Footer).</p>
                    @error('tentang_kami')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="google_maps_url" class="block text-sm font-medium text-gray-700 mb-2">URL Google Maps (Iframe Src)</label>
                    <input type="text" name="google_maps_url" id="google_maps_url" value="{{ old('google_maps_url', $google_maps_url ?? '') }}" required
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-nibras-magenta focus:border-nibras-magenta transition-colors"
                        placeholder="https://www.google.com/maps/embed?pb=...">
                    <p class="mt-2 text-xs text-gray-500">Masukkan link dari atribut 'src' pada Google Maps Iframe.</p>
                    @error('google_maps_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-nibras-magenta text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-pink-700 transition-colors shadow-sm flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

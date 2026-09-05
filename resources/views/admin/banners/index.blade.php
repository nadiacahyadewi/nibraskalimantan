@extends('layouts.admin_layout')

@section('title', 'Kelola Banner Promo')
@section('header_title', 'Kelola Banner Promo')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h3 class="text-xl font-bold text-gray-800">Daftar Banner</h3>
        <p class="text-gray-500 text-sm mt-1">Kelola gambar banner promo yang tampil di halaman depan.</p>
    </div>
    <a href="{{ route('admin.banners.create') }}" class="bg-nibras-magenta hover:bg-pink-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2 shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        Tambah Banner
    </a>
</div>

@if(session('success'))
<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
    <p>{{ session('success') }}</p>
</div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider border-b border-gray-100">
                    <th class="p-4 font-semibold w-16">No</th>
                    <th class="p-4 font-semibold">Gambar</th>
                    <th class="p-4 font-semibold">Judul</th>
                    <th class="p-4 font-semibold text-center w-24">Urutan</th>
                    <th class="p-4 font-semibold text-center w-28">Status</th>
                    <th class="p-4 font-semibold text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($banners as $index => $banner)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="p-4 text-gray-500 text-sm">{{ $index + 1 }}</td>
                    <td class="p-4">
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" class="h-16 w-32 object-cover rounded shadow-sm border border-gray-100">
                    </td>
                    <td class="p-4 text-sm text-gray-800 font-medium">
                        {{ $banner->title ?: '-' }}
                    </td>
                    <td class="p-4 text-center text-sm text-gray-600">
                        {{ $banner->order }}
                    </td>
                    <td class="p-4 text-center">
                        @if($banner->is_active)
                            <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-full text-xs font-semibold tracking-wide">Aktif</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-full text-xs font-semibold tracking-wide">Tidak Aktif</span>
                        @endif
                    </td>
                    <td class="p-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.banners.edit', $banner->id) }}" class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 p-1.5 rounded transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" class="inline-block swal-form" data-title="Hapus Banner?" data-text="Banner yang dihapus tidak dapat dikembalikan.">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 p-1.5 rounded transition-colors" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-500">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p>Belum ada data banner.</p>
                        <a href="{{ route('admin.banners.create') }}" class="text-nibras-magenta hover:underline text-sm mt-1 inline-block">Tambah banner pertama Anda</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

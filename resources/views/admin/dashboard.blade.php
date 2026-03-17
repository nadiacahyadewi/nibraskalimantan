@extends('layouts.admin_layout')

@section('title', 'Admin Dashboard - Febia Nibras Kalsel')
@section('header_title', 'Dashboard Overview')

@section('content')
<!-- Background decors -->
<div class="absolute -top-40 -right-40 w-96 h-96 bg-pink-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 pointer-events-none"></div>

<div class="max-w-7xl mx-auto space-y-8 relative z-10">
    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-nibras-magenta to-pink-600 rounded-2xl p-8 text-white shadow-lg shadow-pink-200 flex justify-between items-center relative overflow-hidden">
        <div class="absolute right-0 top-0 opacity-10">
            <svg width="200" height="200" viewBox="0 0 24 24" fill="currentColor"><path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"/></svg>
        </div>
        <div class="relative z-10">
            <h3 class="text-2xl md:text-3xl font-bold mb-2">Selamat Datang di Admin Panel</h3>
            <p class="text-pink-100 text-sm md:text-base">Kelola produk, pesanan, dan hak akses pengguna Anda dengan mudah.</p>
        </div>
        <a href="/" target="_blank" class="hidden md:flex relative z-10 bg-white text-nibras-magenta px-6 py-2 rounded-lg font-semibold hover:bg-gray-50 transition-colors shadow items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            Lihat Website
        </a>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="p-3 rounded-full bg-pink-50 text-nibras-magenta">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Produk</p>
                <p class="text-2xl font-bold text-gray-800">124</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="p-3 rounded-full bg-blue-50 text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Pesanan Aktif</p>
                <p class="text-2xl font-bold text-gray-800">12</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="p-3 rounded-full bg-purple-50 text-purple-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Pengguna Terdaftar</p>
                <p class="text-2xl font-bold text-gray-800">1,402</p>
            </div>
        </div>
    </div>

    <!-- Recent Activity Placeholder -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h4 class="font-semibold text-gray-800">Aktivitas Terbaru</h4>
        </div>
        <div class="p-6 flex flex-col items-center justify-center text-gray-400 min-h-[200px]">
            <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            <p>Belum ada aktivitas baru</p>
        </div>
    </div>
</div>
@endsection

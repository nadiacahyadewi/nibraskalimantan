<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang Kami - Nibras Kalimantan</title>

    <!-- Google Fonts -->
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
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F8F8F8;
        }
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); } 
        }
        .animate-scroll {
            animation: scroll 30s linear infinite;
        }
        .animate-scroll:hover {
            animation-play-state: paused;
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="text-gray-800">

    <div class="w-full bg-white min-h-screen relative flex flex-col overflow-x-hidden">
        <!-- Header via Include -->
        @include('layouts.navbar')

        <!-- Main Content -->
        <main class="flex-grow pt-[70px] md:pt-[100px] w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <h1 class="text-3xl font-bold text-center text-gray-900 mb-8 mt-4 md:mt-8">Tentang Kami</h1>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <!-- Kontak & Sosial Media -->
                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100 h-fit">
                    <h2 class="text-2xl font-semibold mb-6 text-nibras-magenta">Informasi Kontak</h2>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-pink-50 rounded-full text-nibras-magenta shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Alamat</h3>
                                <p class="text-gray-600 mt-1">Jl. Karang Anyar 1, Nomor 31, Loktabat Utara, Banjarbaru</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-pink-50 rounded-full text-nibras-magenta shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Telepon</h3>
                                <p class="text-gray-600 mt-1">+62 821-4888-2473 (Telepon 1)</p>
                                <p class="text-gray-600">+62 822-5094-0398 (Telepon 2)</p>
                            </div>
                        </div>
                    </div>

                    <h2 class="text-2xl font-semibold mb-6 text-nibras-magenta">Media Sosial</h2>
                    <div class="space-y-4 mb-8">
                        <!-- Facebook -->
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-pink-50 rounded-full text-nibras-magenta shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Facebook</h3>
                                <p class="text-gray-600">Nibras Banjarbaru</p>
                            </div>
                        </div>

                        <!-- Instagram -->
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-pink-50 rounded-full text-nibras-magenta shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Instagram</h3>
                                <p class="text-gray-600">@nibrashouse_banjarbaru</p>
                            </div>
                        </div>

                        <!-- TikTok -->
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-pink-50 rounded-full text-nibras-magenta shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">TikTok</h3>
                                <p class="text-gray-600">Nibras House Banjarbaru</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-pink-50 to-white border border-pink-100 p-6 rounded-xl">
                        <h3 class="font-semibold text-gray-900 mb-2">Pesan atau Tanya-tanya?</h3>
                        <p class="text-sm text-gray-600 mb-4">Untuk order atau tanya-tanya bisa klik ikon WA dibawah ini:</p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="https://wa.me/6282148882473" target="_blank" class="flex-1 flex items-center justify-center gap-2 bg-green-500 text-white px-4 py-2.5 rounded-lg hover:bg-green-600 transition-colors font-medium">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                Admin 1
                            </a>
                            <a href="https://wa.me/6282250940398" target="_blank" class="flex-1 flex items-center justify-center gap-2 bg-green-500 text-white px-4 py-2.5 rounded-lg hover:bg-green-600 transition-colors font-medium">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                Admin 2
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Maps & Ulasan -->
                <div class="flex flex-col gap-6">
                    <!-- Google Maps Iframe -->
                    <div class="bg-white p-2 rounded-2xl shadow-sm border border-gray-100 overflow-hidden h-[400px]">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.650678307639!2d114.8136408!3d-3.4349013000000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de6813466be6fdf%3A0x88ff5990fc0fa984!2sNIBRAS%20BANJARBARU!5e0!3m2!1sid!2sid!4v1772500565133!5m2!1sid!2sid" 
                            width="100%" 
                            height="100%" 
                            style="border:0; border-radius: 12px;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                    <!-- Review Map Card unified -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col gap-4">
                        <div class="flex items-center justify-between border-b border-gray-50 pb-4">
                            <div>
                                <div class="flex items-center gap-1 mb-1">
                                    <!-- 5 Stars -->
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                </div>
                                <h3 class="font-bold text-gray-900 text-lg">Ulasan Toko Kami</h3>
                                <p class="text-gray-500 text-sm mt-1">Berdasarkan ulasan pelanggan di Google Maps</p>
                            </div>
                            <div class="text-center">
                                <span class="text-3xl font-bold text-gray-900">4.9</span>
                                <span class="text-sm text-gray-500 block">/ 5.0</span>
                            </div>
                        </div>

                        <!-- Scrolling Reviews Inline -->
                        <div class="w-full overflow-hidden relative rounded-xl bg-gray-50 border border-gray-100 py-3 mt-2">
                            <!-- Gradient overlays for smooth edge fading -->
                            <div class="absolute inset-y-0 left-0 w-8 bg-gradient-to-r from-gray-50 to-transparent z-10 pointer-events-none"></div>
                            <div class="absolute inset-y-0 right-0 w-8 bg-gradient-to-l from-gray-50 to-transparent z-10 pointer-events-none"></div>
                            
                            <div class="flex w-max animate-scroll gap-4 px-4">
                                @php
                                    $reviews = [
                                        ['name' => 'Budi S.', 'text' => 'Pelayanan ramah, baju-bajunya lengkap dan bagus kualitasnya.', 'rating' => 5],
                                        ['name' => 'Siti A.', 'text' => 'Toko Nibras terlengkap di Banjarbaru. Selalu puas belanja disini.', 'rating' => 5],
                                        ['name' => 'Rina M.', 'text' => 'Tempatnya nyaman, mbak penjaganya sabar mencarikan ukuran yang pas.', 'rating' => 5],
                                        ['name' => 'Ahmad F.', 'text' => 'Sering ada diskon. Alhamdulillah kebutuhan seragam keluarga terpenuhi.', 'rating' => 4],
                                        ['name' => 'Lina D.', 'text' => 'Banyak pilihan gamis terbaru, warnanya cantik-cantik. Recommended!', 'rating' => 5],
                                    ];
                                    // Duplicate array to create a seamless infinite scroll loop illusion
                                    $scrollReviews = array_merge($reviews, $reviews);
                                @endphp
                                
                                @foreach($scrollReviews as $rev)
                                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 w-64 md:w-72 flex-shrink-0 flex flex-col justify-between">
                                    <div>
                                        <div class="flex text-yellow-400 mb-2">
                                            @for($i=0; $i<$rev['rating']; $i++)
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                            @endfor
                                        </div>
                                        <p class="text-sm text-gray-700 italic mb-3 line-clamp-3">"{{ $rev['text'] }}"</p>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 text-sm text-right">- {{ $rev['name'] }}</h4>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        @include('layouts.footer')
    </div>
    
    <script>
        // Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');

            if (btn && menu) {
                btn.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Febia Nibras Kalsel</title>

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
            background-image: radial-gradient(#E32184 0.5px, transparent 0.5px), radial-gradient(#E32184 0.5px, #F8F8F8 0.5px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            background-attachment: fixed;
            opacity: 0.95;
        }
        .container-glow {
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>
<body class="text-gray-800 min-h-screen flex flex-col">

    <!-- Header / Navbar -->
    <header class="bg-white border-b border-gray-100 px-6 py-4 shadow-sm z-10 w-full relative">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <a href="/" class="flex flex-col sm:flex-row sm:items-baseline gap-1 sm:gap-2">
                <span class="text-nibras-magenta font-brand text-3xl tracking-tight leading-none">Nibra's</span>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1 sm:mt-0">Kalimantan</span>
            </a>
            
            <a href="/" class="text-sm font-medium text-gray-500 hover:text-nibras-magenta transition-colors flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </header>

    <!-- Main Login Content -->
    <main class="flex-grow flex items-center justify-center p-6 relative w-full">
        <!-- Decoration SVG behind card -->
        <div class="absolute inset-0 z-0 flex items-center justify-center overflow-hidden opacity-10 pointer-events-none">
            <svg class="w-full max-w-4xl text-nibras-magenta" viewBox="0 0 24 24" fill="currentColor">
               <!-- Abstract flower/mandala style SVG element -->
               <path d="M12,2C6.48,2 2,6.48 2,12C2,17.52 6.48,22 12,22C17.52,22 22,17.52 22,12C22,6.48 17.52,2 12,2ZM11,19.93C7.05,19.43 4,16.05 4,12C4,7.95 7.05,4.57 11,4.07V19.93ZM13,4.07C16.95,4.57 20,7.95 20,12C20,16.05 16.95,19.43 13,19.93V4.07Z"/>
            </svg>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-xl container-glow w-full max-w-md p-8 relative z-10 border-t-4 border-nibras-magenta">
            
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Selamat Datang Kembali</h1>
                <p class="text-sm text-gray-500">Silakan masuk ke akun Anda</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                
                @if ($errors->any())
                    <div class="p-3 bg-red-50 text-red-600 border border-red-200 rounded text-sm mb-4">
                        <ul class="list-disc pl-4 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email / Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required class="pl-10 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-nibras-magenta focus:border-nibras-magenta sm:text-sm transition-colors" placeholder="Masukkan email Anda">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="pl-10 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-nibras-magenta focus:border-nibras-magenta sm:text-sm transition-colors" placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between mt-2">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-nibras-magenta focus:ring-nibras-magenta border-gray-300 rounded cursor-pointer">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-700 cursor-pointer">
                            Ingat saya
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-nibras-magenta hover:text-pink-700 transition-colors">
                            Lupa password?
                        </a>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-semibold text-white bg-nibras-magenta hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-nibras-magenta transition-all duration-200 transform hover:-translate-y-0.5 shadow-lg shadow-pink-200 uppercase tracking-widest">
                        Masuk
                    </button>
                </div>
            </form>

            <!-- Note about Roles constraint -->
            <div class="mt-6 text-center text-xs text-gray-500 bg-gray-50 p-3 rounded border border-gray-100">
                <p>Login sebagai <strong>Admin</strong> atau <strong>User</strong> menggunakan form ini. Sistem akan mendeteksi hak akses secara otomatis.</p>
            </div>

            <div class="mt-6 border-t border-gray-200 pt-6">
                <p class="text-center text-sm text-gray-600">
                    Belum punya akun? 
                    <a href="/register" class="font-medium text-nibras-magenta hover:text-pink-700 transition-colors">Daftar sekarang</a>
                </p>
            </div>
        </div>
    </main>
</body>
</html>

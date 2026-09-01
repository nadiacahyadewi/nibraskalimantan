<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Febia Nibras Kalsel</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white m-0 p-0 min-h-screen flex text-gray-800">

    <div class="w-full flex flex-col md:flex-row min-h-screen">
        
        <!-- Left Banner: Image (Hidden on small screens) -->
        <div class="hidden md:flex md:w-1/2 relative bg-gray-100 overflow-hidden">
            <!-- Background Image (Menggunakan banner promo sebagai placeholder/background) -->
            <img src="{{ asset('assets/loginbg.png') }}" class="absolute inset-0 w-full h-full object-cover object-center" alt="Login Banner">
            
            <!-- Overlay tipis (opsional) untuk teks jika diperlukan -->
            <div class="absolute inset-0 bg-black/10"></div>
            
            <!-- Branding -->
            <div class="absolute inset-x-0 top-10 z-10 flex justify-center drop-shadow-lg">
                <img src="{{ asset('assets/logo.png') }}" alt="Nibras Logo" class="h-12 w-auto">
            </div>
            
            
        </div>

        <!-- Right Side: Login Form Container -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-20 relative">
            
            <!-- Back Button -->
            <a href="{{ url('/') }}" class="absolute top-6 right-8 text-sm font-medium text-gray-400 hover:text-red-500 transition-colors flex items-center gap-1">
                Kembali ke beranda
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>

            <!-- Form Wrapper -->
            <div class="w-full max-w-md">
                
                <h1 class="text-[28px] font-bold text-gray-900 mb-1 tracking-tight">Selamat Datang!</h1>
                <p class="text-gray-500 mb-8 text-sm">Yuk, Login untuk mulai belanja.</p>

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    @if ($errors->any())
                        <div class="p-3 bg-red-50 text-red-600 border border-red-200 rounded-lg text-sm mb-4">
                            <ul class="list-disc pl-4 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Email Field -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input name="email" type="text" value="{{ old('email') }}" required class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500 text-sm placeholder-gray-400 transition-colors" placeholder="Masukan email">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" required class="w-full pl-11 pr-11 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500 text-sm placeholder-gray-400 transition-colors" placeholder="Masukan password">
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none transition-colors">
                                <!-- Eye Closed -->
                                <svg id="eyeSlashIcon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                </svg>
                                <!-- Eye Open -->
                                <svg id="eyeIcon" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between mt-2 pt-1">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-red-500 focus:ring-red-500 border-gray-300 rounded cursor-pointer">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-500 cursor-pointer">
                                Ingat saya
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-[#de232c] hover:text-red-700 transition-colors">
                                Lupa password?
                            </a>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center py-3.5 px-4 rounded-lg shadow-sm text-sm font-semibold text-gray-500 bg-gray-100 hover:bg-gray-200 focus:outline-none transition-colors">
                            Masuk
                        </button>
                    </div>
                </form>

                

                <!-- Register Link -->
                <div class="mt-8 text-center text-sm text-gray-600">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="font-medium text-[#de232c] hover:text-red-700 transition-colors">Daftar</a>
                </div>
                
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Script untuk Toggle Password Visibility
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
            const eyeIcon = document.querySelector('#eyeIcon');
            const eyeSlashIcon = document.querySelector('#eyeSlashIcon');

            togglePassword.addEventListener('click', function () {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                eyeIcon.classList.toggle('hidden');
                eyeSlashIcon.classList.toggle('hidden');
            });
        });
    </script>
</body>
</html>

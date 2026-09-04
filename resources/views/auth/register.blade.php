<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - Febia Nibras Kalsel</title>
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
            <!-- Background Image -->
            <img src="{{ asset('assets/loginbg.png') }}" class="absolute inset-0 w-full h-full object-cover object-center" alt="Register Banner">
            
            <div class="absolute inset-0 bg-black/10"></div>
            
            <!-- Branding -->
            <div class="absolute inset-x-0 top-10 z-10 flex justify-center drop-shadow-lg">
                <img src="{{ asset('assets/logo.png') }}" alt="Nibras Logo" class="h-12 w-auto">
            </div>
            
            <div class="absolute bottom-10 left-10 right-10 z-10 text-white drop-shadow-md">
                <p class="text-sm font-medium leading-relaxed max-w-lg">
                    Temukan koleksi busana muslimah terbaik dan berkualitas untuk menemani aktivitas harian Anda.
                </p>
            </div>
        </div>

        <!-- Right Side: Register Form Container -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-6 sm:p-12 lg:p-20">
            
            <!-- Form Wrapper -->
            <div class="w-full max-w-md relative">
                
                <!-- Back Button -->
                <div class="flex justify-end mb-6">
                    <a href="{{ url('/') }}" class="text-xs sm:text-sm font-medium text-gray-400 hover:text-red-500 transition-colors flex items-center gap-1">
                        Kembali ke beranda
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
                
                <h1 class="text-[28px] font-bold text-gray-900 mb-1 tracking-tight">Buat Akun Baru</h1>
                <p class="text-gray-500 mb-8 text-sm">Bergabunglah dan lengkapi profil Anda.</p>

                <form action="{{ route('register') }}" method="POST" class="space-y-4">
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

                    <!-- Nama Field -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input name="name" type="text" value="{{ old('name') }}" required minlength="3" maxlength="50" class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500 text-sm placeholder-gray-400 transition-colors" placeholder="Masukkan nama lengkap">
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <input name="email" type="email" value="{{ old('email') }}" required class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500 text-sm placeholder-gray-400 transition-colors" placeholder="Masukkan email">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <!-- Password Field -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input id="password" name="password" type="password" required minlength="8" maxlength="20" class="w-full pl-11 pr-11 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500 text-sm placeholder-gray-400 transition-colors" placeholder="••••••••">
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

                        <!-- Confirm Password Field -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Ulangi</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input id="password_confirmation" name="password_confirmation" type="password" required minlength="8" maxlength="20" class="w-full pl-11 pr-11 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500 text-sm placeholder-gray-400 transition-colors" placeholder="••••••••">
                                <button type="button" id="toggleConfirmPassword" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none transition-colors">
                                    <svg id="eyeConfirmSlashIcon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    </svg>
                                    <svg id="eyeConfirmIcon" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center py-3.5 px-4 rounded-lg shadow-sm text-sm font-semibold text-white bg-[#E32184] hover:bg-pink-700 focus:outline-none transition-colors">
                            Daftar Akun
                        </button>
                    </div>
                </form>

                <!-- Login Link -->
                <div class="mt-8 text-center text-sm text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-medium text-[#de232c] hover:text-red-700 transition-colors">Masuk di sini</a>
                </div>
                
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Script untuk Toggle Password Visibility
            const setupPasswordToggle = (toggleId, inputId, eyeId, slashId) => {
                const toggle = document.querySelector(toggleId);
                const input = document.querySelector(inputId);
                const eye = document.querySelector(eyeId);
                const slash = document.querySelector(slashId);

                if (toggle && input) {
                    toggle.addEventListener('click', function () {
                        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                        input.setAttribute('type', type);
                        eye.classList.toggle('hidden');
                        slash.classList.toggle('hidden');
                    });
                }
            };

            setupPasswordToggle('#togglePassword', '#password', '#eyeIcon', '#eyeSlashIcon');
            setupPasswordToggle('#toggleConfirmPassword', '#password_confirmation', '#eyeConfirmIcon', '#eyeConfirmSlashIcon');
        });
    </script>
</body>
</html>

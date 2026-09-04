<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password - Febia Nibras Kalsel</title>
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
            <img src="{{ asset('assets/loginbg.png') }}" class="absolute inset-0 w-full h-full object-cover object-center" alt="Forgot Password Banner">
            
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

        <!-- Right Side: Form Container -->
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
                
                <h1 class="text-[28px] font-bold text-gray-900 mb-1 tracking-tight">Lupa Password?</h1>
                <p class="text-gray-500 mb-8 text-sm">Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.</p>

                @if (session('status'))
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 border border-green-200 rounded-lg" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
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
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <input name="email" type="email" value="{{ old('email') }}" required class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500 text-sm placeholder-gray-400 transition-colors" placeholder="Masukkan email">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center py-3.5 px-4 rounded-lg shadow-sm text-sm font-semibold text-white bg-[#E32184] hover:bg-pink-700 focus:outline-none transition-colors">
                            Kirim Link Reset Password
                        </button>
                    </div>
                </form>

                <!-- Login Link -->
                <div class="mt-8 text-center text-sm text-gray-600">
                    <a href="{{ route('login') }}" class="font-medium text-[#de232c] hover:text-red-700 transition-colors">Kembali ke halaman Login</a>
                </div>
                
            </div>
        </div>
    </div>

</body>
</html>

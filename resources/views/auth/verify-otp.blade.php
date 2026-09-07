<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi OTP - Febia Nibras Kalsel</title>
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
            <img src="{{ asset('assets/loginbg.png') }}" class="absolute inset-0 w-full h-full object-cover object-center" alt="Verification Banner">
            
            <div class="absolute inset-0 bg-black/10"></div>
            
            <!-- Branding -->
            <div class="absolute inset-x-0 top-10 z-10 flex justify-center drop-shadow-lg">
                <img src="{{ asset('assets/logo.png') }}" alt="Nibras Logo" class="h-12 w-auto">
            </div>
            
            <div class="absolute bottom-10 left-10 right-10 z-10 text-white drop-shadow-md">
                <p class="text-sm font-medium leading-relaxed max-w-lg">
                    Satu langkah lagi untuk menyelesaikan pendaftaran Anda.
                </p>
            </div>
        </div>

        <!-- Right Side: Form Container -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-6 sm:p-12 lg:p-20">
            
            <!-- Form Wrapper -->
            <div class="w-full max-w-md relative">
                
                <!-- Logo & Heading -->
                <div class="flex justify-center md:justify-start mb-6">
                    <img src="{{ asset('assets/logo.png') }}" alt="Nibras Logo" class="h-10 sm:h-12 w-auto drop-shadow-sm">
                </div>
                <h1 class="text-[28px] font-bold text-gray-900 mb-1 tracking-tight text-center md:text-left">Verifikasi Email</h1>
                <p class="text-gray-500 mb-8 text-sm text-center md:text-left">Masukkan 6 digit kode OTP yang telah dikirimkan ke email <strong>{{ $email }}</strong>.</p>

                @if (session('status'))
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 border border-green-200 rounded-lg text-center" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="p-3 bg-red-50 text-red-600 border border-red-200 rounded-lg text-sm mb-4">
                        <ul class="list-disc pl-4 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register.verify.post') }}" method="POST" class="space-y-5" id="otpForm">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    
                    <!-- Hidden real OTP input -->
                    <input type="hidden" name="otp" id="realOtp" required>
                    
                    <!-- OTP Fields -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2 text-center md:text-left">Kode OTP</label>
                        <div class="flex justify-between items-center gap-2 max-w-sm mx-auto md:mx-0">
                            <input type="text" maxlength="1" class="otp-input w-12 h-14 text-center text-2xl font-bold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors" inputmode="numeric" pattern="\d*">
                            <input type="text" maxlength="1" class="otp-input w-12 h-14 text-center text-2xl font-bold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors" inputmode="numeric" pattern="\d*">
                            <input type="text" maxlength="1" class="otp-input w-12 h-14 text-center text-2xl font-bold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors" inputmode="numeric" pattern="\d*">
                            <input type="text" maxlength="1" class="otp-input w-12 h-14 text-center text-2xl font-bold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors" inputmode="numeric" pattern="\d*">
                            <input type="text" maxlength="1" class="otp-input w-12 h-14 text-center text-2xl font-bold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors" inputmode="numeric" pattern="\d*">
                            <input type="text" maxlength="1" class="otp-input w-12 h-14 text-center text-2xl font-bold border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors" inputmode="numeric" pattern="\d*">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" class="w-full flex justify-center py-3.5 px-4 rounded-lg shadow-sm text-sm font-semibold text-white bg-[#E32184] hover:bg-pink-700 focus:outline-none transition-colors">
                            Verifikasi & Daftar
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center text-sm text-gray-600">
                    Belum menerima kode? <br>
                    
                    <form action="{{ route('register.resend') }}" method="POST" class="inline-block mt-2">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <button type="submit" id="resendBtn" class="font-medium text-[#de232c] hover:text-red-700 transition-colors disabled:text-gray-400 disabled:cursor-not-allowed">
                            Kirim ulang kode OTP
                        </button>
                    </form>
                    
                    <div id="countdown" class="text-xs text-gray-500 mt-1 font-mono hidden">
                        Tunggu <span id="timer">60</span> detik
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if we need to start countdown (from localStorage)
            const email = "{{ $email }}";
            const storageKey = 'otp_countdown_' + email;
            const resendBtn = document.getElementById('resendBtn');
            const countdownDiv = document.getElementById('countdown');
            const timerSpan = document.getElementById('timer');
            
            let endTime = localStorage.getItem(storageKey);
            
            // If the user just arrived here or successfully sent OTP, start timer
            @if(session('status') || session('email'))
                endTime = Date.now() + (60 * 1000);
                localStorage.setItem(storageKey, endTime);
            @endif

            function updateTimer() {
                if (!endTime) return;
                
                const now = Date.now();
                const diff = Math.ceil((endTime - now) / 1000);
                
                if (diff > 0) {
                    resendBtn.disabled = true;
                    countdownDiv.classList.remove('hidden');
                    timerSpan.innerText = diff;
                    requestAnimationFrame(updateTimer);
                } else {
                    resendBtn.disabled = false;
                    countdownDiv.classList.add('hidden');
                    localStorage.removeItem(storageKey);
                }
            }
            
            updateTimer();

            // OTP Input Logic
            const otpInputs = document.querySelectorAll('.otp-input');
            const realOtpInput = document.getElementById('realOtp');
            const otpForm = document.getElementById('otpForm');

            otpInputs.forEach((input, index) => {
                // Focus first input automatically if empty
                if (index === 0) setTimeout(() => input.focus(), 100);

                // Handle input
                input.addEventListener('input', (e) => {
                    // Only allow numbers
                    e.target.value = e.target.value.replace(/[^0-9]/g, '');
                    
                    if (e.target.value !== '') {
                        if (index < otpInputs.length - 1) {
                            otpInputs[index + 1].focus();
                        }
                    }
                });

                // Handle backspace
                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && e.target.value === '') {
                        if (index > 0) {
                            otpInputs[index - 1].focus();
                        }
                    }
                });

                // Handle paste
                input.addEventListener('paste', (e) => {
                    e.preventDefault();
                    const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '').slice(0, 6);
                    if (pastedData) {
                        for (let i = 0; i < pastedData.length; i++) {
                            if (otpInputs[i]) {
                                otpInputs[i].value = pastedData[i];
                                if (i < otpInputs.length - 1) {
                                    otpInputs[i + 1].focus();
                                } else {
                                    otpInputs[i].focus();
                                }
                            }
                        }
                    }
                });
            });

            // Update hidden input on submit
            otpForm.addEventListener('submit', (e) => {
                let otpValue = '';
                otpInputs.forEach(input => {
                    otpValue += input.value;
                });
                
                if (otpValue.length === 6) {
                    realOtpInput.value = otpValue;
                } else {
                    e.preventDefault();
                    alert('Silakan masukkan 6 digit kode OTP secara lengkap.');
                }
            });
        });
    </script>
</body>
</html>

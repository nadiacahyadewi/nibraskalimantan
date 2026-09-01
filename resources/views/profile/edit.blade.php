<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - Nibras Kalimantan</title>
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
                        'nibras-magenta': '#de232c',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        pacifico: ['Pacifico', 'cursive']
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    @include('layouts.navbar')

    <main class="flex-grow pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-8 border-b border-gray-100 bg-white">
                    <h1 class="text-2xl font-bold text-gray-900">Edit Profil Anda</h1>
                    <p class="mt-1 text-sm text-gray-500">Perbarui informasi profil Anda termasuk nomor telepon dan alamat pengiriman.</p>
                </div>

                <div class="px-6 py-8">
                    @if(session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Lengkap -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500 transition-colors @error('name') border-red-500 @enderror" required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500 transition-colors @error('email') border-red-500 @enderror" required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Nomor Telepon -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Handphone / WhatsApp</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 081234567890" class="w-full md:w-1/2 px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500 transition-colors @error('phone') border-red-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500">Akan digunakan untuk konfirmasi pesanan dan pengiriman.</p>
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Alamat Lengkap -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap Pengiriman</label>
                            <textarea name="address" id="address" rows="4" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-red-500 focus:border-red-500 transition-colors @error('address') border-red-500 @enderror" placeholder="Masukkan nama jalan, gedung, RT/RW, kelurahan, kecamatan, dan kode pos...">{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                            <a href="{{ url('/') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Batal</a>
                            <button type="submit" class="px-6 py-2.5 bg-[#de232c] hover:bg-red-700 text-white font-medium rounded-lg shadow-sm transition-colors focus:ring-4 focus:ring-red-500/20">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    @include('layouts.footer')
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Keuangan - Admin Dashboard</title>

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
        body { font-family: 'Poppins', sans-serif; background-color: #F3F4F6; }
    </style>
</head>
<body class="text-gray-800 flex h-screen overflow-hidden">

    <!-- Mobile Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 hidden md:hidden transition-opacity"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-white shadow-lg flex flex-col h-full z-30 absolute md:relative -translate-x-full md:translate-x-0 transition-transform duration-300">
        <div class="h-16 flex items-center justify-center border-b border-gray-100 px-4">
            <span class="text-nibras-magenta font-brand text-2xl tracking-tight leading-none">Nibra's Admin</span>
        </div>
        
        <nav class="flex-grow p-4 space-y-2 overflow-y-auto">
            <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-nibras-magenta rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-nibras-magenta rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Kelola Produk
            </a>
            <a href="{{ route('admin.category_brand.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-nibras-magenta rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Kategori & Brand
            </a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-nibras-magenta rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Kelola Pesanan
            </a>
            <a href="{{ route('admin.finance.index') }}" class="flex items-center gap-3 px-4 py-3 bg-pink-50 text-nibras-magenta rounded-lg transition-colors font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Kelola Keuangan
            </a>
        </nav>
        
        <div class="p-4 border-t border-gray-100">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Panel
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-full overflow-hidden relative">
        <!-- Topbar -->
        <header class="h-16 bg-white shadow-sm flex items-center justify-between px-4 md:px-8 z-10 w-full gap-2">
            <div class="flex items-center gap-2 md:gap-3 whitespace-nowrap">
                <button id="mobile-menu-btn" class="md:hidden p-2 text-gray-600 hover:text-nibras-magenta focus:outline-none rounded-md hover:bg-gray-50 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <h2 class="text-lg md:text-xl font-semibold text-gray-800">
                    <span class="md:hidden">Keuangan</span>
                    <span class="hidden md:inline">Kelola Keuangan</span>
                </h2>
            </div>
            <div class="flex items-center gap-3 md:gap-4 overflow-hidden">
                <span class="text-sm font-medium text-gray-600 truncate max-w-[100px] md:max-w-none">
                    <span class="hidden md:inline">Halo, </span>{{ Auth::user()->name ?? 'Admin' }}
                </span>
                <div class="w-8 h-8 rounded-full bg-nibras-magenta text-white flex items-center justify-center font-bold shadow flex-shrink-0">
                    A
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="flex-1 overflow-y-auto p-4 md:p-8 relative">
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-pink-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 pointer-events-none"></div>

            <div class="max-w-7xl mx-auto space-y-8 relative z-10">
                <!-- Alerts -->
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg relative">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Profit Summary Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 {{ $profitToday < 0 ? 'border-l-4 border-l-red-500' : 'border-l-4 border-l-green-500' }}">
                        <p class="text-sm text-gray-500 font-medium mb-1">Keuntungan Hari Ini</p>
                        <p class="text-xl md:text-2xl font-bold {{ $profitToday < 0 ? 'text-red-600' : 'text-green-600' }}">
                            Rp {{ number_format($profitToday, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 {{ $profitWeek < 0 ? 'border-l-4 border-l-red-500' : 'border-l-4 border-l-green-500' }}">
                        <p class="text-sm text-gray-500 font-medium mb-1">Keuntungan Minggu Ini</p>
                        <p class="text-xl md:text-2xl font-bold {{ $profitWeek < 0 ? 'text-red-600' : 'text-green-600' }}">
                            Rp {{ number_format($profitWeek, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 {{ $profitMonth < 0 ? 'border-l-4 border-l-red-500' : 'border-l-4 border-l-green-500' }}">
                        <p class="text-sm text-gray-500 font-medium mb-1">Keuntungan Bulan Ini</p>
                        <p class="text-xl md:text-2xl font-bold {{ $profitMonth < 0 ? 'text-red-600' : 'text-green-600' }}">
                            Rp {{ number_format($profitMonth, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 {{ $profitYear < 0 ? 'border-l-4 border-l-red-500' : 'border-l-4 border-l-green-500' }}">
                        <p class="text-sm text-gray-500 font-medium mb-1">Keuntungan Tahun Ini</p>
                        <p class="text-xl md:text-2xl font-bold {{ $profitYear < 0 ? 'text-red-600' : 'text-green-600' }}">
                            Rp {{ number_format($profitYear, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                @if($profitFiltered !== null)
                <div class="bg-gray-800 text-white p-5 rounded-xl shadow-md border-l-4 {{ $profitFiltered < 0 ? 'border-l-red-500' : 'border-l-green-400' }} flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-gray-300 font-medium mb-1">Keuntungan (Sesuai Filter Tanggal)</p>
                        <p class="text-xs text-gray-400">
                            @if(request('start_date') && request('end_date'))
                                {{ \Carbon\Carbon::parse(request('start_date'))->format('d M Y') }} - {{ \Carbon\Carbon::parse(request('end_date'))->format('d M Y') }}
                            @elseif(request('start_date'))
                                Mulai {{ \Carbon\Carbon::parse(request('start_date'))->format('d M Y') }}
                            @elseif(request('end_date'))
                                Hingga {{ \Carbon\Carbon::parse(request('end_date'))->format('d M Y') }}
                            @endif
                        </p>
                    </div>
                    <p class="text-2xl md:text-3xl font-bold {{ $profitFiltered < 0 ? 'text-red-400' : 'text-green-400' }}">
                        Rp {{ number_format($profitFiltered, 0, ',', '.') }}
                    </p>
                </div>
                @endif

                <!-- Data and Filters -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-4 md:p-6 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <h3 class="text-lg font-bold text-gray-800">Riwayat Keuangan</h3>
                        
                        <div class="flex flex-col sm:flex-row gap-2">
                            <form action="{{ route('admin.finance.index') }}" method="GET" class="flex items-center gap-2">
                                <select name="type" class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-nibras-magenta bg-white">
                                    <option value="">Semua Filter</option>
                                    <option value="pemasukan" {{ request('type') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                    <option value="pengeluaran" {{ request('type') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                                </select>
                                
                                <div class="flex items-center gap-2">
                                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-nibras-magenta bg-white" placeholder="Tanggal Awal" title="Tanggal Awal">
                                    <span class="text-gray-400 font-medium">-</span>
                                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-nibras-magenta bg-white" placeholder="Tanggal Akhir" title="Tanggal Akhir">
                                </div>
                                
                                <button type="submit" class="bg-gray-800 hover:bg-black text-white px-3 py-2 rounded-md text-sm font-medium transition-colors flex items-center justify-center hidden sm:flex" title="Terapkan Filter">
                                    Saring
                                </button>
                            </form>
                            <button onclick="openModal('addModal')" class="bg-nibras-magenta hover:bg-pink-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Tambah Data
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-600">
                            <thead class="bg-gray-50/50 text-gray-700">
                                <tr>
                                    <th class="px-6 py-4 font-medium">Tanggal</th>
                                    <th class="px-6 py-4 font-medium">Keterangan</th>
                                    <th class="px-6 py-4 font-medium">Tipe</th>
                                    <th class="px-6 py-4 font-medium">Nominal</th>
                                    <th class="px-6 py-4 font-medium text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($finances as $finance)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($finance->date)->format('d M Y') }}</td>
                                        <td class="px-6 py-4">{{ $finance->description ?? '-' }}</td>
                                        <td class="px-6 py-4">
                                            @if($finance->type == 'pemasukan')
                                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">Pemasukan</span>
                                            @else
                                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">Pengeluaran</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 font-semibold {{ $finance->type == 'pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $finance->type == 'pemasukan' ? '+' : '-' }}Rp {{ number_format($finance->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end gap-2">
                                                <button onclick="openEditModal({{ $finance->id }}, '{{ $finance->type }}', '{{ $finance->amount }}', '{{ $finance->description }}', '{{ $finance->date }}')" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Edit">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                </button>
                                                <form action="{{ route('admin.finance.destroy', $finance->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded transition-colors" title="Hapus">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                <p>Belum ada catatan keuangan yang ditemukan.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($finances->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100">
                            {{ $finances->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Tambah Data -->
    <div id="addModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-lg mx-4 overflow-hidden transform scale-95 transition-transform duration-300">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Tambah Catatan Keuangan</h3>
                <button onclick="closeModal('addModal')" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form action="{{ route('admin.finance.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                        <select name="type" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-nibras-magenta focus:ring-1 focus:ring-nibras-magenta">
                            <option value="pemasukan">Pemasukan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="date" required value="{{ date('Y-m-d') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-nibras-magenta focus:ring-1 focus:ring-nibras-magenta">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nominal (Rp)</label>
                        <input type="number" name="amount" required min="0" step="1" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-nibras-magenta focus:ring-1 focus:ring-nibras-magenta" placeholder="Misal: 500000">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                        <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-nibras-magenta focus:ring-1 focus:ring-nibras-magenta" placeholder="Keterangan transaksi..."></textarea>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-end gap-3">
                    <button type="button" onclick="closeModal('addModal')" class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium bg-nibras-magenta text-white hover:bg-pink-700 rounded-lg transition-colors">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Data -->
    <div id="editModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-lg mx-4 overflow-hidden transform scale-95 transition-transform duration-300">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Edit Catatan Keuangan</h3>
                <button onclick="closeModal('editModal')" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                        <select name="type" id="edit_type" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-nibras-magenta focus:ring-1 focus:ring-nibras-magenta">
                            <option value="pemasukan">Pemasukan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="date" id="edit_date" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-nibras-magenta focus:ring-1 focus:ring-nibras-magenta">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nominal (Rp)</label>
                        <input type="number" name="amount" id="edit_amount" required min="0" step="1" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-nibras-magenta focus:ring-1 focus:ring-nibras-magenta">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                        <textarea name="description" id="edit_description" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-nibras-magenta focus:ring-1 focus:ring-nibras-magenta"></textarea>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-end gap-3">
                    <button type="button" onclick="closeModal('editModal')" class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium bg-blue-600 text-white hover:bg-blue-700 rounded-lg transition-colors">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Interactive Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const mobileBtn = document.getElementById('mobile-menu-btn');

            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                if (sidebar.classList.contains('-translate-x-full')) {
                    overlay.classList.add('hidden');
                } else {
                    overlay.classList.remove('hidden');
                }
            }

            if (mobileBtn) mobileBtn.addEventListener('click', toggleSidebar);
            if (overlay) overlay.addEventListener('click', toggleSidebar);
        });

        function openModal(id) {
            const modal = document.getElementById(id);
            const content = modal.querySelector('div.bg-white');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-95');
            }, 10);
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            const content = modal.querySelector('div.bg-white');
            modal.classList.add('opacity-0');
            content.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        function openEditModal(id, type, amount, description, date) {
            document.getElementById('editForm').action = '/admin/finance/' + id;
            document.getElementById('edit_type').value = type;
            document.getElementById('edit_amount').value = Math.floor(amount); // Remove trailing zeros
            document.getElementById('edit_description').value = description;
            
            // Format datetime output if needed, but it's date column so 'YYYY-MM-DD' should be enough
            let formattedDate = date;
            if (date.includes(' ')) {
                formattedDate = date.split(' ')[0];
            }
            document.getElementById('edit_date').value = formattedDate;
            
            openModal('editModal');
        }
    </script>
</body>
</html>

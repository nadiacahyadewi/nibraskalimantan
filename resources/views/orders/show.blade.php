<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pesanan #{{ $order->id }} - Febia Nibras Kalsel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { nibras: { magenta: '#E32184', gray: '#EEEEEE', text: '#706f6c' } },
                    fontFamily: { sans: ['Poppins', 'sans-serif'] }
                }
            }
        }
    </script>
    @if($order->payment_method === 'Midtrans')
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    @endif
</head>
<body class="text-gray-800 bg-gray-50 flex flex-col min-h-screen">
    @include('layouts.navbar')

    <main class="flex-grow pt-[100px] mb-20 px-6 lg:px-16 container mx-auto max-w-5xl">
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('orders.index') }}" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-gray-400 hover:text-nibras-magenta shadow-sm border border-gray-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Pesanan</h1>
                <p class="text-sm text-gray-500">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }} • {{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-left">
            <!-- Left: Items & Status -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-nibras-magenta" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Status Pesanan
                    </h3>
                    
                    <div class="relative pl-8 space-y-8 before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-0.5 before:bg-gray-100">
                        @php
                            $statuses = ['Menunggu Pembayaran', 'Dibayar', 'Menunggu Konfirmasi', 'Diproses', 'Dikirim', 'Selesai'];
                            $currentIndex = array_search($order->status, $statuses);
                            if ($order->status == 'Dibatalkan') $statuses = ['Dibatalkan'];
                        @endphp

                        @foreach($statuses as $index => $status)
                            @php
                                $isCompleted = $currentIndex !== false && $index <= $currentIndex;
                                $isCurrent = $currentIndex !== false && $index == $currentIndex;
                            @endphp
                            <div class="relative">
                                <div class="absolute -left-[27px] top-1 w-4 h-4 rounded-full border-2 {{ $isCompleted ? 'bg-nibras-magenta border-nibras-magenta' : 'bg-white border-gray-200' }} z-10 transition-colors">
                                    @if($isCompleted)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white mx-auto mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="{{ $status == 'Dibatalkan' ? 'text-red-600' : ($isCompleted ? 'text-gray-900' : 'text-gray-400') }}">
                                    <div class="flex justify-between items-start">
                                        <p class="font-bold text-sm">{{ $status }}</p>
                                        @php
                                            $time = null;
                                            if ($status == 'Menunggu Pembayaran') $time = $order->created_at;
                                            if ($status == 'Dibayar' && in_array($order->status, ['Dibayar', 'Menunggu Konfirmasi', 'Diproses', 'Dikirim', 'Selesai'])) $time = $order->updated_at;
                                            if ($status == 'Menunggu Konfirmasi' && in_array($order->status, ['Menunggu Konfirmasi', 'Diproses', 'Dikirim', 'Selesai'])) $time = $order->updated_at;
                                            if ($status == 'Diproses') $time = $order->processed_at;
                                            if ($status == 'Dikirim') $time = $order->shipped_at;
                                            if ($status == 'Selesai') $time = $order->completed_at;
                                            if ($status == 'Dibatalkan') $time = $order->cancelled_at;
                                        @endphp
                                        @if($time)
                                            <span class="text-[10px] bg-gray-100 px-2 py-0.5 rounded text-gray-500 font-medium whitespace-nowrap ml-2">
                                                {{ is_string($time) ? \Carbon\Carbon::parse($time)->format('d/m, H:i') : $time->format('d/m, H:i') }}
                                            </span>
                                        @endif
                                    </div>
                                    @if($isCurrent)
                                        <p class="text-xs mt-1 text-nibras-magenta font-medium animate-pulse">Pesanan Anda saat ini sedang berada di tahap ini.</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($order->status === 'Dikirim' || $order->receipt_number)
                        <div class="mt-8 pt-6 border-t border-gray-100">
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Informasi Pengiriman</h4>
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100">
                                <div>
                                    <p class="text-xs text-gray-500">Nomor Resi / No. Kurir</p>
                                    <p class="font-bold text-gray-900">{{ $order->receipt_number ?? 'Sedang disiapkan' }}</p>
                                </div>
                                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-nibras-magenta shadow-sm border border-gray-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                                </div>
                            </div>

                            @if($order->status === 'Dikirim')
                                <div class="mt-6">
                                    <form action="{{ route('orders.complete', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" onclick="return confirm('Apakah Anda yakin barang sudah diterima dengan baik?')" class="w-full py-3 bg-green-600 text-white rounded-xl font-bold text-sm shadow-lg shadow-green-100 transition-transform hover:scale-[1.02]">
                                            Pesanan Diterima
                                        </button>
                                    </form>
                                    <p class="text-[10px] text-center text-gray-400 mt-3 italic">Klik tombol di atas jika Anda sudah menerima barang untuk menyelesaikan pesanan.</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-nibras-magenta" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Informasi Pembayaran
                    </h3>
                    <div class="grid grid-cols-2 gap-4 text-left">
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Metode</p>
                            <p class="text-sm font-bold text-gray-900">{{ $order->payment_method ?? 'Tidak ada' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Total Bayar</p>
                            <p class="text-sm font-bold text-nibras-magenta">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    @if($order->payment_method === 'Midtrans' && $order->status === 'Menunggu Pembayaran')
                        <div class="mt-4 pt-4 border-t border-gray-50">
                            <button id="check-status-button" class="w-full py-2 bg-gray-100 text-gray-600 rounded-xl font-bold text-xs hover:bg-gray-200 transition-colors flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Perbarui Status Pembayaran
                            </button>
                            <p class="text-[9px] text-gray-400 mt-2 text-center italic">Klik jika Anda sudah membayar tapi status belum berubah.</p>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $('#check-status-button').on('click', function() {
                                    const btn = $(this);
                                    btn.prop('disabled', true).addClass('opacity-70').html('Memproses...');

                                    $.ajax({
                                        url: "{{ route('midtrans.status') }}",
                                        method: 'POST',
                                        data: {
                                            _token: "{{ csrf_token() }}",
                                            order_id: "{{ $order->id }}"
                                        },
                                        success: function(response) {
                                            alert(response.message);
                                            if (response.success) {
                                                window.location.reload();
                                            } else {
                                                btn.prop('disabled', false).removeClass('opacity-70').html('Perbarui Status Pembayaran');
                                            }
                                        },
                                        error: function(xhr) {
                                            let msg = 'Gagal memperbarui status.';
                                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                                msg = xhr.responseJSON.message;
                                            }
                                            alert(msg);
                                            btn.prop('disabled', false).removeClass('opacity-70').html('Perbarui Status Pembayaran');
                                        }
                                    });
                                });
                            });
                        </script>
                    @endif

                    @if($order->payment_method === 'Midtrans' && ($order->status === 'Menunggu Konfirmasi' || $order->status === 'Menunggu Pembayaran'))
                        <div class="mt-6">
                            <button id="pay-button" class="w-full py-4 bg-nibras-magenta text-white rounded-2xl font-bold shadow-lg shadow-pink-100 transition-all hover:scale-[1.02] hover:bg-pink-700 flex items-center justify-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Bayar Sekarang
                            </button>
                        </div>

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                        <script type="text/javascript">
                            $('#pay-button').on('click', function () {
                                const btn = $(this);
                                btn.prop('disabled', true).addClass('opacity-70').html('Memproses...');
                                
                                $.ajax({
                                    url: "{{ route('midtrans.token') }}",
                                    method: 'POST',
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                        order_id: "{{ $order->id }}"
                                    },
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest'
                                    },
                                    success: function(data) {
                                        if (data.snap_token) {
                                            window.snap.pay(data.snap_token, {
                                                onSuccess: function(result) { window.location.reload(); },
                                                onPending: function(result) { window.location.reload(); },
                                                onError: function(result) { window.location.reload(); },
                                                onClose: function() { 
                                                    btn.prop('disabled', false).removeClass('opacity-70').html('<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg> Bayar Sekarang');
                                                }
                                            });
                                        } else {
                                            alert('Gagal mendapatkan token pembayaran.');
                                            btn.prop('disabled', false).removeClass('opacity-70').html('Bayar Sekarang');
                                        }
                                    },
                                    error: function(xhr) {
                                        console.error('Error fetching snap token:', xhr.responseText);
                                        alert('Terjadi kesalahan saat memproses pembayaran.');
                                        btn.prop('disabled', false).removeClass('opacity-70').html('Bayar Sekarang');
                                    }
                                });
                            });
                        </script>
                    @endif
                </div>

                <!-- Items Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50">
                        <h3 class="font-bold text-gray-900">Rincian Produk</h3>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @foreach($order->items as $item)
                        <div class="p-6 flex items-center gap-4">
                            <div class="w-20 h-24 bg-gray-50 rounded-lg overflow-hidden shrink-0 border border-gray-100">
                                @php
                                    $product = \App\Models\Product::find($item->product_id);
                                    $image = $product ? $product->images->first() : null;
                                @endphp
                                @if($image)
                                    <img src="{{ Storage::url($image->image_path) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow">
                                <h4 class="font-bold text-gray-900 leading-tight mb-1">{{ $item->product_name }}</h4>
                                <p class="text-xs text-gray-500 mb-2 uppercase tracking-widest">Ukuran: {{ $item->size }}</p>
                                <div class="flex items-center justify-between sm:justify-start gap-4">
                                    <p class="text-xs text-gray-400">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                    <p class="text-sm font-bold text-nibras-magenta sm:hidden">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="text-right hidden sm:block">
                                <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Subtotal</p>
                                <p class="font-bold text-gray-900">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="bg-gray-50 p-6 flex flex-col gap-3">
                        <div class="flex justify-between text-sm text-gray-500 font-medium">
                            <span>Subtotal Produk</span>
                            <span>Rp {{ number_format($order->total_amount - $order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-500 font-medium">
                            <span class="flex items-center gap-2">
                                Ongkos Kirim 
                                <span class="text-[10px] bg-white px-2 py-0.5 rounded border border-gray-200 uppercase">{{ $order->courier }}</span>
                            </span>
                            <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold text-gray-900 pt-3 border-t border-gray-200">
                            <span>Total Pembayaran</span>
                            <span class="text-nibras-magenta">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Shipping Info -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-nibras-magenta" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Informasi Pengiriman
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Penerima</p>
                            <p class="text-sm font-bold text-gray-900">{{ $order->customer_name }}</p>
                            <p class="text-xs text-gray-500">{{ $order->customer_phone }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Alamat Lengkap</p>
                            <div class="text-xs text-gray-600 leading-relaxed bg-gray-50 p-3 rounded-xl border border-gray-100">
                                <p class="mb-1">{{ $order->customer_address }}</p>
                                <p class="font-bold text-gray-800">{{ $order->district }}, {{ $order->city }}</p>
                                <p>{{ $order->province }}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Kurir & Layanan</p>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-gray-100 rounded flex items-center justify-center text-[10px] font-black uppercase text-gray-500 border border-gray-200">
                                    {{ $order->courier }}
                                </div>
                                <p class="text-xs font-bold text-gray-700">{{ $order->shipping_service }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-pink-50 rounded-2xl p-6 border border-pink-100">
                    <h4 class="font-bold text-nibras-magenta text-sm mb-2 italic">Butuh bantuan?</h4>
                    <p class="text-xs text-pink-700 leading-relaxed mb-4">Jika ada kendala dengan pesanan Anda, silakan hubungi admin kami melalui WhatsApp.</p>
                    @php
                        $msg = "Halo Admin, saya ingin bertanya tentang pesanan saya #ORD-" . str_pad($order->id, 5, '0', STR_PAD_LEFT);
                        $adminWa = "6282148882473";
                    @endphp
                    <a href="https://wa.me/{{ $adminWa }}?text={{ urlencode($msg) }}" target="_blank" class="flex items-center justify-center gap-2 w-full py-2.5 bg-nibras-magenta text-white rounded-xl font-bold text-xs shadow-lg shadow-pink-200 transition-transform hover:scale-105">
                        Chat Admin
                    </a>
                </div>
            </div>
        </div>
    </main>

    @include('layouts.footer')
</body>
</html>

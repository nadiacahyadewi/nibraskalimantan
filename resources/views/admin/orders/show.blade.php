@extends('layouts.admin_layout')

@section('title', 'Detail Pesanan - Admin Panel')
@section('header_title', 'Detail Pesanan')

@section('content')
<div class="px-4 py-6 md:px-6 md:py-8" x-data="{ shipModal: false }">
    <!-- Breadcrumb & Title -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.orders.index') }}" class="hover:text-nibras-magenta transition-colors">Pesanan</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-gray-900 font-medium">Detail Pesanan</span>
            </div>
            <h2 class="text-xl md:text-2xl font-bold text-gray-800">Pesanan #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h2>
            <p class="text-xs text-gray-500 mt-1">{{ $order->created_at->format('d F Y, H:i') }}</p>
        </div>
        
        <div class="flex flex-wrap items-center gap-3">
            @if($order->status === 'Menunggu Pembayaran')
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="Dibayar">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition-colors shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Konfirmasi Pembayaran
                    </button>
                </form>
            @elseif($order->status === 'Dibayar')
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="Menunggu Konfirmasi">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Konfirmasi Pesanan
                    </button>
                </form>
            @elseif($order->status === 'Menunggu Konfirmasi')
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="Diproses">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Konfirmasi & Proses
                    </button>
                </form>
            @elseif($order->status === 'Diproses')
                <button type="button" @click="shipModal = true" class="bg-nibras-magenta text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-pink-700 transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                    Kirim Pesanan
                </button>
            @endif

            @if(!in_array($order->status, ['Selesai', 'Dibatalkan']))
            <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" name="status" value="Dibatalkan" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')" class="text-gray-500 hover:text-red-600 px-3 py-2 text-sm font-medium transition-colors">
                    Batalkan
                </button>
            </form>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-700 border border-green-200 rounded-lg flex items-start gap-3">
            <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <div>
                <h4 class="text-sm font-semibold">Berhasil</h4>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left: Order Details & Products -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Product List Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                    <h3 class="font-bold text-gray-800">Daftar Produk</h3>
                    <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">{{ $order->items->count() }} Item</span>
                </div>
                <div class="p-0">
                    <div class="divide-y divide-gray-100">
                        @foreach($order->items as $item)
                        <div class="flex gap-4 p-6 hover:bg-gray-50 transition-colors">
                            <div class="w-16 h-16 md:w-20 md:h-20 bg-gray-50 rounded-lg overflow-hidden shrink-0 border border-gray-100">
                                @if($item->product && $item->product->images->count() > 0)
                                    <img src="{{ $item->product->images->first()->url }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow flex flex-col justify-between">
                                <div>
                                    <h4 class="font-semibold text-gray-900 line-clamp-2 leading-tight">{{ $item->product_name }}</h4>
                                    <p class="text-xs text-gray-500 mt-1">Ukuran: <span class="font-medium text-gray-700">{{ $item->size ?? '-' }}</span></p>
                                </div>
                                <div class="flex justify-between items-end mt-2">
                                    <span class="text-gray-500 text-xs">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                    <span class="font-bold text-gray-900 text-sm">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Payment Summary Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Subtotal Produk</span>
                        <span class="font-medium text-gray-900">Rp {{ number_format($order->total_amount - $order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Ongkos Kirim</span>
                        <span class="font-medium text-gray-900">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="pt-4 border-t border-gray-100 flex justify-between items-center">
                        <span class="font-bold text-gray-800">Total Tagihan</span>
                        <span class="text-xl md:text-2xl font-black text-nibras-magenta">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Status & Customer Info -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Order Status Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="font-bold text-gray-800 text-sm uppercase tracking-wider">Status Pesanan</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-4">
                        @php
                            $statusColors = [
                                'Menunggu Pembayaran' => 'bg-amber-100 text-amber-700 border-amber-200',
                                'Dibayar' => 'bg-blue-100 text-blue-700 border-blue-200',
                                'Menunggu Konfirmasi' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                                'Diproses' => 'bg-cyan-100 text-cyan-700 border-cyan-200',
                                'Dikirim' => 'bg-purple-100 text-purple-700 border-purple-200',
                                'Selesai' => 'bg-green-100 text-green-700 border-green-200',
                                'Dibatalkan' => 'bg-red-100 text-red-700 border-red-200',
                            ];
                            $color = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $color }}">
                            {{ $order->status }}
                        </span>
                    </div>

                    <div class="space-y-4 text-xs">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Dipesan:</span>
                            <span class="text-gray-900 font-medium">{{ $order->created_at->format('d M, H:i') }}</span>
                        </div>
                        @if($order->paid_at)
                        <div class="flex justify-between">
                            <span class="text-gray-500">Dibayar:</span>
                            <span class="text-gray-900 font-medium">{{ \Carbon\Carbon::parse($order->paid_at)->format('d M, H:i') }}</span>
                        </div>
                        @endif
                        @if($order->confirmed_at)
                        <div class="flex justify-between">
                            <span class="text-gray-500">Dikonfirmasi:</span>
                            <span class="text-gray-900 font-medium">{{ \Carbon\Carbon::parse($order->confirmed_at)->format('d M, H:i') }}</span>
                        </div>
                        @endif
                        @if($order->processed_at)
                        <div class="flex justify-between">
                            <span class="text-gray-500">Diproses:</span>
                            <span class="text-gray-900 font-medium">{{ \Carbon\Carbon::parse($order->processed_at)->format('d M, H:i') }}</span>
                        </div>
                        @endif
                        @if($order->shipped_at)
                        <div class="flex justify-between">
                            <span class="text-gray-500">Dikirim:</span>
                            <span class="text-gray-900 font-medium">{{ \Carbon\Carbon::parse($order->shipped_at)->format('d M, H:i') }}</span>
                        </div>
                        @endif
                        @if($order->completed_at)
                        <div class="flex justify-between">
                            <span class="text-gray-500">Selesai:</span>
                            <span class="text-gray-900 font-medium">{{ \Carbon\Carbon::parse($order->completed_at)->format('d M, H:i') }}</span>
                        </div>
                        @endif
                        @if($order->cancelled_at)
                        <div class="flex justify-between">
                            <span class="text-gray-500 text-red-500">Dibatalkan:</span>
                            <span class="text-red-600 font-medium">{{ \Carbon\Carbon::parse($order->cancelled_at)->format('d M, H:i') }}</span>
                        </div>
                        @endif

                        @if($order->receipt_number)
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <p class="text-[10px] text-gray-500 uppercase tracking-widest mb-2 font-bold">Nomor Resi</p>
                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg border border-blue-100">
                                <span class="font-mono font-bold text-blue-800 text-sm">{{ $order->receipt_number }}</span>
                                <button onclick="copyAdminReceipt()" class="text-blue-600 hover:text-blue-800 bg-white p-1 rounded border border-blue-100 shadow-sm" title="Salin Resi">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Customer Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                    <h3 class="font-bold text-gray-800 text-sm uppercase tracking-wider">Pelanggan</h3>
                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $order->customer_phone)) }}" target="_blank" class="w-8 h-8 bg-green-50 text-green-600 rounded-full flex items-center justify-center hover:bg-green-100 transition-colors shadow-sm border border-green-100" title="Hubungi WA">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                    </a>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Nama</p>
                            <p class="text-sm font-bold text-gray-900">{{ $order->customer_name }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Kontak</p>
                            <p class="text-sm font-bold text-gray-900">{{ $order->customer_phone }}</p>
                        </div>
                        <div class="pt-4 border-t border-gray-100">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-2">Alamat Pengiriman</p>
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-nibras-magenta font-bold text-[10px] shadow-sm border border-pink-100 uppercase">
                                        {{ $order->courier }}
                                    </div>
                                    <span class="text-xs font-bold text-gray-800">{{ $order->shipping_service }}</span>
                                </div>
                                <p class="text-xs text-gray-600 leading-relaxed">{{ $order->customer_address }}, {{ $order->district }}, {{ $order->city }}, {{ $order->province }}</p>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-gray-100 flex justify-between items-center">
                            <div>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Metode Bayar</p>
                                <p class="text-sm font-bold text-gray-900">
                                    {{ $order->payment_method }}
                                    @if($order->payment_info)
                                        <span class="text-xs font-medium text-gray-500 block">({{ $order->payment_info }})</span>
                                    @elseif($order->payment_type)
                                        <span class="text-xs font-medium text-gray-500 block">({{ strtoupper(str_replace('_', ' ', $order->payment_type)) }})</span>
                                    @endif
                                </p>
                            </div>
                            @if($order->payment_method === 'Midtrans' && $order->status === 'Menunggu Pembayaran')
                                <button id="check-status-admin" class="text-[10px] bg-nibras-magenta/10 text-nibras-magenta px-3 py-1.5 rounded-lg font-bold hover:bg-nibras-magenta/20 transition-colors flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                    Cek Status
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div x-show="shipModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-[60] flex items-center justify-center p-4" 
         style="display: none;">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden" 
             @click.away="shipModal = false"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="font-bold text-gray-800">Kirim Pesanan</h3>
                <button @click="shipModal = false" class="text-gray-400 hover:text-gray-600 p-1 hover:bg-gray-100 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form action="{{ route('admin.orders.ship', $order) }}" method="POST">
                @csrf
                <div class="p-6 space-y-4">
                    <p class="text-sm text-gray-500 leading-relaxed">Masukkan nomor resi pengiriman untuk memberitahu pelanggan bahwa barang telah dikirim.</p>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nomor Resi / No. Kurir</label>
                        <input type="text" name="receipt_number" required placeholder="Contoh: JNE12345678" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-nibras-magenta/20 focus:border-nibras-magenta outline-none transition-all">
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50/80 flex justify-end gap-3">
                    <button type="button" @click="shipModal = false" class="px-5 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-700 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-nibras-magenta text-white text-sm font-bold rounded-xl hover:bg-pink-700 transition-all shadow-md shadow-pink-100 active:scale-95">
                        Konfirmasi Pengiriman
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function copyAdminReceipt() {
        const receipt = "{{ $order->receipt_number }}";
        navigator.clipboard.writeText(receipt).then(() => {
            alert('Nomor resi berhasil disalin!');
        }).catch(err => {
            console.error('Gagal menyalin: ', err);
        });
    }

    $(document).ready(function() {
        $('#check-status-admin').on('click', function() {
            const btn = $(this);
            btn.prop('disabled', true).addClass('opacity-50').html('...');

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
                        btn.prop('disabled', false).removeClass('opacity-50').html('Cek Status');
                    }
                },
                error: function(xhr) {
                    alert('Gagal mengambil status.');
                    btn.prop('disabled', false).removeClass('opacity-50').html('Cek Status');
                }
            });
        });
    });
</script>
@endsection

@extends('layouts.admin_layout')

@section('content')
<div class="px-6 py-8" x-data="{ shipModal: false }">
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.orders.index') }}" class="hover:text-nibras-magenta transition-colors">Pesanan</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-gray-900 font-medium">Detail Pesanan</span>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Pesanan #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h2>
        </div>
        
        <div class="flex items-center gap-3">
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
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-2 px-3 py-2 bg-blue-50 text-blue-700 border border-blue-100 rounded-lg text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Diproses ({{ $order->processed_at ? (is_string($order->processed_at) ? \Carbon\Carbon::parse($order->processed_at)->format('d/m, H:i') : $order->processed_at->format('d/m, H:i')) : '-' }})
                    </div>
                    <button type="button" @click="shipModal = true" class="bg-nibras-magenta text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-pink-700 transition-colors shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                        Kirim Pesanan
                    </button>
                </div>
            @elseif($order->status === 'Dikirim')
                <div class="flex items-center gap-2 px-3 py-2 bg-green-50 text-green-700 border border-green-100 rounded-lg text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Dalam Pengiriman ({{ $order->shipped_at ? (is_string($order->shipped_at) ? \Carbon\Carbon::parse($order->shipped_at)->format('d/m, H:i') : $order->shipped_at->format('d/m, H:i')) : '-' }})
                </div>
            @elseif($order->status === 'Selesai')
                <div class="flex items-center gap-2 px-3 py-2 bg-gray-50 text-gray-600 border border-gray-100 rounded-lg text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Selesai ({{ $order->completed_at ? (is_string($order->completed_at) ? \Carbon\Carbon::parse($order->completed_at)->format('d/m, H:i') : $order->completed_at->format('d/m, H:i')) : '-' }})
                </div>
            @elseif($order->status === 'Dibatalkan')
                <div class="flex items-center gap-2 px-3 py-2 bg-red-50 text-red-600 border border-red-100 rounded-lg text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    Dibatalkan ({{ $order->cancelled_at ? (is_string($order->cancelled_at) ? \Carbon\Carbon::parse($order->cancelled_at)->format('d/m, H:i') : $order->cancelled_at->format('d/m, H:i')) : '-' }})
                </div>
            @endif

            <div class="h-6 w-px bg-gray-200 mx-2"></div>

            <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" name="status" value="Dibatalkan" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')" class="text-gray-500 hover:text-red-600 px-3 py-2 text-sm font-medium transition-colors">
                    Batalkan
                </button>
            </form>
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
        
        <!-- Left Column: Order Items -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="font-bold text-gray-800">Daftar Produk</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                        <div class="flex gap-4 p-4 border border-gray-100 rounded-lg hover:border-pink-100 hover:bg-pink-50/30 transition-colors">
                            <div class="w-20 h-20 bg-gray-100 rounded-md overflow-hidden shrink-0 border border-gray-200">
                                @if($item->product && $item->product->images->count() > 0)
                                    <img src="{{ Storage::url($item->product->images->first()->image_path) }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow flex flex-col justify-between">
                                <div>
                                    <h4 class="font-semibold text-gray-900 line-clamp-2 leading-snug">{{ $item->product_name }}</h4>
                                    <p class="text-sm text-gray-500 mt-1">Ukuran / Variasi: <span class="font-medium text-gray-700 bg-gray-100 px-2 py-0.5 rounded">{{ $item->size ?? '-' }}</span></p>
                                </div>
                                <div class="flex justify-between items-end mt-2">
                                    <span class="text-gray-600 text-sm">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                    <span class="font-bold text-gray-900">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 bg-gray-50/50">
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Subtotal Produk</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format($order->total_amount - $order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Ongkos Kirim ({{ strtoupper($order->courier) }})</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="pt-3 border-t border-gray-100 flex justify-between items-center">
                            <span class="font-bold text-gray-800">Total Pembayaran</span>
                            <span class="text-2xl font-black text-nibras-magenta">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Customer Info -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="font-bold text-gray-800">Informasi Pelanggan</h3>
                </div>
                <div class="p-6 space-y-5">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Nama Lengkap</p>
                        <p class="font-medium text-gray-900">{{ $order->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">No. HP / WhatsApp</p>
                        <div class="flex items-center gap-2">
                            <p class="font-medium text-gray-900">{{ $order->customer_phone }}</p>
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $order->customer_phone)) }}" target="_blank" class="text-green-500 hover:text-green-600" title="Hubungi via WA">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                            </a>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Alamat Pengiriman</p>
                        <div class="text-gray-800 leading-relaxed bg-gray-50 p-3 rounded-lg border border-gray-100 text-sm">
                            <p class="font-bold mb-1">{{ $order->customer_name }}</p>
                            <p>{{ $order->customer_address }}</p>
                            <p class="mt-2">{{ $order->district }}, {{ $order->city }}</p>
                            <p>{{ $order->province }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Layanan Pengiriman</p>
                        <div class="flex items-center gap-3 p-3 bg-pink-50 rounded-lg border border-pink-100">
                            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-nibras-magenta font-bold text-xs shadow-sm border border-pink-100 uppercase">
                                {{ $order->courier }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ $order->shipping_service }}</p>
                                <p class="text-xs text-gray-500">Ongkir: Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Metode Pembayaran</p>
                        <div class="flex items-center justify-between">
                            <p class="font-medium text-gray-900 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-nibras-magenta"></span>
                                {{ $order->payment_method }}
                            </p>
                            @if($order->payment_method === 'Midtrans' && $order->status === 'Menunggu Pembayaran')
                                <button id="check-status-admin" class="text-[10px] bg-gray-100 px-2 py-1 rounded hover:bg-gray-200 transition-colors flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                    Cek Status
                                </button>
                            @endif
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Waktu Dipesan</p>
                        <p class="text-gray-800 text-sm">{{ $order->created_at->format('d F Y, H:i') }}</p>
                    </div>

                    @if($order->payment_method === 'Midtrans' && $order->status === 'Menunggu Pembayaran')
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                    <script>
                        $('#check-status-admin').on('click', function() {
                            const btn = $(this);
                            btn.prop('disabled', true).addClass('opacity-70').html('...');

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
                                        btn.prop('disabled', false).removeClass('opacity-70').html('Cek Status');
                                    }
                                },
                                error: function(xhr) {
                                    alert('Gagal mengambil status.');
                                    btn.prop('disabled', false).removeClass('opacity-70').html('Cek Status');
                                }
                            });
                        });
                    </script>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <!-- Ship Modal -->
    <div x-show="shipModal" x-transition.opacity class="fixed inset-0 bg-black/50 z-[60] flex items-center justify-center p-4" style="display: none;">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden" @click.away="shipModal = false">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Kirim Pesanan</h3>
                <button @click="shipModal = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form action="{{ route('admin.orders.ship', $order) }}" method="POST">
                @csrf
                <div class="p-6 space-y-4">
                    <p class="text-sm text-gray-500">Masukkan nomor resi pengiriman untuk memberitahu pelanggan bahwa barang telah dikirim.</p>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Resi / No. Kurir</label>
                        <input type="text" name="receipt_number" required placeholder="Contoh: JNE12345678" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-nibras-magenta focus:border-nibras-magenta">
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3">
                    <button type="button" @click="shipModal = false" class="px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-nibras-magenta text-white text-sm font-medium rounded-lg hover:bg-pink-700 transition-colors shadow-sm">
                        Konfirmasi Pengiriman
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

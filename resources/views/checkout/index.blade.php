<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout Pengiriman - Febia Nibras Kalsel</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { nibras: { magenta: '#E32184', gray: '#EEEEEE', text: '#706f6c' } },
                    fontFamily: { 
                        sans: ['Poppins', 'sans-serif'],
                        brand: ['Pacifico', 'cursive']
                    }
                }
            }
        }
    </script>

    <!-- midtrans -->
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <style>
        .nibras-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .container-glow {
            box-shadow: 0 0 40px rgba(227, 33, 132, 0.08);
        }
    </style>
</head>
<body class="text-gray-800 bg-[#F8F8F8] flex flex-col min-h-screen font-sans">

    @include('layouts.navbar')

    <main class="flex-grow pt-[100px] pb-16 px-6 lg:px-16 max-w-7xl mx-auto w-full">
        
        <div class="mb-10 text-center md:text-left">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 tracking-tight">Checkout <span class="font-brand text-nibras-magenta">Pengiriman</span></h1>
            <p class="text-gray-500 mt-2">Lengkapi data untuk menyelesaikan pesanan Anda.</p>
        </div>

        <form action="{{ route('checkout.process') }}" method="POST" class="flex flex-col lg:flex-row gap-8">
            @csrf
            
            <!-- Left: Formulir Data Diri dan Ongkir -->
            <div class="w-full lg:w-2/3 flex flex-col gap-8">
                <!-- Form Data Diri -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 container-glow">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-nibras-magenta text-white flex items-center justify-center text-sm">1</span>
                        Data Penerima
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-nibras-magenta focus:border-nibras-magenta" placeholder="Masukkan nama lengkap penerima">
                        </div>
                        <div class="col-span-1 md:md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP / WhatsApp</label>
                            <input type="text" name="phone" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-nibras-magenta focus:border-nibras-magenta" placeholder="Contoh: 081234567890">
                        </div>

                        <!-- Lokasi Pengiriman -->
                        <div class="col-span-1">
                            <label for="province" class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                            <select id="province" name="province_id" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-nibras-magenta focus:border-nibras-magenta">
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach($provinces as $province)
                                <option value="{{ $province['id'] }}" data-name="{{ $province['name'] }}">{{ $province['name'] }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="province" id="province_name">
                        </div>

                        <div class="col-span-1">
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Kota / Kabupaten</label>
                            <select id="city" name="city_id" required disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-nibras-magenta focus:border-nibras-magenta disabled:bg-gray-100">
                                <option value="">-- Pilih Kota / Kabupaten --</option>
                            </select>
                            <input type="hidden" name="city" id="city_name">
                        </div>

                        <div class="col-span-1">
                            <label for="district" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                            <select id="district" name="district_id" required disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-nibras-magenta focus:border-nibras-magenta disabled:bg-gray-100">
                                <option value="">-- Pilih Kecamatan --</option>
                            </select>
                            <input type="hidden" name="district" id="district_name">
                        </div>

                        <div class="col-span-1">
                            <label for="courier" class="block text-sm font-medium text-gray-700 mb-1">Pilih Kurir</label>
                            <select id="courier_select" name="courier" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-nibras-magenta focus:border-nibras-magenta">
                                <option value="">-- Pilih Kurir --</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS Indonesia</option>
                                <option value="tiki">TIKI</option>
                                <option value="sicepat">SICEPAT</option>
                                <option value="jnt">J&T</option>
                                <option value="anteraja">Anteraja</option>
                                <option value="ninja">Ninja Express</option>
                                <option value="wahana">Wahana</option>
                                <option value="lion">Lion Parcel</option>
                            </select>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap (Jalan, No Rumah, RT/RW)</label>
                            <textarea name="address" required rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-nibras-magenta focus:border-nibras-magenta" placeholder="Nama Jalan, RT/RW, Patokan rumah..."></textarea>
                        </div>
                    </div>

                    <!-- Shipping Services Selection -->
                    <div id="shipping-services-container" class="mt-6 hidden">
                        <h3 class="text-sm font-bold text-gray-800 mb-3">Pilih Layanan Pengiriman</h3>
                        <div id="shipping-services-list" class="space-y-3">
                            <!-- Services will be populated here via AJAX -->
                        </div>
                        <input type="hidden" name="shipping_service" id="selected_shipping_service">
                        <input type="hidden" name="shipping_cost" id="selected_shipping_cost" value="0">
                        <div id="shipping-loader" class="hidden mt-4 flex items-center justify-center">
                            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-nibras-magenta"></div>
                        </div>
                    </div>
                </div>



                <!-- Form Metode Pembayaran -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 container-glow">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-nibras-magenta text-white flex items-center justify-center text-sm">2</span>
                        Metode Pembayaran
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="relative flex items-center p-4 border-2 rounded-xl cursor-pointer bg-pink-50 border-nibras-magenta ring-2 ring-pink-100 transition-all group payment-method-card">
                            <input type="radio" name="payment_method" value="Midtrans" checked required class="sr-only">
                            <div class="w-5 h-5 rounded-full border-2 border-nibras-magenta flex items-center justify-center mr-4 radio-circle">
                                <div class="w-2.5 h-2.5 rounded-full bg-nibras-magenta"></div>
                            </div>
                            <div class="flex-grow">
                                <span class="font-bold text-gray-900">Pembayaran Otomatis</span>
                                <p class="text-xs text-gray-500">Snap Midtrans (QRIS, VA, dll)</p>
                            </div>
                        </label>
                        <label class="relative flex items-center p-4 border-2 rounded-xl cursor-pointer hover:bg-pink-50 hover:border-pink-200 transition-all group payment-method-card">
                            <input type="radio" name="payment_method" value="Bank Transfer" required class="sr-only">
                            <div class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center mr-4 group-hover:border-nibras-magenta radio-circle">
                                <div class="w-2.5 h-2.5 rounded-full bg-nibras-magenta hidden"></div>
                            </div>
                            <div class="flex-grow">
                                <span class="font-bold text-gray-900">Transfer Manual</span>
                                <p class="text-xs text-gray-500">Konfirmasi via WhatsApp</p>
                            </div>
                        </label>
                    </div>
                </div>

                <a href="{{ route('cart.index') }}" class="inline-block mt-4 text-sm font-medium text-gray-500 hover:text-nibras-magenta transition-colors">
                    &larr; Kembali ke Keranjang
                </a>
            </div>

            <!-- Right: Order Summary -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 sticky top-28 container-glow">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 border-b border-gray-100 pb-4">Ringkasan Pembayaran</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal ({{ $totalQty }} Produk)</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format($baseSubtotal, 0, ',', '.') }}</span>
                        </div>
                        @php
                            $totalSavings = $baseSubtotal - $subtotal;
                        @endphp
                        @if($totalSavings > 0)
                        <div class="flex justify-between text-green-600">
                            <span>Hemat Produk</span>
                            <span class="font-medium">- Rp {{ number_format($totalSavings, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between text-gray-600">
                            <span>Estimasi Berat</span>
                            <span class="font-medium text-gray-900">{{ number_format($totalWeight, 0, ',', '.') }} gram</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mb-8 p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <span class="text-base font-bold text-gray-900">Total Keseluruhan</span>
                        <span id="grand-total-display" class="text-2xl font-black text-nibras-magenta drop-shadow-sm">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" id="submit-button" class="w-full bg-nibras-magenta text-white h-14 rounded-full font-bold hover:bg-pink-700 transition-all shadow-xl shadow-pink-900/20 flex items-center justify-center gap-3 hover:shadow-2xl hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-pink-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Selesaikan Pesanan
                    </button>
                    
                    <p class="text-xs text-gray-400 text-center mt-4">Pesanan Anda akan segera diproses setelah konfirmasi.</p>
                </div>
            </div>
            
            <!-- Hidden Data Cart Items For WA Template -->
            <div id="cart_wa_items" class="hidden">
                @foreach($cartItems as $item)
                    @php
                        $variant = $item->product->variants->where('size', $item->size)->first();
                        $price = $variant ? $variant->effective_price : $item->product->price;
                    @endphp
                    - {{ $item->product->name }} (Ukuran: {{ $item->size }}) - {{ $item->quantity }} pcs x {{ $price }}
                @endforeach
            </div>

        </form>
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            const subtotal = {{ $subtotal }};
            const weight = {{ $totalWeight }};

            function formatCurrency(amount) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(amount).replace('Rp', 'Rp ').replace(',00', '');
            }

            // Dropdown Provinsi
            $('#province').on('change', function() {
                let provinceId = $(this).val();
                let provinceName = $(this).find(':selected').data('name');
                $('#province_name').val(provinceName);
                
                if (provinceId) {
                    $('#city').prop('disabled', false).empty().append('<option value="">-- Memuat Kota... --</option>');
                    $('#district').prop('disabled', true).empty().append('<option value="">-- Pilih Kecamatan --</option>');
                    
                    $.get(`/cities/${provinceId}`, function(data) {
                        $('#city').empty().append('<option value="">-- Pilih Kota / Kabupaten --</option>');
                        $.each(data, function(key, value) {
                            $('#city').append(`<option value="${value.id}" data-name="${value.name}">${value.name}</option>`);
                        });
                    });
                } else {
                    $('#city').prop('disabled', true).empty().append('<option value="">-- Pilih Kota / Kabupaten --</option>');
                    $('#district').prop('disabled', true).empty().append('<option value="">-- Pilih Kecamatan --</option>');
                }
                resetShipping();
            });

            // Dropdown Kota
            $('#city').on('change', function() {
                let cityId = $(this).val();
                let cityName = $(this).find(':selected').data('name');
                $('#city_name').val(cityName);
                
                if (cityId) {
                    $('#district').prop('disabled', false).empty().append('<option value="">-- Memuat Kecamatan... --</option>');
                    
                    $.get(`/districts/${cityId}`, function(data) {
                        $('#district').empty().append('<option value="">-- Pilih Kecamatan --</option>');
                        $.each(data, function(key, value) {
                            $('#district').append(`<option value="${value.id}" data-name="${value.name}">${value.name}</option>`);
                        });
                    });
                } else {
                    $('#district').prop('disabled', true).empty().append('<option value="">-- Pilih Kecamatan --</option>');
                }
                resetShipping();
            });

            // Dropdown Kecamatan
            $('#district').on('change', function() {
                let districtName = $(this).find(':selected').data('name');
                $('#district_name').val(districtName);
                checkOngkir();
            });

            // Dropdown Kurir
            $('#courier_select').on('change', function() {
                checkOngkir();
            });

            function checkOngkir() {
                let districtId = $('#district').val();
                let courier = $('#courier_select').val();

                if (districtId && courier) {
                    $('#shipping-services-container').removeClass('hidden');
                    $('#shipping-services-list').empty();
                    $('#shipping-loader').removeClass('hidden');

                    $.post('/check-ongkir', {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        district_id: districtId,
                        courier: courier,
                        weight: weight
                    }, function(data) {
                        $('#shipping-loader').addClass('hidden');
                        if (data && data.length > 0) {
                            $.each(data, function(key, value) {
                                let serviceHtml = `
                                    <label class="relative flex items-center p-4 border-2 rounded-xl cursor-pointer hover:bg-pink-50 hover:border-pink-200 transition-all group">
                                        <input type="radio" name="shipping_radio" value="${value.cost}" data-service="${value.service} (${value.description})" class="sr-only">
                                        <div class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center mr-4 group-hover:border-nibras-magenta" id="radio-custom-${key}">
                                            <div class="w-2.5 h-2.5 rounded-full bg-nibras-magenta hidden"></div>
                                        </div>
                                        <div class="flex-grow">
                                            <div class="flex justify-between items-center mb-1">
                                                <span class="font-bold text-gray-900">${value.service}</span>
                                                <span class="font-bold text-nibras-magenta text-lg">${formatCurrency(value.cost)}</span>
                                            </div>
                                            <div class="text-xs text-gray-500">${value.description} <span class="mx-1">•</span> Estimasi ${value.etd} hari</div>
                                        </div>
                                    </label>
                                `;
                                $('#shipping-services-list').append(serviceHtml);
                            });
                        } else {
                            $('#shipping-services-list').append('<p class="text-sm text-red-500">Layanan tidak tersedia untuk kurir ini.</p>');
                        }
                    });
                }
            }

            $(document).on('change', 'input[name="shipping_radio"]', function() {
                let cost = parseInt($(this).val());
                let service = $(this).data('service');
                
                $('#selected_shipping_cost').val(cost);
                $('#selected_shipping_service').val(service);
                
                let grandTotal = subtotal + cost;
                $('#grand-total-display').text(formatCurrency(grandTotal));
                
                // Highlight selection
                $('input[name="shipping_radio"]').parent().removeClass('border-nibras-magenta bg-pink-50 ring-2 ring-pink-100');
                $('input[name="shipping_radio"]').parent().find('.rounded-full div').addClass('hidden');
                
                $(this).parent().addClass('border-nibras-magenta bg-pink-50 ring-2 ring-pink-100');
                $(this).parent().find('.rounded-full div').removeClass('hidden');
            });

            function resetShipping() {
                $('#shipping-services-container').addClass('hidden');
                $('#shipping-services-list').empty();
                $('#selected_shipping_cost').val(0);
                $('#selected_shipping_service').val('');
                $('#grand-total-display').text(formatCurrency(subtotal));
            }

            // Payment Method Selection UI
            $('.payment-method-card').on('click', function() {
                $(this).find('input[name="payment_method"]').prop('checked', true).trigger('change');
            });

            $('input[name="payment_method"]').on('change', function() {
                console.log('Payment method changed to:', $(this).val());
                $('.payment-method-card').removeClass('border-nibras-magenta bg-pink-50 ring-2 ring-pink-100');
                $('.radio-circle div').addClass('hidden');
                
                $(this).closest('.payment-method-card').addClass('border-nibras-magenta bg-pink-50 ring-2 ring-pink-100');
                $(this).closest('.payment-method-card').find('.radio-circle div').removeClass('hidden');
            });

            // Form Submission with Midtrans Snap
            $('form').on('submit', function(e) {
                const paymentMethod = $('input[name="payment_method"]:checked').val();
                console.log('Submitting form with payment method:', paymentMethod);
                
                if (paymentMethod === 'Midtrans') {
                    e.preventDefault();
                    console.log('Processing Midtrans Snap payment...');
                    const form = $(this);
                    const submitBtn = $('#submit-button');
                    
                    // Disable button and show loading
                    submitBtn.prop('disabled', true).addClass('opacity-70').html('<div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div> Memproses...');

                    // First, process the checkout into the database
                    $.ajax({
                        url: form.attr('action'),
                        method: 'POST',
                        data: form.serialize(),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        success: function(response) {
                            console.log('Checkout processed successfully:', response);
                            if (response.success && response.order_id) {
                                // Now get the Midtrans Snap Token
                                $.ajax({
                                    url: "{{ route('midtrans.token') }}",
                                    method: 'POST',
                                    data: {
                                        _token: $('meta[name="csrf-token"]').attr('content'),
                                        order_id: response.order_id
                                    },
                                    success: function(tokenResponse) {
                                        console.log('Snap token received:', tokenResponse);
                                        if (tokenResponse.snap_token) {
                                            window.snap.pay(tokenResponse.snap_token, {
                                                onSuccess: function(result) {
                                                    console.log('Payment success:', result);
                                                    window.location.href = "{{ url('/pesanan') }}/" + response.order_id + "?success=1";
                                                },
                                                onPending: function(result) {
                                                    console.log('Payment pending:', result);
                                                    window.location.href = "{{ url('/pesanan') }}/" + response.order_id;
                                                },
                                                onError: function(result) {
                                                    console.error('Payment error:', result);
                                                    alert('Pembayaran gagal, silakan coba lagi.');
                                                    window.location.reload();
                                                },
                                                onClose: function() {
                                                    console.log('Customer closed the popup without finishing the payment');
                                                    alert('Anda menutup popup sebelum menyelesaikan pembayaran. Anda dapat membayar nanti di halaman detail pesanan.');
                                                    window.location.href = "{{ url('/pesanan') }}/" + response.order_id;
                                                }
                                            });
                                        } else {
                                            console.error('Failed to get snap token from response');
                                            alert('Gagal mendapatkan token pembayaran.');
                                            submitBtn.prop('disabled', false).removeClass('opacity-70').html('Selesaikan Pesanan');
                                        }
                                    },
                                    error: function(xhr) {
                                        console.error('Error fetching snap token:', xhr.responseText);
                                        alert('Terjadi kesalahan saat memproses pembayaran.');
                                        submitBtn.prop('disabled', false).removeClass('opacity-70').html('Selesaikan Pesanan');
                                    }
                                });
                            } else {
                                console.error('Order creation failed:', response);
                                alert(response.message || 'Gagal membuat pesanan.');
                                submitBtn.prop('disabled', false).removeClass('opacity-70').html('Selesaikan Pesanan');
                            }
                        },
                        error: function(xhr) {
                            console.error('Error processing checkout:', xhr.responseText);
                            let errorMsg = 'Terjadi kesalahan saat memproses data pesanan.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMsg += '\n' + xhr.responseJSON.message;
                            }
                            alert(errorMsg);
                            submitBtn.prop('disabled', false).removeClass('opacity-70').html('Selesaikan Pesanan');
                        }
                    });
                } else {
                    console.log('Normal form submission for method:', paymentMethod);
                }
            });
        });
    </script>


</body>
</html>

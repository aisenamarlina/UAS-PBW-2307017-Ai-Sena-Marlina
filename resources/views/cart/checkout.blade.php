<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - CLC LUXE</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root { 
            --leather-dark: #3e2723; --leather-medium: #8b5e3c; --leather-light: #b08d57;
            --cream-bg: #fcfaf8; --white: #ffffff; 
        }
        body { background: var(--cream-bg); font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; padding: 20px; color: var(--leather-dark); }
        
        .checkout-container { max-width: 1100px; margin: 40px auto; display: grid; grid-template-columns: 1.5fr 1fr; gap: 30px; }
        .card { background: white; border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
        
        h2 { font-family: 'Playfair Display', serif; font-size: 2rem; margin-top: 0; }
        h3 { font-size: 1.2rem; border-bottom: 2px solid #f8f8f8; padding-bottom: 15px; margin-bottom: 20px; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 700; margin-bottom: 8px; font-size: 0.9rem; }
        .form-group input, .form-group textarea { 
            width: 100%; padding: 12px; border: 1px solid #eee; border-radius: 10px; 
            font-family: inherit; box-sizing: border-box; background: #fafafa;
        }

        .order-item { display: flex; align-items: center; gap: 15px; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f0f0f0; }
        .order-item img { width: 70px; height: 70px; border-radius: 12px; object-fit: cover; }
        .item-info { flex: 1; }
        .item-info h4 { margin: 0; font-size: 1rem; margin-bottom: 8px; }

        .quantity-control { display: flex; align-items: center; gap: 10px; }
        .btn-qty { 
            background: #eee; border: none; width: 28px; height: 28px; border-radius: 8px; 
            cursor: pointer; display: flex; align-items: center; justify-content: center; 
            font-size: 0.8rem; transition: 0.2s; 
        }
        .btn-qty:hover { background: var(--leather-light); color: white; }
        .qty-input { width: 30px; text-align: center; border: none; background: transparent; font-weight: 700; font-size: 0.9rem; }

        .payment-option { 
            border: 2px solid #eee; border-radius: 12px; padding: 15px; 
            display: flex; align-items: center; gap: 15px; cursor: pointer; transition: 0.3s;
        }
        .payment-option.active { border-color: var(--leather-dark); background: #fdfaf8; }

        .summary-row { display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 0.95rem; }
        .total-row { display: flex; justify-content: space-between; margin-top: 20px; padding-top: 20px; border-top: 2px solid #eee; font-weight: 800; font-size: 1.3rem; }

        .btn-confirm { 
            width: 100%; padding: 18px; background: var(--leather-dark); color: white; border: none; 
            border-radius: 12px; font-weight: 700; font-size: 1rem; cursor: pointer; transition: 0.3s; margin-top: 20px;
        }
        .btn-confirm:hover { background: var(--leather-medium); transform: translateY(-2px); }

        .nav-links { display: flex; flex-direction: column; gap: 10px; margin-top: 20px; text-align: center; }
        .link-item { text-decoration: none; color: #888; font-size: 0.9rem; transition: 0.3s; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .link-item:hover { color: var(--leather-medium); }

        /* Style untuk tombol Dashboard khusus di notifikasi atau navigasi */
        .btn-dashboard { color: var(--leather-medium); font-weight: 700; }

        @media (max-width: 850px) { .checkout-container { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

    <form id="checkout-form" action="{{ route('cart.process') }}" method="POST">
        @csrf
        <div class="checkout-container">
            <div class="card">
                <h2>Lengkapi Pesanan</h2>
                
                <h3><i class="fas fa-map-marker-alt"></i> Alamat Pengiriman</h3>
                <div class="form-group">
                    <label>Nama Penerima</label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}" required>
                </div>
                <div class="form-group">
                    <label>Nomor WhatsApp</label>
                    <input type="tel" name="phone" required placeholder="08...">
                </div>
                <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <textarea name="address" rows="3" required></textarea>
                </div>

                <h3><i class="fas fa-wallet"></i> Metode Pembayaran</h3>
                <div class="payment-option active">
                    <input type="radio" name="payment_method" value="COD" checked id="cod">
                    <label for="cod" style="cursor: pointer;">
                        <strong>Bayar di Tempat (COD)</strong><br>
                        <small>Bayar saat barang sampai</small>
                    </label>
                    <i class="fas fa-truck-fast" style="margin-left: auto; color: var(--leather-medium); font-size: 1.5rem;"></i>
                </div>
            </div>

            <div class="card" style="height: fit-content;">
                <h3>Ringkasan Belanja</h3>
                
                <div class="order-list">
                    @php 
                        $total = 0; 
                        $onlyId = request()->query('only');
                        $displayItems = ($onlyId && isset($cart[$onlyId])) 
                                        ? [$onlyId => $cart[$onlyId]] 
                                        : $cart;
                    @endphp

                    @foreach($displayItems as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                    
                    <div class="order-item" data-price="{{ $details['price'] }}">
                        <img src="{{ Str::startsWith($details['image'], ['http://', 'https://']) ? $details['image'] : asset('storage/' . $details['image']) }}" 
                             onerror="this.src='https://via.placeholder.com/150?text=Produk+Kulit'" 
                             alt="{{ $details['name'] }}">
                        
                        <div class="item-info">
                            <h4>{{ $details['name'] }}</h4>
                            <div class="quantity-control">
                                <button type="button" class="btn-qty minus"><i class="fas fa-minus"></i></button>
                                <input type="text" class="qty-input" name="items[{{ $id }}][quantity]" value="{{ $details['quantity'] }}" readonly>
                                <button type="button" class="btn-qty plus"><i class="fas fa-plus"></i></button>
                                <span style="margin-left: auto; font-weight: 700;">
                                    Rp <span class="subtotal-item">{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="summary-details">
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>Rp <span id="grand-subtotal">{{ number_format($total, 0, ',', '.') }}</span></span>
                    </div>
                    <div class="summary-row">
                        <span>Biaya Pengiriman</span>
                        <span style="color: #2ecc71;">Gratis</span>
                    </div>
                    <div class="total-row">
                        <span>Total</span>
                        <span>Rp <span id="grand-total">{{ number_format($total, 0, ',', '.') }}</span></span>
                    </div>
                </div>

                <button type="submit" class="btn-confirm" id="submit-btn">
                    Konfirmasi Pesanan <i class="fas fa-arrow-right" style="margin-left: 10px;"></i>
                </button>
                
                <div class="nav-links">
                    <a href="{{ route('dashboard') }}" class="link-item btn-dashboard">
                        <i class="fas fa-columns"></i> Ke Dashboard 
                    </a>
                    <a href="{{ route('cart.index') }}" class="link-item">
                        <i class="fas fa-chevron-left"></i> Kembali ke Keranjang
                    </a>

                </div>
            </div>
        </div>
    </form>

    <script>
        // Logika Update Quantity (Tetap sama seperti kode awal Anda)
        document.querySelectorAll('.btn-qty').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const row = this.closest('.order-item');
                const input = row.querySelector('.qty-input');
                const price = parseInt(row.getAttribute('data-price'));
                let qty = parseInt(input.value);

                if (this.classList.contains('plus')) {
                    qty++;
                } else if (this.classList.contains('minus') && qty > 1) {
                    qty--;
                }

                input.value = qty;
                row.querySelector('.subtotal-item').innerText = (price * qty).toLocaleString('id-ID');
                updateGrandTotal();
            });
        });

        function updateGrandTotal() {
            let total = 0;
            document.querySelectorAll('.order-item').forEach(row => {
                const price = parseInt(row.getAttribute('data-price'));
                const qty = parseInt(row.querySelector('.qty-input').value);
                total += price * qty;
            });
            document.getElementById('grand-subtotal').innerText = total.toLocaleString('id-ID');
            document.getElementById('grand-total').innerText = total.toLocaleString('id-ID');
        }

        // --- NOTIFIKASI BERHASIL CHECKOUT ---
        const form = document.getElementById('checkout-form');
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Kita simulasi sukses dulu untuk demo visual atau tangkap setelah submit
            
            Swal.fire({
                title: 'Pesanan Berhasil!',
                text: 'Terima kasih! Pesanan Anda sedang kami proses. Poin loyalitas Anda akan segera bertambah.',
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3e2723',
                cancelButtonColor: '#8b5e3c',
                confirmButtonText: '<i class="fas fa-columns"></i> Ke Dashboard',
                cancelButtonText: 'Tetap di Sini',
                background: '#fcfaf8',
                color: '#3e2723',
                backdrop: `rgba(62, 39, 35, 0.4)`
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('dashboard') }}";
                } else {
                    form.submit(); // Lanjutkan proses ke server
                }
            });
        });

        // Tampilkan notifikasi jika ada Session Success dari Laravel
        @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#3e2723'
            });
        @endif
    </script>
</body>
</html>
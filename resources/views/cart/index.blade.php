<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - CLC LUXE</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { 
            --leather-dark: #3e2723; 
            --leather-medium: #5d4037;
            --leather-light: #8b5e3c;
            --accent-gold: #b08d57;
            --bg-soft: #fcfaf8;
        }

        body { 
            background: var(--bg-soft); 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            color: var(--leather-dark); 
            margin: 0; 
            padding: 40px 20px; 
        }

        .cart-container { 
            max-width: 1200px; 
            margin: 0 auto; 
            display: grid; 
            grid-template-columns: 2fr 1fr; 
            gap: 30px; 
        }

        .card { 
            background: white; 
            border-radius: 20px; 
            padding: 30px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.03); 
        }

        h2 { font-size: 1.8rem; margin-top: 0; margin-bottom: 30px; display: flex; align-items: center; gap: 12px; }

        table { width: 100%; border-collapse: collapse; }
        thead { background: #fdfaf7; }
        th { text-align: left; padding: 15px; color: var(--leather-light); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px; }
        td { padding: 20px 15px; border-bottom: 1px solid #f0f0f0; }

        .item-checkbox { 
            width: 20px; 
            height: 20px; 
            accent-color: var(--leather-medium); 
            cursor: pointer; 
        }

        .prod-info { display: flex; align-items: center; gap: 15px; }
        .prod-info img { width: 80px; height: 80px; border-radius: 12px; object-fit: cover; background: #fafafa; }
        .prod-info h4 { margin: 0; font-size: 1rem; }

        .qty-wrapper { 
            display: flex; 
            align-items: center; 
            border: 1px solid #eee; 
            border-radius: 8px; 
            width: fit-content;
            overflow: hidden;
        }
        .btn-qty { 
            background: none; border: none; padding: 8px 12px; cursor: pointer; 
            color: var(--leather-dark); transition: 0.2s; 
        }
        .btn-qty:hover { background: #f5f5f5; }
        .qty-input { width: 40px; text-align: center; border: none; font-weight: 700; font-family: inherit; outline: none; }

        .summary-item { display: flex; justify-content: space-between; margin-bottom: 15px; color: #666; }
        .total-row { 
            border-top: 2px solid #f8f5f2; 
            margin-top: 20px; 
            padding-top: 20px; 
            font-weight: 800; 
            font-size: 1.3rem; 
            color: var(--leather-dark);
        }

        .btn-checkout { 
            width: 100%; 
            background: var(--leather-medium); 
            color: white; 
            border: none; 
            padding: 18px; 
            border-radius: 12px; 
            font-weight: 700; 
            font-size: 1rem; 
            cursor: pointer; 
            margin-top: 25px;
            transition: 0.3s;
        }
        .btn-checkout:hover { background: var(--leather-dark); transform: translateY(-2px); }
        .btn-checkout:disabled { background: #ccc; cursor: not-allowed; transform: none; }

        .btn-back { 
            display: flex; align-items: center; justify-content: center; gap: 8px;
            margin-top: 15px; text-decoration: none; color: #888; font-size: 0.9rem; font-weight: 600;
        }
        .btn-back:hover { color: var(--leather-light); }

        .remove-link { color: #ff7675; text-decoration: none; font-size: 0.8rem; display: block; margin-top: 5px; background: none; border: none; padding: 0; cursor: pointer; }

        @media (max-width: 992px) {
            .cart-container { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="cart-container">
    <div class="card">
        <h2><i class="fas fa-shopping-bag"></i> Keranjang Belanja</h2>
        
        @if(session('cart') && count(session('cart')) > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 40px;"><input type="checkbox" id="check-all" class="item-checkbox"></th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $id => $details)
                <tr class="cart-row" data-id="{{ $id }}" data-price="{{ $details['price'] }}">
                    <td>
                        <input type="checkbox" class="item-checkbox product-checkbox">
                    </td>
                    <td>
                        <div class="prod-info">
                            <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" onerror="this.src='https://via.placeholder.com/80?text=Produk'">
                            <div>
                                <h4>{{ $details['name'] }}</h4>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="remove-link">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td>Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                    <td>
                        <div class="qty-wrapper">
                            <button class="btn-qty minus"><i class="fas fa-minus"></i></button>
                            <input type="text" class="qty-input" value="{{ $details['quantity'] }}" readonly>
                            <button class="btn-qty plus"><i class="fas fa-plus"></i></button>
                        </div>
                    </td>
                    <td style="font-weight: 700;">Rp <span class="subtotal-text">{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div style="text-align:center; padding: 40px;">
            <p>Keranjang Anda kosong.</p>
            <a href="{{ route('products.index') }}" class="btn-back">Mulai Belanja</a>
        </div>
        @endif
    </div>

    <div class="card" style="height: fit-content;">
        <h3>Ringkasan Pesanan</h3>
        <div class="summary-item">
            <span>Barang Dipilih</span>
            <span id="selected-count">0 Produk</span>
        </div>
        <div class="summary-item">
            <span>Pengiriman</span>
            <span style="color: #2ecc71;">Gratis</span>
        </div>
        
        <div class="total-row">
            <span>Total</span>
            <span>Rp <span id="grand-total">0</span></span>
        </div>

        <form action="{{ route('cart.checkout') }}" method="GET" id="checkout-form">
            <input type="hidden" name="selected_items" id="selected-items-input">
            <button type="submit" class="btn-checkout" id="btn-checkout" disabled>Checkout Sekarang</button>
        </form>

        <a href="{{ route('products.index') }}" class="btn-back">
            <i class="fas fa-shopping-cart"></i> Lanjut Belanja
        </a>

        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fas fa-user"></i> Kembali ke Dashboard
        </a>
    </div>
</div>

<script>
    const productCheckboxes = document.querySelectorAll('.product-checkbox');
    const checkAll = document.getElementById('check-all');
    const btnCheckout = document.getElementById('btn-checkout');

    function updateGrandTotal() {
        let total = 0;
        let count = 0;
        let selectedIds = [];

        document.querySelectorAll('.cart-row').forEach(row => {
            const checkbox = row.querySelector('.product-checkbox');
            const price = parseInt(row.getAttribute('data-price'));
            const qty = parseInt(row.querySelector('.qty-input').value);
            const subtotal = price * qty;

            row.querySelector('.subtotal-text').innerText = subtotal.toLocaleString('id-ID');

            if (checkbox.checked) {
                total += subtotal;
                count++;
                selectedIds.push(row.getAttribute('data-id'));
            }
        });

        document.getElementById('grand-total').innerText = total.toLocaleString('id-ID');
        document.getElementById('selected-count').innerText = count + ' Produk';
        document.getElementById('selected-items-input').value = JSON.stringify(selectedIds);
        
        btnCheckout.disabled = (count === 0);
    }

    document.querySelectorAll('.btn-qty').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('.cart-row');
            const input = row.querySelector('.qty-input');
            let qty = parseInt(input.value);

            if (this.classList.contains('plus')) {
                qty++;
            } else if (this.classList.contains('minus') && qty > 1) {
                qty--;
            }

            input.value = qty;
            updateGrandTotal();
        });
    });

    productCheckboxes.forEach(cb => {
        cb.addEventListener('change', updateGrandTotal);
    });

    checkAll.addEventListener('change', function() {
        productCheckboxes.forEach(cb => cb.checked = this.checked);
        updateGrandTotal();
    });

    updateGrandTotal();
</script>

</body>
</html>
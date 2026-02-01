<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - Creating LC</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root { 
            --leather-dark: #3e2723; --leather-medium: #8b5e3c; --leather-light: #b08d57;
            --cream-bg: #fcfaf8; --white: #ffffff; 
            --sidebar-w: 260px;
            --sidebar-collapsed-w: 80px;
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: var(--cream-bg); color: #2d241e; overflow-x: hidden; }

        /* Sidebar */
        .sidebar-custom { 
            width: var(--sidebar-w); height: 100vh; position: fixed; left: 0; top: 0; 
            background: var(--white); display: flex; flex-direction: column; 
            border-right: 1px solid #efeae6; transition: var(--transition); z-index: 1000; 
        }
        .sidebar-custom.collapsed { width: var(--sidebar-collapsed-w); }
        .brand { height: 100px; display: flex; align-items: center; padding: 0 25px; }
        .brand-logo { height: 45px; width: auto; object-fit: contain; }
        .menu-text { margin-left: 12px; font-weight: 800; white-space: nowrap; transition: opacity .3s; color: #1f2937; }
        .sidebar-custom.collapsed .menu-text { opacity: 0; pointer-events: none; }

        .nav-item-custom { 
            display: flex; align-items: center; padding: 14px 20px; margin: 6px 15px; 
            border-radius: 12px; color: #64748b; text-decoration: none; transition: var(--transition); 
        }
        .nav-item-custom i { min-width: 32px; font-size: 1.2rem; }
        .nav-item-custom.active { 
            background: linear-gradient(135deg, #78350f, #451a03); 
            color: var(--white); box-shadow: 0 10px 15px -3px rgba(120, 53, 15, 0.3); 
        }
        .nav-item-custom:hover:not(.active) { background: #f1f5f9; color: var(--leather-dark); }

        /* Main Content */
        .main-wrapper-custom { margin-left: var(--sidebar-w); transition: var(--transition); min-height: 100vh; }
        .main-wrapper-custom.expanded { margin-left: var(--sidebar-collapsed-w); }

        .navbar { 
            background: var(--white); padding: 15px 40px; display: flex; 
            justify-content: space-between; align-items: center; 
            border-bottom: 1px solid #efeae6; position: sticky; top: 0; z-index: 999;
        }
        .toggle-btn { 
            width: 40px; height: 40px; border: 1px solid #efeae6; border-radius: 10px; 
            background: white; cursor: pointer; color: var(--leather-dark);
        }

        .container { max-width: 1100px; margin: 40px auto; padding: 0 20px; }

        .search-container {
            background: white; padding: 40px 30px; border-radius: 30px;
            border: 1px solid #efeae6; margin-bottom: 30px; text-align: center;
        }
        .search-container h2 { font-family: 'Playfair Display', serif; font-size: 2.2rem; color: var(--leather-dark); }
        .search-form { display: flex; gap: 12px; max-width: 600px; margin: 20px auto 0; }
        .search-input { flex: 1; padding: 12px 20px; border-radius: 12px; border: 1.5px solid #f1ece7; outline: none; }
        .btn-search { background: var(--leather-dark); color: white; padding: 0 25px; border: none; border-radius: 12px; cursor: pointer; }

        .category-tabs { display: flex; justify-content: center; gap: 10px; margin-bottom: 40px; }
        .category-tab { text-decoration: none; padding: 8px 20px; background: white; border: 1.5px solid #efeae6; border-radius: 50px; color: #8d8d8d; font-size: 0.75rem; font-weight: 700; }
        .category-tab.active { background: var(--leather-dark); color: white; }

        /* Product Cards */
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px; }
        .product-card { background: white; border-radius: 20px; overflow: hidden; border: 1px solid #efeae6; transition: 0.4s; position: relative; }
        .product-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(62, 39, 35, 0.08); }
        .product-img-wrapper { width: 100%; height: 300px; background: #f8f8f8; position: relative; overflow: hidden; }
        .product-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s; }
        .product-card:hover .product-img { transform: scale(1.1); }
        
        .product-info { padding: 25px 20px; text-align: center; }
        .product-info h3 { font-size: 1.1rem; color: var(--leather-dark); margin-bottom: 8px; font-weight: 700; }
        .price { color: var(--leather-medium); font-weight: 800; display: block; margin-bottom: 20px; font-size: 1.2rem; }
        
        /* Button Group */
        .btn-group { display: flex; align-items: center; gap: 12px; width: 100%; }
        .btn-cart { 
            background: #f8f5f2; color: var(--leather-dark); border: 1.5px solid #efeae6; 
            width: 48px; height: 48px; border-radius: 12px; cursor: pointer; 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); display: flex; align-items: center; justify-content: center; font-size: 1.1rem;
        }
        .btn-cart:hover { background: var(--leather-light); color: white; border-color: var(--leather-light); transform: rotate(-10deg); }

        .btn-detail { 
            flex: 1; height: 48px; background: linear-gradient(135deg, var(--leather-dark), #5d4037); 
            color: white; text-decoration: none; border-radius: 12px; font-weight: 700; 
            border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; 
            gap: 8px; transition: all 0.3s ease; font-size: 0.85rem; letter-spacing: 0.5px; text-transform: uppercase;
        }
        .btn-detail:hover { background: linear-gradient(135deg, #5d4037, var(--leather-dark)); box-shadow: 0 8px 20px rgba(62, 39, 35, 0.25); transform: translateY(-2px); }

        /* Notification Toast */
        .toast-notif {
            position: fixed; bottom: 30px; right: 30px; background: #2d3436; color: white;
            padding: 16px 28px; border-radius: 16px; box-shadow: 0 15px 30px rgba(0,0,0,0.15);
            display: flex; align-items: center; gap: 12px; z-index: 9999;
            transform: translateY(150px); opacity: 0; transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        .toast-notif.show { transform: translateY(0); opacity: 1; }
        .toast-notif i { color: #00b894; font-size: 1.2rem; }

        @media (max-width: 768px) {
            .sidebar-custom { transform: translateX(-100%); }
            .sidebar-custom.show { transform: translateX(0); }
            .main-wrapper-custom, .main-wrapper-custom.expanded { margin-left: 0; }
        }
    </style>
</head>
<body>

<div id="toast" class="toast-notif">
    <i class="fas fa-check-circle"></i>
    <span>Produk berhasil ditambahkan!</span>
</div>

<aside class="sidebar-custom" id="sidebar">
    <div class="brand">
        <img src="{{ asset('img/logo png.png') }}" alt="Logo" class="brand-logo">
        <span class="menu-text">CREATING LC</span>
    </div>

    <nav style="flex:1; padding-top: 10px;">
        <a href="/dashboard" class="nav-item-custom">
            <i class="fas fa-columns"></i>
            <span class="menu-text">Dashboard</span>
        </a>
        <a href="{{ route('products.index') }}" class="nav-item-custom active">
            <i class="fas fa-th-large"></i>
            <span class="menu-text">Katalog</span>
        </a>
        <a href="{{ route('cart.index') }}" class="nav-item-custom">
            <i class="fas fa-shopping-cart"></i>
            <span class="menu-text">Keranjang</span>
        </a>
        <a href="{{ route('chats.index', ['receiver_id' => 1]) }}" class="nav-item-custom">
            <i class="fas fa-comment-dots"></i>
            <span class="menu-text">Pesan Chat</span>
        </a>
        <a href="{{ route('orders.my_orders') }}" class="nav-item-custom">
            <i class="fas fa-truck-loading"></i>
            <span class="menu-text">Pesanan Saya</span>
        </a>
        <a href="{{ route('user.profile') }}" class="nav-item-custom">
            <i class="fas fa-user-circle"></i>
            <span class="menu-text">Akun Saya</span>
        </a>
        <a href="/" class="nav-item-custom">
            <i class="fas fa-home"></i>
            <span class="menu-text">Beranda</span>
        </a>
    </nav>

    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
        @csrf
        <button type="submit" class="nav-item-custom" style="color:#ef4444; margin-bottom: 25px; border:none; background:none; width:calc(100% - 30px); cursor:pointer; text-align:left;">
            <i class="fas fa-sign-out-alt"></i><span class="menu-text">Keluar</span>
        </button>
    </form>
</aside>

<main class="main-wrapper-custom" id="main-content">
    <nav class="navbar">
        <button id="toggle-btn" class="toggle-btn"><i class="fas fa-bars"></i></button>
        <div class="nav-links">
             <span style="font-weight:700; color:var(--leather-medium); font-size: 0.8rem; text-transform: uppercase;">Katalog Koleksi User</span>
        </div>
    </nav>

    <div class="container">
        <div class="search-container">
            <h2>Creating Leather Craft</h2>
            <p>Eksplorasi keindahan kulit asli dalam setiap detail jahitan tangan.</p>
            <form action="" method="GET" class="search-form">
                <input type="text" name="search" class="search-input" placeholder="Cari produk..." value="{{ request('search') }}">
                <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <div class="category-tabs">
            <a href="#" class="category-tab active">Semua</a>
            <a href="#" class="category-tab">Dompet</a>
            <a href="#" class="category-tab">ID Card</a>
            <a href="#" class="category-tab">Aksesoris</a>
        </div>

        <div class="product-grid" id="main-product-grid">
            @php
                $products = [
                    ['id' => 1, 'name' => 'Dompet Panjang Pria', 'price' => '200.000', 'img' => 'dompetp-68f4b246ed64152b57732dd2.jpg?t=o&v=770', 'tag' => 'Laris'],
                    ['id' => 2, 'name' => 'Dompet Pendek Pria', 'price' => '125.000', 'img' => 'dompppet-68f4b2a5ed64152e8c73adf2.jpg?t=o&v=770', 'tag' => 'Baru'],
                    ['id' => 3, 'name' => 'ID Card Kulit', 'price' => '100.000', 'img' => 'id-68f4b2f434777c3d8a5035a2.jpg?t=o&v=770', 'tag' => 'Premium'],
                    ['id' => 4, 'name' => 'Gantungan Kunci & STNK', 'price' => '125.000', 'img' => 'dompettt-68f4b34934777c43a6172872.jpg?t=o&v=770', 'tag' => 'Best Seller'],
                    ['id' => 5, 'name' => 'Tempat Kartu / Card Holder', 'price' => '80.000', 'img' => 'dompetk-68f4b43ec925c47cd01e3082.jpg?t=o&v=770', 'tag' => 'Terpopuler'],
                    ['id' => 6, 'name' => 'Gantungan Kunci', 'price' => '50.000', 'img' => 'gantungann-68f4b51dc925c404b611bfc3.jpg?t=o&v=740&x=416', 'tag' => 'Handmade'],
                ];
            @endphp

            @foreach($products as $p)
            <div class="product-card">
                <div style="position: absolute; top: 15px; left: 15px; background: #8b5e3c; color: white; padding: 4px 12px; border-radius: 6px; font-size: 0.65rem; font-weight: 800; z-index: 2; text-transform: uppercase;">
                    {{ $p['tag'] }}
                </div>
                <div class="product-img-wrapper" style="background: #fdfaf7; display: flex; align-items: center; justify-content: center; padding: 25px;">
                    <img src="https://assets.kompasiana.com/items/album/2025/10/19/{{ $p['img'] }}" 
                         class="product-img" alt="{{ $p['name'] }}" style="width: 100%; height: 100%; object-fit: contain;">
                </div>
                <div class="product-info" style="text-align: left; padding: 20px;">
                    <p style="font-size: 0.7rem; color: #b08d57; margin-bottom: 4px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Genuine Leather</p>
                    <h3 style="font-size: 1.1rem; color: #3e2723; margin-bottom: 10px; font-weight: 800;">{{ $p['name'] }}</h3>
                    <span class="price">Rp {{ $p['price'] }}</span>
                    <div class="btn-group">
                        <form action="{{ route('cart.add', $p['id']) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-cart" title="Tambah ke Keranjang"><i class="fas fa-shopping-basket"></i></button>
                        </form>
                        
                        <form action="{{ route('cart.add', $p['id']) }}" method="POST" class="buy-now-form" style="flex:1;">
                            @csrf
                            <button type="submit" class="btn-detail"><i class="fas fa-bolt"></i> Beli Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('toggle-btn');
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('main-content');
        const toast = document.getElementById('toast');

        // Sidebar logic
        btn.addEventListener('click', function () {
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('show');
            } else {
                sidebar.classList.toggle('collapsed');
                main.classList.toggle('expanded');
            }
        });

        function showToast(message) {
            toast.querySelector('span').innerText = message;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 3000);
        }

        // Logic AJAX
        const allForms = document.querySelectorAll('form[action*="cart/add"]');
        
        allForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); 
                
                const token = this.querySelector('input[name="_token"]').value;
                const isBuyNow = this.classList.contains('buy-now-form');

                fetch(this.action, {
                    method: 'POST',
                    body: new FormData(this),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': token
                    }
                })
                .then(response => {
                    // Cek jika response sukses (biasanya 200)
                    if (isBuyNow) {
                        // PERBAIKAN DI SINI: Menggunakan 'cart.checkout' sesuai web.php Anda
                        window.location.href = "{{ route('cart.checkout') }}"; 
                    } else {
                        showToast("Produk berhasil masuk keranjang!");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast("Terjadi kesalahan, coba lagi.");
                });
            });
        });
    });
</script>
</body>
</html>
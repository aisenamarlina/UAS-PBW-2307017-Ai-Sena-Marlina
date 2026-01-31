<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Creating LC</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    
    <style>
        :root { 
            --leather-dark: #3e2723; --leather-medium: #8b5e3c; --leather-light: #b08d57;
            --cream-bg: #fcfaf8; --white: #ffffff; 
        }
        body { background: var(--cream-bg); font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; padding: 20px; }
        
        /* Navbar Simple */
        .navbar-detail { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; max-width: 1000px; margin: 0 auto 20px auto; }
        .brand-logo { width: 45px; height: 45px; object-fit: contain; }
        .menu-text { font-weight: 800; color: var(--leather-dark); letter-spacing: 1px; }

        .detail-container { 
            max-width: 1000px; margin: 20px auto; background: white; 
            border-radius: 30px; display: flex; overflow: hidden; 
            box-shadow: 0 20px 40px rgba(0,0,0,0.05); 
        }
        .product-image { width: 50%; background: #f8f8f8; }
        .product-image img { width: 100%; height: 100%; object-fit: cover; }
        .product-info { width: 50%; padding: 50px; }
        .category { color: var(--leather-light); font-weight: 800; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 2px; }
        .product-info h1 { font-family: 'Playfair Display', serif; font-size: 2.5rem; color: var(--leather-dark); margin: 10px 0; }
        .price { font-size: 1.8rem; color: var(--leather-medium); font-weight: 700; margin-bottom: 30px; display: block; }
        .description { color: #666; line-height: 1.8; margin-bottom: 30px; }
        .specs { border-top: 1px solid #eee; padding-top: 20px; margin-bottom: 30px; }
        .spec-item { margin-bottom: 10px; font-size: 0.9rem; }
        .spec-item strong { color: var(--leather-dark); width: 100px; display: inline-block; }
        
        .action-buttons { display: flex; gap: 15px; margin-top: 20px; flex-wrap: wrap; }
        .btn-cart { 
            flex: 1; padding: 15px; border: 2px solid var(--leather-dark); 
            background: transparent; color: var(--leather-dark); 
            border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.3s;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            text-decoration: none;
        }
        .btn-buy { 
            flex: 1; padding: 15px; border: none; 
            background: var(--leather-dark); color: white; 
            border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.3s;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            text-decoration: none;
        }
        /* Style Tambahan untuk Tombol Chat */
        .btn-chat {
            flex-basis: 100%; padding: 12px; border: none;
            background: #25d366; color: white;
            border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.3s;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            text-decoration: none; margin-top: 5px;
        }

        .btn-cart:hover { background: #f5efeb; }
        .btn-buy:hover { background: var(--leather-medium); }
        .btn-chat:hover { background: #1eb954; }

        .btn-back { 
            display: inline-block; margin-top: 30px; text-decoration: none; 
            color: var(--leather-dark); font-weight: 700; 
        }
        .alert-success { background: #2ecc71; color: white; padding: 15px; text-align: center; border-radius: 10px; margin-bottom: 20px; max-width: 1000px; margin-left: auto; margin-right: auto; }

        @media (max-width: 768px) { .detail-container { flex-direction: column; } .product-image, .product-info { width: 100%; } .navbar-detail { justify-content: center; } }
    </style>
</head>
<body>
    <div class="navbar-detail">
        <img src="{{ asset('img/logo png.png') }}" alt="Logo" class="brand-logo">
        <span class="menu-text" style="font-size: 1.1rem;">CREATING LC</span>
    </div>

    @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="detail-container">
        <div class="product-image">
            @php
                $name = strtolower($product->name);
                if (str_contains($name, 'panjang')) {
                    $imgUrl = 'https://assets.kompasiana.com/items/album/2025/10/19/dompetp-68f4b246ed64152b57732dd2.jpg?t=o&v=740&x=416';
                } elseif (str_contains($name, 'pendek')) {
                    $imgUrl = 'https://assets.kompasiana.com/items/album/2025/10/19/dompppet-68f4b2a5ed64152e8c73adf2.jpg?t=o&v=740&x=416';
                } elseif (str_contains($name, 'id card')) {
                    $imgUrl = 'https://assets.kompasiana.com/items/album/2025/10/19/id-68f4b2f434777c3d8a5035a2.jpg?t=o&v=740&x=416';
                } elseif (str_contains($name, 'stnk')) {
                    $imgUrl = 'https://assets.kompasiana.com/items/album/2025/10/19/dompettt-68f4b34934777c43a6172872.jpg?t=o&v=740&x=416';
                } elseif (str_contains($name, 'holder') || str_contains($name, 'kunci')) {
                    $imgUrl = 'https://assets.kompasiana.com/items/album/2025/10/19/dompetk-68f4b43ec925c47cd01e3082.jpg?t=o&v=740&x=416';
                } else {
                    $imgUrl = asset('storage/' . $product->image);
                }
            @endphp
            <img src="{{ $imgUrl }}" alt="{{ $product->name }}">
        </div>
        
        <div class="product-info">
            <span class="category">{{ $product->category ?? 'Handmade Leather' }}</span>
            <h1>{{ $product->name }}</h1>
            <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            
            <p class="description">{{ $product->description }}</p>

            <div class="specs">
                <div class="spec-item"><strong>Material</strong> {{ $product->material ?? 'Kulit Sapi Asli' }}</div>
                <div class="spec-item"><strong>Dimensi</strong> {{ $product->dimensions ?? '-' }}</div>
            </div>

            <div class="action-buttons">
                <form action="{{ route('cart.add', $product->id) }}" method="POST" style="flex: 1; display: flex;">
                    @csrf
                    <button type="submit" class="btn-cart" style="width: 100%;">
                        <i class="fas fa-cart-plus"></i> Keranjang
                    </button>
                </form>

                <form action="{{ route('cart.add', $product->id) }}" method="POST" style="flex: 1; display: flex;">
                    @csrf
                    <input type="hidden" name="redirect" value="cart">
                    <button type="submit" class="btn-buy" style="width: 100%;">
                        <i class="fas fa-shopping-bag"></i> Beli Sekarang
                    </button>
                </form>

                @php $adminId = 1; // Sesuaikan ID Admin Anda @endphp
                <a href="{{ route('chats.index', ['receiver_id' => $adminId]) }}" class="btn-chat">
                    <i class="fas fa-comment-dots"></i> Chat dengan Penjual
                </a>
            </div>

            <a href="{{ route('products.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali ke Katalog
            </a>
        </div>
    </div>
</body>
</html>
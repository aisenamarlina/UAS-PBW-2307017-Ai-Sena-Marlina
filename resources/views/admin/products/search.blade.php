<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Produk Baru - CLC LUXE</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root { 
            --leather-dark: #3e2723; 
            --leather-medium: #8b5e3c;
            --leather-light: #b08d57;
            --cream-bg: #fcfaf8; 
            --white: #ffffff; 
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: var(--cream-bg); color: #2d241e; }

        /* Navbar (Konsisten) */
        .navbar { 
            background: var(--white); padding: 15px 8%; display: flex; 
            justify-content: space-between; align-items: center; 
            border-bottom: 1px solid #efeae6; position: sticky; top: 0; z-index: 1000;
        }
        .logo { font-family: 'Playfair Display', serif; font-weight: 800; font-size: 1.5rem; color: var(--leather-dark); text-decoration: none; }
        .logo span { color: var(--leather-light); }

        .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }

        /* Search Section */
        .search-wrapper {
            background: var(--white);
            padding: 40px;
            border-radius: 30px;
            border: 1px solid #efeae6;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(62, 39, 35, 0.03);
        }

        .search-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--leather-dark);
            margin-bottom: 25px;
            text-align: center;
        }

        .search-box {
            display: flex;
            gap: 15px;
            max-width: 800px;
            margin: 0 auto;
        }

        .input-group {
            flex: 1;
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--leather-light);
        }

        .search-input {
            width: 100%;
            padding: 15px 15px 15px 50px;
            border: 2px solid #f1ece7;
            border-radius: 15px;
            font-size: 1rem;
            outline: none;
            transition: 0.3s;
        }

        .search-input:focus { border-color: var(--leather-medium); }

        .btn-search {
            background: var(--leather-dark);
            color: white;
            padding: 0 30px;
            border: none;
            border-radius: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-search:hover { background: var(--leather-medium); }

        /* Filter Chips */
        .filter-tags {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .tag {
            padding: 8px 20px;
            background: #f5f0ec;
            border-radius: 50px;
            font-size: 0.8rem;
            color: var(--leather-medium);
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .tag:hover, .tag.active {
            background: var(--leather-medium);
            color: white;
        }

        /* Results Grid */
        .results-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }

        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #efeae6;
            transition: 0.4s;
        }

        .product-card:hover { transform: translateY(-10px); }

        .product-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            background: #f9f9f9;
        }

        .product-content { padding: 20px; text-align: center; }
        .product-content h3 { font-family: 'Playfair Display', serif; color: var(--leather-dark); margin-bottom: 10px; }
        .product-price { color: var(--leather-medium); font-weight: 800; margin-bottom: 15px; }

        .btn-detail {
            display: inline-block;
            padding: 10px 20px;
            border: 1px solid var(--leather-medium);
            color: var(--leather-medium);
            text-decoration: none;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-detail:hover { background: var(--leather-medium); color: white; }

        @media (max-width: 600px) {
            .search-box { flex-direction: column; }
            .btn-search { padding: 15px; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="/" class="logo">CLC<span> LUXE</span></a>
        <div class="nav-links" style="display: flex; gap: 20px;">
            <a href="{{ route('products.index') }}" style="text-decoration:none; color:#8d8d8d; font-weight:600; font-size:0.9rem;">KATALOG</a>
            <a href="{{ route('dashboard') }}" style="text-decoration:none; color:#8d8d8d; font-weight:600; font-size:0.9rem;">AKUN SAYA</a>
        </div>
    </nav>

    <div class="container">
        <div class="search-wrapper">
            <h1 class="search-title">Temukan Karya Kulit Impian Anda</h1>
            
            <form action="{{ route('products.index') }}" method="GET" class="search-box">
                <div class="input-group">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" class="search-input" placeholder="Cari tas, dompet, atau aksesoris..." value="{{ request('search') }}">
                </div>
                <button type="submit" class="btn-search">Cari Sekarang</button>
            </form>

            <div class="filter-tags">
                <a href="?category=all" class="tag active">Semua</a>
                <a href="?category=tas" class="tag">Tas Tangan</a>
                <a href="?category=dompet" class="tag">Dompet</a>
                <a href="?category=sabuk" class="tag">Sabuk</a>
                <a href="?category=aksesoris" class="tag">Aksesoris</a>
            </div>
        </div>

        <div class="results-grid">
            @forelse($products as $product)
            <div class="product-card">
                <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://images.unsplash.com/photo-1590739225287-bd26514ca9ba?auto=format&fit=crop&w=500' }}" class="product-img">
                <div class="product-content">
                    <h3>{{ $product->name }}</h3>
                    <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    <a href="{{ route('products.show', $product->id) }}" class="btn-detail">Lihat Detail</a>
                </div>
            </div>
            @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: #a1887f;">
                <i class="fas fa-search-minus fa-3x" style="margin-bottom: 15px; opacity: 0.3;"></i>
                <p>Maaf, produk yang Anda cari tidak ditemukan.</p>
            </div>
            @endforelse
        </div>
    </div>

</body>
</html>
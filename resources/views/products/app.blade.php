@extends('layouts.app')

@section('title', 'Koleksi Global — CLC LUXE')

@section('content')
<style>
:root{
    --dark:#2b1b12;
    --brown:#6b4a2d;
    --gold:#c9a96a;
    --ivory:#fbfaf8;
    --line:#ece6e0;
}

body{
    background:var(--ivory);
    font-family:'Plus Jakarta Sans',sans-serif;
}

/* ===== HERO ===== */
.hero{
    background:
        linear-gradient(rgba(43,27,18,.94),rgba(43,27,18,.94)),
        url('https://www.transparenttextures.com/patterns/leather.png');
    color:#fff;
    padding:90px 0 120px;
    border-radius:0 0 60px 60px;
    text-align:center;
}

.hero h1{
    font-family:'Playfair Display',serif;
    font-weight:700;
    letter-spacing:.5px;
}

.hero p{
    opacity:.8;
}

/* ===== SEARCH ===== */
.filter-wrap{
    margin-top:-60px;
    position:relative;
    z-index:10;
}

.search-box{
    background:#fff;
    border-radius:60px;
    padding:8px;
    border:1px solid var(--line);
    box-shadow:0 20px 45px rgba(0,0,0,.08);
}

.search-box input{
    border:none;
    outline:none;
    font-size:.9rem;
}

.btn-search{
    background:var(--dark);
    color:#fff;
    border-radius:40px;
    padding:10px 28px;
    border:none;
    transition:.3s;
}
.btn-search:hover{
    background:var(--brown);
}

/* ===== CATEGORY ===== */
.category-nav{
    display:flex;
    justify-content:center;
    gap:14px;
    flex-wrap:wrap;
    margin-top:35px;
}

.cat{
    padding:8px 22px;
    font-size:.78rem;
    font-weight:700;
    letter-spacing:.5px;
    border-radius:40px;
    background:#fff;
    border:1px solid var(--line);
    color:var(--dark);
    text-decoration:none;
    transition:.35s;
}

.cat:hover,
.cat.active{
    background:var(--brown);
    color:#fff;
    border-color:var(--brown);
    transform:translateY(-3px);
}

/* ===== CARD ===== */
.card-luxe{
    border:none;
    border-radius:22px;
    background:#fff;
    border:1px solid var(--line);
    overflow:hidden;
    transition:.45s;
}

.card-luxe:hover{
    transform:translateY(-12px);
    box-shadow:0 28px 55px rgba(43,27,18,.12);
}

.img-wrap{
    height:250px;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:28px;
    position:relative;
}

.badge-import{
    position:absolute;
    top:16px;
    left:16px;
    background:var(--dark);
    color:var(--gold);
    font-size:.55rem;
    font-weight:800;
    padding:4px 10px;
    letter-spacing:1px;
    border-radius:4px;
}

.product-title{
    font-family:'Playfair Display',serif;
    font-size:.95rem;
    color:var(--dark);
    min-height:46px;
}

.price small{
    font-size:.6rem;
    letter-spacing:.8px;
}

.price span{
    font-weight:800;
    color:var(--dark);
}

.btn-wish{
    background:transparent;
    border:none;
    font-size:1.1rem;
    opacity:.6;
    transition:.3s;
}
.btn-wish:hover{
    opacity:1;
    transform:scale(1.1);
}
</style>

{{-- HERO --}}
<section class="hero">
    <div class="container">
        <h1 class="display-6 mb-2">Exclusive Global Gallery</h1>
        <p>Kurasi produk premium internasional dengan sentuhan elegan</p>
    </div>
</section>

{{-- SEARCH --}}
<div class="container filter-wrap">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <form method="GET" action="{{ route('products.api') }}">
                <div class="search-box d-flex">
                    <input type="text" name="search"
                        class="form-control px-4"
                        placeholder="Cari koleksi eksklusif..."
                        value="{{ request('search') }}">
                    <button class="btn btn-search">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- CATEGORY --}}
    <div class="category-nav">
        <a href="{{ route('products.api') }}"
           class="cat {{ !request('category') ? 'active' : '' }}">ALL</a>

        <a href="{{ route('products.api',['category'=>"men's clothing"]) }}"
           class="cat {{ request('category')=="men's clothing"?'active':'' }}">
           MEN
        </a>

        <a href="{{ route('products.api',['category'=>"women's clothing"]) }}"
           class="cat {{ request('category')=="women's clothing"?'active':'' }}">
           WOMEN
        </a>

        <a href="{{ route('products.api',['category'=>'jewelery']) }}"
           class="cat {{ request('category')=='jewelery'?'active':'' }}">
           JEWELRY
        </a>

        <a href="{{ route('products.api',['category'=>'electronics']) }}"
           class="cat {{ request('category')=='electronics'?'active':'' }}">
           TECH
        </a>
    </div>

    {{-- GRID --}}
    <div class="row g-4 mt-5">
        @forelse($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card-luxe h-100">
                <div class="img-wrap">
                    <span class="badge-import">IMPORTED</span>
                    <img src="{{ $product['image'] }}"
                         class="img-fluid"
                         style="max-height:100%;object-fit:contain;">
                </div>

                <div class="card-body p-4 pt-0">
                    <small class="text-uppercase text-muted fw-bold"
                           style="font-size:.6rem;letter-spacing:1px">
                        {{ $product['category'] }}
                    </small>

                    <h6 class="product-title mt-2">
                        {{ Str::limit($product['title'],36) }}
                    </h6>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="price">
                            <small class="text-muted d-block">ESTIMATED PRICE</small>
                            <span>
                                Rp {{ number_format($product['price']*15500,0,',','.') }}
                            </span>
                        </div>
                        <button class="btn-wish">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 text-muted">
            <p>Koleksi tidak ditemukan</p>
        </div>
        @endforelse
    </div>
</div>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
@endsection

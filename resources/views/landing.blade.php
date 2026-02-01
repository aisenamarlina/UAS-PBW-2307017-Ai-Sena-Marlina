@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;700&family=Playfair+Display:ital,wght@0,700;1,400&display=swap');

    :root {
        --pure-white: #ffffff;
        --soft-gray: #f8f9fa;
        --deep-black: #1a1a1a;
        --accent-gold: #c5a059;
    }

    /* Animasi Keyframes */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .luxe-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--pure-white);
        color: var(--deep-black);
        overflow-x: hidden;
    }

    /* Alert Success Styling */
    .alert-success {
        background: #27ae60;
        color: white;
        padding: 15px 10%;
        text-align: center;
        font-weight: 700;
        animation: fadeIn 0.5s ease-in;
    }

    /* Hero Section */
    .hero-container {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        min-height: 85vh;
        background: var(--pure-white);
        padding: 40px 10%;
        align-items: center;
        gap: 50px;
    }

    .hero-text {
        display: flex;
        flex-direction: column;
        justify-content: center;
        z-index: 2;
        animation: fadeInUp 1s ease-out forwards;
    }

    .hero-text span {
        display: inline-block;
        background: #e9c46a;
        padding: 5px 15px;
        font-size: 0.75rem;
        font-weight: 700;
        margin-bottom: 20px;
        width: fit-content;
        border-radius: 4px;
    }

    .hero-text h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.5rem, 5vw, 4rem);
        line-height: 1.1;
        margin-bottom: 25px;
        font-weight: 700;
    }

    .hero-text p {
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 35px;
        color: #555;
        max-width: 450px;
    }

    .hero-logo-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        animation: fadeIn 1.5s ease-in-out forwards;
    }

    .hero-logo {
        width: 100%;
        max-width: 550px; 
        height: auto;
        filter: none;
        transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .hero-logo:hover {
        transform: scale(1.05);
    }

    .featured-section {
        background-color: #f8f9fa;
        padding: 100px 10% 120px;
    }

    .section-title {
        text-align: center;
        margin-bottom: 60px;
    }

    .section-title h2 {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        font-weight: 700;
    }

    .product-grid-luxe {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .luxe-card {
        background: white;
        padding: 40px 20px;
        border-radius: 20px;
        text-align: center;
        text-decoration: none;
        color: inherit;
        transition: all 0.4s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        opacity: 0;
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .luxe-card:nth-child(1) { animation-delay: 0.2s; }
    .luxe-card:nth-child(2) { animation-delay: 0.4s; }
    .luxe-card:nth-child(3) { animation-delay: 0.6s; }

    .luxe-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.08);
    }

    .luxe-card .img-holder {
        width: 100%;
        margin-bottom: 40px;
        display: flex;
        justify-content: center;
    }

    .luxe-card img {
        max-width: 85%;
        height: auto;
        object-fit: contain;
    }

    .luxe-card h3 {
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }

    .gold-line {
        width: 60px;
        height: 3px;
        background-color: #d4af37;
        margin-top: auto;
    }

    .btn-dark {
        background: #1a1a1a;
        color: white;
        padding: 16px 40px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        transition: 0.3s;
        display: inline-block;
    }

    .btn-dark:hover {
        background: #e9c46a;
        color: #1a1a1a;
        transform: scale(1.05);
    }

    @media (max-width: 992px) {
        .hero-container { 
            grid-template-columns: 1fr; 
            text-align: center; 
            padding: 60px 5%;
        }
        .hero-text { align-items: center; order: 2; }
        .hero-logo-wrapper { order: 1; margin-bottom: 30px; }
        .hero-logo { max-width: 320px; }
        .product-grid-luxe { grid-template-columns: 1fr; }
    }
</style>

<div class="luxe-page">
    {{-- BAGIAN NOTIFIKASI SUKSES --}}
    @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <section class="hero-container">
        <div class="hero-text">
            <span>The Art of Leathercraft</span>
            <h1>Eksplorasi Kemewahan<br>Kulit Asli Garut</h1>
            <p>Mendefinisikan kemewahan lewat kerajinan tangan. Produk kulit asli premium dari Garut, dirancang untuk melengkapi gaya hidup modern Anda.</p>
            
        </div>
        
        <div class="hero-logo-wrapper">
            <img src="{{ asset('img/Gemini_Generated_Image_8ankv18ankv18ank.png') }}" alt="Creating Leather Craft Logo" class="hero-logo">
        </div>
    </section>

    <div class="featured-section">
        <div class="section-title">
            <h2>Koleksi Unggulan</h2>
        </div>

        <div class="product-grid-luxe">
            <a href="{{ route('products.show', 1) }}" class="luxe-card">
                <div class="img-holder">
                    <img src="https://assets.kompasiana.com/items/album/2025/10/19/dompetp-68f4b246ed64152b57732dd2.jpg?t=o&v=740&x=416" alt="Dompet Panjang Pria">
                </div>
                <h3>Dompet Panjang Pria</h3>
                <div class="gold-line"></div>
            </a>

            <a href="{{ route('products.show', 2) }}" class="luxe-card">
                <div class="img-holder">
                    <img src="https://assets.kompasiana.com/items/album/2025/10/19/dompppet-68f4b2a5ed64152e8c73adf2.jpg?t=o&v=740&x=416" alt="Dompet Pria Pendek">
                </div>
                <h3>Dompet Pria Pendek</h3>
                <div class="gold-line"></div>
            </a>

            <a href="{{ route('products.show', 3) }}" class="luxe-card">
                <div class="img-holder">
                    <img src="https://assets.kompasiana.com/items/album/2025/10/19/id-68f4b2f434777c3d8a5035a2.jpg?t=o&v=740&x=416" alt="ID Card Kulit">
                </div>
                <h3>ID Card Kulit</h3>
                <div class="gold-line"></div>
            </a>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div style="min-height: 80vh; display: flex; align-items: center; justify-content: center; background: #fcfaf8; font-family: 'Plus Jakarta Sans', sans-serif;">
    <div style="max-width: 550px; text-align: center; background: white; padding: 60px 40px; border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.05); animation: fadeInUp 0.8s ease-out;">
        
        <div style="width: 100px; height: 100px; background: #c5a059; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px; font-size: 2.5rem; box-shadow: 0 10px 20px rgba(197, 160, 89, 0.3);">
            <i class="fas fa-check"></i>
        </div>
        
        <h1 style="font-family: 'Playfair Display', serif; color: #1a1a1a; font-size: 2.5rem; margin-bottom: 15px;">Pembayaran Berhasil</h1>
        <p style="color: #666; line-height: 1.8; margin-bottom: 40px; font-size: 1.1rem;">
            Terima kasih atas kepercayaan Anda pada <strong>CLC LUXE</strong>. Produk kerajinan kulit pilihan Anda sedang kami siapkan untuk segera dikirimkan.
        </p>

        <a href="{{ route('dashboard') }}" style="display: inline-block; width: 100%; background: #1a1a1a; color: white; padding: 20px; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 1rem; transition: 0.3s; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
            Kembali ke Dashboard <i class="fas fa-arrow-right" style="margin-left: 10px;"></i>
        </a>
        
        <div style="margin-top: 30px; padding-top: 30px; border-top: 1px solid #f0f0f0;">
            <p style="font-size: 0.9rem; color: #888;">Butuh bantuan mengenai pesanan Anda?</p>
            <a href="https://wa.me/628123456789" style="color: #c5a059; text-decoration: none; font-weight: 700; font-size: 0.95rem;">
                <i class="fab fa-whatsapp"></i> Hubungi Concierge Kami
            </a>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
@extends('layouts.app')

@section('content')
<style>
    /* Menggunakan font mewah yang konsisten */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap');

    .auth-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #fcfaf8; /* Putih Gading / Cream */
        font-family: 'Plus Jakarta Sans', sans-serif;
        padding: 40px 20px;
    }

    .auth-card {
        background: white;
        width: 100%;
        max-width: 550px; /* Sedikit lebih lebar untuk grid password */
        padding: 50px;
        border-radius: 40px;
        box-shadow: 0 25px 50px -12px rgba(67, 42, 26, 0.08);
        border: 1px solid #f1ece7;
    }

    .auth-header {
        text-align: center;
        margin-bottom: 35px;
    }

    .brand-name {
        font-family: 'Playfair Display', serif;
        font-size: 0.9rem;
        letter-spacing: 4px;
        text-transform: uppercase;
        color: #8b5e3c; /* Coklat Medium */
        margin-bottom: 15px;
        display: block;
    }

    .auth-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        color: #3e2723; /* Dark Chocolate */
        margin-bottom: 10px;
    }

    .auth-header p {
        font-size: 0.85rem;
        color: #8d8d8d;
    }

    .form-group { margin-bottom: 20px; }

    .form-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
        color: #5d4037;
    }

    .form-input {
        width: 100%;
        padding: 14px 20px;
        border-radius: 15px;
        border: 1.5px solid #eee;
        background: #fdfdfd;
        transition: 0.3s ease;
        box-sizing: border-box;
    }

    .form-input:focus {
        outline: none;
        border-color: #a1887f;
        background: white;
        box-shadow: 0 0 0 4px rgba(161, 136, 127, 0.1);
    }

    .grid-inputs {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .btn-auth {
        width: 100%;
        padding: 18px;
        background: #3e2723; /* Dark Chocolate */
        color: #fcfaf8;
        border: none;
        border-radius: 50px; /* Capsule shape */
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        cursor: pointer;
        transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        margin-top: 15px;
    }

    .btn-auth:hover {
        background: #5d4037;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(62, 39, 35, 0.2);
    }

    .invalid-feedback {
        color: #d32f2f;
        font-size: 0.75rem;
        margin-top: 5px;
        display: block;
        font-weight: 600;
    }

    .form-input.is-invalid { border-color: #d32f2f; }

    .auth-footer {
        margin-top: 30px;
        text-align: center;
        font-size: 0.9rem;
        color: #8d8d8d;
    }

    .auth-footer a {
        color: #3e2723;
        font-weight: 700;
        text-decoration: none;
        border-bottom: 2px solid #8b5e3c;
    }

    @media (max-width: 640px) {
        .grid-inputs { grid-template-columns: 1fr; }
        .auth-card { padding: 30px 20px; }
    }
</style>

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <span class="brand-name">Creating Leather Craft</span>
            <h1>Gabung Member</h1>
            <p>Mulailah perjalanan kriya kulit Anda bersama kami</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-input @error('name') is-invalid @enderror" 
                       placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Alamat Email</label>
                <input type="email" name="email" class="form-input @error('email') is-invalid @enderror" 
                       placeholder="email@contoh.com" value="{{ old('email') }}" required>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid-inputs">
                <div class="form-group">
                    <label class="form-label">Kata Sandi</label>
                    <input type="password" name="password" class="form-input @error('password') is-invalid @enderror" 
                           placeholder="••••••••" required>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Konfirmasi</label>
                    <input type="password" name="password_confirmation" class="form-input" 
                           placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-auth">Buat Akun Member</button>
        </form>

        <div class="auth-footer">
            Sudah menjadi member? <a href="{{ route('login') }}">Masuk di Sini</a>
        </div>
    </div>
</div>
@endsection
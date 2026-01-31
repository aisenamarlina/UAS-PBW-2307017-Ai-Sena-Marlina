@extends('layouts.app')

@section('content')
<style>
    /* Menggunakan font mewah yang sama */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap');

    .auth-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #fcfaf8; /* Nuansa Putih Gading/Cream */
        font-family: 'Plus Jakarta Sans', sans-serif;
        padding: 20px;
    }

    .auth-card {
        background: white;
        width: 100%;
        max-width: 450px;
        padding: 60px 50px;
        border-radius: 40px; /* Lebih membulat agar elegan */
        box-shadow: 0 25px 50px -12px rgba(67, 42, 26, 0.08); /* Shadow kecoklatan halus */
        border: 1px solid #f1ece7;
    }

    .auth-header {
        text-align: center;
        margin-bottom: 40px;
    }

    /* Nama Brand: Creating Leather Craft */
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
        color: #3e2723; /* Coklat Gelap (Dark Chocolate) */
        margin: 0;
    }

    .auth-header p {
        font-size: 0.85rem;
        color: #8d8d8d;
        margin-top: 10px;
    }

    .form-group { margin-bottom: 25px; }

    .form-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
        color: #5d4037;
    }

    .form-input {
        width: 100%;
        padding: 16px 22px;
        border-radius: 15px;
        border: 1.5px solid #eee;
        background: #fdfdfd;
        transition: 0.3s all ease;
        box-sizing: border-box;
        font-size: 0.95rem;
    }

    .form-input:focus {
        outline: none;
        border-color: #a1887f; /* Coklat Muda saat Fokus */
        background: white;
        box-shadow: 0 0 0 4px rgba(161, 136, 127, 0.1);
    }

    /* Checkbox & Forgot Password */
    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        font-size: 0.85rem;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #6d4c41;
        cursor: pointer;
    }

    .forgot-password {
        color: #8b5e3c;
        text-decoration: none;
        font-weight: 600;
    }

    .btn-auth {
        width: 100%;
        padding: 18px;
        background: #3e2723; /* Dark Chocolate */
        color: #fcfaf8;
        border: none;
        border-radius: 15px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        cursor: pointer;
        transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .btn-auth:hover {
        background: #5d4037;
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(62, 39, 35, 0.2);
    }

    .auth-footer {
        margin-top: 40px;
        text-align: center;
        font-size: 0.9rem;
        color: #8d8d8d;
    }

    .auth-footer a {
        color: #3e2723;
        font-weight: 700;
        text-decoration: none;
        position: relative;
    }

    .auth-footer a::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 1px;
        bottom: -2px;
        left: 0;
        background-color: #8b5e3c;
    }

    /* Error Styling */
    .invalid-feedback {
        color: #d32f2f;
        font-size: 0.75rem;
        margin-top: 8px;
        display: block;
        font-weight: 600;
    }
    
    .form-input.is-invalid {
        border-color: #d32f2f;
        background-color: #fff8f8;
    }
</style>

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <span class="brand-name">Creating Leather Craft</span>
            <h1>Selamat Datang</h1>
            <p>Silakan masuk ke akun member Anda</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Alamat Email</label>
                <input type="email" name="email" class="form-input @error('email') is-invalid @enderror" 
                       placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Kata Sandi</label>
                <input type="password" name="password" class="form-input @error('password') is-invalid @enderror" 
                       placeholder="••••••••" required>
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> 
                    Ingat saya
                </label>
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        Lupa sandi?
                    </a>
                @endif
            </div>

            <button type="submit" class="btn-auth">Masuk Sekarang</button>
        </form>

        <div class="auth-footer">
            Belum punya akun? <a href="{{ route('register') }}">Daftar Member</a>
        </div>
    </div>
</div>
@endsection
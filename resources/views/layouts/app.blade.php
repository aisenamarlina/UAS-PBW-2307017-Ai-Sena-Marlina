<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creating Leather Craft</title>
    @vite('resources/css/app.css')
    
    <style>
        .nav-link {
            text-decoration: none;
            color: #4b5563;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            color: #92400e;
        }
        .btn-register {
            background-color: #92400e;
            color: white !important;
            padding: 8px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(146, 64, 14, 0.3);
            text-decoration: none;
            font-weight: 700;
            font-size: 0.85rem;
            transition: 0.3s;
        }
        .btn-register:hover {
            background-color: #78350f;
            transform: translateY(-1px);
            box-shadow: 0 6px 10px -1px rgba(146, 64, 14, 0.4);
        }
        /* Style untuk logo gambar agar rapi */
        .brand-logo {
            height: 40px; 
            width: auto;
            object-fit: contain;
        }
    </style>
</head>
<body style="background-color: #f9fafb; margin: 0; font-family: sans-serif;">

<nav style="background: white; border-bottom: 1px solid #f3f4f6; padding: 12px 0; position: sticky; top: 0; z-index: 50; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center;">
        
        <a href="{{ route('home') }}" style="text-decoration: none; display: flex; align-items: center; gap: 12px;">
            <img src="{{ asset('img/logo png.png') }}" alt="Logo" class="brand-logo">
            
            <span style="font-size: 1.25rem; font-weight: 800; color: #1f2937; letter-spacing: -0.5px; text-transform: uppercase;">
                Creating Leather Craft<span style="color: #d97706;">.</span>
            </span>
        </a>
        
        <div style="display: flex; align-items: center; gap: 24px;">
            <a href="{{ route('products.index') }}" class="nav-link">Daftar Produk</a>

            {{-- MENU PESAN (CHAT) --}}
            @auth
                @php $adminId = 1; // Sesuaikan dengan ID Admin Anda @endphp
                <a href="{{ route('chats.index', ['receiver_id' => $adminId]) }}" class="nav-link">
                    <i class="fas fa-comment-dots" style="margin-right: 4px;"></i> Pesan
                </a>
            @endauth
            
            <div style="height: 20px; width: 1px; background-color: #e5e7eb;"></div> 

            @guest
                <a href="{{ route('login') }}" class="nav-link" style="color: #1f2937;">Login</a>
                <a href="{{ route('register') }}" class="btn-register">Register</a>
            @else
                <form action="{{ route('logout') }}" method="POST" style="display: inline; margin: 0;">
                    @csrf
                    <button type="submit" style="background: none; border: 1px solid #ef4444; color: #ef4444; padding: 6px 16px; border-radius: 6px; font-weight: 600; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#ef4444'; this.style.color='white'" onmouseout="this.style.background='none'; this.style.color='#ef4444'">
                        Logout
                    </button>
                </form>
            @endguest
        </div>
    </div>
</nav>

<main style="min-height: 80vh;">
    @yield('content')
</main>

<footer style="background: white; border-top: 1px solid #e5e7eb; padding: 40px 0; margin-top: 60px;">
    <div style="max-width: 1200px; margin: 0 auto; text-align: center;">
        <p style="color: #6b7280; font-size: 0.875rem; margin: 0;">
            &copy; 2026 <strong>Creating Leather Craft</strong>. All rights reserved.
        </p>
    </div>
</footer>

</body>
</html>
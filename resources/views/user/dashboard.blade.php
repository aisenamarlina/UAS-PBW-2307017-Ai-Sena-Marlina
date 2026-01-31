<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard - Creating LC</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root { 
            --leather-dark: #3e2723; --leather-medium: #8b5e3c; --leather-light: #b08d57;
            --cream-bg: #fcfaf8; --white: #ffffff; 
            --sidebar-w: 240px; /* Diperkecil dari 280px */
            --sidebar-collapsed-w: 75px; /* Diperkecil dari 85px */
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            --shadow-soft: 0 10px 30px rgba(62, 39, 35, 0.05);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: var(--cream-bg); color: #2d241e; overflow-x: hidden; letter-spacing: -0.01em; }

        /* Sidebar Custom - Sleeker Look */
        .sidebar-custom { 
            width: var(--sidebar-w); height: 100vh; position: fixed; left: 0; top: 0; 
            background: var(--white); display: flex; flex-direction: column; 
            border-right: 1px solid #f1ece8; transition: var(--transition); z-index: 1000; 
        }
        .sidebar-custom.collapsed { width: var(--sidebar-collapsed-w); }
        
        .brand { height: 100px; display: flex; align-items: center; padding: 0 20px; }
        .brand-logo { height: 40px; width: auto; filter: drop-shadow(0 4px 4px rgba(0,0,0,0.1)); transition: 0.3s; }
        .menu-text { margin-left: 12px; font-weight: 800; font-size: 0.85rem; letter-spacing: 0.5px; color: var(--leather-dark); text-transform: uppercase; white-space: nowrap; }
        .sidebar-custom.collapsed .menu-text { opacity: 0; pointer-events: none; }

        .nav-item-custom { 
            display: flex; align-items: center; padding: 14px 18px; margin: 5px 15px; 
            border-radius: 12px; color: #7f8c8d; text-decoration: none; transition: var(--transition); 
            font-weight: 600; font-size: 0.85rem;
        }
        .nav-item-custom i { min-width: 28px; font-size: 1.15rem; }
        .nav-item-custom.active { 
            background: linear-gradient(135deg, #5d4037, #2d1b18); 
            color: var(--white); box-shadow: 0 8px 15px -5px rgba(62, 39, 35, 0.4); 
        }
        .nav-item-custom:hover:not(.active) { background: #fdf8f4; color: var(--leather-medium); transform: translateX(3px); }

        /* Main Content Adjustment */
        .main-wrapper-custom { margin-left: var(--sidebar-w); transition: var(--transition); min-height: 100vh; background: radial-gradient(circle at top right, #fdf8f4, var(--cream-bg)); }
        .main-wrapper-custom.expanded { margin-left: var(--sidebar-collapsed-w); }

        /* Navbar */
        .navbar { 
            background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); padding: 15px 40px; 
            display: flex; justify-content: space-between; align-items: center; 
            border-bottom: 1px solid rgba(239, 234, 230, 0.5); position: sticky; top: 0; z-index: 999;
        }
        .toggle-btn { 
            width: 38px; height: 38px; border: 1px solid #efeae6; border-radius: 10px; 
            background: white; cursor: pointer; color: var(--leather-dark); transition: 0.3s;
            display: flex; align-items: center; justify-content: center;
        }
        .toggle-btn:hover { background: var(--leather-dark); color: white; }

        .container { max-width: 1100px; margin: 30px auto; padding: 0 25px; }

        /* Profile Header */
        .user-profile-header {
            display: grid; grid-template-columns: auto 1fr auto; align-items: center;
            gap: 25px; background: var(--white); padding: 30px; border-radius: 25px;
            border: 1px solid #f1ece8; margin-bottom: 30px; box-shadow: var(--shadow-soft);
        }
        .avatar-wrapper {
            width: 85px; height: 85px; border-radius: 25px; background: #fdf8f4;
            display: flex; align-items: center; justify-content: center; border: 2px solid #f1ece8;
            transform: rotate(-3deg); transition: 0.4s;
        }
        .user-profile-header:hover .avatar-wrapper { transform: rotate(0deg); border-color: var(--leather-light); }
        .avatar-wrapper i { font-size: 2.5rem; color: var(--leather-medium); }
        .user-info h1 { font-family: 'Playfair Display', serif; font-size: 1.7rem; color: var(--leather-dark); margin-bottom: 3px; }
        
        .loyalty-badge {
            background: linear-gradient(135deg, #8b5e3c 0%, #3e2723 100%);
            color: white; padding: 15px 22px; border-radius: 20px; text-align: center;
            box-shadow: 0 12px 25px rgba(139, 94, 60, 0.15);
        }

        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 35px; }
        .stat-card { 
            background: white; padding: 25px; border-radius: 24px; border: 1px solid #f1ece8; 
            text-align: left; transition: 0.4s; box-shadow: var(--shadow-soft);
            position: relative; overflow: hidden;
        }
        .stat-card:hover { transform: translateY(-8px); border-color: var(--leather-light); }
        .stat-card i { font-size: 1.5rem; margin-bottom: 15px; display: block; }

        /* Tables */
        .order-card { 
            background: white; border-radius: 28px; padding: 25px; 
            border: 1px solid #f1ece8; box-shadow: var(--shadow-soft); margin-bottom: 35px;
            overflow-x: auto;
        }
        table { width: 100%; border-collapse: separate; border-spacing: 0 12px; min-width: 600px; }
        th { text-align: left; padding: 0 15px; color: #a1887f; font-size: 0.75rem; letter-spacing: 1px; text-transform: uppercase; font-weight: 700; }
        td { padding: 20px 15px; background: #fafafa; border-top: 1px solid #f1ece8; border-bottom: 1px solid #f1ece8; font-size: 0.9rem; }
        td:first-child { border-left: 1px solid #f1ece8; border-radius: 12px 0 0 12px; }
        td:last-child { border-right: 1px solid #f1ece8; border-radius: 0 12px 12px 0; }

        .status-pill { padding: 6px 14px; border-radius: 10px; font-size: 0.7rem; font-weight: 700; }
        .status-done { background: #e8f5e9; color: #2e7d32; }
        .status-shipped { background: #e3f2fd; color: #1565c0; }
        .status-process { background: #fff8e1; color: #f57f17; }

        .btn-checkout-now { 
            background: linear-gradient(135deg, #3e2723, #5d4037); color: white; padding: 8px 18px; 
            border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 0.8rem;
            transition: 0.3s;
        }
        .btn-checkout-now:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(62, 39, 35, 0.2); }

        @media (max-width: 768px) {
            .sidebar-custom { transform: translateX(-100%); width: var(--sidebar-w); }
            .sidebar-custom.show { transform: translateX(0); }
            .main-wrapper-custom { margin-left: 0; }
            .stats-grid { grid-template-columns: 1fr; }
            .user-profile-header { grid-template-columns: 1fr; text-align: center; }
            .avatar-wrapper { margin: 0 auto; }
        }
    </style>
</head>
<body>

<aside class="sidebar-custom" id="sidebar">
    <div class="brand">
        <img src="{{ asset('img/logo png.png') }}" alt="Logo" class="brand-logo">
        <span class="menu-text">CREATING LC</span>
    </div>

    <nav style="flex:1; padding: 5px 0;">
        <a href="/dashboard" class="nav-item-custom active">
            <i class="fas fa-columns"></i>
            <span class="menu-text">Dashboard</span>
        </a>
        
        <a href="{{ route('products.index') }}" class="nav-item-custom">
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
        <button type="submit" class="nav-item-custom" style="color:#ef4444; margin-bottom: 25px; border:none; background:none; width:calc(100% - 30px); cursor:pointer; font-weight: 700;">
            <i class="fas fa-sign-out-alt"></i><span class="menu-text">Keluar</span>
        </button>
    </form>
</aside>

<main class="main-wrapper-custom" id="main-content">
    <nav class="navbar">
        <button id="toggle-btn" class="toggle-btn"><i class="fas fa-bars"></i></button>
        <div class="nav-links">
             <a href="{{ route('cart.index') }}" style="color: var(--leather-dark); text-decoration: none; position: relative; background: #fdf8f4; padding: 10px; border-radius: 10px; display: flex; align-items: center;">
                <i class="fas fa-shopping-bag" style="font-size: 1.1rem;"></i>
                <span style="position: absolute; top: -5px; right: -5px; background: #3e2723; color: white; font-size: 0.6rem; font-weight: 800; padding: 2px 6px; border-radius: 6px;">{{ count(session('cart', [])) }}</span>
             </a>
        </div>
    </nav>

    <div class="container">
        <div class="user-profile-header">
            <div class="avatar-wrapper">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="user-info">
                <p style="text-transform: uppercase; font-size: 0.7rem; letter-spacing: 1.5px; color: var(--leather-light); font-weight: 800; margin-bottom: 3px;">Welcome back</p>
                <h1>{{ auth()->user()->name }}</h1>
                <p style="color: #8d8d8d; font-size: 0.85rem;">{{ auth()->user()->email }} <span style="margin: 0 8px; opacity: 0.3;">|</span> Member since {{ auth()->user()->created_at->format('M Y') }}</p>
            </div>
            <div class="loyalty-badge">
                <span style="display:block; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; font-weight: 700; opacity: 0.8;">Loyalty Points</span>
                <strong style="font-size: 1.2rem;"><i class="fas fa-coins" style="color: #ffd700; margin-right: 5px;"></i> {{ number_format(auth()->user()->loyalty_points ?? 0, 0, ',', '.') }}</strong>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-box" style="color: var(--leather-medium);"></i>
                <div style="font-size: 0.7rem; text-transform: uppercase; font-weight: 800; color: #a1887f;">Total Orders</div>
                <div style="font-size: 1.6rem; font-weight: 800; color: var(--leather-dark);">{{ $orders->count() }}</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-shopping-cart" style="color: var(--leather-medium);"></i>
                <div style="font-size: 0.7rem; text-transform: uppercase; font-weight: 800; color: #a1887f;">In Basket</div>
                <div style="font-size: 1.6rem; font-weight: 800; color: var(--leather-dark);">{{ count(session('cart', [])) }}</div>
            </div>
            <div class="stat-card" style="border-left: 3px solid #ffa000;">
                <i class="fas fa-truck" style="color: #ffa000;"></i>
                <div style="font-size: 0.7rem; text-transform: uppercase; font-weight: 800; color: #a1887f;">In Transit</div>
                <div style="font-size: 1.6rem; font-weight: 800; color: var(--leather-dark);">{{ $orders->where('status', 'shipped')->count() }}</div>
            </div>
        </div>

        <h3 style="font-family: 'Playfair Display', serif; margin-bottom: 20px;">Shopping Basket</h3>
        <div class="order-card">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $cart = session('cart', []); @endphp
                    @forelse($cart as $id => $details)
                    <tr>
                        <td style="font-weight: 700; color: var(--leather-dark);">{{ $details['name'] }}</td>
                        <td><span style="background: #eee; padding: 4px 10px; border-radius: 8px; font-weight: 700; font-size: 0.75rem;">{{ $details['quantity'] }}</span></td>
                        <td style="font-weight: 800; color: var(--leather-medium);">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                        <td style="text-align: right;"><a href="{{ route('cart.checkout') }}" class="btn-checkout-now">Checkout</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 40px 20px;">
                            <p style="color: #8d8d8d; font-size: 0.9rem;">Your basket is empty.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <h3 style="font-family: 'Playfair Display', serif; margin-bottom: 20px;">Order History</h3>
        <div class="order-card">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td style="font-weight: 700; color: var(--leather-dark);">#{{ $order->id }}</td>
                        <td style="color: #64748b;">{{ $order->created_at->format('d M y') }}</td>
                        <td style="font-weight: 800; color: var(--leather-dark);">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>
                            @if($order->status == 'completed')
                                <span class="status-pill status-done">Completed</span>
                            @elseif($order->status == 'shipped')
                                <span class="status-pill status-shipped">Shipped</span>
                            @else
                                <span class="status-pill status-process">Processing</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align: center; color: #8d8d8d; padding: 30px;">No history yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('toggle-btn');
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('main-content');

        btn.addEventListener('click', function () {
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('show');
                return;
            }
            sidebar.classList.toggle('collapsed');
            main.classList.toggle('expanded');
        });
    });
</script>
</body>
</html>
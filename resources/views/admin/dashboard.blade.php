<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Creating LC - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        :root {
            --leather-brown: #78350f;
            --leather-dark: #451a03;
            --accent-gold: #d97706;
            --pure-white: #ffffff;
            --soft-white: #f8fafc; /* Lebih cerah sedikit */
            --sidebar-w: 260px;
            --sidebar-collapsed-w: 80px;
            --text-dark: #1f2937;
            --card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Plus Jakarta Sans', sans-serif; background: var(--soft-white); color: var(--text-dark); overflow-x: hidden; }

        /* Sidebar - Glass Effect */
        .sidebar-custom { 
            width: var(--sidebar-w); 
            height: 100vh; 
            position: fixed; 
            left: 0; 
            top: 0; 
            background: var(--pure-white); 
            display: flex; 
            flex-direction: column; 
            border-right: 1px solid #f1f5f9; 
            transition: var(--transition); 
            z-index: 1000; 
        }
        .sidebar-custom.collapsed { width: var(--sidebar-collapsed-w); }
        
        .brand { height: 100px; display: flex; align-items: center; padding: 0 25px; }
        .brand-logo { height: 45px; width: auto; object-fit: contain; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.05)); }
        .menu-text { margin-left: 12px; font-weight: 800; white-space: nowrap; transition: opacity .3s; letter-spacing: -0.5px; color: var(--text-dark); }
        .sidebar-custom.collapsed .menu-text { opacity: 0; pointer-events: none; }

        .nav-item-custom { 
            display: flex; 
            align-items: center; 
            padding: 14px 20px; 
            margin: 6px 15px; 
            border-radius: 12px; 
            color: #64748b; 
            text-decoration: none; 
            transition: var(--transition); 
        }
        .nav-item-custom i { min-width: 32px; font-size: 1.2rem; }
        .nav-item-custom.active { 
            background: linear-gradient(135deg, var(--leather-brown), var(--leather-dark)); 
            color: var(--pure-white); 
            box-shadow: 0 10px 15px -3px rgba(120, 53, 15, 0.3); 
        }
        .nav-item-custom:hover:not(.active) { background: #f1f5f9; color: var(--leather-brown); transform: translateX(5px); }

        .main-wrapper-custom { margin-left: var(--sidebar-w); min-height: 100vh; padding: 40px; display: grid; grid-template-columns: 1fr 320px; gap: 40px; transition: var(--transition); }
        .main-wrapper-custom.expanded { margin-left: var(--sidebar-collapsed-w); }

        /* Modern Components */
        .toggle-btn { 
            width: 45px; 
            height: 45px; 
            border: 1px solid #e2e8f0; 
            border-radius: 12px; 
            background: var(--pure-white); 
            cursor: pointer; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            color: var(--leather-brown);
            transition: .3s;
        }
        .toggle-btn:hover { background: #f8fafc; border-color: var(--leather-brown); }

        .hero-banner-custom { 
            background: linear-gradient(135deg, #78350f 0%, #a16207 100%), url('https://www.transparenttextures.com/patterns/leather.png');
            border-radius: 24px; 
            padding: 45px; 
            color: var(--pure-white); 
            box-shadow: 0 20px 25px -5px rgba(120, 53, 15, 0.2);
            position: relative;
            overflow: hidden;
        }
        .hero-banner-custom::after {
            content: '';
            position: absolute;
            top: -50px; right: -50px;
            width: 150px; height: 150px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .stat-card-custom { 
            background: var(--pure-white); 
            border-radius: 20px; 
            padding: 25px; 
            box-shadow: var(--card-shadow); 
            border: 1px solid rgba(241, 245, 249, 1);
            transition: .3s;
        }
        .stat-card-custom:hover { transform: translateY(-5px); }
        .stat-card-custom strong { font-size: 1.4rem; color: var(--leather-brown); display: block; margin-top: 8px; }

        .content-card-custom { 
            background: var(--pure-white); 
            border-radius: 24px; 
            padding: 30px; 
            box-shadow: var(--card-shadow); 
            border: 1px solid #f1f5f9; 
        }

        .dashboard-aside { 
            background: var(--pure-white); 
            border-radius: 24px; 
            padding: 35px 25px; 
            box-shadow: var(--card-shadow); 
            border: 1px solid #f1f5f9; 
            position: sticky; 
            top: 40px; 
            text-align: center;
            height: fit-content;
        }
        
        /* Badges */
        .status-pill { padding: 6px 12px; border-radius: 8px; font-size: .7rem; font-weight: 700; letter-spacing: 0.5px; }
        .status-success { background: #dcfce7; color: #15803d; }
        .status-pending { background: #fef3c7; color: #b45309; }

        .search-bar { 
            flex: 1; 
            border: 1px solid #e2e8f0; 
            padding: 14px 24px; 
            border-radius: 14px; 
            outline: none; 
            transition: .3s; 
            background: var(--pure-white);
        }
        .search-bar:focus { border-color: var(--leather-brown); box-shadow: 0 0 0 4px rgba(120, 53, 15, 0.05); }

        .transaction-item {
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            padding: 16px 0; 
            border-bottom: 1px solid #f1f5f9;
            transition: .2s;
        }
        .transaction-item:last-child { border-bottom: none; }
        .transaction-item:hover { background: #f8fafc; margin-left: -10px; padding-left: 10px; border-radius: 12px; }

        @media(max-width:1100px){ .main-wrapper-custom{ grid-template-columns: 1fr; } .dashboard-aside{ display:none; } }
        @media(max-width:768px){ 
            .sidebar-custom{ transform: translateX(-100%); } 
            .sidebar-custom.show { transform: translateX(0); box-shadow: 20px 0 25px rgba(0,0,0,0.1); } 
            .main-wrapper-custom, .main-wrapper-custom.expanded{ margin-left: 0; padding: 20px; } 
        }
    </style>
</head>
<body>

<aside class="sidebar-custom" id="sidebar">
    <div class="brand">
        <img src="{{ asset('img/logo png.png') }}" alt="Logo" class="brand-logo">
        <span class="menu-text">CREATING LC</span>
    </div>

    <nav style="flex:1; padding-top: 10px;">
        <a href="{{ route('admin.dashboard') }}" class="nav-item-custom {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i>
            <span class="menu-text">Dashboard</span>
        </a>
        <a href="{{ route('admin.orders') }}" class="nav-item-custom {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
            <i class="fas fa-shopping-cart"></i>
            <span class="menu-text">Pemesanan</span>
        </a>
        <a href="{{ route('admin.products.index') }}" class="nav-item-custom {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <i class="fas fa-box"></i>
            <span class="menu-text">Produk</span>
        </a>

        <a href="{{ route('admin.chat.inbox') }}" class="nav-item-custom {{ request()->routeIs('admin.chat.*') ? 'active' : '' }}" style="position: relative;">
            <i class="fas fa-comments"></i>
            <span class="menu-text">Pesan Pelanggan</span>
            
            @php
                $unreadCount = \App\Models\Message::where('receiver_id', auth()->id())->where('is_read', false)->count();
            @endphp
            
            @if($unreadCount > 0)
                <span style="position: absolute; right: 15px; background: #ef4444; color: white; border-radius: 50%; width: 18px; height: 18px; font-size: 0.65rem; display: flex; align-items: center; justify-content: center; font-weight: 800; border: 2px solid var(--pure-white);">
                    {{ $unreadCount }}
                </span>
            @endif
        </a>

        <a href="{{ route('admin.reports') }}" class="nav-item-custom {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
            <i class="fas fa-file-invoice-dollar"></i>
            <span class="menu-text">Laporan Keuangan</span>
        </a>

        <a href="{{ route('admin.toko') }}" class="nav-item-custom {{ request()->routeIs('admin.toko') ? 'active' : '' }}">
            <i class="fas fa-store"></i>
            <span class="menu-text">Toko</span>
        </a>
        <a href="{{ route('admin.settings') }}" class="nav-item-custom {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            <i class="fas fa-cog"></i><span class="menu-text">Setting</span>
        </a>
    </nav>

    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
        @csrf
        <button type="submit" class="nav-item-custom" style="color:#ef4444; margin-bottom: 25px; border:none; background:none; width:calc(100% - 30px); cursor:pointer; text-align:left;">
            <i class="fas fa-sign-out-alt"></i>
            <span class="menu-text">Keluar</span>
        </button>
    </form>
</aside>

<main class="main-wrapper-custom" id="main-content">
    <div>
        <header style="display:flex; gap:20px; margin-bottom:30px; align-items:center;">
            <button id="toggle-btn" class="toggle-btn">
                <i class="fas fa-bars"></i>
            </button>
            <input class="search-bar" placeholder="Cari pesanan atau pelanggan...">
        </header>

        <section class="hero-banner-custom">
            <h2 style="margin:0 0 10px 0; font-weight: 800;">Selamat Datang, {{ auth()->user()->name }}</h2>
            <p style="margin:0; opacity:0.9; font-weight: 500;">Pantau terus perkembangan bisnis kerajinan kulit Anda hari ini.</p>
        </section>

        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:25px; margin:35px 0">
            <div class="stat-card-custom">
                <div style="width: 40px; height: 40px; background: #fff7ed; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                    <i class="fas fa-wallet" style="color: var(--accent-gold)"></i>
                </div>
                <span style="color:#64748b; font-size:0.9rem; font-weight: 600;">Total Pendapatan</span>
                <strong>Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</strong>
            </div>
            <div class="stat-card-custom">
                <div style="width: 40px; height: 40px; background: #f0f9ff; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                    <i class="fas fa-shopping-bag" style="color: #0284c7"></i>
                </div>
                <span style="color:#64748b; font-size:0.9rem; font-weight: 600;">Total Pesanan</span>
                <strong>{{ $orderCount ?? 0 }} Order</strong>
            </div>
            <div class="stat-card-custom">
                <div style="width: 40px; height: 40px; background: #f5f3ff; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                    <i class="fas fa-cubes" style="color: #7c3aed"></i>
                </div>
                <span style="color:#64748b; font-size:0.9rem; font-weight: 600;">Koleksi Produk</span>
                <strong>{{ $totalProducts ?? 0 }} Item</strong>
            </div>
        </div>

        <div class="content-card-custom">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                <h4 style="margin:0; font-weight: 800;">Transaksi Terbaru</h4>
                <a href="#" style="font-size: 0.8rem; color: var(--leather-brown); font-weight: 700; text-decoration: none;">Lihat Semua</a>
            </div>
            
            @forelse($recentTransactions as $transaction)
                <div class="transaction-item">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <div style="width: 45px; height: 45px; background: #f8fafc; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #94a3b8;">
                            {{ substr($transaction->customer_name, 0, 1) }}
                        </div>
                        <div>
                            <span style="font-weight: 700; color: var(--text-dark);">{{ $transaction->customer_name }}</span><br>
                            <small style="color: #94a3b8; font-weight: 500;">{{ $transaction->created_at->diffForHumans() }} • {{ $transaction->payment_method }}</small>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <div style="font-weight: 800; color: var(--leather-brown); margin-bottom: 6px;">
                            Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                        </div>
                        <span class="status-pill {{ $transaction->status == 'completed' || $transaction->status == 'success' ? 'status-success' : 'status-pending' }}">
                            {{ $transaction->status }}
                        </span>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 40px 0;">
                    <img src="https://illustrations.popsy.co/amber/no-messages.svg" style="height: 120px; margin-bottom: 15px; opacity: 0.5;">
                    <p style="color: #94a3b8; font-weight: 500;">Belum ada transaksi masuk.</p>
                </div>
            @endforelse
        </div>
    </div>

    <aside class="dashboard-aside">
        <div style="position: relative; width: 100px; height: 100px; margin: 0 auto 20px;">
            <div style="width:100%; height:100%; background:linear-gradient(135deg, #f1f5f9, #e2e8f0); border-radius:50%; display:flex; align-items:center; justify-content:center; border: 4px solid var(--pure-white); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
                 <i class="fas fa-user-tie" style="font-size:2.5rem; color:var(--leather-brown)"></i>
            </div>
            <div style="position: absolute; bottom: 5px; right: 5px; width: 20px; height: 20px; background: #10b981; border: 3px solid var(--pure-white); border-radius: 50%;"></div>
        </div>
        <strong style="font-size:1.1rem; font-weight: 800;">{{ auth()->user()->name }}</strong>
        <p style="color:#64748b; margin:5px 0 25px; font-weight: 600; font-size: 0.85rem;">Administrator</p>
        
        <div style="background: #f8fafc; border-radius: 16px; padding: 20px; text-align: left;">
            <p style="font-size:0.75rem; color:#64748b; line-height: 1.6; font-weight: 500; margin: 0;">
                <i class="fas fa-info-circle" style="color: var(--leather-brown); margin-right: 5px;"></i>
                Dashboard ini terhubung langsung dengan sistem inventori kulit premium Anda.
            </p>
        </div>
    </aside>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('toggle-btn');
        const icon = btn.querySelector('i');
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('main-content');

        btn.addEventListener('click', function () {
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('show');
                return;
            }
            sidebar.classList.toggle('collapsed');
            main.classList.toggle('expanded');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-chevron-right');
        });
    });
</script>
</body>
</html>
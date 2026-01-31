<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creating LC - Admin Pemesanan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            /* Palette Cokelat & Putih Sesuai Halaman Lain */
            --leather-brown: #78350f; 
            --accent-gold: #d97706;
            --pure-white: #ffffff;
            --soft-white: #f9fafb;
            --text-dark: #1f2937;
            
            --sidebar-w: 260px;
            --sidebar-collapsed-w: 85px;
            --card-shadow: 0 4px 20px rgba(0,0,0,0.05);
            --transition: all 0.35s ease;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--soft-white); overflow-x: hidden; color: var(--text-dark); }

        /* Sidebar Style */
        .sidebar-custom {
            width: var(--sidebar-w); height: 100vh; position: fixed; left: 0; top: 0;
            background: var(--pure-white); transition: var(--transition); z-index: 1050;
            display: flex; flex-direction: column; border-right: 1px solid rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .sidebar-custom.collapsed { width: var(--sidebar-collapsed-w); }

        .brand { height: 100px; display: flex; align-items: center; padding: 0 20px; white-space: nowrap; }
        .brand-logo { width: 45px; height: 45px; object-fit: contain; }

        .menu-text { margin-left: 12px; font-weight: 800; color: var(--text-dark); transition: opacity 0.2s; letter-spacing: -0.5px; }
        .sidebar-custom.collapsed .menu-text { opacity: 0; visibility: hidden; }

        .nav-item-custom {
            display: flex; align-items: center; padding: 12px 20px; color: #6b7280;
            text-decoration: none; transition: 0.3s; margin: 4px 15px; border-radius: 10px; white-space: nowrap;
        }
        .nav-item-custom i { font-size: 1.1rem; min-width: 30px; }
        .nav-item-custom.active { color: var(--pure-white); background: var(--leather-brown); box-shadow: 0 4px 12px rgba(120, 53, 15, 0.2); }
        .nav-item-custom:hover:not(.active) { background: #f3f4f6; color: var(--leather-brown); }

        /* Layout Main */
        .main-wrapper-custom {
            margin-left: var(--sidebar-w); min-height: 100vh; padding: 30px;
            transition: var(--transition); display: grid; grid-template-columns: 1fr 320px; gap: 30px;
        }
        .main-wrapper-custom.expanded { margin-left: var(--sidebar-collapsed-w); }

        /* Order Table */
        .order-table { width: 100%; border-collapse: separate; border-spacing: 0 12px; margin-top: -12px; }
        .order-table tr { background: white; transition: transform 0.2s; }
        .order-table tr:hover { transform: scale(1.005); box-shadow: var(--card-shadow); }
        .order-table th { padding: 15px 20px; color: #6b7280; font-size: 0.75rem; text-align: left; text-transform: uppercase; letter-spacing: 1px; }
        .order-table td { padding: 18px 20px; vertical-align: middle; border: none; border-top: 1px solid #f3f4f6; border-bottom: 1px solid #f3f4f6; }
        .order-table td:first-child { border-radius: 16px 0 0 16px; border-left: 1px solid #f3f4f6; }
        .order-table td:last-child { border-radius: 0 16px 16px 0; border-right: 1px solid #f3f4f6; }

        /* UI Elements */
        .customer-avatar { width: 40px; height: 40px; border-radius: 10px; background: #fffbeb; display: flex; align-items: center; justify-content: center; font-weight: 700; color: var(--leather-brown); text-transform: uppercase; }
        
        .status-pill { padding: 6px 14px; border-radius: 10px; font-size: 0.8rem; font-weight: 600; text-transform: capitalize; }
        .status-pending { background: #fff7ed; color: #c2410c; }
        .status-completed { background: #f0fdf4; color: #15803d; }
        .status-process { background: #eff6ff; color: #1d4ed8; }

        .btn-action { border: 1px solid #e5e7eb; background: white; padding: 10px; border-radius: 10px; color: #6b7280; cursor: pointer; transition: 0.2s; text-decoration: none; display: inline-block; }
        .btn-action:hover { background: var(--leather-brown); color: white; border-color: var(--leather-brown); }

        .dashboard-aside { background: var(--pure-white); border-radius: 20px; padding: 25px; height: fit-content; box-shadow: var(--card-shadow); border: 1px solid rgba(0,0,0,0.02); position: sticky; top: 30px; }

        @media (max-width: 1100px) {
            .main-wrapper-custom { grid-template-columns: 1fr; }
            .dashboard-aside { display: none; }
        }
    </style>
</head>
<body>

    <aside class="sidebar-custom" id="sidebar">
        <div class="brand">
            <img src="{{ asset('img/logo png.png') }}" alt="Logo" class="brand-logo">
            <span class="menu-text" style="font-size: 1.1rem;">CREATING LC</span>
        </div>

        <nav style="flex-grow: 1;">
            <a href="{{ route('admin.dashboard') }}" class="nav-item-custom {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span class="menu-text">Dashboard</span>
            </a>
            <a href="{{ route('admin.orders') }}" class="nav-item-custom {{ request()->is('admin/orders*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i>
                <span class="menu-text">Pemesanan</span>
            </a>
            <a href="{{ route('admin.products.index') }}" class="nav-item-custom {{ request()->is('admin/products*') ? 'active' : '' }}">
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
            
            <a href="{{ route('admin.settings') }}" class="nav-item-custom">
                <i class="fas fa-cog"></i>
                <span class="menu-text">Setting</span>
            </a>
        </nav>

        <div style="padding: 20px; border-top: 1px solid #f3f4f6;">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-item-custom" style="color: #ef4444; margin: 0; background: none; border: none; width: 100%; cursor: pointer; text-align: left;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="menu-text">Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="main-wrapper-custom" id="main-content">
        <div class="dashboard-main">
            <header style="display:flex; align-items:center; justify-content: space-between; margin-bottom:30px;">
                <div style="display:flex; align-items:center; gap: 20px;">
                    <button id="toggle-btn" style="background:white; border:1px solid #e5e7eb; width:45px; height:45px; border-radius:12px; cursor:pointer; color: var(--leather-brown);">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h2 style="margin:0; font-weight:800; color: var(--text-dark);">Manajemen Pemesanan</h2>
                </div>
            </header>

            @if(session('success'))
                <div style="background: #f0fdf4; color: #15803d; padding: 15px; border-radius: 12px; margin-bottom: 20px; font-weight: 600; border: 1px solid #bbf7d0;">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <table class="order-table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>No. WhatsApp</th>
                        <th>Status</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div class="customer-avatar">
                                    {{ substr($order->customer_name, 0, 2) }}
                                </div>
                                <div>
                                    <div style="font-weight:700; color: var(--text-dark);">{{ $order->customer_name }}</div>
                                    <small style="color:#6b7280;">#INV-{{ $order->id }}</small>
                                </div>
                            </div>
                        </td>
                        <td style="font-weight:600; color:var(--text-dark);">
                            {{ $order->phone }}
                        </td>
                        <td>
                            <span class="status-pill status-{{ $order->status }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td style="font-weight:800; color: var(--leather-brown);">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-action">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px; color: #9ca3af;">
                            <i class="fas fa-inbox fa-3x" style="margin-bottom: 10px; display: block; opacity: 0.3;"></i>
                            Belum ada pesanan yang masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <aside class="dashboard-aside">
            <div style="display:flex; align-items:center; gap:15px; margin-bottom:30px;">
                <div style="width:50px; height:50px; background:var(--leather-brown); border-radius:15px; display:flex; align-items:center; justify-content:center; color:white; font-weight:bold;">
                    {{ substr(Auth::user()->name ?? 'AD', 0, 2) }}
                </div>
                <div>
                    <div style="font-weight:700; color: var(--text-dark);">{{ Auth::user()->name ?? 'Admin LC' }}</div>
                    <small style="color:#6b7280; text-transform: capitalize;">{{ Auth::user()->role ?? 'Staff' }}</small>
                </div>
            </div>

            <div style="background:var(--soft-white); border-radius:15px; padding:20px; border: 1px solid #f3f4f6; text-align:center; color:var(--leather-brown); margin-bottom:20px;">
                <i class="fas fa-calendar-alt" style="margin-bottom:10px; color: var(--accent-gold);"></i><br>
                <small style="font-weight: 700;">{{ now()->format('d F Y') }}</small>
            </div>

            <div style="background:#fffbeb; padding:15px; border-radius:12px; border-left:4px solid var(--accent-gold);">
                <p style="margin:0; font-size:0.85rem; color:var(--leather-brown);">
                    <strong>Info:</strong> 
                    Ada {{ $orders->where('status', 'pending')->count() }} pesanan butuh konfirmasi.
                </p>
            </div>
        </aside>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('toggle-btn');
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('main-content');

            btn.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                content.classList.toggle('expanded');
            });
        });
    </script>
</body>
</html>
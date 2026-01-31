<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creating LC - Laporan Keuangan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root {
            --leather-brown: #78350f;
            --accent-gold: #d97706;
            --pure-white: #ffffff;
            --soft-white: #f9fafb;
            --text-dark: #1f2937;
            --sidebar-w: 260px;
            --sidebar-collapsed-w: 80px;
            --card-shadow: 0 4px 20px rgba(0,0,0,0.05);
            --transition: all 0.35s ease;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--soft-white); color: var(--text-dark); }

        /* Sidebar */
        .sidebar-custom { width: var(--sidebar-w); height: 100vh; position: fixed; background: var(--pure-white); transition: var(--transition); z-index: 1000; display: flex; flex-direction: column; border-right: 1px solid rgba(0,0,0,0.05); }
        .sidebar-custom.collapsed { width: var(--sidebar-collapsed-w); }
        .brand { height: 100px; display: flex; align-items: center; padding: 0 20px; }
        .brand-logo { height: 45px; width: auto; }
        .menu-text { margin-left: 12px; font-weight: 800; white-space: nowrap; transition: opacity 0.2s; color: var(--text-dark); }
        .sidebar-custom.collapsed .menu-text { opacity: 0; pointer-events: none; }

        .nav-item-custom { display: flex; align-items: center; padding: 12px 20px; color: #6b7280; text-decoration: none; margin: 4px 15px; border-radius: 10px; transition: 0.3s; }
        .nav-item-custom.active { background: var(--leather-brown); color: var(--pure-white); box-shadow: 0 4px 12px rgba(120, 53, 15, 0.2); }
        .nav-item-custom:hover:not(.active) { background: #f3f4f6; color: var(--leather-brown); }

        /* Main Content */
        .main-wrapper-custom { margin-left: var(--sidebar-w); padding: 30px; transition: var(--transition); }
        .main-wrapper-custom.expanded { margin-left: var(--sidebar-collapsed-w); }

        /* Stats Cards */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 25px; border-radius: 20px; box-shadow: var(--card-shadow); border-left: 5px solid var(--leather-brown); }
        .stat-card h3 { font-size: 0.85rem; color: #6b7280; text-transform: uppercase; margin-bottom: 10px; }
        .stat-card .value { font-size: 1.5rem; font-weight: 800; color: var(--text-dark); }

        /* Report Table */
        .report-container { background: white; padding: 25px; border-radius: 20px; box-shadow: var(--card-shadow); margin-top: 30px; }
        .table-custom { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table-custom th { text-align: left; padding: 15px; border-bottom: 2px solid #f3f4f6; color: #6b7280; font-size: 0.85rem; text-transform: uppercase; }
        .table-custom td { padding: 15px; border-bottom: 1px solid #f3f4f6; font-size: 0.95rem; }

        .btn-export { background: #10b981; color: white; padding: 10px 20px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 0.85rem; border: none; cursor: pointer; display: flex; align-items: center; gap: 8px; }
        
        .chart-box { background: white; padding: 25px; border-radius: 20px; box-shadow: var(--card-shadow); height: 400px; }
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
        <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <div style="display:flex; align-items:center; gap: 20px;">
                <button id="toggle-btn" style="background:white; border:none; width:45px; height:45px; border-radius:12px; cursor:pointer; color:var(--leather-brown); box-shadow: var(--card-shadow);"><i class="fas fa-bars"></i></button>
                <h2 style="font-weight:800;">Laporan Keuangan</h2>
            </div>
            <button class="btn-export" onclick="window.print()"><i class="fas fa-download"></i> Cetak Laporan</button>
        </header>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Pendapatan</h3>
                <div class="value">Rp 1.450.000</div>
                <small style="color: #10b981;">+12% dari bulan lalu</small>
            </div>
            <div class="stat-card" style="border-left-color: var(--accent-gold);">
                <h3>Produk Terjual</h3>
                <div class="value">14 Item</div>
                <small>Bulan Januari 2026</small>
            </div>
            <div class="stat-card" style="border-left-color: #10b981;">
                <h3>Rata-rata Order</h3>
                <div class="value">Rp 48.214</div>
                <small>Per transaksi</small>
            </div>
        </div>

        <div class="chart-box">
            <h3 style="margin-bottom: 20px; font-weight: 800;">Grafik Penjualan Mingguan</h3>
            <canvas id="salesChart"></canvas>
        </div>

        <div class="report-container">
            <h3 style="font-weight: 800;">Transaksi Terbaru</h3>
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>ID Transaksi</th>
                        <th>Customer</th>
                        <th>Metode</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>30 Jan 2026</td>
                        <td>#INV-1024</td>
                        <td>Budi Santoso</td>
                        <td>COD</td>
                        <td style="font-weight: 700; color: var(--leather-brown);">Rp 200.000</td>
                    </tr>
                    <tr>
                        <td>29 Jan 2026</td>
                        <td>#INV-1023</td>
                        <td>Siti Aminah</td>
                        <td>COD</td>
                        <td style="font-weight: 700; color: var(--leather-brown);">Rp 150.000</td>
                    </tr>
                    <tr>
                        <td>28 Jan 2026</td>
                        <td>#INV-1022</td>
                        <td>Andi Wijaya</td>
                        <td>COD</td>
                        <td style="font-weight: 700; color: var(--leather-brown);">Rp 75.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        // Sidebar Toggle
        const btn = document.getElementById('toggle-btn');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('main-content');

        btn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('expanded');
        });

        // Chart.js Configuration
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: [800000, 1200000, 950000, 1500000, 1100000, 2100000, 1850000],
                    borderColor: '#78350f',
                    backgroundColor: 'rgba(120, 53, 15, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f3f4f6' } },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
</body>
</html>
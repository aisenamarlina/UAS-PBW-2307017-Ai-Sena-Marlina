<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creating LC - Pengaturan Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
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

        .header-section { margin-bottom: 30px; }
        .settings-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 30px; }

        .card-white { background: white; border-radius: 20px; padding: 25px; box-shadow: var(--card-shadow); border: 1px solid rgba(0,0,0,0.02); }
        
        .profile-header { text-align: center; margin-bottom: 25px; }
        .avatar-large { width: 100px; height: 100px; background: #fffbeb; border-radius: 30px; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: var(--leather-brown); margin: 0 auto 15px; border: 2px solid #fef3c7; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 700; font-size: 0.85rem; color: #6b7280; margin-bottom: 8px; text-transform: uppercase; }
        .form-control { width: 100%; padding: 12px 15px; border-radius: 12px; border: 1px solid #e5e7eb; background: #f9fafb; font-size: 0.95rem; transition: 0.3s; }
        .form-control:focus { outline: none; border-color: var(--leather-brown); background: white; box-shadow: 0 0 0 4px rgba(120, 53, 15, 0.05); }

        .btn-save { background: var(--leather-brown); color: white; padding: 12px 30px; border-radius: 12px; border: none; font-weight: 700; cursor: pointer; transition: 0.3s; width: 100%; }
        .btn-save:hover { background: var(--accent-gold); transform: translateY(-2px); }

        .section-title { font-weight: 800; font-size: 1.2rem; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; color: var(--leather-brown); }
        
        @media (max-width: 992px) { .settings-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

    <aside class="sidebar-custom" id="sidebar">
        <div class="brand">
            <img src="{{ asset('img/logo png.png') }}" alt="Logo" class="brand-logo">
            <span class="menu-text">CREATING LC</span>
        </div>
        <nav style="flex:1">
            <a href="{{ route('admin.dashboard') }}" class="nav-item-custom"><i class="fas fa-th-large"></i><span class="menu-text">Dashboard</span></a>
            <a href="{{ route('admin.orders') }}" class="nav-item-custom"><i class="fas fa-shopping-cart"></i><span class="menu-text">Pemesanan</span></a>
            <a href="{{ route('admin.products.index') }}" class="nav-item-custom"><i class="fas fa-box"></i><span class="menu-text">Produk</span></a>
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
            <a href="{{ route('admin.toko') }}" class="nav-item-custom"><i class="fas fa-store"></i><span class="menu-text">Toko</span></a>
            <a href="{{ route('admin.settings') }}" class="nav-item-custom active"><i class="fas fa-cog"></i><span class="menu-text">Setting</span></a>
        </nav>
    </aside>

    <main class="main-wrapper-custom" id="main-content">
        <header class="header-section">
            <div style="display:flex; align-items:center; gap: 20px;">
                <button id="toggle-btn" style="background:white; border:none; width:45px; height:45px; border-radius:12px; cursor:pointer; color:var(--leather-brown); box-shadow: var(--card-shadow);"><i class="fas fa-bars"></i></button>
                <h2 style="font-weight:800;">Pengaturan Akun</h2>
            </div>
        </header>

        <div class="settings-grid">
            <div class="card-white">
                <div class="profile-header">
                    <div class="avatar-large">
                        {{ substr(Auth::user()->name ?? 'AD', 0, 2) }}
                    </div>
                    <h3 style="font-weight: 800;">{{ Auth::user()->name ?? 'Administrator' }}</h3>
                    <p style="color: #6b7280; font-size: 0.9rem;">{{ Auth::user()->email ?? 'admin@creatinglc.com' }}</p>
                </div>
                <hr style="border: none; border-top: 1px solid #f3f4f6; margin: 20px 0;">
                <div style="font-size: 0.85rem; color: #6b7280;">
                    <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
                        <span>Role:</span>
                        <strong style="color: var(--leather-brown); text-transform: capitalize;">{{ Auth::user()->role ?? 'Admin' }}</strong>
                    </div>
                    <div style="display:flex; justify-content:space-between;">
                        <span>Member Sejak:</span>
                        <strong>{{ Auth::user()->created_at ? Auth::user()->created_at->format('d M Y') : 'Jan 2026' }}</strong>
                    </div>
                </div>
            </div>

            <div class="card-white">
                <h3 class="section-title"><i class="fas fa-user-edit"></i> Edit Profil</h3>
                <form action="#" method="POST">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name ?? '' }}" placeholder="Masukkan nama">
                        </div>
                        <div class="form-group">
                            <label>Alamat Email</label>
                            <input type="email" class="form-control" value="{{ Auth::user()->email ?? '' }}" placeholder="email@contoh.com">
                        </div>
                    </div>

                    <h3 class="section-title" style="margin-top: 20px;"><i class="fas fa-lock"></i> Keamanan</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type="password" class="form-control" placeholder="Isi jika ingin ganti">
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password</label>
                            <input type="password" class="form-control" placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <div style="margin-top: 20px; text-align: right;">
                        <button type="submit" class="btn-save">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        const btn = document.getElementById('toggle-btn');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('main-content');

        btn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('expanded');
        });
    </script>
</body>
</html>
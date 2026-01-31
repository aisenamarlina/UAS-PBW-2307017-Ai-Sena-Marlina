<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creating LC - Pengaturan Toko</title>
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
        body { background-color: var(--soft-white); color: var(--text-dark); overflow-x: hidden; }

        /* Sidebar Style */
        .sidebar-custom { width: var(--sidebar-w); height: 100vh; position: fixed; background: var(--pure-white); transition: var(--transition); z-index: 1000; display: flex; flex-direction: column; border-right: 1px solid rgba(0,0,0,0.05); }
        .sidebar-custom.collapsed { width: var(--sidebar-collapsed-w); }
        
        .brand { height: 100px; display: flex; align-items: center; padding: 0 20px; overflow: hidden; }
        .brand-logo { height: 45px; width: auto; object-fit: contain; }
        .menu-text { margin-left: 12px; font-weight: 800; white-space: nowrap; transition: opacity 0.2s; color: var(--text-dark); letter-spacing: -0.5px; }
        .sidebar-custom.collapsed .menu-text { opacity: 0; pointer-events: none; }

        /* Navigation */
        .nav-item-custom { display: flex; align-items: center; padding: 12px 20px; color: #6b7280; text-decoration: none; margin: 4px 15px; border-radius: 10px; transition: 0.3s; }
        .nav-item-custom i { min-width: 30px; font-size: 1.1rem; }
        .nav-item-custom.active { background: var(--leather-brown); color: var(--pure-white); box-shadow: 0 4px 12px rgba(120, 53, 15, 0.2); }
        .nav-item-custom:hover:not(.active) { background: #f3f4f6; color: var(--leather-brown); }

        /* Main Content */
        .main-wrapper-custom { margin-left: var(--sidebar-w); padding: 30px; transition: var(--transition); }
        .main-wrapper-custom.expanded { margin-left: var(--sidebar-collapsed-w); }

        .store-grid { display: grid; grid-template-columns: 1fr 320px; gap: 30px; margin-top: 30px; }
        .card-white { background: var(--pure-white); padding: 25px; border-radius: 20px; box-shadow: var(--card-shadow); border: 1px solid rgba(0,0,0,0.02); }
        
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-dark); font-size: 0.9rem; }
        .form-control { width: 100%; padding: 12px 15px; border: 1px solid #e5e7eb; border-radius: 10px; outline: none; transition: 0.3s; }
        .form-control:focus { border-color: var(--leather-brown); }

        .btn-save { background: var(--leather-brown); color: white; border: none; padding: 14px; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.3s; width: 100%; font-size: 1rem; }
        .btn-save:hover { background: var(--accent-gold); transform: translateY(-2px); }

        /* Banner & Profile - UPDATED for functional upload */
        .banner-preview { width: 100%; height: 160px; background: linear-gradient(135deg, var(--leather-brown), var(--accent-gold)); border-radius: 15px; margin-bottom: 40px; position: relative; background-size: cover; background-position: center; }
        .banner-upload-btn { position: absolute; top: 15px; right: 15px; background: rgba(255,255,255,0.2); color: white; padding: 8px 12px; border-radius: 8px; cursor: pointer; backdrop-filter: blur(5px); font-size: 0.8rem; border: 1px solid rgba(255,255,255,0.3); }
        
        .profile-upload { width: 85px; height: 85px; background: var(--pure-white); border-radius: 18px; position: absolute; bottom: -25px; left: 25px; border: 4px solid var(--pure-white); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--leather-brown); box-shadow: var(--card-shadow); cursor: pointer; overflow: hidden; }
        .profile-upload img { width: 100%; height: 100%; object-fit: cover; }

        .toggle-btn { width: 45px; height: 45px; border: 1px solid #f3f4f6; border-radius: 10px; background: var(--pure-white); cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--leather-brown); }

        @media(max-width:1100px) { .store-grid { grid-template-columns: 1fr; } }
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
        <header style="display:flex; align-items:center; gap: 20px;">
            <button id="toggle-btn" class="toggle-btn"><i class="fas fa-bars"></i></button>
            <h2 style="font-weight:800; color:var(--text-dark);">Pengaturan Toko</h2>
        </header>

        <div class="store-grid">
            <div class="card-white">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="banner-preview" id="banner-bg">
                        <label for="banner-input" class="banner-upload-btn">
                            <i class="fas fa-image"></i> Ganti Banner
                        </label>
                        <input type="file" id="banner-input" name="banner" style="display:none" accept="image/*">
                        
                        <label for="profile-input" class="profile-upload" id="profile-frame">
                            <i class="fas fa-camera" id="camera-icon"></i>
                        </label>
                        <input type="file" id="profile-input" name="logo" style="display:none" accept="image/*">
                    </div>
                    
                    <div style="margin-bottom: 25px;">
                        <h3 style="color:var(--text-dark);">Profil Bisnis</h3>
                        <p style="color:#6b7280; font-size: 0.85rem;">Informasi ini akan muncul di halaman depan toko Anda.</p>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label>Nama Brand</label>
                            <input type="text" name="brand_name" class="form-control" value="Creating LC">
                        </div>
                        <div class="form-group">
                            <label>Email Bisnis</label>
                            <input type="email" name="email" class="form-control" value="admin@creatinglc.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Slogan / Deskripsi Singkat</label>
                        <textarea name="description" class="form-control" rows="3">Premium Leather Craftsmanship & Handmade Quality.</textarea>
                    </div>
                    <div class="form-group">
                        <label>Alamat Workshop</label>
                        <input type="text" name="address" class="form-control" placeholder="Lokasi pusat produksi...">
                    </div>
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                </form>
            </div>

            <div style="display: flex; flex-direction: column; gap: 20px;">
                <div class="card-white">
                    <h4 style="margin-bottom: 20px; color:var(--text-dark); border-bottom: 1px solid #f3f4f6; padding-bottom: 10px;">Jam Kerja</h4>
                    <div style="display: flex; flex-direction: column; gap: 15px;">
                        <div style="display:flex; justify-content: space-between; font-size: 0.9rem;">
                            <span style="color:#6b7280;">Senin - Sabtu</span>
                            <span style="font-weight: 700; color:var(--leather-brown);">08:00 - 17:00</span>
                        </div>
                        <div style="display:flex; justify-content: space-between; font-size: 0.9rem;">
                            <span style="color:#6b7280;">Minggu</span>
                            <span style="color:#ef4444; font-weight: 700;">Libur</span>
                        </div>
                    </div>
                </div>

                <div class="card-white" style="background: var(--leather-brown); color: white;">
                    <div style="display:flex; align-items:center; gap: 15px;">
                        <i class="fas fa-shield-alt" style="font-size: 1.5rem; color: var(--accent-gold);"></i>
                        <div>
                            <p style="font-size: 0.75rem; opacity: 0.8; text-transform: uppercase; letter-spacing: 1px;">Verifikasi</p>
                            <p style="font-weight: 700;">Toko Terverifikasi</p>
                        </div>
                    </div>
                </div>
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

        // Script Preview Gambar saat diupload
        function previewImage(input, elementId, isBackground = false) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if(isBackground) {
                        document.getElementById(elementId).style.backgroundImage = `url(${e.target.result})`;
                    } else {
                        const frame = document.getElementById(elementId);
                        frame.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.getElementById('profile-input').addEventListener('change', function() {
            previewImage(this, 'profile-frame');
        });

        document.getElementById('banner-input').addEventListener('change', function() {
            previewImage(this, 'banner-bg', true);
        });
    </script>
</body>
</html>
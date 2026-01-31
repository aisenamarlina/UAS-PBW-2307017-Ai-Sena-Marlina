<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Saya - Creating LC</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root { 
            --leather-dark: #3e2723; 
            --leather-medium: #8b5e3c; 
            --leather-light: #b08d57;
            --cream-bg: #fcfaf8; 
            --white: #ffffff; 
            --shadow: 0 10px 30px rgba(62, 39, 35, 0.05);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: var(--cream-bg); color: #2d241e; }

        /* Navbar */
        .navbar { 
            background: var(--white); padding: 15px 8%; display: flex; 
            justify-content: space-between; align-items: center; 
            border-bottom: 1px solid #efeae6; position: sticky; top: 0; z-index: 1000;
        }
        .brand-container { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .brand-logo { height: 40px; width: auto; }
        .menu-text { font-family: 'Playfair Display', serif; font-weight: 800; color: var(--leather-dark); font-size: 1.2rem; }

        .container { max-width: 1000px; margin: 50px auto; padding: 0 20px; display: grid; grid-template-columns: 300px 1fr; gap: 30px; }

        /* Sidebar Profil */
        .profile-sidebar { background: var(--white); border-radius: 25px; padding: 30px; border: 1px solid #efeae6; box-shadow: var(--shadow); height: fit-content; text-align: center; }
        .avatar-wrapper { position: relative; width: 120px; height: 120px; margin: 0 auto 20px; }
        .avatar-img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; border: 4px solid var(--cream-bg); outline: 2px solid var(--leather-light); }
        .edit-avatar { position: absolute; bottom: 5px; right: 5px; background: var(--leather-dark); color: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; cursor: pointer; border: 2px solid white; }
        
        .user-name { font-family: 'Playfair Display', serif; font-size: 1.4rem; color: var(--leather-dark); margin-bottom: 5px; }
        .user-role { font-size: 0.8rem; color: var(--leather-light); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 25px; display: block; }

        .nav-menu { text-align: left; list-style: none; }
        .nav-menu li a { display: flex; align-items: center; gap: 12px; padding: 12px 15px; text-decoration: none; color: #64748b; font-weight: 600; border-radius: 12px; transition: 0.3s; margin-bottom: 5px; }
        .nav-menu li a.active { background: #fdf8f3; color: var(--leather-dark); }
        .nav-menu li a:hover:not(.active) { background: #f8fafc; color: var(--leather-medium); }

        /* Main Content */
        .content-card { background: var(--white); border-radius: 25px; padding: 40px; border: 1px solid #efeae6; box-shadow: var(--shadow); }
        .section-title { font-family: 'Playfair Display', serif; font-size: 1.8rem; color: var(--leather-dark); margin-bottom: 30px; border-bottom: 2px solid #fcfaf8; padding-bottom: 15px; }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-group { margin-bottom: 20px; }
        .form-group.full { grid-column: span 2; }
        .form-group label { display: block; font-size: 0.85rem; font-weight: 700; color: #64748b; margin-bottom: 8px; text-transform: uppercase; }
        .form-control { width: 100%; padding: 12px 18px; border-radius: 12px; border: 1.5px solid #f1ece7; outline: none; transition: 0.3s; font-size: 0.95rem; }
        .form-control:focus { border-color: var(--leather-medium); box-shadow: 0 0 0 4px rgba(139, 94, 60, 0.05); }

        .btn-save { background: var(--leather-dark); color: white; padding: 15px 30px; border: none; border-radius: 15px; font-weight: 700; cursor: pointer; transition: 0.3s; margin-top: 10px; }
        .btn-save:hover { background: var(--leather-medium); transform: translateY(-2px); }

        /* Responsive */
        @media (max-width: 850px) {
            .container { grid-template-columns: 1fr; }
            .form-grid { grid-template-columns: 1fr; }
            .form-group.full { grid-column: span 1; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="/" class="brand-container">
            <img src="{{ asset('img/logo png.png') }}" alt="Logo" class="brand-logo">
            <span class="menu-text">CREATING LC</span>
        </a>
        <a href="{{ route('admin.dashboard') }}" style="text-decoration:none; color:var(--leather-medium); font-weight:700; font-size: 0.8rem;">
            <i class="fas fa-arrow-left"></i> KEMBALI
        </a>
    </nav>

    <div class="container">
        <aside class="profile-sidebar">
            <div class="avatar-wrapper">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}&background=3e2723&color=fff" alt="Avatar" class="avatar-img">
                <div class="edit-avatar"><i class="fas fa-camera"></i></div>
            </div>
            <h2 class="user-name">{{ auth()->user()->name ?? 'Nama Pengguna' }}</h2>
            <span class="user-role">Pelanggan Setia</span>

            <ul class="nav-menu">
                <li><a href="#" class="active"><i class="fas fa-user-circle"></i> Profil Saya</a></li>
                <li><hr style="border: 0; border-top: 1px solid #f1ece7; margin: 10px 0;"></li>
                <li><a href="#" style="color: #ef4444;"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </aside>

        <main class="content-card">
            <h1 class="section-title">Informasi Profil</h1>
            
            <form action="#" method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name ?? '' }}" placeholder="Masukkan nama lengkap">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" value="{{ auth()->user()->email ?? '' }}" placeholder="email@contoh.com">
                    </div>
                    <div class="form-group">
                        <label>Nomor WhatsApp</label>
                        <input type="text" class="form-control" placeholder="0812xxxxxxx">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="form-group full">
                        <label>Bio Singkat</label>
                        <textarea class="form-control" rows="3" placeholder="Ceritakan sedikit tentang Anda..."></textarea>
                    </div>
                </div>

                <div style="margin-top: 30px;">
                    <h1 class="section-title" style="font-size: 1.4rem;">Keamanan Akun</h1>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Kata Sandi Baru</label>
                            <input type="password" class="form-control" placeholder="Kosongkan jika tidak ingin diubah">
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Sandi</label>
                            <input type="password" class="form-control" placeholder="Ulangi sandi baru">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-save">Simpan Perubahan</button>
            </form>
        </main>
    </div>

</body>
</html>
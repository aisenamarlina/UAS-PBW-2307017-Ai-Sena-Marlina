<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Saya - Creating LC</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root { 
            --leather-dark: #3e2723; --leather-medium: #8b5e3c; --leather-light: #b08d57;
            --cream-bg: #fcfaf8; --white: #ffffff; --shadow: 0 10px 30px rgba(62, 39, 35, 0.05);
            --danger: #ef4444;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: var(--cream-bg); color: #2d241e; line-height: 1.6; }

        .navbar { background: var(--white); padding: 15px 8%; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #efeae6; position: sticky; top: 0; z-index: 1000; }
        .brand-container { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .brand-logo { height: 40px; }
        .menu-text { font-family: 'Playfair Display', serif; font-weight: 800; color: var(--leather-dark); font-size: 1.2rem; }

        .profile-form-wrapper { max-width: 1100px; margin: 40px auto; padding: 0 20px; }
        .container-layout { display: grid; grid-template-columns: 320px 1fr; gap: 30px; }

        .profile-sidebar { background: var(--white); border-radius: 25px; padding: 40px 30px; border: 1px solid #efeae6; box-shadow: var(--shadow); height: fit-content; text-align: center; }
        .avatar-wrapper { position: relative; width: 140px; height: 140px; margin: 0 auto 25px; cursor: pointer; }
        .avatar-img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; border: 5px solid var(--cream-bg); outline: 2px solid var(--leather-light); transition: 0.4s; }
        .avatar-wrapper:hover .avatar-img { transform: scale(1.05); filter: brightness(0.9); }
        .edit-avatar-badge { position: absolute; bottom: 8px; right: 8px; background: var(--leather-dark); color: white; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 3px solid white; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        
        .user-name { font-family: 'Playfair Display', serif; color: var(--leather-dark); margin-bottom: 5px; font-size: 1.4rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .user-role { color: var(--leather-medium); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; }

        .nav-menu { text-align: left; list-style: none; margin-top: 35px; border-top: 1px solid #f1ece7; padding-top: 20px; }
        .nav-menu li a { display: flex; align-items: center; gap: 12px; padding: 14px 18px; text-decoration: none; color: #64748b; font-weight: 600; border-radius: 15px; transition: 0.3s; margin-bottom: 5px; }
        .nav-menu li a.active { background: #fdf8f3; color: var(--leather-dark); }
        .nav-menu li a:hover:not(.active) { background: #f8fafc; color: var(--leather-medium); padding-left: 25px; }

        .content-card { background: var(--white); border-radius: 25px; padding: 45px; border: 1px solid #efeae6; box-shadow: var(--shadow); }
        .section-header { margin-bottom: 35px; }
        .section-title { font-family: 'Playfair Display', serif; font-size: 2rem; color: var(--leather-dark); margin-bottom: 10px; }
        .section-subtitle { color: #94a3b8; font-size: 0.95rem; }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 25px; }
        .form-group { margin-bottom: 5px; }
        .form-group label { display: block; font-size: 0.8rem; font-weight: 800; color: #64748b; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-control { width: 100%; padding: 14px 20px; border-radius: 15px; border: 1.5px solid #f1ece7; outline: none; transition: 0.3s; font-size: 1rem; color: var(--leather-dark); }
        .form-control:focus { border-color: var(--leather-medium); background: #fff; box-shadow: 0 0 0 4px rgba(139, 94, 60, 0.08); }
        .form-control.is-invalid { border-color: var(--danger); }

        .invalid-feedback { color: var(--danger); font-size: 0.75rem; margin-top: 5px; font-weight: 600; }

        .btn-save { background: var(--leather-dark); color: white; padding: 18px; border: none; border-radius: 18px; font-weight: 700; font-size: 1.1rem; cursor: pointer; transition: 0.3s; width: 100%; margin-top: 20px; box-shadow: 0 10px 20px rgba(62, 39, 35, 0.15); }
        .btn-save:hover { background: var(--leather-medium); transform: translateY(-3px); box-shadow: 0 15px 25px rgba(62, 39, 35, 0.2); }

        @media (max-width: 900px) { .container-layout { grid-template-columns: 1fr; } .content-card { padding: 30px; } }
        @media (max-width: 600px) { .form-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="/" class="brand-container">
            <img src="{{ asset('img/logo png.png') }}" alt="Logo" class="brand-logo">
            <span class="menu-text">CREATING LC</span>
        </a>
        <a href="{{ route('dashboard') }}" style="text-decoration:none; color:var(--leather-medium); font-weight:700; font-size: 0.85rem; display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-chevron-left"></i> KEMBALI
        </a>
    </nav>

    <div class="profile-form-wrapper">
        {{-- Pastikan Variabel User Terdefinisi --}}
        @php $user = Auth::user(); @endphp

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="mainProfileForm">
            @csrf
            @method('PUT')

            <div class="container-layout">
                {{-- SIDEBAR --}}
                <aside class="profile-sidebar">
                    <div class="avatar-wrapper" onclick="document.getElementById('avatar-input').click()">
                        @php
                            $avatarUrl = $user->avatar 
                                ? asset('storage/avatars/' . $user->avatar) 
                                : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=3e2723&color=fff&size=128';
                        @endphp
                        <img src="{{ $avatarUrl }}" alt="Avatar" class="avatar-img" id="avatar-preview">
                        <div class="edit-avatar-badge"><i class="fas fa-camera"></i></div>
                    </div>
                    
                    <input type="file" name="avatar" id="avatar-input" style="display: none;" accept="image/*" onchange="previewImage(this)">
                    
                    <h2 class="user-name">{{ $user->name }}</h2>
                    <span class="user-role">{{ $user->role ?? 'Pelanggan' }}</span>

                    <ul class="nav-menu">
                        <li><a href="#" class="active"><i class="fas fa-user-circle"></i> Profil Saya</a></li>
                        <li><a href="#"><i class="fas fa-shopping-bag"></i> Pesanan</a></li>
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: var(--danger);">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </a>
                        </li>
                    </ul>
                </aside>

                {{-- MAIN CONTENT --}}
                <main class="content-card">
                    <div class="section-header">
                        <h1 class="section-title">Informasi Pribadi</h1>
                        <p class="section-subtitle">Perbarui informasi akun dan foto profil Anda.</p>
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Alamat Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Nomor WhatsApp</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="birthday" class="form-control" value="{{ old('birthday', $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('Y-m-d') : '') }}">
                        </div>

                        <div class="form-group" style="grid-column: span 2;">
                            <label>Bio Singkat</label>
                            <textarea name="bio" class="form-control" rows="3">{{ old('bio', $user->bio) }}</textarea>
                        </div>
                    </div>

                    <div style="margin-top: 40px; border-top: 1px solid #f1ece7; padding-top: 35px;">
                        <h2 class="section-title" style="font-size: 1.5rem;">Keamanan</h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Kata Sandi Baru</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Isi hanya jika ingin diubah">
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Sandi</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi sandi baru">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                </main>
            </div>
        </form>
    </div>

    {{-- Hidden Logout Form --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>

    <script>
        // Preview Foto Profil
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Notifikasi Sukses
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#3e2723'
            });
        @endif
    </script>
</body>
</html>
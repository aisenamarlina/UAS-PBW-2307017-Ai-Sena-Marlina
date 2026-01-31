<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creating LC - Produk Admin</title>
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

        /* Main Wrapper */
        .main-wrapper-custom { margin-left: var(--sidebar-w); padding: 30px; transition: var(--transition); }
        .main-wrapper-custom.expanded { margin-left: var(--sidebar-collapsed-w); }

        /* Header & Buttons */
        .header-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .btn-add { background: var(--leather-brown); color: white; padding: 12px 24px; border-radius: 12px; text-decoration: none; font-weight: 700; display: flex; align-items: center; gap: 8px; border: none; cursor: pointer; transition: 0.3s; }
        .btn-add:hover { background: var(--accent-gold); transform: translateY(-2px); }

        /* Grid */
        .grid-container { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px; }
        .product-card { background: white; border-radius: 20px; overflow: hidden; box-shadow: var(--card-shadow); border: 1px solid rgba(0,0,0,0.03); transition: 0.3s; }
        .product-card:hover { transform: translateY(-5px); }
        .img-box { width: 100%; height: 220px; overflow: hidden; position: relative; }
        .img-box img { width: 100%; height: 100%; object-fit: cover; }
        .badge-stok { position: absolute; top: 12px; right: 12px; background: rgba(255,255,255,0.9); padding: 4px 10px; border-radius: 8px; font-size: 0.7rem; font-weight: 800; color: var(--leather-brown); }
        .info-box { padding: 20px; }
        .prod-price { color: var(--accent-gold); font-weight: 800; font-size: 1.1rem; }

        .action-btns { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 15px; padding-top: 15px; border-top: 1px solid #f3f4f6; }
        .btn-act { padding: 10px; border-radius: 8px; border: none; font-weight: 700; font-size: 0.8rem; cursor: pointer; text-align: center; text-decoration: none; transition: 0.2s; }
        .btn-edit { background: #fffbeb; color: var(--accent-gold); }
        .btn-del { background: #fef2f2; color: #ef4444; }

        /* Modal Perbaikan Upload */
        .modal { display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); align-items: center; justify-content: center; backdrop-filter: blur(4px); }
        .modal-content { background: white; padding: 30px; border-radius: 24px; width: 95%; max-width: 550px; box-shadow: 0 20px 40px rgba(0,0,0,0.2); max-height: 90vh; overflow-y: auto; }
        .modal-header { font-weight: 800; font-size: 1.4rem; margin-bottom: 25px; color: var(--leather-brown); display: flex; justify-content: space-between; align-items: center; }
        
        .upload-area { border: 2px dashed #e5e7eb; border-radius: 15px; padding: 20px; text-align: center; margin-bottom: 20px; cursor: pointer; transition: 0.3s; position: relative; }
        .upload-area:hover { border-color: var(--leather-brown); background: #fffbf7; }
        #preview-img { width: 100%; max-height: 200px; object-fit: contain; border-radius: 10px; display: none; margin-bottom: 10px; }
        .upload-icon { font-size: 2rem; color: #9ca3af; margin-bottom: 10px; }

        .form-label { display: block; font-size: 0.8rem; font-weight: 700; color: #6b7280; margin-bottom: 8px; text-transform: uppercase; }
        .form-input { width: 100%; padding: 14px; margin-bottom: 15px; border: 1.5px solid #f3f4f6; border-radius: 12px; outline: none; transition: 0.3s; }
        .form-input:focus { border-color: var(--leather-brown); }
    </style>
</head>
<body>

    <div id="productModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span id="modalTitle">Tambah Produk Baru</span>
                <i class="fas fa-times" onclick="closeModal()" style="cursor:pointer; color:#9ca3af;"></i>
            </div>
            
            <form id="productForm">
                <label class="form-label">Foto Produk</label>
                <div class="upload-area" onclick="document.getElementById('fileInput').click()">
                    <input type="file" id="fileInput" accept="image/*" style="display:none" onchange="previewFile()">
                    <img id="preview-img" src="">
                    <div id="placeholder-content">
                        <i class="fas fa-cloud-upload-alt upload-icon"></i>
                        <p style="font-size: 0.85rem; color: #6b7280;">Klik untuk upload foto produk</p>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div>
                        <label class="form-label">Nama Produk</label>
                        <input type="text" class="form-input" placeholder="Contoh: Dompet Card">
                    </div>
                    <div>
                        <label class="form-label">Kategori</label>
                        <select class="form-input">
                            <option>Dompet</option>
                            <option>Aksesoris</option>
                            <option>ID Card</option>
                        </select>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div>
                        <label class="form-label">Harga (Rp)</label>
                        <input type="number" class="form-input" placeholder="0">
                    </div>
                    <div>
                        <label class="form-label">Stok</label>
                        <input type="number" class="form-input" placeholder="0">
                    </div>
                </div>

                <div class="modal-footer" style="display: flex; gap: 10px; margin-top: 10px;">
                    <button type="button" class="btn-act" onclick="closeModal()" style="background:#f3f4f6; flex:1;">Batal</button>
                    <button type="button" class="btn-act" onclick="saveProduct()" style="background:var(--leather-brown); color:white; flex:2;">Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>

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
        <div class="header-section">
            <div style="display:flex; align-items:center; gap: 20px;">
                <button id="toggle-btn" style="background:white; border:none; width:45px; height:45px; border-radius:12px; cursor:pointer; color:var(--leather-brown); box-shadow: var(--card-shadow);"><i class="fas fa-bars"></i></button>
                <h2 style="font-weight:800;">Manajemen Produk</h2>
            </div>
            <button class="btn-add" onclick="openModal('Tambah')"><i class="fas fa-plus"></i> Tambah Produk</button>
        </div>

        <div class="grid-container">
    @foreach($products as $product)
    <div class="product-card">
        <div class="img-box">
            <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}">
            <span class="badge-stok">STOK: {{ $product->stock ?? 0 }}</span>
        </div>
        <div class="info-box">
            <span class="prod-category">{{ $product->category }}</span>
            <h3 class="prod-name">{{ $product->name }}</h3>
            <p class="prod-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            
            <div class="action-btns">
                <button onclick="openModal('Edit')" class="btn-act btn-edit">Edit</button>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-act btn-del" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                </form>
            </div>

            <a href="{{ url('/cart/add/' . $product->id) }}" class="btn-add" style="margin-top: 10px; justify-content: center; text-decoration: none;">
                <i class="fas fa-shopping-cart"></i> Beli Sekarang
            </a>
        </div>
    </div>
    @endforeach
</div>
            <div class="product-card">
                <div class="img-box">
                    <img src="https://assets.kompasiana.com/items/album/2025/10/19/dompppet-68f4b2a5ed64152e8c73adf2.jpg?t=o&v=740&x=416">
                    <span class="badge-stok">STOK: 20</span>
                </div>
                <div class="info-box">
                    <span class="prod-category">Dompet</span>
                    <h3 class="prod-name">Dompet Pria Pendek</h3>
                    <p class="prod-price">Rp 150.000</p>
                    <div class="action-btns">
                        <button onclick="openModal('Edit')" class="btn-act btn-edit">Edit</button>
                        <button onclick="confirmDelete()" class="btn-act btn-del">Hapus</button>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <div class="img-box">
                    <img src="https://assets.kompasiana.com/items/album/2025/10/19/id-68f4b2f434777c3d8a5035a2.jpg?t=o&v=740&x=416">
                    <span class="badge-stok">STOK: 35</span>
                </div>
                <div class="info-box">
                    <span class="prod-category">ID Card</span>
                    <h3 class="prod-name">ID Card Kulit</h3>
                    <p class="prod-price">Rp 85.000</p>
                    <div class="action-btns">
                        <button onclick="openModal('Edit')" class="btn-act btn-edit">Edit</button>
                        <button onclick="confirmDelete()" class="btn-act btn-del">Hapus</button>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <div class="img-box">
                    <img src="https://assets.kompasiana.com/items/album/2025/10/19/dompettt-68f4b34934777c43a6172872.jpg?t=o&v=740&x=416">
                    <span class="badge-stok">STOK: 50</span>
                </div>
                <div class="info-box">
                    <span class="prod-category">Aksesoris</span>
                    <h3 class="prod-name">Gantungan Kunci STNK</h3>
                    <p class="prod-price">Rp 55.000</p>
                    <div class="action-btns">
                        <button onclick="openModal('Edit')" class="btn-act btn-edit">Edit</button>
                        <button onclick="confirmDelete()" class="btn-act btn-del">Hapus</button>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <div class="img-box">
                    <img src="https://assets.kompasiana.com/items/album/2025/10/19/dompetk-68f4b43ec925c47cd01e3082.jpg?t=o&v=740&x=416">
                    <span class="badge-stok">STOK: 25</span>
                </div>
                <div class="info-box">
                    <span class="prod-category">Dompet</span>
                    <h3 class="prod-name">Card Holder Unisex</h3>
                    <p class="prod-price">Rp 120.000</p>
                    <div class="action-btns">
                        <button onclick="openModal('Edit')" class="btn-act btn-edit">Edit</button>
                        <button onclick="confirmDelete()" class="btn-act btn-del">Hapus</button>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <div class="img-box">
                    <img src="https://assets.kompasiana.com/items/album/2025/10/19/gantungann-68f4b51dc925c404b611bfc3.jpg?t=o&v=740&x=416">
                    <span class="badge-stok">STOK: 100</span>
                </div>
                <div class="info-box">
                    <span class="prod-category">Aksesoris</span>
                    <h3 class="prod-name">Gantungan Kunci</h3>
                    <p class="prod-price">Rp 35.000</p>
                    <div class="action-btns">
                        <button onclick="openModal('Edit')" class="btn-act btn-edit">Edit</button>
                        <button onclick="confirmDelete()" class="btn-act btn-del">Hapus</button>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script>
        const btn = document.getElementById('toggle-btn');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('main-content');

        // Sidebar Toggle
        btn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('expanded');
        });

        // Preview File Gambar
        function previewFile() {
            const preview = document.getElementById('preview-img');
            const file = document.getElementById('fileInput').files[0];
            const placeholder = document.getElementById('placeholder-content');
            const reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }

        // Modal Controls
        function openModal(type) {
            document.getElementById('modalTitle').innerText = type + " Produk";
            document.getElementById('productModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('productModal').style.display = 'none';
            // Reset form saat tutup
            document.getElementById('productForm').reset();
            document.getElementById('preview-img').style.display = 'none';
            document.getElementById('placeholder-content').style.display = 'block';
        }

        function saveProduct() {
            alert("Produk dan Foto berhasil disimpan!");
            closeModal();
        }

        function confirmDelete() {
            if(confirm("Hapus produk ini?")) alert("Terhapus!");
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('productModal')) closeModal();
        }
    </script>
</body>
</html>
@extends('layouts.app')

@section('content')
<style>
    /* Gunakan variabel yang sama untuk konsistensi */
    :root {
        --espresso: #3d2b1f;
        --leather-tan: #a67c52;
        --soft-gray: #f8f9fa;
    }

    .main-content {
        margin-left: calc(var(--sidebar-w, 260px) + 40px);
        padding: 40px;
        transition: all 0.5s ease;
    }

    .form-container {
        background: #ffffff;
        border-radius: 40px;
        padding: 50px;
        box-shadow: 0 15px 50px rgba(0,0,0,0.02);
        max-width: 900px;
        margin: 0 auto;
        border: 1px solid rgba(0,0,0,0.03);
    }

    .form-header {
        margin-bottom: 40px;
        text-align: center;
    }

    .form-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        color: var(--espresso);
    }

    .input-group-luxe {
        margin-bottom: 25px;
    }

    .input-group-luxe label {
        display: block;
        font-weight: 700;
        font-size: 0.85rem;
        color: #a3aed0;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .input-group-luxe input, 
    .input-group-luxe select, 
    .input-group-luxe textarea {
        width: 100%;
        padding: 15px 20px;
        border-radius: 18px;
        border: 1.5px solid #eee;
        background: #fafafa;
        color: var(--espresso);
        font-weight: 500;
        transition: 0.3s;
    }

    .input-group-luxe input:focus {
        outline: none;
        border-color: var(--leather-tan);
        background: #fff;
        box-shadow: 0 5px 15px rgba(166, 124, 82, 0.05);
    }

    .image-upload-box {
        border: 2px dashed #eee;
        border-radius: 25px;
        padding: 40px;
        text-align: center;
        cursor: pointer;
        transition: 0.3s;
    }

    .image-upload-box:hover {
        border-color: var(--leather-tan);
        background: #fffdfb;
    }

    .btn-save {
        background: var(--espresso);
        color: white;
        border: none;
        padding: 18px 40px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 1rem;
        width: 100%;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 20px;
    }

    .btn-save:hover {
        background: var(--leather-tan);
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(166, 124, 82, 0.2);
    }
</style>

<div class="main-content">
    <div class="form-container">
        <div class="form-header">
            <p style="color: var(--leather-tan); font-weight: 700; font-size: 0.75rem; letter-spacing: 2px;">PRODUCT MANAGEMENT</p>
            <h2>Tambah Produk Baru</h2>
        </div>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-7">
                    <div class="input-group-luxe">
                        <label>Nama Produk Kerajinan</label>
                        <input type="text" name="name" placeholder="Contoh: Tas Kulit Garut Premium" required>
                    </div>

                    <div class="input-group-luxe">
                        <label>Kategori</label>
                        <select name="category" required>
                            <option value="tas">Tas Pria/Wanita</option>
                            <option value="dompet">Dompet Kulit</option>
                            <option value="sabuk">Sabuk / Ikat Pinggang</option>
                            <option value="aksesoris">Aksesoris</option>
                        </select>
                    </div>

                    <div class="input-group-luxe">
                        <label>Deskripsi Detail</label>
                        <textarea name="description" rows="5" placeholder="Ceritakan keunggulan material kulit Anda..."></textarea>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="input-group-luxe">
                        <label>Harga (IDR)</label>
                        <input type="number" name="price" placeholder="0" required>
                    </div>

                    <div class="input-group-luxe">
                        <label>Stok Barang</label>
                        <input type="number" name="stock" placeholder="Jumlah ketersediaan">
                    </div>

                    <div class="input-group-luxe">
                        <label>Foto Produk</label>
                        <div class="image-upload-box" onclick="document.getElementById('fileInput').click()">
                            <i class="fas fa-cloud-upload-alt" style="font-size: 2rem; color: #cbd5e0; margin-bottom: 10px;"></i>
                            <p style="font-size: 0.8rem; color: #a3aed0;">Klik untuk upload foto produk</p>
                            <input type="file" id="fileInput" name="image" style="display:none">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-save">Simpan ke Katalog</button>
            <a href="{{ route('dashboard') }}" style="display: block; text-align: center; margin-top: 20px; color: #a3aed0; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Batal dan Kembali</a>
        </form>
    </div>
</div>
@endsection
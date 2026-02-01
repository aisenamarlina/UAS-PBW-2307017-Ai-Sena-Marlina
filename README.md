
# Creating Leather Craft -  E-Commerce System

**Kerajinan Kulit Asli Garut Handmade**

Aplikasi e-commerce berbasis web yang menyediakan platform jual-beli produk kulit premium asli Garut. Sistem ini mengintegrasikan pengalaman belanja pelanggan (loyalty points & shopping basket) dengan manajemen toko yang komprehensif bagi admin.

## 👤 Informasi Mahasiswa

* **Nama:** Sena Marlina
* **NIM:** 2307017

## 🚀 Teknologi yang Digunakan

* **Framework:** Laravel 10.
* **Environment:** Laragon (Local Server) & Visual Studio Code (Editor).
* **Database:** MySQL dengan sistem Migration dan Seeding.
* **Frontend:** Blade Templating, Custom CSS (Font: Plus Jakarta Sans), Font Awesome 6.

## ⚙️ Panduan Instalasi & Menjalankan Aplikasi

### 1. Persiapan Environment

Pastikan Anda menjalankan **Laragon** dan memiliki **PHP 8.1+** serta **Composer** yang terinstal.

### 2. Instalasi Dependency

Buka terminal di VS Code pada direktori proyek dan jalankan:

```bash
# Instal library PHP via Composer
composer install

# Update autoload jika diperlukan
composer dump-autoload

```

### 3. Konfigurasi Database

1. Buat database baru di Laragon/phpMyAdmin dengan nama `creating_leather_craft`.
2. Edit file `.env` di root proyek:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=leathercraft
DB_USERNAME=root
DB_PASSWORD=

```

### 4. Migrasi Database & Seeding

Jalankan perintah ini untuk membuat struktur tabel dan mengisi data awal:

```bash
php artisan migrate
php artisan db:seed --class=DatabaseSeeder

```

### 5. Menjalankan Aplikasi

```bash
php artisan serve

```

Akses aplikasi melalui browser di: `http://127.0.0.1:8000`.

## 📸 Tangkapan Layar Aplikasi

*(File gambar dapat ditemukan di folder `public/img/Screenshots/` atau `public/img/`)*.

### 1. Dashboard Pelanggan (User Side)

Halaman utama pelanggan yang menampilkan profil, Loyalty Points (200 pts), keranjang belanja, dan status pengiriman.

### 2. Manajemen Produk (Admin Side)

Antarmuka admin untuk mengelola katalog produk (Dompet Panjang, Pendek, ID Card) dan memantau stok secara real-time.

### 3. Lingkungan Pengembangan (VS Code)

Proses migrasi database dan manajemen file di dalam VS Code terminal.

## 🛠️ Fitur Utama

* **Loyalty Points System:** Pelanggan mendapatkan poin (seperti 200 poin) dari aktivitas akun atau transaksi.
* **Shopping Basket:** Fitur keranjang untuk mengelola item sebelum checkout.
* **Admin Inventory:** CRUD produk lengkap dengan badge indikator stok untuk setiap barang.
* **Modern UI/UX:** Sidebar responsif dengan navigasi lengkap (Dashboard, Produk, Pesanan, Laporan, Chat, Setting).

---


### 📸 Tangkapan Layar Aplikasi

#### 1. Antarmuka Pengguna (User Interface)

Halaman utama dan proses belanja pelanggan:

* **Tampilan Beranda 1:** `![Beranda 1](public/img/tampilan-awaln-1.png)`
* **Tampilan Beranda 2:** `![Beranda 2](public/img/tampilan-awaln-2.png)`
* **Halaman Produk:** `![Produk](public/img/halaman-produk-user.png)`
* **Keranjang Belanja:** `![Keranjang](public/img/keranjang-belanja.png)`
* **Proses Checkout:** `![Checkout](public/img/halaman-checkout.png)`
* **Detail Pesanan:** `![Detail Pesanan](public/img/halaman-detail-pesanan.png)`
* **Cek Resi:** `![Cek Resi](public/img/halaman-cek-resi.png)`
* **Halaman Chat:** `![Chat](public/img/halaman-chat.png)`
* **Akun User:** `![Akun User](public/img/halaman-akun-user.png)`

---

### 🛠️ Bagian Admin / Manajemen (Opsional)

Jika Anda ingin menambahkan bagian manajemen yang ada di folder tersebut:

* **Manajemen Produk:** `![Manajemen Produk](public/img/manajemenproduk.png)`
* **Manajemen Pesanan:** `![Manajemen Pesanan](public/img/halaman-manajemen-pemesanan.png)`
* **Laporan Keuangan:** `![Laporan Keuangan](public/img/laporan-keuangan.png)`
* **Konfirmasi Pesanan:** `![Konfirmasi](public/img/komfirmasi-pesanan.png)`


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


### 📸 Tangkapan Layar Aplikasi

#### 1. Antarmuka Pengguna (User Interface)
![Tampilan Beranda 1](public/img/tampilan-awaln-1.png)
![Tampilan Beranda 2](public/img/tampilan-awaln-2.png)

## 2. Login - Register
<img width="1159" height="644" alt="login" src="https://github.com/user-attachments/assets/1f570083-b874-4647-b570-66aba21aa39f" />
<img width="1222" height="643" alt="registrasi" src="https://github.com/user-attachments/assets/f4dd4965-cf5d-45db-9208-6dc1841136b8" />


## 3. Bagian User
## Dashboard User
<img width="1366" height="614" alt="halaman-dashboard-user" src="https://github.com/user-attachments/assets/39bf16f6-8b8f-4d20-a070-a4ff193ab937" />
## Halaman Katalog
![Halaman Produk](public/img/halaman-produk-user.png)
## Halaman Keranjang
![Keranjang Belanja](public/img/keranjang-belanja.png)
## Halaman Checkout
![Proses Checkout](public/img/halaman-checkout.png)
<img width="900" height="521" alt="halaman-checkout-2" src="https://github.com/user-attachments/assets/e10364b8-28ab-48a3-b114-a2493a407548" />
## Halaman Detail Pesanan
<img width="732" height="413" alt="halaman-detail-pesanan" src="https://github.com/user-attachments/assets/8b1020b1-6b2a-4ca1-9362-8b7b4f3d9e2b" />
## Halaman Cek Resi
<img width="698" height="365" alt="halaman-cek-resi" src="https://github.com/user-attachments/assets/89bc1fd3-f97a-4739-8538-b0b65ac52eb0" />


#### 4. Bagian Admin / Manajemen
## Manajemen Produk
![Manajemen Produk](public/img/manajemenproduk.png)
## Manajemen Pemesanan
![Manajemen Pesanan](public/img/halaman-manajemen-pemesanan.png)
## Laporan Keuangan
![Laporan Keuangan](public/img/laporan-keuangan.png)
## Konfirmasi Pesanan 
<img width="1366" height="618" alt="komfirmasi-pesanan" src="https://github.com/user-attachments/assets/c5c41272-a1bf-4a58-ac7e-277ead47ee45" />
## Manajemen Produk
<img width="1361" height="616" alt="manajemenproduk" src="https://github.com/user-attachments/assets/f790d393-8501-40d2-8509-639d71afde10" />




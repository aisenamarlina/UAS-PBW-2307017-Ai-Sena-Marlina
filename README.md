# Creating Leather Craft – E-Commerce System

**Kerajinan Kulit Asli Garut Handmade**

Aplikasi e-commerce berbasis web yang menyediakan platform jual-beli produk kulit premium asli Garut. Sistem ini dirancang untuk mengintegrasikan pengalaman belanja pelanggan (loyalty points & shopping basket) dengan sistem manajemen toko yang komprehensif bagi admin.

---

## 👤 Informasi Mahasiswa

* **Nama:** Sena Marlina
* **NIM:** 2307017

---

## 🚀 Teknologi yang Digunakan

* **Framework:** Laravel 10
* **Environment:** Laragon (Local Server), Visual Studio Code (Editor)
* **Database:** MySQL (Migration & Seeding)
* **Frontend:** Blade Templating, Custom CSS
  Font: *Plus Jakarta Sans*, Font Awesome 6

---

## ⚙️ Panduan Instalasi & Menjalankan Aplikasi

### 1. Persiapan Environment

Pastikan **Laragon** telah berjalan dan sistem memiliki:

* PHP versi **8.1+**
* Composer

### 2. Instalasi Dependency

Jalankan perintah berikut melalui terminal di direktori proyek:

```bash
composer install
composer dump-autoload
```

### 3. Konfigurasi Database

1. Buat database baru melalui phpMyAdmin dengan nama:

   ```
   creating_leather_craft
   ```
2. Konfigurasikan file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=leathercraft
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrasi & Seeding Database

```bash
php artisan migrate
php artisan db:seed --class=DatabaseSeeder
```

### 5. Menjalankan Aplikasi

```bash
php artisan serve
```

Akses aplikasi melalui browser:

```
http://127.0.0.1:8000
```

---

## 🛠️ Fitur Utama

* **Loyalty Points System** – Pelanggan memperoleh poin dari aktivitas dan transaksi.
* **Shopping Basket** – Keranjang belanja untuk mengelola produk sebelum checkout.
* **Admin Inventory Management** – CRUD produk dengan indikator stok real-time.
* **Modern UI/UX** – Sidebar responsif dan navigasi terstruktur (Dashboard, Produk, Pesanan, Laporan, Chat, Setting).

---

## 📸 Dokumentasi Antarmuka Aplikasi

### 1. Antarmuka Pengguna (User Interface)

#### Tampilan Beranda

![Tampilan Beranda 1](public/img/tampilan-awaln-1.png)
![Tampilan Beranda 2](public/img/tampilan-awaln-2.png)

---

### 2. Login & Register

**Halaman Login**

<img width="1159" height="644" alt="Login" src="https://github.com/user-attachments/assets/1f570083-b874-4647-b570-66aba21aa39f" />

**Halaman Registrasi**

<img width="1222" height="643" alt="Registrasi" src="https://github.com/user-attachments/assets/f4dd4965-cf5d-45db-9208-6dc1841136b8" />

---

### 3. Bagian User

**Dashboard User**

<img width="1366" height="614" alt="Dashboard User" src="https://github.com/user-attachments/assets/39bf16f6-8b8f-4d20-a070-a4ff193ab937" />

**Halaman Katalog Produk**

![Halaman Produk](public/img/halaman-produk-user.png)

**Halaman Keranjang Belanja**

![Keranjang Belanja](public/img/keranjang-belanja.png)

**Halaman Checkout**

![Proses Checkout](public/img/halaman-checkout.png)

<img width="900" height="521" alt="Checkout Detail" src="https://github.com/user-attachments/assets/e10364b8-28ab-48a3-b114-a2493a407548" />

**Halaman Detail Pesanan**

<img width="732" height="413" alt="Detail Pesanan" src="https://github.com/user-attachments/assets/8b1020b1-6b2a-4ca1-9362-8b7b4f3d9e2b" />

**Halaman Cek Resi**

<img width="698" height="365" alt="Cek Resi" src="https://github.com/user-attachments/assets/89bc1fd3-f97a-4739-8538-b0b65ac52eb0" />

---

### 4. Bagian Admin / Manajemen

**Manajemen Produk**

![Manajemen Produk](public/img/manajemenproduk.png)

<img width="1361" height="616" alt="Manajemen Produk Admin" src="https://github.com/user-attachments/assets/f790d393-8501-40d2-8509-639d71afde10" />

**Manajemen Pemesanan**

![Manajemen Pesanan](public/img/halaman-manajemen-pemesanan.png)

**Konfirmasi Pesanan**

<img width="1366" height="618" alt="Konfirmasi Pesanan" src="https://github.com/user-attachments/assets/c5c41272-a1bf-4a58-ac7e-277ead47ee45" />

**Laporan Keuangan**

![Laporan Keuangan](public/img/laporan-keuang

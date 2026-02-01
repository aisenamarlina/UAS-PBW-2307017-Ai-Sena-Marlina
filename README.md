# 👜 Creating Leather Craft – E-Commerce System

**Kerajinan Kulit Asli Garut Handmade**

---

## 👤 Identitas Mahasiswa

* **Nama:** Sena Marlina
* **NIM:** 2307017
* **Mata Kuliah:** Pemrograman Berbasis Web
* **Topik Project:** Sistem Informasi E-Commerce Kerajinan Kulit

---

## 📝 Deskripsi Aplikasi

**Creating Leather Craft – E-Commerce System** merupakan aplikasi e-commerce berbasis web yang dirancang untuk menampilkan, mengelola, dan memproses penjualan produk kerajinan kulit khas Garut. Aplikasi ini dikembangkan sebagai project pembelajaran pada mata kuliah Pemrograman Berbasis Web dengan menerapkan konsep **fullstack development**, mulai dari pengelolaan database, backend, hingga antarmuka pengguna (UI/UX).

Sistem ini mendukung dua peran utama, yaitu **user (pelanggan)** dan **admin**, yang masing-masing memiliki hak akses dan fitur berbeda untuk menunjang proses transaksi dan manajemen produk secara terintegrasi.

---

## 👥 Pihak yang Terlibat

* **Sena Marlina** – Mahasiswa / Fullstack Developer
  Bertanggung jawab atas analisis sistem, perancangan UI/UX, pengembangan backend dan frontend, pengelolaan database, serta dokumentasi aplikasi.

* **Dosen Pengampu Mata Kuliah** – Pembimbing Akademik
  Memberikan arahan, evaluasi, dan penilaian terhadap pengembangan project.

---

## 📊 Sumber Data (Public API)

Pada pengembangan aplikasi **Creating Leather Craft – E-Commerce System**, **tidak menggunakan Public API (Free Public API)**.

Seluruh data bersumber dari **database lokal MySQL** yang dikelola secara mandiri menggunakan fitur **migration** dan **seeding** pada framework Laravel.

Data yang digunakan meliputi:

* Data produk kerajinan kulit
* Data pengguna (user dan admin)
* Data pemesanan dan transaksi
* Data laporan keuangan

Pendekatan ini dipilih untuk:

* Memberikan kontrol penuh terhadap data
* Mendukung implementasi CRUD secara menyeluruh
* Menyesuaikan kebutuhan pembelajaran Pemrograman Berbasis Web

---

## 🚀 Fitur-Fitur Aplikasi

### 👤 Fitur User (Pelanggan)

* Registrasi dan login pengguna
* Melihat katalog produk kerajinan kulit
* Menambahkan produk ke keranjang belanja
* Proses checkout dan pemesanan
* Melihat detail dan riwayat pesanan
* Cek status pengiriman (resi)
* Sistem **Loyalty Points**

### 🛠️ Fitur Admin

* Manajemen produk (Create, Read, Update, Delete)
* Manajemen pesanan pelanggan
* Konfirmasi dan update status pesanan
* Monitoring stok produk
* Laporan keuangan penjualan

---

## 🛠️ Teknologi yang Digunakan

| Bagian      | Teknologi                         |
| ----------- | --------------------------------- |
| Backend     | Laravel 10                        |
| Frontend    | Blade Templating, Custom CSS      |
| Database    | MySQL                             |
| UI Asset    | Font Awesome 6, Plus Jakarta Sans |
| Environment | Laragon                           |
| Tools       | Visual Studio Code, Git           |

---

## ⚙️ Langkah Instalasi & Menjalankan Project

### 1️⃣ Persiapan Environment

Pastikan perangkat telah terinstal:

* PHP **>= 8.1**
* Composer
* MySQL
* Laragon / XAMPP

---

### 2️⃣ Instalasi Backend (Laravel)

```bash
composer install
composer dump-autoload
```

---

### 3️⃣ Konfigurasi Database

Buat database baru dengan nama:

```text
leathercraft
```

Atur konfigurasi database pada file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=leathercraft
DB_USERNAME=root
DB_PASSWORD=
```

---

### 4️⃣ Migrasi & Seeding Database

```bash
php artisan migrate
php artisan db:seed --class=DatabaseSeeder
```

---

### 5️⃣ Menjalankan Aplikasi

```bash
php artisan serve
```

Akses aplikasi melalui browser:

```text
http://127.0.0.1:8000
```

---


---

## 📸 Dokumentasi Aplikasi (Screenshots)

### A. Antarmuka Pengguna (User Interface)

#### Tampilan Beranda

![Tampilan Beranda 1](public/img/tampilan-awaln-1.png)
![Tampilan Beranda 2](public/img/tampilan-awaln-2.png)

---

#### Login & Registrasi

<img width="1159" height="644" alt="Login" src="https://github.com/user-attachments/assets/1f570083-b874-4647-b570-66aba21aa39f" />

<img width="1222" height="643" alt="Registrasi" src="https://github.com/user-attachments/assets/f4dd4965-cf5d-45db-9208-6dc1841136b8" />

---

#### Dashboard User

<img width="1366" height="614" alt="Dashboard User" src="https://github.com/user-attachments/assets/39bf16f6-8b8f-4d20-a070-a4ff193ab937" />

---

#### Katalog Produk & Keranjang

![Halaman Produk](public/img/halaman-produk-user.png)
![Keranjang Belanja](public/img/keranjang-belanja.png)

---

#### Checkout & Detail Pesanan

![Checkout](public/img/halaman-checkout.png)

<img width="900" height="521" alt="Checkout Detail" src="https://github.com/user-attachments/assets/e10364b8-28ab-48a3-b114-a2493a407548" />

<img width="732" height="413" alt="Detail Pesanan" src="https://github.com/user-attachments/assets/8b1020b1-6b2a-4ca1-9362-8b7b4f3d9e2b" />

---

### B. Antarmuka Admin

#### Manajemen Produk

![Manajemen Produk](public/img/manajemenproduk.png)


---

#### Manajemen Pemesanan & Konfirmasi

![Manajemen Pesanan](public/img/halaman-manajemen-pemesanan.png)

<img width="1366" height="618" alt="Konfirmasi Pesanan" src="https://github.com/user-attachments/assets/c5c41272-a1bf-4a58-ac7e-277ead47ee45" />

---

#### Laporan Keuangan

![Laporan Keuangan](public/img/laporan-keuangan.png)

---


# 👜 Creating Leather Craft – E-Commerce System 

**Kerajinan Kulit Asli Garut Handmade**

Creating Leather Craft adalah aplikasi e-commerce berbasis web yang menampilkan dan mengelola penjualan produk kerajinan kulit premium khas Garut. Project ini dikembangkan sebagai **Fullstack Web Application** dengan fokus pada manajemen produk, transaksi pemesanan, serta pengalaman pengguna (UI/UX) yang modern dan responsif.

---

## 👤 Identitas Mahasiswa

* **Nama:** Sena Marlina
* **NIM:** 2307017
* **Mata Kuliah:** Pemrograman Berbasis Web
* **Topik Project:** Sistem Informasi E-Commerce Kerajinan Kulit

---
Siap 👍 aku rapikan dan **tambahkan deskripsi singkat setelah Identitas Mahasiswa**, lalu **langsung masuk ke bagian Sumber Data (Public API)** dengan bahasa formal-akademik yang rapi dan siap dikumpulkan.

Berikut versi **hasil revisinya** (tinggal tempel):

---

## 👤 Identitas Mahasiswa

* **Nama:** Sena Marlina
* **NIM:** 2307017
* **Mata Kuliah:** Pemrograman Berbasis Web
* **Topik Project:** Sistem Informasi E-Commerce Kerajinan Kulit

**Deskripsi Singkat Proyek**
Project *Creating Leather Craft – E-Commerce System* merupakan aplikasi e-commerce berbasis web yang dikembangkan untuk mendukung proses penjualan dan pengelolaan produk kerajinan kulit khas Garut. Sistem ini dirancang untuk membantu pelaku usaha dalam mengelola data produk, pemesanan, transaksi, serta laporan keuangan secara terstruktur dan terintegrasi, sekaligus memberikan pengalaman belanja yang mudah dan nyaman bagi pengguna.

---

##  Sumber Data (Public API)

Pada pengembangan aplikasi **Creating Leather Craft – E-Commerce System**, sistem **tidak menggunakan Public API (Free Public API)**.

Seluruh data yang digunakan dalam aplikasi bersumber dari **database lokal MySQL** yang dikelola secara mandiri menggunakan framework **Laravel**, melalui proses **migration** dan **database seeding**.

Adapun data yang dikelola dalam sistem meliputi:

* Data produk kerajinan kulit
* Data pengguna (user dan admin)
* Data pemesanan dan transaksi
* Data laporan keuangan

Pendekatan ini dipilih dengan pertimbangan:

* Memberikan kontrol penuh terhadap pengelolaan dan keamanan data
* Mendukung penerapan fungsi **CRUD (Create, Read, Update, Delete)** secara menyeluruh
* Menyesuaikan dengan kebutuhan pembelajaran pada mata kuliah **Pemrograman Berbasis Web**

---

## 🚀 Fitur Utama

### 👤 Sisi User (Pelanggan)

* Registrasi & Login pengguna
* Katalog produk kerajinan kulit
* Keranjang belanja (Shopping Cart)
* Proses checkout pemesanan
* Detail dan riwayat pesanan
* Cek resi pengiriman
* Sistem **Loyalty Points** untuk pengguna

### 🛠️ Sisi Admin

* Manajemen produk (Create, Read, Update, Delete)
* Manajemen pemesanan pelanggan
* Konfirmasi status pesanan
* Laporan keuangan
* Monitoring stok produk secara real-time

---

## 🛠️ Tech Stack

| Bagian      | Teknologi                         |
| ----------- | --------------------------------- |
| Backend     | Laravel 10                        |
| Frontend    | Blade Templating, Custom CSS      |
| Database    | MySQL                             |
| UI Asset    | Font Awesome 6, Plus Jakarta Sans |
| Environment | Laragon                           |
| Tools       | Visual Studio Code, Git           |

---

## 📋 Langkah Instalasi & Menjalankan Project

### 1️⃣ Persiapan Environment

Pastikan perangkat telah terpasang:

* PHP **>= 8.1**
* Composer
* MySQL (Larago)

---

### 2️⃣ Instalasi Backend (Laravel)

```bash
composer install
composer dump-autoload
```

---

### 3️⃣ Konfigurasi Database

Buat database baru melalui phpMyAdmin dengan nama:

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

<img width="1361" height="616" alt="Manajemen Produk Admin" src="https://github.com/user-attachments/assets/f790d393-8501-40d2-8509-639d71afde10" />

---

#### Manajemen Pemesanan & Konfirmasi

![Manajemen Pesanan](public/img/halaman-manajemen-pemesanan.png)

<img width="1366" height="618" alt="Konfirmasi Pesanan" src="https://github.com/user-attachments/assets/c5c41272-a1bf-4a58-ac7e-277ead47ee45" />

---

#### Laporan Keuangan

![Laporan Keuangan](public/img/laporan-keuangan.png)

---

## 👥 Orang yang Terlibat

* **Sena Marlina** – Mahasiswa / Fullstack Developer
  (Analisis sistem, UI/UX, pengembangan backend & frontend, database, dan dokumentasi)

* **Dosen Pengampu Mata Kuliah** – Pembimbing Akademik

---

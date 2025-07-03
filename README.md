# Sistem Informasi Perpustakaan - Laravel 11

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Laravel](https://img.shields.io/badge/Laravel-11-red.svg)](https://laravel.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5-blueviolet.svg)](https://getbootstrap.com)

Aplikasi web sederhana untuk manajemen perpustakaan yang dibangun menggunakan Laravel 11. Aplikasi ini dirancang untuk memudahkan admin dalam mengelola data buku, anggota, serta proses peminjaman dan pengembalian.

![image](https://github.com/user-attachments/assets/8b481839-64d9-43cf-a8a7-ce555923074e)

## ✨ Fitur Utama
https://github.com/Syzhaa/perpustakaan1/issues
- **Dashboard Admin**: Menampilkan ringkasan data statistik perpustakaan secara visual
- **Manajemen Buku**: Operasi CRUD (Tambah, Lihat, Edit, Hapus) untuk data buku
- **Manajemen Anggota**: Operasi CRUD untuk data anggota
- **Manajemen Peminjaman**:
  - Mencatat transaksi peminjaman buku
  - Admin dapat membuat buku baru langsung dari form peminjaman
  - Menandai buku yang telah dikembalikan
- **Impor Data dari Excel**: Menambahkan data buku dan anggota secara massal dari file .xlsx atau .csv
- **Sistem Role**: Pembagian hak akses antara Admin dan Anggota

## 🛠️ Teknologi yang Digunakan

- **Framework**: Laravel 11
- **Frontend**: Blade & Bootstrap 5
- **Database**: MySQL
- **Packages Utama**:
  - Laravel Breeze (untuk sistem login & registrasi)
  - Maatwebsite/Excel (untuk fitur impor data)

## 🚀 Panduan Instalasi

Berikut adalah langkah-langkah untuk menginstal dan menjalankan proyek ini di lingkungan pengembangan lokal Anda.

### 📋 Prasyarat

Pastikan perangkat lunak berikut sudah terpasang di komputer Anda:

- Laragon atau XAMPP (sudah termasuk PHP, MySQL/MariaDB, Apache)
- Composer ([Download di sini](https://getcomposer.org/download/))
- Node.js & NPM ([Download di sini](https://nodejs.org/))
- Git ([Download di sini](https://git-scm.com/))

### Langkah-langkah Instalasi

1. **Clone Repositori**

   ```bash
   git clone https://github.com/Syzhaa/perpustakaan1.git
   cd perpustakaan1
   ```

2. **Install Dependensi**

   ```bash
   composer install
   npm install
   ```

3. **Setup File .env**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi Database**
   - Buat database baru dengan nama `perpustakaan1` di phpMyAdmin
   - Sesuaikan konfigurasi database di file `.env`:

     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=perpustakaan1
     DB_USERNAME=root
     DB_PASSWORD=
     ```

5. **Jalankan Migrasi dan Seeder**

   ```bash
   php artisan migrate --seed
   ```

6. **Compile Aset Frontend**

   ```bash
   npm run dev
   ```

7. **Jalankan Server Aplikasi**

   ```bash
   php artisan serve
   ```

Aplikasi Anda sekarang siap diakses melalui browser di alamat [http://localhost:8000](http://localhost:8000).

## 👤 Akun Admin Default

Setelah menjalankan perintah `migrate --seed`, akun admin default akan dibuat secara otomatis dengan kredensial berikut:

- **Email**: admin@example.com
- **Password**: password

Anda bisa langsung login menggunakan akun ini untuk mengakses semua fitur admin.

## 📄 Lisensi

Proyek ini berada di bawah lisensi [MIT](LICENSE).

---

**Dikembangkan dengan ❤️ oleh [Syzhaa]**  
⭐ Jangan lupa beri bintang jika proyek ini bermanfaat!

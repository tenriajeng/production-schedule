# Dokumentasi Proyek Laravel 10 - Production Schedule

## Prasyarat

Sebelum memulai, pastikan Anda telah menginstal prasyarat berikut:

- **PHP** (versi 8.0 atau lebih baru)
- **Composer** (versi terbaru)
- **Node.js** (versi 14 atau lebih baru)
- **Database** (MySQL, PostgreSQL, SQLite, atau yang lain)

## Kloning Repository

Untuk memulai, kloning repositori proyek ke mesin lokal Anda:

```bash
git clone https://github.com/tenriajeng/production-schedule.git

cd production-schedule
```

## Menginstal Dependensi
Jalankan perintah berikut untuk menginstal dependensi PHP menggunakan Composer:
```bash
composer install
```
Untuk menginstal dependensi frontend, jalankan:
```bash
npm install
```

## Konfigurasi Environment
Salin file .env.example menjadi .env:
```bash
cp .env.example .env
```
Edit file .env untuk mengatur koneksi database dan konfigurasi lainnya. Contoh konfigurasi database:
```bash

DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=/Users/ilham/production-schedule/database/database.sqlite
DB_USERNAME=root
DB_PASSWORD=root
DB_FOREIGN_KEYS=false
```

## Membuat Kunci Aplikasi
Jalankan perintah berikut untuk membuat kunci aplikasi:

```bash 
php artisan key:generate
```

## Migrasi Database
Lakukan migrasi untuk membuat tabel di database:

```bash
php artisan migrate
```
Jika Anda memiliki seeders, jalankan:


## Menjalankan Server
Untuk menjalankan aplikasi, gunakan perintah berikut:
```bash
php artisan serve
```
Aplikasi akan tersedia di http://localhost:8000.

## Menjalankan Kompilasi Frontend
Untuk mengkompilasi aset frontend, jalankan:

```bash
npm run dev
```

## Screenshot Web
### Production Plans
Berikut adalah screenshot dari halaman "Production Plans" yang menunjukkan daftar rencana produksi yang ada.

Contoh Screenshot:
![Production Plans image](https://sejawat.s3.ap-southeast-1.amazonaws.com/sejawat/file/888312af04a056738951ca57c6d92c0b/screencapture-localhost-8000-2024-11-03-22_20_04.png)

### Add Plans
Di bawah ini adalah screenshot dari halaman "Add Plans" yang menunjukkan form untuk menambahkan rencana produksi baru.

Contoh Screenshot:
![Create Plan image 1](https://sejawat.s3.ap-southeast-1.amazonaws.com/sejawat/file/bf64d0c57e11056bd6144b42fd817295/screencapture-localhost-8000-production-plans-create-2024-11-03-22_20_24.png)

![Create Plan image 2](https://sejawat.s3.ap-southeast-1.amazonaws.com/sejawat/file/9b64df1dade1bcc3bf4ac2cd4b9b19f3/screencapture-localhost-8000-production-plans-create-2024-11-03-22_20_42.png)

### Edit Plan
Berikut adalah screenshot dari halaman "Edit Plan" yang menunjukkan form untuk mengedit rencana produksi yang telah ada.

Contoh Screenshot:

![Edit Plan image](https://sejawat.s3.ap-southeast-1.amazonaws.com/sejawat/file/808ac142ecc352e84ddc8ac31c79fcb9/screencapture-localhost-8000-production-plans-7-edit-2024-11-03-22_21_05.png)
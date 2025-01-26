# Dokumentasi Web API Laravel

## Pendahuluan
Dokumentasi ini menjelaskan cara menjalankan Web API yang dibangun dengan Laravel, termasuk beberapa fitur utamanya.

## Persyaratan
- PHP versi 8.1 atau lebih tinggi
- Composer
- Database yang didukung oleh Laravel
- Web server seperti Apache atau Nginx

## Instalasi
1. Clone repository Laravel ini:
   ```bash
   git clone <repository-url>
   ```
2. Navigasi ke direktori proyek:
   ```bash
   cd nama-direktori-proyek
   ```
3. Install dependensi proyek menggunakan Composer:
   ```bash
   composer install
   ```
4. Salin file `.env.example` ke `.env` dan sesuaikan konfigurasi database:
   ```bash
   cp .env.example .env
   ```
5. Generate application key:
   ```bash
   php artisan key:generate
   ```
6. Jalankan migrasi database:
   ```bash
   php artisan migrate
   ```

## Menjalankan Server
Untuk menjalankan server lokal, gunakan perintah berikut:
```bash
php artisan serve
```
Server akan berjalan di `http://localhost:8000`.

## Fitur Utama
- **Autentikasi**: Menggunakan Laravel Sanctum untuk autentikasi pengguna.
- **Manajemen Destinasi**: API untuk mengelola destinasi wisata, termasuk fitur untuk membuat, membaca, mengupdate, dan menghapus destinasi.
- **Jadwal Travel**: API yang menyediakan fitur manajemen jadwal travel.
- **Booking**: Fitur untuk membuat dan mengelola booking perjalanan.
- **Validasi Kuota**: Memastikan kuota penumpang tersedia sebelum mengkonfirmasi booking.

## Rute API
- **Autentikasi**:
  - `POST /api/register` - Registrasi pengguna baru.
  - `POST /api/login` - Login pengguna.
  - `POST /api/logout` - Logout pengguna.

- **Destinasi**:
  - `GET /api/destinasi` - Mendapatkan daftar destinasi.
  - `POST /api/destinasi` - Menambahkan destinasi baru.
  - `GET /api/destinasi/{id}` - Mendapatkan detail destinasi.
  - `PUT /api/destinasi/{id}` - Memperbarui destinasi.
  - `DELETE /api/destinasi/{id}` - Menghapus destinasi.

- **Jadwal Travel**:
  - `GET /api/travel` - Mendapatkan jadwal travel.
  - `POST /api/travel` - Menambahkan jadwal travel.
  - `PUT /api/travel/{id}` - Memperbarui jadwal travel.
  - `DELETE /api/travel/{id}` - Menghapus jadwal travel.

- **Booking**:
  - `GET /api/booking` - Mendapatkan daftar booking.
  - `POST /api/checkout` - Membuat booking baru.
  - `PUT /api/booking/{id}` - Memperbarui booking.
  - `DELETE /api/booking/{id}` - Menghapus booking.

## Kesimpulan
Dokumentasi ini memberikan panduan dasar untuk menginstal dan menjalankan Web API Laravel serta menjelaskan fitur dan rute API utama yang tersedia. Untuk informasi lebih lanjut, Anda dapat merujuk ke dokumentasi Laravel resmi.


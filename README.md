# ManhwaRead

Website baca manhwa/manga online dengan panel admin untuk mengelola konten, pengguna, dan hak akses. Dibuat sebagai project tugas/pembelajaran menggunakan Laravel.

## Fitur

**Sisi pengunjung**
- Beranda, jelajah (explore), dan pencarian manhwa dengan filter genre (AJAX)
- Halaman detail manhwa dan pembaca chapter
- Library/bookmark dan riwayat bacaan
- Komentar umum dan komentar per chapter
- Login dan registrasi pengguna

**Sisi admin**
- CRUD Role, Genre, Manhwa, Chapter, Halaman Chapter, dan User
- Sistem hak akses (permission) per role
- Log aktivitas
- Dashboard dengan grafik
- Pengaturan situs dan banner/slider
- Login terpisah untuk karyawan dan panel khusus Owner dan Supervisor

## Teknologi

- Laravel 13 + Laravel Breeze
- MySQL
- AdminLTE 4 (panel admin)
- Tailwind CSS + Vite
- Tema publik bergaya gelap

## Cara Menjalankan (Lokal)

Kebutuhan: PHP 8.3.33, Composer, Node.js, dan MySQL (misalnya lewat Laragon).

```bash
git clone https://github.com/Langitzz/ManhwaRead.git
cd ManhwaRead
composer install
npm install
copy .env.example .env
php artisan key:generate
```

1. Buat database MySQL kosong, misalnya `manhwaread`.
2. Sesuaikan bagian `DB_*` di file `.env` (nama database, username, dan password MySQL).
3. Jalankan perintah berikut:

```bash
php artisan migrate
php artisan storage:link
npm run dev
php artisan serve
```

Buka `http://127.0.0.1:8000` di browser.

## Pembuat

Ahmad Nur Faizin · SMKN 17 JAKARTA BARAT
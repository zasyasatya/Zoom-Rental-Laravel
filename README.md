## Tahapan Instalasi
1. Clone repository ini, kemudian buka Visual Studio Code
2. Jalankan perintah `composer update`
3. Kemudian, buat database baru di `PhpMyAdmin`, lalu rename file `.env.example` ubah menjadi `.env` dan ganti bagian `DB_DATABASE` dengan database yang sudah dibuat di `PhpMyAdmin`
4. Kemudian jalankan perintah `php artisan migrate`
5. Setelah itu, jalankan perintah `php artisan serve` lalu buka aplikasi di browser

## Tahapan Akun
- Untuk register sebagai mahasiswa, silahkan pilih `register` lalu pada bagian `Login As` pilih mahasiswa
- Untuk register sebagai staff, silahkan pilih `register` lalu pada bagian `Login As` pilih staff
- Ketika registerasi, anda akan dikirimkan kode verifikasi ke alamat email yang dimasukkan. Pastikan alamat email yang digunakan adalah alamat email sebenarnya.
- Jika berhasil diverifikasi, maka selanjutnya anda akan diarahkan kehalaman beranda

## Fitur
1. Laravel Auth (Register, Login, Forgot Password)
2. Middleware
3. Migration
4. Model
5. Membagi Controller dan Route
6. CRUD data Zoom oleh Staff
7. Soft Deletes data Zoom
8. Peminjaman Zoom oleh Mahasiswa
9. Approve/Menolak peminjaman Zoom dari Mahasiswa oleh Staff
10. Melihat List Zoom yang didaftarkan oleh Staff
11. Melihat List Zoom yang dipinjam pada level Mahasiswa
12. Melihat List Jadwal Zoom yang telah di-approve oleh Staff

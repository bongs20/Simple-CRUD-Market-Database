
# 🛒 Simple CRUD Market Database

Aplikasi web CRUD berbasis PHP & MySQL yang digunakan untuk mengelola sistem penjualan dengan berbagai tabel seperti barang, pelanggan, transaksi, dan lainnya. Sistem ini dilengkapi dengan fitur login, error handling, dan struktur folder terorganisir berdasarkan tiap tabel.

## ✨ Fitur Utama

- 🔐 **Autentikasi Login**
  - Halaman login di `index.php` untuk membatasi akses ke sistem.
  - Menggunakan session PHP dan validasi login via database `users`.

- 📊 **Dashboard Tabel**
  - Setelah login, pengguna diarahkan ke `view_tabel.php`.
  - Menampilkan daftar semua tabel dalam sistem penjualan.
  - Setiap tabel bisa diklik untuk diarahkan ke folder CRUD-nya masing-masing.

- 📁 **Struktur Modular per Tabel**
  - Setiap tabel memiliki folder terpisah (misalnya: `/barang`, `/pelanggan`, dll).
  - Tiap folder berisi file `view`, `add`, `edit`, dan `delete`.

- ⚠️ **Error Handling**
  - Validasi input user (misalnya saat form kosong, input invalid, dll).
  - Pesan error ditampilkan agar pengguna paham letak kesalahan.

## 🗃️ Tabel Database `sistem_penjualan`

- `barang`
- `detail_pembelian`
- `detail_transaksi`
- `laporan_keuangan`
- `pelanggan`
- `pemasok`
- `pembelian_stok`
- `transaksi`
- `users` ← Digunakan untuk autentikasi login

## 🗂️ Struktur Folder Aplikasi

```
/ (root)
├── index.php                ← Halaman login
├── koneksi.php              ← Koneksi ke database
├── view_tabel.php           ← Dashboard daftar semua tabel
├── /barang/                 ← Folder CRUD untuk tabel `barang`
├── /pelanggan/              ← Folder CRUD untuk tabel `pelanggan`
├── /pemasok/                ← Folder CRUD untuk tabel `pemasok`
├── /transaksi/              ← dan seterusnya...
└── /database/               ← File backup SQL (`sistem_penjualan.sql`)
```

## 🚀 Cara Menjalankan

1. Clone repository:
   ```bash
   git clone https://github.com/bongs20/Simple-CRUD-Market-Database.git
   cd Simple-CRUD-Market-Database
   ```

2. Import database:
   - Buka `phpMyAdmin`
   - Buat database `sistem_penjualan`
   - Import `database/sistem_penjualan.sql`

3. Jalankan:
   ```bash
   php -S localhost:8000
   ```

4. Buka di browser:
   ```
   http://localhost:8000
   ```

5. Login via halaman `index.php`

## 🔒 Login Default

| Username | Password |
|----------|----------|
| admin    | admin    |

*(Atau sesuaikan dengan isi tabel `users`)*

## 🧰 Teknologi yang Digunakan

- PHP (Native)
- MySQL/MariaDB
- Bootstrap 5
- HTML + CSS + JavaScript

## 📝 Lisensi

MIT License

# Teen Dream (Warung Online)

Aplikasi web toko online (*e-commerce*) fashion remaja berbasis PHP native dan MySQL. Proyek ini menyediakan halaman etalase publik untuk menjelajahi dan mencari produk, area pelanggan untuk berbelanja hingga mengunggah bukti transfer, serta panel admin untuk mengelola kategori, produk, dan memvalidasi pesanan.

## Fitur Utama

### Pengunjung / Publik
- **Etalase Produk & Banner Promo**: Menampilkan slider promo, daftar kategori favorit, dan katalog produk aktif terbaru (`index.php`).
- **Filter & Pencarian Produk**: Menyaring produk berdasarkan kategori (`?kat=<id>`) maupun kata kunci nama, harga, atau deskripsi (`produk_cari.php`).
- **Detail Produk**: Menampilkan gambar, harga, stok, deskripsi produk, serta tombol kontak WhatsApp admin (`detail_produk.php`).
- **Autentikasi**: Registrasi akun pelanggan (`register.php`) dan login multi-role untuk `admin` dan `pelanggan` (`login.php`, `logout.php`).

### Pelanggan (`user/`)
- **Katalog & Pencarian**: Melihat daftar produk dan detail produk setelah login (`dashboard_user.php`, `produk_user.php`, `detail_produk_user.php`).
- **Keranjang Belanja**: Menambahkan produk ke keranjang, menghapus item, dan memilih produk yang ingin di-checkout (`cart.php`, `chart_proses.php`, `hapus_proses.php`).
- **Checkout & Upload Bukti Transfer**: Menampilkan rincian pesanan, pilihan rekening bank tujuan, dan form unggah bukti pembayaran (`checkout.php`) yang otomatis memperbarui stok produk.
- **Pelacakan Pesanan & Riwayat**: Memantau status validasi pembayaran dan pengiriman, mengonfirmasi pesanan diterima (`checkout_data.php`, `proses.php`), serta melihat transaksi selesai (`selesai.php`).
- **Profil Akun**: Mengelola informasi profil pelanggan (`profil.php`).

### Admin (`admin/`)
- **Dashboard Admin**: Tampilan ringkasan dan navigasi cepat ke menu pengelolaan (`dashboard.php`, `sidebar.php`).
- **Manajemen Kategori**: Tambah, lihat, dan ubah data kategori produk (`kategori_data.php`, `kategori_tambah.php`, `kategori_edit.php`).
- **Manajemen Produk**: Tambah, lihat, ubah, dan hapus produk beserta unggah gambar produk dan pengaturan stok (`produk_data.php`, `produk_tambah.php`, `produk_edit.php`, `produk_hapus.php`).
- **Validasi Pembayaran & Pesanan**: Memeriksa bukti transfer pelanggan, menandai bukti valid/tidak valid (`checkout.php`, `proses.php`, `proses_nonvalid.php`), memantau keranjang (`chart.php`), serta melihat daftar pesanan selesai (`selesai.php`).
- **Profil Admin**: Mengelola data akun dan kontak toko yang tampil di halaman publik (`profil.php`).

## Teknologi yang Digunakan

- **Backend**: PHP (native PHP dengan ekstensi `mysqli`)
- **Database**: MySQL / MariaDB
- **Frontend**: HTML5, CSS3, JavaScript, Google Fonts (`Quicksand`), Font Awesome (CDN)
- **Lingkungan Server**: Apache & MySQL (XAMPP)

## Struktur Proyek

```text
warungonline/
├── admin/                  # Halaman panel admin (dashboard, kategori, produk, validasi checkout)
├── user/                   # Halaman pelanggan (dashboard, katalog, keranjang, checkout, riwayat)
├── css/                    # Stylesheet utama (style.css, styleadmin.css)
├── img/                    # Aset gambar UI, logo, ikon, dan banner promo
├── produk/                 # Direktori penyimpanan foto produk yang diunggah
├── bukti_transfer/         # Direktori penyimpanan bukti transfer pelanggan
├── fontawesome/            # Aset ikon tambahan
├── db.php                  # Konfigurasi koneksi database MySQL
├── index.php               # Halaman utama / etalase toko
├── detail_produk.php       # Halaman detail produk publik
├── produk_cari.php         # Halaman hasil pencarian produk publik
├── login.php               # Halaman login multi-role (admin & pelanggan)
├── register.php            # Halaman registrasi akun pelanggan
└── logout.php              # Proses keluar sesi
```

## Konfigurasi Lingkungan & Database

Proyek ini tidak menggunakan file `.env` maupun `.env.example`. Konfigurasi koneksi database diatur langsung pada file `db.php` dengan pengaturan bawaan:

- **Host**: `localhost`
- **Username**: `root`
- **Password**: *(kosong)*
- **Nama Database**: `db_warungonline`

Sesuaikan kredensial pada `db.php` apabila konfigurasi MySQL lokal Anda berbeda.

> **Catatan**: Repositori ini belum menyertakan file dump `.sql`. Pastikan database `db_warungonline` beserta tabel yang dibutuhkan aplikasi (`tb_admin`, `tb_category`, `tb_product`, `tb_chart`, `tb_checkout_temp`, `tb_checkout`) sudah dibuat/diimpor di MySQL lokal sebelum menjalankan aplikasi.

## Cara Instalasi & Menjalankan

1. **Salin proyek ke direktori web server**
   Pastikan folder proyek berada di dalam `htdocs` XAMPP, misalnya:
   ```text
   C:\xampp\htdocs\warungonline
   ```
   Atau clone repositori langsung ke folder tersebut:
   ```bash
   git clone https://github.com/BevandJanuartama/teen-dreams.git C:\xampp\htdocs\warungonline
   ```

2. **Jalankan Apache dan MySQL**
   Buka **XAMPP Control Panel**, lalu klik **Start** pada layanan **Apache** dan **MySQL**.

3. **Siapkan Database**
   - Buka `http://localhost/phpmyadmin`.
   - Buat database baru bernama `db_warungonline` (dan impor struktur tabelnya jika tersedia).
   - Periksa kembali konfigurasi koneksi di `db.php`.

4. **Akses Aplikasi di Browser**
   Buka browser dan kunjungi:
   ```text
   http://localhost/warungonline/
   ```
   - Untuk masuk sebagai admin atau pelanggan, buka `http://localhost/warungonline/login.php`.
   - Untuk mendaftar akun pelanggan baru, buka `http://localhost/warungonline/register.php`.

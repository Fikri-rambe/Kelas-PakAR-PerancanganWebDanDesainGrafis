# 👟 Mahkota Kaki - Website Toko Online Sepatu

Mahkota Kaki adalah proyek website toko online sepatu yang dibangun dengan PHP native dan MySQL. Website ini memiliki dua area terpisah: **halaman customer** dan **halaman admin**, lengkap dengan fitur pembelian, chat real-time, dan pengelolaan produk.

## ✨ Fitur Utama

### 🔹 Halaman Customer
- Melihat daftar produk berdasarkan kategori
- Pencarian dan filter produk
- Tambah ke keranjang dan proses checkout
- Upload bukti pembayaran
- Chat real-time dengan admin
- Tampilan responsif dengan Bootstrap

### 🔹 Halaman Admin
- Login admin
- Dashboard produk
- Tambah/edit/hapus produk dan kategori
- Melihat riwayat transaksi
- Chat real-time dengan pelanggan

## 🛠️ Teknologi yang Digunakan
- **PHP** (Native)
- **MySQL** (phpMyAdmin)
- **HTML, CSS, Bootstrap 5**
- **AJAX & JavaScript** (untuk fitur chat real-time)
- **Session Management**

## 📁 Struktur Folder
mahkota_kaki/
│
├── admin/ # Halaman admin
│ ├── index.php
│ ├── dashboard.php
│ ├── chat.php
│ ├── chat_detail.php
│ └── ...
│
├── customer/ # Halaman customer
│ ├── index.php
│ ├── chat.php
│ ├── beli.php
│ ├── keranjang.php
│ ├── checkout.php
│ └── ...
│
├── config/
│ └── koneksi.php # File koneksi ke database
│
├── assets/
│ ├── css/
│ └── img/
│
├── database/
│ └── mahkotakaki.sql # File struktur database
│
├── kirim_pesan.php # Handler chat customer-admin
└── index.php # Landing page pemilih role




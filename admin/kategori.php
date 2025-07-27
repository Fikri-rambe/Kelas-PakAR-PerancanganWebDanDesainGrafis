<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}
include '../config/koneksi.php';

$pesan = "";

// Tambah kategori
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nama_kategori'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_kategori']);
    
    // Cek apakah nama kategori sudah ada
    $cek = mysqli_query($conn, "SELECT id FROM kategori WHERE nama_kategori = '$nama'");
    if (mysqli_num_rows($cek) > 0) {
        $pesan = "Kategori '$nama' sudah ada!";
    } else {
        mysqli_query($conn, "INSERT INTO kategori (nama_kategori) VALUES ('$nama')");
        $pesan = "Kategori '$nama' berhasil ditambahkan.";
    }
}

// Hapus kategori
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    
    // Cek apakah kategori digunakan oleh produk
    $cekProduk = mysqli_query($conn, "SELECT id FROM produk WHERE kategori_id = $id");
    if (mysqli_num_rows($cekProduk) > 0) {
        $pesan = "Kategori sedang digunakan oleh produk, tidak dapat dihapus!";
    } else {
        mysqli_query($conn, "DELETE FROM kategori WHERE id = $id");
        $pesan = "Kategori berhasil dihapus.";
    }
}

// Ambil semua kategori
$kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY id DESC");
?>

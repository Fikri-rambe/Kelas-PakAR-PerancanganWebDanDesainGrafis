<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}
?>


<?php
include '../config/koneksi.php';

// Cek apakah ada ID produk yang dikirim
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data produk untuk cek gambar
    $query = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
    $produk = mysqli_fetch_assoc($query);

    // Hapus file gambar dari folder (opsional, jika tidak ingin membiarkan gambar lama menumpuk)
    $gambar = $produk['gambar'];
    $lokasi = "../assets/img/" . $gambar;

    if (file_exists($lokasi)) {
        unlink($lokasi); // Hapus file gambar
    }

    // Hapus produk dari database
    mysqli_query($conn, "DELETE FROM produk WHERE id = $id") or die(mysqli_error($conn));
}

// Kembali ke dashboard
header("Location: dashboard.php");
exit;
?>

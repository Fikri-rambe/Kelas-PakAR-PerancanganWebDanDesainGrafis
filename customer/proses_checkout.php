<?php
session_start();
include '../config/koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Silakan login terlebih dahulu.'); window.location='login.php';</script>";
    exit;
}

$pelanggan_id = $_SESSION['pelanggan']['id'];

// Ambil data dari form
$nama = htmlspecialchars($_POST['nama']);
$alamat = htmlspecialchars($_POST['alamat']);
$metode = $_POST['metode'];

// Validasi form
if (empty($nama) || empty($alamat) || empty($metode)) {
    echo "<script>alert('Mohon lengkapi semua data!'); window.history.back();</script>";
    exit;
}

// Proses upload bukti pembayaran jika bukan COD
$bukti_pembayaran = null;
if (
    isset($_FILES['bukti']) && 
    $_FILES['bukti']['error'] === 0 && 
    $metode !== "COD (Bayar di Tempat)"
) {
    $nama_file = date('YmdHis') . '_' . $_FILES['bukti']['name'];
    $lokasi_tmp = $_FILES['bukti']['tmp_name'];
    $tujuan = '../assets/bukti/' . $nama_file;

    // Pastikan folder ada
    if (!is_dir('../assets/bukti')) {
        mkdir('../assets/bukti', 0777, true);
    }

    move_uploaded_file($lokasi_tmp, $tujuan);
    $bukti_pembayaran = $nama_file;
}

// Ambil data keranjang
$keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : [];
if (empty($keranjang)) {
    echo "<script>alert('Keranjang kosong!'); window.location='index.php';</script>";
    exit;
}

// Hitung total
$total = 0;
foreach ($keranjang as $id_produk => $jumlah) {
    $q = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id_produk");
    $produk = mysqli_fetch_assoc($q);
    if ($produk) {
        $subtotal = $produk['harga'] * $jumlah;
        $total += $subtotal;
    }
}

// Simpan ke tabel transaksi
mysqli_query($conn, "INSERT INTO transaksi 
    (pelanggan_id, nama_pembeli, alamat, metode_pembayaran, bukti_bayar, total, tanggal) 
    VALUES (
        '$pelanggan_id',
        '$nama',
        '$alamat',
        '$metode',
        " . ($bukti_pembayaran ? "'$bukti_pembayaran'" : "NULL") . ",
        '$total',
        NOW()
    )
");

$transaksi_id = mysqli_insert_id($conn);

// Simpan ke detail_transaksi
foreach ($keranjang as $id_produk => $jumlah) {
    $q = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id_produk");
    $produk = mysqli_fetch_assoc($q);
    if ($produk) {
        $subtotal = $produk['harga'] * $jumlah;
        mysqli_query($conn, "INSERT INTO detail_transaksi 
            (transaksi_id, produk_id, jumlah, subtotal) 
            VALUES (
                $transaksi_id,
                $id_produk,
                $jumlah,
                $subtotal
            )
        ");
    }
}

// Kosongkan keranjang
unset($_SESSION['keranjang']);

// Redirect ke halaman sukses
header("Location: checkout_sukses.php");
exit;
?>

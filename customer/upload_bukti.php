<?php
session_start();
include '../config/koneksi.php';

// Ambil transaksi terakhir berdasarkan nama dan alamat (sementara, karena belum ada login customer)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    // Ambil ID transaksi terakhir
    $q = mysqli_query($conn, "SELECT id FROM transaksi 
                              WHERE nama_pembeli = '$nama' AND alamat = '$alamat' 
                              ORDER BY tanggal DESC LIMIT 1");
    $t = mysqli_fetch_assoc($q);

    if ($t && isset($_FILES['bukti']['name']) && $_FILES['bukti']['name'] != "") {
        $id_transaksi = $t['id'];
        $nama_file = date('YmdHis') . '_' . basename($_FILES['bukti']['name']);
        $lokasi_tmp = $_FILES['bukti']['tmp_name'];
        $folder = "../assets/bukti/";

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        if (move_uploaded_file($lokasi_tmp, $folder . $nama_file)) {
            // Simpan nama file ke DB
            mysqli_query($conn, "UPDATE transaksi 
                                 SET bukti_bayar = '$nama_file' 
                                 WHERE id = $id_transaksi");

            echo "<script>alert('Bukti pembayaran berhasil diunggah.'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Gagal mengunggah file.');</script>";
        }
    } else {
        echo "<script>alert('Data transaksi tidak ditemukan atau file tidak valid.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Bukti Pembayaran - Mahkota Kaki</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <h1>Upload Bukti Pembayaran</h1>

    <form method="POST" enctype="multipart/form-data">
        <label>Nama Pembeli:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Alamat Pengiriman:</label><br>
        <textarea name="alamat" required></textarea><br><br>

        <label>Upload Bukti Pembayaran (JPG/PNG):</label><br>
        <input type="file" name="bukti" accept="image/*" required><br><br>

        <button type="submit">Kirim Bukti</button>
        <a href="index.php">← Kembali</a>
    </form>

</body>
</html>

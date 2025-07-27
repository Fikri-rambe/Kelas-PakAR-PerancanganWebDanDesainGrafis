<?php
session_start();
include '../config/koneksi.php';

// Cek login
if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Silakan login terlebih dahulu.'); window.location='login.php';</script>";
    exit;
}

$pelanggan_id = $_SESSION['pelanggan']['id'];

// Ambil transaksi berdasarkan pelanggan_id
$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE pelanggan_id = $pelanggan_id ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="text-center mb-4">📦 Riwayat Pesanan Anda</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>Nama Pembeli</th>
                <th>Alamat</th>
                <th>Metode Pembayaran</th>
                <th>Total</th>
                <th>Tanggal</th>
                <th>Bukti Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($query)):
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_pembeli']) ?></td>
                <td><?= htmlspecialchars($row['alamat']) ?></td>
                <td><?= htmlspecialchars($row['metode_pembayaran']) ?></td>
                <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                <td><?= $row['tanggal'] ?></td>
                <td>
                    <?php if ($row['bukti_bayar']): ?>
                        <a href="../assets/bukti/<?= $row['bukti_bayar'] ?>" target="_blank">Lihat</a>
                    <?php else: ?>
                        Tidak ada
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <div class="text-center mt-4">
    <a href="index.php" class="btn btn-primary">🏠 Kembali ke Beranda</a>
</div>

</div>

</body>
</html>

<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

include '../config/koneksi.php';

$transaksi = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Transaksi - Mahkota Kaki</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    img {
      max-height: 80px;
      object-fit: cover;
    }
  </style>
</head>
<body class="bg-light">

<div class="container py-4">
  <h2 class="text-center mb-4">📦 Riwayat Transaksi</h2>

  <div class="mb-3 text-start">
    <a href="dashboard.php" class="btn btn-outline-primary">← Kembali ke Dashboard</a>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle text-center">
      <thead class="table-dark">
        <tr>
          <th>Nama Pembeli</th>
          <th>Alamat</th>
          <th>Metode Pembayaran</th>
          <th>Bukti Pembayaran</th>
          <th>Total</th>
          <th>Tanggal</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($t = mysqli_fetch_assoc($transaksi)) : ?>
        <tr>
          <td><?= htmlspecialchars($t['nama_pembeli']) ?></td>
          <td><?= nl2br(htmlspecialchars($t['alamat'])) ?></td>
          <td><?= $t['metode_pembayaran'] ?? '-' ?></td>
          <td>
            <?php if (!empty($t['bukti_bayar'])): ?>
              <a href="../assets/bukti/<?= $t['bukti_bayar'] ?>" target="_blank">
                <img src="../assets/bukti/<?= $t['bukti_bayar'] ?>" class="img-thumbnail" alt="Bukti">
              </a>
            <?php else: ?>
              <em class="text-muted">Tidak ada</em>
            <?php endif; ?>
          </td>
          <td>Rp <?= number_format($t['total'], 0, ',', '.') ?></td>
          <td><?= date('d-m-Y H:i', strtotime($t['tanggal'])) ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>

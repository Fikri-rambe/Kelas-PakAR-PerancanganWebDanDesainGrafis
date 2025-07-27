<?php
session_start();
include '../config/koneksi.php';

$keranjang = $_SESSION['keranjang'] ?? [];

$produk_keranjang = [];
$total = 0;

foreach ($keranjang as $id => $jumlah) {
    $q = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
    $p = mysqli_fetch_assoc($q);
    if ($p) {
        $p['jumlah'] = $jumlah;
        $p['subtotal'] = $p['harga'] * $jumlah;
        $total += $p['subtotal'];
        $produk_keranjang[] = $p;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja - Mahkota Kaki</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f8ff;
        }
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
        }
        .card-total {
            background-color: #fefefe;
            border-left: 5px solid #0d6efd;
            padding: 1rem 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        @media (max-width: 576px) {
            .btn-sm {
                font-size: 0.75rem;
                padding: 5px 10px;
            }
        }
    </style>
</head>
<body>

<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center text-primary">🛒 Keranjang Mahkota Kaki</h2>

    <?php if (empty($keranjang)): ?>
        <div class="alert alert-info text-center shadow-sm">
            Keranjangmu masih kosong 😢 <br>
            <a href="index.php" class="btn btn-sm btn-primary mt-3">✨ Ayo Belanja Sekarang</a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle bg-white shadow-sm">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Produk</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($produk_keranjang as $p): ?>
                    <tr class="text-center">
                        <td>
                            <img src="../assets/img/<?= htmlspecialchars($p['gambar']) ?>" class="product-img" alt="<?= htmlspecialchars($p['nama']) ?>">
                        </td>
                        <td><?= htmlspecialchars($p['nama']) ?></td>
                        <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                        <td><?= $p['jumlah'] ?></td>
                        <td>Rp <?= number_format($p['subtotal'], 0, ',', '.') ?></td>
                        <td>
                            <div class="d-flex justify-content-center gap-1 flex-wrap">
                                <a href="tambah_jumlah.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-success">➕</a>
                                <a href="kurangi_jumlah.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">➖</a>
                                <a href="hapus_item.php?id=<?= $p['id'] ?>" onclick="return confirm('Yakin ingin hapus?')" class="btn btn-sm btn-danger">🗑</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Total -->
        <div class="card card-total mt-4 text-end">
            <h5 class="mb-0">Total Belanja: <span class="text-success">Rp <?= number_format($total, 0, ',', '.') ?></span></h5>
        </div>

        <!-- Aksi -->
        <div class="text-center mt-4 d-flex flex-wrap justify-content-center gap-3">
            <a href="checkout.php" class="btn btn-lg btn-primary">✅ Lanjut Checkout</a>
            <a href="index.php" class="btn btn-lg btn-outline-secondary">🔙 Belanja Lagi</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>

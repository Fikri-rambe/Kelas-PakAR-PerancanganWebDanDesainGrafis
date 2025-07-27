<?php
session_start();
include '../config/koneksi.php';

// Validasi ID produk
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
$produk = mysqli_fetch_assoc($q);

if (!$produk) {
    header("Location: index.php");
    exit;
}

// Handle tambah ke keranjang
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jumlah = (int)$_POST['jumlah'];
    if ($jumlah < 1) $jumlah = 1;

    if ($jumlah > $produk['stok']) {
        header("Location: beli.php?id=$id&error=Jumlah melebihi stok tersedia!");
        exit;
    }

    $_SESSION['keranjang'][$id] = isset($_SESSION['keranjang'][$id])
        ? $_SESSION['keranjang'][$id] + $jumlah
        : $jumlah;

    // Tambah ke keranjang sukses, arahkan ke checkout jika diminta
    if (isset($_POST['checkout'])) {
        header("Location: checkout.php");
        exit;
    }

    header("Location: beli.php?id=$id&success=Produk berhasil ditambahkan ke keranjang!");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($produk['nama']) ?> - Mahkota Kaki</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media (max-width: 768px) {
            .product-img {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-4 py-md-5">
    <!-- Notifikasi -->
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger text-center"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php elseif (isset($_GET['success'])): ?>
        <div class="alert alert-success text-center"><?= htmlspecialchars($_GET['success']) ?></div>
    <?php endif; ?>

    <!-- Konten Produk -->
    <div class="row align-items-start">
        <div class="col-md-6 product-img">
            <img src="../assets/img/<?= htmlspecialchars($produk['gambar']) ?>" class="img-fluid rounded shadow w-100" alt="<?= htmlspecialchars($produk['nama']) ?>">
        </div>
        <div class="col-md-6">
            <h2 class="fw-bold"><?= htmlspecialchars($produk['nama']) ?></h2>
            <p class="text-muted"><?= htmlspecialchars($produk['deskripsi']) ?></p>
            <h4 class="text-success fw-semibold mb-3">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></h4>
            <p class="mb-1">Stok tersedia: <strong><?= $produk['stok'] ?></strong></p>

            <form method="POST" class="mt-3">
                <div class="mb-3" style="max-width: 140px;">
                    <label for="jumlah" class="form-label">Jumlah:</label>
                    <input type="number" name="jumlah" id="jumlah" value="1" min="1" max="<?= $produk['stok'] ?>" class="form-control" required>
                </div>
                <div class="d-grid gap-2 d-md-flex mt-3">
                    <button type="submit" name="tambah" class="btn btn-primary">🛒 Tambah ke Keranjang</button>
                    <button type="submit" name="checkout" class="btn btn-success">✅ Checkout Sekarang</button>
                    <a href="index.php" class="btn btn-outline-secondary">← Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>

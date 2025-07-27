<?php
session_start();
include '../config/koneksi.php';

$keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : [];

if (empty($keranjang)) {
    echo "<script>alert('Keranjang masih kosong!'); window.location='index.php';</script>";
    exit;
}

// Ambil data produk
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
    <title>Checkout - Mahkota Kaki</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media (max-width: 576px) {
            .form-control, .form-select, .btn {
                font-size: 14px;
            }
            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="text-center text-success fw-bold mb-4">🧾 Checkout Pesanan Anda</h2>

    <form method="POST" enctype="multipart/form-data" action="proses_checkout.php" class="row g-3">
        <div class="col-12 col-md-6">
            <label for="nama" class="form-label">👤 Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" id="nama" required>
        </div>

        <div class="col-12 col-md-6">
            <label for="alamat" class="form-label">🏠 Alamat Lengkap</label>
            <input type="text" class="form-control" name="alamat" id="alamat" required>
        </div>

        <div class="col-12">
            <label for="metode" class="form-label">💳 Metode Pembayaran</label>
            <select class="form-select" name="metode" id="metode" required>
                <option value="">-- Pilih Metode --</option>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="E-Wallet (OVO/DANA/Gopay)">E-Wallet (OVO/DANA/Gopay)</option>
                <option value="COD (Bayar di Tempat)">COD (Bayar di Tempat)</option>
            </select>
        </div>

        <div class="col-12" id="formBukti">
            <label for="bukti" class="form-label">📎 Upload Bukti Pembayaran</label>
            <input type="file" class="form-control" name="bukti" id="bukti" accept=".jpg,.jpeg,.png">
        </div>

        <div class="col-12 mt-4">
            <h5 class="fw-bold">📦 Ringkasan Pesanan</h5>
            <ul class="list-group mb-3">
                <?php foreach ($produk_keranjang as $p): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= htmlspecialchars($p['nama']) ?> (x<?= $p['jumlah'] ?>)
                        <span>Rp <?= number_format($p['subtotal'], 0, ',', '.') ?></span>
                    </li>
                <?php endforeach; ?>
                <li class="list-group-item d-flex justify-content-between fw-bold bg-light">
                    Total Bayar:
                    <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
                </li>
            </ul>
        </div>

        <div class="col-12 text-center">
            <button type="submit" class="btn btn-success btn-lg">✅ Konfirmasi & Checkout</button>
            <a href="keranjang.php" class="btn btn-outline-secondary btn-lg ms-2">↩️ Kembali ke Keranjang</a>
        </div>
    </form>
</div>

<!-- Script logika upload bukti -->
<script>
    const metodeSelect = document.getElementById('metode');
    const buktiInput = document.getElementById('bukti');
    const formBukti = document.getElementById('formBukti');

    function toggleBuktiPembayaran() {
        const selected = metodeSelect.value;
        if (selected.includes("COD")) {
            formBukti.style.display = 'none';
            buktiInput.required = false;
        } else {
            formBukti.style.display = 'block';
            buktiInput.required = true;
        }
    }

    metodeSelect.addEventListener('change', toggleBuktiPembayaran);
    window.addEventListener('DOMContentLoaded', toggleBuktiPembayaran);
</script>

</body>
</html>

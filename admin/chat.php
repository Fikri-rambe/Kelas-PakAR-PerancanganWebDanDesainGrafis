<?php
session_start();
include '../config/koneksi.php';

// Cek jika admin belum login
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Silakan login sebagai admin.'); window.location='login.php';</script>";
    exit;
}

// Ambil daftar pelanggan yang pernah kirim pesan
$pelanggan_q = mysqli_query($conn, "SELECT DISTINCT pelanggan.id, pelanggan.nama 
                                     FROM chat 
                                     JOIN pelanggan ON chat.sender_id = pelanggan.id 
                                     WHERE chat.sender = 'customer' 
                                     ORDER BY chat.timestamp DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Chat Pelanggan - Mahkota Kaki</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #2c3e50, #34495e);
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .card {
            background-color: #1f1f1f;
            border: none;
            border-radius: 12px;
        }

        .card a {
            text-decoration: none;
        }

        .list-group-item {
            background-color: #2c3e50;
            color: #fff;
            border: 1px solid #3e4c5a;
            transition: background 0.3s ease;
        }

        .list-group-item:hover {
            background-color: #3a4a5a;
        }

        .btn-back {
            background-color: #f39c12;
            color: #fff;
            border: none;
            font-weight: bold;
        }

        .btn-back:hover {
            background-color: #e67e22;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">💬 Daftar Chat Pelanggan</h3>
        <a href="index.php" class="btn btn-back">🏠 Kembali ke Beranda</a>
    </div>

    <div class="card p-4">
        <div class="list-group list-group-flush">
            <?php if (mysqli_num_rows($pelanggan_q) > 0): ?>
                <?php while ($p = mysqli_fetch_assoc($pelanggan_q)) : ?>
                    <a href="chat_detail.php?receiver_id=<?= $p['id'] ?>" class="list-group-item list-group-item-action">
                        👤 <?= htmlspecialchars($p['nama']) ?>
                    </a>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="text-center text-muted py-3">Belum ada pesan dari pelanggan.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>

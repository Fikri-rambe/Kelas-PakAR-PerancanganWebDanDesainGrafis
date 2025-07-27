<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

include '../config/koneksi.php';

// Tangkap keyword pencarian (jika ada)
$keyword = isset($_GET['cari']) ? mysqli_real_escape_string($conn, $_GET['cari']) : '';

// Query produk dengan pencarian
$query = "SELECT produk.*, kategori.nama_kategori 
          FROM produk 
          LEFT JOIN kategori ON produk.kategori_id = kategori.id";
if ($keyword) {
    $query .= " WHERE produk.nama LIKE '%$keyword%'";
}
$query .= " ORDER BY produk.id DESC";

$produk = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - Mahkota Kaki</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
        background-color: #f9f9f9;
        font-family: Arial, sans-serif;
        padding: 20px;
    }

    h1 {
        color: #6a1b9a;
        margin-bottom: 20px;
    }

    .nav-links a {
        margin-right: 10px;
        text-decoration: none;
        color: #fff;
        background-color: #6a1b9a;
        padding: 8px 12px;
        border-radius: 5px;
        font-size: 0.9rem;
    }

    .nav-links a:hover {
        background-color: #4a148c;
    }

    .search-box {
        margin: 20px 0;
    }

    .add-button {
        background-color: #27ae60;
        color: #fff;
        padding: 8px 14px;
        text-decoration: none;
        border-radius: 5px;
        display: inline-block;
        margin-bottom: 15px;
    }

    .add-button:hover {
        background-color: #1e874b;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        font-size: 0.95rem;
    }

    th {
        background-color: #eee;
    }

    img {
        border-radius: 4px;
    }
  </style>
</head>
<body>

<h1>👑 Dashboard Admin - Mahkota Kaki</h1>

<!-- Navigasi -->
<div class="nav-links mb-3">
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="transaksi.php">📦 Transaksi</a>
    <a href="chat.php">💬 Chat Pelanggan</a>
    <a href="logout.php" style="background-color: #c0392b;">🚪 Logout</a>
</div>

<!-- Pencarian -->
<div class="search-box">
    <form method="GET" class="d-flex flex-wrap gap-2">
        <input type="text" name="cari" class="form-control" placeholder="🔍 Cari produk..." style="max-width: 300px;" value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit" class="btn btn-primary">Cari</button>
        <?php if ($keyword): ?>
            <a href="dashboard.php" class="btn btn-danger">Reset</a>
        <?php endif; ?>
    </form>
</div>

<!-- Tombol tambah produk -->
<a href="tambah_produk.php" class="add-button">+ Tambah Produk</a>

<!-- Tabel produk -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while($p = mysqli_fetch_assoc($produk)): ?>
        <tr>
            <td><img src="../assets/img/<?= $p['gambar'] ?>" width="70" alt="<?= htmlspecialchars($p['nama']) ?>"></td>
            <td><?= htmlspecialchars($p['nama']) ?></td>
            <td><?= $p['nama_kategori'] ?? '-' ?></td>
            <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
            <td><?= $p['stok'] ?></td>
            <td><?= substr(strip_tags($p['deskripsi']), 0, 50) ?>...</td>
            <td>
                <a href="edit_produk.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="hapus_produk.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus produk ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>

<?php
session_start();
include '../config/koneksi.php';

// Ambil semua kategori
$kategori_q = mysqli_query($conn, "SELECT * FROM kategori");
$kategori_list = [];
while ($row = mysqli_fetch_assoc($kategori_q)) {
    $kategori_list[] = $row;
}

// Tangkap filter kategori dan pencarian
$kategori_filter = $_GET['kategori'] ?? '';
$search_keyword = $_GET['search'] ?? '';

// Query produk
$where = "1=1";
if ($kategori_filter !== '') {
    $where .= " AND produk.kategori_id = " . intval($kategori_filter);
}
if ($search_keyword !== '') {
    $search_safe = mysqli_real_escape_string($conn, $search_keyword);
    $where .= " AND produk.nama LIKE '%$search_safe%'";
}

$produk = mysqli_query($conn, "SELECT produk.*, kategori.nama_kategori 
                               FROM produk 
                               LEFT JOIN kategori ON produk.kategori_id = kategori.id 
                               WHERE $where");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Mahkota Kaki 👑👟</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(to right, #e0f7fa, #fff3e0);
    }
    h1 {
        font-weight: bold;
        color: #ff6f00;
        font-size: 2rem;
        animation: bounce 1s infinite alternate;
    }
    @keyframes bounce {
        0% { transform: translateY(0); }
        100% { transform: translateY(-5px); }
    }
    .card:hover {
        transform: scale(1.02);
        box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        transition: all 0.3s ease-in-out;
    }
    .btn-primary {
        background-color: #ff9800;
        border: none;
    }
    .btn-primary:hover {
        background-color: #f57c00;
    }
    .btn-outline-primary {
        border-color: #ff9800;
        color: #ff9800;
    }
    .btn-outline-primary:hover {
        background-color: #ff9800;
        color: white;
    }

    @media (max-width: 576px) {
        h1 { text-align: center; font-size: 1.5rem; }
        .card-img-top { height: 180px !important; }
    }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h1>Mahkota Kaki 👑👟</h1>
        <div class="d-flex flex-wrap gap-2">
            <a href="keranjang.php" class="btn btn-outline-primary">🛒 Keranjang</a>

            <?php if (isset($_SESSION['pelanggan'])): ?>
                <a href="chat.php" class="btn btn-outline-success">💬 Chat dengan Admin</a>
                <a href="logout.php" class="btn btn-outline-danger">🚪 Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-outline-primary">🔑 Login</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Filter & Search -->
    <form method="GET" class="row g-2 align-items-center mb-4">
        <div class="col-md-4">
            <select name="kategori" class="form-select" onchange="this.form.submit()">
                <option value="">-- Semua Kategori --</option>
                <?php foreach ($kategori_list as $k): ?>
                    <option value="<?= $k['id'] ?>" <?= ($k['id'] == $kategori_filter ? 'selected' : '') ?>>
                        <?= $k['nama_kategori'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <input type="text" name="search" value="<?= htmlspecialchars($search_keyword) ?>" placeholder="Cari produk..." class="form-control">
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-primary">🔍 Cari</button>
        </div>
        <?php if ($kategori_filter || $search_keyword): ?>
        <div class="col-md-2 d-grid">
            <a href="index.php" class="btn btn-secondary">🔄 Reset</a>
        </div>
        <?php endif; ?>
    </form>

    <!-- Produk -->
    <div class="row">
        <?php if (mysqli_num_rows($produk) > 0): ?>
            <?php while($p = mysqli_fetch_assoc($produk)): ?>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="../assets/img/<?= $p['gambar'] ?>" class="card-img-top" alt="<?= $p['nama'] ?>" style="height: 230px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-subtitle mb-1 text-muted small"><?= $p['nama_kategori'] ?></h6>
                        <h5 class="card-title"><?= $p['nama'] ?></h5>
                        <p class="card-text text-muted small"><?= $p['deskripsi'] ?></p>
                        <p class="card-text fw-bold text-success">Rp <?= number_format($p['harga'], 0, ',', '.') ?></p>
                        <a href="beli.php?id=<?= $p['id'] ?>" class="btn btn-primary mt-auto">🎁 Beli Sekarang</a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Produk tidak ditemukan.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

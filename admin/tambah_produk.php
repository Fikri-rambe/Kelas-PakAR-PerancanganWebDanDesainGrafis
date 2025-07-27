<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

include '../config/koneksi.php';

// Ambil semua kategori
$kategori = mysqli_query($conn, "SELECT * FROM kategori");

// Proses tambah produk
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama        = mysqli_real_escape_string($conn, $_POST['nama']);
    $deskripsi   = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $harga       = (int)$_POST['harga'];
    $stok        = (int)$_POST['stok'];
    $kategori_id = (int)$_POST['kategori_id'];

    // Upload gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];
    $lokasi = "../assets/img/" . $gambar;

    if (move_uploaded_file($tmp, $lokasi)) {
        $query = "INSERT INTO produk (nama, deskripsi, harga, stok, gambar, kategori_id) 
                  VALUES ('$nama', '$deskripsi', $harga, $stok, '$gambar', $kategori_id)";
        mysqli_query($conn, $query) or die(mysqli_error($conn));
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('Upload gambar gagal.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk - Mahkota Kaki</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Tambah Produk Sepatu</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>Nama Produk:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi" required></textarea><br><br>

        <label>Harga:</label><br>
        <input type="number" name="harga" required><br><br>

        <label>Stok:</label><br>
        <input type="number" name="stok" required><br><br>

        <label>Kategori:</label><br>
        <select name="kategori_id" required>
            <option value="">-- Pilih Kategori --</option>
            <?php while($k = mysqli_fetch_assoc($kategori)): ?>
                <option value="<?= $k['id'] ?>"><?= htmlspecialchars($k['nama_kategori']) ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Gambar Produk:</label><br>
        <input type="file" name="gambar" accept="image/*" required><br><br>

        <button type="submit">Simpan Produk</button>
        <a href="dashboard.php">← Kembali</a>
    </form>
</body>
</html>

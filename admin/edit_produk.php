<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

include '../config/koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
$produk = mysqli_fetch_assoc($query);

if (!$produk) {
    echo "Produk tidak ditemukan.";
    exit;
}

$kategori = mysqli_query($conn, "SELECT * FROM kategori");

// Proses edit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama        = mysqli_real_escape_string($conn, $_POST['nama']);
    $deskripsi   = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $harga       = (int)$_POST['harga'];
    $stok        = (int)$_POST['stok'];
    $kategori_id = (int)$_POST['kategori_id'];
    $gambarLama  = $_POST['gambar_lama'];

    // Upload gambar baru (jika ada)
    if ($_FILES['gambar']['name'] != "") {
        $gambar = $_FILES['gambar']['name'];
        $tmp    = $_FILES['gambar']['tmp_name'];
        $lokasi = "../assets/img/" . $gambar;

        if (move_uploaded_file($tmp, $lokasi)) {
            // unlink("../assets/img/" . $gambarLama); // jika ingin hapus gambar lama
        } else {
            echo "Upload gambar gagal.";
            exit;
        }
    } else {
        $gambar = $gambarLama;
    }

    $update = "UPDATE produk SET 
                nama = '$nama',
                deskripsi = '$deskripsi',
                harga = $harga,
                stok = $stok,
                gambar = '$gambar',
                kategori_id = $kategori_id
               WHERE id = $id";
    mysqli_query($conn, $update) or die(mysqli_error($conn));

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk - Mahkota Kaki</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<h1>Edit Produk Sepatu</h1>

<form method="POST" enctype="multipart/form-data">
    <label>Nama Produk:</label><br>
    <input type="text" name="nama" value="<?= htmlspecialchars($produk['nama']) ?>" required><br><br>

    <label>Kategori:</label><br>
    <select name="kategori_id" required>
        <?php while ($k = mysqli_fetch_assoc($kategori)) : ?>
            <option value="<?= $k['id'] ?>" <?= $k['id'] == $produk['kategori_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($k['nama_kategori']) ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi" required><?= htmlspecialchars($produk['deskripsi']) ?></textarea><br><br>

    <label>Harga:</label><br>
    <input type="number" name="harga" value="<?= $produk['harga'] ?>" required><br><br>

    <label>Stok:</label><br>
    <input type="number" name="stok" value="<?= $produk['stok'] ?>" required><br><br>

    <label>Gambar Saat Ini:</label><br>
    <img src="../assets/img/<?= $produk['gambar'] ?>" width="100"><br><br>

    <label>Ganti Gambar (Opsional):</label><br>
    <input type="file" name="gambar" accept="image/*"><br><br>

    <input type="hidden" name="gambar_lama" value="<?= $produk['gambar'] ?>">

    <button type="submit">Simpan Perubahan</button>
    <a href="dashboard.php">Batal</a>
</form>

</body>
</html>

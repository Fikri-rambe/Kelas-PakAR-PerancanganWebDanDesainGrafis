<?php
include '../config/koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek apakah nama sudah digunakan
    $cek = mysqli_query($conn, "SELECT * FROM pelanggan WHERE nama = '$nama'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Nama sudah digunakan. Silakan gunakan nama lain.";
    } else {
        mysqli_query($conn, "INSERT INTO pelanggan (nama, password) VALUES ('$nama', '$password')");

        // Simpan pesan sukses ke session, lalu redirect ke login.php
        $_SESSION['register_success'] = "Pendaftaran berhasil! Silakan login.";
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi - Mahkota Kaki</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e0f7fa, #fff3e0);
        }
        .highlight-text {
            font-size: 0.95rem;
            color: #ff6f00;
            font-weight: 500;
            text-align: center;
            font-family: 'Fredoka', sans-serif;
            animation: fadeInUp 1s ease-in-out;
        }
        .highlight-text span {
            font-size: 1.1rem;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .btn-success {
            background-color: #43a047;
            border: none;
        }
        .btn-success:hover {
            background-color: #388e3c;
        }
        h3 {
            font-weight: bold;
            color: #2e7d32;
            animation: bounce 1s infinite alternate;
        }
        @keyframes bounce {
            0% { transform: translateY(0); }
            100% { transform: translateY(-4px); }
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-center mb-3">Daftar Yuk 📝✨</h3>

                    <p class="highlight-text mb-4">
                        <span>👋 Baru di sini?</span> Yuk daftar dulu dengan nama dan password yang kamu suka!
                    </p>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">🎉 Daftar Sekarang</button>
                    </form>

                    <div class="mt-3 text-center small">
                        Sudah punya akun? <a href="login.php">Login yuk 🚀</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

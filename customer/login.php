<?php
include '../config/koneksi.php';
session_start();

// Tampilkan notifikasi jika baru saja selesai registrasi
$success = '';
if (isset($_SESSION['register_success'])) {
    $success = $_SESSION['register_success'];
    unset($_SESSION['register_success']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $password = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * FROM pelanggan WHERE nama = '$nama'");
    $user = mysqli_fetch_assoc($q);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['pelanggan'] = $user;
        header("Location: login_success.php");
        exit;
    } else {
        $error = "Nama atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Customer - Mahkota Kaki</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e0f7fa, #fff3e0);
        }
        h3 {
            font-weight: bold;
            color: #ff6f00;
            font-size: 1.7rem;
            animation: bounce 1s infinite alternate;
        }
        @keyframes bounce {
            0% { transform: translateY(0); }
            100% { transform: translateY(-4px); }
        }
        .btn-primary {
            background-color: #ff9800;
            border: none;
        }
        .btn-primary:hover {
            background-color: #f57c00;
        }
        .card {
            border-radius: 1rem;
        }
        .fun-instruksi {
            font-family: 'Fredoka', sans-serif;
            font-size: 0.95rem;
            color: #ff6f00;
            text-align: center;
            animation: bounceFade 1.5s ease-in-out;
        }
        @keyframes bounceFade {
            0% { opacity: 0; transform: translateY(-10px); }
            50% { opacity: 1; transform: translateY(5px); }
            100% { transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm p-4">
                <div class="card-body">
                    <h3 class="text-center mb-2">👟 Login Yuk!</h3>

                    <p class="fun-instruksi">
                        😎 sudah buat akun? <strong>gas login.</strong><br>
                        🤔 belum? ayo daftar tinggal masukkan nama dan buat password.
                    </p>

                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>

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
                        <button type="submit" class="btn btn-primary w-100">🔓 Login</button>
                    </form>

                    <div class="mt-3 text-center small">
                        Belum punya akun? <a href="register.php">Daftar di sini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

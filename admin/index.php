<?php
session_start();
include '../config/koneksi.php';

if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Mahkota Kaki</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #f3e5f5, #e1f5fe);
            font-family: 'Inter', sans-serif;
        }

        .login-container {
            max-width: 400px;
            margin: 80px auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .login-title {
            font-weight: 700;
            color: #6a1b9a;
        }

        .btn-login {
            background-color: #6a1b9a;
            border: none;
        }

        .btn-login:hover {
            background-color: #4a148c;
        }

        .form-control:focus {
            border-color: #6a1b9a;
            box-shadow: 0 0 0 0.2rem rgba(106, 27, 154, 0.25);
        }

        .error-message {
            color: #d32f2f;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h3 class="text-center login-title mb-4">🔐 Login Admin</h3>

    <?php if (isset($error)): ?>
        <div class="error-message mb-3 text-center"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>

        <div class="mb-4">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-login w-100 text-white">Masuk</button>
    </form>
</div>

</body>
</html>

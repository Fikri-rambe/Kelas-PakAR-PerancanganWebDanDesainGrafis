<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang di Mahkota Kaki 👑👟</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e0f7fa, #fce4ec);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            background-color: white;
            text-align: center;
        }
        .btn-option {
            padding: 12px 20px;
            font-size: 1.1rem;
            border-radius: 10px;
            margin: 10px;
            width: 220px;
        }
        .btn-customer {
            background-color: #ff9800;
            color: white;
            border: none;
        }
        .btn-customer:hover {
            background-color: #f57c00;
        }
        .btn-admin {
            background-color: #6a1b9a;
            color: white;
            border: none;
        }
        .btn-admin:hover {
            background-color: #4a148c;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2 class="mb-4">Selamat Datang di <br><strong>Mahkota Kaki 👑👟</strong></h2>
        <p class="mb-4">Silakan pilih halaman sesuai peran Anda:</p>
        <div>
            <a href="customer/index.php" class="btn btn-customer btn-option">Masuk sebagai Customer</a>
            <a href="admin/index.php" class="btn btn-admin btn-option">Masuk sebagai Admin</a>
        </div>
    </div>
</body>
</html>

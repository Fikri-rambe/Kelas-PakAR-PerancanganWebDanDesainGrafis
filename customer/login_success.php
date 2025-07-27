<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Berhasil - Mahkota Kaki</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Fredoka', sans-serif;
            background: linear-gradient(to right, #e0f7fa, #fff3e0);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .main-text {
            text-align: center;
            animation: fadeSlide 1.5s ease;
        }

        .main-text h1 {
            font-size: 2.8rem;
            color: #ff6f00;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .main-text p {
            font-size: 1.2rem;
            color: #444;
            font-style: italic;
        }

        .btn-start {
            margin-top: 2rem;
            padding: 12px 30px;
            font-size: 1.1rem;
            border: none;
            border-radius: 50px;
            background-color: #ff9800;
            color: white;
            transition: all 0.3s ease;
            animation: fadeSlide 2s ease;
        }

        .btn-start:hover {
            background-color: #f57c00;
            transform: scale(1.05);
        }

        @keyframes fadeSlide {
            0% {
                opacity: 0;
                transform: translateY(40px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .emoji {
            font-size: 3rem;
            display: block;
            margin-bottom: 1rem;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>

<div class="main-text">
    <div class="emoji">👑👟</div>
    <h1>Login Berhasil!</h1>
    <p>"Temukan mahkota kakimu, buat setiap langkah perjalanan lebih nyaman."</p>
    <a href="index.php" class="btn btn-start">Lihat Produk Sekarang</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout Berhasil - Mahkota Kaki</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(to right, #ffe0b2, #fff3e0);
            overflow-x: hidden;
        }

        .success-container {
            max-width: 600px;
            margin: auto;
            padding: 3rem 2rem;
            text-align: center;
            background-color: #ffffffcc;
            border-radius: 16px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(8px);
        }

        .success-icon {
            font-size: 70px;
            animation: bounce 1s infinite alternate;
        }

        @keyframes bounce {
            0% { transform: translateY(0); }
            100% { transform: translateY(-8px); }
        }

        h2 {
            color: #ff6f00;
            font-weight: 700;
        }

        p {
            color: #444;
            margin-bottom: 10px;
        }

        .btn {
            border-radius: 50px;
            transition: all 0.3s ease-in-out;
        }

        .btn-outline-primary:hover {
            background-color: #ff9800;
            color: white;
            border-color: #ff9800;
        }

        .btn-secondary:hover {
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>
<body>

<!-- Confetti canvas -->
<canvas id="confetti-canvas" style="position:fixed; top:0; left:0; width:100%; height:100%; pointer-events:none; z-index:9999;"></canvas>

<div class="container py-5">
    <div class="success-container">
        <div class="success-icon">🎉</div>
        <h2>Yay! Checkout Berhasil</h2>
        <p>Terima kasih telah berbelanja di <strong>Mahkota Kaki</strong> 👟</p>
        <p>Pesanan kamu lagi kami proses yaa 😍</p>

        <div class="mt-4 d-grid gap-2">
            <a href="index.php" class="btn btn-outline-primary btn-lg">⬅️ Kembali ke Beranda</a>
            <a href="riwayat_pesanan.php" class="btn btn-secondary btn-lg">📦 Lihat Riwayat Pesanan</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Confetti JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<script>
// Fungsi untuk ledakkan confetti
function confettiBoom() {
    const duration = 2 * 1000;
    const animationEnd = Date.now() + duration;
    const defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 9999 };

    const interval = setInterval(function() {
        const timeLeft = animationEnd - Date.now();

        if (timeLeft <= 0) {
            return clearInterval(interval);
        }

        confetti(Object.assign({}, defaults, {
            particleCount: 40,
            origin: { x: Math.random(), y: Math.random() - 0.2 }
        }));
    }, 200);
}

// Jalankan confetti saat halaman load
window.onload = confettiBoom;
</script>

</body>
</html>

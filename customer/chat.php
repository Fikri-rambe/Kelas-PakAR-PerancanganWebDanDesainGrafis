<?php
session_start();
include '../config/koneksi.php';
if (!isset($_SESSION['pelanggan'])) {
    header('Location: login.php');
    exit;
}
$id_customer = $_SESSION['pelanggan']['id'];
$admin_id = 1;

$chat = mysqli_query($conn, "SELECT * FROM chat WHERE (sender_id=$id_customer OR receiver_id=$id_customer) AND (sender='customer' OR sender='admin') ORDER BY waktu ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Chat dengan Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #2c3e50, #34495e);
            color: #fff;
        }
        .chat-box {
            height: 350px;
            overflow-y: auto;
            padding: 15px;
            background-color: #1f1f1f;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }
        .chat-bubble {
            max-width: 80%;
            padding: 10px 15px;
            border-radius: 15px;
            margin-bottom: 10px;
            word-wrap: break-word;
        }
        .chat-bubble.customer {
            background-color: #2980b9;
            align-self: flex-end;
            color: #fff;
        }
        .chat-bubble.admin {
            background-color: #7f8c8d;
            align-self: flex-start;
            color: #fff;
        }
        .chat-meta {
            font-size: 0.75rem;
            color: #ccc;
            margin-top: 5px;
        }
        .btn-home {
            background-color: #f39c12;
            border: none;
        }
        .btn-home:hover {
            background-color: #e67e22;
        }
        @media (max-width: 576px) {
            .chat-box {
                height: 300px;
                padding: 10px;
            }
            .chat-bubble {
                font-size: 0.9rem;
            }
            h3 {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-2">
        <h3 class="mb-0">💬 Chat dengan Admin</h3>
        <a href="index.php" class="btn btn-home text-white">
            🏠 Kembali ke Beranda
        </a>
    </div>

    <div class="chat-box">
        <?php while ($c = mysqli_fetch_assoc($chat)): ?>
            <div class="chat-bubble <?= $c['sender'] === 'customer' ? 'customer' : 'admin' ?>">
                <div><?= htmlspecialchars($c['message']) ?></div>
                <div class="chat-meta"><?= $c['sender'] === 'customer' ? 'Anda' : 'Admin' ?> • <?= $c['waktu'] ?></div>
            </div>
        <?php endwhile; ?>
    </div>

    <form method="POST" action="../kirim_pesan.php" class="d-flex flex-column flex-sm-row gap-2">
        <input type="hidden" name="sender" value="customer">
        <input type="hidden" name="sender_id" value="<?= $id_customer ?>">
        <input type="hidden" name="receiver_id" value="<?= $admin_id ?>">
        <input type="text" name="message" class="form-control" placeholder="Tulis pesan..." required>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>
</body>
</html>

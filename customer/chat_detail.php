<?php
session_start();
include '../config/koneksi.php';

// Cek login customer
if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); location='login.php';</script>";
    exit;
}

$sender_id = $_SESSION['pelanggan']['id'];
$receiver_id = 1; // Asumsikan ID admin = 1
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Chat - Mahkota Kaki</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Segoe UI', sans-serif;
        }
        .chat-container {
            max-width: 600px;
            margin: auto;
            margin-top: 50px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .chat-header {
            background-color: #0d6efd;
            color: white;
            padding: 15px;
            font-weight: bold;
            font-size: 1.2rem;
            text-align: center;
        }
        #chat-box {
            height: 400px;
            overflow-y: auto;
            padding: 15px;
            background: #fefefe;
        }
        .message {
            margin-bottom: 10px;
            padding: 10px 15px;
            border-radius: 20px;
            max-width: 70%;
        }
        .message.customer {
            background-color: #dcf8c6;
            align-self: flex-end;
            margin-left: auto;
        }
        .message.admin {
            background-color: #f1f0f0;
            align-self: flex-start;
            margin-right: auto;
        }
        .chat-form {
            display: flex;
            gap: 10px;
            padding: 15px;
            border-top: 1px solid #ddd;
        }
        .chat-form input {
            flex-grow: 1;
        }
    </style>
</head>
<body>

<div class="chat-container">
    <div class="chat-header">💬 Chat dengan Admin</div>

    <!-- Tombol kembali -->
    <div class="text-end p-2">
        <a href="index.php" class="btn btn-sm btn-outline-secondary">← Kembali ke Beranda</a>
    </div>

    <!-- Chat Box -->
    <div id="chat-box" class="d-flex flex-column"></div>

    <!-- Form Kirim Pesan -->
    <form id="chat-form" class="chat-form" method="POST">
        <input type="text" name="message" id="message" class="form-control" placeholder="Tulis pesan..." required>
        <button type="submit" class="btn btn-primary">Kirim</button>
        <input type="hidden" name="sender" value="customer">
        <input type="hidden" name="sender_id" value="<?= $sender_id ?>">
        <input type="hidden" name="receiver_id" value="<?= $receiver_id ?>">
    </form>
</div>

<!-- Realtime Chat -->
<script>
// Ambil pesan setiap 2 detik
setInterval(() => {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "load_chat.php?sender_id=<?= $sender_id ?>&receiver_id=<?= $receiver_id ?>", true);
    xhr.onload = function () {
        if (this.status === 200) {
            document.getElementById("chat-box").innerHTML = this.responseText;
            document.getElementById("chat-box").scrollTop = document.getElementById("chat-box").scrollHeight;
        }
    };
    xhr.send();
}, 2000);

// Kirim pesan
document.getElementById("chat-form").addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../kirim_pesan.php", true);
    xhr.onload = function () {
        if (this.status === 200) {
            document.getElementById("message").value = '';
        }
    };
    xhr.send(formData);
});
</script>

</body>
</html>

<?php
session_start();
include '../config/koneksi.php';

$sender_id = 1; // ID admin
$receiver_id = isset($_GET['receiver_id']) ? (int)$_GET['receiver_id'] : 0;

if ($receiver_id < 1) {
    echo "<script>alert('Customer tidak dipilih.'); location='index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Chat Admin - Mahkota Kaki</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #2c3e50, #34495e);
            color: #fff;
        }
        .chat-box {
            height: 430px;
            overflow-y: auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .chat-bubble {
            max-width: 65%;
            padding: 10px 16px;
            border-radius: 15px;
            word-wrap: break-word;
            position: relative;
            font-size: 0.95rem;
            line-height: 1.4;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        }
        .admin {
            background-color: #3498db;
            align-self: flex-end;
            color: white;
            border-bottom-right-radius: 0;
        }
        .customer {
            background-color: #7f8c8d;
            align-self: flex-start;
            color: white;
            border-bottom-left-radius: 0;
        }
        .chat-meta {
            font-size: 0.7rem;
            color: #ccc;
            margin-top: 4px;
        }
        .btn-home {
            background-color: #f39c12;
            border: none;
        }
        .btn-home:hover {
            background-color: #e67e22;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">💬 Chat Admin dengan Pelanggan ID #<?= $receiver_id ?></h4>
        <a href="index.php" class="btn btn-home text-white">🏠 Kembali</a>
    </div>

    <div id="chat-box" class="chat-box"></div>

    <form id="chat-form" method="POST" class="d-flex gap-2">
        <input type="hidden" name="sender" value="admin">
        <input type="hidden" name="sender_id" value="<?= $sender_id ?>">
        <input type="hidden" name="receiver_id" value="<?= $receiver_id ?>">
        <input type="text" name="message" id="message" class="form-control" placeholder="Tulis balasan..." required>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>

<script>
let chatBox = document.getElementById("chat-box");

function loadChat() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "load_chat_admin.php?sender_id=<?= $sender_id ?>&receiver_id=<?= $receiver_id ?>", true);
    xhr.onload = function () {
        if (this.status === 200) {
            const wasAtBottom = chatBox.scrollHeight - chatBox.scrollTop - chatBox.clientHeight < 100;
            chatBox.innerHTML = this.responseText;
            if (wasAtBottom) {
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        }
    };
    xhr.send();
}

// Kirim pesan
document.getElementById("chat-form").addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../kirim_pesan.php", true);
    xhr.onload = function () {
        if (this.status === 200) {
            document.getElementById("message").value = '';
            loadChat();
        }
    };
    xhr.send(formData);
});

// Auto-refresh
setInterval(loadChat, 2000);
loadChat();
</script>
</body>
</html>

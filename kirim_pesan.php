<?php
include 'config/koneksi.php';

$sender     = $_POST['sender'];
$sender_id  = $_POST['sender_id'];
$receiver_id= $_POST['receiver_id'];
$message    = htmlspecialchars($_POST['message']);

if (!$message || !$sender_id || !$receiver_id) {
    echo "Data tidak lengkap";
    exit;
}

mysqli_query($conn, "INSERT INTO chat (sender, sender_id, receiver_id, message) VALUES (
    '$sender', '$sender_id', '$receiver_id', '$message'
)");

header("Location: " . $_SERVER['HTTP_REFERER']);
exit;

<?php
include '../config/koneksi.php';

$sender_id = isset($_GET['sender_id']) ? (int)$_GET['sender_id'] : 0;      // Admin
$receiver_id = isset($_GET['receiver_id']) ? (int)$_GET['receiver_id'] : 0; // Customer

if ($sender_id < 1 || $receiver_id < 1) {
    exit('Invalid ID');
}

$result = mysqli_query($conn, "SELECT * FROM chat WHERE 
    (sender_id = $sender_id AND receiver_id = $receiver_id) OR 
    (sender_id = $receiver_id AND receiver_id = $sender_id)
    ORDER BY id ASC");

while ($row = mysqli_fetch_assoc($result)) {
    $class = $row['sender'] === 'admin' ? 'admin' : 'customer';
    $message = htmlspecialchars($row['message']);
    $waktu = $row['waktu'];

    echo "<div class='chat-bubble $class'>";
    echo "$message";
    echo "<div class='chat-meta'>$waktu</div>";
    echo "</div>";
}
?>

<?php
include '../config/koneksi.php';

$sender_id = $_GET['sender_id'];
$receiver_id = $_GET['receiver_id'];

$result = mysqli_query($conn, "SELECT * FROM chat WHERE 
    (sender_id = $sender_id AND receiver_id = $receiver_id) OR 
    (sender_id = $receiver_id AND receiver_id = $sender_id) 
    ORDER BY timestamp ASC");

while ($row = mysqli_fetch_assoc($result)) {
    $class = ($row['sender_id'] == $sender_id) ? 'customer' : 'admin';
    echo "<div class='message $class'><strong>{$row['sender']}:</strong> " . htmlspecialchars($row['message']) . "</div>";
}

<?php
session_start();
$id = $_GET['id'];

if (isset($_SESSION['keranjang'][$id])) {
    $_SESSION['keranjang'][$id]++;
}

header("Location: keranjang.php");
exit;

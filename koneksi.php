<?php
$host = mysqli_connect("localhost", "root", "", "bukutamu");
if (!$host) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

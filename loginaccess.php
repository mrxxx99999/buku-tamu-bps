<?php
session_start();
require_once("koneksi.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = mysqli_real_escape_string($host, $_POST['username']);
  $password = $_POST['password'];

  // Ambil data user berdasarkan username
  $query = mysqli_query($host, "SELECT * FROM user WHERE username = '$username'");
  $data = mysqli_fetch_assoc($query);

  if (!$data) {
    echo "<script>alert('Username belum terdaftar!'); window.location='login.php';</script>";
    exit;
  }

  // Verifikasi password hash
  if (!password_verify($password, $data['password'])) {
    echo "<script>alert('Password salah!'); window.location='login.php';</script>";
    exit;
  }

  // Set session dan redirect ke admin page
  $_SESSION['username'] = $data['username'];
  $_SESSION['nama_petugas'] = $data['nama_petugas'];
  header("Location: adminpage.php");
  exit;
}
?>

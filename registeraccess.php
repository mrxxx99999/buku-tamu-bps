<?php
require_once "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = mysqli_real_escape_string($host, $_POST['nama_petugas']);
  $username = mysqli_real_escape_string($host, $_POST['username']);
  $password = mysqli_real_escape_string($host, $_POST['password']);

  // Cek apakah username sudah ada
  $cek = mysqli_query($host, "SELECT * FROM user WHERE username='$username'");
  if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Username sudah digunakan! Silakan pilih username lain.'); window.location='login.php';</script>";
    exit;
  }

  // Enkripsi password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Insert ke database
  $simpan = mysqli_query($host, "INSERT INTO user (nama_petugas, username, password) VALUES ('$nama', '$username', '$hashed_password')");

  if ($simpan) {
    echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
  } else {
    echo "<script>alert('Registrasi gagal. Coba lagi.'); window.location='login.php';</script>";
  }
}
?>

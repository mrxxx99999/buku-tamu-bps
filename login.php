<?php
session_start();
if (isset($_SESSION['username'])) {
  header('Location: adminpage.php');
  exit;
}
require_once("koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin - Buku Tamu</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      background: #f2f6fc;
    }
    .login-container {
      max-width: 500px;
      margin: 50px auto;
    }
    .card {
      border-radius: 20px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }
    .card-header {
      background-color: #0d6efd;
      color: white;
      border-radius: 20px 20px 0 0;
      text-align: center;
      font-size: 1.4rem;
      padding: 1rem;
    }
    .form-group label {
      font-weight: 500;
    }
    .btn-primary {
      border-radius: 30px;
      width: 100%;
    }
    .switch-link {
      text-align: center;
      margin-top: 1rem;
    }
    .switch-link a {
      text-decoration: none;
    }
  </style>
</head>
<body>

<div class="container login-container">
  <div class="card">
    <div class="card-header" id="form-title">
      <i class="bi bi-person-circle"></i> Login Admin
    </div>
    <div class="card-body">
      <!-- LOGIN FORM -->
      <form action="loginaccess.php" method="POST" id="login-form">
        <div class="form-group mb-3">
          <label for="username">Username</label>
          <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
        </div>
        <div class="form-group mb-4">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <div class="switch-link mt-3">
          Belum punya akun? <a href="#" onclick="toggleForm('register')">Daftar di sini</a>
        </div>
      </form>

      <!-- REGISTER FORM -->
      <form action="registeraccess.php" method="POST" id="register-form" style="display: none;">
        <div class="form-group mb-3">
          <label for="nama">Nama Lengkap</label>
          <input type="text" name="nama_petugas" class="form-control" placeholder="Masukkan Nama" required>
        </div>
        <div class="form-group mb-3">
          <label for="username">Username</label>
          <input type="text" name="username" class="form-control" placeholder="Buat Username" required>
        </div>
        <div class="form-group mb-4">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Buat Password" required>
        </div>
        <button type="submit" class="btn btn-primary">Daftar</button>
        <div class="switch-link mt-3">
          Sudah punya akun? <a href="#" onclick="toggleForm('login')">Login di sini</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function toggleForm(type) {
    const loginForm = document.getElementById("login-form");
    const registerForm = document.getElementById("register-form");
    const title = document.getElementById("form-title");

    if (type === "register") {
      loginForm.style.display = "none";
      registerForm.style.display = "block";
      title.innerHTML = '<i class="bi bi-person-plus"></i> Register Admin';
    } else {
      loginForm.style.display = "block";
      registerForm.style.display = "none";
      title.innerHTML = '<i class="bi bi-person-circle"></i> Login Admin';
    }
  }
</script>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

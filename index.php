<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <style>
    img {
      width: 300px;
    }
    body {
      background-color: #f8f9fa;
    }
    .welcome-box {
      background: white;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .btn-form {
      padding: 15px 30px;
      font-size: 1.2rem;
      border-radius: 30px;
    }
    .navbar {
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
  </style>
  <title>Home</title>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">Buku Tamu</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <!-- Tambahan: target="_blank" -->
        <a class="nav-item nav-link btn btn-outline-primary rounded-pill px-4" href="login.php" target="_blank">Login</a>
      </div>
    </div>
  </div>
</nav>


  <!-- Main Content -->
  <div class="container d-flex justify-content-center align-items-center flex-column mt-5">
    <div class="welcome-box text-center">
      <h3 class="mb-4"><strong>SELAMAT DATANG</strong></h3>
      <h5>APLIKASI BUKU TAMU <br> BADAN PUSAT STATISTIK KEFAMENANU</h5>
      <br>
      <img src="assets/img/bps.png" alt="Logo BPS">
    </div>

    <!-- Button to Form -->
    <div class="mt-4">
      <a href="formbukutamu.php" class="btn btn-primary btn-form shadow">Isi Buku Tamu</a>
    </div>
  </div>

  <!-- JS Scripts -->
  <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>

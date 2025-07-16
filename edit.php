<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
  header('location:login.php');
  exit;
}

$id_tamu = $_GET['id_tamu'];
$query = mysqli_query($host, "SELECT * FROM tamu WHERE id_tamu = '$id_tamu'") or die(mysqli_error($host));
$data = mysqli_fetch_assoc($query);

if (!$data) {
  echo "<script>alert('Data tidak ditemukan!'); window.location='adminpage.php';</script>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Data Tamu</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap & Icons -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(to bottom right, #e7f0fd, #ffffff);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .main-container {
      margin-top: 60px;
      margin-bottom: 60px;
    }
    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
      animation: fadeIn 0.5s ease-in-out;
    }
    .card-header {
      background-color: #0d6efd;
      color: white;
      font-size: 1.5rem;
      font-weight: bold;
      border-radius: 16px 16px 0 0;
    }
    .form-control {
      border-radius: 10px;
    }
    .btn-save {
      background-color: #0d6efd;
      border: none;
      border-radius: 30px;
      padding: 10px;
      font-weight: bold;
      font-size: 1rem;
    }
    .btn-save:hover {
      background-color: #0b5ed7;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container main-container">
  <div class="col-md-8 offset-md-2">
    <div class="card">
      <div class="card-header text-center">
        <i class="bi bi-pencil-square me-2"></i>Edit Data Tamu
      </div>
      <div class="card-body">
        <form action="act-edit.php" method="POST">
          <input type="hidden" name="id_tamu" value="<?= $data['id_tamu'] ?>">

          <div class="form-group mb-3">
            <label for="instansi">Nama Instansi</label>
            <input type="text" class="form-control" name="instansi" id="instansi"
              value="<?= htmlspecialchars($data['instansi']) ?>" required>
          </div>

          <div class="form-group mb-3">
            <label for="kepada">Kepada</label>
            <input type="text" class="form-control" name="kepada" id="kepada"
              value="<?= htmlspecialchars($data['kepada']) ?>" required>
          </div>

          <div class="row">
            <div class="form-group mb-3 col-md-6">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" name="nama" id="nama"
                value="<?= htmlspecialchars($data['nama']) ?>" required>
            </div>
            <div class="form-group mb-3 col-md-6">
              <label for="tlp">No Telepon</label>
              <input type="text" class="form-control" name="tlp" id="tlp"
                value="<?= htmlspecialchars($data['tlp']) ?>" required>
            </div>
          </div>

          <div class="form-group mb-4">
            <label for="pesan">Pesan</label>
            <textarea class="form-control" name="pesan" id="pesan" rows="3" required><?= htmlspecialchars($data['pesan']) ?></textarea>
          </div>

          <button type="submit" class="btn btn-save w-100">
            <i class="bi bi-save me-2"></i>Simpan Perubahan
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include 'footer.php'; ?>

<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
  header('location:login.php');
  exit;
}

$id = $_GET['id'];
$query = mysqli_query($host, "SELECT * FROM tamu WHERE id = '$id'") or die(mysqli_error($host));
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
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to bottom right, #e7f0fd, #ffffff);
    }
    .main-container {
      margin-top: 60px;
      margin-bottom: 60px;
    }
    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }
    .card-header {
      background-color: #0d6efd;
      color: white;
      font-size: 1.5rem;
      font-weight: bold;
      border-radius: 16px 16px 0 0;
    }
    .btn-save {
      background-color: #0d6efd;
      border: none;
      border-radius: 30px;
      padding: 10px;
      font-weight: bold;
    }
    .btn-save:hover {
      background-color: #0b5ed7;
    }
  </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container main-container">
  <div class="col-md-10 offset-md-1">
    <div class="card">
      <div class="card-header text-center bg-white text-primary" style="font-size: 1.5rem; font-weight: bold;">
  <i class="bi bi-pencil-square me-2"></i>Edit Data Tamu
</div>

      <div class="card-body">
        <form action="act-edit.php" method="POST">
          <input type="hidden" name="id" value="<?= $data['id'] ?>">

          <div class="row mb-3">
            <div class="col-md-6">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" required>
            </div>
            <div class="col-md-6">
              <label>Email</label>
              <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email']) ?>">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label>No HP</label>
              <input type="text" name="hp" class="form-control" value="<?= htmlspecialchars($data['hp']) ?>">
            </div>
            <div class="col-md-6">
              <label>Jenis Kelamin</label>
              <select name="gender" class="form-control">
                <option value="Laki-laki" <?= $data['gender'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= $data['gender'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label>Pendidikan</label>
              <input type="text" name="pendidikan" class="form-control" value="<?= htmlspecialchars($data['pendidikan']) ?>">
            </div>
            <div class="col-md-6">
              <label>Pekerjaan</label>
              <input type="text" name="pekerjaan" class="form-control" value="<?= htmlspecialchars($data['pekerjaan']) ?>">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label>Kategori Instansi</label>
              <input type="text" name="kategori_instansi" class="form-control" value="<?= htmlspecialchars($data['kategori_instansi']) ?>">
            </div>
            <div class="col-md-6">
              <label>Nama Instansi</label>
              <input type="text" name="nama_instansi" class="form-control" value="<?= htmlspecialchars($data['nama_instansi']) ?>">
            </div>
          </div>

          <div class="mb-3">
            <label>Pemanfaatan</label>
            <input type="text" name="pemanfaatan" class="form-control" value="<?= htmlspecialchars($data['pemanfaatan']) ?>">
          </div>

          <div class="mb-3">
            <label>Jenis Layanan</label>
            <select name="layanan" class="form-control">
              <option value="">-- Pilih --</option>
              <option value="Perpustakaan" <?= $data['layanan'] == 'Perpustakaan' ? 'selected' : '' ?>>Perpustakaan</option>
              <option value="Permintaan Data" <?= $data['layanan'] == 'Permintaan Data' ? 'selected' : '' ?>>Permintaan Data</option>
              <option value="Konsultasi" <?= $data['layanan'] == 'Konsultasi' ? 'selected' : '' ?>>Konsultasi</option>
              <option value="Rekomendasi" <?= $data['layanan'] == 'Rekomendasi' ? 'selected' : '' ?>>Rekomendasi</option>
            </select>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label>Perpustakaan</label>
              <input type="text" name="perpustakaan" class="form-control" value="<?= htmlspecialchars($data['perpustakaan']) ?>">
            </div>
            <div class="col-md-6">
              <label>Permintaan Data</label>
              <input type="text" name="permintaan_data" class="form-control" value="<?= htmlspecialchars($data['permintaan_data']) ?>">
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-md-6">
              <label>Konsultasi</label>
              <input type="text" name="konsultasi" class="form-control" value="<?= htmlspecialchars($data['konsultasi']) ?>">
            </div>
            <div class="col-md-6">
              <label>Rekomendasi</label>
              <input type="text" name="rekomendasi" class="form-control" value="<?= htmlspecialchars($data['rekomendasi']) ?>">
            </div>
          </div>

          <button type="submit" class="btn btn-save w-100">
            <i class="bi bi-save me-2"></i> Simpan Perubahan
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include 'footer.php'; ?>

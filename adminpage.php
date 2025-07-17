<?php
include "koneksi.php";

// Hindari session error
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}

// Ambil data user login
$username = $_SESSION['username'];
$queryPetugas = mysqli_query($host, "SELECT * FROM user WHERE username = '$username'");
$petugas = mysqli_fetch_assoc($queryPetugas);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      background-color: #f5f8fc;
    }
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.07);
    }
    .card-header {
      background-color: #0d6efd;
      color: white;
      border-radius: 15px 15px 0 0;
      font-weight: bold;
      font-size: 1.2rem;
    }
    .btn-sm {
      padding: 5px 10px;
      font-size: 0.8rem;
    }
    .dataTables_filter {
  text-align: right !important;
}

  </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-4">
  <div class="card">
    <div class="card-header text-center bg-white text-primary" style="font-size: 1.5rem; font-weight: bold;">
      <i class="bi bi-pencil-square me-2"></i>Data Tamu
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="tamu" class="table table-bordered table-hover">
          <thead class="table-primary">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Email</th>
              <th>No. HP</th>
              <th>Gender</th>
              <th>Pendidikan</th>
              <th>Pekerjaan</th>
              <th>Instansi</th>
              <th>Pemanfaatan</th>
              <th>Layanan</th>
              <th>Detail Layanan</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($host, "SELECT * FROM tamu ORDER BY tanggal ASC");
            while ($data = mysqli_fetch_array($query)) {
              ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($data['nama']) ?></td>
                <td><?= htmlspecialchars($data['email']) ?></td>
                <td><?= htmlspecialchars($data['hp']) ?></td>
                <td><?= htmlspecialchars($data['gender']) ?></td>
                <td><?= htmlspecialchars($data['pendidikan']) ?></td>
                <td><?= htmlspecialchars($data['pekerjaan']) ?></td>
                <td><?= htmlspecialchars($data['nama_instansi']) ?></td>
                <td><?= htmlspecialchars($data['pemanfaatan']) ?></td>
                <td><?= htmlspecialchars($data['layanan']) ?></td>
                <td>
                  <ul class="mb-0">
                    <?php if (!empty($data['perpustakaan'])): ?>
                      <li><strong>Perpustakaan:</strong> <?= htmlspecialchars($data['perpustakaan']) ?></li>
                    <?php endif; ?>
                    <?php if (!empty($data['permintaan_data'])): ?>
                      <li><strong>Permintaan Data:</strong> <?= htmlspecialchars($data['permintaan_data']) ?></li>
                    <?php endif; ?>
                    <?php if (!empty($data['konsultasi'])): ?>
                      <li><strong>Konsultasi Statistik:</strong> <?= htmlspecialchars($data['konsultasi']) ?></li>
                    <?php endif; ?>
                    <?php if (!empty($data['rekomendasi'])): ?>
                      <li><strong>Rekomendasi Kegiatan:</strong> <?= htmlspecialchars($data['rekomendasi']) ?></li>
                    <?php endif; ?>
                  </ul>
                </td>
                <td><?= date('d-m-Y H:i', strtotime($data['tanggal'])) ?></td>
                <td>
                  <a href="edit.php?id=<?= $data['id'] ?>" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-square"></i> Edit
                  </a>
                  <a href="hapus.php?id=<?= $data['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');">
                    <i class="bi bi-trash"></i> Hapus
                  </a>
                </td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Script -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function() {
    $('#tamu').DataTable();
  });
</script>

</body>
</html>

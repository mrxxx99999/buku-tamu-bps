<?php
include "koneksi.php";
session_start();

if (!isset($_SESSION['username'])) {
  header('location:login.php');
  exit;
}

// Ambil data petugas
$username = $_SESSION['username'];
$queryPetugas = mysqli_query($host, "SELECT * FROM user WHERE username = '$username'");
$petugas = mysqli_fetch_assoc($queryPetugas);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
    .logout-btn {
      position: absolute;
      right: 20px;
      top: 20px;
    }
  </style>
</head>
<body>

<!-- Navbar / Header -->
<?php include 'navbar.php'; ?>

<div class="container mt-4">
  <div class="card">
    <div class="card-header">
      <i class="bi bi-table"></i> Data Tamu
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="tamu" class="table table-bordered table-hover">
          <thead class="table-primary">
            <tr>
              <th>No</th>
              <th>Nama Instansi</th>
              <th>Kepada</th>
              <th>Nama</th>
              <th>No Telepon</th>
              <th>Pesan</th>
              <th>Tanggal Kirim</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($host, "SELECT * FROM tamu ORDER BY date_created DESC");
            while ($data = mysqli_fetch_array($query)) {
            ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($data['instansi']) ?></td>
                <td><?= htmlspecialchars($data['kepada']) ?></td>
                <td><?= htmlspecialchars($data['nama']) ?></td>
                <td><?= htmlspecialchars($data['tlp']) ?></td>
                <td><?= htmlspecialchars($data['pesan']) ?></td>
                <td><?= $data['date_created'] ?></td>
                <td>
                  <a href="edit.php?id_tamu=<?= $data['id_tamu'] ?>" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-square"></i> Edit
                  </a>
                  <a href="hapus.php?id_tamu=<?= $data['id_tamu'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">
                    <i class="bi bi-trash"></i> Hapus
                  </a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
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

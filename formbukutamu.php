<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Buku Tamu</title>

  <!-- Styles -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    body {
      background-color: #f1f4f9;
    }
    .main-title {
      text-align: center;
      font-size: 2.2rem;
      font-weight: bold;
      color: #0d6efd;
      margin-top: 40px;
      margin-bottom: 30px;
    }
    .card {
      border: none;
      border-radius: 18px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.08);
      background-color: #ffffff;
    }
    .form-control {
      border-radius: 10px;
    }
    .btn-primary {
      background-color: #0d6efd;
      border: none;
      border-radius: 30px;
      padding: 10px;
      font-weight: 600;
    }
    .btn-primary:hover {
      background-color: #0b5ed7;
    }
    table thead {
      background-color: #0d6efd;
      color: white;
    }
    table td, table th {
      vertical-align: middle;
    }
    .card-header i {
      margin-right: 8px;
    }
    @media (min-width: 992px) {
      .card-form, .card-table {
        min-height: 100%;
      }
    }
  </style>
</head>
<body>

<!-- JUDUL -->
<div class="container">
  <div class="main-title"><i class="bi bi-journal-text"></i> BUKU TAMU</div>
</div>

<!-- FORM DAN TABEL -->
<div class="container mt-3">
  <div class="row">
    <!-- FORM TAMU - lebih lebar (col-lg-5) -->
    <div class="col-lg-5 mb-4">
      <div class="card card-form p-2">
        <div class="card-header text-center text-primary fs-5">
          <i class="bi bi-pencil-square"></i> Form Buku Tamu
        </div>
        <div class="card-body">
          <form action="act-tambah.php" method="post">
            <div class="form-group mb-3">
              <label for="instansi">Nama Instansi</label>
              <input type="text" class="form-control" id="instansi" name="instansi" placeholder="Masukkan Nama Instansi" required>
            </div>
            <div class="form-group mb-3">
              <label for="kepada">Kepada</label>
              <input type="text" class="form-control" id="kepada" name="kepada" placeholder="Ditujukan kepada siapa" required>
            </div>
            <div class="form-group mb-3">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Anda" required>
            </div>
            <div class="form-group mb-3">
              <label for="tlp">No Telepon</label>
              <input type="text" class="form-control" id="tlp" name="tlp" placeholder="081xxxxxxx" required>
            </div>
            <div class="form-group mb-4">
              <label for="pesan">Pesan</label>
              <textarea name="pesan" id="pesan" class="form-control" rows="3" placeholder="Tulis pesan atau keperluan Anda" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-send"></i> Kirim</button>
          </form>
        </div>
      </div>
    </div>

    <!-- TABEL TAMU - lebih luas (col-lg-7) -->
    <div class="col-lg-7 mb-4">
      <div class="card card-table p-2">
        <div class="card-header text-center text-primary fs-5">
          <i class="bi bi-people-fill"></i> Daftar Data Tamu
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="tamu" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Instansi</th>
                  <th>Kepada</th>
                  <th>Nama</th>
                  <th>Telepon</th>
                  <th>Pesan</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $nomor = 1;
                $query_mysql = mysqli_query($host, "SELECT * FROM tamu ORDER BY date_created DESC") or die(mysqli_error($host));
                while($data = mysqli_fetch_array($query_mysql)) {
                ?>
                <tr>
                  <td><?= $nomor++; ?></td>
                  <td><?= htmlspecialchars($data['instansi']); ?></td>
                  <td><?= htmlspecialchars($data['kepada']); ?></td>
                  <td><?= htmlspecialchars($data['nama']); ?></td>
                  <td><?= htmlspecialchars($data['tlp']); ?></td>
                  <td><?= htmlspecialchars($data['pesan']); ?></td>
                  <td><?= $data['date_created']; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- SCRIPTS -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function(){
    $('#tamu').DataTable({
      responsive: true
    });
  });
</script>
</body>
</html>

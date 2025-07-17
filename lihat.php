<?php include 'koneksi.php'; ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Tamu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card shadow p-4">
    <h3 class="text-primary mb-4">Data Pengunjung</h3>
    <a href="index.php" class="btn btn-secondary mb-3">Isi Form Lagi</a>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="table-primary">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Gender</th>
            <th>Pendidikan</th>
            <th>Pekerjaan</th>
            <th>Instansi</th>
            <th>Pemanfaatan</th>
            <th>Layanan</th>
            <th>Detail</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $result = mysqli_query($host, "SELECT * FROM tamu ORDER BY id ASC");
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['hp']) ?></td>
            <td><?= htmlspecialchars($row['gender']) ?></td>
            <td><?= htmlspecialchars($row['pendidikan']) ?></td>
            <td><?= htmlspecialchars($row['pekerjaan']) ?></td>
            <td>
              <?= htmlspecialchars($row['kategori_instansi']) ?><br>
              <small><?= htmlspecialchars($row['nama_instansi']) ?></small>
            </td>
            <td><?= htmlspecialchars($row['pemanfaatan']) ?></td>
            <td><?= htmlspecialchars($row['layanan']) ?></td>
            <td>
              <ul class="mb-0">
                <?php if ($row['perpustakaan']) echo "<li>Perpustakaan: " . htmlspecialchars($row['perpustakaan']) . "</li>"; ?>
                <?php if ($row['permintaan_data']) echo "<li>Data: " . htmlspecialchars($row['permintaan_data']) . "</li>"; ?>
                <?php if ($row['konsultasi']) echo "<li>Konsultasi: " . htmlspecialchars($row['konsultasi']) . "</li>"; ?>
                <?php if ($row['rekomendasi']) echo "<li>Rekomendasi: " . htmlspecialchars($row['rekomendasi']) . "</li>"; ?>
              </ul>
            </td>
            <td><?= htmlspecialchars($row['tanggal']) ?></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>

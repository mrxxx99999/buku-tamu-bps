<?php include 'koneksi.php'; ?>

<?php
// Pagination dan Pencarian
$batas = 10; // ubah batas per halaman jadi 10
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

// Pencarian
$search = isset($_GET['search']) ? mysqli_real_escape_string($host, $_GET['search']) : '';

// Query total data
$queryTotal = "SELECT COUNT(*) as total FROM tamu WHERE nama LIKE '%$search%' OR email LIKE '%$search%'";
$totalResult = mysqli_query($host, $queryTotal);
$totalData = mysqli_fetch_assoc($totalResult)['total'];
$totalHalaman = ceil($totalData / $batas);

// Ambil data sesuai pencarian dan pagination
$query = "SELECT * FROM tamu 
          WHERE nama LIKE '%$search%' OR email LIKE '%$search%' 
          ORDER BY tanggal ASC 
          LIMIT $halaman_awal, $batas";
$result = mysqli_query($host, $query);

// Nomor urut berdasarkan halaman
$no = $halaman_awal + 1;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Tamu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
  <div class="card shadow p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="text-primary">Daftar Tamu</h4>
      <a href="formbukutamu.php" class="btn btn-sm btn-primary">Isi Form Lagi</a>
    </div>

    <!-- Form Pencarian -->
    <form class="d-flex mb-3" method="GET">
      <input class="form-control me-2" type="text" name="search" placeholder="Cari nama atau email..." value="<?= htmlspecialchars($search) ?>">
      <button class="btn btn-outline-primary" type="submit">Cari</button>
    </form>

    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped">
        <thead class="table-primary">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No. HP</th>
            <th>Instansi</th>
            <th>Layanan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($data = mysqli_fetch_array($result)) { ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($data['nama']) ?></td>
              <td><?= htmlspecialchars($data['email']) ?></td>
              <td><?= htmlspecialchars($data['hp']) ?></td>
              <td><?= htmlspecialchars($data['nama_instansi']) ?></td>
              <td><?= htmlspecialchars($data['layanan']) ?></td>
              <td>
                <a href="detailuser.php?id=<?= $data['id'] ?>" class="btn btn-info btn-sm">
                  <i class="bi bi-eye"></i> Detail
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <nav>
      <ul class="pagination justify-content-center">
        <?php if ($halaman > 1): ?>
          <li class="page-item"><a class="page-link" href="?halaman=<?= $halaman - 1 ?>&search=<?= urlencode($search) ?>">«</a></li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalHalaman; $i++): ?>
          <li class="page-item <?= $i == $halaman ? 'active' : '' ?>">
            <a class="page-link" href="?halaman=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
          </li>
        <?php endfor; ?>

        <?php if ($halaman < $totalHalaman): ?>
          <li class="page-item"><a class="page-link" href="?halaman=<?= $halaman + 1 ?>&search=<?= urlencode($search) ?>">»</a></li>
        <?php endif; ?>
      </ul>
    </nav>

    <!-- Tombol Kembali -->
    <a href="index.php" class="btn btn-primary mt-3"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a>
  </div>
</div>

</body>
</html>

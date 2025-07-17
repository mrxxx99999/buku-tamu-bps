<?php
include 'koneksi.php';
if (session_status() === PHP_SESSION_NONE) session_start();

$today = date('Y-m-d');
$total_today = mysqli_fetch_assoc(mysqli_query($host, "SELECT COUNT(*) as total FROM tamu WHERE DATE(tanggal) = CURDATE()"))['total'];
$total_week = mysqli_fetch_assoc(mysqli_query($host, "SELECT COUNT(*) as total FROM tamu WHERE YEARWEEK(tanggal, 1) = YEARWEEK(CURDATE(), 1)"))['total'];
$total_month = mysqli_fetch_assoc(mysqli_query($host, "SELECT COUNT(*) as total FROM tamu WHERE MONTH(tanggal) = MONTH(CURDATE()) AND YEAR(tanggal) = YEAR(CURDATE())"))['total'];
$total_year = mysqli_fetch_assoc(mysqli_query($host, "SELECT COUNT(*) as total FROM tamu WHERE YEAR(tanggal) = YEAR(CURDATE())"))['total'];

$bulan = []; $jumlah = [];
for ($i = 1; $i <= 12; $i++) {
  $month = str_pad($i, 2, '0', STR_PAD_LEFT);
  $tahun = date('Y');
  $res = mysqli_query($host, "SELECT COUNT(*) as total FROM tamu WHERE MONTH(tanggal) = '$month' AND YEAR(tanggal) = '$tahun'");
  $row = mysqli_fetch_assoc($res);
  $bulan[] = date('M', mktime(0, 0, 0, $i, 10));
  $jumlah[] = $row['total'];
}

// Grafik layanan
$layanan = ['Perpustakaan', 'Permintaan Data', 'Konsultasi', 'Rekomendasi'];
$data_layanan = [];
foreach ($layanan as $layananItem) {
  $query = mysqli_query($host, "SELECT COUNT(*) as total FROM tamu WHERE layanan LIKE '%$layananItem%'");
  $result = mysqli_fetch_assoc($query);
  $data_layanan[] = $result['total'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Buku Tamu</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-size: 15px;
    }
    .card-stat {
      transition: transform 0.2s ease;
      box-shadow: 0 0 6px rgba(0,0,0,0.1);
    }
    .card-stat:hover {
      transform: scale(1.02);
    }
    .chart-card {
      box-shadow: 0 0 8px rgba(0,0,0,0.05);
      margin-bottom: 20px;
    }
    .chart-container {
      height: 280px;
    }
  </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">📊 Dashboard Buku Tamu</h4>
    <small class="text-muted"><?= date('l, d M Y') ?></small>
  </div>

  <div class="row text-white">
    <div class="col-6 col-md-3 mb-2">
      <div class="card bg-primary card-stat">
        <div class="card-body p-4">
          <i class="bi bi-calendar-day-fill"></i>
          <div>Hari Ini</div>
          <h5><?= $total_today ?></h5>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-3 mb-2">
      <div class="card bg-success card-stat">
        <div class="card-body p-4">
          <i class="bi bi-calendar-week-fill"></i>
          <div>Minggu Ini</div>
          <h5><?= $total_week ?></h5>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-3 mb-2">
      <div class="card bg-warning text-dark card-stat">
        <div class="card-body p-4">
          <i class="bi bi-calendar-month-fill"></i>
          <div>Bulan Ini</div>
          <h5><?= $total_month ?></h5>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-3 mb-2">
      <div class="card bg-danger card-stat">
        <div class="card-body p-4">
          <i class="bi bi-calendar3"></i>
          <div>Tahun Ini</div>
          <h5><?= $total_year ?></h5>
        </div>
      </div>
    </div>
  </div>

  <!-- Grafik Bulanan dan Grafik Layanan -->
  <div class="row">
    <div class="col-md-6 mb-3">
      <div class="card chart-card">
        <div class="card-header bg-light py-2">
          <strong>📅 Grafik Bulanan</strong>
        </div>
        <div class="card-body chart-container">
          <canvas id="chartTamu"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6 mb-3">
      <div class="card chart-card">
        <div class="card-header bg-light py-2">
          <strong>📌 Grafik Jumlah Tamu per Layanan</strong>
        </div>
        <div class="card-body chart-container">
          <canvas id="chartLayanan"></canvas>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- Chart.js -->
<script>
  new Chart(document.getElementById('chartTamu').getContext('2d'), {
    type: 'bar',
    data: {
      labels: <?= json_encode($bulan) ?>,
      datasets: [{
        label: 'Jumlah Tamu',
        data: <?= json_encode($jumlah) ?>,
        backgroundColor: 'rgba(13, 110, 253, 0.7)'
      }]
    },
    options: {
      responsive: true,
      scales: { y: { beginAtZero: true } },
      plugins: { legend: { display: false } }
    }
  });

  new Chart(document.getElementById('chartLayanan').getContext('2d'), {
    type: 'bar',
    data: {
      labels: <?= json_encode($layanan) ?>,
      datasets: [{
        label: 'Tamu',
        data: <?= json_encode($data_layanan) ?>,
        backgroundColor: 'rgba(40, 167, 69, 0.7)'
      }]
    },
    options: {
      responsive: true,
      scales: { y: { beginAtZero: true } },
      plugins: { legend: { display: false } }
    }
  });
</script>

</body>
</html>

<?php
include 'koneksi.php';
if (session_status() === PHP_SESSION_NONE) session_start();

$today = date('Y-m-d');
$startOfWeek = date('Y-m-d', strtotime('monday this week'));
$startOfMonth = date('Y-m-01');
$startOfYear = date('Y-01-01');

$total_today = mysqli_fetch_assoc(mysqli_query($host, "SELECT COUNT(*) as total FROM tamu WHERE DATE(tanggal) = CURDATE()"))['total'];

$total_week = mysqli_fetch_assoc(mysqli_query($host, "SELECT COUNT(*) as total FROM tamu WHERE YEARWEEK(tanggal, 1) = YEARWEEK(CURDATE(), 1)"))['total'];
$total_month = mysqli_fetch_assoc(mysqli_query($host, "SELECT COUNT(*) as total FROM tamu WHERE MONTH(tanggal) = MONTH(CURDATE()) AND YEAR(tanggal) = YEAR(CURDATE())"))['total'];
$total_year = mysqli_fetch_assoc(mysqli_query($host, "SELECT COUNT(*) as total FROM tamu WHERE YEAR(tanggal) = YEAR(CURDATE())"))['total'];

$bulan = [];
$jumlah = [];
for ($i = 1; $i <= 12; $i++) {
  $month = str_pad($i, 2, '0', STR_PAD_LEFT);
  $tahun = date('Y');
  $result = mysqli_query($host, "SELECT COUNT(*) as total FROM tamu WHERE MONTH(tanggal) = '$month' AND YEAR(tanggal) = '$tahun'");
  $row = mysqli_fetch_assoc($result);
  $bulan[] = date('F', mktime(0, 0, 0, $i, 10));
  $jumlah[] = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard Buku Tamu</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    .card-stat {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .card-stat:hover {
      transform: scale(1.03);
      box-shadow: 0 0 15px rgba(0,0,0,0.15);
    }

    .card-stat i {
      font-size: 1.8rem;
    }

    .card-stat .card-body {
      display: flex;
      flex-direction: column;
      align-items: start;
      justify-content: center;
      gap: 5px;
    }

    .chart-card {
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<?php include 'navbar.php'; ?>
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">📊 Dashboard Buku Tamu</h3>
    <small class="text-muted"><?= date('l, d M Y') ?></small>
  </div>

  <!-- Statistik -->
  <div class="row text-white">
    <div class="col-md-3 mb-3">
      <div class="card bg-primary card-stat">
        <div class="card-body">
          <i class="bi bi-calendar-day-fill"></i>
          <h5 class="mb-0">Hari Ini</h5>
          <h3><?= $total_today ?></h3>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card bg-success card-stat">
        <div class="card-body">
          <i class="bi bi-calendar-week-fill"></i>
          <h5 class="mb-0">Minggu Ini</h5>
          <h3><?= $total_week ?></h3>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card bg-warning card-stat text-dark">
        <div class="card-body">
          <i class="bi bi-calendar-month-fill"></i>
          <h5 class="mb-0">Bulan Ini</h5>
          <h3><?= $total_month ?></h3>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card bg-danger card-stat">
        <div class="card-body">
          <i class="bi bi-calendar3"></i>
          <h5 class="mb-0">Tahun Ini</h5>
          <h3><?= $total_year ?></h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Grafik -->
  <div class="card mt-4 chart-card">
    <div class="card-header bg-light">
      <strong>📈 Grafik Jumlah Tamu Tahun <?= date('Y') ?></strong>
    </div>
    <div class="card-body">
      <canvas id="chartTamu"></canvas>
    </div>
  </div>
</div>

<script>
  const ctx = document.getElementById('chartTamu').getContext('2d');
  const chartTamu = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= json_encode($bulan) ?>,
      datasets: [{
        label: 'Jumlah Tamu',
        data: <?= json_encode($jumlah) ?>,
        backgroundColor: 'rgba(13, 110, 253, 0.7)',
        borderColor: 'rgba(13, 110, 253, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1
          }
        }
      },
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              return context.dataset.label + ': ' + context.parsed.y + ' tamu';
            }
          }
        }
      }
    }
  });
</script>
</body>
</html>

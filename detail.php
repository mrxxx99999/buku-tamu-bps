<?php
include 'koneksi.php';

// Cek parameter ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('ID tamu tidak valid'); window.location='lihat.php';</script>";
    exit;
}

$id = intval($_GET['id']);
$query = mysqli_query($host, "SELECT * FROM tamu WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data tamu tidak ditemukan'); window.location='lihat.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .table th {
            width: 30%;
            background-color: #f8f9fa;
        }
        .section-title {
            font-weight: bold;
            font-size: 1.1rem;
            color: #0d6efd;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <div class="card p-4">
        <h3 class="text-center text-primary mb-4"><i class="bi bi-person-lines-fill me-2"></i>Detail Data Tamu</h3>

        <table class="table table-bordered">
            <tr><th>Nama</th><td><?= htmlspecialchars($data['nama']) ?></td></tr>
            <tr><th>Email</th><td><?= htmlspecialchars($data['email']) ?></td></tr>
            <tr><th>No HP</th><td><?= htmlspecialchars($data['hp']) ?></td></tr>
            <tr><th>Jenis Kelamin</th><td><?= htmlspecialchars($data['gender']) ?></td></tr>
            <tr><th>Pendidikan</th><td><?= htmlspecialchars($data['pendidikan']) ?></td></tr>
            <tr><th>Pekerjaan</th><td><?= htmlspecialchars($data['pekerjaan']) ?></td></tr>
            <tr><th>Kategori Instansi</th><td><?= htmlspecialchars($data['kategori_instansi']) ?></td></tr>
            <tr><th>Nama Instansi</th><td><?= htmlspecialchars($data['nama_instansi']) ?></td></tr>
            <tr><th>Pemanfaatan</th><td><?= htmlspecialchars($data['pemanfaatan']) ?></td></tr>
            <tr><th>Layanan</th><td><?= htmlspecialchars($data['layanan']) ?></td></tr>
        </table>

        <!-- Bagian detail layanan -->
        <div class="section-title"><i class="bi bi-info-circle me-1"></i>Detail Layanan</div>
        <table class="table table-bordered">
            <?php if (!empty($data['perpustakaan'])): ?>
                <tr><th>Perpustakaan</th><td><?= htmlspecialchars($data['perpustakaan']) ?></td></tr>
            <?php endif; ?>

            <?php if (!empty($data['permintaan_data'])): ?>
                <tr><th>Permintaan Data</th><td><?= htmlspecialchars($data['permintaan_data']) ?></td></tr>
            <?php endif; ?>

            <?php if (!empty($data['konsultasi'])): ?>
                <tr><th>Konsultasi Statistik</th><td><?= htmlspecialchars($data['konsultasi']) ?></td></tr>
            <?php endif; ?>

            <?php if (!empty($data['rekomendasi'])): ?>
                <tr><th>Rekomendasi</th><td><?= htmlspecialchars($data['rekomendasi']) ?></td></tr>
            <?php endif; ?>
        </table>

        <div class="text-muted text-end">Tanggal Kunjungan: <strong><?= date('d-m-Y H:i', strtotime($data['tanggal'])) ?></strong></div>

        <div class="text-start mt-4">
            <a href="adminpage.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>
</body>
</html>

<?php
include 'koneksi.php';

// Set zona waktu ke WITA (Asia/Makassar)
date_default_timezone_set('Asia/Makassar');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama              = $_POST['nama'];
    $email             = $_POST['email'];
    $hp                = $_POST['hp'];
    $gender            = $_POST['gender'];
    $pendidikan        = $_POST['pendidikan'];
    $pekerjaan         = $_POST['pekerjaan'];
    $kategori_instansi = $_POST['kategori_instansi'];
    $nama_instansi     = $_POST['nama_instansi'];
    $pemanfaatan       = $_POST['pemanfaatan'];
    $layanan_array     = isset($_POST['layanan']) ? $_POST['layanan'] : [];
    $layanan           = implode(', ', $layanan_array);

    $perpustakaan    = $_POST['perpustakaan_detail'] ?? '';
    $permintaan_data = $_POST['permintaan_data_detail'] ?? '';
    $konsultasi      = $_POST['konsultasi_detail'] ?? '';
    $rekomendasi     = $_POST['rekomendasi_detail'] ?? '';

    // Ambil waktu WITA sekarang
    $tanggal = date('Y-m-d H:i:s');

    $query = "INSERT INTO tamu (
        nama, email, hp, gender, pendidikan, pekerjaan,
        kategori_instansi, nama_instansi, pemanfaatan, layanan,
        perpustakaan, permintaan_data, konsultasi, rekomendasi, tanggal
    ) VALUES (
        '$nama', '$email', '$hp', '$gender', '$pendidikan', '$pekerjaan',
        '$kategori_instansi', '$nama_instansi', '$pemanfaatan', '$layanan',
        '$perpustakaan', '$permintaan_data', '$konsultasi', '$rekomendasi', '$tanggal'
    )";

    if (mysqli_query($host, $query)) {
        echo "<script>alert('Data berhasil disimpan');window.location='lihat.php';</script>";
    } else {
        echo "Gagal menyimpan: " . mysqli_error($host);
    }
}
?>

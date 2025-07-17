<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama             = $_POST['nama'];
    $email            = $_POST['email'];
    $hp               = $_POST['hp'];
    $gender           = $_POST['gender'];
    $pendidikan       = $_POST['pendidikan'];
    $pekerjaan        = $_POST['pekerjaan'];
    $kategori_instansi = $_POST['kategori_instansi'];
    $nama_instansi    = $_POST['nama_instansi'];
    $pemanfaatan      = $_POST['pemanfaatan'];
    $layanan          = isset($_POST['layanan']) ? $_POST['layanan'] : [];

    // Konversi checkbox layanan ke nilai 1/0
    $perpustakaan     = in_array("Perpustakaan", $layanan) ? 1 : 0;
    $permintaan_data  = in_array("Permintaan Data", $layanan) ? 1 : 0;
    $konsultasi       = in_array("Konsultasi Statistik", $layanan) ? 1 : 0;
    $rekomendasi      = in_array("Rekomendasi", $layanan) ? 1 : 0;

    $tanggal          = date('Y-m-d H:i:s');

    // Simpan ke database
    $query = "INSERT INTO tamu (
        nama, email, hp, gender, pendidikan, pekerjaan, 
        kategori_instansi, nama_instansi, pemanfaatan, layanan, 
        perpustakaan, permintaan_data, konsultasi, rekomendasi, tanggal
    ) VALUES (
        '$nama', '$email', '$hp', '$gender', '$pendidikan', '$pekerjaan', 
        '$kategori_instansi', '$nama_instansi', '$pemanfaatan', 
        '".implode(", ", $layanan)."', 
        '$perpustakaan', '$permintaan_data', '$konsultasi', '$rekomendasi', '$tanggal'
    )";

    if (mysqli_query($host, $query)) {
        echo "<script>alert('Data berhasil disimpan');window.location='index.php';</script>";
    } else {
        echo "Gagal menyimpan: " . mysqli_error($host);
    }
}
?>

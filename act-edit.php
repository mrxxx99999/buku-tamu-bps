<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Gunakan kolom 'id' bukan 'id_tamu'
  $id         = $_POST['id'];
  $nama       = mysqli_real_escape_string($host, $_POST['nama']);
  $email      = mysqli_real_escape_string($host, $_POST['email']);
  $hp         = mysqli_real_escape_string($host, $_POST['hp']);
  $gender     = mysqli_real_escape_string($host, $_POST['gender']);
  $pendidikan = mysqli_real_escape_string($host, $_POST['pendidikan']);
  $pekerjaan  = mysqli_real_escape_string($host, $_POST['pekerjaan']);
  $kategori_instansi = mysqli_real_escape_string($host, $_POST['kategori_instansi']);
  $nama_instansi     = mysqli_real_escape_string($host, $_POST['nama_instansi']);
  $pemanfaatan       = mysqli_real_escape_string($host, $_POST['pemanfaatan']);
  $layanan           = mysqli_real_escape_string($host, $_POST['layanan']);
  $perpustakaan      = mysqli_real_escape_string($host, $_POST['perpustakaan']);
  $permintaan_data   = mysqli_real_escape_string($host, $_POST['permintaan_data']);
  $konsultasi        = mysqli_real_escape_string($host, $_POST['konsultasi']);
  $rekomendasi       = mysqli_real_escape_string($host, $_POST['rekomendasi']);

  $query = "UPDATE tamu SET 
              nama='$nama',
              email='$email',
              hp='$hp',
              gender='$gender',
              pendidikan='$pendidikan',
              pekerjaan='$pekerjaan',
              kategori_instansi='$kategori_instansi',
              nama_instansi='$nama_instansi',
              pemanfaatan='$pemanfaatan',
              layanan='$layanan',
              perpustakaan='$perpustakaan',
              permintaan_data='$permintaan_data',
              konsultasi='$konsultasi',
              rekomendasi='$rekomendasi'
            WHERE id='$id'";

  if (mysqli_query($host, $query)) {
    echo "<script>alert('Data berhasil diperbarui'); window.location='adminpage.php';</script>";
  } else {
    echo "<script>alert('Terjadi kesalahan saat mengupdate data: " . mysqli_error($host) . "'); window.history.back();</script>";
  }
} else {
  echo "<script>alert('Akses tidak sah!'); window.location='adminpage.php';</script>";
}
?>

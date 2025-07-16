<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id_tamu   = $_POST['id_tamu'];
  $instansi  = mysqli_real_escape_string($host, $_POST['instansi']);
  $kepada    = mysqli_real_escape_string($host, $_POST['kepada']);
  $nama      = mysqli_real_escape_string($host, $_POST['nama']);
  $tlp       = mysqli_real_escape_string($host, $_POST['tlp']);
  $pesan     = mysqli_real_escape_string($host, $_POST['pesan']);

  $query = "UPDATE tamu SET 
              instansi='$instansi',
              kepada='$kepada',
              nama='$nama',
              tlp='$tlp',
              pesan='$pesan' 
            WHERE id_tamu='$id_tamu'";

  if (mysqli_query($host, $query)) {
    echo "<script>alert('Data berhasil diperbarui'); window.location='adminpage.php';</script>";
  } else {
    echo "<script>alert('Terjadi kesalahan saat mengupdate data'); window.history.back();</script>";
  }
} else {
  echo "<script>alert('Akses tidak sah!'); window.location='adminpage.php';</script>";
}
?>

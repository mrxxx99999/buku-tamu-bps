<?php
include 'koneksi.php';
$id_tamu = $_POST['id_tamu'];
$instansi = $_POST['instansi'];
$kepada = $_POST['kepada'];
$nama = $_POST['nama'];
$tlp = $_POST['tlp'];
$pesan = $_POST['pesan'];
$date_created = date('Y-m-d');

mysqli_query($host,"INSERT INTO tamu VALUES('','$instansi','$kepada','$nama','$tlp','$pesan' ,'$date_created')");

header("location:formbukutamu.php");
?>

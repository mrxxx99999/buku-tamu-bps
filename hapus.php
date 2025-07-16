<?php
include 'koneksi.php';
$id_tamu = $_GET['id_tamu'];
mysqli_query($host,"DELETE FROM tamu WHERE id_tamu='$id_tamu'")or die(mysql_error());

header("location:adminpage.php");
?>

<?php
include 'koneksi.php';
$id = $_GET['id'];
mysqli_query($host,"DELETE FROM tamu WHERE id='$id'")or die(mysql_error());

header("location:adminpage.php");
?>

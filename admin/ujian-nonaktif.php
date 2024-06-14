<?php 
if (isset($_GET['id'])) {
	include '../koneksi.php';
	$id = $_GET['id'];
	mysqli_query($koneksi, "UPDATE ujian SET status=0 WHERE id_ujian='$id' ");
	header("location:ujian.php?pesan=nonaktif");
}
?>
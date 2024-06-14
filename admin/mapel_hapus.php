<?php
if (isset($_GET['id'])) {
	include '../koneksi.php';

	$id = $_GET['id'];
	$hapus = mysqli_query($koneksi,"DELETE FROM mapel WHERE id_mapel='$id' ");

	if ($hapus) {
		header("location:mapel.php?pesan=hapus");
	}else{
		header("location:mapel.php?pesan=dilarangHapus");
	}
}
?>
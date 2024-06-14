<?php
if (isset($_GET['id'])) {
	include '../koneksi.php';

	$id = $_GET['id'];
	$hapus = mysqli_query($koneksi,"DELETE FROM kelas WHERE id_kelas='$id'");
	
	if ($hapus) {
		header("location:kelas.php?pesan=hapus");
	}else{
		header("location:kelas.php?pesan=dilarangHapus");
	}
}
?>
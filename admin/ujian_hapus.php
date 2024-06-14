<?php
if (isset($_GET['id'])) {
	include '../koneksi.php';

	$id = $_GET['id'];
	// hapus data
	$hapus = mysqli_query($koneksi,"DELETE FROM ujian WHERE id_ujian='$id'");
	if ($hapus) {
		header("location:ujian.php?pesan=hapus");
	}else{
		// on delete restrict
		header("location:ujian.php?pesan=dilarangHapus");
	}
}
?>
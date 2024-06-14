<?php
if (isset($_GET['nis'])) {
	include '../koneksi.php';

	$nis = $_GET['nis'];
	$hapus = mysqli_query($koneksi,"DELETE FROM siswa WHERE nis='$nis'");
	
	if ($hapus) {
		header("location:siswa.php?pesan=hapus");
	}else{
		header("location:siswa.php?pesan=dilarangHapus");
	}
}

?>
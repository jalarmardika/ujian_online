<?php
if (isset($_POST['submit'])) {
	include '../koneksi.php';

	$nama_kelas = $_POST['nama_kelas'];
	mysqli_query($koneksi,"INSERT INTO kelas VALUES('','$nama_kelas')");
	header("location:kelas.php?pesan=berhasil");
}

?>
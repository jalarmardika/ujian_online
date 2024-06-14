<?php
if (isset($_POST['submit'])) {
	include '../koneksi.php';

	$nama_mapel = $_POST['nama_mapel'];
	mysqli_query($koneksi,"INSERT INTO mapel VALUES('','$nama_mapel')");
	header("location:mapel.php?pesan=berhasil");
}
?>
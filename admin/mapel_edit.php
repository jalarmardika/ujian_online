<?php
if (isset($_POST['submit'])) {
	include '../koneksi.php';

	$id = $_POST['id'];
	$nama_mapel = $_POST['nama_mapel'];

	mysqli_query($koneksi,"UPDATE mapel SET mata_pelajaran='$nama_mapel' WHERE id_mapel='$id'");
	header("location:mapel.php?pesan=edit");
}
?>
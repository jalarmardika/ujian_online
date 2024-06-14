<?php
if (isset($_POST['submit'])) {
	include '../koneksi.php';

	$id = $_POST['id'];
	$nama_kelas = $_POST['nama_kelas'];

	mysqli_query($koneksi,"UPDATE kelas SET nama_kelas='$nama_kelas' WHERE id_kelas='$id'");
	header("location:kelas.php?pesan=edit");
}
?>
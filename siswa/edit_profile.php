<?php
if (isset($_POST['submit'])) {
	include '../koneksi.php';

	$nama = $_POST['nama'];
	$kelas = $_POST['kelas'];
	$nis = $_POST['nis'];
	$email = $_POST['email'];
	mysqli_query($koneksi,"UPDATE siswa SET nama='$nama',email='$email' WHERE nis='$nis'");
	header("location:profile.php?pesan=edit");
}

?>
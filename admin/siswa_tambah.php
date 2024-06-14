<?php
if (isset($_POST['submit'])) {
	include '../koneksi.php';

	$nama = $_POST['nama'];
	$kelas = $_POST['kelas'];
	$nis = $_POST['nis'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$status = 1;

	$cari = mysqli_query($koneksi,"SELECT * FROM siswa WHERE nis='$nis'");
	if (mysqli_num_rows($cari) > 0) {
		header("location:siswa.php?pesan=gagal");
	}else{
		mysqli_query($koneksi,"INSERT INTO siswa VALUES('$nis','$nama','$email','$kelas','$password','$status')");
		header("location:siswa.php?pesan=berhasil");
	}
}

?>
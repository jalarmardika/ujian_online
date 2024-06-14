<?php
if (isset($_POST['submit'])) {
	include '../koneksi.php';

	$nama = $_POST['nama'];
	$kelas = $_POST['kelas'];
	$nis = $_POST['nis'];
	$email = $_POST['email'];
	$status = $_POST['status'];

	if ($_POST['password'] == "") {
		mysqli_query($koneksi,"UPDATE siswa SET nama='$nama',id_kelas='$kelas',status='$status',email='$email' WHERE nis='$nis'");
	}else{
		$password = md5($_POST['password']);
		mysqli_query($koneksi,"UPDATE siswa SET nama='$nama',id_kelas='$kelas',status='$status',email='$email',password='$password' WHERE nis='$nis' ");
	}
	header("location:siswa.php?pesan=edit");
}
?>
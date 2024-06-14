<?php
if (isset($_POST['submit'])) {
	include '../koneksi.php';

	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$level = $_POST['level'];

	mysqli_query($koneksi,"INSERT INTO user VALUES('','$email','$nama','$password','$level')");
	header("location:pengguna.php?pesan=berhasil");
}

?>
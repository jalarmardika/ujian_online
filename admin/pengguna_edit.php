<?php
if (isset($_POST['submit'])) {
	include '../koneksi.php';

	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$level = $_POST['level'];

	if ($_POST['password'] == "") {
		mysqli_query($koneksi,"UPDATE user SET nama='$nama',level='$level',email='$email' WHERE id_user='$id' ");
	}else{
		$password = md5($_POST['password']);
		mysqli_query($koneksi,"UPDATE user SET nama='$nama',level='$level',email='$email',password='$password' WHERE id_user='$id' ");
	}
	header("location:pengguna.php?pesan=edit");
}
?>
<?php
if (isset($_POST['submit'])) {
	include '../koneksi.php';

	$pass_lama = md5($_POST['pass_lama']);
	$pass_baru = md5($_POST['pass_baru']);
	$konfirm = md5($_POST['konfirm']);
	$id = $_POST['id'];
	// cek apakah user benar memasukkan password lama
	$cek = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id' and password='$pass_lama' ");
	// jika benar
	if (mysqli_num_rows($cek) > 0) {
		if ($pass_baru == $konfirm) {
			mysqli_query($koneksi,"UPDATE user SET password='$pass_baru' WHERE id_user='$id'");
			header("location:ganti_password.php?pesan=ganti_password");
		} else {
			header("location:ganti_password.php?pesan=konfirmasi_password_gagal");
		}
	}else{
		header("location:ganti_password.php?pesan=password_lama_salah");
	}

}	

?>
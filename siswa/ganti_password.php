<?php
if (isset($_POST['submit'])) {
	include '../koneksi.php';

	$pass_lama = md5($_POST['pass_lama']);
	$pass_baru = md5($_POST['pass_baru']);
	$konfirm = md5($_POST['konfirm']);
	$nis = $_POST['nis'];
	// cek apakah siswa benar memasukkan password lama
	$cek = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis' and password='$pass_lama' ");
	// jika benar
	if (mysqli_num_rows($cek) > 0) {
		if ($pass_baru == $konfirm) {
			mysqli_query($koneksi,"UPDATE siswa SET password='$pass_baru' WHERE nis='$nis'");
			header("location:profile.php?pesan=ganti_password");
		} else {
			
			header("location:profile.php?pesan=konfirmasi_password_gagal");
		}
	}else{
		header("location:profile.php?pesan=password_lama_salah");
	}

}	

?>
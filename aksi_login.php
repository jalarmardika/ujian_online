<?php

if (isset($_POST['submit'])) {
	include'koneksi.php';
	session_start();
	
	$email = $_POST['email'];
	$password = md5($_POST['pass']);

	$siswa = mysqli_query($koneksi,"SELECT * FROM siswa WHERE email='$email' and password='$password'");
	$jumlah_siswa = mysqli_num_rows($siswa);

	$user = mysqli_query($koneksi,"SELECT * FROM user WHERE email='$email' and password='$password'");
	$jumlah_user = mysqli_num_rows($user);

	if ($jumlah_user > 0){
		$data_user = mysqli_fetch_assoc($user);
		$_SESSION['id_user']=$data_user['id_user'];
		$_SESSION['status']=$data_user['level'];
		header("location:admin/index.php");		
	}elseif ($jumlah_siswa > 0) {
		$data_siswa = mysqli_fetch_assoc($siswa);
		// jika status siswa nonaktif maka siswa tidak bisa masuk dan akan di redirect ke halaman index.php (halaman login)
		if ($data_siswa['status'] == 0) {
			header("location:index.php?pesan=nonaktif");
		} else {
			$_SESSION['nis']=$data_siswa['nis'];
			$_SESSION['status']="Siswa";
			header("location:siswa/index.php");	
		}	
	}
	else{
		header("location:index.php?pesan=gagal");
		
	}
}

?>
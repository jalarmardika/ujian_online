<?php
if (isset($_POST['submit'])) {
	session_start();
	include '../koneksi.php';

	$jenis = $_POST['jenis'];
	$mapel = $_POST['mapel'];
	$kelas = $_POST['kelas'];
	$waktu = $_POST['waktu'];
	date_default_timezone_set('Asia/Jakarta');
	$tgl_dibuat = date('Y-m-d H:i:s');
	$status = 0;
	$id_user = $_SESSION['id_user'];
	mysqli_query($koneksi,"INSERT INTO ujian(tgl_dibuat,jenis_ujian,id_mapel,id_kelas,waktu,status,id_user) VALUES('$tgl_dibuat','$jenis','$mapel','$kelas','$waktu','$status','$id_user')");
	header("location:ujian.php?pesan=berhasil");
}
?>
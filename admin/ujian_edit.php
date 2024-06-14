<?php
if (isset($_POST['submit'])) {
	include '../koneksi.php';

	$id = $_POST['id'];
	$jenis = $_POST['jenis'];
	$mapel = $_POST['mapel'];
	$kelas = $_POST['kelas'];
	$waktu = $_POST['waktu'];
	if (isset($_POST['status']) && !empty($_POST['status'])) {
		$status = $_POST['status'];
		mysqli_query($koneksi,"UPDATE ujian SET jenis_ujian='$jenis',id_mapel='$mapel',id_kelas='$kelas',waktu='$waktu',status='$status' WHERE id_ujian='$id'");
	}else{
		mysqli_query($koneksi,"UPDATE ujian SET jenis_ujian='$jenis',id_mapel='$mapel',id_kelas='$kelas',waktu='$waktu' WHERE id_ujian='$id'");
	}
	
	header("location:ujian.php?pesan=edit");
}
?>
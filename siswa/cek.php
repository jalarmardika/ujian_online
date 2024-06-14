<?php
if (isset($_POST['nis']) && isset($_POST['id_ujian'])) {
	include '../koneksi.php';

	$nis = $_POST['nis'];
	$id_ujian = $_POST['id_ujian'];

	$siswa = mysqli_query($koneksi,"SELECT * FROM siswa WHERE nis='$nis'");
	$arraySiswa = mysqli_fetch_array($siswa);

	$ujian = mysqli_query($koneksi,"SELECT * FROM ujian WHERE id_ujian='$id_ujian'");
	$arrayUjian = mysqli_fetch_array($ujian);
	$data = [
		'status_siswa' => $arraySiswa['status'],
		'status_ujian' => $arrayUjian['status']
	];

	echo json_encode($data);
}

?>
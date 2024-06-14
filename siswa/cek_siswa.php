<?php
if (isset($_POST['nis'])) {

	include '../koneksi.php';
	$nis = $_POST['nis'];

	$siswa = mysqli_query($koneksi,"SELECT * FROM siswa WHERE nis='$nis'");
	$arraySiswa = mysqli_fetch_assoc($siswa);

	$data = [
		'status_siswa' => $arraySiswa['status']
	];

	echo json_encode($data);
}

?>
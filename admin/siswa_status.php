<?php 
if (isset($_GET['nis'])) {
	include '../koneksi.php';
	$nis = $_GET['nis'];
	$siswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis' ");
	if (mysqli_num_rows($siswa) > 0) {
		$data = mysqli_fetch_assoc($siswa);
		if ($data['status'] == 0) {
			mysqli_query($koneksi,"UPDATE siswa SET status='1' WHERE nis='$nis'");
		} elseif ($data['status'] == 1) {
			mysqli_query($koneksi,"UPDATE siswa SET status='0' WHERE nis='$nis'");
		}
		header("location:siswa.php?pesan=updateStatus");
	} else {
		echo "Siswa Tidak ditemukan";
	}
}
?>
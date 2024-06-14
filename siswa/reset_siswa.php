<?php 
if (isset($_GET['pesan'])) {
	if ($_GET['pesan'] == "reset_siswa") {
		session_start();
		include '../koneksi.php';
		// delete dari tabel pengerjaan
		$nis = $_GET['nis'];
		mysqli_query($koneksi, "DELETE FROM pengerjaan WHERE nis='$nis' ");
		// hapus semua session
		session_destroy();
		// redirect keh halaman index.php (halaman login) dgn pesan reset
		header("location:../index.php?pesan=reset");
	}
}
?>
<?php 
if (isset($_GET['pesan'])) {
	if ($_GET['pesan'] == "reset_ujian") {
		include '../koneksi.php';
		// delete dari tabel pengerjaan
		$nis = $_GET['nis'];
		mysqli_query($koneksi, "DELETE FROM pengerjaan WHERE nis='$nis' ");
		// redirect keh halaman ujian.php dgn pesan reset
		header("location:ujian.php?pesan=reset");
	}
}
?>
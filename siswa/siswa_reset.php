<?php 
if (isset($_GET['pesan'])) {
	if ($_GET['pesan'] == "reset_siswa") {
		session_start();
		// hapus semua session
		session_destroy();
		// redirect keh halaman index.php (halaman login) dgn pesan reset
		header("location:../index.php?pesan=reset");
	}
}
?>
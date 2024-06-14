<?php 
if (isset($_GET['id'])) {
	include '../koneksi.php';
	$id = $_GET['id'];
	$id_ujian = $_GET['id_ujian'];
	$soal = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$id' ");
	$data_soal = mysqli_fetch_assoc($soal);
	// delete gambar jika soal memiliki gambar 
	unlink('../assets/img/'.$data_soal['gambar_soal']);
	unlink('../assets/img/'.$data_soal['gambar_a']);
	unlink('../assets/img/'.$data_soal['gambar_b']);
	unlink('../assets/img/'.$data_soal['gambar_c']);
	unlink('../assets/img/'.$data_soal['gambar_d']);
	unlink('../assets/img/'.$data_soal['gambar_e']);
	// hapus soal
	mysqli_query($koneksi, "DELETE FROM soal WHERE id_soal='$id' ");
	// jumlah soal di tabel ujian di kurangi 1
	$ujian = mysqli_query($koneksi,"SELECT * FROM ujian WHERE id_ujian='$id_ujian'");
	$array = mysqli_fetch_assoc($ujian);
	$jml_soal = $array['jml_soal'];
	$update = $jml_soal - 1;
	mysqli_query($koneksi,"UPDATE ujian SET jml_soal='$update' WHERE id_ujian='$id_ujian'");
	// cek apakah sudah ada siswa yg SELESAI mengerjakan ujian ini
	$cek_nilai = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_ujian='$id_ujian' ");
	if(mysqli_num_rows($cek_nilai) > 0){
		 // jika ada maka semua data dengan id_ujian='$id_ujian' akan dihapus dari tabel nilai
		mysqli_query($koneksi, "DELETE FROM nilai WHERE id_ujian='$id_ujian' ");
	}
	header("location:daftar-soal.php?id=$id_ujian");
}
?>
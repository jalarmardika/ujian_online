<?php
if (isset($_POST['submit'])) {
	include '../koneksi.php';
	$id_soal = $_POST['id'];
	$id_ujian = $_POST['id_ujian'];
	$query_soal = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$id_soal' ");
	$data_soal = mysqli_fetch_assoc($query_soal);
	// gambar soal
	if ($_FILES['gambar_soal']['name'] == "") {
		$img_soal = $data_soal['gambar_soal'];
	} else {
		unlink('../assets/img/'.$data_soal['gambar_soal']);
		$img_soal = time().str_replace(" ", "", $_FILES['gambar_soal']['name']);
		$file_tmp_soal =$_FILES['gambar_soal']['tmp_name'];
		move_uploaded_file($file_tmp_soal, '../assets/img/'.$img_soal);
	}
	//gambar a
	if ($_FILES['gambar_a']['name'] == "") {
		$img_a = $data_soal['gambar_a'];
	} else {
		unlink('../assets/img/'.$data_soal['gambar_a']);
		$img_a = time().str_replace(" ", "", $_FILES['gambar_a']['name']);
		$file_tmp_a =$_FILES['gambar_a']['tmp_name'];
		move_uploaded_file($file_tmp_a, '../assets/img/'.$img_a);
	}
	//gambar b
	if ($_FILES['gambar_b']['name'] == "") {
		$img_b = $data_soal['gambar_b'];
	} else {
		unlink('../assets/img/'.$data_soal['gambar_b']);
		$img_b = time().str_replace(" ", "", $_FILES['gambar_b']['name']);
		$file_tmp_b =$_FILES['gambar_b']['tmp_name'];
		move_uploaded_file($file_tmp_b, '../assets/img/'.$img_b);
	}
	//gambar c
	if ($_FILES['gambar_c']['name'] == "") {
		$img_c = $data_soal['gambar_c'];
	} else {
		unlink('../assets/img/'.$data_soal['gambar_c']);
		$img_c = time().str_replace(" ", "", $_FILES['gambar_c']['name']);
		$file_tmp_c =$_FILES['gambar_c']['tmp_name'];
		move_uploaded_file($file_tmp_c, '../assets/img/'.$img_c);
	}
	//gambar d
	if ($_FILES['gambar_d']['name'] == "") {
		$img_d = $data_soal['gambar_d'];
	} else {
		unlink('../assets/img/'.$data_soal['gambar_d']);
		$img_d = time().str_replace(" ", "", $_FILES['gambar_d']['name']);
		$file_tmp_d =$_FILES['gambar_d']['tmp_name'];
		move_uploaded_file($file_tmp_d, '../assets/img/'.$img_d);
	}
	//gambar e
	if ($_FILES['gambar_e']['name'] == "") {
		$img_e = $data_soal['gambar_e'];
	} else {
		unlink('../assets/img/'.$data_soal['gambar_e']);
		$img_e = time().str_replace(" ", "", $_FILES['gambar_e']['name']);
		$file_tmp_e =$_FILES['gambar_e']['tmp_name'];
		move_uploaded_file($file_tmp_e, '../assets/img/'.$img_e);
	}

	$soal = $_POST['soal'];
	$pilihan_a = $_POST['pilihan_a'];
	$pilihan_b = $_POST['pilihan_b'];
	$pilihan_c = $_POST['pilihan_c'];
	$pilihan_d = $_POST['pilihan_d'];
	$pilihan_e = $_POST['pilihan_e'];
	$kunci = $_POST['kunci'];
	// edit soal
	mysqli_query($koneksi, "UPDATE soal SET soal='$soal',pilihan_a='$pilihan_a',pilihan_b='$pilihan_b',pilihan_c='$pilihan_c',pilihan_d='$pilihan_d',pilihan_e='$pilihan_e',gambar_soal='$img_soal',gambar_a='$img_a',gambar_b='$img_b',gambar_c='$img_c',gambar_d='$img_d',gambar_e='$img_e',kunci='$kunci' WHERE id_soal='$id_soal' ");

	// cek apakah sudah ada siswa yg SELESAI mengerjakan ujian ini
	$cek_nilai = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_ujian='$id_ujian' ");
	if(mysqli_num_rows($cek_nilai) > 0){
		 // jika ada maka semua data dengan id_ujian='$id_ujian' akan dihapus dari tabel nilai
		mysqli_query($koneksi, "DELETE FROM nilai WHERE id_ujian='$id_ujian' ");
	}
	header("location:daftar-soal.php?id=$id_ujian&pesan=edit");
}

?>
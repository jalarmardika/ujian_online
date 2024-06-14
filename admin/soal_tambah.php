<?php
if (isset($_POST['submit'])) {
	include '../koneksi.php';
	$id_ujian = $_POST['id_ujian'];
	// gambar soal
	if ($_FILES['gambar_soal']['name'] == "") {
		$img_soal = "";
	} else {
		$img_soal = time().str_replace(" ", "", $_FILES['gambar_soal']['name']);
		$file_tmp_soal =$_FILES['gambar_soal']['tmp_name'];
		move_uploaded_file($file_tmp_soal, '../assets/img/'.$img_soal);
	}
	//gambar a
	if ($_FILES['gambar_a']['name'] == "") {
		$img_a = "";
	} else {
		$img_a = time().str_replace(" ", "", $_FILES['gambar_a']['name']);
		$file_tmp_a =$_FILES['gambar_a']['tmp_name'];
		move_uploaded_file($file_tmp_a, '../assets/img/'.$img_a);
	}
	//gambar b
	if ($_FILES['gambar_b']['name'] == "") {
		$img_b = "";
	} else {
		$img_b = time().str_replace(" ", "", $_FILES['gambar_b']['name']);
		$file_tmp_b =$_FILES['gambar_b']['tmp_name'];
		move_uploaded_file($file_tmp_b, '../assets/img/'.$img_b);
	}
	//gambar c
	if ($_FILES['gambar_c']['name'] == "") {
		$img_c = "";
	} else {
		$img_c = time().str_replace(" ", "", $_FILES['gambar_c']['name']);
		$file_tmp_c =$_FILES['gambar_c']['tmp_name'];
		move_uploaded_file($file_tmp_c, '../assets/img/'.$img_c);
	}
	//gambar d
	if ($_FILES['gambar_d']['name'] == "") {
		$img_d = "";
	} else {
		$img_d = time().str_replace(" ", "", $_FILES['gambar_d']['name']);
		$file_tmp_d =$_FILES['gambar_d']['tmp_name'];
		move_uploaded_file($file_tmp_d, '../assets/img/'.$img_d);
	}
	//gambar e
	if ($_FILES['gambar_e']['name'] == "") {
		$img_e = "";
	} else {
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
	// tambah soal
	mysqli_query($koneksi,"INSERT INTO soal(id_ujian,soal,gambar_soal,pilihan_a,pilihan_b,pilihan_c,pilihan_d,pilihan_e,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,kunci) VALUES('$id_ujian','$soal','$img_soal','$pilihan_a','$pilihan_b','$pilihan_c','$pilihan_d','$pilihan_e','$img_a','$img_b','$img_c','$img_d','$img_e','$kunci')");
	// jumlah soal di tabel ujian ditambah 1	
	$query = mysqli_query($koneksi,"SELECT * FROM ujian WHERE id_ujian='$id_ujian'");
	$array = mysqli_fetch_array($query);
	$jml_soal = $array['jml_soal'];
	$update = $jml_soal + 1;
	mysqli_query($koneksi,"UPDATE ujian SET jml_soal='$update' WHERE id_ujian='$id_ujian'");
	// cek apakah sudah ada siswa yg SELESAI mengerjakan ujian ini
	$cek_nilai = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_ujian='$id_ujian' ");
	if(mysqli_num_rows($cek_nilai) > 0){
		 // jika ada maka semua data dengan id_ujian='$id_ujian' akan dihapus dari tabel nilai
		mysqli_query($koneksi, "DELETE FROM nilai WHERE id_ujian='$id_ujian' ");
	}
	header("location:input_soal.php?id=$id_ujian&pesan=berhasil");
}
	
?>
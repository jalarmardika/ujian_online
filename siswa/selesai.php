<?php 
include '../koneksi.php';

$id = $_POST['id'];
$id_ujian = $_POST['id_ujian'];
$nis = $_POST['nis'];
$pilihan = $_POST['pilihan'];
$benar = 0;
$salah = 0;
$kosong = 0;
$nilai = 0;
date_default_timezone_set('Asia/Jakarta');
$tgl = date('Y-m-d H:i:s');

for ($i=0; $i < count($_POST['id']); $i++) { 

	$nomor = $id[$i];

	if (empty($pilihan[$nomor])) {
		$kosong++;
	} else {

		$jawaban = $pilihan[$nomor];
		$koreksi = mysqli_query($koneksi,"SELECT * FROM soal WHERE id_soal='$nomor' and kunci='$jawaban'");
		$jml = mysqli_num_rows($koreksi);

		if ($jml) {
			$benar++;
		} else {
			$salah++;
		}

	}

	$hitung = mysqli_query($koneksi,"SELECT * FROM soal WHERE id_ujian='$id_ujian'");
	$jml_soal = mysqli_num_rows($hitung);
	$nilai = 100 / $jml_soal * $benar;
	$predikat = '';

	if ($nilai>= 90) {
		$predikat='A';
	} elseif ($nilai>= 80) {
		$predikat='B';
	}elseif ($nilai>= 70) {
		$predikat='C';
	}elseif ($nilai>= 60) {
		$predikat='D';
	}else {
		$predikat='E';
	}
	

}
// delete siswa dari tabel pengerjaan karena sudah menyelesaikan ujian
mysqli_query($koneksi,"DELETE FROM pengerjaan WHERE nis='$nis' and id_ujian='$id_ujian'");

mysqli_query($koneksi,"INSERT INTO nilai Values('','$tgl','$nis','$id_ujian','$benar','$salah','$kosong','$nilai','$predikat')");
header("Location:nilai.php?id=$id_ujian&pesan=selesai");

?>

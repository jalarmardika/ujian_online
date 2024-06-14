<?php 
if (isset($_POST['submit'])) {
	include '../koneksi.php';
	$id_ujian = $_POST['id'];
	$ujian = mysqli_query($koneksi, "SELECT * FROM ujian,kelas,mapel WHERE ujian.id_kelas=kelas.id_kelas and ujian.id_mapel=mapel.id_mapel and id_ujian='$id_ujian' ");
	$data_ujian = mysqli_fetch_assoc($ujian);
	// convert file kebentuk excel
	header("Content-Type:application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Nilai ".$data_ujian['mata_pelajaran']." kelas ".$data_ujian['nama_kelas'].".xls");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Export Nilai</title>
	<style type="text/css">
		p{
			margin-top: -10px;
		}
	</style>
</head>
<body>
	<h3>Data Nilai <?php echo $data_ujian['jenis_ujian']; ?></h3>
	<p>Mata Pelajaran : <?= $data_ujian['mata_pelajaran']; ?></p>
	<p>Kelas : <?= $data_ujian['nama_kelas']; ?></p>
	<table width="100%" border="1" cellspacing="1" cellpadding="5">
		<thead>
			<tr>
				<th align="center">No</th>
	            <th align="left">NIS</th>
	            <th align="left">Nama Siswa</th>
	            <th align="center">Benar</th>
	            <th align="center">Salah</th>
	            <th align="center">Kosong</th>
	            <th align="center">Nilai</th>
	            <th align="center">Predikat</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			$nilai = mysqli_query($koneksi,"SELECT * FROM nilai,siswa WHERE id_ujian='$id_ujian' and nilai.nis=siswa.nis ORDER BY nilai.nis ASC");
			while ($d = mysqli_fetch_assoc($nilai)) { ?>
			<tr>
				<td align="center"><?php echo $no++; ?></td>
				<td align="left"><?php echo $d['nis']; ?></td>
				<td align="left"><?php echo $d['nama']; ?></td>
				<td align="center"><?php echo $d['benar']; ?></td>
				<td align="center"><?php echo $d['salah']; ?></td>
				<td align="center"><?php echo $d['kosong']; ?></td>
				<td align="center"><?php echo $d['nilai']; ?></td>
				<td align="center"><?php echo $d['predikat']; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</body>
</html>
<?php } ?>
<?php 
if (isset($_GET['id'])) {
	include 'header.php';
	$id = $_GET['id'];
	?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<div class="container">

			<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<?php
						if(isset($_GET['pesan'])){
							if($_GET['pesan']=="selesai"){ ?>
								<div class="alert alert-success no-print"> 
									<button type="button" class="close pull-right text-white" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									Anda Berhasil Mengerjakan Ujian ini
								</div>
							<?php } } ?>

							<div class="box box-solid">
								<div class="box-body">
									<?php 
									$siswa = mysqli_query($koneksi, "SELECT * FROM siswa JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE nis='$nis' ");
									$nilai = mysqli_query($koneksi,"SELECT * FROM nilai,ujian,mapel,kelas WHERE ujian.id_mapel=mapel.id_mapel and ujian.id_kelas=kelas.id_kelas and nilai.id_ujian=ujian.id_ujian and nilai.id_ujian='$id' and nilai.nis='$nis'");
									if (mysqli_num_rows($nilai) > 0) {
										$data = mysqli_fetch_assoc($siswa);
										$d = mysqli_fetch_assoc($nilai);
										?>
										<h5 class="mb-4">Hasil Ujian <?= $d['jenis_ujian']; ?></h5>
										<table class="table mb-4">
											<tr>
												<td>NIS</td>
												<td>:</td>
												<td><?= $data['nis']; ?></td>
											</tr>
											<tr>
												<td>Nama Siswa</td>
												<td>:</td>
												<td><?= $data['nama']; ?></td>
											</tr>
											<tr>
												<td>Kelas Saat Ini</td>
												<td>:</td>
												<td><?= $data['nama_kelas']; ?></td>
											</tr>
											<tr>
												<td>Mata Pelajaran</td>
												<td>:</td>
												<td><?= $d['mata_pelajaran']; ?></td>
											</tr>
											<tr>
												<td>Kelas</td>
												<td>:</td>
												<td><?= $d['nama_kelas']; ?></td>
											</tr>
											<tr>
												<td>Dibuat Pada</td>
												<td>:</td>
												<td><?= date('d-m-Y H:i:s', strtotime($d['tgl_dibuat'])); ?></td>
											</tr>
											<tr>
												<td>Selesai Dikerjakan Pada</td>
												<td>:</td>
												<td><?= date('d-m-Y H:i:s', strtotime($d['tgl_selesai'])); ?></td>
											</tr>
											<tr>
												<td>Jumlah Soal</td>
												<td>:</td>
												<td><?= $d['jml_soal']; ?></td>
											</tr>
											<tr>
												<td>Waktu</td>
												<td>:</td>
												<td><?= $d['waktu']; ?> menit</td>
											</tr>
											<tr>
												<td>Benar</td>
												<td>:</td>
												<td><?= $d['benar']; ?></td>
											</tr>
											<tr>
												<td>Salah</td>
												<td>:</td>
												<td><?= $d['salah']; ?></td>
											</tr>
											<tr>
												<td>Kosong</td>
												<td>:</td>
												<td><?= $d['kosong']; ?></td>
											</tr>
											<tr>
												<td>Predikat</td>
												<td>:</td>
												<td><?= $d['predikat']; ?></td>
											</tr>
											<tr>
												<td>Nilai</td>
												<td>:</td>
												<td><?= $d['nilai']; ?></td>
											</tr>
										</table>
										<div class="row no-print">
											<div class="col-xs-12">
												<button type="button" class="btn btn-default pull-right" onclick="window.print()" style="margin-right: 5px;"><i class="fa fa-print"></i> Cetak</button>
											</div>
										</div>
									<?php }else{ ?>
										<p class="text-center">Data tidak ditemukan</p>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="col-md-2"></div>
					</div>
					<!-- /.row -->
				</section>
			</div>
			<!-- /.content -->
		</div>


		<!-- /.content-wrapper -->
		<?php
		include 'footer.php'; 
	}
	?>
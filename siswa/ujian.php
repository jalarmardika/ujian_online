<?php include 'header.php';?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="container">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1 class="mt-3">
				Daftar Ujian

			</h1>
			<ol class="breadcrumb mt-3">
				<li><a href="index.php">Beranda</a></li>
				<li class="active">Daftar Ujian</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<?php
			if(isset($_GET['pesan'])){
				if($_GET['pesan']=="reset"){ ?>
					<div class="alert alert-danger fade in"> 
						<button type="button" class="close pull-right text-white" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						Ujian Di Nonaktifkan Oleh Petugas
					</div>
				<?php }elseif($_GET['pesan']=="gagal"){ ?>
					<div class="alert alert-danger fade in"> 
						<button type="button" class="close pull-right text-white" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						Gagal Mengerjakan Ujian
					</div>
				<?php } } ?>
				<div class="row">
					<div class="col-md-12">
						<div class="search-box">
							<form action="" method="get" class="form-inline " id="search-form">
								<div class="search-input">
									<input type="text" name="keyword" class="input" placeholder="Telusuri..." autocomplete="off">
								</div>
								<i class="fa fa-search"></i>
							</form>
						</div>
					</div>
					<?php
					$jumlahDataPerHalaman = 6;
					$halamanAktif = (isset($_GET['page']) ? $_GET['page'] : 1);

	      			$id_kelas = $array['id_kelas']; // id_kelas siswa yg sedang login

	      			if (isset($_GET['keyword'])) {
	      				$keyword = $_GET['keyword'];

	      				$jumlahUjian = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM ujian JOIN mapel ON ujian.id_mapel=mapel.id_mapel JOIN kelas ON ujian.id_kelas=kelas.id_kelas WHERE status=1 AND (jenis_ujian LIKE '%".$keyword."%' OR mapel.mata_pelajaran LIKE '%".$keyword."%' OR kelas.nama_kelas LIKE '%".$keyword."%') "));
	      				$jumlahHalaman = ceil($jumlahUjian / $jumlahDataPerHalaman);
	      				$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

	      				$ujian = mysqli_query($koneksi,"SELECT * FROM ujian JOIN mapel ON ujian.id_mapel=mapel.id_mapel JOIN kelas ON ujian.id_kelas=kelas.id_kelas WHERE status=1 AND (jenis_ujian LIKE '%".$keyword."%' OR mapel.mata_pelajaran LIKE '%".$keyword."%' OR kelas.nama_kelas LIKE '%".$keyword."%') ORDER BY ujian.id_ujian DESC LIMIT $awalData, $jumlahDataPerHalaman");
	      			}else{


	      				$jumlahUjian = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM ujian WHERE status=1"));
	      				$jumlahHalaman = ceil($jumlahUjian / $jumlahDataPerHalaman);
	      				$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

	      				$ujian = mysqli_query($koneksi,"SELECT * FROM ujian JOIN mapel ON ujian.id_mapel=mapel.id_mapel JOIN kelas ON ujian.id_kelas=kelas.id_kelas WHERE status=1 ORDER BY id_ujian DESC LIMIT $awalData, $jumlahDataPerHalaman");
	      			}

	      			if (mysqli_num_rows($ujian) > 0) { 
	      				while ($d = mysqli_fetch_assoc($ujian)) { 
	      					?>
	      					<div class="col-md-4">
	      						<div class="box box-solid">
	      							<div class="box-body">

	      								<h5 class="text-center mb-4"><?= $d['jenis_ujian']; ?></h5>
	      								<p class="text-center"><?= $d['mata_pelajaran']; ?></p>
	      								<ul class="list-group list-group-unbordered">
	      									<li class="list-group-item">
	      										Dibuat Pada : <?= date('d-m-Y H:i:s', strtotime($d['tgl_dibuat'])); ?>
	      									</li>
	      									<li class="list-group-item">
	      										Kelas : <?= $d['nama_kelas']; ?>
	      									</li>
	      									<li class="list-group-item">
	      										Jumlah Soal : <?= $d['jml_soal']; ?>
	      									</li>
	      									<li class="list-group-item">
	      										Waktu : <?= $d['waktu']; ?> menit
	      									</li>
	      								</ul>
	      								<?php
			      						// cek di tabel nilai apakah siswa sudah mengerjakan ujian
	      								$cek_ujian = mysqli_query($koneksi,"SELECT * FROM nilai WHERE id_ujian='$d[id_ujian]' and nis='$nis'");

	      								if (mysqli_num_rows($cek_ujian) < 1) { 
			      						// jika siswa belum mengerjakan ujian
	      									if ($id_kelas == $d['id_kelas']) {
			      							// jika id_kelas siswa yg sedang login sama dengan id_kelas data ujian, maka siswa dapat mengerjakan ujian
	      										?>
	      										<form action="ujianStart.php" method="post" onsubmit="return confirm('Apakah anda yakin ingin mengerjakan ujian ini ?')">
	      											<input type="hidden" name="id" value="<?php echo $d['id_ujian']; ?>">
	      											<input type="hidden" name="waktu" value="<?php echo $d['waktu']; ?>">
	      											<button type="submit" name="submit" class="btn btn-success btn-sm btn-block"><i class="fa fa-clock-o"></i> Mulai Kerjakan</button>
	      										</form>

	      									<?php }else{ 
	      										// tampilkan link disabled
	      										?>
	      										<a href="#" disabled class="btn btn-success btn-sm btn-block"><i class="fa fa-clock-o"></i> Mulai Kerjakan</a>
	      									<?php }

	      								}else{
			      							// jika siswa sudah selesai mengerjakan ujian 
	      									?>
	      									<a href="nilai.php?id=<?php echo $d['id_ujian']; ?>" class="btn btn-primary btn-sm btn-block"><i class="fa fa-eye"></i> Lihat Hasil Ujian</a>

	      								<?php } ?>
	      							</div>
	      						</div>
	      					</div>
	      				<?php } 

	      			}else{ ?>
	      				<div class="col-md-12">
	      					<p class="text-center">Tidak Ada Data</p>
	      				</div>
	      			<?php } ?>
	      		</div><!-- /.row -->

	      		<?php if (mysqli_num_rows($ujian) > 0) {  ?>
	      			<center>
	      				<nav class="pb-5">
	      					<ul class="pagination">
	      						<li class="page-item">
	      							<a href="?page=1<?php if (isset($_GET['keyword'])) { echo "&keyword=". $_GET['keyword']; } ?>" class="page-link">First</a>
	      						</li>
	      						<?php 
	      						if ($halamanAktif > 1) { ?>
	      							<li class="page-item">
	      								<a href="?page=<?php echo $halamanAktif - 1; if (isset($_GET['keyword'])) { echo "&keyword=". $_GET['keyword']; } ?>" class="page-link">&laquo;</a>
	      							</li>
	      						<?php } ?>

	      						<?php 
				      			$jumlah_link = 2; // tentukan jumlah link sesudah dan sebelum halaman aktif
				      			$awal_nomor = ($halamanAktif > $jumlah_link) ? $halamanAktif - $jumlah_link: 1;
				      			$akhir_nomor = ($halamanAktif < ($jumlahHalaman - $jumlah_link)) ? $halamanAktif + $jumlah_link: $jumlahHalaman;

				      			if ($halamanAktif - $jumlah_link > 1) { ?>
				      				<li class="page-item disabled">
				      					<a href="#" class="page-link">...</a>
				      				</li>
				      			<?php } 

				      			for ($i=$awal_nomor; $i <= $akhir_nomor; $i++) {
				      				if ($halamanAktif == $i) { ?>
				      					<li class="page-item active">
				      						<a href="?page=<?php echo $i; if (isset($_GET['keyword'])) { echo "&keyword=". $_GET['keyword']; } ?>" class="page-link"><?= $i; ?></a>
				      					</li>
				      				<?php } else{ ?>
				      					<li class="page-item">
				      						<a href="?page=<?php echo $i; if (isset($_GET['keyword'])) { echo "&keyword=". $_GET['keyword']; } ?>" class="page-link"><?= $i; ?></a>
				      					</li>
				      				<?php }
				      			}

				      			if ($halamanAktif + $jumlah_link < $jumlahHalaman) { ?>
				      				<li class="page-item disabled">
				      					<a href="#" class="page-link">...</a>
				      				</li>
				      			<?php } 

				      			if ($halamanAktif < $jumlahHalaman) { ?>
				      				<li class="page-item">
				      					<a href="?page=<?php echo $halamanAktif + 1; if (isset($_GET['keyword'])) { echo "&keyword=". $_GET['keyword']; } ?>" class="page-link">&raquo;</a>
				      				</li>
				      			<?php } ?>
				      			<li class="page-item">
				      				<a href="?page=<?php echo $jumlahHalaman; if (isset($_GET['keyword'])) { echo "&keyword=". $_GET['keyword']; } ?>" class="page-link">Last</a>
				      			</li>
				      		</ul>
				      	</nav>
				      </center>
				  <?php } ?>
				</section>
			</div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<script type="text/javascript">
			$(document).ready(function(){
				$('input[name=keyword]').on('keyup', function(e){
					if (e.keyCode == 13) {
						$('#search-form').submit();
					}
				})

				$('#search-form .fa-search').on('click', function(){
					$('#search-form').submit();
				})
			})
		</script>
		<?php include 'footer.php'; ?>

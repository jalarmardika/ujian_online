<?php
if (isset($_POST['submit'])) {
	session_start();
	include '../koneksi.php';
	$id = $_POST['id'];
	$nis = $_SESSION['nis'];
	
	$waktu = $_POST['waktu'];
	$waktu *= 60;
	date_default_timezone_set('Asia/Jakarta');
	$mulai = date('H:i:s');
	$time = time();
	$waktu += $time;
	$selesai = date('H:i:s', $waktu);
	$tgl = date('Y-m-d');
	$no_pengerjaan = rand();

	$simpan_pengerjaan = mysqli_query($koneksi,"INSERT INTO pengerjaan VALUES('$no_pengerjaan','$tgl','$nis','$id','$mulai','$selesai')");
	if (!$simpan_pengerjaan) {
		// jika gagal melakukan penyimpanan ke tabel pengerjaan
		header("location:ujian.php?pesan=gagal");
	}else{
		$pengerjaan = mysqli_query($koneksi,"SELECT * FROM pengerjaan WHERE id_ujian='$id' and nis='$nis'");
		$row = mysqli_fetch_assoc($pengerjaan);
		$lama       = time();
		$sekarang   = date('H:i:s',$lama);
		$awal       = strtotime($sekarang);
		$mulai      = strtotime($row['mulai']);
		
		$mulailah   = $awal - $mulai;
		$akhir      = strtotime($row['selesai']);
		$awalah     = $awal + $mulailah;
		$akhirlah   = $akhir + $mulailah;
		$sisa       = $akhirlah - $awalah;
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title>Mengerjakan Ujian | Ujian Online</title>
			<!-- Tell the browser to be responsive to screen width -->
			<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			<link rel="stylesheet" href="../assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
			<link rel="stylesheet" href="../assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
			<link rel="stylesheet" href="../assets/adminlte/dist/css/AdminLTE.min.css">
			<link rel="stylesheet" href="../assets/adminlte/dist/css/skins/_all-skins.css">
			<link rel="stylesheet" href="../assets/css/bootstrap.css">
			<script src="../assets/js/jquery.js"></script>
			<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
			<script>
				let count = '<?php echo $sisa; ?>';
				// hitungan mundur
				setInterval(timer, 1000);

				function timer() {
					count -= 1;
					if (count == 0) {
				       // submit otomatis form ketika waktu ujian habis
				       submitForm();
				   }else{
					   	let seconds = count % 60;
					   	let minutes = Math.floor(count / 60);
					   	let hours = Math.floor(minutes / 60);
					   	minutes %= 60;
					   	hours %= 60;

					   	document.getElementById("divwaktu").innerHTML = hours + " : " + minutes + " : " + seconds;

					    // cek status siswa dan ujian apakah 1 atau 0 setiap 1 detik
					    let nis = <?php echo $nis; ?>;
					    let id_ujian = <?php echo $id; ?>;
					    $.ajax({
					    	type: 'post',
					    	url: 'cek.php',
					    	data: {
					    		nis: nis,
					    		id_ujian: id_ujian
					    	},
					    	dataType: 'json',
					    	success: function(response) {

					    		if (response.status_siswa == 0) {
					          	// jika status siswa 0 (nonaktif) maka dialihkan ke halaman reset_siswa.php dengan pesan reset_siswa
					          	window.location.href="reset_siswa.php?pesan=reset_siswa&nis=" + nis;
					          }else if(response.status_ujian == 0){
					          	// jika status ujian 0 (nonaktif) maka dialihkan ke halaman reset_ujian.php dengan pesan reset_ujian
					          	window.location.href="reset_ujian.php?pesan=reset_ujian&nis=" + nis;
					          }
					      },
					      error: function(xhr, thrownError){
					      	alert(xhr,status + "\n" + xhr,responseText + "\n" + thrownError);
					      }
					  });
					}
				}

				function submitForm(){
					document.getElementById("myForm").submit();
				}
			</script>
		</head>
		<body class="hold-transition skin-yellow layout-top-nav">
			<header class="main-header mb-5">
				<nav class="navbar navbar-static-top">
					<div class="container">
						<div class="navbar-header">
							<a href="#" class="navbar-brand"><b>Ujian</b> Online</a>
						</div>
					</div>
					<!-- /.container -->
				</nav>
			</header>
			<div class="container">	
				<div class="row mb-4">
					<div class="col-md-12">
						<div class="box box-warning shadow-lg word-wrap">
							<div class="box-body">
								<div class="row no-gutters" style="margin: auto;">
									<div class="col-md-4 col-sm-4 col-xs-5">
										<div class="divs-number">
											<?php
											$soal_ujian = mysqli_query($koneksi,"SELECT * FROM soal WHERE id_ujian='$id'");
											$nomor = 0;
											while (mysqli_fetch_assoc($soal_ujian)) {
												$nomor++;
												?>
												<div class="nomornya" style="margin-top: 5px;">
													<h4 style="display: inline;"><b>Soal Nomor </b></h4> <a href="#" id="no_soal" class="btn btn-primary btn-sm"><?=$nomor?></a>
												</div>
											<?php } ?>

										</div>
									</div>
									<div class="col-md-4 col-sm-3">

									</div>
									<div class="col-md-4 col-sm-5 col-xs-7">
										<div class="btn-group float-right" role="group" aria-label="Basic example" style="border-radius: 2rem;margin-top: 5px;">

											<button type="button" class="btn btn-danger text-white" id="divwaktu" style="border: none;"></button>
										</div>
									</div>
								</div>
								<div class="row" style="margin: auto;margin-top: 10px;">
									<div class="col-md-6 col-sm-6 col-xs-8">
										<div style="margin-top: 5px;">
											<div class="btn-group" role="group" aria-label="Basic example">
												<button type="button" class="btn btn-default"><b>Ukuran Font : </b></button>
												<button id="fontMin" type="button" class="sm btn btn-default">A</button>  
												<button id="fontNormal" type="button" class="md btn btn-default">A</button>  
												<button id="fontMax" type="button" class="lg btn btn-default">A</button>  
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-4">
										<a href="#" class="btn btn-warning text-white btn-md float-right" data-toggle="modal" data-target="#mymodal" style=" border-radius: 2rem;margin-top: 5px;"><i class="fa fa-th"></i> Daftar Soal</a>
									</div>
								</div>
								<div class="col-md-12">
									<form action="selesai.php" id="myForm" method="post">
										<div id="border" class="divs" style="padding: 30px;">
											<?php
											$soal = mysqli_query($koneksi,"SELECT * FROM soal WHERE id_ujian='$id'");
											$jml = mysqli_num_rows($soal);
											$no = 0;
											while ($array = mysqli_fetch_assoc($soal)) {
												$no++;
												?>
												<div class="soalnya">
													<input type="hidden" name="id_ujian" value="<?=$id;?>">
													<input type="hidden" name="id[]" value="<?=$array['id_soal'];?>">
													<input type="hidden" name="jml" id="jml" value="<?=$jml;?>">
													<input type="hidden" name="nis" value="<?=$nis;?>">
													<tr>

														<td>&emsp;<h4 class="font" style="display: inline;"><?=$array['soal']?></h4></td><br>
													</tr><br>
													<?php
													if (!empty($array['gambar_soal'])) {
														echo "<tr><td></td><td>&emsp;<img src='../assets/img/$array[gambar_soal]' align=center style='max-width:300px;height:auto' ></td></tr><br><br>";
													}
													?>

													<tr>
														<td>
															<label class="custom-radio-button">
																<input type="radio" name="pilihan[<?=$array['id_soal'];?>]" class="number<?php echo $no; ?>" value="A"/> 
																<span class="helping-el"></span>
																<span class="label-text">A</span>
																<h4 id="cho" class="ml-5 font" style="display: inline-block;"><?=$array['pilihan_a']?></h4>
															</label></td><br>
														</tr><br>
														<?php
														if (!empty($array['gambar_a'])) {
															echo "<tr><td></td><td>&emsp;&emsp;&emsp;&emsp;<img src='../assets/img/$array[gambar_a]' align=center style='max-width:150px;height:auto' ></td></tr><br><br>";
														}
														?>

														<tr>
															<td><label class="custom-radio-button">
																<input type="radio" name="pilihan[<?=$array['id_soal'];?>]" class="number<?php echo $no; ?>" value="B"/> 
																<span class="helping-el"></span>
																<span class="label-text">B</span>
																<h4 id="cho" class="ml-5 font" style="display: inline-block;"><?=$array['pilihan_b']?></h4>
															</label></td><br>
														</tr><br>
														<?php
														if (!empty($array['gambar_b'])) {
															echo "<tr><td></td><td>&emsp;&emsp;&emsp;&emsp;<img src='../assets/img/$array[gambar_b]' align=center style='max-width:150px;height:auto' ></td></tr><br><br>";
														}
														?>

														<tr>
															<td><label class="custom-radio-button">
																<input type="radio" name="pilihan[<?=$array['id_soal'];?>]" class="number<?php echo $no; ?>" value="C"/> 
																<span class="helping-el"></span>
																<span class="label-text">C</span>
																<h4 id="cho" class="ml-5 font" style="display: inline-block;"><?=$array['pilihan_c']?></h4>
															</label></td><br>
														</tr><br>
														<?php
														if (!empty($array['gambar_c'])) {
															echo "<tr><td></td><td>&emsp;&emsp;&emsp;&emsp;<img src='../assets/img/$array[gambar_c]' align=center style='max-width:150px;height:auto' ></td></tr><br><br>";
														}
														?>

														<tr>
															<td><label class="custom-radio-button">
																<input type="radio" name="pilihan[<?=$array['id_soal'];?>]" class="number<?php echo $no; ?>" value="D"/> 
																<span class="helping-el"></span>
																<span class="label-text">D</span>
																<h4 id="cho" class="ml-5 font" style="display: inline-block;"><?=$array['pilihan_d']?></h4>
															</label></td><br>
														</tr><br>
														<?php
														if (!empty($array['gambar_d'])) {
															echo "<tr><td></td><td>&emsp;&emsp;&emsp;&emsp;<img src='../assets/img/$array[gambar_d]' align=center style='max-width:150px;height:auto' ></td></tr><br><br>";
														}
														?>

														<tr>
															<td><label class="custom-radio-button">
																<input type="radio" name="pilihan[<?=$array['id_soal'];?>]" class="number<?php echo $no; ?>" value="E"/> 
																<span class="helping-el"></span>
																<span class="label-text">E</span>
																<h4 id="cho" class="ml-5 font" style="display: inline-block;"><?=$array['pilihan_e']?></h4>
															</label></td><br>                     
														</tr><br>
														<?php
														if (!empty($array['gambar_e'])) {
															echo "<tr><td></td><td>&emsp;&emsp;&emsp;&emsp;<img src='../assets/img/$array[gambar_e]' align=center style='max-width:150px;height:auto' ></td></tr><br><br>";
														}
														?>
														<br>

													</div>
												<?php } ?>

											</div>
											<div class="row mb-4">
												<div class="col-md-5 col-sm-5 col-xs-4">
													<a id="prev" class="btn btn-md btn-danger disabled" style=" border-radius: 2rem;"><i class="fa fa-chevron-left"></i> Soal Sebelumnya</a>
												</div>

												<div class="col-md-2 col-sm-2 col-xs-4">
													<button type="submit" name="tombolSelesai" class="btn btn-md btn-success ml-6" style=" border-radius: 2rem;"><i class="fa fa-check"></i> Selesai</button>
												</div>

												<div class="col-md-5 col-sm-5 col-xs-4">
													<a id="next"  class="btn btn-md btn-warning float-right" style=" border-radius: 2rem;">Soal Selanjutnya <i class="fa fa-chevron-right"></i></a>
												</div>
											</div>

										</form>
										<div class="modal" tabindex="-1" id="mymodal">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<b>Daftar Soal</b>
														<button type="button"  class="close" data-dismiss="modal" >&times;</button>
													</div>
													<div class="modal-body">
														<div id="pagin"></div>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
				<footer class="main-footer">
				    <div class="container">
				      <div class="pull-right hidden-xs">
				        <b>Version</b> 2.4.18
				      </div>
				      <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
				      reserved.
				    </div>
				    <!-- /.container -->
			    </footer>
			    
				<script type="text/javascript">
					<?php
					$query = mysqli_query($koneksi,"SELECT * FROM soal WHERE id_ujian='$id'");
					$j = 0;
					?>
					<?php while (mysqli_fetch_assoc($query)) {
						$j++;
						?>
						let radio<?php echo $j; ?> = document.querySelectorAll('.number<?php echo $j; ?>');

						for (let m<?php echo $j; ?> = 0; m<?php echo $j; ?> < radio<?php echo $j; ?>.length; m<?php echo $j; ?>++) {
							radio<?php echo $j; ?>[m<?php echo $j; ?>].addEventListener('change', function(){
								$('#navsoal<?php echo $j; ?>').removeClass('btn-default');
								$('#navsoal<?php echo $j; ?>').addClass('btn-primary');
							});
						}

					<?php } ?>
				</script>
				<script type="text/javascript">
					$(document).ready(function(){
						$(".divs-number > div").each(function(i) {
							if (i != 0)
								$(this).hide();
						});

						$(".divs > div").each(function(e) {
							if (e != 0)
								$(this).hide();
						});

						$("#next").click(function(){
							if ($(".divs div:visible").next().length != 0){
								$(".divs div:visible")
								.next()
								.show()
								.prev()
								.hide();
								$(".divs-number div:visible")
								.next()
								.show()
								.prev()
								.hide();

								$('#prev').removeClass('disabled');

								if ($(".divs div:visible").next().length == 0){

									$('#next').addClass('disabled');

								}

							}
							return false;
						});

						$("#prev").click(function(){
							if ($(".divs div:visible").prev().length != 0){
								console.log("There are still elements");
								$(".divs div:visible")
								.prev()
								.show()
								.next()
								.hide();
								$(".divs-number div:visible")
								.prev()
								.show()
								.next()
								.hide();

								$('#next').removeClass('disabled');

								if ($(".divs div:visible").prev().length == 0){

									$('#prev').addClass('disabled');

								}	

							}

							return false;
						});
					});

					let pageCount =  $(".soalnya").length / 1;

					for(let i = 0 ; i<pageCount;i++){

						$("#pagin").append('<a id="navsoal'+(i+1)+'" href="#" class="btn btn-default btn-sm " style="margin: 6px;">'+(i+1)+'</a>');

					}

					showPage = function(page) {

						$(".soalnya").hide();
						$(".soalnya").each(function(n) {
							if (n >= 1 * (page - 1) && n < 1 * page){
								$(this).show();
							}

						});   

					}

					showNumber = function(number) {

						$(".nomornya").hide();
						$(".nomornya").each(function(m) {
							if (m >= 1 * (number - 1) && m < 1 * number){
								$(this).show();
							}
						});        
					}
					showNumber(1);
					showPage(1);

					$("#pagin a").click(function() {
						showPage(parseInt($(this).text())) 
						showNumber(parseInt($(this).text())) 
						$('#mymodal').modal('hide');

						let jml_soal = $(".soalnya").length;
						if ($(this).text() == 1){
							$('#prev').addClass('disabled');
							$('#next').removeClass('disabled');
						}else if ($(this).text() == jml_soal){
							$('#prev').removeClass('disabled');
							$('#next').addClass('disabled');
						}else{
							$('#prev').removeClass('disabled');
							$('#next').removeClass('disabled');
						}

					});
					let font = $('.font');

					$("#fontMin").on('click', function () {
						font.removeClass('normal');
						font.removeClass('max');
						font.addClass('min');
					});
					$("#fontNormal").on('click', function () {
						font.removeClass('min');
						font.removeClass('max');
						font.addClass('normal');
					});
					$("#fontMax").on('click', function () {
						font.removeClass('min');
						font.removeClass('normal');
						font.addClass('max');
					});
				</script>
				<script src="../assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
				<script src="../assets/adminlte/dist/js/adminlte.min.js"></script>
				<script src="../assets/adminlte/dist/js/demo.js"></script>
			</body>
			</html>
			<?php 
		}
	} 
	?>
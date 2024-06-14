<?php 
session_start();
if (isset($_SESSION['status'])) {
	if ($_SESSION['status'] == "Admin") {
		header("location:admin/index.php?pesan=sudahLogin");
	}elseif ($_SESSION['status'] == "Petugas") {
		header("location:petugas/index.php?pesan=sudahLogin");
	}elseif ($_SESSION['status'] == "Siswa") {
		header("location:siswa/index.php?pesan=sudahLogin");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login | Ujan Online</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/adminlte/dist/css/AdminLTE.min.css">

</head>
<body class="hold-transition login-page">
	  <div class="login-box">
	    <div class="login-logo">
	      <a href="index2.html"><b>Login</b> Ujan Online</a>
	    </div>
	    <?php
	    if(isset($_GET['pesan'])){
	      if($_GET['pesan']=="gagal"){ ?>
	      <div class="alert alert-danger"> 
	        Email & Password Tidak Sesuai
	      </div>
	      <?php }elseif($_GET['pesan']=="belumLogin"){ ?>
	      <div class="alert alert-warning"> 
	        Anda Harus Login Terlebih Dahulu
	      </div>
	      <?php }elseif($_GET['pesan']=="reset"){ ?>
	      <div class="alert alert-warning"> 
	        Anda Telah Direset Oleh Petugas
	      </div>
	      <?php }elseif($_GET['pesan']=="nonaktif"){ ?>
	      <div class="alert alert-warning"> 
	        Anda Tidak Dapat Login Karena Telah Direset Oleh Petugas Sebelumnya
	      </div>
	      <?php }elseif($_GET['pesan']=="logout"){ ?>
	      <div class="alert alert-success"> 
	        Anda Berhasil Logout
	      </div>
	      <?php } } ?>
	    <div class="login-box-body">
	      <p class="login-box-msg">Silakan Masukkan Email & Password Anda</p>

	      <form action="aksi_login.php" method="post">
	        <div class="form-group has-feedback">
	          <input type="email" name="email" required="required" class="form-control" placeholder="Email" autofocus>
	          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	        </div>
	        <div class="form-group has-feedback">
	          <input type="password" name="pass" required="required" class="form-control" placeholder="Password">
	          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	        </div>
	        <div class="row">
	          <div class="col-xs-8">
	          </div>
	          <!-- /.col -->
	          <div class="col-xs-4">
	            <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Log in</button>
	          </div>
	          <!-- /.col -->
	        </div>
	      </form>

	    </div>
	    <!-- /.login-box-body -->
	  </div>

<!-- Bootstrap 3.3.7 -->
<script src="assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
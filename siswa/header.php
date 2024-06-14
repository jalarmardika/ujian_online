<?php 
include '../koneksi.php';
session_start();

if ($_SESSION['status'] == "") {
  header("location:../index.php?pesan=belumLogin");
}elseif ($_SESSION['status'] != "Siswa") {
  http_response_code(403);
  exit();
}else{
  $nis = $_SESSION['nis'];
  $siswa_login = mysqli_query($koneksi,"SELECT * FROM siswa,kelas WHERE nis='$nis' and siswa.id_kelas=kelas.id_kelas ");
  $array = mysqli_fetch_assoc($siswa_login);
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Aplikasi Ujian Online</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="../assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.css">
  <script type="text/javascript" src="../assets/js/jquery.js"></script>
  <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
  <link rel="stylesheet" href="../assets/adminlte/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="../assets/adminlte/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/search.css">
  <script type="text/javascript">
    // cek status siswa apakah 1 atau 0 setiap 1 detik
    setInterval(timer, 1000);

    function timer() { 
      let nis = <?php echo $nis; ?>;
      $.ajax({
        type: 'post',
        url: 'cek_siswa.php',
        data: {
          nis: nis
        },
        dataType: 'json',
        success: function(response) {

          if (response.status_siswa == 0) {
              // jika status siswa 0 (nonaktif) maka dialihkan ke halaman siswa_reset.php dengan pesan reset_siswa
              window.location.href="siswa_reset.php?pesan=reset_siswa&nis=" + nis;
            }
          },
          error: function(xhr, thrownError){
            alert(xhr,status + "\n" + xhr,responseText + "\n" + thrownError);
          }
        })
    }
  </script>
</head>
<body class="hold-transition skin-yellow layout-top-nav">
  <div class="wrapper">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="#" class="navbar-brand"><b>Ujian</b> Online</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
              <li><a href="index.php"><i class="fa fa-home"></i> Beranda</a></li>
              <li><a href="ujian.php"><i class="fa fa-book"></i> Daftar Ujian</a></li>
            </ul>
          </div>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-user-circle"></i>
                  <span class="hidden-xs"><?php echo $array['nama']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <i class="fa fa-user-circle fa-5x"></i>
                    <p>
                      <?php echo $array['nama']; ?>
                      <small><?php echo $array['nama_kelas']; ?></small>
                      <small><?php echo $array['email']; ?></small>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout.php"  onclick="return confirm('Apakah anda ingin keluar ?');" class="btn btn-default btn-flat">Logout</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <!-- /.navbar-custom-menu -->

        </div>
        <!-- /.container-fluid -->
      </nav>
    </header>

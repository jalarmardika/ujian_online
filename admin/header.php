<?php 
session_start();

if ($_SESSION['status'] == null) {
  header("location:../index.php?pesan=belumLogin");
}elseif ($_SESSION['status'] != "Admin" && $_SESSION['status'] != "Petugas") { 
  http_response_code(403);
  exit();
}else{
  include '../koneksi.php';
  $id_user = $_SESSION['id_user'];
  $user_login = mysqli_query($koneksi,"SELECT * FROM user WHERE id_user='$id_user'");
  $array = mysqli_fetch_assoc($user_login);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Aplikasi Ujian Online</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.css">
  <script type="text/javascript" src="../assets/js/jquery.js"></script>
  <link rel="stylesheet" href="../assets/adminlte/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="../assets/adminlte/dist/css/skins/_all-skins.min.css">
  <script src="../assets/adminlte/bower_components/ckeditor/ckeditor.js"></script>
</head>
<body class="hold-transition skin-yellow sidebar-mini">
  <div class="wrapper">

    <header class="main-header" >
      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini  mt-2"><b>U</b>O</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg  mt-2"><b>Ujian</b> Online</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle mr-auto" data-toggle="push-menu" role="button">

        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav ml-auto">

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user-circle"></i>
                <span class="hidden-xs"><?php echo $array['nama']; ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header" style="height: 10rem;">
                  <p>
                    <?php echo $array['nama']; ?>
                    <small><?php echo $array['email']; ?></small>
                    <small><?php echo $array['level']; ?></small>
                  </p>
                </li>
                <!-- Menu Body -->

                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">

                  </div>
                  <div class="pull-right">
                    <a href="logout.php" onclick="return confirm('Apakah anda yakin ?');" class="btn btn-default btn-flat">Logout</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->

          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar mt-4">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li>
            <a href="index.php">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">

              </span>
            </a>
          </li>

          <li class="treeview">
            <a href="#" style="text-decoration: none;">
              <i class="fa fa-database"></i>
              <span>Data Master</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="siswa.php"><i class="fa fa-circle-o"></i> Siswa</a></li>
              <li><a href="kelas.php"><i class="fa fa-circle-o"></i> Kelas</a></li>
              <li><a href="mapel.php"><i class="fa fa-circle-o"></i> Mata Pelajaran</a></li>

            </ul>
          </li>
          <li>
            <a href="ujian.php">
              <i class="fa fa-book"></i> <span>Management Ujian</span>
              <span class="pull-right-container">

              </span>
            </a>
          </li>
          <li>
            <a href="nilai.php">
              <i class="fa fa-area-chart"></i> <span>Hasil Test</span>
              <span class="pull-right-container">

              </span>
            </a>
          </li>
          <?php 
          if ($array['level'] == "Admin") { ?>
            <li>
              <a href="pengguna.php">
                <i class="fa fa-user"></i> <span>Pengguna</span>
                <span class="pull-right-container">

                </span>
              </a>
            </li>
          <?php }else{ ?>
            <li>
              <a href="ganti_password.php">
                <i class="fa fa-lock"></i> <span>Ganti Password</span>
                <span class="pull-right-container">

                </span>
              </a>
            </li>
          <?php }
          ?>
        </ul>
      </section>

      <!-- /.sidebar -->
    </aside>
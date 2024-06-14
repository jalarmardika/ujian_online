<?php include 'header.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class=" mt-3">
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb mt-3">
        <li><a href="index.php">Dashboard</a></li>
       
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <?php
            $siswa = mysqli_query($koneksi,"SELECT * FROM siswa");
            $jumlah_siswa = mysqli_num_rows($siswa);
            ?>
            <div class="inner">
              <h3><?php echo $jumlah_siswa;?></h3>

              <p>Jumlah Siswa</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php
              $kelas = mysqli_query($koneksi,"SELECT * FROM kelas");
              $jumlah_kelas = mysqli_num_rows($kelas);
              ?>
              <h3><?php echo $jumlah_kelas;?></h3>

              <p>Jumlah Kelas</p>
            </div>
            <div class="icon">
              <i class="fa fa-bank"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
         <div class="small-box bg-green" style="margin: auto;">
           <div class="inner">
             <?php
             $pengerjaan = mysqli_query($koneksi,"SELECT * FROM pengerjaan ");
             $jumlah_pengerjaan = mysqli_num_rows($pengerjaan);
             ?>
             <h3><?=$jumlah_pengerjaan?></h3>

             <p>Siswa Mengerjakan Ujian</p>
           </div>
           <div class="icon">
             <i class="fa fa-user"></i>
           </div>
           
         </div>
       </div> 
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
              $mapel = mysqli_query($koneksi,"SELECT * FROM mapel ");
              $jumlah_mapel = mysqli_num_rows($mapel);
              ?>
              <h3><?=$jumlah_mapel?></h3>

              <p>Mata Pelajaran</p>
            </div>
            <div class="icon">
              <i class="fa fa-tasks"></i>
            </div>
            
          </div>
        </div>

       
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php
              $ujian = mysqli_query($koneksi,"SELECT * FROM ujian WHERE status=1 ");
              $jumlah_ujian = mysqli_num_rows($ujian);
              ?>
              <h3><?php echo $jumlah_ujian;?></h3>

              <p>Ujian Aktif</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            
          </div>
        </div>
         <!-- small box -->
         
        <!-- ./col -->
      </div>
     
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include 'footer.php'; ?>

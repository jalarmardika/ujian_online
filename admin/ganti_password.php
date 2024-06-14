<?php 
include 'header.php';
if ($array['level'] == "Petugas") {
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="mt-3">
        Ganti Password
      </h1>
      <ol class="breadcrumb mt-3">
        <li><a href="index.php">Dashboard</a></li>
        <li class="active">Ganti Password</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
      if(isset($_GET['pesan'])){
        if($_GET['pesan']=="ganti_password"){ ?>
          <div class="alert alert-success fade in"> 
            <button type="button" class="close pull-right text-white" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            Password Berhasil Diganti
          </div>
        <?php }else if($_GET['pesan']=="konfirmasi_password_gagal"){ ?>
          <div class="alert alert-danger fade in"> 
            <button type="button" class="close pull-right text-white" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            Konfirmasi Password Gagal
          </div>
        <?php }else if($_GET['pesan']=="password_lama_salah"){ ?>
          <div class="alert alert-danger fade in"> 
            <button type="button" class="close pull-right text-white" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            Password Lama Salah
          </div>
        <?php }
      }
      ?>

      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->

          <div class="box box-primary">
            <div class="box-body">
              <form action="ganti_password_aksi.php" method="post">
                <input type="hidden" name="id" required="required" value="<?php echo $array['id_user']; ?>">
                <div class="form-group">
                  <div class="row">
                    <label class="control-label col-sm-2">Password Lama</label>
                    <div class="col-sm-8">
                      <input type="password" name="pass_lama" required="required" placeholder="Password Lama" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="control-label col-sm-2">Password Baru</label>
                    <div class="col-sm-8">
                      <input type="password" name="pass_baru" required="required" placeholder="Password Baru" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <label class="control-label col-sm-2">Konfirmasi Password</label>
                    <div class="col-sm-8">
                      <input type="password" name="konfirm" placeholder="Konfirmasi Password" required="required" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-2">

                  </div>
                  <div class="col-sm-5">
                    <input type="submit" name="submit" class="btn btn-danger btn-sm" value="Ganti Password">
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php 
  include 'footer.php'; 
} ?>

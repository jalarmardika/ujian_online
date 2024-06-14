<?php 
include 'header.php';
if ($array['level'] == "Admin") {
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="mt-3">
        Pengguna
        
      </h1>
      <ol class="breadcrumb mt-3">
        <li><a href="index.php">Dashboard</a></li>

        <li class="active">Pengguna</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
      if(isset($_GET['pesan'])){
        if($_GET['pesan']=="berhasil"){ ?>
          <div class="alert alert-success fade in"> 
            <button type="button" class="close pull-right text-white" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            Data Berhasil Disimpan
          </div>
        <?php }else if($_GET['pesan']=="edit"){ ?>
          <div class="alert alert-success fade in"> 
            <button type="button" class="close pull-right text-white" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            Data Berhasil Di Update
          </div>
        <?php }else if($_GET['pesan']=="hapus"){ ?>
          <div class="alert alert-success fade in"> 
            <button type="button" class="close pull-right text-white" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            Data Berhasil Di Hapus
          </div>
        <?php }else if($_GET['pesan']=="dilarangHapus"){ ?>
          <div class="alert alert-warning fade in"> 
            <button type="button" class="close pull-right text-white" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            Data Tidak Dapat Dihapus Karena Ada Data Ujian Yang Terkait
          </div>
          <?php 
        }
      }
      ?>
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->

          <div class="box box-primary">
            <div class="box-header with-border">
              <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-user-plus"></i> Tambah Pengguna</a>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">


              <table class="table table-bordered table-hover table-responsive-md">
                <thead>
                  <tr>
                    <th width="1%">No</th>
                    <th>Nama Pengguna</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $user = mysqli_query($koneksi,"SELECT * FROM user ORDER BY id_user DESC");
                  while ($d = mysqli_fetch_assoc($user)) {

                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['nama'];?></td>
                      <td><?php echo $d['email'];?></td>
                      <td><?php echo $d['level'];?></td>
                      <td>

                        <a class="btn btn-warning btn-sm text-white" title="Edit" data-toggle="modal" data-target="#modalEdit<?php echo $d['id_user'];?>"><i class="fa fa-edit"></i></a>
                        <a onclick="return confirm('Apakah anda yakin ?')" title="Hapus" href="pengguna_hapus.php?id=<?php echo $d['id_user']; ?>" class="btn btn-danger btn-sm "><i class="fa fa-trash"></i></a>

                      </td>

                    </tr>
                    <!-- modal edit data -->
                    <div class="modal" tabindex="-1" id="modalEdit<?php echo $d['id_user'];?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <b>Edit Pengguna</b>
                            <button type="button" class="close" data-dismiss="modal" >&times;</button>
                          </div>
                          <div class="modal-body">
                            <form method="post" action="pengguna_edit.php">
                              <input type="hidden" name="id" value="<?php echo $d['id_user'];?>">
                              <div class="form-group">
                                <label >Nama Pengguna</label>
                                <input type="text" name="nama" required="required" class="form-control" value="<?php echo $d['nama']; ?>">
                              </div>

                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label >Email</label>
                                    <input type="email" name="email" required="required" class="form-control" value="<?php echo $d['email']; ?>">
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label >Password (Optional)</label>
                                    <input type="password" name="password" class="form-control" placeholder="Jika Ingin Ganti Password">
                                  </div>
                                </div>
                              </div>

                              <div class="form-group">
                                <label >Level</label><br>
                                <label><input type="radio" name="level" value="Admin" <?php if($d['level']=="Admin"){ echo 'checked'; } ?>> Admin</label>
                                <label><input type="radio" name="level" value="Petugas" <?php if($d['level']=="Petugas"){ echo 'checked'; } ?>> Petugas</label>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" name="submit" class="btn btn-primary btn-sm "><i class="fa fa-refresh"></i> Update</button>   
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  <?php } ?>

                </tbody>
              </table>

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
  <!-- modal tambah data -->
  <div class="modal" tabindex="-1" id="modalAdd">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <b>Tambah Pengguna</b>
          <button type="button" class="close" data-dismiss="modal" >&times;</button>
        </div>
        <div class="modal-body">
          <form method="post" action="pengguna_tambah.php">
            <div class="form-group">
              <label >Nama Pengguna</label>
              <input type="text" name="nama" required="required" class="form-control">
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" required="required" class="form-control">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label >Password</label>
                  <input type="password" name="password" required="required" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label >Level</label><br>
              <label><input type="radio" name="level" value="Admin"> Admin</label>
              <label><input type="radio" name="level" value="Petugas"> Petugas</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-primary btn-sm "><i class="fa fa-save"></i> Simpan</button>   
          </div>
        </form>

      </div>
    </div>

  </div>
  <!-- /.content-wrapper -->
  <?php 
  include 'footer.php';
} 
?>
<?php include 'header.php';?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 class="mt-3">
      Kelas
    </h1>
    <ol class="breadcrumb mt-3">
      <li><a href="index.php">Dashboard</a></li>
      <li class="active">Kelas</li>
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
      <?php }else if($_GET['pesan']=="gagalHapus"){ ?>
        <div class="alert alert-danger fade in"> 
          <button type="button" class="close pull-right text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          Terjadi Kesalahan, Gagal Menghapus Data
        </div>
      <?php }else if($_GET['pesan']=="dilarangHapus"){ ?>
        <div class="alert alert-warning fade in"> 
          <button type="button" class="close pull-right text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          Data Tidak Dapat Dihapus Karena Ada Data Siswa/Ujian Yang Terkait
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
            <?php 
            if ($array['level'] == "Admin") { ?>
              <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mymodal"><i class="fa fa-plus-circle"></i> Tambah Kelas</a>
            <?php }
            ?>
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
                  <th >Nama Kelas</th>
                  <?php 
                  if ($array['level'] == "Admin") { ?>
                    <th width="25%">Opsi</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $noo = 1;
                $kelas = mysqli_query($koneksi,"SELECT * FROM kelas ORDER BY id_kelas DESC");
                while ($d = mysqli_fetch_assoc($kelas)) {

                  ?>
                  <tr>
                    <td><?php echo $noo++; ?></td>
                    <td><?php echo $d['nama_kelas'];?></td>
                    <?php 
                    if ($array['level'] == "Admin") { ?>
                      <td>
                        <a class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#mymodaledit<?php echo $d['id_kelas'];?>"><i class="fa fa-edit"></i> Edit</a>
                        <a onclick="return confirm('Apakah anda yakin ?')" href="kelas_hapus.php?id=<?php echo $d['id_kelas']; ?>" class="btn btn-danger btn-sm "><i class="fa fa-trash"></i> Hapus</a>
                      </td>
                    <?php } ?>
                  </tr>
                  <div class="modal" tabindex="-1" id="mymodaledit<?php echo $d['id_kelas'];?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <b>Edit Kelas</b>
                          <button type="button" class="close" data-dismiss="modal" >&times;</button>
                        </div>
                        <form method="post" action="kelas_edit.php">
                          <div class="modal-body">

                            <input type="hidden" name="id" value="<?php echo $d['id_kelas'];?>">
                            <div class="form-group">
                              <label>Nama Kelas</label>
                              <input type="text" name="nama_kelas" class="form-control" required="required" value="<?php echo $d['nama_kelas']; ?>">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" name="submit" class="btn btn-primary btn-sm "><i class="fa fa-refresh"></i> Update</button>   
                          </div>
                        </form>
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
  <div class="modal" tabindex="-1" id="mymodal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <b>Tambah Kelas</b>
          <button type="button" class="close" data-dismiss="modal" >&times;</button>
        </div>
        <form method="post" action="kelas_tambah.php">
          <div class="modal-body">

            <div class="form-group">
              <label>Nama Kelas</label>
              <input type="text" name="nama_kelas" required="required" class="form-control">
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
  <?php include 'footer.php'; ?>

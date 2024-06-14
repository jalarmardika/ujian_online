<?php include 'header.php';?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 class="mt-3">
      Siswa

    </h1>
    <ol class="breadcrumb mt-3">
      <li><a href="index.php">Dashboard</a></li>

      <li class="active">Siswa</li>
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
          Data Tidak Dapat Dihapus Karena Ada Data Nilai/Pengerjaan Yang Terkait
        </div>
      <?php }else if($_GET['pesan']=="updateStatus"){ ?>
        <div class="alert alert-success fade in"> 
          <button type="button" class="close pull-right text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          Status Siswa Berhasil Di Update
        </div>
      <?php }else if($_GET['pesan']=="gagal"){ ?>
        <div class="alert alert-danger fade in"> 
          <button type="button" class="close pull-right text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          Data Gagal Disimpan, NIS sudah ada silakan masukan NIS yang lain
        </div>
      <?php }
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
              <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-user-plus"></i> Tambah Siswa</a>
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
                  <th >NIS</th>
                  <th >Nama Siswa</th>
                  <th >Email</th>
                  <th >Kelas</th>
                  <th width="12%" class="text-center">Status</th>
                  <th >Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $noo = 1;
                $siswa = mysqli_query($koneksi,"SELECT * FROM siswa,kelas WHERE siswa.id_kelas=kelas.id_kelas ORDER BY nis ASC");
                while ($d = mysqli_fetch_assoc($siswa)) {

                  ?>
                  <tr>
                    <td><?php echo $noo++; ?></td>
                    <td><?php echo $d['nis'];?></td>
                    <td><?php echo $d['nama'];?></td>
                    <td><?php echo $d['email'];?></td>
                    <td><?php echo $d['nama_kelas'];?></td>
                    <td class="text-center">
                      <?php
                      if ($d['status'] == 1) { ?>
                        <a href="#" class="btn-success btn-xs" style="text-decoration: none;">Aktif</a>
                      <?php }else { ?>
                        <a href="#" class="btn-danger btn-xs" style="text-decoration: none;">Nonaktif</a>
                      <?php } ?>
                    </td>
                    <?php 
                    if ($array['level'] == "Admin") { ?>
                      <td>
                        <a class="btn btn-warning btn-sm text-white" title="Edit" data-toggle="modal" data-target="#modalEdit<?php echo $d['nis'];?>"><i class="fa fa-edit"></i></a>
                        <a onclick="return confirm('Apakah anda yakin ?')" title="Hapus" href="siswa_hapus.php?nis=<?php echo $d['nis']; ?>" class="btn btn-danger btn-sm "><i class="fa fa-trash"></i></a>
                      </td>
                    <?php } else { ?>
                      <td>
                        <?php if ($d['status'] == 0) { ?>
                          <a title="Aktifkan" href="siswa_status.php?nis=<?php echo $d['nis']; ?>" class="btn btn-success btn-sm "><i class="fa fa-pencil"></i></a>
                        <?php } else { ?>
                          <a title="Nonaktifkan" href="siswa_status.php?nis=<?php echo $d['nis']; ?>" class="btn btn-danger btn-sm "><i class="fa fa-pencil"></i></a>
                        <?php } ?>
                      </td>
                    <?php }
                    ?>
                  </tr>
                  <!-- modal edit data -->
                  <div class="modal" tabindex="-1" id="modalEdit<?php echo $d['nis'];?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <b>Edit Siswa</b>
                          <button type="button" class="close" data-dismiss="modal" >&times;</button>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="siswa_edit.php">
                            <input type="hidden" name="nis" value="<?php echo $d['nis'];?>">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label >Nama Siswa</label>
                                  <input type="text" name="nama" required="required" class="form-control" value="<?php echo $d['nama']; ?>">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label >Kelas</label>
                                <select name="kelas" class="form-control" required="required">
                                  <option value=""> -- Pilih -- </option>
                                  <?php
                                  $query_kelas = mysqli_query($koneksi,"SELECT * FROM kelas ORDER BY id_kelas DESC");
                                  while($kelas_array = mysqli_fetch_array($query_kelas)){
                                    ?>
                                    <option <?php if($d['id_kelas']==$kelas_array['id_kelas']){echo "selected='selected'";} ?> value="<?php echo $kelas_array['id_kelas']; ?>"><?php echo $kelas_array['nama_kelas']; ?></option>
                                    <?php
                                  }
                                  ?>
                                </select>
                              </div>
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
                              <label >Status</label><br>
                              <label><input type="radio" name="status" value="1" <?php if($d['status']==1){echo 'checked';} ?>> Aktif</label>
                              <label><input type="radio" name="status" value="0" <?php if($d['status']==0){echo 'checked';} ?>> Nonaktif</label>
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
        <b>Tambah Siswa</b>
        <button type="button" class="close" data-dismiss="modal" >&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" action="siswa_tambah.php">
          <div class="form-group">
            <label>NIS</label>
            <input type="text" name="nis" required="required" class="form-control" autocomplete="off">
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label >Nama Siswa</label>
                <input type="text" name="nama" required="required" class="form-control">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label >Kelas</label>
                <select name="kelas" class="form-control" required="required">
                  <option value=""> -- Pilih -- </option>
                  <?php
                  $query_kelas = mysqli_query($koneksi,"SELECT * FROM kelas");
                  while($kelas_array = mysqli_fetch_array($query_kelas)){ ?>
                    <option value="<?php echo $kelas_array['id_kelas']; ?>"><?php echo $kelas_array['nama_kelas']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
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

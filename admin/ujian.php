<?php include 'header.php';?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 class="mt-3">
      Management Ujian

    </h1>
    <ol class="breadcrumb mt-3">
      <li><a href="index.php">Dashboard</a></li>

      <li class="active">Management Ujian</li>
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
        <?php 
      }else if($_GET['pesan']=="nonaktif"){ ?>
        <div class="alert alert-success fade in"> 
          <button type="button" class="close pull-right text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          Ujian Berhasil Di Nonaktifkan
        </div>
        <?php 
      }else if($_GET['pesan']=="dilarangHapus"){ ?>
        <div class="alert alert-warning fade in"> 
          <button type="button" class="close pull-right text-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          Data Tidak Dapat Dihapus Karena Ada Data Nilai/Soal/Pengerjaan Yang Terkait
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
            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#mymodal"><i class="fa fa-plus-circle"></i> Tambah Ujian</a>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">


            <table width="100%" class="table table-bordered table-hover table-responsive-md">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis Ujian</th>
                  <th>Tgl Dibuat</th>
                  <th>Mapel</th>
                  <th>Kelas</th>
                  <th>Jumlah Soal</th>
                  <th>Waktu</th>
                  <th>Status</th>
                  <th>Pembuat</th>
                  <th width="10%">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $noo = 1;
                $ujian = mysqli_query($koneksi,"SELECT * FROM ujian,mapel,kelas,user WHERE ujian.id_mapel=mapel.id_mapel and ujian.id_kelas=kelas.id_kelas and ujian.id_user=user.id_user ORDER BY id_ujian DESC");
                while ($d = mysqli_fetch_assoc($ujian)) {

                  ?>
                  <tr>
                    <td><?php echo $noo++; ?></td>
                    <td><?php echo $d['jenis_ujian'];?></td>
                    <td><?php echo date('d-m-Y H:i:s', strtotime($d['tgl_dibuat']));?></td>
                    <td><?php echo $d['mata_pelajaran'];?></td>
                    <td><?php echo $d['nama_kelas'];?></td>
                    <td class="text-center"><?php echo $d['jml_soal']; ?></td>
                    <td><?php echo $d['waktu'];?> menit</td>
                    <td class="text-center">
                      <?php
                      if ($d['status']==1) { ?>
                        <a href="#" class="btn-success btn-xs" style="text-decoration: none;">Aktif</a>
                      <?php }else { ?>
                        <a href="#" class="btn-danger btn-xs" style="text-decoration: none;">Nonaktif</a>
                      <?php } ?>
                    </td>
                    <td><?php echo $d['nama']; ?></td>
                    <td>
                      <a class="btn btn-info btn-sm text-white" title="Daftar Soal" href="daftar-soal.php?id=<?php echo $d['id_ujian']; ?>"><i class="fa fa-list"></i></a>
                      <?php 
                      // jika status ujian nonaktif maka tampilkan tombol untuk edit dan hapus ujian
                      if ($d['status'] == 0) { ?>
                        <a class="btn btn-warning btn-sm text-white mb-2" title="Edit" data-toggle="modal" data-target="#mymodaledit<?php echo $d['id_ujian'];?>"><i class="fa fa-pencil"></i></a>

                        <a onclick="return confirm('Apakah anda yakin ingin menghapus ujian ini ?')" title="Hapus" href="ujian_hapus.php?id=<?php echo $d['id_ujian']; ?>" class="btn btn-danger btn-sm mb-2"><i class="fa fa-trash"></i></a>

                      <?php }else{ ?>
                        <a onclick="return confirm('Catatan : Jika ujian dinonaktifkan maka siswa tidak dapat mengerjakan ujian dan bagi yang sudah mengerjakan tidak dapat melihat nilai/hasil ujian . Yakin ?')" class="btn btn-danger btn-sm text-white mb-2" title="Nonaktifkan" href="ujian-nonaktif.php?id=<?php echo $d['id_ujian'];?>"><i class="fa fa-edit"></i></a>
                      <?php } ?>
                    </td>

                  </tr>
                  <div class="modal" tabindex="-1" id="mymodaledit<?php echo $d['id_ujian'];?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <b>Edit Ujian</b>
                          <button type="button" class="close" data-dismiss="modal" >&times;</button>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="ujian_edit.php">
                            <input type="hidden" name="id" value="<?php echo $d['id_ujian'];?>">
                            <div class="form-group">
                              <label>Jenis Ujian</label>
                              <input type="text" name="jenis" class="form-control" required="required" value="<?php echo $d['jenis_ujian']; ?>" autocomplete="off" placeholder="Contoh : Penilaian Tengah Semester I 2022/2023">
                            </div>

                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label >Mata Pelajaran</label>
                                  <select name="mapel" class="form-control" required="required">
                                    <option value=""> -- Pilih -- </option>
                                    <?php
                                    $query_mapel = mysqli_query($koneksi,"SELECT * FROM mapel ORDER BY id_mapel DESC");
                                    while($mapel_array = mysqli_fetch_assoc($query_mapel)){
                                      ?>
                                      <option <?php if($d['id_mapel']==$mapel_array['id_mapel']){echo "selected='selected'";} ?> value="<?php echo $mapel_array['id_mapel']; ?>"><?php echo $mapel_array['mata_pelajaran']; ?></option>
                                      <?php
                                    }
                                    ?>
                                  </select>
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label >Kelas</label>
                                  <select name="kelas" class="form-control" required="required">
                                    <option value=""> -- Pilih -- </option>
                                    <?php
                                    $query_kelas = mysqli_query($koneksi,"SELECT * FROM kelas ORDER BY id_kelas DESC");
                                    while($kelas_array = mysqli_fetch_assoc($query_kelas)){
                                      ?>
                                      <option <?php if($d['id_kelas']==$kelas_array['id_kelas']){echo "selected='selected'";} ?> value="<?php echo $kelas_array['id_kelas']; ?>"><?php echo $kelas_array['nama_kelas']; ?></option>
                                      <?php
                                    }
                                    ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-4">
                                <label>Waktu</label>
                                <div class="input-group">
                                  <input type="number" name="waktu" class="form-control" required="required" value="<?php echo $d['waktu']; ?>">
                                  <span class="input-group-addon"><i class="fa fa-clock-o"></i> menit</span>
                                </div>
                                <br>
                              </div>
                            </div>
                            <?php 
                            // jika jumlah soal lebih dari 0 maka tampilkan inputan untuk mengubah status ujian
                            if ($d['jml_soal'] > 0) { ?>
                              <div class="form-group">
                                <label >Status</label><br>
                                <label><input type="radio" name="status" value="1" <?php if($d['status']==1){echo 'checked';} ?>> Aktif</label>
                                <label><input type="radio" name="status" value="0" <?php if($d['status']==0){echo 'checked';} ?>> Nonaktif</label>
                              </div>
                            <?php } ?>
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
<div class="modal" tabindex="-1" id="mymodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <b>Tambah Ujian</b>
        <button type="button" class="close" data-dismiss="modal" >&times;</button>
      </div>
      <div class="modal-body">
        <form method="post" action="ujian_tambah.php">
          <div class="form-group">
            <label>Jenis Ujian</label>
            <input type="text" name="jenis" class="form-control" required="required"  autocomplete="off" placeholder="Contoh : Penilaian Tengah Semester I 2022/2023">
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label >Mata Pelajaran</label>
                <select name="mapel" class="form-control" required="required">
                  <option value=""> -- Pilih -- </option>
                  <?php
                  $mapel = mysqli_query($koneksi,"SELECT * FROM mapel ORDER BY id_mapel DESC");
                  while($array_mapel = mysqli_fetch_assoc($mapel)){
                    ?>
                    <option value="<?php echo $array_mapel['id_mapel']; ?>"><?php echo $array_mapel['mata_pelajaran']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label >Kelas</label>
                <select name="kelas" class="form-control" required="required">
                  <option value=""> -- Pilih -- </option>
                  <?php
                  $kelas = mysqli_query($koneksi,"SELECT * FROM kelas ORDER BY id_kelas DESC");
                  while($array_kelas = mysqli_fetch_assoc($kelas)){
                    ?>
                    <option value="<?php echo $array_kelas['id_kelas']; ?>"><?php echo $array_kelas['nama_kelas']; ?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <label>Waktu</label>
              <div class="input-group">

                <input type="number" name="waktu" class="form-control" required="required">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i> menit</span>
              </div>
              <br>
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

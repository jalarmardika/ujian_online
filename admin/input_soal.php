<?php 
if (isset($_GET['id'])) {
  include 'header.php';
  $id_ujian = $_GET['id'];
  // cek apakah id_ujian yang dikirimkan lewat url ada di table ujian
  $ujian = mysqli_query($koneksi, "SELECT * FROM ujian JOIN mapel ON ujian.id_mapel=mapel.id_mapel JOIN kelas ON ujian.id_kelas=kelas.id_kelas WHERE id_ujian='$id_ujian' ");
  if (mysqli_num_rows($ujian) > 0) {
    // jika ada, ambil datanya
    $data_ujian = mysqli_fetch_assoc($ujian);
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1 class="mt-3">
          Input Soal
          
        </h1>
        <ol class="breadcrumb mt-3">
          <li><a href="index.php">Dashboard</a></li>
          <li><a href="ujian.php">Ujian</a></li>
          <li><a href="daftar-soal.php?id=<?php echo $id_ujian; ?>">Daftar Soal</a></li>
          <li class="active">Input Soal</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <?php
        if(isset($_GET['pesan'])){
          if($_GET['pesan']=="berhasil"){ ?>
            <div class="alert alert-success"> 
              <button type="button" class="close pull-right text-white" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              Soal Berhasil Ditambahkan
            </div>
          <?php } } ?>

          <div class="row">
            <div class="col-md-4">
              <div class="box box-primary">
                <div class="box-header with-border">
                  Data Ujian
                </div>
                <div class="box-body">
                  <p class="mb-2"><b><?= $data_ujian['jenis_ujian']; ?></b></p>
                  <table class="table">
                    <tr>
                      <td>Mata Pelajaran</td>
                      <td>:</td>
                      <td><?= $data_ujian['mata_pelajaran']; ?></td>
                    </tr>
                    <tr>
                      <td>Dibuat Pada</td>
                      <td>:</td>
                      <td><?= date('d-m-Y H:i:s', strtotime($data_ujian['tgl_dibuat'])); ?></td>
                    </tr>
                    <tr>
                      <td>Kelas</td>
                      <td>:</td>
                      <td><?= $data_ujian['nama_kelas']; ?></td>
                    </tr>
                    <tr>
                      <td>Waktu</td>
                      <td>:</td>
                      <td><?= $data_ujian['waktu']; ?> menit</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="box box-primary">
                <div class="box-header with-border">
                  Form Input Soal
                </div>
                <div class="box-body">
                  <form action="soal_tambah.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_ujian" value="<?php echo $id_ujian; ?>">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-2">
                          <label>Soal</label>
                        </div>
                        <div class="col-md-10">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-image"></i> Gambar Soal 
                            </div>
                            <input class="form-control" name="gambar_soal" type="file" accept=".jpg , .png"/>
                          </div>
                          <textarea id="editor_soal" name="soal" class="form-control" required="required" rows="10" cols="80"></textarea>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-2">
                          <label>Pilihan A</label>
                        </div>
                        <div class="col-md-10">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-image"></i> Gambar A 
                            </div>
                            <input class="form-control" name="gambar_a" type="file" accept=".jpg , .png"/>
                          </div>
                          <textarea id="editora" name="pilihan_a" class="form-control" required="required" rows="10" cols="80"></textarea>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-2">
                          <label>Pilihan B</label>
                        </div>
                        <div class="col-md-10">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-image"></i> Gambar B 
                            </div>
                            <input class="form-control" name="gambar_b" type="file" accept=".jpg , .png"/>
                          </div>
                          <textarea id="editorb" name="pilihan_b" class="form-control" required="required" rows="10" cols="80"></textarea>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-2">
                          <label>Pilihan C</label>
                        </div>
                        <div class="col-md-10">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-image"></i> Gambar C 
                            </div>
                            <input class="form-control" name="gambar_c" type="file" accept=".jpg , .png"/>
                          </div>
                          <textarea id="editorc" name="pilihan_c" class="form-control" required="required" rows="10" cols="80"></textarea>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-2">
                          <label>Pilihan D</label>
                        </div>
                        <div class="col-md-10">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-image"></i> Gambar D 
                            </div>
                            <input class="form-control" name="gambar_d" type="file" accept=".jpg , .png"/>
                          </div>
                          <textarea id="editord" name="pilihan_d" class="form-control" required="required" rows="10" cols="80"></textarea>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-2">
                          <label>Pilihan E</label>
                        </div>
                        <div class="col-md-10">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-image"></i> Gambar E 
                            </div>
                            <input class="form-control" name="gambar_e" type="file" accept=".jpg , .png"/>
                          </div>
                          <textarea id="editore" name="pilihan_e" class="form-control" required="required" rows="10" cols="80"></textarea>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-2">
                          <label>Kunci Jawaban</label>
                        </div>
                        <div class="col-md-10">
                          <select name="kunci" class="form-control" required="required">
                            <option value=""> -- Pilih -- </option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-2">
                          
                        </div>
                        <div class="col-md-10">
                          <button type="submit" name="submit" class="btn btn-success btn-sm mt-5 mb-5"><i class="fa fa-plus"></i> Tambahkan</button>
                          <a href="daftar-soal.php?id=<?php echo $id_ujian; ?>" class="btn btn-danger btn-sm mt-5 mb-5"><i class="fa fa-undo"></i> Kembali</a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.box -->
            </div>
          </div>
          <!-- /.row -->
        </section>
        <!-- /.content -->
      </div>
      
      <!-- /.content-wrapper -->
      <script type="text/javascript">
        $(document).ready(function(){
          CKEDITOR.replace( 'editor_soal',
          {
           enterMode : CKEDITOR.ENTER_BR,

         });
          CKEDITOR.replace( 'editora',
          {
           enterMode : CKEDITOR.ENTER_BR,

         });
          CKEDITOR.replace( 'editorb',
          {
           enterMode : CKEDITOR.ENTER_BR,

         });
          CKEDITOR.replace( 'editorc',
          {
           enterMode : CKEDITOR.ENTER_BR,

         });
          CKEDITOR.replace( 'editord',
          {
           enterMode : CKEDITOR.ENTER_BR,

         });
          CKEDITOR.replace( 'editore',
          {
           enterMode : CKEDITOR.ENTER_BR,

         });
        })
      </script>
      <?php 
      include 'footer.php';
    } 
  } 
  ?>
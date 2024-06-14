<?php 
if (isset($_POST['submit'])) {
  include 'header.php';
  $id_soal = $_POST['id'];
  $id_ujian = $_POST['id_ujian'];
  $soal = mysqli_query($koneksi, "SELECT * FROM soal WHERE id_soal='$id_soal' ");
  $ujian = mysqli_query($koneksi, "SELECT * FROM ujian WHERE id_ujian='$id_ujian' ");

  if (mysqli_num_rows($ujian) > 0 && mysqli_num_rows($soal) > 0) {
    $data = mysqli_fetch_array($soal);
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="mt-3">
        Edit Soal
        
      </h1>
      <ol class="breadcrumb mt-3">
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="ujian.php">Ujian</a></li>
        <li><a href="daftar-soal.php?id=<?php echo $id_ujian; ?>">Daftar Soal</a></li>
        <li class="active">Edit Soal</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->

          <div class="box box-primary">
            <div class="box-header with-border">
              Form Edit Soal
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <form action="soal_edit.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id_soal; ?>">
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
                        <option <?php if($data['kunci'] == 'A') { echo "Selected='selected'"; } ?> value="A">A</option>
                        <option <?php if($data['kunci'] == 'B') { echo "Selected='selected'"; } ?> value="B">B</option>
                        <option <?php if($data['kunci'] == 'C') { echo "Selected='selected'"; } ?> value="C">C</option>
                        <option <?php if($data['kunci'] == 'D') { echo "Selected='selected'"; } ?> value="D">D</option>
                        <option <?php if($data['kunci'] == 'E') { echo "Selected='selected'"; } ?> value="E">E</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      
                    </div>
                    <div class="col-md-10">
                      <button type="submit" name="submit" class="btn btn-success btn-sm mt-5 mb-5"><i class="fa fa-edit"></i> Update</button>
                      <a href="daftar-soal.php?id=<?php echo $id_ujian; ?>" class="btn btn-danger btn-sm mt-5 mb-5"><i class="fa fa-undo"></i> Kembali</a>
                    </div>
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
<script type="text/javascript">
  $(document).ready(function(){
    CKEDITOR.replace( 'editor_soal',
     {
     enterMode : CKEDITOR.ENTER_BR,

     }).setData("<?php echo $data['soal']; ?>");

    CKEDITOR.replace( 'editora',
     {
     enterMode : CKEDITOR.ENTER_BR,

     }).setData("<?php echo $data['pilihan_a']; ?>");

    CKEDITOR.replace( 'editorb',
     {
     enterMode : CKEDITOR.ENTER_BR,

     }).setData("<?php echo $data['pilihan_b']; ?>");

    CKEDITOR.replace( 'editorc',
     {
     enterMode : CKEDITOR.ENTER_BR,

     }).setData("<?php echo $data['pilihan_c']; ?>");

    CKEDITOR.replace( 'editord',
     {
     enterMode : CKEDITOR.ENTER_BR,

     }).setData("<?php echo $data['pilihan_d']; ?>");

    CKEDITOR.replace( 'editore',
     {
     enterMode : CKEDITOR.ENTER_BR,

     }).setData("<?php echo $data['pilihan_e']; ?>");
  })

</script>
<?php 
include 'footer.php';
 }
}
?>
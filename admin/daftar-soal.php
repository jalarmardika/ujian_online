<?php 
if (isset($_GET['id'])) {
  include 'header.php';
  $id_ujian = $_GET['id'];
  $ujian = mysqli_query($koneksi, "SELECT * FROM ujian WHERE id_ujian='$id_ujian' ");
  if (mysqli_num_rows($ujian) > 0) {
    $data_ujian = mysqli_fetch_assoc($ujian);
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1 class="mt-3">
          Daftar Soal

        </h1>
        <ol class="breadcrumb mt-3">
          <li><a href="index.php">Dashboard</a></li>
          <li><a href="ujian.php">Ujian</a></li>
          <li class="active">Daftar Soal</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <?php
        if(isset($_GET['pesan'])){
          if($_GET['pesan']=="edit"){ ?>
            <div class="alert alert-success fade in"> 
              <button type="button" class="close pull-right text-white" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              Soal Berhasil Di Edit
            </div>
            <?php 
          } 
        } 

        // cek apakah status ujian ini nonaktif
        if ($data_ujian['status'] == 0) {
        // cek apakah sudah ada siswa yg SELESAI mengerjakan ujian ini
          $cek_nilai = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_ujian='$id_ujian' ");
          if(mysqli_num_rows($cek_nilai) > 0){  ?>
            <div class="alert alert-warning fade in">
              <b>Peringatan !</b> Sudah Ada Siswa Yang <b>Selesai</b> Mengerjakan Ujian Ini, Jika Anda Menambah, Mengedit atau Menghapus Soal Maka Nilai Para Siswa Yang Sudah Selesai Mengerjakan akan <b>Di Reset Otomatis .</b>
            </div>
            <?php 
          }
        }else{ ?>
          <div class="alert alert-warning fade in">
            <b>Catatan !</b> Ujian sedang aktif, anda tidak dapat menambah, mengedit atau menghapus soal. Nonaktifkan ujian terlebih dahulu agar anda dapat memanipulasi soal .
          </div>
          <?php
        }
        ?>
        <div class="row" >
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->

            <div class="box box-primary">
              <?php 
              // jika status ujian nonaktif maka user dapat menambah soal
              if ($data_ujian['status'] == 0) { ?>
                <div class="box-header with-border">
                  <a href="input_soal.php?id=<?php echo $id_ujian;?>" class="btn btn-primary btn-sm "><i class="fa fa-plus"></i> Tambah Soal</a>
                </div>
              <?php } ?>
              <div class="box-body">
                <div class="row" style="margin: auto;">
                  <div class="col-md-12">
                    <?php 
                    $no=1;
                    $query = mysqli_query($koneksi,"SELECT * FROM soal WHERE id_ujian='$id_ujian' ORDER BY id_soal ASC");
                    while ($array = mysqli_fetch_assoc($query)) { ?>
                      <div class="row">
                        <div class="col-md-11">
                          <tr>
                            <td><b><?= $no++ ?>.</b></td> 
                            <td><?=$array['soal']?></td><br>
                          </tr><br>
                          <?php
                          if (!empty($array['gambar_soal'])) {
                            echo "<tr><td></td><td>&emsp;<img src='../assets/img/$array[gambar_soal]' align=center style='max-width:300px;height:auto' ></td></tr><br><br>";
                          }
                          ?>
                          
                          <tr>
                            <td></td> 
                            <td>a. <?=$array['pilihan_a']?></td><br>
                          </tr><br>
                          <?php
                          if (!empty($array['gambar_a'])) {
                            echo "<tr><td></td><td>&emsp;<img src='../assets/img/$array[gambar_a]' align=center style='max-width:150px;height:auto' ></td></tr><br><br>";
                          }
                          ?>

                          <tr>
                            <td></td> 
                            <td>b. <?=$array['pilihan_b']?></td><br>
                          </tr><br>
                          <?php
                          if (!empty($array['gambar_b'])) {
                            echo "<tr><td></td><td>&emsp;<img src='../assets/img/$array[gambar_b]' align=center style='max-width:150px;height:auto' ></td></tr><br><br>";
                          }
                          ?>

                          <tr>
                            <td></td> 
                            <td>c. <?=$array['pilihan_c']?></td><br>
                          </tr><br>
                          <?php
                          if (!empty($array['gambar_c'])) {
                            echo "<tr><td></td><td>&emsp;<img src='../assets/img/$array[gambar_c]' align=center style='max-width:150px;height:auto' ></td></tr><br><br>";
                          }
                          ?>

                          <tr>
                            <td></td> 
                            <td>d. <?=$array['pilihan_d']?></td><br>
                          </tr><br>
                          <?php
                          if (!empty($array['gambar_d'])) {
                            echo "<tr><td></td><td>&emsp;<img src='../assets/img/$array[gambar_d]' align=center style='max-width:150px;height:auto' ></td></tr><br><br>";
                          }
                          ?>

                          <tr>
                            <td></td> 
                            <td>e. <?=$array['pilihan_e']?></td><br>                     
                          </tr><br>
                          <?php
                          if (!empty($array['gambar_e'])) {
                            echo "<tr><td></td><td>&emsp;<img src='../assets/img/$array[gambar_e]' align=center style='max-width:150px;height:auto' ></td></tr><br><br>";
                          }
                          ?>
                          <tr>
                            <td></td>
                            <td><b>Kunci Jawaban : <?=$array['kunci']?></b></td><br>
                          </tr><br>
                        </div>

                        <div class="col-md-1">
                          <?php 
                            // jika status ujian nonaktif maka user dapat menghapus soal
                          if ($data_ujian['status'] == 0) { ?>
                           <form action="edit_soal.php" method="post" style="display: inline;">
                             <input type="hidden" name="id" value="<?php echo $array['id_soal']; ?>">
                             <input type="hidden" name="id_ujian" value="<?php echo $id_ujian; ?>">
                             <button type="submit" name="submit" title="Edit" class="btn btn-warning text-white btn-sm mb-5 "><i class="fa fa-edit"></i></button>
                           </form>
                           <a onclick="return confirm('Apakah anda yakin ingin menghapus soal ini ?')" title="Hapus" href="soal_hapus.php?id=<?php echo $array['id_soal']; ?>&id_ujian=<?php echo $id_ujian; ?>" class="btn btn-danger btn-sm mb-5 "><i class="fa fa-trash"></i></a><br>
                         <?php } ?>
                       </div>
                     </div>
                   <?php } ?> 
                 </div>
               </div>
               <!-- /.box -->

             </div>
           </div>
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
 }
}
?>
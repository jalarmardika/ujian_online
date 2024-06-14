<?php 
if (isset($_POST['submit'])) {
  include 'header.php';
  $id_ujian = $_POST['id'];
  $id_kelas = $_POST['id_kelas'];
  $ujian = mysqli_query($koneksi, "SELECT * FROM ujian JOIN mapel ON ujian.id_mapel=mapel.id_mapel JOIN kelas ON ujian.id_kelas=kelas.id_kelas WHERE id_ujian='$id_ujian' ");
  $data_ujian = mysqli_fetch_assoc($ujian);
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="mt-3">
        Detail Hasil Test
        
      </h1>
      <ol class="breadcrumb mt-3">
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="nilai.php">Hasil Test</a></li>
        <li class="active">Detail Hasil Test</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">
          <div class="box box-primary">
            <div class="box-header with-border">
              Data Ujian
            </div>
            <div class="box-body">
              <p class="mb-2"><b><?= $data_ujian['jenis_ujian']; ?></b></p>
              <table class="table">
                <tr>
                  <td>Mapel</td>
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
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border no-print">
              Data Nilai Siswa
              <div class="box-tools pull-right">
                <?php 
                $nilai = mysqli_query($koneksi,"SELECT * FROM nilai,siswa,kelas WHERE id_ujian='$id_ujian' and nilai.nis=siswa.nis and siswa.id_kelas=kelas.id_kelas ORDER BY id_nilai DESC");

                if (mysqli_num_rows($nilai) > 0) { ?>
                  <form action="export-nilai.php" method="post" target="_blank">
                    <input type="hidden" name="id" value="<?php echo $id_ujian; ?>">
                    <button type="submit" name="submit" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i> Export Excel</button>
                  </form>
                <?php }else{ ?>
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <?php } ?>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table width="100%" class="table table-bordered table-hover table-responsive-md">
               <thead>
                 <tr>
                   <th>No</th>
                   <th>NIS</th>
                   <th>Nama Siswa</th>
                   <th>Kelas Saat Ini</th>
                   <th>Selesai Dikerjakan</th>
                   <th class="text-center">Benar</th>
                   <th class="text-center">Salah</th>
                   <th class="text-center">Kosong</th>
                   <th class="text-center">Nilai</th>
                   <th class="text-center">Predikat</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                 $no = 1;
                 while ($d = mysqli_fetch_assoc($nilai)) {
                   ?>
                   <tr>
                     <td><?php echo $no++; ?></td>
                     <td><?php echo $d['nis'];?></td>
                     <td><?php echo $d['nama'];?></td>
                     <td><?php echo $d['nama_kelas'];?></td>
                     <td><?php echo date('d-m-Y H:i:s', strtotime($d['tgl_selesai']));?></td>
                     <td class="text-center"><?php echo $d['benar'];?></td>
                     <td class="text-center"><?php echo $d['salah'];?></td>
                     <td class="text-center"><?php echo $d['kosong'];?></td>
                     <td class="text-center"><?php echo $d['nilai'];?></td>
                     <td class="text-center"><?php echo $d['predikat'];?></td>
                   </tr>
                   
                 <?php } ?>

               </tbody>
             </table>
           </div>
         </div>
         <!-- /.box -->
       </div>
     </div>
     <div class="row">
       <div class="col-md-6">
        <div class="box box-primary no-print">
          <div class="box-header with-border">
            Data Siswa Belum Mengerjakan Ujian
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
           <table width="100%" class="table table-bordered table-hover table-responsive-md">
             <thead>
               <tr>
                 <th width="1%">No</th>
                 <th >NIS</th>
                 <th >Nama Siswa</th>
                 <th>Kelas</th>
               </tr>
             </thead>
             <tbody>
               <?php
               $nomor = 1;
               $siswaBelumMengerjakan = mysqli_query($koneksi,"SELECT * FROM siswa,kelas WHERE siswa.id_kelas='$id_kelas' and siswa.id_kelas=kelas.id_kelas ORDER BY nis ASC");
               while ($fetch = mysqli_fetch_assoc($siswaBelumMengerjakan)) {
                $nis = $fetch['nis'];
                $cari = mysqli_query($koneksi,"SELECT * FROM nilai WHERE nis='$nis' and id_ujian='$id_ujian'");
                if (mysqli_num_rows($cari) < 1) {

                 ?>
                 <tr>
                   <td><?php echo $nomor++; ?></td>
                   <td><?php echo $fetch['nis'];?></td>
                   <td><?php echo $fetch['nama'];?></td>
                   <td><?php echo $fetch['nama_kelas'];?></td>
                 </tr>

               <?php } } ?>

             </tbody>
           </table>
         </div>
       </div>
       <!-- /.box -->
     </div>
     <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          Grafik Predikat Siswa
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div> 
        <div class="box-body">
          <div style="width: 100%; margin-bottom: 40px;">
            <canvas id="myChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>

<script type="text/javascript" src="../assets/js/Chart.js"></script>
<script type="text/javascript">
  var ctx = document.getElementById("myChart").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
      "Predikat : A", 
      "Predikat : B", 
      "Predikat : C", 
      "Predikat : D", 
      "Predikat : E" 
      ],
      datasets: [{
        label: 'Jumlah Siswa',
        data: [

        <?php
        $predikatA = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_ujian='$id_ujian' and predikat='A'");
        ?>
        "<?php echo mysqli_num_rows($predikatA); ?>",
        <?php
        $predikatB = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_ujian='$id_ujian' and predikat='B'");
        ?>
        "<?php echo mysqli_num_rows($predikatB); ?>", 
        <?php
        $predikatC = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_ujian='$id_ujian' and predikat='C'");
        ?>
        "<?php echo mysqli_num_rows($predikatC); ?>",
        <?php
        $predikatD = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_ujian='$id_ujian' and predikat='D'");
        ?>
        "<?php echo mysqli_num_rows($predikatD); ?>",
        <?php
        $predikatE = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_ujian='$id_ujian' and predikat='E'");
        ?>
        "<?php echo mysqli_num_rows($predikatE); ?>"
        ],
        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });

</script>
<!-- /.content-wrapper -->
<?php
include 'footer.php';
}
?>

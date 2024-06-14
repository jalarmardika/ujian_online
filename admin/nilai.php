<?php include 'header.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="mt-3">
        Hasil Test
        
      </h1>
      <ol class="breadcrumb mt-3">
        <li><a href="index.php">Dashboard</a></li>
       
        <li class="active">Hasil Test</li>
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
                              <th >Jenis Ujian</th>
                              <th >Tgl Dibuat</th>
                              <th >Mapel</th>
                              <th >Kelas</th>
                              <th class="text-center">Jumlah Soal</th>
                              <th >Waktu</th>
                              <th >Status</th>
                              <th >Opsi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $noo = 1;
                            $ujian = mysqli_query($koneksi,"SELECT * FROM ujian,mapel,kelas WHERE ujian.id_mapel=mapel.id_mapel and ujian.id_kelas=kelas.id_kelas ORDER BY id_ujian DESC");
                            while ($d = mysqli_fetch_array($ujian)) {
                              
                            ?>
                            <tr>
                              <td><?php echo $noo++; ?></td>
                              <td><?php echo $d['jenis_ujian'];?></td>
                              <td><?php echo date('d-m-Y H:i:s', strtotime($d['tgl_dibuat']));?></td>
                              <td><?php echo $d['mata_pelajaran'];?></td>
                              <td><?php echo $d['nama_kelas'];?></td>
                              <td class="text-center"><?php echo $d['jml_soal'];?></td>
                              <td><?php echo $d['waktu'];?> menit</td>
                              <td class="text-center">
                                <?php
                                    if ($d['status']==1) { ?>
                                    <a href="#" class="btn-success btn-xs" style="text-decoration: none;">Aktif</a>
                                    <?php }else { ?>
                                    <a href="#" class="btn-danger btn-xs" style="text-decoration: none;">Nonaktif</a>
                                <?php } ?>
                              </td>
                              <td>
                                <form action="hasil.php" method="post">
                                  <input type="hidden" name="id" value="<?php echo $d['id_ujian']; ?>">
                                  <input type="hidden" name="id_kelas" value="<?php echo $d['id_kelas']; ?>">
                                  <button type="submit" name="submit" class="btn btn-primary btn-sm text-white" title="Lihat Detail"><i class="fa fa-eye"></i></button>
                                </form>
                              </td>
                              
                            </tr>
                            
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
  <!-- /.content-wrapper -->
 <?php include 'footer.php'; ?>

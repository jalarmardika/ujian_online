<?php include 'header.php';?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="mt-3">
              Beranda
          </h1>
          <ol class="breadcrumb mt-3">
            <li><a href="index.php">Beranda</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="pad margin no-print">
                    <div class="callout callout-info" style="margin-bottom: 0!important;">
                        Selamat Datang <?php echo $array['nama']; ?> .
                    </div>
                </div>
            </div>
        </div>

        <ul class="timeline" style="width: 100%; height: 100%; overflow-y: auto;">

            <!-- timeline time label -->
            <li class="time-label">
                <span class="bg-white">
                    <i class="fa fa-info-circle"></i> Tutorial cara mengikuti ujian
                </span>
            </li>
            <!-- /.timeline-label -->

            <!-- timeline item -->
            <li>
                <!-- timeline icon -->
                <i class="fa fa-edit bg-red"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 1</span>

                    <h3 class="timeline-header"><a href="#">Langkah pertama</a> ...</h3>

                    <div class="timeline-body">
                        Pilih menu ujian.
                    </div>

                    <div class="timeline-footer">
                        <a href="ujian.php" class="btn btn-primary btn-xs">Menu Ujian</a>
                    </div>
                </div>
            </li>

            <li>
                <!-- timeline icon -->
                <i class="fa fa-book bg-yellow"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 2</span>

                    <h3 class="timeline-header"><a href="#">Langkah kedua</a> ...</h3>

                    <div class="timeline-body">
                        Pilih salah satu soal ujian yang aktif, klik tombol mulai kerjakan.<br>
                        hubungi petugas atau admin jika tidak ada soal yang aktif.
                    </div>
                </div>
            </li>

            <li>
                <!-- timeline icon -->
                <i class="fa fa-list bg-blue"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 3</span>

                    <h3 class="timeline-header"><a href="#">Langkah ketiga</a> ...</h3>

                    <div class="timeline-body">
                        Soal siap dikerjakan...<br>
                        Pastikan soal sudah dikerjakan semua dengan teliti sebelum menyelesaikan ujian...<br>
                    </div>
                </div>
            </li>

            <li>
                <!-- timeline icon -->
                <i class="fa fa-check bg-green"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 4</span>

                    <h3 class="timeline-header"><a href="#">Langkah keempat</a> ...</h3>

                    <div class="timeline-body">
                        Klik tombol selesai untuk mengakhiri ujian . Apabila waktu sudah habis maka ujian akan diakhiri secara otomatis .
                    </div>
                </div>
            </li>
        </ul>
    </section>
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>

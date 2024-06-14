<?php include 'header.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<div class="container">

	    <!-- Main content -->
	    <section class="content">
	      
	      <div class="row">
	      	<div class="col-md-3">
	      		
	      	</div>
	      	<div class="col-md-6">
	      		<?php
	      		if(isset($_GET['pesan'])){
	      		  if($_GET['pesan']=="ganti_password"){ ?>
	      		  <div class="alert alert-success fade in"> 
	      		    <button type="button" class="close pull-right text-white mb-4" data-dismiss="alert" aria-label="Close">
	      		      <span aria-hidden="true">&times;</span>
	      		    </button>
	      		    Password Berhasil Diubah
	      		  </div>
	      		  <?php }else if($_GET['pesan']=="edit"){ ?>
	      		  <div class="alert alert-success fade in"> 
	      		    <button type="button" class="close pull-right text-white mb-4" data-dismiss="alert" aria-label="Close">
	      		      <span aria-hidden="true">&times;</span>
	      		    </button>
	      		    Profile Berhasil Di Update
	      		  </div>
	      		  <?php }else if($_GET['pesan']=="konfirmasi_password_gagal"){ ?>
	      		  <div class="alert alert-danger fade in"> 
	      		    <button type="button" class="close pull-right text-white mb-4" data-dismiss="alert" aria-label="Close">
	      		      <span aria-hidden="true">&times;</span>
	      		    </button>
	      		    Konfirmasi Passwword Gagal
	      		  </div>
	      		  
	      		  <?php }else if($_GET['pesan']=="password_lama_salah"){ ?>
	      		  <div class="alert alert-danger fade in"> 
	      		    <button type="button" class="close pull-right text-white mb-4" data-dismiss="alert" aria-label="Close">
	      		      <span aria-hidden="true">&times;</span>
	      		    </button>
	      		    Passwword Lama Salah
	      		  </div>
	      		  
	      		  <?php } } ?>
	      		<div class="box box-solid">
	      			<div class="box-body">
	      				<h5 class="mb-4">Profile</h5>
			      		<table width="100%" class="table table-responsive-md mb-4">
			      		  <tbody>
			      		  	<tr>
			      		  		<td>NIS</td>
			      		  		<td>:</td>
			      		  		<td><?php echo $array['nis']; ?></td>
			      		  	</tr>
			      		  	<tr>
			      		  		<td>Nama Lengkap</td>
			      		  		<td>:</td>
			      		  		<td><?php echo $array['nama']; ?></td>
			      		  	</tr>
			      		  	<tr>
			      		  		<td>Email</td>
			      		  		<td>:</td>
			      		  		<td><?php echo $array['email']; ?></td>
			      		  	</tr>
			      		  	<tr>
			      		  		<td>Kelas</td>
			      		  		<td>:</td>
			      		  		<td><?php echo $array['nama_kelas']; ?></td>
			      		  	</tr>
			      		  	<tr>
			      		  		<td>Status</td>
			      		  		<td>:</td>
			      		  		<td>
			      		  			<?php
			      		  			    if ($array['status']==1) { ?>
			      		  			    <a href="#" class="btn-success btn-xs" style="text-decoration: none;">Aktif</a>
			      		  			    <?php }else { ?>
			      		  			    <a href="#" class="btn-danger btn-xs" style="text-decoration: none;">Nonaktif</a>
			      		  			<?php } ?>
			      		  		</td>
			      		  	</tr>
			      		  	
			      		  </tbody>
			      		</table>
			      		<div class="row no-print">
			      			<div class="col-xs-12">
			      				<a class="btn btn-success btn-sm text-white pull-right" title="Edit Profile"  data-toggle="modal" data-target="#modaledit"><i class="fa fa-pencil"></i> Edit Profile</a>
			      				<a class="btn btn-danger btn-sm text-white pull-right" title="Ganti Password" data-toggle="modal" data-target="#modalpass" style="margin-right: 5px;"><i class="fa fa-lock"></i> Ganti Password</a>
			      			</div>
			      		</div>
	      			</div>
	      		</div>
	      	</div>
	      	<div class="col-md-3">
	      		
	      	</div>
	      </div>

	      <!-- /.row -->
	    </section>
	   </div>
    <!-- /.content -->
  </div>

    <div class="modal" tabindex="-1" id="modaledit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <b>Edit Profile</b>
             <button type="button" class="close" data-dismiss="modal" >&times;</button>
          </div>
          <div class="modal-body">
            <form method="post" action="edit_profile.php">
                  <div class="form-group">
                      <label>NIS</label>
                      <input type="text" name="nis" required="required" class="form-control" autocomplete="off" readonly value="<?php echo $array['nis']; ?>">
                  </div>
                
                  <div class="form-group">
                    <label >Nama Siswa</label>
                    <input type="text" name="nama" required="required" class="form-control" value="<?php echo $array['nama']; ?>">
                  </div>
                
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required="required" class="form-control" value="<?php echo $array['email']; ?>">
                  </div>
                
                  <div class="form-group">
                    <label>Kelas</label>
                    <input type="text" name="kelas" required="required" class="form-control" value="<?php echo $array['nama_kelas']; ?>" readonly>
                  </div>
                
          </div>
          <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-primary btn-sm "><i class="fa fa-save"></i> Simpan</button>   
          </div>
          </form>
        
      </div>
    </div>
  </div>

    <div class="modal" tabindex="-1" id="modalpass">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <b>Ganti Password</b>
             <button type="button" class="close" data-dismiss="modal" >&times;</button>
          </div>
          <div class="modal-body">
            <form method="post" action="ganti_password.php">
            	  <input type="hidden" name="nis" required="required" value="<?php echo $array['nis']; ?>">
            	  <div class="form-group">
                      <label>Password Lama</label>
                      <input type="password" name="pass_lama" required="required" placeholder="Password Lama" class="form-control">
                  </div>
                  <div class="form-group">
                      <label>Password Baru</label>
                      <input type="password" name="pass_baru" required="required" placeholder="Password Baru" class="form-control">
                  </div>
                  <div class="form-group">
                    <label >Konfirmasi Password</label>
                    <input type="password" name="konfirm" placeholder="Konfirmasi Password" required="required" class="form-control">
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

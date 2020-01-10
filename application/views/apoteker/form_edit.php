<div class="container">
<?php echo form_open('apoteker/update','class="form-horizontal col-md-5" style=" "') ?>
	<div class="panel panel-default">
    <div class="panel-heading"><b>FORM EDIT APOTEKER</b></div>
    <div class="panel-body">   
        <input type="hidden" class="form-control" name="kodeApo" value="<?php echo $editApo['kodeApoteker'] ?>">
      	<div class="form-group">
        	<label class="col-sm-4 control-label">Nama</label>
        	<div class="col-sm-8">
          		<input type="text" class="form-control" name="nama" value="<?php echo $editApo['nama'] ?>">
        	</div>
      	</div>

      	<div class="form-group">
        	<label class="col-sm-4 control-label">Alamat</label>
        	<div class="col-sm-8">
          		<input type="text" class="form-control" name="alamat" value="<?php echo $editApo['alamat'] ?>">
        	</div>
      	</div>


        <div class="form-group">
          <label class="col-sm-4 control-label">Tempat Lahir</label>
          <div class="col-sm-8">
              <input type="text" class="form-control" name="tmpLahir" value="<?php echo $editApo['tempatLahir'] ?>">
          </div>
        </div>

      	<div class="form-group">
        	<label class="col-sm-4 control-label">Tanggal Lahir</label>
        	<div class="col-sm-8">
          		<input type="date" class="form-control" name="tglLahir" value="<?php echo $editApo['tanggalLahir'] ?>">
        	</div>
      	</div>

      	<div class="form-group">
        	<label class="col-sm-4 control-label">Jenis Kelamin</label>
        	<div class="col-sm-8">
          		<select class="form-control" name="j_kel">
          			<option value="L">Laki-laki</option>
          			<option value="P">Perempuan</option>
          		</select>
        	</div>
      	</div>

      	<div class="form-group">
        	<label class="col-sm-4 control-label">Username</label>
        	<div class="col-sm-8">
          		<input type="text" class="form-control" name="username" value="<?php echo $editApo['username'] ?>">
        	</div>
     	  </div>

     	  <div class="form-group">
        	<label class="col-sm-4 control-label">Password</label>
        	<div class="col-sm-8">
          		<input type="password" class="form-control" name="password" value="<?php echo $editApo['password'] ?>">
        	</div>
      	</div>
      	
      
      	<div class="form-group">
        	<div class="col-sm-offset-4 col-sm-8">
          		<input type="submit" name="submit" class="btn btn-primary">
        	</div>
      	</div>
    <?php echo form_close();
   
    ?>
    </div>
  </div>
 
</div>
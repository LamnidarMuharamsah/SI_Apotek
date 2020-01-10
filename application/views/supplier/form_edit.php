<div class="container">
<?php echo form_open('supplier/update','class="form-horizontal col-md-5" style=" "') ?>
	<div class="panel panel-default">
    <div class="panel-heading"><b>FORM EDIT SUPPLIER</b></div>
    <div class="panel-body">   
     <input type="hidden" class="form-control" name="kodeSupp" value="<?php echo $editSupp['kodeSupplier'] ?>">
     
        <div class="form-group">
        	<label class="col-sm-4 control-label">Nama</label>
        	<div class="col-sm-8">
          		<input type="text" class="form-control" name="nama" value="<?php echo $editSupp['nama'] ?>">
        	</div>
      	</div>

      	<div class="form-group">
        	<label class="col-sm-4 control-label">Alamat</label>
        	<div class="col-sm-8">
          		<input type="text" class="form-control" name="alamat" value="<?php echo $editSupp['alamat'] ?>">
        	</div>
      	</div>


        <div class="form-group">
          <label class="col-sm-4 control-label">No Handphone</label>
          <div class="col-sm-8">
              <input type="text" class="form-control" name="noHp" value="<?php echo $editSupp['noHp'] ?>">
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
<div class="container">
<?php echo form_open('obat/update','class="form-horizontal col-md-5" style=" "') ?>
  <div class="panel panel-default">
    <div class="panel-heading"><b>FORM EDIT OBAT</b></div>
    <div class="panel-body">   
        <input type="hidden" class="form-control" name="kodeOb" value="<?php echo $editOba['kodeObat'] ?>">

        <div class="form-group">
          <label class="col-sm-4 control-label">Nama</label>
          <div class="col-sm-8">
              <input type="text" class="form-control" name="nama" value="<?php echo $editOba['nama'] ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4 control-label">Stok</label>
          <div class="col-sm-8">
              <input type="text" class="form-control" name="stok" value="<?php echo $editOba['stok'] ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4 control-label">Expire</label>
          <div class="col-sm-8">
              <input type="date" class="form-control" name="expire" value="<?php echo $editOba['expire'] ?>">
          </div>
        </div>


        <div class="form-group">
          <label class="col-sm-4 control-label">Harga</label>
          <div class="col-sm-8">
              <input type="text" class="form-control" name="harga" value="<?php echo $editOba['harga'] ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4 control-label">Kode Supplier</label>
          <div class="col-sm-8">
              <input type="text" class="form-control" name="kodeSupplier" value="<?php echo $editOba['kodeSupplier'] ?>">
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
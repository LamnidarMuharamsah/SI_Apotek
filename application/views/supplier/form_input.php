
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('supplier/input','class="form-horizontal col-md-5" style=" "') ?>
                        <div class="panel panel-default">
                          <div class="panel-heading"><b>FORM INPUT APOTEKER</b></div>
                          <div class="panel-body">   
                            
                              <div class="form-group">
                                <label class="col-sm-4 control-label">Kode Supplier </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="kodeSupp">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-4 control-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="nama">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-4 control-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="alamat">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-4 control-label">No Handphone</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="noHp">
                                </div>
                              </div>

                            
                              <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <input type="submit" name="submit" class="btn btn-primary">
                                </div>
                              </div>
                          <?php echo form_close(); ?>
                          </div>
                        </div>
                        <?php  $this->load->view('supplier/tampil_data'); ?>
                    </div>
                </div>
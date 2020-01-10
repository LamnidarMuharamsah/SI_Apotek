
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('obat/input','class="form-horizontal col-md-5" style=" "') ?>
                        <div class="panel panel-default">
                          <div class="panel-heading"><b>FORM INPUT OBAT</b></div>
                          <div class="panel-body">   
                            
                             <div class="form-group">
                                <label class="col-sm-4 control-label">Kode Obat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="kodeOb">
                                </div>
                              </div>


                              <div class="form-group">
                                <label class="col-sm-4 control-label">Nama Obat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="nama">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-4 control-label">Stock</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="stok">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-4 control-label">Expire</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="expire">
                                </div>
                              </div>

                             <div class="form-group">
                                <label class="col-sm-4 control-label">Harga</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="harga">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-4 control-label">Kode Supplier</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="kodeSup">
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
                        <?php  $this->load->view('obat/tampil_data'); ?>
                    </div>
                </div>
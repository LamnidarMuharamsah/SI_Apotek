
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('apoteker/input','class="form-horizontal col-md-5" style=" "') ?>
                        <div class="panel panel-default">
                          <div class="panel-heading"><b>FORM INPUT APOTEKER</b></div>
                          <div class="panel-body">   
                            
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
                                <label class="col-sm-4 control-label">Tempat Lahir</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="tmpLahir">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-4 control-label">Tanggal Lahir</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="tglLahir">
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
                                    <input type="text" class="form-control" name="username">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-4 control-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="password">
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
                        <?php  $this->load->view('apoteker/tampil_data'); ?>
                    </div>
                </div>
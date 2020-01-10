<div class="row">	
	<div class="col-md-12">	
	    <div class="table-responsive">
			<table id="dt-table" class="table table-hover dt-responsive display nowrap" cellspacing="0">
				<thead>
					<tr>
						<th>No.</th>
						<th>Kode Obat</th>
						<th>Nama Obat</th>
						<th>Stok</th>
						<th>Expire</th>
						<th>harga</th>
						<th>Kode Supplier</th>
						<th>Satuan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>	
</div>
<!--Modal Tambah Data-->
<div class="modal fade modal-tambah-data" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="gridSystemModalLabel"></h4>
      		</div>
      		<div class="modal-body">
      			<div class="row">
                    <div class="col-lg-6">
                    	<div id="message"></div>
                        <?php echo form_open('obat','id="form" class="form-horizontal col-md-12"') ?>              	 
                          	
                              	<div class="form-group">
                                	<label class="col-sm-4 control-label">Kode Obat</label>
	                                <div class="col-sm-8">
	                                    <input type="text" id="kode" class="form-control" name="kdObat" value="<?php echo $kode ?>">
	                                    <span class="help-block"></span>
	                                </div>
                             	</div>

                             	<div class="form-group">
                                	<label class="col-sm-4 control-label">Nama Obat</label>
	                                <div class="col-sm-8">
	                                    <input type="text" class="form-control" name="nama">
	                                    <span class="help-block"></span>
	                                </div>
                             	</div>

                             	<div class="form-group">
                                	<label class="col-sm-4 control-label">Stok</label>
	                                <div class="col-sm-8">
	                                    <input type="number" class="form-control" name="stok" min=1>
	                                    <span class="help-block"></span>
	                                </div>
                             	</div>

                             	<div class="form-group">
                                	<label class="col-sm-4 control-label">Harga</label>
	                                <div class="col-sm-8">
	                                	<div class="input-group">
      										<div class="input-group-addon">Rp.</div>
	                                    	<input type="text" class="form-control numeric" name="harga">	                                    	
	                                    </div>
	                                    <span class="help-block help-numeric"></span>
	                                </div>
                             	</div>
                             	
                             	<div class="form-group">
                                	<label class="col-sm-4 control-label">Satuan</label>
	                                <div class="col-sm-8">
	                                	<select class="form-control" name="satuan">
										    <option value="">--Pilih Satuan--</option>
										    <option>Botol</option>
										    <option>Kaplet</option>
										    <option>Butir</option>
										    <option>Pot</option>
										    <option>Tube</option>
									    </select>	                                    
	                                    <span class="help-block"></span>
	                                </div>
                             	</div>

                             	<div class="form-group">
	                                <div class="col-sm-offset-4 col-sm-8">
	                                    <input type="submit" name="submit" id="btn-simpan" class="btn btn-primary" onclick="simpan_data()" value="Simpan">
	                                </div>
                              	</div>     	
                             
                    </div>
                    <div class="col-lg-6">
                    	<div class="form-group">
                            <label class="col-sm-4 control-label">Supplier</label>
	                           	<div class="col-sm-8">	                                    
	                               	<select class="form-control" name="kdSupplier">
	                               	<option value="">--Pilih Supplier--</option>
	                               	<?php foreach ($kdSupplier as $kdspl) {
	                               	
	                               	?>										    
									<option value="<?php echo $kdspl['kodeSupplier'] ?>"><?php echo $kdspl['nama']; ?></option>	
									<?php 
										}
									?>									   
								</select>	      
	                               <span class="help-block"></span>
	                           	</div>
                        </div>
                    	<div class="form-group">
                            <label class="col-sm-4 control-label">Expire</label>
	                        <div class="col-sm-8">
	                            <input type="date" class="form-control" name="expire">
	                            <span class="help-block"></span>
	                        </div>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>

      		</div>
    	</div>
  	</div>
</div>
<!--/Modal Tambah Data-->
<script type="text/javascript">
	var save_method;
	var table;
	var modal;
	table = $('#dt-table').DataTable({		            
		"responsive": true,
  		"autoWidth": false,
		"bLengthChange": false,		
		"dom": '<"row"<"col-md-6"<"pull-left"f>><"col-md-6"<"pull-right"<"button">>>>t<"row"<"col-sm-4"i><"col-sm-8"p>>',
		"ajax":{
			"url":"<?php echo site_url('obat/tampil_data') ?>",
			"type":"POST"
		}
	});
	$("div.button").html('<button type="button" class="btn btn-success" onclick="tambah_data()" data-toggle="modal" data-target=".modal-tambah-data">+ Tambah Data</button>');
/*	*/
$(document).ready(function() {	
	//set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');        
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $(".numeric").keypress(function (e) {
     	//if the letter is not digit then display error and don't type anything
     	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $(".numeric").parent().parent().parent().addClass('has-error').show();        
        $(".help-numeric").text("Data Harus Berupa Angka !");   
            return false;
    	}
   	});

});


	function tambah_data()
	{	    
	    save_method = 'tambah';	    
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $('#kode').prop('readonly', true);	    
	    $('.modal-title').text('Tambah Data Obat'); // Set Title to Bootstrap modal title
	}

	function reload_table()
	{
	    table.ajax.reload(null,false); //reload datatable ajax	   
		window.location.reload();			
	}

	function simpan_data(){
		$('#btn-simpan').text('saving...');
    	$('#btn-simpan').attr('disabled',true);
    	var url;    	
 
	    if(save_method == 'tambah'){
	        url = "<?php echo site_url('obat/ajax_input')?>";
	    }else{
	        url = "<?php echo site_url('obat/ajax_update')?>";
	    }

		$.ajax({
	        url : url,
	        type: "POST",
	        data: $('#form').serialize(),
	        dataType: "JSON",
	        success: function(data){
	 
	            if(data.status) //if success close modal and reload ajax table
	            {
	            	//alert('Data Berhasil Di Simpan');

	            	$('.modal-tambah-data').modal('hide');
	            	           	
	                reload_table();
	               
	            }else{
	                for (var i = 0; i < data.inputerror.length; i++){
	                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
	                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
	                }
	                $('[name="harga"]').parent().parent().parent().addClass('has-error');
	                $('.help-numeric').text(data.error_string[4]);
	            }
	            $('#btn-simpan').text('save'); //change button text
	            $('#btn-simpan').attr('disabled',false); //set button enable 
	 
	 
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error adding / update data');
	            $('#btn-simpan').text('save'); //change button text
	            $('#btn-simpan').attr('disabled',false); //set button enable 
	 
	        }
	    });
	}

	function edit_data(kodeObat){
	    save_method = 'update';
	    $('#form')[0].reset(); // reset form on modals
	    $('#kode').prop('readonly', true);	  
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	 
	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo site_url('obat/ajax_edit/')?>" + kodeObat,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
	 
	            $('[name="kdObat"]').val(data.kodeObat);
	            $('[name="nama"]').val(data.nama);
	            $('[name="stok"]').val(data.stok);
	            $('[name="expire"]').val(data.expire);
	            $('[name="harga"]').val(data.harga);
	            $('[name="kdSupplier"]').val(data.kodeSupplier);
	            $('[name="satuan"]').val(data.satuan);	            
	            $('.modal-tambah-data').modal('show'); // show bootstrap modal when complete loaded
	            $('.modal-title').text('Edit Data Obat'); // Set Title to Bootstrap modal title
	 
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
	}

	function hapus_data(kodeObat)
	{
	    if(confirm('Anda yakin akan menghapus data dengan kode ' + kodeObat + ' ?'))
	    {
	        // ajax delete data to database
	        $.ajax({
	            url : "<?php echo site_url('obat/ajax_delete')?>/" + kodeObat,
	            type: "POST",
	            dataType: "JSON",
	            success: function(data)
	            {
	                //if success reload ajax table
	                $('.modal-tambah-data').modal('hide');
	                reload_table();
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Error deleting data');
	            }
	        });
	 
	    }
	}

</script>
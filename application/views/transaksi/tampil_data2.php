<div class="row">	
	<div class="col-md-12">	
	    <div class="table-responsive">
			<table id="dt-table" class="table table-hover dt-responsive display nowrap" cellspacing="0">
				<thead>
					<tr>
						<th>No.</th>
						<th>Kode Transaksi</th>
						<th>Tanggal Transaksi</th>
						<th>Kode Apoteker</th>
						<th>Kode Obat</th>
						<th>Stok</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Total</th>
						<th>Proses</th>						
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
      				<?php echo form_open('transaksi','id="form" class="col-md-12"') ?>            
                    <div class="col-lg-6 sr-only">
                    	<div id="message"></div>
                          	 
                          	
                              	<div class="form-group">
                                	<label class="control-label">Kode Transaksi</label>
	                                <div class="">
	                                    <input type="text" id="kode" class="form-control" name="kdTransaksi" value="<?php echo $kode ?>">
	                                    <span class="help-block"></span>
	                                </div>
                             	</div>

                             	<div class="form-group">
                                	<label class=" control-label">Tanggal Transaksi</label>
	                                <div class="">
	                                    <input id="date" type="text" class="form-control" name="tglTransaksi" >
	                                    <span class="help-block"></span>
	                                </div>
                             	</div>

                             	<div class="form-group">
                                	<label class=" control-label">Kode Apoteker</label>
	                                <div class="">
	                                    <input type="text" class="form-control" name="kdApoteker" value="<?php echo $this->session->userdata('kodeApoteker') ?>">
	                                    <span class="help-block"></span>
	                                </div>
                             	</div>                              	

                    </div>
                    <div id="add-row-field" class="col-lg-12">
                    	<div id="message"></div>
                    	
                    	<div class="row">
                    		<div class="col-md-3">
                    			<div class="form-group">
                                	<label class=" control-label">Kode Obat</label>
	                                <div class="">
	                                    <input type="text" class="form-control" name="kdObat">
	                                    <span class="help-block"></span>
	                                </div>
                             	</div>
							</div>

							<div class="col-md-3">
                             	<div class="form-group">
                                	<label class=" control-label">Harga</label>
	                                <div class="">
	                                    <input type="text" class="form-control" name="harga">
	                                    <span class="help-block"></span>
	                                </div>
                             	</div>
                            </div>

                            <div class="col-md-3">
                             	<div class="form-group">
                                	<label class=" control-label">Jumlah</label>
	                                <div class="">
	                                    <input type="text" class="form-control" name="jumlah">
	                                    <span class="help-block"></span>
	                                </div>
                             	</div>
                            </div>

                            <div class="col-md-3">	
                             	<div class="form-group">
                                	<label class=" control-label">Total</label>
	                                <div class="">
	                                    <input type="text" class="form-control" name="total">
	                                    <span class="help-block"></span>
	                                </div>
                             	</div>
                            </div>
                        </div>    	
                    </div>  

                    <div class="col-md-6 col-md-offset-6">
                    		<div class="form-group">
	                            <div class="pull-right">
	                                <input type="submit" name="submit" id="btn-simpan" class="btn btn-primary" onclick="simpan_data()" value="Simpan">
	                            </div>
                             </div>
                    </div>
                    <?php echo form_close(); ?>

                </div><hr>
                <div class="row">
                	<div class="col-md-12">	
					    <div class="table-responsive">
							<table id="dt-table-obat" class="table table-hover dt-responsive display nowrap" cellspacing="0">
								<thead>
									<tr>
										<th><input type="checkbox" id="pilih-semua"></th>
										<th>No.</th>
										<th>Kode Obat</th>
										<th>Nama Obat</th>
										<th>Stok</th>
										<th>Expire</th>
										<th>harga</th>
										<th>Kode Supplier</th>
										<th>Satuan</th>
										
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
                </div>	

      		</div>
    	</div>
  	</div>
</div>
<script type="text/javascript">
	var save_method;
	var table;
	var modal;
	table = $('#dt-table').DataTable({		            
		"responsive": true,
  		"autoWidth": false,
		"bLengthChange": false,		
		"dom": '<"row"<"col-md-6"<"pull-left"f>><"col-md-6"<"pull-right"<"button">>>>t<"row"<"col-md-4"i><"col-sm-8"p>>',
		"ajax":{
			"url":"<?php echo site_url('transaksi/tampil_data') ?>",
			"type":"POST"
		}
	});
	$("div.button").html('<button type="button" class="btn btn-success" onclick="tambah_data()" data-toggle="modal" data-target=".modal-tambah-data">+ Tambah Data</button>');

	var table_obat = $('#dt-table-obat').DataTable({		            
		"responsive": true,
  		"autoWidth": false,
		"bLengthChange": false,
		"ordering": false,
		"iDisplayLength": 3,		
		"dom": '<"row"<"col-md-6"<"pull-left"f>><"col-md-6"<"pull-right"<"button-obat">>>>t<"row"<"col-sm-4"i><"col-sm-8"p>>',
		"ajax":{
			"url":"<?php echo site_url('transaksi/tampil_data_obat') ?>",
			"type":"POST"
		}
	});
	$("div.button-obat").html('<button type="button" class="btn btn-success" onclick="field_obat()">+ Tambah Obat</button>');
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

   
});

/*	*/
	

	function tambah_data()
	{	    
	    save_method = 'tambah';	    
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string	   
	    $('.modal-title').text('Tambah Data Transaksi'); // Set Title to Bootstrap modal title
	    $('#kode').prop('readonly', true);
	    $('[name="tglTransaksi"]').prop('readonly', true);
	    $('[name="kdApoteker"]').prop('readonly', true);
	    set_date();
	    field_obat();  
	}

	function reload_table()
	{
	    table.ajax.reload(null,false); //reload datatable ajax	   
		window.location.reload();			
	}

	function set_date(){
	    var now = new Date();

		var day = ("0" + now.getDate()).slice(-2);
		var month = ("0" + (now.getMonth() + 1)).slice(-2);

		var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

		$('#date').val(today);
	}

	$("#pilih-semua").click(function () {
        $(".data-check").prop('checked', $(this).prop('checked'));
    });

   function field_obat(){   			
	    $(".data-check").change(function() {	           
	        if(this.checked) {
	            $('#add-row-field').append('\
			        <div class="row append-row">\
			          	<div class="col-md-3">\
                    		<div class="form-group">\
                                <label class=" control-label">Kode Obat</label>\
	                            <div class="">\
	                                <input type="text" class="form-control" name="kdObat">\
	                                <span class="help-block"></span>\
	                            </div>\
                            </div>\
						</div>\
						<div class="col-md-3">\
                    		<div class="form-group">\
                                <label class=" control-label">Harga</label>\
	                                <div class="">\
	                                    <input type="text" class="form-control" name="harga">\
	                                <span class="help-block"></span>\
	                            </div>\
                            </div>\
						</div>\
						<div class="col-md-3">\
                    		<div class="form-group">\
                                <label class=" control-label">Jumlah</label>\
	                                <div class="">\
	                                    <input type="text" class="form-control" name="jumlah">\
	                                <span class="help-block"></span>\
	                            </div>\
                            </div>\
						</div>\
						<div class="col-md-3">\
                    		<div class="form-group">\
                                <label class=" control-label">Total</label>\
	                                <div class="">\
	                                    <input type="text" class="form-control" name="total">\
	                                <span class="help-block"></span>\
	                            </div>\
                            </div>\
						</div>\
			        </div>');
	        }else{
      			$('.append-row').remove();
      		}     	
	    });
   }

	function pilih_obat()
	{
	    var list_id = [];
	    $(".data-check:checked").each(function() {
	            list_id.push(this.value);	           
	    });
	    if(list_id.length > 0)
	    {
	        if(confirm('Are you sure delete this '+list_id.length+' data?'))
	        {
	            $.ajax({
	                type: "POST",
	                data: {id:list_id},
	                url: "<?php echo site_url('transaksi/ajax_bulk_delete')?>",
	                dataType: "JSON",
	                success: function(data)
	                {
	                    if(data.status)
	                    {
	                        reload_table();
	                    }
	                    else
	                    {
	                        alert('Failed.');
	                    }
	                     
	                },
	                error: function (jqXHR, textStatus, errorThrown)
	                {
	                    alert('Error deleting data');
	                }
	            });
	        }
	    }
	    else
	    {
	        alert('no data selected');
	    }
	}

	function simpan_data(){
		$('#btn-simpan').text('saving...');
    	$('#btn-simpan').attr('disabled',true);
    	var url;    	
 
	    if(save_method == 'tambah'){
	        url = "<?php echo site_url('transaksi/ajax_input')?>";
	    }else{
	        url = "<?php echo site_url('transaksi/ajax_update')?>";
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

</script>
<div class="row">	
	<div class="col-md-12">	
	    <div class="table-responsive">
			<table id="dt-table" class="table table-hover dt-responsive display nowrap" cellspacing="0">
				<thead>
					<tr>
						<th>No.</th>
						<th>Kode Apoteker</th>
						<th>Nama Apoteker</th>						
						<th>Alamat</th>
						<th>Username</th>						
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
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="gridSystemModalLabel"></h4>
      		</div>
      		<div class="modal-body">
      			<div class="row">
                    <div class="col-lg-12">
                    	<div id="message"></div>
                        <?php echo form_open('supplier','id="form" class="form-horizontal col-md-12"') ?>              	 
                          	
                              	<div class="form-group">
                                	<label class="col-sm-4 control-label">Kode Supplier</label>
	                                <div class="col-sm-8">
	                                    <input type="text" id="kode" class="form-control" name="kdSupplier" value="<?php echo $kode ?>">
	                                    <span class="help-block"></span>
	                                </div>
                             	</div>

                             	<div class="form-group">
                                	<label class="col-sm-4 control-label">Nama</label>
	                                <div class="col-sm-8">
	                                    <input type="text" class="form-control" name="nama">
	                                    <span class="help-block"></span>
	                                </div>
                             	</div>                             	

                             	<div class="form-group">
                                	<label class="col-sm-4 control-label">Alamat</label>
	                                <div class="col-sm-8">
	                                	<textarea class="form-control" name="almt" rows="3"></textarea>	                                    
	                                    <span class="help-block"></span>
	                                </div>
                             	</div>

                             	<div class="form-group">
                                	<label class="col-sm-4 control-label">No. Handphone</label>
	                                <div class="col-sm-8">
	                                    <input type="text" class="form-control" name="noHp">
	                                    <span class="help-block"></span>
	                                </div>
                             	</div>
                             	
                             	<div class="form-group">
	                                <div class="col-sm-offset-4 col-sm-8">
	                                    <input type="submit" name="submit" id="btn-simpan" class="btn btn-primary" onclick="simpan_data()" value="Simpan">
	                                </div>
                              	</div>                      
                          	
                        
                         <?php echo form_close(); ?>
                    </div>
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
			"url":"<?php echo site_url('supplier/tampil_data') ?>",
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
});



	function tambah_data()
	{	    
	    save_method = 'tambah';	    
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	    $('#kode').prop('readonly', true);	    
	    $('.modal-title').text('Tambah Data Supplier'); // Set Title to Bootstrap modal title
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
	        url = "<?php echo site_url('supplier/ajax_input')?>";
	    }else{
	        url = "<?php echo site_url('supplier/ajax_update')?>";
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

	function edit_data(kodeSupplier){
	    save_method = 'update';
	    $('#form')[0].reset(); // reset form on modals
	    $('#kode').prop('readonly', true);	  
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
	 
	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo site_url('supplier/ajax_edit/')?>" + kodeSupplier,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
	 
	            $('[name="kdSupplier"]').val(data.kodeSupplier);
	            $('[name="nama"]').val(data.nama);	            
	            $('[name="almt"]').val(data.alamat);
	            $('[name="noHp"]').val(data.noHp);	                  
	            $('.modal-tambah-data').modal('show'); // show bootstrap modal when complete loaded
	            $('.modal-title').text('Edit Data Supplier'); // Set Title to Bootstrap modal title
	 
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
	}

	function hapus_data(kodeSupplier)
	{
	    if(confirm('Anda yakin akan menghapus data dengan kode ' + kodeSupplier + ' ?'))
	    {
	        // ajax delete data to database
	        $.ajax({
	            url : "<?php echo site_url('supplier/ajax_delete')?>/" + kodeSupplier,
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
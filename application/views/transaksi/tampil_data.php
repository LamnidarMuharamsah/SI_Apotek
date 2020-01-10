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
<div class="modal fade modal-tambah-data" role="dialog">
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
                    <div class="col-lg-12">
					    <div class="table-responsive">
							<table id="table-transaksi" class="table table-bordered table-hover dt-responsive display nowrap" cellspacing="0">
								<thead>
									<tr>
										<th>No.</th>						
										<th>Kode Obat</th>										
										<th>Harga</th>
										<th>Jumlah</th>
										<th>Sub Total</th>
										<th>Proses</th>						
									</tr>
								</thead>
								<tbody id="row-transaksi">
								<input type="text" id="kode" class="form-control" name="kdTransaksi" value="<?php echo $kode ?>">
									
								</tbody>
								
							</table>
						</div>
                    </div>                

                    <div class="col-md-6 col-md-offset-6">
                    		<div class="form-group">
	                            <div class="pull-right">
	                                <input type="button" name="submit" id="btn-simpan" class="btn btn-primary" onclick="simpan_transaksi()" value="Simpan">
	                            </div>
                             </div>
                    </div>
                    <?php echo form_close(); ?>

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

	function set_date(){
	    var now = new Date();

		var day = ("0" + now.getDate()).slice(-2);
		var month = ("0" + (now.getMonth() + 1)).slice(-2);

		var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

		$('#date').val(today);
	}

	function reload_table()
	{
	    table.ajax.reload(null,false); //reload datatable ajax	   
		$('#form').trigger('reset');		
	}

	function tambah_data(){	    
	    save_method = 'tambah';	    
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string	   
	    $('.modal-title').text('Tambah Data Transaksi'); // Set Title to Bootstrap modal title
	    $('#kode').prop('readonly', true);
	    $('[name="tglTransaksi"]').prop('readonly', true);
	    $('[name="kdApoteker"]').prop('readonly', true);
	    set_date();
	    reset_transaksi();  
	}

	function tambah_transaksi() {

		$('#row-transaksi').append('\
			<tr>\
				<td></td>\
				<td><select id="obat-select2" class="form-control" name="kdObat[]"></select></td>\
				<td><input type="text" id="harga" class="form-control" name="harga[]"></td>\
				<td><input type="text" class="form-control" name="jumlah[]"></td>\
				<td><input type="text" class="form-control" name="subTotal[]"></td>\
				<td><button type="button" class="btn btn-xs btn-primary" id="tambahTrx" onclick="tambah_transaksi()">+</button>&nbsp;<button type="button" class="btn btn-xs btn-danger" id="tambahTrx" onclick="hapus_transaksi(this)">-</button></td>\
			</tr>');
	}

	function reset_transaksi() {
		$('#table-transaksi').html('\
			<thead><tr><th>No.</th><th>Kode Obat</th><th>Harga</th><th>Jumlah</th><th>Sub Total</th><th>Proses</th></tr></thead>\
			<tbody id="row-transaksi">\
			<tr>\
				<td></td>\
				<td><select id="obat-select2" class="form-control" name="kdObat[]"></select></td>\
				<td><input type="text" id="harga" class="form-control"  name="harga[]"></td>\
				<td><input type="text" class="form-control" name="jumlah[]"></td>\
				<td><input type="text" class="form-control" name="subTotal[]"></td>\
				<td><button type="button" id="tambahTrx" class="btn btn-xs btn-primary" onclick="tambah_transaksi()">+</button>&nbsp;<button type="button" id="tambahTrx" class="btn btn-xs btn-danger" onclick="hapus_transaksi(this)">-</button></td>\
			</tr>\
			</tbody>');
		set_date();
		select2_obat();

	}


	function hapus_transaksi(el) {
		$(el).parent().parent().remove();
		console.log(el);
	}
	function simpan_transaksi() {
		$.ajax({
	        type: "POST",
	        url: "<?php echo site_url('transaksi/ajax_input')?>",
	        data: $('#form').serialize(),	        
	        dataType: "JSON",
	        success: function(data)
	        {
	            if(data.status){
	                alert('berhasil');
	                reload_table();
	                reset_transaksi();
	                $('#kode').val(data.kode);
	                
	                //$('#form').trigger('reset');

	            }else{
	                alert('Failed.');
	            }   
	        }
	    });
	    console.log($('[name="kdTransaksi"]').val());
	    console.log($('[name="tglTransaksi"]').val());
	    console.log($('[name="kdApoteker"]').val());
	    console.log($('[name="kdObat[]"]').val());
	    console.log($('[name="jumlah[]"]').val());
	    console.log($('[name="subTotal[]"]').val());
	}

	function select2_obat () {
		//$('#obat-select2').each(function(){			
			$('#obat-select2').select2({
				drowdownAutoWidth: false,
				placeholder: 'Pilih Obat',
				allowClear: true,
				minimumInputLength: 1,		
				ajax: {
					dataType: 'JSON',
					url:"<?php echo site_url('transaksi/get_data_obat') ?>",					
					delay: 250,
					data: function (params) {
		                return {
		                    kode : params.term
		                };
		                
		            },
					processResults: function (data){
						// var hasil = [];
						// console.log(data);
						// $.each(data, function(index, item){
						// 	hasil.push({
						// 		id: item.kodeObat,
						// 		text: item.kodeObat + ' - ' + item.nama+"jj"
						// 	});
						// });
						return {
							results: $.map(data, function(item){
								return{
									text: item.kodeObat + ' - ' +item.nama,
									id: item.kodeObat,
									sHarga : item.harga
								};
							})	
						};
					},
					cache:true

				}
			});
			
		//});
		
	}
		$('#obat-select2').change(function(e) { 		    
		    var hargaObat = ;
		    
		    $('#harga').val(hargaObat);
		});


</script>
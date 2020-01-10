<?php 
/**
* 
*/
class Obat extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("obat_model");
		$this->load->model("supplier_model");
	}

	function index(){
			
		$data['view'] = '';
		$data['page'] = 'Data Obat';
		$data['content'] = 'Olah Data';
		$data['kode'] = $this->obat_model->max_kode();
		$data['kdSupplier'] = $this->supplier_model->tampil_data();
		$this->load->view("obat_view",$data);
	}

	function tampil_data(){
		$tampil_obat = $this->obat_model->tampil_data();
		$data = array();
		$i=1;
		foreach ($tampil_obat as $rows) {
			array_push($data,
				array(
					$i,
					$rows['kodeObat'],
					$rows['nama'],
					$rows['stok'],
					$rows['expire'],
					$rows['harga'],
					$rows['kodeSupplier'],
					$rows['satuan'],
					'<a class="btn btn-xs btn-primary" href="javascript:void(0)" onclick="edit_data('."'".$rows['kodeObat']."'".')">Ubah</a>
					<a class="btn btn-xs btn-danger" href="javascript:void(0)" onclick="hapus_data('."'".$rows['kodeObat']."'".')">Hapus</a>'
										
				)
			);
			$i++;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));

	}

	private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('kdObat') == '')
        {
            $data['inputerror'][] = 'kdObat';
            $data['error_string'][] = 'Field Ini Harus Di Isi !';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('nama') == '')
        {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Field Ini Harus Di Isi !';
            $data['status'] = FALSE;
        }

        if($this->input->post('stok') == '')
        {
            $data['inputerror'][] = 'stok';
            $data['error_string'][] = 'Field Ini Harus Di Isi !';
            $data['status'] = FALSE;
        }

        if($this->input->post('expire') == '')
        {
            $data['inputerror'][] = 'expire';
            $data['error_string'][] = 'Field Ini Harus Di Isi !';
            $data['status'] = FALSE;
        }

        if($this->input->post('harga') == '')
        {
            $data['inputerror'][] = 'harga';
            $data['error_string'][] = 'Field Ini Harus Di Isi !';
            $data['status'] = FALSE;
        }

        if($this->input->post('kdSupplier') == '')
        {
            $data['inputerror'][] = 'kdSupplier';
            $data['error_string'][] = 'Field Ini Harus Di Isi !';
            $data['status'] = FALSE;
        }

        if($this->input->post('satuan') == '')
        {
            $data['inputerror'][] = 'satuan';
            $data['error_string'][] = 'Field Ini Harus Di Isi !';
            $data['status'] = FALSE;
        } 
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

	public function ajax_input(){
        $this->_validate();
        $data = array(
                'kodeObat' => $this->input->post('kdObat'),
				'nama' => $this->input->post('nama'),
				'stok' => $this->input->post('stok'),
				'expire' => $this->input->post('expire'),
				'harga' => $this->input->post('harga'),
				'kodeSupplier' => $this->input->post('kdSupplier'),
				'satuan' => $this->input->post('satuan')                 
            );
        $insert = $this->obat_model->input($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update(){
	    $this->_validate();
	    $data = array(
            	'kodeObat' => $this->input->post('kdObat'),
				'nama' => $this->input->post('nama'),
				'stok' => $this->input->post('stok'),
				'expire' => $this->input->post('expire'),
				'harga' => $this->input->post('harga'),
				'kodeSupplier' => $this->input->post('kdSupplier'),
				'satuan' => $this->input->post('satuan')               
        );
	    $this->obat_model->update(array('kodeObat' => $this->input->post('kdObat')), $data);
	    echo json_encode(array("status" => TRUE));
	}
 

    public function ajax_edit($id)
    {
        $data = $this->obat_model->get_data_edit($id);        
        echo json_encode($data);
    }

    public function ajax_delete($id){	   
	    $this->obat_model->delete($id);
	    echo json_encode(array("status" => TRUE));
	}
 

	function input(){
		$validasi = array(
				array(
					'field'=>'kdKadaluarsa',
					'label'=>'Kode Kadaluarsa',
					'rules'=>'required'
				),
				array(
					'field'=>'nama',
					'label'=>'Tanggal Kadaluarsa',
					'rules'=>'required'
				)
			);
		$this->form_validation->set_rules($validasi);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$info['message']="Data Berhasil Ditambahkan";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
/*


	function input(){
		$data['view'] = 'input';
		$data['obat'] = $this->obat_model->tampil();
		$this->load->view("obat_view",$data);
		if ($this->input->post("submit")) {
			$input = $this->obat_model->input();
			if (!$input)
				echo "Gagal Input";
			else
				redirect('obat');			
		}
	}

	function hapus($kode){
		$query = $this->obat_model->delete($kode);
		if($query)
			redirect('obat');
		else
			echo "gagal hapus";
	}

	function edit($kode){
		$data['view'] = 'edit';
		$data['editOba'] = $this->obat_model->edit($kode);
		$data['obat'] = $this->obat_model->tampil();
		$this->load->view('obat_view',$data);
	}

	function update(){
		if ($this->input->post("submit")) {
			$input = $this->obat_model->update();
			if (!$input)
				echo "Gagal Update";
			else
				redirect('obat');			
		}
	}
*/
}
?>
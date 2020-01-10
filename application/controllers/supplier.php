<?php 
/**
* 
*/
class Supplier extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("supplier_model");
	}

	function index(){				
		$data['view'] = '';
		$data['page'] = 'Data Supplier';
		$data['content'] = 'Olah Data';
		$data['kode'] = $this->supplier_model->max_kode();
		$this->load->view("supplier_view",$data);
	}

	function tampil_data(){
		$tampil_supplier = $this->supplier_model->tampil_data();
		$data = array();
		$i=1;
		foreach ($tampil_supplier as $rows) {
			array_push($data,
				array(
					$i,
					$rows['kodeSupplier'],
					$rows['nama'],					
					$rows['alamat'],
					$rows['noHp'],					
					'<a class="btn btn-xs btn-primary" href="javascript:void(0)" onclick="edit_data('."'".$rows['kodeSupplier']."'".')">Ubah</a>
					<a class="btn btn-xs btn-danger" href="javascript:void(0)" onclick="hapus_data('."'".$rows['kodeSupplier']."'".')">Hapus</a>'
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
 
        if($this->input->post('kdSupplier') == '')
        {
            $data['inputerror'][] = 'kdSupplier';
            $data['error_string'][] = 'Field Ini Harus Di Isi !';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('nama') == '')
        {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Field Ini Harus Di Isi !';
            $data['status'] = FALSE;
        }

        if($this->input->post('almt') == '')
        {
            $data['inputerror'][] = 'almt';
            $data['error_string'][] = 'Field Ini Harus Di Isi !';
            $data['status'] = FALSE;
        }

        if($this->input->post('noHp') == '')
        {
            $data['inputerror'][] = 'noHp';
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
                'kodeSupplier' => $this->input->post('kdSupplier'),
				'nama' => $this->input->post('nama'),				
				'alamat' => $this->input->post('almt'),
				'noHp' => $this->input->post('noHp')				         
            );
        $insert = $this->supplier_model->input($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update(){
	    $this->_validate();
	    $data = array(
            	'kodeSupplier' => $this->input->post('kdSupplier'),
				'nama' => $this->input->post('nama'),				
				'alamat' => $this->input->post('almt'),
				'noHp' => $this->input->post('noHp'),				             
        );
	    $this->supplier_model->update(array('kodeSupplier' => $this->input->post('kdSupplier')), $data);
	    echo json_encode(array("status" => TRUE));
	}
 
    public function ajax_edit($id)
    {
        $data = $this->supplier_model->get_data_edit($id);        
        echo json_encode($data);
    }

    public function ajax_delete($id){	   
	    $this->supplier_model->delete($id);
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
		$data['supplier'] = $this->supplier_model->tampil();
		$this->load->view("supplier_view",$data);
		if ($this->input->post("submit")) {
			$input = $this->supplier_model->input();
			if (!$input)
				echo "Gagal Input";
			else
				redirect('supplier');			
		}
	}

	function hapus($kode){
		$query = $this->supplier_model->delete($kode);
		if($query)
			redirect('supplier');
		else
			echo "gagal hapus";
	}

	function edit($kode){
		$data['view'] = 'edit';
		$data['editSupp'] = $this->supplier_model->edit($kode);
		$data['supplier'] = $this->supplier_model->tampil();
		$this->load->view('supplier_view',$data);
	}

	function update(){
		if ($this->input->post("submit")) {
			$input = $this->supplier_model->update();
			if (!$input)
				echo "Gagal Update";
			else
				redirect('apoteker');			
		}
	}
*/
}
?>
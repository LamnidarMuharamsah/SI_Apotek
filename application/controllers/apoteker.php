<?php 
/**
* 
*/
class Apoteker extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("apoteker_model");
	}

	function index(){

		$data['view'] = '';
		$data['page'] = 'Data Apoteker';
		$data['content'] = 'Olah Data';
		$data['kode'] = $this->apoteker_model->max_kode();
		$this->load->view("apoteker_view",$data);
	}

	function tampil_data(){
		$tampil_apoteker = $this->apoteker_model->tampil_data();
		$data = array();
		$i=1;
		foreach ($tampil_apoteker as $rows) {
			array_push($data,
				array(
					$i,
					$rows['kodeApoteker'],
					$rows['nama'],
					$rows['tempatLahir'],
					$rows['tanggalLahir'],
					$rows['alamat'],
					$rows['username'],
					$rows['password'],
					'<a class="btn btn-xs btn-primary" href="javascript:void(0)" onclick="edit_data('."'".$rows['kodeApoteker']."'".')">Ubah</a>
					<a class="btn btn-xs btn-danger" href="javascript:void(0)" onclick="hapus_data('."'".$rows['kodeApoteker']."'".')">Hapus</a>'
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
 
        if($this->input->post('kdApoteker') == '')
        {
            $data['inputerror'][] = 'kdApoteker';
            $data['error_string'][] = 'Field Ini Harus Di Isi !';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('nama') == '')
        {
            $data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Field Ini Harus Di Isi !';
            $data['status'] = FALSE;
        }

        if($this->input->post('tmpLahir') == '')
        {
            $data['inputerror'][] = 'tmpLahir';
            $data['error_string'][] = 'Field Ini Harus Di Isi !';
            $data['status'] = FALSE;
        }

        if($this->input->post('tglLahir') == '')
        {
            $data['inputerror'][] = 'tglLahir';
            $data['error_string'][] = 'Field Ini Harus Di Isi !';
            $data['status'] = FALSE;
        }

        if($this->input->post('almt') == '')
        {
            $data['inputerror'][] = 'almt';
            $data['error_string'][] = 'Field Ini Harus Di Isi !';
            $data['status'] = FALSE;
        }

        if($this->input->post('username') == '')
        {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Field Ini Harus Di Isi !';
            $data['status'] = FALSE;
        }

        if($this->input->post('pass') == '')
        {
            $data['inputerror'][] = 'pass';
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
                'kodeApoteker' => $this->input->post('kdApoteker'),
				'nama' => $this->input->post('nama'),
				'tempatLahir' => $this->input->post('tmpLahir'),
				'tanggalLahir' => $this->input->post('tglLahir'),
				'alamat' => $this->input->post('almt'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('pass'))                 
            );
        $insert = $this->apoteker_model->input($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update(){
	    $this->_validate();
	    $data = array(
            	'kodeApoteker' => $this->input->post('kdApoteker'),
				'nama' => $this->input->post('nama'),
				'tempatLahir' => $this->input->post('tmpLahir'),
				'tanggalLahir' => $this->input->post('tglLahir'),
				'alamat' => $this->input->post('almt'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('pass'))                
        );
	    $this->apoteker_model->update(array('kodeApoteker' => $this->input->post('kdApoteker')), $data);
	    echo json_encode(array("status" => TRUE));
	}
 

    public function ajax_edit($id)
    {
        $data = $this->apoteker_model->get_data_edit($id);        
        echo json_encode($data);
    }

    public function ajax_delete($id){	   
	    $this->apoteker_model->delete($id);
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
		$data['apoteker'] = $this->apoteker_model->tampil();
		$this->load->view("apoteker_view",$data);
		if ($this->input->post("submit")) {
			$input = $this->apoteker_model->input();
			if (!$input)
				echo "Gagal Input";
			else
				redirect('apoteker');			
		}
	}

	function hapus($kode){
		$query = $this->apoteker_model->delete($kode);
		if($query)
			redirect('apoteker');
		else
			echo "gagal hapus";
	}

	function edit($kode){
		$data['view'] = 'edit';
		$data['editApo'] = $this->apoteker_model->edit($kode);
		$data['apoteker'] = $this->apoteker_model->tampil();
		$this->load->view('apoteker_view',$data);
	}

	function update(){
		if ($this->input->post("submit")) {
			$input = $this->apoteker_model->update();
			if (!$input)
				echo "Gagal Update";
			else
				redirect('apoteker');			
		}
	}
*/
}
?>
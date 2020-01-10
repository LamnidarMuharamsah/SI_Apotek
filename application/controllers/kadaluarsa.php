<?php 
/**
* 
*/
class Kadaluarsa extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('kadaluarsa_model');
	}

	function index(){
		$data['page'] = 'Data Kadaluarsa Obat';
		$data['content'] = 'Olah Data';
		$data['kode'] = $this->kadaluarsa_model->max_kode();
		$this->load->view('kadaluarsa_view', $data);
	}

	function tampil_data(){
		$tampil_kadaluarsa = $this->kadaluarsa_model->tampil_data();
		$data = array();
		$i=1;
		foreach ($tampil_kadaluarsa as $rows) {
			array_push($data,
				array(
					$i,
					$rows['kodeKadaluarsa'],
					$rows['tglKadaluarsa'],
					'<a class="btn btn-xs btn-primary" href="javascript:void(0)" onclick="edit_data('."'".$rows['kodeKadaluarsa']."'".')">Ubah</a>
					<a class="btn btn-xs btn-danger" href="javascript:void(0)" onclick="hapus_data('."'".$rows['kodeKadaluarsa']."'".')">Hapus</a>'
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
 
        if($this->input->post('kdKadaluarsa') == '')
        {
            $data['inputerror'][] = 'kdKadaluarsa';
            $data['error_string'][] = 'Kode Kadaluarsa Harus Di Isi !';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('tglKadaluarsa') == '')
        {
            $data['inputerror'][] = 'tglKadaluarsa';
            $data['error_string'][] = 'Tanggal Kadaluarsa Harus Di Isi !';
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
                'kodeKadaluarsa' => $this->input->post('kdKadaluarsa'),
                'tglKadaluarsa' => $this->input->post('tglKadaluarsa')                
            );
        $insert = $this->kadaluarsa_model->input($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update(){
	    $this->_validate();
	    $data = array(
            'kodeKadaluarsa' => $this->input->post('kdKadaluarsa'),
            'tglKadaluarsa' => $this->input->post('tglKadaluarsa')                
        );
	    $this->kadaluarsa_model->update(array('kodeKadaluarsa' => $this->input->post('kdKadaluarsa')), $data);
	    echo json_encode(array("status" => TRUE));
	}
 

    public function ajax_edit($id)
    {
        $data = $this->kadaluarsa_model->get_data_edit($id);        
        echo json_encode($data);
    }

    public function ajax_delete($id){	   
	    $this->kadaluarsa_model->delete($id);
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
					'field'=>'tglKadaluarsa',
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
}
?>
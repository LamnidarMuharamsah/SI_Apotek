<?php 
/**
* 
*/
class Transaksi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("transaksi_model");
		$this->load->model("obat_model");
	}

	function index(){

		$data['view'] = '';
		$data['page'] = 'Data Transaksi';
		$data['content'] = 'Penjualan';
		$data['kode'] = $this->transaksi_model->max_kode();
		$this->load->view("transaksi_view",$data);
	}

	function tampil_data(){
		$tampil_transaksi = $this->transaksi_model->tampil_data();
		$data = array();
		$i=1;
		foreach ($tampil_transaksi as $rows) {
			array_push($data,
				array(
					$i,
					$rows['kodeTransaksi'],
					$rows['tanggalTransaksi'],
					$rows['kodeApoteker'],
					$rows['kodeObat'],
					$rows['stok'],
					$rows['harga'],
					$rows['jumlah'],
					$rows['total'],										
					'<a class="btn btn-xs btn-primary" href="javascript:void(0)" onclick="edit_data('."'".$rows['kodeTransaksi']."'".')">Ubah</a>
					<a class="btn btn-xs btn-danger" href="javascript:void(0)" onclick="hapus_data('."'".$rows['kodeTransaksi']."'".')">Hapus</a>'
				)
			);
			$i++;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));

	}

	function tampil_data_obat(){
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
					$rows['satuan']										
				)
			);
			$i++;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}

	public function get_data_obat() {
	    $term = $_GET['kode'];
	    // variable lain bisa dipake dari view yang diset
	    // $datalain = $this->input->get('datalain');

	    // load data ke model
	    $dataObat= $this->transaksi_model->get_obat_by($term, 'kodeObat,nama,stok,harga,satuan');
	    $data = array();
		$i=1;
		foreach ($dataObat as $rows) {
			array_push($data,
				array(					
					'id' => $i,
					'kodeObat' => $rows['kodeObat'],
					'nama' => $rows['nama'],
					'stok' => $rows['stok'],					
					'harga' => $rows['harga'],					
					'satuan' => $rows['satuan']										
				)
			);
			$i++;
		}
		echo json_encode($data);

	    // keluarkan dalam bentuk json
	    //echo json_encode($dataObat);   
	}

	private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('kdTransaksi') == '')
        {
            $data['inputerror'][] = 'kdTransaksi';
            $data['error_string'][] = 'Field Ini Harus Di Isi !';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('tglTransaksi') == '')
        {
            $data['inputerror'][] = 'tglTransaksi';
            $data['error_string'][] = 'Field Ini Harus Di Isi !';
            $data['status'] = FALSE;
        }

        if($this->input->post('kdApoteker') == '')
        {
            $data['inputerror'][] = 'kdApoteker';
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
		$kodeTrx = $this->input->post('kdTransaksi');
        $query1 = $this->transaksi_model->input_transaksi($kodeTrx);
        $query2 = $this->transaksi_model->input_detail($kodeTrx); 
        if($query1 && $query2) {
        	echo json_encode(array("status" => TRUE,
        							"kode" =>$this->transaksi_model->max_kode()));
        		
        }else{
        	echo json_encode(array("status" => false));
        } 

    }

    public function ajax_bulk_delete()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->person->delete_by_id($id);
        }
        echo json_encode(array("status" => TRUE));
    }
	
}
?>
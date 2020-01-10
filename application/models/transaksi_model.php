<?php 
/**
* 
*/
class Transaksi_Model extends CI_Model
{
	
	var $table = "transaksi";

	function __construct()
	{
		parent::__construct();
	}

	public function max_kode() {
		$table = 'transaksi';
		$field_id = 'kodeTransaksi';
	  	$kode = 'TR';

	  	$query = $this->db->query("SELECT MAX($field_id) as max_id FROM $table"); 
	  	$row = $query->row_array();
	  	$max_id = $row['max_id']; 
	  	$max_id1 =(int) substr($max_id,2,4);
	  	$kdTransaksi = $max_id1 +1;
	  	$maxkode= $kode.sprintf("%04s",$kdTransaksi);
	  	return $maxkode;
	}

	function tampil_data(){
		$query = $this->db->get("v_trx");
		return $query->result_array();
	}

	function get_obat_by($term, $column='*') {
		$query = $this->db->query("SELECT $column FROM obat WHERE kodeObat LIKE '%".$term."%' OR nama LIKE '%".$term."%'");
	    // $this->db->select($column);
	    // $this->db->like('kodeObat',$term);
	    // $this->db->or_like('nama',$term);
	    // $query = $this->db->from('obat')->get();
	    return $query->result_array();

	}

	public function input_transaksi($kdTransaksi)
    {
		
        $tglTrx = $this->input->post('tglTransaksi');
        $kdApo = $this->input->post('kdApoteker');
    	

    	$dataTrx = array(
    		'kodeTransaksi' => $kdTransaksi,
    		'tanggalTransaksi' => $this->input->post('tglTransaksi'),
    		'kodeApoteker' => $this->input->post('kdApoteker')
    	);

    	$query = $this->db->insert('transaksi',$dataTrx);
    	if ($query) 
    		return true;
    	else
    		return false;

 	}

 	function input_detail($kdTransaksi){
 		
    	$kdObat = $this->input->post('kdObat');    	
    	$jml = $this->input->post('jumlah');
    	$subTotal = $this->input->post('subTotal');

    	$dataDet = array();
        for ($i=0; $i < count($kdObat) ; $i++) {        	
        	$dataDet['kodeTransaksi'] = $kdTransaksi;
    		$dataDet['kodeObat'] = $kdObat[$i];    		
    		$dataDet['jumlah'] = $jml[$i];
    		$dataDet['total'] = $subTotal[$i];
    		$query = $this->db->insert('detail_transaksi',$dataDet); 		   		
        }

        if ($query) 
    		return true;
    	else
    		return false;
    }

    public function get_data_edit($id)
    {
        $query = $this->db->query("SELECT * FROM transaksi WHERE kodeTransaksi = '$id' ");
		return $query->row_array();
        
    }

    public function update($where, $data)
    {
    	$this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
    	$this->db->where('kodeTransaksi', $id);
    	$this->db->delete($this->table);
        return $this->db->affected_rows();
    }

}
?>
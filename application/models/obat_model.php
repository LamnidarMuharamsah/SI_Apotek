<?php 
/**
* 
*/
class obat_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function max_kode() {
		$table = 'obat';
		$field_id = 'kodeObat';
	  	$kode = 'OB';

	  	$query = $this->db->query("SELECT MAX($field_id) as max_id FROM $table"); 
	  	$row = $query->row_array();
	  	$max_id = $row['max_id']; 
	  	$max_id1 =(int) substr($max_id,2,4);
	  	$kdObat = $max_id1 +1;
	  	$maxkode= $kode.sprintf("%04s",$kdObat);
	  	return $maxkode;
	}

	function tampil_data(){
		$query = $this->db->get("obat");
		return $query->result_array();
	}

	public function input($data)
    {
        
       $query = $this->db->insert('obat', $data);
		if ($query)
			return true;
		else
			return false;
    }

    public function get_data_edit($id)
    {
        $query = $this->db->query("SELECT * FROM obat WHERE kodeObat = '$id' ");
		return $query->row_array();
        
    }

    public function update($where, $data)
    {
    	$this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
    	$this->db->where('kodeObat', $id);
    	$this->db->delete($this->table);
        return $this->db->affected_rows();
    }
/*
	function tampil(){
		$query = $this->db->get("obat");
		return $query->result_array();
	}

	function input(){
		$data = array(
			'kodeObat' => $this->input->post('kodeOb'),
			'nama' => $this->input->post('nama'),
			'stok' => $this->input->post('stok'),
			'expire' => $this->input->post('expire'),
			'harga' => $this->input->post('harga'),
			'kodeSupplier' => $this->input->post('kodeSup'));
		$query = $this->db->insert('obat',$data);
		if ($query)
			return true;
		else
			return false;
	}

	function delete($kode){
		$query = $this->db->delete('obat', array('kodeObat' => $kode));
		if($query)
			return true;
		else
			return false;
	}

	function edit($kode){
		$query = $this->db->query("SELECT * FROM obat WHERE kodeObat = $kode ");
		return $query->row_array();
	}

	function update(){
		$data = array(
			'kodeObat' => $this->input->post('kodeOb'),
			'nama' => $this->input->post('nama'),
			'stok' => $this->input->post('stok'),
			'expire' => $this->input->post('expire'),
			'harga' => $this->input->post('harga'),
			'kodeSupplier' => $this->input->post('kodeSup'));
		
		$this->db->where('kodeObat', $this->input->post('kodeOb'));
		$query = $this->db->update('obat',$data);
		if ($query)
			return true;
		else
			return false;
	}

 */

}
?>
<?php 
/**
* 
*/
class supplier_model extends CI_Model
{
	var $table = 'supplier';

	function __construct()
	{
		parent::__construct();
	}

	public function max_kode() {
		$table = 'supplier';
		$field_id = 'kodeSupplier';
	  	$kode = 'SP';

	  	$query = $this->db->query("SELECT MAX($field_id) as max_id FROM $table"); 
	  	$row = $query->row_array();
	  	$max_id = $row['max_id']; 
	  	$max_id1 =(int) substr($max_id,2,4);
	  	$kdSupplier = $max_id1 +1;
	  	$maxkode= $kode.sprintf("%04s",$kdSupplier);
	  	return $maxkode;
	}

	function tampil_data(){
		$query = $this->db->get("supplier");
		return $query->result_array();
	}

	public function input($data)
    {
        
       $query = $this->db->insert('supplier', $data);
		if ($query)
			return true;
		else
			return false;
    }

    public function get_data_edit($id)
    {
        $query = $this->db->query("SELECT * FROM supplier WHERE kodeSupplier = '$id' ");
		return $query->row_array();
        
    }

    public function update($where, $data)
    {
    	$this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
    	$this->db->where('kodeSupplier', $id);
    	$this->db->delete($this->table);
        return $this->db->affected_rows();
    }
/*
	function tampil(){
		$query = $this->db->get("supplier");
		return $query->result_array();
	}

	function input(){
		$data = array(
			'kodeSupplier' => $this->input->post('kodeSupp'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'noHp' => $this->input->post('noHp'));

		$query = $this->db->insert('supplier',$data);
		if ($query)
			return true;
		else
			return false;
	}

	function delete($kode){
		$query = $this->db->delete('supplier', array('kodeSupplier' => $kode));
		if($query)
			return true;
		else
			return false;
	}

	function edit($kode){
		$query = $this->db->query("SELECT * FROM supplier WHERE kodeSupplier = $kode ");
		return $query->row_array();
	}

	function update(){
		$data = array(
			'kodeSupplier' => $this->input->post('kodeSupp'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'noHp' => $this->input->post('noHp'));
		$this->db->where('kodeSupplier', $this->input->post('kodeSupp'));
		$query = $this->db->update('supplier',$data);
		if ($query)
			return true;
		else
			return false;
	}*/



}
?>
<?php 
/**
* 
*/
class apoteker_model extends CI_Model
{
	var $table = "apoteker";

	function __construct()
	{
		parent::__construct();
	}

	public function max_kode() {
		$table = 'apoteker';
		$field_id = 'kodeApoteker';
	  	$kode = 'AP';

	  	$query = $this->db->query("SELECT MAX($field_id) as max_id FROM $table"); 
	  	$row = $query->row_array();
	  	$max_id = $row['max_id']; 
	  	$max_id1 =(int) substr($max_id,2,4);
	  	$kdApoteker = $max_id1 +1;
	  	$maxkode= $kode.sprintf("%04s",$kdApoteker);
	  	return $maxkode;
	}

	function tampil_data(){
		$query = $this->db->get("apoteker");
		return $query->result_array();
	}

	public function input($data)
    {
        
       $query = $this->db->insert('apoteker', $data);
		if ($query)
			return true;
		else
			return false;
    }

    public function get_data_edit($id)
    {
        $query = $this->db->query("SELECT * FROM apoteker WHERE kodeApoteker = '$id' ");
		return $query->row_array();
        
    }

    public function update($where, $data)
    {
    	$this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
    	$this->db->where('kodeApoteker', $id);
    	$this->db->delete($this->table);
        return $this->db->affected_rows();
    }

/*
	function input(){
		$data = array(
			'kodeApoteker' => '',
			'nama' => $this->input->post('nama'),
			'tempatLahir' => $this->input->post('tmpLahir'),
			'tanggalLahir' => $this->input->post('tglLahir'),
			'alamat' => $this->input->post('alamat'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')) 
			);
		$query = $this->db->insert('apoteker',$data);
		if ($query)
			return true;
		else
			return false;
	}

	function delete($kode){
		$query = $this->db->delete('apoteker', array('kodeApoteker' => $kode));
		if($query)
			return true;
		else
			return false;
	}

	function edit($kode){
		$query = $this->db->query("SELECT * FROM apoteker WHERE kodeApoteker = $kode ");
		return $query->row_array();
	}

	function update(){
		$data = array(
			'kodeApoteker' => $this->input->post('kodeApo'),
			'nama' => $this->input->post('nama'),
			'tempatLahir' => $this->input->post('tmpLahir'),
			'tanggalLahir' => $this->input->post('tglLahir'),
			'alamat' => $this->input->post('alamat'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')) 
			);
		$this->db->where('kodeApoteker', $this->input->post('kodeApo'));
		$query = $this->db->update('apoteker',$data);
		if ($query)
			return true;
		else
			return false;
	}

*/
}
?>
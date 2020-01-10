<?php 
/**
* 
*/
class Kadaluarsa_model extends CI_Model
{
	var $table = 'kadaluarsa_obat';
	function __construct()
	{
		parent::__construct();
	}

	public function max_kode() {
		$table = 'kadaluarsa_obat';
	  	$kode = 'KO';
	  	$query = $this->db->query("SELECT MAX(kodeKadaluarsa) as max_id FROM $table"); 
	  	$row = $query->row_array();
	  	$max_id = $row['max_id']; 
	  	$max_id1 =(int) substr($max_id,2,4);
	  	$kdKadaluarsa = $max_id1 +1;
	  	$maxkode= $kode.sprintf("%04s",$kdKadaluarsa);
	  	return $maxkode;
	}

	function tampil_data(){
		$query = $this->db->get("kadaluarsa_obat");
		return $query->result_array();
	}

	public function input($data)
    {
        
       $query = $this->db->insert('kadaluarsa_obat', $data);
		if ($query)
			return true;
		else
			return false;
    }

    public function get_data_edit($id)
    {
        $query = $this->db->query("SELECT * FROM kadaluarsa_obat WHERE kodeKadaluarsa = '$id' ");
		return $query->row_array();
        
    }

    public function update($where, $data)
    {
    	$this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
    	 $this->db->where('kodeKadaluarsa', $id);
    	$this->db->delete($this->table);
        return $this->db->affected_rows();
    }
}
?>
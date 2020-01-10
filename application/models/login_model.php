<?php  
/**
* 
*/
class Login_model extends CI_Model
{
	var $table = 'apoteker';
	function __construct()
	{
		parent::__construct();
	}

	public function ceklogin($username,$pass){
		$this->db->where('username',$username);
		$this->db->where('password',$pass);
		$query = $this->db->get($this->table);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
	}
}
?>
<?php 
/**
* 
*/
class Home extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') != true) {
			redirect('login');
		}
	}

	public function index(){
		$this->load->view('home_view');
	}
}

?>
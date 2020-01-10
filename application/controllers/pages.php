<?php 
/**
* 
*/
class Pages extends CI_Controller
{
	
	public function view($page = 'login_view'){
		if (! file_exists(APPPATH.'views/'.$page.'.php')) {
			show_404();
		}

		$data['title'] = $page;

		$this->load->view('parts/header', $data);
		$this->load->view($page, $data);
		$this->load->view('parts/footer', $data);
	}
}
?>
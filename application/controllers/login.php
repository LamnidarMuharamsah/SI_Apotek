<?php 

/**
* 
*/
class Login extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	function index(){
		$this->load->view('login_view');
	}

	public function login_aksi(){
		//input dari form login
		$username = $this->input->post('username');
		$pass = md5($this->input->post('password'));

		//validasi form
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

		//proses validasi
		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('pesan1','Username dan Password Tidak Boleh Dikosongkan !');
			redirect('login');
		}else{
			//$this->load->model('login_model','',true);
			$cekdata = $this->login_model->ceklogin($username,$pass); //ambil data pada login_model
			if ($cekdata) {
				foreach ($cekdata as $data) {
					$username = $data['username'];
					$nama = $data['nama'];
					$kdApoteker = $data['kodeApoteker'];
				}

				$datalogin = array(
					'username' => $username,
					'nama' => $nama,
					'kodeApoteker' => $kdApoteker,
					'logged_in' => true 
					);

				$this->session->set_userdata($datalogin);
				redirect('home');
			}else{
				$this->session->set_flashdata('pesan2','Username atau Password salah !');
				redirect('login');	
			}
		}
	}

	public function logout(){
		$datalogin = array(
					'username' => '',
					'nama' => '',
					'logged_in' => '' 
					);
		$this->session->unset_userdata($datalogin); //hapus session
		$this->session->sess_destroy(); //tutup session
		redirect('login');
	}
}
?>
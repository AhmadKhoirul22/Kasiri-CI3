<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');

	}

	public function index(){
		$this->load->view('Auth');
	}
	public function login(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
	
		$this->db->from('user')->where('username', $username);
		$user = $this->db->get()->row();
	
		if ($user == NULL) {
			$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissible" role="alert">
				Username tidak terdaftar!!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			  </div>');
			redirect('auth');
		} elseif ($user->password == $password) {
			$data = array(
				'username' => $user->username,
				'nama'     => $user->nama,
				'level'    => $user->level,
				'id_user'  => $user->id_user,
			);
			$this->session->set_userdata($data);
			redirect('admin/home');
		} else {
			$this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissible" role="alert">
				Password Salah!!
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			  </div>');
			redirect('auth');
		}
	}
	
    public function logout(){
		// $user_id = $this->session->userdata('id_user');
		// $date = date('Y-m-d H:i:s');
		// $this->db->set('last_login',$date);
		// $this->db->where('id_user', $user_id); 
		// $this->db->update('user');
			$this->session->sess_destroy();
			redirect('auth');
	}
}

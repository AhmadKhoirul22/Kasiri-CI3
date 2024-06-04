<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if($this->session->userdata('level')==NULL){
            redirect('auth');
        }
	}
	public function index(){
        $data['title'] = 'Page of Profile';
        $data['header'] = 'Profile';

        $this->db->from('profile');
        $data['profile'] = $this->db->get()->row();
		$this->load->view('admin/profile',$data);
	}

    public function update(){
        $data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'telp' => $this->input->post('telp'),
            'email' => $this->input->post('email'),
        );
        $where = array('id_profile' => 1);
        $this->db->update('profile',$data,$where);
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        Berhasil Mengupdate Data Profile
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
		redirect('admin/profile');
    }
}

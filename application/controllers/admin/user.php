<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
    if($this->session->userdata('level')==NULL){
      redirect('auth');
    }
		$this->load->model('User_model');
  
	}
	public function index(){
        $this->db->from('user')->order_by('nama', 'ASC');
        $data['user']= $this->db->get()->result_array();
        $data['h2'] = 'Page of User';
        $data['title'] = 'Page of User';
		$this->load->view('admin/User',$data);
	}
	public function tambah(){
        $this->db->from('user');
        $this->db->where('username',$this->input->post('username'));
        $cek = $this->db->get()->result_array();
        if($cek<>NULL){
            $this->session->set_flashdata('alert','<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i>
            Username Sudah Digunakan
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
      	redirect('admin/user');
        }
        $this->User_model->tambah();
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        Berhasil Menambahkan Data User
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
    	redirect('admin/user');
    }
    public function update(){
        $this->User_model->update();
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        Berhasil Mengupdate Data User
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
		redirect('admin/user');
    }
    public function delete($id){
        $where = array(
            'id_user' => $id);
        $this->db->delete('user', $where);
        $this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-octagon me-1"></i>
        Data Produk Berhasil Di Hapus!!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('admin/user');
    }
    public function reset($id){
      $user = $this->db->get_where('user', array('id_user' => $id))->row_array();
      $default_password = md5($user['username']);
      $data = array(
          'password' => $default_password,
      );
      $where = array(
          'id_user' => $id
      );
      $this->db->update('user', $data, $where);
      $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-1"></i>
      Berhasil Mengreset Password
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
      redirect('admin/user');
  }
  
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        if($this->session->userdata('level')==NULL){
            redirect('auth');
        }
	} 
    
	public function index(){
        $this->db->from('pelanggan');
        $data['pelanggan'] = $this->db->get()->result_array();
        $data['h2'] = 'Page of Pelanggan';
        $data['title'] = 'Page of Pelanggan';
		$this->load->view('admin/pelanggan',$data);
	}

    public function tambah(){
        $data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'telp' => $this->input->post('telp'),
        );
        $this->db->insert('pelanggan',$data);
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        Berhasil Menambahkan Data Pelanggan
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
    	redirect('admin/pelanggan');
    }
    public function update(){
        $data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'telp' => $this->input->post('telp'),
        );
        $where = array(
            'id_pelanggan' => $this->input->post('id_pelanggan')
        );
        $this->db->update('pelanggan',$data,$where);
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        Berhasil Mengupdate Data Pelanggan
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
    	redirect('admin/pelanggan');
    }
    public function delete($id){
        $where = array(
            'id_pelanggan' => $id);
        $this->db->delete('pelanggan', $where);
        $this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-octagon me-1"></i>
        Pelanggan Berhasil Di Hapus!!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('admin/pelanggan');
    }
    public function transaksi($id_pelanggan){
        $this->db->select('*');
        $this->db->from('penjualan a');
        $this->db->join('pelanggan b','a.id_pelanggan=b.id_pelanggan');
        $this->db->where('a.id_pelanggan', $id_pelanggan);
        $transaksi = $this->db->get()->result_array();
    
        // Menyiapkan data untuk ditampilkan di view
        $data['transaksi'] = $transaksi;
        $data['title'] = 'Transaksi Pelanggan';
        $this->load->view('admin/transaksi_pelanggan',$data);
    }
}

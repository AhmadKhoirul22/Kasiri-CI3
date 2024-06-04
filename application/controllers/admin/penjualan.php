<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        if($this->session->userdata('level')==NULL){
            redirect('auth');
        }
	}
    
	public function index(){
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');
        $data['judul_halaman'] = 'Page of Penjualan';
        $data['title'] = 'Page of Penjualan';

        $this->db->from('produk');
        $data['produk'] = $this->db->get()->result_array();

        $this->db->from('penjualan a')->order_by('a.tanggal','DESC');
        $this->db->join('pelanggan b','a.id_pelanggan=b.id_pelanggan','left');
        $data['penjualan'] = $this->db->get()->result_array();

        $this->db->from('pelanggan');
        $data['pelanggan'] = $this->db->get()->result_array();

		$this->load->view('admin/penjualan',$data);
	}
    
    public function transaksi($id_pelanggan){
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('Y-m');

        $this->db->from('penjualan')->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
        $jumlah = $this->db->count_all_results();
        
        $nota  = date('ymd').$jumlah+1;
        $data['nota'] = $nota;

        $data['id_pelanggan'] = $id_pelanggan;

        $this->db->from('pelanggan')->where('id_pelanggan',$id_pelanggan);
        $data['nama_pelanggan'] = $this->db->get()->row()->nama;

        $this->db->from('produk')->where('stok >',0)->order_by('nama','ASC');
        $data['produk'] = $this->db->get()->result_array();

        $this->db->from('detail_penjualan a');
        $this->db->join('produk b','a.id_produk=b.id_produk','left');
        $this->db->where('a.kode_penjualan',$nota);
        $data['detail'] = $this->db->get()->result_array();

        $this->db->from('temp a');
        $this->db->join('produk b','a.id_produk=b.id_produk','left');
        $this->db->where('a.id_user',$this->session->userdata('id_user'));
        $this->db->where('a.id_pelanggan',$id_pelanggan);
        $data['temp'] = $this->db->get()->result_array();

        $data['title'] = 'Tambah Penjualan';
        $this->load->view('admin/transaksi',$data);
    }
    
    public function tambah_temp(){
        $this->db->from('produk')->where('id_produk',$this->input->post('id_produk'));
        $stok_lama =  $this->db->get()->row()->stok;

        $this->db->from('temp');
        $this->db->where('id_produk',$this->input->post('id_produk'));
        $this->db->where('id_user',$this->session->userdata('id_user'));
        $this->db->where('id_pelanggan',$this->input->post('id_pelanggan'));
        $cek = $this->db->get()->result_array();

        if($stok_lama<$this->input->post('jumlah')){
            $this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            Stok Produk Tidak Mencukupii
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            
        } else if($cek<>NULL){
            $this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            Produk Sudah Dipilih
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            
        } else {
            $data = array(
                'id_pelanggan' => $this->input->post('id_pelanggan'),
                'id_produk' => $this->input->post('id_produk'),
                'id_user' => $this->session->userdata('id_user'),
                'jumlah' => $this->input->post('jumlah')
            );
            $this->db->insert('temp',$data);
            $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            Berhasil Menambahkan Data Keranjang
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        }
        redirect($_SERVER["HTTP_REFERER"]);
    }
    public function delete_temp($id_temp){
        $where = array(
            'id_temp' => $id_temp);
        $this->db->delete('temp', $where);
        $this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-octagon me-1"></i>
        Berhasil Menghapus Data Keranjang
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect($_SERVER["HTTP_REFERER"]);
    }
    public function bayar_temp(){
        //pembuatan nota
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('Y-m');
        $this->db->from('penjualan')->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
        $jumlah = $this->db->count_all_results();
        $nota  = date('ymd').$jumlah+1;

        $this->db->from('temp a');
        $this->db->join('produk b','a.id_produk=b.id_produk','left');
        $this->db->where('a.id_user',$this->session->userdata('id_user'));
        $this->db->where('a.id_pelanggan',$this->input->post('id_pelanggan'));
        $temp = $this->db->get()->result_array();
        $total = 0;
        foreach($temp as $ar){
            //cek stok apakah melebihi jumlah
            if($ar['stok']<$ar['jumlah']){
                $this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                Stok Produk Tidak Mencukupii
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
                redirect($_SERVER["HTTP_REFERER"]);
            }
            $total = $total+$ar['jumlah']*$ar['harga'];
            //input ke tabel detail penjualan
            $data = array(
                'kode_penjualan' => $nota,
                'id_produk' => $ar['id_produk'],
                'jumlah' => $ar['jumlah'],
                'sub_total' => $ar['jumlah']*$ar['harga'] 
            );
            $this->db->insert('detail_penjualan',$data);
            //update stok produk
            $data2 = array('stok' => $ar['stok']-$ar['jumlah']);
            $where = array('id_produk' => $ar['id_produk']);
            $this->db->update('produk',$data2,$where);
            //update tabel temp
            $aaa = array(
                'id_pelanggan' => $this->input->post('id_pelanggan'),
                'id_user' => $this->session->userdata('id_user'),
            );
            $this->db->delete('temp',$aaa);
        }
        //bagian penjualan
        $data = array(
            'kode_penjualan' => $nota,
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'total_harga' => $total,
            'tanggal' => date('Y-m-d'),
            
        );
        $this->db->insert('penjualan',$data);
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        Penjualan Berhasil
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
        redirect('admin/penjualan/invoice/'.$nota);
    }

    public function invoice($kode_penjualan){
        $this->db->from('profile');
        $data['profile'] = $this->db->get()->row();

        $this->db->select('*');
        $this->db->from('penjualan a')->order_by('a.tanggal','DESC');
        $this->db->join('pelanggan b','a.id_pelanggan=b.id_pelanggan','left');
        $this->db->where('a.kode_penjualan',$kode_penjualan);
        $data['penjualan'] = $this->db->get()->row();

        $this->db->from('detail_penjualan a');
        $this->db->join('produk b','a.id_produk=b.id_produk','left');
        $this->db->where('a.kode_penjualan',$kode_penjualan);
        $data['detail'] = $this->db->get()->result_array();

        $this->load->view('admin/invoice',$data);
    }
    public function delete_penjualan($id){
        $where = array(
            'id_penjualan' => $id);
        $this->db->delete('penjualan', $where);
        $this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-octagon me-1"></i>
        Data Penjualan Berhasil Di Hapus!!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('admin/penjualan');
    }
}

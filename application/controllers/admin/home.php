<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
        if($this->session->userdata('level')==NULL){
            redirect('auth');
        }
		$this->load->model('Penjualan_model');
	}
	public function index(){
		$this->load->model('Penjualan_model'); 
		
		$this->db->from('produk');
		$data['produk'] = $this->db->get()->result_array();

		$this->db->from('profile');
		$data['proile'] = $this->db->get()->row();
		// $this->db->from('penjualan');
		// $data['penjualan'] = $this->db->get()->result_array();
		date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('Y-m-d');
		$this->db->select('sum(total_harga) as total');
		$this->db->from('penjualan');
		$this->db->where("DATE_FORMAT(tanggal,'%Y-%m-%d')",$tanggal);
        $data['today'] =  $this->db->get()->row()->total;

        $this->db->from('penjualan')->where("DATE_FORMAT(tanggal,'%Y-%m-%d')",$tanggal);
        $data['transaksi'] =  $this->db->count_all_results();

		$tanggal = date("Y-m");
		$this->db->select('sum(total_harga) as total');
		$this->db->from('penjualan');
		$this->db->where("DATE_FORMAT(tanggal,'%Y-%m-%d')",$tanggal);
        $data['bulan_ini'] =  $this->db->get()->row()->total;

		// aktivitas
        $this->db->from('penjualan a')->order_by('a.tanggal','DESC');
        $this->db->join('pelanggan b','a.id_pelanggan=b.id_pelanggan','left');
		$this->db->limit(10);
		$data['activity'] = $this->db->get()->result_array();
		// aktivitas
		$this->db->from('detail_penjualan a');
        $this->db->join('produk b','a.id_produk=b.id_produk','left');
        $data['detail'] = $this->db->get()->result_array();
		// penjualn terbanyak
		$this->db->select('b.kode_produk, b.nama, SUM(a.jumlah) as total_penjualan');
		$this->db->from('detail_penjualan a');
		$this->db->join('produk b', 'a.id_produk = b.id_produk', 'left');
		$this->db->group_by('a.id_produk'); // Mengelompokkan hasil berdasarkan id_produk
		$this->db->order_by('total_penjualan', 'DESC'); // Mengurutkan berdasarkan total penjualan secara descending
		$data['penjualan_terbanyak'] = $this->db->get()->result_array();
		
		// part 2

		$this->db->from('pelanggan');
		$data['pelanggan'] = $this->db->get()->result_array();

        $data['h2'] = 'Dashboard';
		$this->load->view('admin/dashboard',$data);
	}
}


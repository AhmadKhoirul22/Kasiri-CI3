<?php
class Invoice extends CI_Controller { 
    public function index($kode_penjualan) {
        $this->db->from('profile');
        $data['profile'] = $this->db->get()->row();

        $this->db->from('penjualan a')->order_by('a.tanggal', 'DESC');
        $this->db->join('pelanggan b', 'a.id_pelanggan=b.id_pelanggan', 'left');
        $this->db->where('a.kode_penjualan', $kode_penjualan); // Ubah agar hanya mengambil data dengan kode_penjualan yang sesuai
        $data['penjualan'] = $this->db->get()->row();

        $this->db->from('detail_penjualan a');
        $this->db->join('produk b', 'a.id_produk=b.id_produk', 'left');
        $this->db->where('a.kode_penjualan', $kode_penjualan);
        $data['detail'] = $this->db->get()->result_array();

        $this->load->view('cetak_nota', $data);
    }

    public function nota($kode_penjualan) {
        $this->db->from('profile');
        $data['profile'] = $this->db->get()->row();

        $this->db->from('penjualan a')->order_by('a.tanggal', 'DESC');
        $this->db->join('pelanggan b', 'a.id_pelanggan=b.id_pelanggan', 'left');
        $this->db->where('a.kode_penjualan', $kode_penjualan); // Ubah agar hanya mengambil data dengan kode_penjualan yang sesuai
        $data['penjualan'] = $this->db->get()->row();

        $this->db->from('detail_penjualan a');
        $this->db->join('produk b', 'a.id_produk=b.id_produk', 'left');
        $this->db->where('a.kode_penjualan', $kode_penjualan);
        $data['detail'] = $this->db->get()->result_array();

        $this->load->view('haha/index', $data);
    }
}

?>
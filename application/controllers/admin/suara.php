<?php
class Suara extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$data['title'] = 'Suara Page';
		$this->load->view('admin/suara',$data);
	}

	public function tambah(){
		$total_suara = $this->input->post('total_suara_2');
		$total_suara_sah_2 = $this->input->post('total_suara_sah_2');
		$total_suara_tidaksah_2 = $this->input->post('total_suara_tidaksah_2');
		$suara_no1_2 = $this->input->post('suara_no1_2');
		$suara_no2_2 = $this->input->post('suara_no2_2');
		$suara_no3_2 = $this->input->post('suara_no3_2');
		$nama_tps = $this->input->post('nama_tps');

		if($total_suara != ($total_suara_sah_2+$total_suara_tidaksah_2)){
			$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<i class="bi bi-exclamation-octagon me-1"></i>
			jumlah total suara tidak sama jumlahnya dengan penjumlahan suara sah + suara tidak sah
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  </div>');
			redirect('admin/suara');
		}

		if($total_suara_sah_2 != ($suara_no1_2+$suara_no2_2+$suara_no3_2)){
			$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<i class="bi bi-exclamation-octagon me-1"></i>
			jumlah total suara sah tidak sama dengan penjumlahan suara no 1 + o 2 + no 3
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  </div>');
			redirect('admin/suara');
		}

		$data = array(
			'total_suara_2' => $total_suara,
			'total_suara_sah_2' => $total_suara_sah_2,
			'total_suara_tidaksah_2' => $total_suara_tidaksah_2,
			'suara_no1_2' => $suara_no1_2,
			'suara_no2_2' => $suara_no2_2,
			'suara_no3_2' => $suara_no3_2,
			'nama_tps' => $nama_tps,
		);

		$this->db->insert('suara',$data);
		$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade show" role="alert">
		<i class="bi bi-check-circle me-1"></i>
		Berhasil Menambahkan Suara
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
		redirect('admin/suara');
	}
}
?>

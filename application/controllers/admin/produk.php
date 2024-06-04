<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Produk extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        if($this->session->userdata('level')==NULL){
            redirect('auth');
        }
	}

	public function index(){
        $this->db->from('produk');
        $data['produk'] = $this->db->get()->result_array();
        $data['title'] = 'Page of Produk';
        $data['card_title'] = 'Page of Produk';
        $data['head'] = 'Produk';

		$this->db->select('b.kode_produk, b.nama, SUM(a.jumlah) as total_penjualan');
		$this->db->from('detail_penjualan a');
		$this->db->join('produk b', 'a.id_produk = b.id_produk', 'left');
		$this->db->group_by('a.id_produk'); // Mengelompokkan hasil berdasarkan id_produk
		$this->db->order_by('total_penjualan', 'DESC'); // Mengurutkan berdasarkan total penjualan secara descending
		$data['penjualan_terbanyak'] = $this->db->get()->result_array();

		$this->load->view('admin/produk',$data);
	}
    public function tambah(){
        date_default_timezone_set('Asia/Jakarta');

        $currentDateTime = new DateTime();
        $year = $currentDateTime->format('y'); // Mendapatkan tahun (2 digit)
        $month = $currentDateTime->format('m'); // Mendapatkan bulan (3 karakter)
        $day = $currentDateTime->format('d');
        
        $currentHour = $currentDateTime->format('H');
        $currentMinute = $currentDateTime->format('i');
        $currentSecond = $currentDateTime->format('s');

        $currentDateTime->setTime($currentHour, $currentMinute, $currentSecond);

        $data = array(
            'kode_produk' => $year.$month.$day.$currentDateTime->format('His'),
            'nama' => $this->input->post('nama'),
            'stok' => $this->input->post('stok'),
            'harga' => $this->input->post('harga')
        );
        $this->db->insert('produk',$data);
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        Berhasil Menambahkan Data Produk
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
    	redirect('admin/produk');
    }
    public function delete($id){
        $where = array(
            'id_produk' => $id);
        $this->db->delete('produk', $where);
        $this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-octagon me-1"></i>
        Produk Berhasil Di Hapus!!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('admin/produk');
    }
    public function update(){
        $data = array(
            'kode_produk' => $this->input->post('kode_produk'),
            'nama' => $this->input->post('nama'),
            'stok' => $this->input->post('stok'),
            'harga' => $this->input->post('harga'),
        );
        $where = array(
            'id_produk' => $this->input->post('id_produk')
        );
        $this->db->update('produk',$data,$where);
        $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        Berhasil Mengupdate Data Produk
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');
    	redirect('admin/produk');
    }
    public function excel(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $upload_status = $this->uploadDoc();
            if($upload_status != false){
                $inputFileName = 'assets/upload/excel/'.$upload_status;
                $inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
                $spreadsheet = $reader->load($inputFileName);
                $sheet = $spreadsheet->getSheet(0);
                $count_Rows = 0;

                foreach($sheet->getRowIterator() as $row){
                    $kode_produk = $spreadsheet->getActiveSheet()->getCell('A'.$row->getRowIndex());
                    $nama = $spreadsheet->getActiveSheet()->getCell('B'.$row->getRowIndex());
                    $stok = $spreadsheet->getActiveSheet()->getCell('C'.$row->getRowIndex());
                    $harga = $spreadsheet->getActiveSheet()->getCell('D'.$row->getRowIndex());

					if(!$this->isDataImported($kode_produk, $nama)){
						$data = array(
							'kode_produk' => $kode_produk,
							'nama' => $nama,
							'stok' => $stok,
							'harga' => $harga,
						);
						$this->db->insert('produk',$data);
						$count_Rows++;
						$this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="bi bi-check-circle me-1"></i>
						Produk Berhasil Di Tambahkan
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>');
						redirect('admin/produk');
					} else {
						$this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<i class="bi bi-check-circle me-1"></i>
						Produk Gagal Di Tambahkan karna sudah pernah di tambahkan
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>');
						redirect('admin/produk');
					}
                }
                $this->session->set_flashdata('alert','<div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                Succes
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
                redirect('admin/produk');
            } else {
                $this->session->set_flashdata('alert','<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                File tidak valid
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
                redirect('admin/produk');
            }
        } else {
            $this->load->view('admin/produk');
        };
    }
    public function uploadDoc(){
        $uploadPath = 'assets/upload/excel/';
        if(!is_dir($uploadPath)){
            mkdir($uploadPath,0777,true); //untuk membuat directori
        }

        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'csv|xlsx|xls';
        $config['max_size'] = 100000;
        $this->load->library('upload',$config);
        $this->upload->initialize($config);

        if($this->upload->do_upload('upload_excel')){ //upload excel itu nama pada form nya
            $fileData = $this->upload->data();
            return $fileData['file_name'];
        } else {
            return false;
        }
    }

	private function isDataImported($kode_produk, $nama){
		$this->db->where('kode_produk', $kode_produk);
		$this->db->where('nama', $nama);
		$query = $this->db->get('produk');
		return $query->num_rows() > 0;
	}
    
    public function cetak_excel(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach(range('A','F') as $coloumID){
            $spreadsheet->getActiveSheet()->getColumnDimension($coloumID)->setAutoSize(true);
        }
        $sheet->setCellValue('A1','id_produk');
        $sheet->setCellValue('B1','nama');
        $sheet->setCellValue('C1','kode_produk');
        $sheet->setCellValue('D1','stok');
        $sheet->setCellValue('E1','harga');

        $produk = $this->db->query('select * from produk')->result_array();
        $x=2; //start from row 2
        foreach($produk as $row){
            $sheet->setCellValue('A'.$x,$row['id_produk']);
            $sheet->setCellValue('B'.$x,$row['nama']);
            $sheet->setCellValue('C'.$x,$row['kode_produk']);
            $sheet->setCellValue('D'.$x,$row['stok']);
            $sheet->setCellValue('E'.$x,$row['harga']);
            $x++;
        }
        $writer = new Xlsx($spreadsheet);
        $FileName = 'phpexcel.xlsx';
        // $writer->save($FileName);

        header('Content-Type: appliction/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$FileName.'"');
        $writer->save('php://output');
    }
}

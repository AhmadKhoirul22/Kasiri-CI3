<?php 
class Laporanpdf extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('pdf');
    }
	public function nota($kode_penjualan){

        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $this->db->from('profile');
        $profile = $this->db->get()->row();

        $this->db->from('penjualan a')->order_by('a.tanggal', 'DESC');
        $this->db->join('pelanggan b', 'a.id_pelanggan=b.id_pelanggan', 'left');
        $this->db->where('a.kode_penjualan', $kode_penjualan); // Ubah agar hanya mengambil data dengan kode_penjualan yang sesuai
        $penjualan = $this->db->get()->row();

        $this->db->from('detail_penjualan a');
        $this->db->join('produk b', 'a.id_produk=b.id_produk', 'left');
        $this->db->where('a.kode_penjualan', $kode_penjualan);
        $detail = $this->db->get()->result();

        $pdf = new FPDF('L', 'mm','Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(0,7,'Inovoice Penjualan',0,1,'C');
        $pdf->Cell(90, 7, 'Dari:', 0, 0, 'L');
        $pdf->Cell(0, 7, 'Kepada:', 0, 1, 'R');
        
        $pdf->Cell(90, 7, $profile->nama, 0, 0, 'L');
        $pdf->Cell(0, 7, $penjualan->nama, 0, 1, 'R');
        
        $pdf->SetFont('Arial', 'I', '13');
        $pdf->Cell(90, 7, $profile->alamat, 0, 0, 'L');
        $pdf->Cell(0, 7, $penjualan->alamat, 0, 1, 'R');
        
        $pdf->Cell(90, 7, $profile->telp, 0, 0, 'L');
        $pdf->Cell(0, 7, $penjualan->telp, 0, 1, 'R');
        
        $pdf->Cell(90, 7, $profile->email, 0, 0, 'L');
        $pdf->Cell(0, 7, '', 0, 1, 'R'); 
        // $pdf->SetX(150); // Pindahkan posisi X ke sebelah kanan
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 7, 'NOTA:', 0, 1, 'C');
        $pdf->Cell(0, 7, $penjualan->kode_penjualan, 0, 1, 'C');
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(20,6,'No',1,0,'C');
        $pdf->Cell(85,6,'kode produk',1,0,'C');
        $pdf->Cell(27,6,'produk',1,0,'C');
        $pdf->Cell(25,6,'jumlah',1,0,'C');
        $pdf->Cell(45,6,'harga',1,0,'C');
        $pdf->Cell(45,6,'total',1,1,'C');
        $pdf->SetFont('Arial','',10);
        // $pegawai = $this->db->get('transaksi')->result();

        // where('jenis_transaksi','pemasukan');
        $no=0;
        $totalNominal=0;
        foreach ($detail as $data){
            $no++;
            $pdf->Cell(20,6,$no,1,0, 'C');
            $pdf->Cell(85,6,$data->kode_produk,1,0);
            $pdf->Cell(27,6,$data->nama,1,0);
            $pdf->Cell(25,6,$data->jumlah,1,0);
            $pdf->Cell(45,6,number_format($data->harga),1,0);
            $pdf->Cell(45,6,number_format($data->sub_total),1,1);
            $totalNominal = $totalNominal+$data->jumlah*$data->harga;
        }
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(157,6,'Total Belanja',1,0,'R');
        $pdf->Cell(45,6,number_format($totalNominal, 2),1,1,'C');
        $pdf->Output();
	}
}
?>
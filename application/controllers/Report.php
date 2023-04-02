<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->library('session');
		$this->load->model('M_report');
        $this->load->library('pdf');
	}

    public function loadkonten($page, $data) {
		$data['username'] 	= $this->session->userdata('username');

		$this->load->view($page, $data);
	}

	public function index()
    {
        $tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        
        if(empty($tgl_awal) or empty($tgl_akhir))
        { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $transaksi = $this->M_report->view_all();  // Panggil fungsi view_all yang ada di M_report
            $url_cetak = 'transaksi/cetak';
            $label = 'Semua Data Transaksi';
        }else{ // Jika terisi
            $transaksi = $this->M_report->view_by_date($tgl_awal, $tgl_akhir);  // Panggil fungsi view_by_date yang ada di M_report
            $url_cetak = 'Report/cetak?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir;
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
        }
        $data['transaksi'] = $transaksi;
        $data['url_cetak'] = base_url($url_cetak);
        $data['label'] = $label;
        $data['content'] 	= "admin/v_report/list2";
        $data['page'] 		= "Report Request Data";

        $this->loadkonten('admin/app_base',$data);
        // $this->load->view('list', $data);
    }

    public function cetak()
    {
        $tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        if(empty($tgl_awal) or empty($tgl_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $transaksi = $this->M_report->view_all();  // Panggil fungsi view_all yang ada di M_report
            $label = 'Semua Data Transaksi';
        }else{ // Jika terisi
            $transaksi = $this->M_report->view_by_date($tgl_awal, $tgl_akhir);  // Panggil fungsi view_by_date yang ada di M_report
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
        }
        $data['label'] = $label;
        $data['transaksi'] = $transaksi;
    
        ob_start();
        $this->loadkonten('admin/v_report/print',$data);
        // $this->load->view('print', $data);
        $html = ob_get_contents();
        ob_end_clean();
    
        require './assets/html2pdf/autoload.php'; // Load plugin html2pdfnya
        $pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');  // Settingan PDFnya
        $pdf->WriteHTML($html);
        $pdf->Output('Data Transaksi.pdf', 'D');
    }

    public function penerima_bantuan(){
        $this->load->library('htmlpdf');
        $pdf = new HTML2PDF();
        $pdf->setDefaultFont('Arial');
        $data = array(
            'title' => 'My PDF'
        );
        $html = $this->load->view('admin/v_report/print', $data, true);
        $pdf->writeHTML($html);
        $pdf->Output('my_pdf.pdf', 'I');
    }
}
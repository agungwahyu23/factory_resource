<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . 'third_party/mpdf/autoload.php';
// require_once __DIR__ . '/vendor/autoload.php';
// use Dompdf\Dompdf;

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->library('session');
		$this->load->model('M_report');
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
            $url_cetak = 'Report/pdf_request';
            $label = 'All Data Request';
        }else{ // Jika terisi
            $transaksi = $this->M_report->view_by_date($tgl_awal, $tgl_akhir);  // Panggil fungsi view_by_date yang ada di M_report
            $url_cetak = 'Report/pdf_request?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir;
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
    }

    public function item()
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
            $url_cetak = 'Report/pdf_request?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir;
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
    }

    public function return()
    {
        $tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        
        if(empty($tgl_awal) or empty($tgl_akhir))
        { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $transaksi = $this->M_report->view_all();  // Panggil fungsi view_all yang ada di M_report
            $url_cetak = 'Report/pdf_return';
            $label = 'All Data';
        }else{ // Jika terisi
            $transaksi = $this->M_report->view_by_date_return($tgl_awal, $tgl_akhir);  // Panggil fungsi view_by_date yang ada di M_report
            $url_cetak = 'Report/pdf_return?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir;
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
        }
        $data['transaksi'] = $transaksi;
        $data['url_cetak'] = base_url($url_cetak);
        $data['label'] = $label;
        $data['content'] 	= "admin/v_report/list_return";
        $data['page'] 		= "Report Return Data";

        $this->loadkonten('admin/app_base',$data);
    }

    public function pdf_request()
    {
        $tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        if(empty($tgl_awal) or empty($tgl_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $data_req = $this->M_report->view_all();  // Panggil fungsi view_all yang ada di M_report
            $label = 'All Data Request';
        }else{ // Jika terisi
            $data_req = $this->M_report->view_by_date($tgl_awal, $tgl_akhir);  // Panggil fungsi view_by_date yang ada di M_report
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Date '.$tgl_awal.' till '.$tgl_akhir;
        }
        $data['label'] = $label;
        $data['data_req'] = $data_req;
        $data['period'] = $tgl_awal . ' till ' . $tgl_akhir;
        $data['title'] = 'Report Request';

		$data['siswa'] = "tes";
		$this->load->library('pdf');
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "laporan-data-siswa.pdf";
		$this->pdf->load_view('admin/v_report/print', $data);

    }
}
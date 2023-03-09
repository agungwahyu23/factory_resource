<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('M_daftar');
		$this->load->library('session');
	}

	public function loadkonten($page, $data) {
		$data['username'] 	= $this->session->userdata('username');

		$this->load->view($page, $data);
	}

	public function index()
	{
		$data['page'] 		= "Data Surat";
		$data['content'] 	= "admin/dashboard";

		$this->loadkonten('admin/app_base',$data);
	}
}

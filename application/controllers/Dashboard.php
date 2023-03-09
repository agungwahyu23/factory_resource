<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

	public function loadkonten($page, $data) {
		$data['username'] 	= $this->session->userdata('username');

		$this->load->view($page, $data);
	}

	public function index()
	{
		$data['page'] 		= "Dashboard";
		$data['content'] 	= "admin/dashboard";
		$data['order']		= $this->db->query("select * from `order`")->num_rows();
		$data['package']		= $this->db->query("select * from `package`")->num_rows();
		$data['chef']		= $this->db->query("select * from `chef`")->num_rows();
		$data['promo']		= $this->db->query("select * from `promo`")->num_rows();

		$this->loadkonten('admin/app_base',$data);
	}

}

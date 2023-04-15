<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->library('session');
	}

	public function loadkonten($page, $data) {
		$data['username'] 	= $this->session->userdata('username');
		$data['name_of_employee'] 	= $this->session->userdata('name_of_employee');

		$this->load->view($page, $data);
	}

	public function index()
	{
		$data['page'] 		= "Dashboard";
		$data['content'] 	= "admin/dashboard";

		$data['item'] 		= $this->db->query("SELECT COUNT(id) as item FROM tb_item")->row();

		$data['material'] 		= $this->db->query("SELECT COUNT(id) as material FROM tb_raw_material")->row();

		$data['req_sub'] 		= $this->db->query("SELECT COUNT(id) as result FROM tb_order WHERE status = 1")->row();
		$data['req_acc'] 		= $this->db->query("SELECT COUNT(id) as result FROM tb_order WHERE status = 2")->row();
		$data['req_rej'] 		= $this->db->query("SELECT COUNT(id) as result FROM tb_order WHERE status = 3")->row();

		$data['return'] 		= $this->db->query("SELECT COUNT(id) as result FROM tb_return")->row();

		$data['roadmap'] 		= $this->db->query("SELECT COUNT(id) as result FROM tb_roadmap")->row();

		$data['employee'] 		= $this->db->query("SELECT COUNT(id) as result FROM tb_employee")->row();

		$this->loadkonten('admin/app_base',$data);
	}

}

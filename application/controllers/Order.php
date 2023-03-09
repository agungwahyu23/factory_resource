<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('M_order');
	}

	public function loadkonten($page, $data) {
		$data['username'] 	= $this->session->userdata('username');
		
		$this->load->view($page, $data);
	}

	public function index()
	{
		$data['page'] 		= "Order";
		$data['content'] 	= "admin/v_order/home";

		$this->loadkonten('admin/app_base',$data);
	}

	public function ajax_list()
	{
		$list = $this->M_order->getData();

		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $brand) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $brand->package_id;
			$row[] = $brand->name;
			$row[] = $brand->email;
			$row[] = $brand->phone;

			$action = '<div class="dropdown">';
			$action .= '<button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"> Action </button>';
			$action .= '<div class="dropdown-menu dropdown-menu-end">';
			$action .= '<a class="dropdown-item" href="' . base_url('order-detail') . "/" . $brand->id_order . '"> Detail</a>';
			$action .= '<a class="dropdown-item delete-user" href="#" data-id='."'".
			$brand->id_order."'".'> Delete</a>';
			$action .= ' </div>';
			$action .= ' </div>';
			$row[] = $action;
			
			$data[] = $row;
		}

		$output = array(
			"draw" => @$_POST['draw'],
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function delete()
	{
		$id = $_POST['id'];
		$result = $this->M_order->hapus($id);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}
	}

	public function Detail($id)
	{
		$data['page'] = "Detail Order";
		$data['order'] = $this->M_order->select_by_id($id);

		$data['content'] 	= "admin/v_order/detail";

		$this->loadkonten('admin/app_base',$data);
	}
}
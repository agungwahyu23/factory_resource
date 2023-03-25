<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->library('session');
		$this->load->model('M_request');
	}

	public function loadkonten($page, $data) {
		$data['username'] 	= $this->session->userdata('username');

		$this->load->view($page, $data);
	}

	public function index()
	{
		$data['page'] 		= "Request";
		$data['content'] 	= "admin/v_request/home";

		$this->loadkonten('admin/app_base',$data);
	}

	public function ajax_list()
	{
		$requests = $this->M_request->getData();

		$data = array();
		$no = @$_POST['start'];
		foreach ($requests as $request) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $request->code;
			$row[] = $request->date_order;

			$status = $request->status;
			if ($status == 1) {
				$status_desc = '<span class="badge badge-pill badge-primary">Requested</span>';
			}elseif ($status==2) {
				$status_desc = '<span class="badge badge-pill badge-success">Accepted</span>';
			}elseif ($status == 3) {
				$status_desc = '<span class="badge badge-pill badge-danger">Rejected</span>';
			}
			$row[] = $status_desc;

			$action = '<div class="dropdown">';
			$action .= '<button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"> Action </button>';
			$action .= '<div class="dropdown-menu dropdown-menu-end">';
			$action .= '<a class="dropdown-item" href="' . base_url('request-update') . "/" . 
			$request->id . '"> Update</a>';
			$action .= '<a class="dropdown-item delete-request" href="#" data-id='."'".
			$request->id."'".'> Delete</a>';
			$action .= '    	</div>';
			$action .= ' </div>';

			if ($request->status==1) {
				$row[] = $action;
			}else{
				$row[] = '-';
			}
			
			$data[] = $row;
		}

		$output = array(
			"draw" => @$_POST['draw'],
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_list_modal()
	{
		$requests = $this->M_request->getDataMaterial();

		$data = array();
		$no = @$_POST['start'];
		foreach ($requests as $request) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $request->code;
			$row[] = $request->name;
			$row[] = $request->price;

			$action = '<a class="btn btn-sm btn-primary choose_material" href="#" 
			data-id='."'". $request->id."'".' 
			data-name='."'". $request->name."'".'
			data-price='."'". $request->price."'".'> Pilih</a>';

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

	public function ajax_list_order_detail()
	{
		$id = $_POST['order_id'];

		$requests = $this->M_request->getDataDetailOrder($id);

		$data = array();
		$no = @$_POST['start'];
		foreach ($requests as $request) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $request->name;
			$row[] = $request->qty_requested;

			$row[] = '<button class="btn btn-datatable btn-icon btn-transparent-dark hapus-detail" data-id='."'".$request->id."'".'><span class="fa fa-trash"></span></button>';
			
			$data[] = $row;
		}

		$output = array(
			"draw" => @$_POST['draw'],
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function add()
	{
		$data['page'] 		= "Add Request";
		$data['content'] 	= "admin/v_request/add";

		// generate code with format REQ-random code
		$random = mt_rand(1111,9999);
		$data['code'] = 'REQ-'.$random;
		$data['user'] = $this->session->userdata();


		$this->loadkonten('admin/app_base',$data);
	}

	public function prosesAdd()
	{
		$data = [
			'emp_id' 			=> $this->input->post('code'),
			'code' 			=> $this->input->post('code'),
			'date_order' 		=> $this->input->post('date_order'),
			'status' 		=> 1,
			'type' 		=> $this->input->post('type'),
		];
			
		$result = $this->M_request->save_data($data);
		$id = $this->db->insert_id();

		$detail_material = [];
		$material_id = $this->input->post('material_id');
		foreach ($material_id as $key => $product) {
			$detail_material[] = [
				'order_id'			=> $id,
				'material_id'		=> $this->input->post('material_id['.$key.']'),
				'qty_requested'		=> $this->input->post('qty_requested['.$key.']'),
				'saved_price'		=> $this->input->post('material_price['.$key.']')
			];
		}
		$result = $this->M_request->save_data_detail($detail_material);

		if ($result > 0) {
			$out = array('status'=>'berhasil', 'id'=>1);
		} else {
			$out['status'] = 'gagal';
		}

		echo json_encode($out);
	}

	public function detail($id)
	{
		$data['page'] = "Detail Request";
		$data['request'] = $this->M_request->select_by_id($id);

		$data['content'] 	= "admin/v_request/detail";

		$this->loadkonten('admin/app_base',$data);
	}

	public function Update($id)
	{
		$data['page'] = "Update Request";
		$data['request'] = $this->M_request->select_by_id($id);
		$data['detail'] = $this->M_request->order_detail($id);
		// var_dump($data['detail']);
		// die;

		$data['content'] 	= "admin/v_request/update";

		$this->loadkonten('admin/app_base',$data);
	}

	public function prosesUpdate()
	{
			$where = [
				'id' 		   => $this->input->post('id')
			];
			$data = [
				'code' 			=> $this->input->post('code'),
				'name' 			=> $this->input->post('name'),
				'price' 		=> $this->input->post('price'),
				'stock' 		=> $this->input->post('stock'),
				'unit' 			=> $this->input->post('unit'),
				'warehouse_id' 	=> $this->input->post('warehouse_id'),
				
			];
			$result = $this->M_request->update($data, $where);

			if ($result > 0) {
				$out['status'] = 'berhasil';
			} else {
				$out['status'] = 'gagal';
			}

		echo json_encode($out);
	}

	public function delete()
	{
		$id = $_POST['id'];
		$result = $this->M_request->hapus($id);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}
	}
}

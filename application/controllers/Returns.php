<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Returns extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->library('session');
		$this->load->model('M_return');
		$this->load->model('M_request');
	}

	public function loadkonten($page, $data) {
		$data['username'] 	= $this->session->userdata('username');

		$this->load->view($page, $data);
	}

	public function index()
	{
		$data['page'] 		= "Return";
		$data['content'] 	= "admin/v_return/home";

		$this->loadkonten('admin/app_base',$data);
	}

	public function ajax_list()
	{
		$returns = $this->M_return->getData();

		$data = array();
		$no = @$_POST['start'];
		foreach ($returns as $return) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $return->no_return;
			$row[] = $return->date_return;

			$status = $return->status;
			if ($status == 0) {
				$status_desc = '<span class="badge badge-pill badge-primary">Submitted</span>';
			}elseif ($status==1) {
				$status_desc = '<span class="badge badge-pill badge-success">Accepted</span>';
			}elseif ($status == 2) {
				$status_desc = '<span class="badge badge-pill badge-danger">Rejected</span>';
			}
			$row[] = $status_desc;

			

			if ($this->session->userdata('level') == 2) { //akses action untuk produksi
				$action = '<div class="dropdown">';
				$action .= '<button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"> Action </button>';
				$action .= '<div class="dropdown-menu dropdown-menu-end">';
				$action .= '<a class="dropdown-item" href="' . base_url('return-detail') . "/" . 
				$return->id . '"> Detail</a>';
				$action .= '<a class="dropdown-item" id="accept-return" href="#" data-id='."'". $return->id."'".'> Accept</a>';
				$action .= '<a class="dropdown-item" id="reject-return" href="#" data-id='."'". $return->id."'".'> Reject</a>';
				$action .= '    	</div>';
				$action .= ' </div>';
				$row[] = $action;
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

	public function add()
	{
		$data['page'] 		= "Add Return";
		$data['content'] 	= "admin/v_return/add";

		// generate code with format REQ-random code
		$random = mt_rand(1111,9999);
		$data['code'] = 'RETRN-'.$random;
		$data['user'] = $this->session->userdata();
		$data['order'] = $this->M_return->order_list();


		$this->loadkonten('admin/app_base',$data);
	}

	public function prosesAdd()
	{
		$data = [
			'no_return' 			=> $this->input->post('no_return'),
			'date_return' 		=> $this->input->post('date_return'),
			'status' 		=> 0,
			'note' 		=> $this->input->post('note'),
		];
			
		$result = $this->M_return->save_data($data);
		$id = $this->db->insert_id();

		$detail_material = [];
		$material_id = $this->input->post('material_id');
		foreach ($material_id as $key => $product) {
			$detail_material[] = [
				'return_id'			=> $id,
				'item_id'		=> $this->input->post('material_id['.$key.']'),
				'return_amount'		=> $this->input->post('material_price['.$key.']'),
				'information'		=> $this->input->post('information['.$key.']')
			];
		}
		$result = $this->M_return->save_data_detail($detail_material);

		if ($result > 0) {
			$out = array('status'=>'berhasil', 'id'=>1);
		} else {
			$out['status'] = 'gagal';
		}

		echo json_encode($out);
	}

	public function detail($id)
	{
		$data['page'] = "Detail Return";
		$data['return'] = $this->M_return->select_by_id($id);
		$data['detail'] = $this->M_return->return_detail($id);
		// var_dump($data['return']);
		// die;

		$data['content'] 	= "admin/v_return/detail";

		$this->loadkonten('admin/app_base',$data);
	}

	public function reject()
	{
		$id = $_POST['id'];

		$this->db->set('status', '2');
		$this->db->where('id', $id);
		$result = $this->db->update('tb_return');

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}
	}
	
	public function accept()
	{
		$id = $_POST['id'];

		$this->db->set('status', '1');
		$this->db->where('id', $id);
		$result = $this->db->update('tb_return');

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}
	}

	public function delete()
	{
		$id = $_POST['id'];
		$result = $this->M_return->hapus($id);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}
	}
}

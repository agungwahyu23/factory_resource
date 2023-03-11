<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Returns extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->library('session');
		$this->load->model('M_return');
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
			$row[] = $return->code;
			$row[] = $return->name;
			$row[] = $return->stock;

			$action = '<div class="dropdown">';
			$action .= '<button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"> Action </button>';
			$action .= '<div class="dropdown-menu dropdown-menu-end">';
			$action .= '<a class="dropdown-return" href="' . base_url('return-detail') . "/" . 
			$return->id . '"> Detail</a>';
			$action .= '<a class="dropdown-return" href="' . base_url('return-update') . "/" . 
			$return->id . '"> Update</a>';
			$action .= '<a class="dropdown-return delete-return" href="#" data-id='."'".
			$return->id."'".'> Delete</a>';
			$action .= '    	</div>';
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

	public function add()
	{
		$data['page'] 		= "Add Return";
		$data['content'] 	= "admin/v_return/add";

		// generate code with format REQ-random code
		$random = mt_rand(1111,9999);
		$data['code'] = 'REQ-'.$random;
		$data['user'] = $this->session->userdata();


		$this->loadkonten('admin/app_base',$data);
	}

	public function prosesAdd()
	{
			$id_user 	= $this->session->userdata('id_user');
			$data = [
				'code' 			=> $this->input->post('code'),
				'name' 			=> $this->input->post('name'),
				'price' 		=> $this->input->post('price'),
				'stock' 		=> $this->input->post('stock'),
				'unit' 			=> $this->input->post('unit'),
				'warehouse_id' 	=> $this->input->post('warehouse_id'),
				
			];
			
		$result = $this->M_return->save_data($data);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}

		echo json_encode($out);
	}

	public function detail($id)
	{
		$data['page'] = "Detail Return";
		$data['return'] = $this->M_return->select_by_id($id);

		$data['content'] 	= "admin/v_return/detail";

		$this->loadkonten('admin/app_base',$data);
	}

	public function Update($id)
	{
		$data['page'] = "Update Return";
		$data['return'] = $this->M_return->select_by_id($id);

		$data['content'] 	= "admin/v_return/update";

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
			$result = $this->M_return->update($data, $where);

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
		$result = $this->M_return->hapus($id);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->library('session');
		$this->load->model('M_material');
	}

	public function loadkonten($page, $data) {
		$data['username'] 	= $this->session->userdata('username');

		$this->load->view($page, $data);
	}

	public function index()
	{
		$data['page'] 		= "Material";
		$data['content'] 	= "admin/v_material/home";

		$this->loadkonten('admin/app_base',$data);
	}

	public function ajax_list()
	{
		$materials = $this->M_material->getData();

		$data = array();
		$no = @$_POST['start'];
		foreach ($materials as $material) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $material->code;
			$row[] = $material->name;
			$row[] = $material->price;

			$action = '<div class="dropdown">';
			$action .= '<button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"> Action </button>';
			$action .= '<div class="dropdown-menu dropdown-menu-end">';
			$action .= '<a class="dropdown-item" href="' . base_url('material-update') . "/" . 
			$material->id . '"> Update</a>';
			$action .= '<a class="dropdown-item delete-material" href="#" data-id='."'".
			$material->id."'".'> Delete</a>';
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
		$data['page'] 		= "Add Material";
		$data['content'] 	= "admin/v_material/add";

		// generate code with format MTR-random code
		$random = mt_rand(1111,9999);
		$data['code'] = 'MTR-'.$random;


		$this->loadkonten('admin/app_base',$data);
	}

	public function prosesAdd()
	{
		$data = [
			'code' 			=> $this->input->post('code'),
			'name' 			=> $this->input->post('name'),
			'price' 		=> $this->input->post('price'),
			'unit' 		=> $this->input->post('unit'),
		];
			
		$result = $this->M_material->save_data($data);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}

		echo json_encode($out);
	}

	public function Update($id)
	{
		$data['page'] = "Update Material";
		$data['material'] = $this->M_material->select_by_id($id);

		$data['content'] 	= "admin/v_material/update";

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
				'unit' 		=> $this->input->post('unit'),
				
			];
			$result = $this->M_material->update($data, $where);

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
		$result = $this->M_material->hapus($id);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->library('session');
		$this->load->model('M_item');
	}

	public function loadkonten($page, $data) {
		$data['username'] 	= $this->session->userdata('username');

		$this->load->view($page, $data);
	}

	public function index()
	{
		$data['page'] 		= "Item";
		$data['content'] 	= "admin/v_item/home";

		$this->loadkonten('admin/app_base',$data);
	}

	public function index_material($id)
	{
		$data['page'] 		= "Material";
		$data['content'] 	= "admin/v_item/add_material";
		$data['id'] = $id;
		$data['item'] = $this->M_item->select_by_id($id);
		$data['materials'] = $this->M_item->getMaterial();

		$this->loadkonten('admin/app_base',$data);
	}

	public function ajax_list()
	{
		$items = $this->M_item->getData();

		$data = array();
		$no = @$_POST['start'];
		foreach ($items as $item) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $item->code;
			$row[] = $item->name;
			$row[] = $item->stock;

			$action = '<div class="dropdown">';
			$action .= '<button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"> Action </button>';
			$action .= '<div class="dropdown-menu dropdown-menu-end">';
			$action .= '<a class="dropdown-item" href="' . base_url('item-detail') . "/" . 
			$item->id . '"> Detail</a>';
			$action .= '<a class="dropdown-item" href="' . base_url('item-update') . "/" . 
			$item->id . '"> Update</a>';
			$action .= '<a class="dropdown-item delete-item" href="#" data-id='."'".
			$item->id."'".'> Delete</a>';
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

	public function list_material_item($id)
	{
		$item_materials = $this->M_item->getItemMaterial($id);

		$data = array();
		$no = @$_POST['start'];
		foreach ($item_materials as $material_item) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $material_item->code;
			$row[] = $material_item->name;

			$row[] = '<button class="btn btn-datatable btn-icon btn-transparent-dark hapus-detail" data-id='."'".$material_item->id."'".'><span class="fa fa-trash"></span></button>';
			
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
		$data['page'] 		= "Add Item";
		$data['content'] 	= "admin/v_item/add";

		// generate code with format ITEM-random code
		$random = mt_rand(1111,9999);
		$data['code'] = 'ITEM-'.$random;


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
			
		$result = $this->M_item->save_data($data);
		$id = $this->db->insert_id();

		if ($result > 0) {
			$out = array('status'=>'berhasil', 'id'=>$id);
		} else {
			$out['status'] = 'gagal';
		}

		echo json_encode($out);
	}

	public function prosesAddMaterial()
	{
			$data = [
				'item_id' 			=> $this->input->post('item_id'),
				'raw_material_id' 	=> $this->input->post('raw_material_id'),				
			];
			
		$result = $this->M_item->save_data_material($data);

		if ($result > 0) {
			$out = array('status'=>'berhasil');
		} else {
			$out['status'] = 'gagal';
		}

		echo json_encode($out);
	}

	public function detail($id)
	{
		$data['page'] = "Detail Item";
		$data['item'] = $this->M_item->select_by_id($id);
		$data['id'] = $id;

		$data['content'] 	= "admin/v_item/detail";

		$this->loadkonten('admin/app_base',$data);
	}

	public function Update($id)
	{
		$data['page'] = "Update Item";
		$data['item'] = $this->M_item->select_by_id($id);

		$data['content'] 	= "admin/v_item/update";

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
			$result = $this->M_item->update($data, $where);

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
		$result = $this->M_item->hapus($id);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}
	}

	public function delete_detail()
	{
		$id = $_POST['id'];

		$result = $this->M_item->hapus_detail($id);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chef extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('M_chef');
	}

	public function loadkonten($page, $data) {
		$data['username'] 	= $this->session->userdata('username');

		$this->load->view($page, $data);
	}

	public function index()
	{
		$data['page'] 		= "Chef";
		$data['content'] 	= "admin/v_chef/home";

		$this->loadkonten('admin/app_base',$data);
	}

	public function ajax_list()
	{
		// $kelurahan = $this->session->userdata('idkel');
		$list = $this->M_chef->getData();

		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $brand) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $brand->name;
			$row[] = $brand->email;
			$row[] = $brand->phone;
			if ($brand->gender == '0') {
				$gender = 'Female';
			} else if ($brand->gender == '1') {
				$gender = 'Male';
			}
			$row[] = $gender;

			$action = '<div class="dropdown">';
			$action .= '<button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"> Action </button>';
			$action .= '<div class="dropdown-menu dropdown-menu-end">';
			$action .= '<a class="dropdown-item" href="' . base_url('chef-update') . "/" . 
			$brand->id . '"> Update</a>';
			$action .= '<a class="dropdown-item delete-chef" href="#" data-id='."'".
			$brand->id."'".'> Delete</a>';
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
		// $kelurahan = $this->session->userdata('idkel');
		$data['page'] 		= "Add Chef ";
		$data['content'] 	= "admin/v_chef/add";

		$this->loadkonten('admin/app_base',$data);
	}

	public function prosesAdd()
	{
			$id_user 	= $this->session->userdata('id_user');
			$data = [
				'name' 			=> $this->input->post('name'),
				'email' 		=> $this->input->post('email'),
				'phone' 		=> $this->input->post('phone'),
				'gender' 		=> $this->input->post('gender'),
				'created_date'	=> date('Y-m-d'),
				'created_by'	=> $id_user,
				'updated_date'	=> date('Y-m-d'),
				'updated_by'	=> $id_user
			];
			
		$result = $this->M_chef->save_data($data);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}

		echo json_encode($out);
	}


	public function Update($id)
	{
		$data['page'] = "Update Chef";
		$data['chef'] = $this->M_chef->select_by_id($id);

		$data['content'] 	= "admin/v_chef/update";

		$this->loadkonten('admin/app_base',$data);
	}

	public function prosesUpdate()
	{
		$id_user 	= $this->session->userdata('id_user');
			$where = [
				'id' 		   => $this->input->post('id')
			];
			$data = [
				'name' 			=> $this->input->post('name'),
				'email' 		=> $this->input->post('email'),
				'phone' 		=> $this->input->post('phone'),
				'gender' 		=> $this->input->post('gender'),
				'updated_date'	    => date('Y-m-d'),
				'updated_by'		=> $id_user
			];
			$result = $this->M_chef->update($data, $where);

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
		$result = $this->M_chef->hapus($id);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}
	}
}
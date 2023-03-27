<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->library('session');
		$this->load->model('M_user');
	}

	public function loadkonten($page, $data) {
		$data['username'] 	= $this->session->userdata('username');
		
		$this->load->view($page, $data);
	}

	public function index()
	{
		$data['page'] 		= "User";
		$data['content'] 	= "admin/v_user/home";

		$this->loadkonten('admin/app_base',$data);
	}

	public function ajax_list()
	{
		$list = $this->M_user->getData();

		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $user) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $user->code_employee;
			$row[] = $user->name_of_employee;
			$row[] = $user->no_telp;
			$row[] = $user->part_of;
			$row[] = $user->status;

			$action = '<div class="dropdown">';
			$action .= '<button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"> Action </button>';
			$action .= '<div class="dropdown-menu dropdown-menu-end">';
			$action .= '<a class="dropdown-item" href="' . base_url('user-detail') . "/" . $user->id . '"> Detail</a>';
			$action .= '<a class="dropdown-item" href="' . base_url('user-update') . "/" . 
			$user->id .'"> Update</a>';
			$action .= '<a class="dropdown-item delete-user" href="#" data-id='."'".
			$user->id."'".'> Delete</a>';
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

	public function add()
	{
		$data['page'] 		= "Add User";
		$data['content'] 	= "admin/v_user/add";

		// generate code with format REQ-random code
		$random = mt_rand(1111,9999);
		$data['code'] = 'EMP'.$random;

		$this->loadkonten('admin/app_base',$data);
	}

	public function prosesAdd()
	{
			$id_user 	= $this->session->userdata('id_user');
			$data = [
				'code_employee' 		=> $this->input->post('code_employee'),
				'name_of_employee' 		=> $this->input->post('name_of_employee'),
				'no_telp' 		=> $this->input->post('no_telp'),
				'part_of' 		=> $this->input->post('part_of'),
				'company' 		=> $this->input->post('company'),
				'status' 		=> $this->input->post('status'),
				'level' 		=> $this->input->post('level'),
				'username' 		=> $this->input->post('username'),
				'password' 		=> md5($this->input->post('password'))
			];
			
		$result = $this->M_user->save_data($data);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}

		echo json_encode($out);
	}

	public function Update($id)
	{
		$data['page'] = "Update User";
		$data['user'] = $this->M_user->select_by_id($id);
		$data['content'] 	= "admin/v_user/update";

		$this->loadkonten('admin/app_base',$data);
	}

	public function prosesUpdate()
	{
			$password 	= $this->session->userdata('password');
			$where = [
				'id' 		   => $this->input->post('id')
			];
			if (isset($password)) {
				$data = [
					'code_employee' 		=> $this->input->post('code_employee'),
					'name_of_employee' 		=> $this->input->post('name_of_employee'),
					'no_telp' 		=> $this->input->post('no_telp'),
					'part_of' 		=> $this->input->post('part_of'),
					'company' 		=> $this->input->post('company'),
					'status' 		=> $this->input->post('status'),
					'level' 		=> $this->input->post('level'),
					'username' 		=> $this->input->post('username'),
					'password' 		=> md5($this->input->post('password'))
				];
			}else{
				$data = [
					'code_employee' 		=> $this->input->post('code_employee'),
					'name_of_employee' 		=> $this->input->post('name_of_employee'),
					'no_telp' 		=> $this->input->post('no_telp'),
					'part_of' 		=> $this->input->post('part_of'),
					'company' 		=> $this->input->post('company'),
					'status' 		=> $this->input->post('status'),
					'level' 		=> $this->input->post('level'),
					'username' 		=> $this->input->post('username'),
					// 'password' 		=> md5($this->input->post('password'))
				];
			}
			$result = $this->M_user->update($data, $where);

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
		$result = $this->M_user->hapus($id);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}
	}

	public function Detail($id)
	{
		$data['page'] = "Detail User";
		$data['user'] = $this->M_user->select_by_id($id);

		$data['content'] 	= "admin/v_user/detail";

		$this->loadkonten('admin/app_base',$data);
	}
}

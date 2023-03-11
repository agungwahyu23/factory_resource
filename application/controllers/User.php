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
		foreach ($list as $brand) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $brand->username;
			$row[] = $brand->email;
			if ($brand->gender == '0') {
				$gender = 'Female';
			} else if ($brand->gender == '1') {
				$gender = 'Male';
			}
			$row[] = $gender;
			$row[] = $brand->level;

			$action = '<div class="dropdown">';
			$action .= '<button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"> Action </button>';
			$action .= '<div class="dropdown-menu dropdown-menu-end">';
			$action .= '<a class="dropdown-item" href="' . base_url('user-detail') . "/" . $brand->id_user . '"> Detail</a>';
			$action .= '<a class="dropdown-item" href="' . base_url('user-update') . "/" . 
			$brand->id_user .'"> Update</a>';
			$action .= '<a class="dropdown-item delete-user" href="#" data-id='."'".
			$brand->id_user."'".'> Delete</a>';
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
		$data['group']= $this->M_user->getGroup();

		$this->loadkonten('admin/app_base',$data);
	}

	public function prosesAdd()
	{
			$id_user 	= $this->session->userdata('id_user');
			$data = [
				'username' 		=> $this->input->post('username'),
				'email' 		=> $this->input->post('email'),
				'password' 		=> md5($this->input->post('password')),
				'user_group' 	=> $this->input->post('user_group'),
				'gender' 		=> $this->input->post('gender'),
				'created_date'	=> date('Y-m-d'),
				'created_by'	=> $id_user,
				'updated_date'	=> date('Y-m-d'),
				'updated_by'	=> $id_user
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
		$data['group']= $this->M_user->getGroup();
		$data['content'] 	= "admin/v_user/update";

		$this->loadkonten('admin/app_base',$data);
	}

	public function prosesUpdate()
	{
			$id_user 	= $this->session->userdata('id_user');
			$where = [
				'id' 		   => $this->input->post('id')
			];
			$data = [
				'username' 		=> $this->input->post('username'),
				'email' 		=> $this->input->post('email'),
				'password' 		=> md5($this->input->post('password')),
				'user_group' 	=> $this->input->post('user_group'),
				'gender' 		=> $this->input->post('gender'),
				'updated_date'	    => date('Y-m-d'),
				'updated_by'		=> $id_user
			];
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

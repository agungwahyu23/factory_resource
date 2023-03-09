<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('M_promo');
	}

	public function loadkonten($page, $data) {
		$data['username'] 	= $this->session->userdata('username');

		$this->load->view($page, $data);
	}

	public function index()
	{
		$data['page'] 		= "Promo";
		$data['content'] 	= "admin/v_promo/home";

		$this->loadkonten('admin/app_base',$data);
	}

	public function ajax_list()
	{
		// $kelurahan = $this->session->userdata('idkel');
		$list = $this->M_promo->getData();

		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $brand) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $brand->name;
			$row[] = $brand->date_start;
			$row[] = $brand->date_end;
			if ($brand->is_active == '0') {
				$is_active = '<span class="badge bg-danger text-white">Non Active</span>';
			} else if ($brand->is_active == '1') {
				$is_active = '<span class="badge bg-success text-white">Active</span>';
			}
			$row[] = $is_active;

			$action = '<div class="dropdown">';
			$action .= '<button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"> Action </button>';
			$action .= '<div class="dropdown-menu dropdown-menu-end">';
			$action .= '<a class="dropdown-item" href="' . base_url('promo-detail') . "/" . $brand->id . '"> Detail</a>';
			$action .= '<a class="dropdown-item" href="' . base_url('promo-update') . "/" . 
			$brand->id . '"> Update</a>';
			$action .= '<a class="dropdown-item delete-promo" href="#" data-id='."'".
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
		$data['page'] 		= "Add Promo ";
		$data['content'] 	= "admin/v_promo/add";

		$this->loadkonten('admin/app_base',$data);
	}

	public function prosesAdd()
	{
		$status =  $this->input->post('is_active');
		$id_user 	= $this->session->userdata('id_user');
		$file = 'promo_' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
		$config['upload_path'] = "./upload/promo/";
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = '2048'; //maksimum besar file 1M
		$config['file_name'] = $file;
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		// cek upload image or no
		if ($this->upload->do_upload('image')) {
			if ($status == '1') {
				// set all to nonactive
				$data = array(
					'is_active' => '0'
				);
				$this->db->update('promo', $data);

				// then insert new
				$image = $this->upload->data();
				$data = [
					'name' 			=> $this->input->post('name'),
					'title' 		=> $this->input->post('title'),
					'code_referral' => $this->input->post('code_referral'),
					'description' 	=> $this->input->post('description'),
					'date_start' 	=> $this->input->post('date_start'),
					'date_end' 		=> $this->input->post('date_end'),
					'image' 		=> $image['file_name'],
					'is_active' 	=> $this->input->post('is_active'),
					'created_date'	=> date('Y-m-d'),
					'created_by'	=> $id_user,
					'updated_date'	=> date('Y-m-d'),
					'updated_by'	=> $id_user
				];
			}else{
				$image = $this->upload->data();
				$data = [
					'name' 			=> $this->input->post('name'),
					'title' 		=> $this->input->post('title'),
					'code_referral' => $this->input->post('code_referral'),
					'description' 	=> $this->input->post('description'),
					'date_start' 	=> $this->input->post('date_start'),
					'date_end' 		=> $this->input->post('date_end'),
					'image' 		=> $image['file_name'],
					'is_active' 	=> $this->input->post('is_active'),
					'created_date'	=> date('Y-m-d'),
					'created_by'	=> $id_user,
					'updated_date'	=> date('Y-m-d'),
					'updated_by'	=> $id_user
				];
			}
			
		} else {
			if ($status == '1') {
				// set all to nonactive
				$data = array(
					'is_active' => '0'
				);
				$this->db->update('promo', $data);

				// then add new
				$data = [
					'name' 			=> $this->input->post('name'),
					'title' 		=> $this->input->post('title'),
					'code_referral' => $this->input->post('code_referral'),
					'description' 	=> $this->input->post('description'),
					'date_start' 	=> $this->input->post('date_start'),
					'date_end' 		=> $this->input->post('date_end'),
					'image' 		=> 'no-image.png',
					'is_active' 	=> $this->input->post('is_active'),
					'created_date'	=> date('Y-m-d'),
					'created_by'	=> $id_user,
					'updated_date'	=> date('Y-m-d'),
					'updated_by'	=> $id_user
				];
			}else{
				$data = [
					'name' 			=> $this->input->post('name'),
					'title' 		=> $this->input->post('title'),
					'code_referral' => $this->input->post('code_referral'),
					'description' 	=> $this->input->post('description'),
					'date_start' 	=> $this->input->post('date_start'),
					'date_end' 		=> $this->input->post('date_end'),
					'image' 		=> 'no-image.png',
					'is_active' 	=> $this->input->post('is_active'),
					'created_date'	=> date('Y-m-d'),
					'created_by'	=> $id_user,
					'updated_date'	=> date('Y-m-d'),
					'updated_by'	=> $id_user
				];
			}
			
		}
		$result = $this->M_promo->save_data($data);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}

		echo json_encode($out);
	}


	public function Update($id)
	{
		$data['page'] = "Update Promo";
		$data['promo'] = $this->M_promo->select_by_id($id);

		$data['content'] 	= "admin/v_promo/update";

		$this->loadkonten('admin/app_base',$data);
	}

	public function prosesUpdate()
	{
		$status =  $this->input->post('is_active');
		$id_user 	= $this->session->userdata('id_user');
		$where = [
			'id' 		   => $this->input->post('id')
		];
		$file = 'promo_' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
		$config['upload_path'] = "./upload/promo/";
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = '2048'; //maksimum besar file 1M
		$config['file_name'] = $file;
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		// cek upload or no
		if ($this->upload->do_upload('image')) {
			if ($status == '1') {
				// set all to nonactive
				$data = array(
					'is_active' => '0'
				);
				$this->db->update('promo', $data);

				// then update
				$image = $this->upload->data();
				$data = [
					'name' 			=> $this->input->post('name'),
					'title' 		=> $this->input->post('title'),
					'code_referral' => $this->input->post('code_referral'),
					'description' 	=> $this->input->post('description'),
					'date_start' 	=> $this->input->post('date_start'),
					'date_end' 		=> $this->input->post('date_end'),
					'image' 		=> $image['file_name'],
					'is_active' 	=> $this->input->post('is_active'),
					'created_date'	=> date('Y-m-d'),
					'created_by'	=> $id_user,
					'updated_date'	=> date('Y-m-d'),
					'updated_by'	=> $id_user
				];
			}else{
				$image = $this->upload->data();
				$data = [
					'name' 			=> $this->input->post('name'),
					'title' 		=> $this->input->post('title'),
					'code_referral' => $this->input->post('code_referral'),
					'description' 	=> $this->input->post('description'),
					'date_start' 	=> $this->input->post('date_start'),
					'date_end' 		=> $this->input->post('date_end'),
					'image' 		=> $image['file_name'],
					'is_active' 	=> $this->input->post('is_active'),
					'created_date'	=> date('Y-m-d'),
					'created_by'	=> $id_user,
					'updated_date'	=> date('Y-m-d'),
					'updated_by'	=> $id_user
				];
			}
		} else {
			if ($status == '1') {
				// set all to nonactive
				$data = array(
					'is_active' => '0'
				);
				$this->db->update('promo', $data);

				// then update
				$data = [
					'name' 			=> $this->input->post('name'),
					'title' 		=> $this->input->post('title'),
					'code_referral' => $this->input->post('code_referral'),
					'description' 	=> $this->input->post('description'),
					'date_start' 	=> $this->input->post('date_start'),
					'date_end' 		=> $this->input->post('date_end'),
					'is_active' 	=> $this->input->post('is_active'),
					'created_date'	=> date('Y-m-d'),
					'created_by'	=> $id_user,
					'updated_date'	=> date('Y-m-d'),
					'updated_by'	=> $id_user
				];
			}else{
				$data = [
					'name' 			=> $this->input->post('name'),
					'title' 		=> $this->input->post('title'),
					'code_referral' => $this->input->post('code_referral'),
					'description' 	=> $this->input->post('description'),
					'date_start' 	=> $this->input->post('date_start'),
					'date_end' 		=> $this->input->post('date_end'),
					'is_active' 	=> $this->input->post('is_active'),
					'created_date'	=> date('Y-m-d'),
					'created_by'	=> $id_user,
					'updated_date'	=> date('Y-m-d'),
					'updated_by'	=> $id_user
				];
			}
			
			
		}
			$result = $this->M_promo->update($data, $where);

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
		$result = $this->M_promo->hapus($id);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}
	}

	public function Detail($id)
	{
		$data['page'] = "Detail Promo";
		$data['promo'] = $this->M_promo->select_by_id($id);

		$data['content'] 	= "admin/v_promo/detail";

		$this->loadkonten('admin/app_base',$data);
	}
}

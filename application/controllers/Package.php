<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('M_package');
	}

	public function loadkonten($page, $data) {
		$data['username'] 	= $this->session->userdata('username');

		$this->load->view($page, $data);
	}

	public function index()
	{
		$data['page'] 		= "Package";
		$data['content'] 	= "admin/v_package/home";

		$this->loadkonten('admin/app_base',$data);
	}

	public function ajax_list()
	{
		// $kelurahan = $this->session->userdata('idkel');
		$list = $this->M_package->getData();

		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $brand) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $brand->package_code;
			$row[] = $brand->name;
			$row[] = $brand->title;
			$row[] = $brand->seo;
			if ($brand->is_recomended == '0') {
				$is_recomended = '<span class="badge bg-danger text-white">No Recomended</span>';
			} else if ($brand->is_recomended == '1') {
				$is_recomended = '<span class="badge bg-success text-white">Recomended</span>';
			}
			$row[] = $is_recomended;
			
			$action = '<div class="dropdown">';
			$action .= '<button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"> Action </button>';
			$action .= '<div class="dropdown-menu dropdown-menu-end">';
			$action .= '<a class="dropdown-item" href="' . base_url('package-image') . "/" . $brand->id_package . '"> Image</a>';
			$action .= '<a class="dropdown-item" href="' . base_url('package-schedule') . "/" . $brand->id_package . '"> Schedule</a>';
			$action .= '<a class="dropdown-item" href="' . base_url('package-detail') . "/" . $brand->id_package . '"> Detail</a>';
			$action .= '<a class="dropdown-item" href="' . base_url('package-update') . "/" . 
			$brand->id_package . '"> Update</a>';
			$action .= '<a class="dropdown-item delete-package" href="#" data-id='."'".
			$brand->id_package."'".'> Delete</a>';
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
		$data['page'] 		= "Add Package ";
		$data['content'] 	= "admin/v_package/add";
		$data['chef']= $this->M_package->getChef();

		$this->loadkonten('admin/app_base',$data);
	}

	public function prosesAdd()
	{
		$id_user 	= $this->session->userdata('id_user');
		$file = 'thumbnail_' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
		$config['upload_path'] = "./upload/package/";
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = '2048'; //maksimum besar file 1M
		$config['file_name'] = $file;
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ($this->upload->do_upload('thumbnail')) {
			$image = $this->upload->data();
			$data = [
				'chef_id' 		=> $this->input->post('chef_id'),
				'package_code' 	=> $this->input->post('package_code'),
				'title' 		=> $this->input->post('title'),
				'slug' 		=> $this->input->post('slug'),
				'description' 	=> $this->input->post('description'),
				'is_recomended' => $this->input->post('is_recomended'),
				'term_policy' 	=> $this->input->post('term_policy'),
				'hour_duration' => $this->input->post('hour_duration'),
				'minute_duration' => $this->input->post('minute_duration'),
				'seo' 			=> $this->input->post('seo'),
				'price' 		=> $this->input->post('price'),
				'thumbnail' 	=> $image['file_name'],
				'created_date'	=> date('Y-m-d'),
				'created_by'	=> $id_user,
				'updated_date'	=> date('Y-m-d'),
				'updated_by'	=> $id_user
			];
		} else {
			$data = [
				'chef_id' 		=> $this->input->post('chef_id'),
				'package_code' 	=> $this->input->post('package_code'),
				'title' 		=> $this->input->post('title'),
				'slug' 		=> $this->input->post('slug'),
				'description' 	=> $this->input->post('description'),
				'is_recomended' => $this->input->post('is_recomended'),
				'term_policy' 	=> $this->input->post('term_policy'),
				'hour_duration' => $this->input->post('hour_duration'),
				'minute_duration' => $this->input->post('minute_duration'),
				'seo' 			=> $this->input->post('seo'),
				'price' 		=> $this->input->post('price'),
				'thumbnail' 	=> 'no-image.png',
				'created_date'	=> date('Y-m-d'),
				'created_by'	=> $id_user,
				'updated_date'	=> date('Y-m-d'),
				'updated_by'	=> $id_user
			];
			
		}
		$result = $this->M_package->save_data($data);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}

		echo json_encode($out);
	}

	public function Update($id)
	{
		$data['page'] = "Update Package";
		$data['package'] = $this->M_package->select_by_id($id);
		$data['chef']= $this->M_package->getChef();

		$data['content'] 	= "admin/v_package/update";

		$this->loadkonten('admin/app_base',$data);
	}

	public function prosesUpdate()
	{
		$id_user 	= $this->session->userdata('id_user');
		$where = [
			'id' 		   => $this->input->post('id')
		];
		$file = 'thumbnail_' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
		$config['upload_path'] = "./upload/package/";
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = '2048'; //maksimum besar file 1M
		$config['file_name'] = $file;
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ($this->upload->do_upload('thumbnail')) {
			$image = $this->upload->data();
			$data = [
				'chef_id' 		=> $this->input->post('chef_id'),
				'package_code' 	=> $this->input->post('package_code'),
				'title' 		=> $this->input->post('title'),
				'slug' 		=> $this->input->post('slug'),
				'description' 	=> $this->input->post('description'),
				'is_recomended' => $this->input->post('is_recomended'),
				'term_policy' 	=> $this->input->post('term_policy'),
				'hour_duration' => $this->input->post('hour_duration'),
				'minute_duration' => $this->input->post('minute_duration'),
				'seo' 			=> $this->input->post('seo'),
				'price' 		=> $this->input->post('price'),
				'thumbnail' 	=> $image['file_name'],
				'created_date'	=> date('Y-m-d'),
				'created_by'	=> $id_user,
				'updated_date'	=> date('Y-m-d'),
				'updated_by'	=> $id_user
			];
		} else {
			$data = [
				'chef_id' 		=> $this->input->post('chef_id'),
				'package_code' 	=> $this->input->post('package_code'),
				'title' 		=> $this->input->post('title'),
				'slug' 		=> $this->input->post('slug'),
				'description' 	=> $this->input->post('description'),
				'is_recomended' => $this->input->post('is_recomended'),
				'term_policy' 	=> $this->input->post('term_policy'),
				'hour_duration' => $this->input->post('hour_duration'),
				'minute_duration' => $this->input->post('minute_duration'),
				'seo' 			=> $this->input->post('seo'),
				'price' 		=> $this->input->post('price'),
				'created_date'	=> date('Y-m-d'),
				'created_by'	=> $id_user,
				'updated_date'	=> date('Y-m-d'),
				'updated_by'	=> $id_user
			];
		}
			$result = $this->M_package->update($data, $where);

			if ($result > 0) {
				$out['status'] = 'berhasil';
			} else {
				$out['status'] = 'gagal';
			}

		echo json_encode($out);
	}

	public function Detail($id)
	{
		$data['page'] = "Detail Package";
		$data['package'] = $this->M_package->select_by_id($id);

		$data['content'] 	= "admin/v_package/detail";

		$this->loadkonten('admin/app_base',$data);
	}
	
	public function delete()
	{
		$id = $_POST['id'];
		$result = $this->M_package->delete($id);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}
	}
	
	public function image($id)
	{
		// $kelurahan = $this->session->userdata('idkel');
		$data['page'] = "Image Package";
		$data['package'] = $this->M_package->getImage($id);
		$data['id_package'] = $this->M_package->select_by_idpackage($id);
		
		$data['content'] 	= "admin/v_package/image";

		$this->loadkonten('admin/app_base',$data);
	}

	public function ajax_image($id)
	{
		// $kelurahan = $this->session->userdata('idkel');
		$list  = $this->M_package->getImage($id);

		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $brand) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $brand->package_id;
			$image ='<img class="img-thumbnail" width="200px" height="200px"
			src="'.$brand->image.'" />';
			$row[] = $image;
			if ($brand->is_default == '0') {
			$is_default = '<span class="badge bg-danger text-white">No Default</span>';
			} else if ($brand->is_default == '1') {
			$is_default = '<span class="badge bg-success text-white">Default</span>';
			}
			$row[] = $is_default;

			$row[] = '<button class="btn btn-datatable btn-icon btn-danger delete-image"
				data-id='."'".$brand->id."'".'><span class="fa fa-trash"></span></button>';

			$data[] = $row;
			}

			$output = array(
			"draw" => @$_POST['draw'],
			"data" => $data,
			);
			//output to json format
			echo json_encode($output);
	}

	public function prosesAddImage()
	{
			$id_user 	= $this->session->userdata('id_user');
			$file = 'image_' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
			$config['upload_path'] = "./package-image/";
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '1048'; //maksimum besar file 1M
			$config['file_name'] = $file;
			$config['overwrite'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('image')) {
				$image = $this->upload->data();
				$data = [
				'package_id' => $this->input->post('id'),
				'is_default' => $this->input->post('is_default'),
				'image' => $image['file_name'],
				'created_date' => date('Y-m-d'),
				'created_by' => $id_user,
				'updated_date' => date('Y-m-d'),
				'updated_by' => $id_user
				];
			} else {
				$data = [
				'package_id' => $this->input->post('id'),
				'is_default' => $this->input->post('is_default'),
				'image' => 'no-image.png',
				'created_date' => date('Y-m-d'),
				'created_by' => $id_user,
				'updated_date' => date('Y-m-d'),
				'updated_by' => $id_user
				];

			}
			$result = $this->M_package->save_image($data);

			if ($result > 0) {
				$out['status'] = 'berhasil';
			} else {
				$out['status'] = 'gagal';
			}

			echo json_encode($out);
	}
	
	public function deleteImage()
	{
		$id = $_POST['id'];
		$result = $this->M_package->deleteimage($id);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}
	}

	public function schedule($id)
	{
		$data['page'] = "Schedule Package";
		$data['package'] = $this->M_package->getSchedule($id);
		$data['id_package'] = $this->M_package->select_by_idpackage($id);

		$data['content'] = "admin/v_package/schedule";

		$this->loadkonten('admin/app_base',$data);
	}

	public function ajax_schedule($id)
	{
		// $kelurahan = $this->session->userdata('idkel');
		$list  = $this->M_package->getSchedule($id);

		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $brand) {

			$no++;
			$row = array();
			$row[] = $no;
			// $row[] = $brand->package_id;
			// $row[] = $brand->day;
			$row[] = $brand->start;
			$row[] = $brand->end;

			$row[] = '<button class="btn btn-datatable btn-icon btn-danger delete-schedule"
				data-id='."'".$brand->id."'".'><span class="fa fa-trash"></span></button>';

			$data[] = $row;
			}

			$output = array(
			"draw" => @$_POST['draw'],
			"data" => $data,
			);
			//output to json format
			echo json_encode($output);
	}

	public function prosesAddSchedule()
	{
			$id_user 	= $this->session->userdata('id_user');
			$data = [
			'package_id' => $this->input->post('id'),
			// 'day' => $this->input->post('day'),
			'day' => NULL,
			'start' => $this->input->post('start'),
			'end' => $this->input->post('end'),
			'created_date' => date('Y-m-d'),
			'created_by' => $id_user,
			'updated_date' => date('Y-m-d'),
			'updated_by' => $id_user
			];

			$result = $this->M_package->save_schedule($data);

			if ($result > 0) {
			$out['status'] = 'berhasil';
			} else {
			$out['status'] = 'gagal';
			}

			echo json_encode($out);
	}
	
	public function deleteSchedule()
	{
		$id = $_POST['id'];
		$result = $this->M_package->deleteschedule($id);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}
	}
}
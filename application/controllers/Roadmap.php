<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roadmap extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->library('session');
		$this->load->model('M_roadmap');
		$this->load->model('M_request');
	}

	public function loadkonten($page, $data) {
		$data['username'] 	= $this->session->userdata('username');
		$data['name_of_employee'] 	= $this->session->userdata('name_of_employee');

		$this->load->view($page, $data);
	}

	public function index()
	{
		$data['page'] 		= "Roadmap";
		$data['content'] 	= "admin/v_roadmap/home";

		$this->loadkonten('admin/app_base',$data);
	}

	public function ajax_list()
	{
		$roadmaps = $this->M_roadmap->getData();
		$level = $this->session->userdata('level');

		$data = array();
		$no = @$_POST['start'];
		foreach ($roadmaps as $roadmap) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $roadmap->code;
			$row[] = $roadmap->date_send;

			$status = $roadmap->status;
			if ($status == 1) {
				$status_desc = '<span class="badge badge-pill badge-warning">Processing</span>';
			}elseif ($status==2) {
				$status_desc = '<span class="badge badge-pill badge-primary">Sending</span>';
			}elseif ($status == 3) {
				$status_desc = '<span class="badge badge-pill badge-success">Received</span>';
			}
			$row[] = $status_desc;

			// jika yang login produksi
			if ($level == 1) {
				// cek status
				if ($status == 1 || $status == 3) {
					$action = '<a href="' . base_url('roadmap-detail') . "/" . 
					$roadmap->id . '" class="btn btn-primary btn-sm">View</a>';
				}else{
					$action = '<a href="' . base_url('roadmap-detail') . "/" . 
					$roadmap->id . '" class="btn btn-primary btn-sm">View</a>';
					$action .= '<a href="' . base_url('roadmap-acc') . "/" . 
					$roadmap->id . '" class="btn btn-warning btn-sm ml-2">Accept</a>';
				}
			}elseif ($level == 2) { //jika yang login admin gudang
				$action = '<div class="dropdown">';
				$action .= '<button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown"> Action </button>';
				$action .= '<div class="dropdown-menu dropdown-menu-end">';
				$action .= '<a class="dropdown-item" href="' . base_url('roadmap-detail') . "/" . 
				$roadmap->id . '"> Detail</a>';

				// cek status sudah received/belum
				if ($status != 3) {
					$action .= '<a class="dropdown-item" href="' . base_url('roadmap-update') . "/" . 
					$roadmap->id . '"> Update</a>';
				}

				// $action .= '<a class="dropdown-item delete-roadmap" href="#" data-id='."'".
				// $roadmap->id."'".'> Delete</a>';
				$action .= '    	</div>';
				$action .= ' </div>';
			}
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

	public function list_detail_roadmap($id)
	{
		$roadmap_details = $this->M_roadmap->roadmap_detail($id);

		$data = array();
		$no = @$_POST['start'];
		foreach ($roadmap_details as $rd) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $rd->code;
			$row[] = $rd->name;
			$row[] = $rd->qty_sent;
			$row[] = isset($rd->qty_received) ? $rd->qty_received : '-';
			
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
		$data['page'] 		= "Add Roadmap";
		$data['content'] 	= "admin/v_roadmap/add";

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
		];
			
		$result = $this->M_roadmap->save_data($data);
		$id = $this->db->insert_id();

		$detail_material = [];
		$material_id = $this->input->post('material_id');
		foreach ($material_id as $key => $product) {
			$detail_material[] = [
				'order_id'			=> $id,
				'material_id'		=> $this->input->post('material_id['.$key.']'),
				'qty_roadmaped'		=> $this->input->post('qty_roadmaped['.$key.']'),
				'saved_price'		=> $this->input->post('material_price['.$key.']')
			];
		}
		$result = $this->M_roadmap->save_data_detail($detail_material);

		if ($result > 0) {
			$out = array('status'=>'berhasil', 'id'=>1);
		} else {
			$out['status'] = 'gagal';
		}

		echo json_encode($out);
	}

	public function detail($id)
	{
		$data['page'] = "Detail Roadmap";
		$data['roadmap'] = $this->M_roadmap->select_by_id($id);
		$data['detail'] = $this->M_roadmap->roadmap_detail($id);

		$data['content'] 	= "admin/v_roadmap/detail";

		$this->loadkonten('admin/app_base',$data);
	}

	public function acc($id)
	{
		$data['page'] = "Acc Roadmap";
		$data['roadmap'] = $this->M_roadmap->select_by_id($id);
		$data['detail'] = $this->M_roadmap->roadmap_detail($id);;

		$data['content'] 	= "admin/v_roadmap/acc";

		$this->loadkonten('admin/app_base',$data);
	}
	
	public function prosesAcc()
	{
			$id = $this->input->post('id');
			$order_id = $this->input->post('order_id');

			$where = [
				'id' 		   => $this->input->post('id')
			];
			$data = [
				'status' 		=> 3,
			];
			$result = $this->M_roadmap->update($data, $where);

			$this->db->where('order_id', $order_id);
			$this->db->delete('tb_order_detail');

			$detail_material = [];
			$material_id = $this->input->post('material_id');

			foreach ($material_id as $key => $product) {
				$detail_material[] = [
					'order_id'			=> $order_id,
					'material_id'		=> $this->input->post('material_id['.$key.']'),
					'qty_requested'		=> $this->input->post('qty_requested['.$key.']'),
					'saved_price'		=> $this->input->post('material_price['.$key.']'),
					'qty_received'		=> $this->input->post('qty_received['.$key.']')
				];
			}
			$result = $this->M_roadmap->save_data_detail($detail_material);

			foreach ($material_id as $key => $product) {
				$sum_qty_received =$this->db->query("SELECT SUM(tb_order_detail.qty_received) as sum
				FROM tb_order_detail 
				LEFT JOIN tb_order ON tb_order.id = tb_order_detail.order_id 
				LEFT JOIN tb_roadmap ON tb_roadmap.order_id = tb_order.id 
				WHERE tb_roadmap.status = 3 
				AND tb_order_detail.material_id = '".$product."'")->result();
				
				
				$result_val = floatval($sum_qty_received[0]->sum);

				$this->db->set('qty_total', $result_val);
				$this->db->where('id', $product);
				$this->db->update('tb_raw_material'); 
			}


			if ($result > 0) {
				$out['status'] = 'berhasil';
			} else {
				$out['status'] = 'gagal';
			}

		echo json_encode($out);
	}

	public function Update($id)
	{
		$data['page'] = "Update Roadmap";
		$data['roadmap'] = $this->M_roadmap->select_by_id($id);
		$data['detail'] = $this->M_roadmap->select_by_id_detail($id);

		$data['content'] 	= "admin/v_roadmap/update";

		$this->loadkonten('admin/app_base',$data);
	}

	public function prosesUpdate()
	{
			$where = [
				'id' 		   => $this->input->post('id')
			];
			$data = [
				'status' 			=> $this->input->post('status'),
			];
			$result = $this->M_roadmap->update($data, $where);

			$this->db->where('roadmap_id', $where['id']);
			$this->db->delete('tb_roadmap_detail');

			$detail_material = [];
			$material_id = $this->input->post('material_id');

			foreach ($material_id as $key => $product) {
				$detail_material[] = [
					'roadmap_id'		=> $where['id'],
					'material_id'		=> $this->input->post('material_id['.$key.']'),
					'qty_sent'		=> $this->input->post('qty_sent['.$key.']')
				];
			}
			$result = $this->M_roadmap->save_detail_material($detail_material);

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
		$result = $this->M_roadmap->hapus($id);

		if ($result > 0) {
			$out['status'] = 'berhasil';
		} else {
			$out['status'] = 'gagal';
		}
	}
}

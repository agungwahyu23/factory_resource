<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_request extends CI_Model
{

	public function getData()
	{
		$sql = "SELECT * FROM tb_order ORDER BY id ASC";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function getDataMaterial()
	{
		$sql = "SELECT * FROM tb_raw_material ORDER BY id ASC";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function getDataDetailOrder($id)
	{
		$sql = "SELECT od.*, material.name 
				FROM tb_order_detail as od
				LEFT JOIN tb_raw_material as material ON material.id = od.material_id 
				where od.order_id = '".$id."' ORDER BY id ASC";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function save_data($data)
	{
		$result = $this->db->insert('tb_order', $data);
		return $result;
	}

	public function save_data_detail($data)
	{
		$result = $this->db->insert_batch('tb_order_detail', $data);
		return $result;
	}

	public function select_by_id($id)
	{
		$sql = "SELECT * FROM tb_item where id = ?";
		$data = $this->db->query($sql, array($id));
		return $data->row();
	}

	public function update($data, $where)
	{
		$result = $this->db->update('tb_item', $data, $where);
		return $result;
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM tb_item WHERE id='" . $id . "'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_item extends CI_Model
{

	public function getData()
	{
		$sql = "SELECT * FROM tb_item ORDER BY id ASC";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function getMaterial()
	{
		$sql = "SELECT * FROM tb_raw_material ORDER BY id ASC";
		$data = $this->db->query($sql);
		return $data->result();
	}
	
	public function getItemMaterial($id)
	{
		$this->db->select('tb_item_material.*,tb_raw_material.code, tb_raw_material.name');
		$this->db->from('tb_item_material');
		$this->db->join('tb_raw_material', 'tb_raw_material.id = tb_item_material.raw_material_id', 'left');
		$this->db->where('tb_item_material.item_id', $id);
		$data = $this->db->get();
		
		return $data->result();
	}

	public function save_data($data)
	{
		$result = $this->db->insert('tb_item', $data);
		return $result;
	}
	
	public function save_data_material($data)
	{
		$result = $this->db->insert('tb_item_material', $data);
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

	public function hapus_detail($id)
	{
		$sql = "DELETE FROM tb_item_material WHERE id='" . $id . "'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_material extends CI_Model
{

	public function getData()
	{
		$sql = "SELECT * FROM tb_raw_material ORDER BY id ASC";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function save_data($data)
	{
		$result = $this->db->insert('tb_raw_material', $data);
		return $result;
	}

	public function select_by_id($id)
	{
		$sql = "SELECT * FROM tb_raw_material where id = ?";
		$data = $this->db->query($sql, array($id));
		return $data->row();
	}

	public function update($data, $where)
	{
		$result = $this->db->update('tb_raw_material', $data, $where);
		return $result;
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM tb_raw_material WHERE id='" . $id . "'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
}

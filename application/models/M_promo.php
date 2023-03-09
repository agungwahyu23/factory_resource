<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Promo extends CI_Model
{

	public function getData()
	{
		$sql = "SELECT * FROM promo ORDER BY id ASC";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function save_data($data)
	{
		$result = $this->db->insert('promo', $data);
		return $result;
	}

	public function select_by_id($id)
	{
		$sql = "SELECT * FROM promo where id = ?";
		$data = $this->db->query($sql, array($id));
		return $data->row();
	}

	public function update($data, $where)
	{
		$result = $this->db->update('promo', $data, $where);
		return $result;
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM promo WHERE id='" . $id . "'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
}
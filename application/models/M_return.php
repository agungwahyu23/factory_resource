<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_return extends CI_Model
{

	public function getData()
	{
		$sql = "SELECT * FROM tb_return ORDER BY id ASC";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function order_list()
	{
		$sql = "SELECT * FROM tb_order ORDER BY id ASC";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function save_data($data)
	{
		$result = $this->db->insert('tb_return', $data);
		return $result;
	}

	public function save_data_detail($data)
	{
		$result = $this->db->insert_batch('tb_return_detail', $data);
		return $result;
	}

	public function select_by_id($id)
	{
		$sql = "SELECT * FROM tb_return where id = ?";
		$data = $this->db->query($sql, array($id));
		return $data->row();
	}

	public function return_detail($id)
	{
		$sql = "SELECT rd.item_id, rd.return_amount, rd.information, r.code, r.name
		FROM tb_return_detail as rd
		LEFT JOIN tb_raw_material as r ON rd.item_id=r.id
		where rd.return_id = ?";
		$data = $this->db->query($sql, array($id));
		return $data->result();
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

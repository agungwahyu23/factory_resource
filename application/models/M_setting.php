<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_setting extends CI_Model
{

	public function getData()
	{
		$sql = "SELECT * FROM setting ORDER BY id ASC";
		$data = $this->db->query($sql);
		return $data->row();
	}

	public function save_data($data)
	{
		$result = $this->db->insert('setting', $data);
		return $result;
	}

	public function update($data)
	{
		$result = $this->db->update('setting', $data);
		return $result;
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM setting WHERE id='" . $id . "'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
}

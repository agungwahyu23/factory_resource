<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
	public function cek_login($username, $password)
	{
		$sql = "SELECT * FROM tb_employee WHERE username = '$username' AND password = '$password'";
		$query = $this->db->query($sql);
		$user = $query->row();
		if (!empty($user)) {
			return $query->result_array();
		} else {
			return FALSE;
		}
	}

	public function getData()
	{
		$sql = "SELECT u.id, 
		u.code_employee, 
		u.name_of_employee, 
		u.no_telp, 
		u.part_of,
		CASE
			WHEN u.status = '1' THEN 'Active'
			WHEN u.status = '2' THEN 'Nonactive'
			else '-' 
		END as status
		FROM tb_employee u";
		$data = $this->db->query($sql);
		return $data->result();
	}
	
	public function save_data($data)
	{
		$result = $this->db->insert('tb_employee', $data);
		return $result;
	}

	public function select_by_id($id)
	{
		$sql = "SELECT e.*  FROM tb_employee e where e.id = ?";
		$data = $this->db->query($sql, array($id));
		return $data->row();
	}

	public function update($data, $where)
	{
		$result = $this->db->update('tb_employee', $data, $where);
		return $result;
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM tb_employee WHERE id='" . $id . "'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
}

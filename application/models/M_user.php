<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
	public function cek_login($username, $password)
	{
		$sql = "SELECT a.id as id_user, a.* , b.*  FROM user a LEFT JOIN user_group b ON a.user_group=b.id WHERE a.username = '$username' AND  a.password = '$password'";
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
		$sql = "SELECT a.id as id_user, a.* , b.* FROM user a LEFT JOIN user_group b ON a.user_group=b.id ";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function getGroup()
	{
		$sql = "SELECT * FROM user_group ORDER BY id ASC";
		$data = $this->db->query($sql);
		return $data->result();
	}
	
	public function save_data($data)
	{
		$result = $this->db->insert('user', $data);
		return $result;
	}

	public function select_by_id($id)
	{
		$sql = "SELECT a.id as id_user, a.* , b.*  FROM user a LEFT JOIN user_group b ON a.user_group=b.id where a.id = ?";
		$data = $this->db->query($sql, array($id));
		return $data->row();
	}

	public function update($data, $where)
	{
		$result = $this->db->update('user', $data, $where);
		return $result;
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM user WHERE id='" . $id . "'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
}
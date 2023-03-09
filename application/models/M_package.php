<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_package extends CI_Model
{

	public function getData()
	{
		$sql = "SELECT a.id as id_package,  a.* , b.* , c.* ,d.* FROM package a 
		LEFT JOIN package_image b ON a.id=b.package_id 
		LEFT JOIN package_schedule c ON a.id=c.package_id 
		LEFT JOIN chef d ON d.id=a.chef_id 
		GROUP BY a.id";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function getChef()
	{
		$sql = "SELECT * FROM chef ORDER BY id ASC";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function save_data($data)
	{
		$result = $this->db->insert('package', $data);
		return $result;
	}

	public function select_by_id($id)
	{
		$sql = "SELECT a.id as id_package,  a.* , b.* , c.* ,d.* FROM package a 
		LEFT JOIN package_image b ON a.id=b.package_id 
		LEFT JOIN package_schedule c ON a.id=c.package_id 
		LEFT JOIN chef d ON d.id=a.chef_id  where a.id = ?";
		$data = $this->db->query($sql, array($id));
		return $data->row();
	}

	public function update($data, $where)
	{
		$result = $this->db->update('package', $data, $where);
		return $result;
	}

	public function delete($id)
	{
		$sql = "DELETE FROM package WHERE id='" . $id . "'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function getImage($id)
	{
		$sql = "SELECT * FROM package_image where package_id = ?";
		$data = $this->db->query($sql, array($id));
		return $data->result();
	}

	public function save_image($data)
	{
		$result = $this->db->insert('package_image', $data);
		return $result;
	}
	
	public function getSchedule($id)
	{
		$sql = "SELECT * FROM package_schedule where package_id = ?";
		$data = $this->db->query($sql, array($id));
		return $data->result();
	}

	public function save_schedule($data)
	{
		$result = $this->db->insert('package_schedule', $data);
		return $result;
	}

	public function select_by_idpackage($id)
	{
		$sql = "SELECT * FROM package  where id = ?";
		$data = $this->db->query($sql, array($id));
		return $data->row();
	}

	public function deleteimage($id)
	{
		$sql = "DELETE FROM package_image WHERE id='" . $id . "'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function deleteschedule($id)
	{
		$sql = "DELETE FROM package_schedule WHERE id='" . $id . "'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
}
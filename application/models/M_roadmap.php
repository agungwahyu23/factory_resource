<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_roadmap extends CI_Model
{

	public function getData()
	{
		$sql = "SELECT * FROM tb_roadmap ORDER BY id ASC";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function save_data($data)
	{
		$result = $this->db->insert('tb_order', $data);
		return $result;
	}

	public function select_by_id($id)
	{
		$sql = "SELECT tb_roadmap.*, 
		tb_employee.name_of_employee, 
		tb_employee.company,
		CASE 
			WHEN tb_roadmap.status = 1 THEN 'Processed'
    		WHEN tb_roadmap.status = 1 THEN 'Processed'
    		ELSE '-'
		END
		FROM tb_roadmap 
		LEFT JOIN tb_employee ON tb_roadmap.emp_id = tb_employee.id
		where tb_roadmap.id = ?";
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

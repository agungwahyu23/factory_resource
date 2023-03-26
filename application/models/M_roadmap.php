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

	public function save_data_detail($data)
	{
		$result = $this->db->insert_batch('tb_order_detail', $data);
		return $result;
	}

	public function select_by_id($id)
	{
		$sql = "SELECT tb_roadmap.*, 
		tb_employee.name_of_employee, 
		tb_employee.company,
		CASE 
			WHEN tb_roadmap.status = 1 THEN 'Processed'
    		WHEN tb_roadmap.status = 2 THEN 'Sending'
    		WHEN tb_roadmap.status = 3 THEN 'Received'
    		ELSE '-'
		END AS status
		FROM tb_roadmap 
		LEFT JOIN tb_employee ON tb_roadmap.emp_id = tb_employee.id
		where tb_roadmap.id = ?";
		$data = $this->db->query($sql, array($id));
		return $data->row();
	}

	public function roadmap_detail($id)
	{
		$sql = "SELECT rd.id, 
		rd.roadmap_id, 
		rd.material_id, 
		rd.qty_sent,
		rm.code,
		rm.order_id,
		od.qty_requested,
		od.saved_price,
		m.name 
		FROM tb_roadmap_detail as rd
		LEFT JOIN tb_roadmap as rm ON rm.id = rd.roadmap_id
		LEFT JOIN tb_raw_material as m ON rd.material_id=m.id
		LEFT JOIN tb_order_detail AS od ON od.order_id = rm.order_id
		where rd.roadmap_id = ? AND rd.material_id=od.material_id";
		$data = $this->db->query($sql, array($id));
		return $data->result();
	}

	public function update($data, $where)
	{
		$result = $this->db->update('tb_roadmap', $data, $where);
		return $result;
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM tb_item WHERE id='" . $id . "'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
}

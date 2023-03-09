<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_order extends CI_Model
{

	public function getData()
	{
		$sql = "SELECT a.id as id_order, a.name as namaorder, b.name as namapromo, a.* , b.* , c.* FROM `order` a 
		LEFT JOIN promo b ON a.promo_id=b.id 
		LEFT JOIN package c ON a.package_id=c.id ";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function select_by_id($id)
	{
		$sql = "SELECT a.id as id_order, a.name as namaorder, b.name as namapromo, a.* , b.* , c.* FROM `order` a 
		LEFT JOIN promo b ON a.promo_id=b.id 
		LEFT JOIN package c ON a.package_id=c.id where a.id = ?";
		$data = $this->db->query($sql, array($id));
		return $data->row();
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM user WHERE id='" . $id . "'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
}
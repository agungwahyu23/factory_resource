<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_report extends CI_Model 
{
    
    public function view_all()
    {
        return $this->db->get('tb_order')->result(); // Tampilkan semua data transaksi
    }

    public function view_by_date($tgl_awal, $tgl_akhir)
    {
        $tgl_awal = $this->db->escape($tgl_awal);
        $tgl_akhir = $this->db->escape($tgl_akhir);

        $this->db->select('tb_order.*, tb_order_detail.material_id, count(tb_order_detail.id) as tot');
		$this->db->from('tb_order');
		$this->db->join('tb_order_detail', 'tb_order_detail.order_id = tb_order.id', 'left');
		$this->db->where('DATE(date_order) BETWEEN '.$tgl_awal.' AND '.$tgl_akhir); // Tambahkan where tanggal nya
        $this->db->group_by('tb_order.id');
		$data = $this->db->get();
		
		return $data->result();
    }
}
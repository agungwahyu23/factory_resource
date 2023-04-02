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
        $this->db->where('DATE(date_order) BETWEEN '.$tgl_awal.' AND '.$tgl_akhir); // Tambahkan where tanggal nya
        
        return $this->db->get('tb_order')->result();// Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
    }
}
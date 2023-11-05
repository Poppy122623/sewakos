<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_tagihan extends CI_Model
{

    function __construct()
    {
        $this->tableName = 'tagihan';
    }


    public function get_all($getidpenyewa)
    {

        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->join('sewa_kamar', 'sewa_kamar.id_sewa = ' . $this->tableName . '.id_sewa');
        // Menghubungkan tabel dengan ON clause
        $this->db->where($this->tableName . '.id_penyewa', $getidpenyewa); // Menggunakan nilai $getidpenyewa dari parameter

        $query = $this->db->get();

        $result = $query->result_array();

        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }









}
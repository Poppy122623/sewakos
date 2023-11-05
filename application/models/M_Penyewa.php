<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_penyewa extends CI_Model
{

    function __construct()
    {
        $this->tableName = 'penyewa';
    }


    public function data_penyewa($getiduser)
    {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where('id_user', $getiduser); // Menggunakan nilai $getiduser dari parameter

        $query = $this->db->get();

        $result = $query->result_array();

        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function getid_penyewa($getiduser)
    {
        $this->db->select('id_penyewa');
        $this->db->from($this->tableName);
        $this->db->where('id_user', $getiduser);
        $query = $this->db->get();

        $result = $query->row_array();

        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }




}
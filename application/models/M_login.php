<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_login extends CI_Model
{

    function __construct()
    {
        $this->tableName = 'user';
    }


    public function login($username, $password)
    {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get();

        $result = $query->row_array();

        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }



}
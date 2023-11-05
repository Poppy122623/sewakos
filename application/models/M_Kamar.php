<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_kamar extends CI_Model
{

    function __construct()
    {

    }


    public function get_all()
    {
        $sql = "SELECT * FROM kamar JOIN jenis_kamar ON jenis_kamar.id_jeniskamar = kamar.id_jeniskamar JOIN tarif_kamar ON tarif_kamar.no_kamar = kamar.no_kamar WHERE status_kamar = 'Y'";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array(); // Mengembalikan semua hasil dalam bentuk array
        } else {
            return false; // Mengembalikan false jika tidak ada data yang ditemukan
        }
    }








}
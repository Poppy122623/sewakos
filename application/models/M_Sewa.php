<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_sewa extends CI_Model
{

    function __construct()
    {
        $this->tableName = 'sewa_kamar';
    }


    public function get_all($getidpenyewa)
    {

        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->join('penyewa', 'penyewa.id_penyewa = ' . $this->tableName . '.id_penyewa'); // Menghubungkan tabel dengan ON clause
        $this->db->where($this->tableName . '.id_penyewa', $getidpenyewa); // Menggunakan nilai $getidpenyewa dari parameter

        $query = $this->db->get();

        $result = $query->result_array();

        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function get_datasewa($id)
    {
        $this->db->from($this->tableName);
        $this->db->where($this->tableName . '.id_sewa', $id);
        $query = $this->db->get();

        return ($query->num_rows() > 0) ? $query->row_array() : null;
    }


    public function hapus_sewa($id_sewa)
    {
        $this->db->where('id_sewa', $id_sewa);
        $this->db->delete('sewa_kamar');
        return $this->db->affected_rows() > 0;
    }

    public function simpan_sewa($id_penyewa, $no_kamar, $tanggal_awal, $tanggal_akhir)
    {
        $query = $this->db->query("SELECT MAX(id_sewa) AS max_id FROM sewa_kamar");
        $row = $query->row();
        $max_id = $row->max_id;

        $data = array(
            'id_sewa' => $max_id + 1,
            'id_penyewa' => $id_penyewa,
            'no_kamar' => $no_kamar,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'status_sewa' => 'Y'
        );

        $this->db->insert('sewa_kamar', $data);

        if ($this->db->affected_rows() > 0) {
            return true; // Penyimpanan berhasil
        } else {
            return false; // Gagal menyimpan data
        }
    }

    public function update_sewa($id_sewa, $id_penyewa, $no_kamar, $tanggal_awal, $tanggal_akhir)
    {
        $data = array(
            'id_penyewa' => $id_penyewa,
            'no_kamar' => $no_kamar,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'status_sewa' => 'Y'
        );

        $this->db->where('id_sewa', $id_sewa);
        $this->db->update('sewa_kamar', $data);

        return $this->db->affected_rows() > 0;
    }








}
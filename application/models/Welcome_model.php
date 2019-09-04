<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome_model extends CI_Model
{
    public function getAllData($idpenjual)
    {
        return $this->db->get_where('barang_penjual', ['id_penjual' => $idpenjual])->result_array();
    }

    public function getDataBarangDetail($idBarang)
    {
        return $this->db->get_where('barang_penjual', ['id' => $idBarang])->row_array();
    }
}

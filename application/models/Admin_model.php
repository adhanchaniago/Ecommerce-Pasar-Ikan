<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getPesananCair($limit, $start)
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('cairkan', $limit, $start)->result_array();
    }

    public function getAllPesanan($limit, $start)
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('pesanan', $limit, $start)->result_array();
    }



    public function cairkan()
    {
        $input = $this->input;
        $id = $input->post('id');

        $this->db->update('cairkan', ['status' => 0], ['id' => $id]);
    }

    public function getPesanan()
    {
        return $this->db->get_where('pesanan', ['id_status =' => 2])->result_array();
    }

    public function getDataPesanan($id)
    {
        return $this->db->get_where('pesanan', ['id' => $id, 'id_status =' => 2])->row_array();
    }

    public function kirimPesanan()
    {
        $input = $this->input;
        $id = $input->post('id');

        $data = [
            'id_status' => 3
        ];

        $this->db->update('pesanan', $data, ['id' => $id]);
    }

    public function editProfile($id)
    {
        $input = $this->input;

        $data = [
            'email' => $input->post('email'),
            'name' => $input->post('name'),
            'address' => $input->post('address'),
            'no_telp' => $input->post('no_telp')
        ];

        $this->db->update('users', $data, ['id' => $id]);
    }
}

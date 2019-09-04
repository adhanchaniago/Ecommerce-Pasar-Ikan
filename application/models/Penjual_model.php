<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjual_model extends CI_Model
{

    public function tambahDataBarang($gambar, $id_penjual)
    {
        $input = $this->input;

        $idPasar = $this->db->get_where('users', ['id' => $id_penjual])->row_array()['id_pasar'];
        $dataPasar = $this->db->get_where('pasar', ['id' => $idPasar])->row_array();

        $dataSatuan = [
            'satuan' => $input->post('satuan'),
            'stok' => $input->post('stok_ikan')
        ];

        $stokJson = json_encode($dataSatuan);

        $data = [
            'id_penjual' => $id_penjual,
            'nama_barang' => $input->post('name_ikan'),
            'stock_barang' => $stokJson,
            'harga_barang' => $input->post('harga_ikan'),
            'image_barang' => $gambar,
            'latitude' => $dataPasar['latitude'],
            'longtitude' => $dataPasar['longtitude']
        ];

        $this->db->insert('barang_penjual', $data);
    }

    public function ubahDataBarang($gambar)
    {
        $input = $this->input;
        $id = $input->post('id');

        $dataSatuan = [
            'satuan' => $input->post('satuan'),
            'stok' => $input->post('stok_ikan')
        ];

        $stokJson = json_encode($dataSatuan);

        $data = [
            'nama_barang' => $input->post('name_ikan'),
            'stock_barang' => $stokJson,
            'harga_barang' => $input->post('harga_ikan'),
            'image_barang' => $gambar,
        ];

        $this->db->update('barang_penjual', $data, ['id' => $id]);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('barang_penjual');
    }

    public function getAllData($idPenjual)
    {
        return $this->db->get_where('barang_penjual', ['id_penjual' => $idPenjual])->result_array();
    }

    public function getDataBarang($idBarang)
    {
        return $this->db->get_where('barang_penjual', ['id' => $idBarang])->row_array();
    }

    public function getPesanan($idPenjual)
    {
        return $this->db->get_where('pesanan', ['id_penjual' => $idPenjual, 'id_status' => 3])->result_array();
    }

    public function getDiterima($idPenjual)
    {
        $this->db->where('id_penjual', $idPenjual);
        $this->db->where('id_pencairan', 0);
        $this->db->where('id_status', 6);
        return $this->db->get('pesanan')->result_array();
    }

    public function getPesananProses($idPenjual)
    {
        return $this->db->get_where('pesanan', ['id_penjual' => $idPenjual, 'id_status' => 4])->result_array();
    }

    public function tambahResi()
    {
        $input = $this->input;
        $id = $input->post('id');

        $data = [
            'resi' => $input->post('nomor_resi'),
            'id_status' => 5
        ];

        $this->db->update('pesanan', $data, ['id' => $id]);
    }

    public function ditolak()
    {
        $input = $this->input;
        $id = $input->post('id');

        $data = [
            'id_status' => $input->post('status')
        ];

        $this->db->update('pesanan', $data, ['id' => $id]);
    }

    public function diproses()
    {
        $input = $this->input;
        $id = $input->post('id');

        $this->db->update('pesanan', ['id_status' => 4], ['id' => $id]);
    }

    public function getDataPencairannya()
    {
        $dataId = $this->input->post('ceklist');

        $totalnya = 0;
        $idPesanan = '';

        foreach ($dataId as $val) {
            $dana = $this->db->get_where('pesanan', ['id' => $val])->row_array();
            $totalnya = $totalnya + $dana['biaya'];
            $idPesanan .= $val . ',';
        }

        return [
            'idPesanan' => $idPesanan,
            'total' => $totalnya
        ];
    }

    public function sudahDicairkan($idPenjual)
    {
        $input = $this->input;

        $dataPesanan = $input->post('idPesanan');

        $idPesanan = explode(',', $dataPesanan);
        array_pop($idPesanan);

        foreach ($idPesanan as $value) {
            $this->db->update('pesanan', ['id_pencairan' => 1], ['id' => $value]);
        }

        $dataInsert = [
            'id_user' => $idPenjual,
            'nama_penerima' => $input->post('penerima'),
            'nomor_rekening' => $input->post('rekening'),
            'nama_bank' => $input->post('bank'),
            'jumlah_dana' => $input->post('jumlahPencairan'),
            'status' => 1
        ];

        $this->db->insert('cairkan', $dataInsert);
    }
}

/* End of file ModelName.php */

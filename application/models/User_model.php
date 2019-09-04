<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getDataBarang()
    {
        return $this->db->get('barang_penjual', 4)->result_array();
    }

    public function getPesanan($idPembeli)
    {
        return $this->db->get_where('pesanan', ['id_pembeli' => $idPembeli, 'id_status' => 1])->result_array();
    }

    public function getbarangDiproses($idPembeli)
    {
        $data = $this->db->get_where('pesanan', ['id_pembeli' => $idPembeli, 'id_status !=' => 1])->result_array();

        foreach ($data as $d) {
            $this->db->update('pesanan', ['status_notif' => 0], ['id' => $d['id']]);
        }

        return $data;
    }

    public function getDataPesanan($idBarang)
    {
        return $this->db->get_where('pesanan', ['id' => $idBarang])->row_array();
    }

    public function getAllData()
    {
        return $this->db->get_where('barang_penjual')->result_array();
    }

    public function getDataBarangDetail($idBarang)
    {
        return $this->db->get_where('barang_penjual', ['id' => $idBarang])->row_array();
    }

    public function getDetailBarang($id)
    {
        return $this->db->get_where('barang_penjual', ['id' => $id])->row_array();
    }

    public function tambahPesanan($idPembeli, $idPenjual, $data_barang)
    {
        $input = $this->input;

        $data = [
            'id_pembeli' => $idPembeli,
            'id_penjual' => $idPenjual,
            'id_barang' => $data_barang,
            'jmlh_barang' => $input->post('jmlh_barang'),
            'id_satuan' => $input->post('stn_berat'),
            'request' => $input->post('request'),
            'alamat' => $input->post('alamatkirim'),
            'biaya' => $input->post('totalHrgBrgOngkir'),
            'id_status' => 1,
            'pesanan_dibuat' => time()
        ];

        $this->db->insert('pesanan', $data);

        $cariDataBrg = json_decode($this->db->get_where('barang_penjual', ['id' => $data_barang])->row_array()['stock_barang'], true);
        $stokTerbaru = 0;

        if ($cariDataBrg['satuan'] == 'ons') {
            if ($input->post('stn_berat') == 1) {
                $stokTerbaru = $cariDataBrg['stok'] - $input->post('jmlh_barang');
            } else {
                $konvertOns = $input->post('jmlh_barang') * 10;
                $stokTerbaru = $cariDataBrg['stok'] - $konvertOns;
            }
        } else {
            if ($input->post('stn_berat') == 2) {
                $stokTerbaru = $cariDataBrg['stok'] - $input->post('jmlh_barang');
            } else {
                $konvertOns = $input->post('jmlh_barang') / 10;
                $stokTerbaru = $cariDataBrg['stok'] - $konvertOns;
            }
        }

        $updateBrg = [
            'satuan' => $cariDataBrg['satuan'],
            'stok' => $stokTerbaru
        ];

        $this->db->update('barang_penjual', ['stock_barang' => json_encode($updateBrg)], ['id' => $data_barang]);
    }

    public function MenungguRespon($gambar)
    {
        $input = $this->input;
        $id = $input->post('id');

        $this->db->update('pesanan', ['id_status' => 2, 'image' => $gambar], ['id' => $id]);
    }

    public function delete($id)
    {
        $dataBrg = $this->db->get_where('pesanan', ['id' => $id])->row_array();
        $stockBrg = json_decode($this->db->get_where('barang_penjual', ['id' => $dataBrg['id_barang']])->row_array()['stock_barang'], true);
        $stokUpdate = 0;

        if ($stockBrg['satuan'] == 'ons') {
            if ($dataBrg['id_satuan'] == 1) {
                $stokUpdate = $stockBrg['stok'] + $dataBrg['jmlh_barang'];
            } else {
                $konvertOns = $dataBrg['jmlh_barang'] * 10;
                $stokUpdate = $stockBrg['stok'] + $konvertOns;
            }
        } else {
            if ($dataBrg['id_satuan'] == 2) {
                $stokUpdate = $stockBrg['stok'] + $dataBrg['jmlh_barang'];
            } else {
                $konverKilo = $dataBrg['jmlh_barang'] / 10;
                $stokUpdate = $stockBrg['stok'] + $konverKilo;
            }
        }

        $dataUpdate = [
            'satuan' =>  $stockBrg['satuan'],
            'stok' => $stokUpdate
        ];



        $this->db->update('barang_penjual', ['stock_barang' => json_encode($dataUpdate)], ['id' => $dataBrg['id_barang']]);

        // $this->db->where('id', $id);
        $this->db->delete('pesanan', ['id' => $id]);
    }

    public function diterima()
    {
        $input = $this->input;
        $id = $input->post('id');

        $this->db->update('pesanan', ['id_status' => 6], ['id' => $id]);
    }

    public function get_search($search)
    {
        $this->db->like('nama_barang', $search);
        return $this->db->get('barang_penjual')->result_array();
    }

    public function getDitolak($idPembeli)
    {
        $this->db->where('id_pembeli', $idPembeli);
        $this->db->where('id_pencairan', 0);
        $this->db->where('id_status', 7);
        return $this->db->get('pesanan')->result_array();
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

    public function sudahDicairkan($idPembeli)
    {
        $input = $this->input;

        $dataPesanan = $input->post('idPesanan');

        $idPesanan = explode(',', $dataPesanan);
        array_pop($idPesanan);

        foreach ($idPesanan as $value) {
            $this->db->update('pesanan', ['id_pencairan' => 1], ['id' => $value]);
        }

        $dataInsert = [
            'id_user' => $idPembeli,
            'nama_penerima' => $input->post('penerima'),
            'nomor_rekening' => $input->post('rekening'),
            'nama_bank' => $input->post('bank'),
            'jumlah_dana' => $input->post('jumlahPencairan'),
            'status' => 1
        ];

        $this->db->insert('cairkan', $dataInsert);
    }

    public function getFilterData()
    {
        $data = $this->input->get('keyword');
        $filter = $this->input->get('filter');
        $latitude = $this->input->get('lati');
        $longtitude = $this->input->get('longti');

        $this->db->like('nama_barang', $data);
        if ($filter == 'harga_barang') {
            $this->db->order_by('harga_barang', 'ASC');
        } else {
            $this->db->order_by('stock_barang', 'DESC');
        }
        $hasil = $this->db->get('barang_penjual')->result_array();

        $value = '';
        $valueTerdekat = '';
        $dataPasarSementara = [];
        $dataJarakPasar = [];

        foreach ($hasil as $val) {
            $value .= '<div class="col-sm m-wthree">
            <div class="col-m">
                <img src="' . base_url('assets/img/barang/') . $val['image_barang'] . '" class="img-fluid" alt="" style="width:150px;height:150px;">
                <div class="mid-1">
                    <div class="women">
                        <p style="font-size:16px;"><b>' . $val['nama_barang'] . '</b></p>
                        <h6>Stock :' . $val['stock_barang'] . ' Kg</h6>
                    </div>
                    <div class="mid-2">
                        <p><em class="item_price">Rp.' . number_format($val['harga_barang'], 0, ',', '.') . '</em> / Kg</p>
                        <div class="clearfix"></div>
                    </div>
                    <a href="' . base_url('user/detail_barang/') . enkrip_url($val['id']) . '" class="btn btn-warning">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>';

            $dataPenjual = $this->db->get_where('users', ['id' => $val['id_penjual']])->row_array();
            $idPasar = $dataPenjual['id_pasar'];

            if (in_array($idPasar, $dataPasarSementara) == FALSE) {
                array_push($dataPasarSementara, $idPasar);
            }
        }

        if ($filter == 'terdekat') {

            foreach ($dataPasarSementara as $pasar) {
                $dataPasar = $this->db->get_where('pasar', ['id' => $pasar])->row_array();

                $getDataContent = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=' . $latitude . ',' . $longtitude . '&destinations=' . $dataPasar['latitude'] . ',' . $dataPasar['longtitude'] . '&key=AIzaSyBuS2NaAZ3LanbU7bxgGMCHdw1OnszWMak');
                $decode = json_decode($getDataContent, true);
                $dataDecode = $decode['rows'][0]['elements'][0]['distance']['value'];

                if ($dataDecode < 10000) {

                    $isiPenjual = $this->db->get_where('users', ['id_pasar' => $dataPasar['id']])->result_array();

                    foreach ($isiPenjual as $val) {

                        $isiBarang = $this->db->get_where('barang_penjual', ['id_penjual' => $val['id']])->result_array();

                        foreach ($isiBarang as $brg) {

                            $valueTerdekat .= '<div class="col-sm m-wthree">
                            <div class="col-m">
                                <img src="' . base_url('assets/img/barang/') . $brg['image_barang'] . '" class="img-fluid" alt="" style="width:150px;height:150px;">
                                <div class="mid-1">
                                    <div class="women">
                                        <p style="font-size:16px;"><b>' . $brg['nama_barang'] . '</b></p>
                                        <h6>Stock :' . $brg['stock_barang'] . ' Kg</h6>
                                    </div>
                                    <div class="mid-2">
                                        <p><em class="item_price">Rp.' . number_format($brg['harga_barang'], 0, ',', '.') . '</em> / Kg</p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <a href="' . base_url('user/detail_barang/') . enkrip_url($brg['id']) . '" class="btn btn-warning">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>';
                        }
                    }
                }
            }
        }

        return ($filter == 'terdekat') ? $valueTerdekat : $value;
    }
}

/* End of file User_model.php */

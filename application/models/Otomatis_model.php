<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Otomatis_model extends CI_Model
{
    public function getOtomatis()
    {
        $this->_bataPesananBaru();
        $this->_bataPesananDibayar();
    }

    private function _bataPesananBaru()
    {
        $pesananBaru = $this->db->get_where('pesanan', ['id_status' => 1]);

        if ($pesananBaru->num_rows() > 0) {
            foreach ($pesananBaru->result_array() as $p) {

                $waktuTunggu = $p['pesanan_dibuat'] + 7200;

                if (time() > $waktuTunggu) {
                    $this->db->update('pesanan', ['id_status' => 7], ['id' => $p['id']]);
                }
            }
        }
    }

    private function _bataPesananDibayar()
    {
        $pesananDiproses = $this->db->get_where('pesanan', ['id_status' => 3]);

        if ($pesananDiproses->num_rows() > 0) {
            foreach ($pesananDiproses->result_array() as $p) {

                $waktuTunggu = $p['pesanan_dibuat'] + 7200;

                if (time() > $waktuTunggu) {
                    $this->db->update('pesanan', ['id_status' => 7], ['id' => $p['id']]);
                }
            }
        }
    }
}

/* End of file Otomatis_model.php */

<?php

function notifikasi_proses()
{
    $ci = get_instance();
    $datauser = $ci->db->get_where('users', ['email' => $ci->session->userdata('email')])->row_array();

    if ($datauser['role_id'] == 2) {
        $pesanan = $ci->db->get_where('pesanan', ['id_pembeli' => $datauser['id'], 'status_notif' => 1, 'id_status !=' => 1])->num_rows();
    } else {
        $pesanan = $ci->db->get_where('pesanan', ['id_penjual' => $datauser['id'], 'id_status' => 1])->num_rows();
    }

    if ($pesanan > 0) {
        return 'active';
    } else {
        return '';
    }
}

function cekUser()
{
    $ci = &get_instance();
    $datauser = $ci->db->get_where('users', ['email' => $ci->session->userdata('email')])->row_array()['role_id'];

    if ($datauser == 2) {
        return 'user/belanjaan';
    } else {
        return 'penjual/riwayat_penjualan';
    }
}

<?php

function getDataPenjual($id)
{
    $ci = get_instance();
    $dataPenjual = $ci->db->get_where('users', ['id' => $id])->row_array();

    return $dataPenjual['name'] . ' - ' . $dataPenjual['no_lapak'];
}

function getPenjual($id)
{
    $ci = get_instance();
    $dataPenjual = $ci->db->get_where('users', ['id' => $id])->row_array();

    return $dataPenjual['name'];
}

function getSatuan($id)
{
    $ci = get_instance();
    $dataPenjual = $ci->db->get_where('satuan', ['id' => $id])->row_array();

    return $dataPenjual['satuan_brt'];
}

function getDataBarang($id)
{
    $ci = get_instance();
    $dataBarang = $ci->db->get_where('barang_penjual', ['id' => $id])->row_array();

    return $dataBarang['nama_barang'];
}

function getDataPembeli($id)
{
    $ci = get_instance();
    $dataBarang = $ci->db->get_where('users', ['id' => $id])->row_array();

    return $dataBarang['name'];
}

function getStatus($id)
{
    $ci = get_instance();
    $dataBarang = $ci->db->get_where('status', ['id' => $id])->row_array();

    return $dataBarang['status'];
}

function getDataLatLong($idPenjual)
{
    $ci = get_instance();
    $dataPenjual = $ci->db->get_where('users', ['id' => $idPenjual])->row_array()['id_pasar'];

    return $ci->db->get_where('pasar', ['id' => $dataPenjual])->row_array();
}

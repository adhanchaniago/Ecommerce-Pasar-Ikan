<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $querymenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array()['id'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $querymenu
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function getDataStatus($id)
{
    $ci = get_instance();
    $dataPenjual = $ci->db->get_where('status', ['id' => $id])->row_array();

    return $dataPenjual['status'];
}

function getEmail($id)
{
    $ci = get_instance();
    $dataPenjual = $ci->db->get_where('users', ['id' => $id])->row_array();

    return $dataPenjual['email'];
}

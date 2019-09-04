<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Page_model extends CI_Model
{
    public function view()
    {
        $this->load->library('pagination');

        $query = "SELECT * FROM barang_penjual";

        $config['total_rows'] = $this->db->query($query)->num_rows();
        $config['per_page'] = 2;
        $config['uri_segment'] = 2;
        $config['num_links'] = 2;

        // Style Pagination
        // Agar bisa mengganti stylenya sesuai class2 yg ada di bootstrap
        $config['full_tag_open']   = '<ul class="pagination pagination-sm m-t-xs m-b-xs">';
        $config['full_tag_close']  = '</ul>';

        $config['first_link']      = 'First';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link']       = 'Last';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';

        $config['next_link']       = ' <i class="glyphicon glyphicon-menu-right"></i> ';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';

        $config['prev_link']       = ' <i class="glyphicon glyphicon-menu-left"></i> ';
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';

        $config['cur_tag_open']    = '<li class="active"><a href="#">';
        $config['cur_tag_close']   = '</a></li>';

        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        // End style pagination

        $this->pagination->initialize($config); // Set konfigurasi paginationnya

        $page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
        $query .= " LIMIT " . $page . ", " . $config['per_page'];

        $data['limit'] = $config['per_page'];
        $data['total_rows'] = $config['total_rows'];
        $data['pagination'] = $this->pagination->create_links(); // Generate link pagination nya sesuai config diatas
        $data['barang'] = $this->db->query($query)->result();

        return $data;
    }
}

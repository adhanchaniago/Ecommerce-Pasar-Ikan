<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Profile Admin';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/profile_admin', $data);
        $this->load->view('templates/admin_footer');
    }

    public function edit_profile_admin()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Edit Profile';

        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('name', 'Email', 'trim|required');
        $this->form_validation->set_rules('address', 'Email', 'trim|required');
        $this->form_validation->set_rules('no_telp', 'Email', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_profile_admin', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->admin->editProfile($data['users']['id']);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Berhasil Dikirim </div>');
            redirect('admin/profile_admin');
        }
    }

    public function pesanan_masuk()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['pesanan'] = $this->admin->getPesanan();

        $data['title'] = 'Data Pesanan Masuk';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/data_pesanan_masuk', $data);
        $this->load->view('templates/admin_footer');
    }

    public function input_pesanan_penjual($idPesanan)
    {
        $dataDekrip = dekrip_url($idPesanan);
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['pesanan'] = $this->admin->getDataPesanan($dataDekrip);

        $data['title'] = 'Input Pesanan';

        $this->form_validation->set_rules('id', 'id', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/input_pesanan', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->admin->kirimPesanan();

            $this->_sendEmail('pesanan');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Berhasil Dikirim </div>');
            redirect('admin/pesanan_masuk');
        }
    }

    private function _sendEmail($type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'pasarjaya.13@gmail.com',
            'smtp_pass' => 'Pasarjaya1407',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('pasarjaya.13@gmail.com', 'Aplikasi Penjualan Ikan Pasar Jaya');
        $this->email->to($this->input->post('email'));

        if ($type == 'pesanan') {
            $this->email->subject('Pesanan Masuk');
            $this->email->message('Pesanan Baru, Silahkan klik link berikut untuk mengecek pesanan baru pada aplikasi anda <br><a href="' . base_url() . 'auth/login' . '">Buka Pesanan Masuk</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function data_pesanan()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->library('pagination');

        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'admin/data_pesanan';
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;

        //pagination style
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $page = $this->uri->segment(3, 0);

        $data['pesanan'] = $this->admin->getAllPesanan($config['per_page'], $page);
        $config['total_rows'] = $this->db->count_all('pesanan');;
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();

        $data['title'] = 'Seluruh Data Pesanan';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/seluruh_pesanan', $data);
        $this->load->view('templates/admin_footer');
    }

    public function cairkan_dana()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->library('pagination');

        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'admin/cairkan_dana';
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;

        //pagination style
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $page = $this->uri->segment(3, 0);

        $data['pesanan'] = $this->admin->getPesananCair($config['per_page'], $page);
        $config['total_rows'] = $this->db->count_all('pesanan');;
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();

        $data['title'] = 'Seluruh Data Pesanan';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/cairkan', $data);
        $this->load->view('templates/admin_footer');
    }

    public function dicairkan()
    {
        $this->admin->cairkan();
        redirect('admin/cairkan_dana');
    }

    public function ganti_password_admin()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'Password Baru', 'required|trim|min_length[5]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Konfirmasi Password Baru', 'required|trim|min_length[5]|matches[new_password1]');


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Ganti Password';
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/ganti_password', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $current_password = $this->input->post('password_lama');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['users']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password Lama Anda Salah !!! </div>');
                redirect('admin/ganti_password_admin');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password Baru Tidak Boleh Sama Dengan Yang Lama !!! </div>');
                    redirect('admin/ganti_password_admin');
                } else {
                    //password benar
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('users');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password Baru Berhasil diganti ! </div>');
                    redirect('admin/profile_admin');
                }
            }
        }
    }
}

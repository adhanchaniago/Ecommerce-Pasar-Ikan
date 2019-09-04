<?php
defined('BASEPATH') or exit('No direct script access allowed');

class penjual extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Register_model', 'regis');
        $this->load->model('Penjual_model', 'penjual');
        //$this->load->model('Page_model', 'page');
    }

    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['barang'] = $this->penjual->getAllData($data['users']['id']);

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/penjual_navbar', $data);
        $this->load->view('penjual/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function about()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/penjual_navbar', $data);
        $this->load->view('penjual/about', $data);
        $this->load->view('templates/user_footer');
    }

    public function edit_profile()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['edit'] = $this->regis->getRegister($data['users']['id_pasar']);

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/penjual_navbar', $data);
        $this->load->view('penjual/edit_profile', $data);
        $this->load->view('templates/user_footer');
    }

    public function edit_profile_penjual()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['nama'] = $this->db->get('pasar')->result_array();
        $data['edit'] = $this->regis->getRegister($data['users']['id_pasar']);

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('id_pasar', 'Nama Pasar', 'required');
        $this->form_validation->set_rules('no_lapak', 'No Lapak', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/penjual_navbar', $data);
            $this->load->view('penjual/edit_profile_penjual', $data);
            $this->load->view('templates/user_footer');
        } else {
            $data = [
                $name = $this->input->post('name'),
                $email = $this->input->post('email'),
                $address = $this->input->post('address'),
                $id_pasar = $this->input->post('id_pasar'),
                $no_lapak = $this->input->post('no_lapak'),
                $no_telp = $this->input->post('no_telp')
            ];

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_width']     = 4096;
                $config['max_height']    = 4096;
                $config['max_size']      = 4096;
                $config['upload_path']   = './assets/img/foto/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                    $this->session->set_flashdata('error', 'Maaf File/Ukuran Gambar Tidak Sesuai');
                    redirect('user/edit_profile_penjual'); //selesai proses di redirect
                }
            }

            $this->db->set('name', $name);
            $this->db->set('address', $address);
            $this->db->set('no_telp', $no_telp);
            $this->db->set('id_pasar', $id_pasar);
            $this->db->set('no_lapak', $no_lapak);
            $this->db->where('email', $email);
            $this->db->update('users');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Profile Kamu Berhasil diedit! </div>');
            redirect('penjual/edit_profile');
        }
    }

    public function changePassword()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'Password Baru', 'required|trim|min_length[5]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Konfirmasi Password Baru', 'required|trim|min_length[5]|matches[new_password1]');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/penjual_navbar', $data);
            $this->load->view('penjual/change_password', $data);
            $this->load->view('templates/user_footer');
        } else {
            $current_password = $this->input->post('password_lama');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['users']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password Lama Anda Salah !!! </div>');
                redirect('penjual/changePassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password Baru Tidak Boleh Sama Dengan Yang Lama !!! </div>');
                    redirect('penjual/changePassword');
                } else {
                    //password benar
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('users');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password Baru Berhasil diganti ! </div>');
                    redirect('penjual/changePassword');
                }
            }
        }
    }

    public function pesanan_masuk()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['pesanan'] = $this->penjual->getPesanan($data['users']['id']);

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/penjual_navbar', $data);
        $this->load->view('penjual/pesanan_masuk', $data);
        $this->load->view('templates/user_footer');
    }

    public function ditolak()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['pesanan'] = $this->penjual->getPesanan($data['users']['id']);

        $this->form_validation->set_rules('diproses', 'required|trim');

        $this->penjual->ditolak();
        redirect('penjual');
    }

    public function diproses()
    {
        $this->penjual->diproses();
        redirect('penjual/pesanan_diproses');
    }

    public function pesanan_diproses()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['pesanan'] = $this->penjual->getPesananProses($data['users']['id']);

        $this->form_validation->set_rules('nomor_resi', 'Input Nomor Resi', 'required|trim', [
            'required' => 'Wajib Diisi',
            'trim' => 'Wajib Diisi'
        ]);
        $this->form_validation->set_rules('status', 'status', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/penjual_navbar', $data);
            $this->load->view('penjual/pesanan_diproses', $data);
            $this->load->view('templates/user_footer');
        } else {
            $this->penjual->tambahResi();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Berhasil Upload!</div>');
            redirect('penjual/pesanan_diproses');
        }
    }

    public function riwayat_penjualan()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['pesanan'] = $this->penjual->getditerima($data['users']['id']);

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/penjual_navbar', $data);
        $this->load->view('penjual/riwayat_penjualan', $data);
        $this->load->view('templates/user_footer');
    }

    public function total_pencairan()
    {
        $data['users'] = $this->penjual->getDataPencairannya();

        $this->load->view('templates/user_header');
        $this->load->view('templates/penjual_navbar');
        $this->load->view('penjual/halamanPencairan', $data);
        $this->load->view('templates/user_footer');
    }

    public function updateStatusPencairan()
    {
        $data['idUsers'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array()['id'];

        $this->form_validation->set_rules('penerima', 'Penerima', 'trim|required');
        $this->form_validation->set_rules('rekening', 'Rekening', 'trim|required|is_natural_no_zero');
        $this->form_validation->set_rules('bank', 'Bank', 'trim|required');


        if ($this->form_validation->run() == false) {
            redirect('penjualan/riwayat_penjualan');
        } else {
            $this->penjual->sudahDicairkan($data['idUsers']);
            redirect('penjual/riwayat_penjualan');
        }
    }

    public function tambah_barang()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $idPenjual = $data['users']['id'];

        $this->form_validation->set_rules('name_ikan', 'Nama ikan', 'required|trim', [
            'required' => 'Wajib Diisi',
            'trim' => 'Wajib Diisi'
        ]);
        $this->form_validation->set_rules('stok_ikan', 'Stock Ikan', 'required|trim|numeric', [
            'required' => 'Wajib Diisi',
            'trim' => 'Wajib Diisi',
            'numeric' => 'Harus Angka'
        ]);
        $this->form_validation->set_rules('harga_ikan', 'Harga Ikan', 'required|trim|numeric', [
            'required' => 'Wajib Diisi',
            'trim' => 'Wajib Diisi',
            'numeric' => 'Harus Angka'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/penjual_navbar', $data);
            $this->load->view('penjual/tambah_barang', $data);
            $this->load->view('templates/user_footer');
        } else {
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_width']     = 4096;
                $config['max_height']    = 4096;
                $config['max_size']      = 4096;
                $config['upload_path']   = './assets/img/barang/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->penjual->tambahDataBarang($new_image, $idPenjual);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Berhasil Upload!</div>');
                    redirect('penjual');
                } else {
                    echo $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Gagal Upload</div>');
                    redirect('penjual'); //selesai proses di redirect
                }
            }
        }
    }

    public function edit_barang($idBarang)
    {
        $dataDekrip = dekrip_url($idBarang);
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['barang'] = $this->penjual->getDataBarang($dataDekrip);

        $this->form_validation->set_rules('name_ikan', 'Nama ikan', 'required|trim', [
            'required' => 'Wajib Diisi',
            'trim' => 'Wajib Diisi'
        ]);
        $this->form_validation->set_rules('stok_ikan', 'Stock Ikan', 'required|trim|numeric', [
            'required' => 'Wajib Diisi',
            'trim' => 'Wajib Diisi',
            'numeric' => 'Harus Angka'
        ]);
        $this->form_validation->set_rules('harga_ikan', 'Harga Ikan', 'required|trim|numeric', [
            'required' => 'Wajib Diisi',
            'trim' => 'Wajib Diisi',
            'numeric' => 'Harus Angka'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/penjual_navbar', $data);
            $this->load->view('penjual/edit_barang', $data);
            $this->load->view('templates/user_footer');
        } else {
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_width']     = 4096;
                $config['max_height']    = 4096;
                $config['max_size']      = 4096;
                $config['upload_path']   = './assets/img/barang/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Gagal Edit</div>');
                    redirect('penjual'); //selesai proses di redirect
                }
            }

            $this->penjual->ubahDataBarang($idBarang);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Berhasil Di Edit!</div>');
            redirect('penjual');
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->penjual->delete($id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil dihapus</div>');
            redirect('penjual');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal Dihapus</div>');
            redirect('penjual');
        }
    }
}

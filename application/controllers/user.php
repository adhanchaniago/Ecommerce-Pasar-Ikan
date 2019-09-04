<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model', 'user');
    }

    public function index()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['barang'] = $this->user->getDataBarang();

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_navbar_home', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function about()
    {
        $this->load->view('templates/user_header');
        $this->load->view('templates/user_navbar');
        $this->load->view('user/about');
        $this->load->view('templates/user_footer');
    }

    public function search()
    {
        $search = $this->input->get('keyword');
        $data['cari'] = $this->user->get_search($search);

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_navbar_search', $data);
        $this->load->view('user/search', $data);
        $this->load->view('templates/user_footer');
    }

    public function detail_barang_home($idBarang)
    {
        $dataDekrip = dekrip_url($idBarang);
        $data['barang'] = $this->user->getDetailBarang($dataDekrip);
        $data['jumlah'] = count($data['barang']);

        $this->load->view('templates/user_header');
        $this->load->view('templates/navbar_detail_barang_home', $data);
        $this->load->view('user/detail_barang_home', $data);
        $this->load->view('templates/user_footer');
    }

    public function detail_barang($idBarang)
    {
        $dataDekrip = dekrip_url($idBarang);
        $data['barang'] = $this->user->getDetailBarang($dataDekrip);
        $data['jumlah'] = count($data['barang']);

        $this->load->view('templates/user_header');
        $this->load->view('templates/navbar_detail_barang', $data);
        $this->load->view('user/detail_barang', $data);
        $this->load->view('templates/user_footer');
    }

    public function edit_profile()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_navbar', $data);
        $this->load->view('user/edit_profile', $data);
        $this->load->view('templates/user_footer');
    }

    public function edit_profile_pembeli()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'No_Telp', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_navbar', $data);
            $this->load->view('user/edit_profile_pembeli', $data);
            $this->load->view('templates/user_footer');
        } else {
            $data = [
                $name = $this->input->post('name'),
                $email = $this->input->post('email'),
                $address = $this->input->post('address'),
                $no_telp = $this->input->post('no_telp')
            ];

            //--- Validasi gambar ada ---//
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
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
                    redirect('user/edit_profile'); //selesai proses di redirect
                }
            }

            $this->db->set('name', $name);
            $this->db->set('address', $address);
            $this->db->set('no_telp', $no_telp);
            $this->db->where('email', $email);
            $this->db->update('users');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Profile Kamu Berhasil diedit! </div>');
            redirect('user/edit_profile');
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
            $this->load->view('templates/user_navbar', $data);
            $this->load->view('user/ganti_password', $data);
            $this->load->view('templates/user_footer');
        } else {
            $current_password = $this->input->post('password_lama');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['users']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password Lama Anda Salah !!! </div>');
                redirect('user/changePassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password Baru Tidak Boleh Sama Dengan Yang Lama !!! </div>');
                    redirect('user/changePassword');
                } else {
                    //password benar
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('users');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password Baru Berhasil diganti ! </div>');
                    redirect('user/edit_profile');
                }
            }
        }
    }

    public function bayar_pesanan($idBarang)
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['ikan'] = $this->db->get_where('barang_penjual')->row_array();
        $dataDekrip = dekrip_url($idBarang);
        $data['barang'] = $this->user->getDetailBarang($dataDekrip);
        $data['jumlah'] = count($data['barang']);
        $idPembeli = $data['users']['id'];
        $idPenjual = $data['ikan']['id_penjual'];

        $this->form_validation->set_rules('jmlh_barang', 'Berat Ikan', 'required|trim|is_natural_no_zero', [
            'required' => 'Berat Ikan Wajib Diisi',
            'trim' => 'Berat Ikan Wajib Diisi',
            'is_natural_no_zero' => 'Tidak Boleh 0 Beratnya'
        ]);
        $this->form_validation->set_rules('stn_berat', 'trim');
        $this->form_validation->set_rules('request', 'Catatan', 'required|trim', [
            'required' => 'Catatan Wajib Diisi, jika kosong akan dikirim apa adanya.',
            'trim' => 'Catatan Wajib Diisi, jika kosong akan dikirim apa adanya.'
        ]);
        $this->form_validation->set_rules('alamatkirim', 'Alamat Kirim', 'required|trim', [
            'required' => 'Alamat Kirim Wajib Diisi',
            'trim' => 'Alamat Kirim Wajib Diisi'
        ]);
        $this->form_validation->set_rules('totalHrgBrgOngkir', 'trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_navbar', $data);
            $this->load->view('user/bayar_pesanan', $data);
            $this->load->view('templates/user_footer');
        } else {
            $this->user->tambahPesanan($idPembeli, $idPenjual, $dataDekrip);

            $this->_sendEmail($this->session->userdata('email'), 'pembayaran');

            redirect('user/pembayaran');
        }
    }

    public function pembayaran()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_navbar', $data);
        $this->load->view('user/rekening', $data);
        $this->load->view('templates/user_footer');
    }

    public function bayar()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['pesan'] = $this->user->getPesanan($data['users']['id']);

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_navbar', $data);
        $this->load->view('user/bayar', $data);
        $this->load->view('templates/user_footer');
    }

    public function kirimbukti($idBarang)
    {
        $dataDekrip = dekrip_url($idBarang);
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['pesan'] = $this->user->getDataPesanan($dataDekrip);

        $this->form_validation->set_rules('id', 'id', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_navbar', $data);
            $this->load->view('user/kirimbukti', $data);
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
                    $this->user->MenungguRespon($new_image);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                            Bukti Berhasil Dikirim</div>');
                    redirect('user/belanjaan');
                } else {
                    echo $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Gagal Kirim</div>');
                    redirect('user/belanjaan'); //selesai proses di redirect
                }
            }
        }
    }

    public function belanjaan()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['pesan'] = $this->user->getbarangDiproses($data['users']['id']);

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_navbar', $data);
        $this->load->view('user/belanjaan', $data);
        $this->load->view('templates/user_footer');
    }

    public function cairkan()
    {
        $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['cair'] = $this->user->getDitolak($data['users']['id']);

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_navbar', $data);
        $this->load->view('user/cairkan', $data);
        $this->load->view('templates/user_footer');
    }

    public function total_pencairan()
    {
        $data['users'] = $this->user->getDataPencairannya();

        $this->load->view('templates/user_header');
        $this->load->view('templates/user_navbar');
        $this->load->view('user/halamanPencairan', $data);
        $this->load->view('templates/user_footer');
    }

    public function updateStatusPencairan()
    {
        $data['idUsers'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array()['id'];

        $this->form_validation->set_rules('penerima', 'Penerima', 'trim|required');
        $this->form_validation->set_rules('rekening', 'Rekening', 'trim|required|is_natural_no_zero');
        $this->form_validation->set_rules('bank', 'Bank', 'trim|required');


        if ($this->form_validation->run() == false) {
            redirect('user/belanjaan');
        } else {
            $this->user->sudahDicairkan($data['idUsers']);
            redirect('user/belanjaan');
        }
    }

    public function diterima()
    {
        $this->user->diterima();
        redirect('user');
    }

    private function _sendEmail($email)
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
        $this->email->to($email);

        $this->email->subject('Pembayaran');
        $this->email->message('Silahkan lakukan pembayaran melalui ATM dengan mentransfer ke rekening Bank BCA 03022136 a/n PT. Pasar Jaya, kemudian lakukan konfirmasi pembayaran dengan
                            mengupload bukti pembayaran ke menu belanjaan <a href="' . base_url() . 'auth' . '">Konfirmasi Pembayaran</a>');

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->user->delete($id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil dihapus</div>');
            redirect('user');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal Dihapus</div>');
            redirect('user');
        }
    }

    public function getFilter()
    {
        echo json_encode($this->user->getFilterData());
    }

    public function getDataStok($idBarang)
    {
        $dataDekrip = dekrip_url($idBarang);
        $dekrip = json_decode($this->db->get_where('barang_penjual', ['id' => $dataDekrip])->row_array()['stock_barang'], true);

        echo json_encode($dekrip);
    }

    public function getAllData()
    {
        echo json_encode(ths);
    }
}

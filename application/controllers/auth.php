<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Register_model', 'regis');
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login Page';
			$this->load->view('templates/user_header', $data);
			$this->load->view('templates/navbar_home');
			$this->load->view('auth/login');
			$this->load->view('templates/footer_home');
			$this->goToDefaultPage();
		} else {
			//validation success
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$users = $this->db->get_where('users', ['email' => $email])->row_array();

		//jika user ada 
		if ($users) {
			//jika usernya aktif
			if ($users['is_active'] == 1) {
				//cek passwordnya
				if (password_verify($password, $users['password'])) {
					$data = [
						'email' => $users['email'],
						'role_id' => $users['role_id']
					];
					$this->session->set_userdata($data);
					if ($users['role_id'] == 1) {
						redirect('admin');
					} else if ($users['role_id'] == 2) {
						redirect('user');
					} else if ($users['role_id'] == 3) {
						redirect('penjual');
					} else {
						redirect('auth');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Password Salah!</div>');
					redirect('Auth/index');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Email belum teraktivasi!</div>');
				redirect('Auth/index');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Email belum terdaftar!</div>');
			redirect('Auth');
		}
	}

	public function registerPenjual()
	{
		$data['penjual'] = $this->db->get('pasar')->result_array();
		$data['users'] = $this->regis->getRegis();

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
			'is_unique' => 'email tersebut sudah terdaftar sebagai user!!!'
		]);
		$this->form_validation->set_rules('id_pasar', 'Pasar', 'required');
		$this->form_validation->set_rules(
			'password1',
			'Password',
			'required|trim|min_length[5]|matches[password2]',
			['matches' => 'password dont match', 'min_length' => 'password terlalu pendek']
		);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Registration';
			$this->load->view('templates/user_header', $data);
			$this->load->view('templates/navbar_home');
			$this->load->view('auth/registerpenjual');
			$this->load->view('templates/footer_home');
		} else {
			$email = $this->input->post('email', true);

			//siapkan token
			$token = base64_encode(random_bytes(32));
			$user_token = [
				'email' => $email,
				'token' => $token,
				'date_created' => time()
			];
			$this->db->insert('user_token', $user_token);

			$this->regis->tambahPenjual();

			$this->_sendEmail($token, 'verify');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Selamat, akun anda berhasil di buat, mohon untuk Aktivasi akun anda!</div>');
			redirect('Auth');
		}
	}

	public function registration()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
			'is_unique' => 'email tersebut sudah terdaftar sebagai user!!!'
		]);
		$this->form_validation->set_rules(
			'password1',
			'Password',
			'required|trim|min_length[5]|matches[password2]',
			['matches' => 'password dont match', 'min_length' => 'password terlalu pendek']
		);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Registration';
			$this->load->view('templates/user_header', $data);
			$this->load->view('templates/navbar_home');
			$this->load->view('auth/registration');
			$this->load->view('templates/footer_home');
		} else {
			$email = $this->input->post('email', true);

			//siapkan token
			$token = base64_encode(random_bytes(32));
			$user_token = [
				'email' => $email,
				'token' => $token,
				'date_created' => time()
			];
			$this->db->insert('user_token', $user_token);

			$this->regis->tambahPembeli();

			$this->_sendEmail($token, 'verify');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Selamat, akun anda berhasil di buat, mohon untuk Aktivasi akun anda!</div>');
			redirect('Auth');
		}
	}

	private function _sendEmail($token, $type)
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

		if ($type == 'verify') {
			$this->email->subject('Verifikasi akun');
			$this->email->message('Klik link tersebut untuk verify akun anda : <br><a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
		} else if ($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('Klik link tersebut untuk Reset Password akun anda : <br><a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
		}

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$users = $this->db->get_where('users', ['email' => $email])->row_array();

		if ($users) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('users');

					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					' . $email . ' telah teraktivasi, silahkan lagin</div>');
					redirect('auth');
				} else {
					$this->db->delete('users', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Aktivasi akun anda gagal, karena token kadaluarsa</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Aktivasi akun anda gagal, karena token salah</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Aktivasi akun anda gagal, karena email salah</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
		Selamat, akun anda berhasil keluar !</div>');
		redirect('welcome');
	}

	public function blocked()
	{
		$this->load->view('auth/blocked');
	}

	public function goToDefaultPage()
	{
		if ($this->session->userdata('role_id') == 1) {
			redirect('admin');
		} else if ($this->session->userdata('role_id') == 2) {
			redirect('user');
		} else {
			// jika ada role_id yg lain maka tambahkan disini
		}
	}

	public function forgotPassword()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/user_header');
			$this->load->view('templates/navbar_home');
			$this->load->view('auth/forgot-password');
			$this->load->view('templates/footer_home');
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('users', ['email' => $email, 'is_active' => 1])->row_array();

			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token, 'forgot');

				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Tolong cek email anda untuk mereset password</div>');
				redirect('auth/forgotpassword');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Email Belum Terdaftar atau Teraktivasi !!!</div>');
				redirect('auth/forgotpassword');
			}
		}
	}

	public function resetPassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$users = $this->db->get_where('users', ['email' => $email])->row_array();

		if ($users) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Reset Password Failed! Token salah.</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Reset Password Failed! Email salah.</div>');
			redirect('auth');
		}
	}

	public function changePassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}

		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|min_length[5]|matches[password1]');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/user_header');
			$this->load->view('templates/navbar_home');
			$this->load->view('auth/change-password');
			$this->load->view('templates/footer_home');
		} else {
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('users');

			$this->session->unset_userdata('reset_email');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Password Berhasil diganti, tolong login.</div>');
			redirect('auth');
		}
	}
}

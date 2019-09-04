<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'user');
	}

	public function index()
	{
		$data['barang'] = $this->user->getDataBarang();

		$this->load->view('templates/user_header', $data);
		$this->load->view('templates/navbar_home', $data);
		$this->load->view('welcome/welcome_message', $data);
		$this->load->view('templates/footer_home');
	}

	public function detail_barang_welcome($id)
	{
		$data['barang'] = $this->user->getDetailBarang($id);

		$this->load->view('templates/user_header', $data);
		$this->load->view('templates/navbar_home', $data);
		$this->load->view('welcome/detail_barang_welcome', $data);
		$this->load->view('templates/footer_home');
	}

	public function about()
	{
		$this->load->view('templates/user_header');
		$this->load->view('templates/navbar_home');
		$this->load->view('welcome/about');
		$this->load->view('templates/footer_home');
	}
}

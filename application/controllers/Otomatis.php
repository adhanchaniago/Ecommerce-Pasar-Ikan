<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Otomatis extends CI_Controller
{

    public function index()
    {
        $this->load->model('Otomatis_model', 'oto');

        $this->oto->getOtomatis();
        $this->load->view('otomatis/index');
    }
}

/* End of file Otomatis.php */

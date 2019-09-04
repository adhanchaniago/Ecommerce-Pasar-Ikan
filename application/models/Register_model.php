<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register_model extends CI_Model
{
    public function getRegister($data)
    {
        return $this->db->get_where('pasar', ['id' => $data])->row_array();
    }

    public function getRegis()
    {
        $query = "SELECT `users`.*, `pasar`.`id`
                  FROM `users` JOIN `pasar`
                  ON `users`.`id_pasar` = `pasar`.`id`
                  ";

        return $this->db->query($query)->result_array();
    }

    public function tambahPenjual()
    {
        $input = $this->input;
        $email = $this->input->post('email', true);

        $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($email),
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'image' => 'default.jpg',
            'role_id' => 3,
            'id_pasar' => $this->input->post('id_pasar'),
            'is_active' => 0,
            'date_created' => time()
        ];

        $this->db->insert('users', $data);
    }

    public function tambahPembeli()
    {
        $input = $this->input;
        $email = $this->input->post('email', true);

        $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($email),
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'image' => 'default.jpg',
            'role_id' => 2,
            'is_active' => 0,
            'date_created' => time()
        ];

        $this->db->insert('users', $data);
    }
}

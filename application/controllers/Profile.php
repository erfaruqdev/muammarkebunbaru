<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('ProfileModel', 'pm');
        CekLogin();
    }

    public function index()
    {
        $data = [
            'title' => 'Profil Pengguna',
            'classProfile' => 'active',
            'user' => $this->pm->user()
        ];
        $this->load->view('profile/profile', $data);
    }

    public function update()
    {
        $response = $this->pm->update();
        echo json_encode($response);
    }

    public function updatePassword()
    {
        $response = $this->pm->updatePassword();
        echo json_encode($response);
    }
}

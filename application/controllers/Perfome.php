<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perfome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataModel', 'dm');
        $this->load->model('PerfomeModel', 'pm');
        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Peserta MUAMMAR',
            'contest' => $this->pm->contest()
        ];
        $this->load->view('perfome/perfome', $data);
    }

    public function loadData()
    {
        $result = $this->pm->loadData();
        $data = [
            'data' => $result[0],
            'amount' => $result[1]
        ];
        $this->load->view('perfome/ajax-data', $data);
    }
}

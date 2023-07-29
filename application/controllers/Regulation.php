<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Regulation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('download');
        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Tata Tertib',
        ];
        $this->load->view('regulation/regulation', $data);
    }

    public function download()
    {
        $file = 'assets/regulation.pdf';

        force_download($file, NULL);
    }

}

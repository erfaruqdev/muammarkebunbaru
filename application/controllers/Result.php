<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Result extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataModel', 'dm');
        $this->load->model('ResultModel', 'vm');
        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Nilai',
            'contest' => $this->vm->contest()
        ];
        $this->load->view('result/result', $data);
    }

    public function valuation()
    {
        $data = [
            'valuation' => $this->vm->valuation(),
            'contest' => $this->input->post('contest', true)
        ];
        $this->load->view('result/ajax-data', $data);
    }

    public function printResult()
    {
        $data = [
            'title' => 'Print Daftar Nilai',
            'valuations' => $this->vm->valuation(),
            'contest' => $this->vm->getContestById()
        ];
        $this->load->view('print/print-point', $data);
    }

    public function recapitulation()
    {
        $data = [
            'contests' => $this->vm->contests()
        ];
        $this->load->view('result/analytic', $data);
    }
}

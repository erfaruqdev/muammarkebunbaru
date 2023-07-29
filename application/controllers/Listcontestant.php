<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ListContestant extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataModel', 'dm');
        $this->load->model('ListContestantModel', 'lcm');
        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Peserta MUAMMAR',
            'contest' => $this->lcm->contest()
        ];
        $this->load->view('list-contestant/list-contestant', $data);
    }

    public function loadData()
    {
        $result = $this->lcm->loadData();
        $data = [
            'data' => $result[0],
            'amount' => $result[1]
        ];
        $this->load->view('list-contestant/ajax-data', $data);
    }

    public function printMc()
    {
        $result = $this->lcm->loadDataMc();
        $data = [
            'title' => 'Print Data Peserta - MC',
            'status' => $result[0],
            'data' => $result[1],
            'contest' => $result[2],
            'category' => $result[3]
        ];
        $this->load->view('print/mc', $data);
    }

    public function printJury()
    {
        $result = $this->lcm->loadDataJury();
        $data = [
            'title' => 'Print Data Peserta - Juri',
            'status' => $result[0],
            'data' => $result[1],
            'contest' => $result[2],
            'category' => $result[3],
            'name' => $result[4],
            'evaluation' => $result[5],
            'jury' => $result[6],
        ];
        $this->load->view('print/jury', $data);
    }
}

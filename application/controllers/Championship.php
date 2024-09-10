<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Championship extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataModel', 'dm');
        $this->load->model('ChampionshipModel', 'cm');
        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Kejuaraan MUAMMAR',
            'contest' => $this->cm->contest()
        ];
        $this->load->view('championship/championship', $data);
    }

    public function loadData()
    {
        $result = $this->cm->loadData();
        $data = [
            'data' => $result[0],
            'amount' => $result[1]
        ];
        $this->load->view('championship/ajax-data', $data);
    }

    public function loadDataPoint()
    {
        $result = $this->cm->loadDataPoint();
        $data = [
            'status' => $result[0],
            'data' => $result[1]
        ];
        $this->load->view('championship/ajax-point', $data);
    }

    public function print()
    {
        $result = $this->cm->loadDataPoint();
        $data = [
            'title' => 'Print Out Daftar Poin',
            'status' => $result[0],
            'data' => $result[1],
            'contest' => $this->cm->contest()
        ];
        $this->load->view('print/point', $data);
    }

    public function printChampions()
    {
        $result = $this->cm->loadDataChampions();
        $data = [
            'title' => 'Print Out Daftar Juarawan',
            'data' => $result[0],
            'category' => $result[1]
        ];
        $this->load->view('print/champion', $data);
    }

    public function checkData()
    {
        $result = $this->cm->checkData();
        $data = [
            'status' => $result[0],
            'data' => $result[1],
            'mmu' => $result[2]
        ];
        $this->load->view('championship/ajax-champion', $data);
    }

    public function save()
    {
        $result = $this->cm->save();

        echo json_encode($result);
    }
}

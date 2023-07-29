<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataModel', 'dm');
        $this->load->model('CheckinModel', 'cm');
        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Check In Peserta'
        ];
        $this->load->view('checkin/checkin', $data);
    }

    public function loadData()
    {
        $result = $this->cm->loadData();
        $data = [
            'data' => $result
        ];
        $this->load->view('checkin/ajax-data', $data);
    }

    public function checkIn()
    {
        $result = $this->cm->checkIn();
        $data = [
            'status' => $result[0],
            'data' => $result[1]
        ];
        $this->load->view('checkin/ajax-check', $data);
    }

    public function delete()
    {
        $result = $this->cm->delete();

        echo json_encode($result);
    }
}

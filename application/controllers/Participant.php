<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Participant extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataModel', 'dm');
        $this->load->model('ParticipantModel', 'pm');
        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Peserta Muammar',
            'contest' => $this->pm->contest(),
            'setting' => $this->pm->setting()
        ];
        $this->load->view('participant/participant', $data);
    }

    public function loadData()
    {
        $data = [
            'data' => $this->pm->loadData(),
            'setting' => $this->pm->setting()
        ];
        $this->load->view('participant/ajax-data', $data);
    }

    public function save()
    {
        $result = $this->pm->save();

        echo json_encode($result);
    }

    public function edit()
    {
        $result = $this->pm->edit();

        echo json_encode($result);
    }

    public function delete($id)
    {
        $result = $this->pm->delete($id);

        echo json_encode($result);
    }

    public function getData()
    {
        $result = $this->pm->getData();

        echo json_encode($result);
    }

    public function printCard()
    {
        $category = $this->input->post('category');
        $data = $this->pm->printData($category);
        $this->load->view('print/card', [
            'data' => $data,
            'category' => ($category == 1) ? 'PUTRA' : 'PUTRI'
        ]);
    }
}

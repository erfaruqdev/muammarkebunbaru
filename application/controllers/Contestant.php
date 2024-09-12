<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contestant extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataModel', 'dm');
        $this->load->model('ContestantModel', 'cm');
        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Peserta Muammar',
            'mmu' => $this->cm->mmu(),
            'contest' => $this->cm->contest(),
            'setting' => $this->cm->setting()
        ];
        $this->load->view('contestant/contestant', $data);
    }

    public function loadData()
    {
        $data = [
            'data' => $this->cm->loadData(),
            'setting' => $this->cm->setting()
        ];
        $this->load->view('contestant/ajax-data', $data);
    }

    public function save()
    {
        $result = $this->cm->save();

        echo json_encode($result);
    }

    public function delete($id)
    {
        $result = $this->cm->delete($id);

        echo json_encode($result);
    }

    public function getData()
    {
        $result = $this->cm->getData();

        echo json_encode($result);
    }

    public function saveEdit()
    {
        $result = $this->cm->saveEdit();

        echo json_encode($result);
    }

    public function print()
    {
        $category = $this->input->post('category');
        if ($category == '') {
            $category = 1;
        }

        $data = [
            'mmu' => $this->cm->mmu(),
            'contest' => $this->cm->contest(),
            'category' => $category
        ];
        $this->load->view('print/contestant', $data);
    }
}

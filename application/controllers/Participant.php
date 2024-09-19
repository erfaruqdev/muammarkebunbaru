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
            'data' => $data
        ]);
    }

    public function export()
    {
        $category = '';
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $data = [
            'data' => $this->pm->printData($category)
        ];
        //$this->load->view('participant/card', $data);

        // filename dari pdf ketika didownload
        $file_pdf = 'data-analitik-muammar-kebunbaru';
        // setting paper
        $paper = 'legal';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = $this->load->view('participant/card',$data, true);
//		$html = $this->load->view('school/unpaid',$data, true);
        //$this->load->view('registration/invoice',$data);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
    }
}

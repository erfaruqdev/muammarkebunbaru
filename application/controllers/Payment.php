<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataModel', 'dm');
        $this->load->model('PaymentModel', 'pm');
        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Pembayaran'
        ];
        $this->load->view('payment/payment', $data);
    }

    public function loadData()
    {
        $data = [
            'datas' => $this->pm->loadData()[0],
            'total' => $this->pm->loadData()[1]
        ];
        $this->load->view('payment/ajax-data', $data);
    }

    public function checkID()
    {
        $result = $this->pm->checkID();

        echo json_encode($result);
    }

    public function save()
    {
        $result = $this->pm->save();

        echo json_encode($result);
    }

    public function print()
    {
        $invoice = $this->input->post('invoice', true);

        redirect('payment/printout/' . encrypt_url($invoice));
    }

    public function printOut($invoice)
    {
        $invoice = decrypt_url($invoice);
        $data = [
            'title' => 'Print',
            'data' => $this->pm->dataPrint($invoice)
        ];
        $this->load->view('print/invoice', $data);
    }

    public function unpaid()
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $data = [
            'data' => $this->pm->getAnaliytic()
        ];

        // filename dari pdf ketika didownload
        $file_pdf = 'peserta-tidak-bayar';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

//        $html = $this->load->view('school/analytic',$data, true);
		$html = $this->load->view('payment/unpaid',$data, true);
        //$this->load->view('registration/invoice',$data);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
    }
}

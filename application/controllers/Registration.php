<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registration extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RegistrationModel', 'rm');
        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Kartu Registrasi Peserta',
            'payment' => $this->rm->getPayment(),
            'data' => $this->rm->loadData()
        ];
        $this->load->view('registration/registration', $data);
    }
    
    public function invoice()
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $data = [
            'title' => 'Print',
            'data' => $this->rm->invoice()
        ];
        
        // filename dari pdf ketika didownload
        $file_pdf = 'invoice-muammar-kebunbaru';
        // setting paper
        $paper = 'Legal';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        
		$html = $this->load->view('registration/invoice',$data, true);
		//$this->load->view('registration/invoice',$data);	    
        
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
    }
    
    public function ianvoice()
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        //$this->load->library('pdfgenerator');
        
        // title dari pdf
        $data = [
            'title' => 'Print',
            'data' => $this->rm->invoice()
        ];
        
        // filename dari pdf ketika didownload
        //$file_pdf = 'invoice-muammar-kebunbaru';
        // setting paper
        //$paper = 'A4';
        //orientasi paper potrait / landscape
        //$orientation = "portrait";
        
		//$html = $this->load->view('registration/invoice',$data, true);
		$this->load->view('registration/invoice',$data);	    
        
        // run dompdf
        //$this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
    }
}

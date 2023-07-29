<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RegistrationModel extends CI_Model
{
    public function loadData()
    {
        $mmu = $this->session->userdata('user_id');
        return $this->db->get_where('schools', ['id' => $mmu])->row_object();
    }
    
    public function getPayment()
    {
        $mmu = $this->session->userdata('user_id');
        return $this->db->get_where('payments', [
            'school_id' => $mmu, 'status' => 'LUNAS'
        ])->num_rows();
    }

    public function barcode()
    {
        $mmu = $this->session->userdata('user_id');
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        return $generator->getBarcode($mmu, $generator::TYPE_CODE_128, 3, 150);
    }

    public function barcodePdf()
    {
        $mmu = $this->session->userdata('user_id');
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        return $generator->getBarcode($mmu, $generator::TYPE_CODE_128, 4, 90);
    }

    public function invoice()
    {
        $mmu = $this->session->userdata('user_id');

        $this->db->select('a.*, b.id AS invoice, b.created_at, b.amount, b.status, b.method');
        $this->db->from('schools AS a')->join('payments AS b', 'a.id = b.school_id');
        $this->db->where('b.school_id', $mmu);
        return $this->db->order_by('b.order', 'DESC')->get()->row_object();
    }
}

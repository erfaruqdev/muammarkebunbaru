<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PaymentModel extends CI_Model
{
    public function loadData()
    {
        $name = $this->input->post('name', true);
        $method = $this->input->post('method', true);

        $this->db->select('a.*, b.id AS invoice, b.created_at, b.amount, b.status, b.method');
        $this->db->from('schools AS a')->join('payments AS b', 'a.id = b.school_id');
        if ($name != '') {
            $this->db->like('a.name', $name);
        }
        if ($method != '') {
            $this->db->where('b.method', $method);
        }
        $data = $this->db->order_by('b.order', 'DESC')->get()->result_object();
        
        $total = $this->db->select('SUM(amount) AS total')->from('payments')->get()->row_object();
        
        return [
            $data,
            $total
        ];
    }

    public function checkID()
    {
        $id = $this->input->post('id', true);
        $tarif = 350000;

        $cekStudent = $this->db->get_where('schools', [
            'id' => $id
        ])->row_object();
        if (!$cekStudent) {
            return [
                'status' => 400,
                'message' => 'Data MMU tidak ditemukan'
            ];
        }

        $checkPackage = $this->db->get_where('payments', [
            'school_id' => $id, 'status' => 'LUNAS'
        ])->num_rows();
        if ($checkPackage) {
            return [
                'status' => 400,
                'message' => 'MMU ini sudah melunasi pembayaran'
            ];
        }

        $getAmount = $this->db->select_sum('amount')->from('payments')->where('school_id', $id)->get()->row_object();

        return [
            'status' => 200,
            'message' => 'Sukses',
            'id' => $id,
            'sisa' => 'Rp. ' . number_format($tarif - $getAmount->amount, 0, ',', '.'),
            'mmu' => $cekStudent->name . ' - ' . $cekStudent->village . ', ' . $cekStudent->city
        ];
    }

    public function save()
    {
        $method = $this->input->post('method', true);
        $id = $this->input->post('id', true);
        $nominal = (int)str_replace('.', '', $this->input->post('nominal', true));
        $getAmount = $this->db->select_sum('amount')->from('payments')->where('school_id', $id)->get()->row_object();
        $totalAwal = ($getAmount->amount != NULL) ? $getAmount->amount : 0;

        $cekStudent = $this->db->get_where('schools', [
            'id' => $id
        ])->num_rows();
        if ($cekStudent <= 0) {
            return [
                'status' => 400,
                'message' => 'Data MMU tidak ditemukan'
            ];
        }

        $checkPackage = $this->db->get_where('payments', [
            'school_id' => $id, 'status' => 'LUNAS'
        ])->num_rows();
        if ($checkPackage) {
            return [
                'status' => 400,
                'message' => 'MMU ini sudah melunasi pembayaran'
            ];
        }

        if ($nominal > (350000 - $totalAwal)) {
            return [
                'status' => 400,
                'message' => 'Nominal lebih besar dari tarif'
            ];
        }

        $invoice = 'MR-1391' . mt_rand(0000, 9999);
        $this->db->insert('payments', [
            'id' => $invoice,
            'school_id' => $id,
            'created_at' => date('Y-m-d H:i:s'),
            'amount' => $nominal,
            'status' => (($totalAwal + $nominal) >= 350000) ? 'LUNAS' : 'BELUM LUNAS',
            'method' => $method
        ]);

        if ($this->db->affected_rows() <= 0) {
            return [
                'status' => 400,
                'message' => 'Server tidak merespon'
            ];
        }

        return [
            'status' => 200,
            'message' => $invoice
        ];
    }

    public function dataPrint($invoice)
    {
        $this->db->select('a.*, b.id AS invoice, b.created_at, b.amount, b.status, b.method');
        $this->db->from('schools AS a')->join('payments AS b', 'a.id = b.school_id');
        $this->db->where('b.id', $invoice);
        return $this->db->get()->row_object();
    }

    public function barcode($id)
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        return $generator->getBarcode($id, $generator::TYPE_CODE_128, 3, 100);
    }
}

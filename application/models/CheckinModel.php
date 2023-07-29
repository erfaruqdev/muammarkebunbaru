<?php

use PHPUnit\TextUI\XmlConfiguration\MoveWhitelistDirectoriesToCoverage;

defined('BASEPATH') or exit('No direct script access allowed');

class CheckinModel extends CI_Model
{
    public function loadData()
    {
        $type = $this->session->userdata('user_type');

        $this->db->select('COUNT(id) AS school, SUM(amount) AS contestant');
        $this->db->from('registrations')->where('category', $type);
        return $this->db->get()->row_object();
    }

    public function checkIn()
    {
        $id = str_replace('_', '', $this->input->post('id', true));
        $type = $this->session->userdata('user_type');

        //CHECK
        $checkSchool = $this->db->get_where('schools', [
            'id' => $id
        ])->num_rows();

        if ($checkSchool <= 0) {
            return [
                400,
                'No. Reg tidak valid'
            ];
        }

        $checkRegistration = $this->db->get_where('registrations', [
            'school_id' => $id, 'category' => $type
        ])->num_rows();

        if ($checkRegistration > 0) {
            return [
                400,
                'MMU ini sudah check in sebelumnya'
            ];
        }

        $checkContestant = $this->db->get_where('participants', [
            'school_id' => $id, 'category' => $type
        ])->num_rows();
        if ($checkContestant <= 0) {
            return [
                400,
                'MMU ini belum registrasi peserta'
            ];
        }

        $checkPayment = $this->db->get_where('payments', [
            'school_id' => $id, 'status' => 'LUNAS'
        ])->num_rows();

        if ($checkPayment <= 0) {
            return [
                400,
                'MMU ini belum melunasi biaya registrasi'
            ];
        }

        $this->db->insert('registrations', [
            'school_id' => $id,
            'created_at' => date('Y-m-d H:i:s'),
            'category' => $type,
            'amount' => $checkContestant,
            'user_id' => $this->session->userdata('user_id')
        ]);

        $this->db->select('a.*, b.id AS registration, b.created_at, b.amount')->from('schools AS a');
        $this->db->join('registrations AS b', 'a.id = b.school_id');
        $this->db->where([
            'b.school_id' => $id,
            'b.category' => $type,
            'user_id' => $this->session->userdata('user_id')
        ]);
        $data = $this->db->get()->row_object();

        return [
            200,
            $data
        ];
    }

    public function delete()
    {
        $user = $this->session->userdata('user_id');
        $id = $this->input->post('id', true);

        $check = $this->db->get_where('registrations', [
            'id' => $id, 'user_id' => $user
        ])->num_rows();

        if ($check <= 0) {
            return [
                'status' => 400,
                'message' => 'Data tidak ditemukan'
            ];
        }

        $this->db->where('id', $id)->delete('registrations');
        if ($this->db->affected_rows() <= 0) {
            return [
                'status' => 400,
                'message' => 'Kesalahan server'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Yeaahh.! Satu data berhasil dihapus'
        ];
    }
}

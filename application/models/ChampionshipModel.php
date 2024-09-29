<?php

use PHPUnit\TextUI\XmlConfiguration\MoveWhitelistDirectoriesToCoverage;

defined('BASEPATH') or exit('No direct script access allowed');

class ChampionshipModel extends CI_Model
{
    public function contest()
    {
        return $this->db->get('contests')->result_object();
    }

    public function loadData()
    {
        $category = $this->input->post('category', true);
        $contest = $this->input->post('contest', true);

        $this->db->select('a.*, b.name, b.village, b.city, c.name AS contest')->from('champions AS a');
        $this->db->join('schools AS b', 'a.school_id = b.id');
        $this->db->join('contests AS c', 'a.contest_id = c.id');
        if ($category != '') {
            $this->db->where('a.category', $category);
        }
        if ($contest != '') {
            $this->db->where('a.contest_id', $contest);
        }
        $this->db->order_by('a.category ASC, a.contest_id ASC, a.rank ASC');
        $data = $this->db->get();

        return [
            $data->result_object(),
            $data->num_rows()
        ];
    }

    public function loadDataChampions()
    {
        $category = $this->input->post('category', true);
        $contest = $this->input->post('contest', true);

        $this->db->select('a.*, b.name, b.village, b.city, c.name AS contest')->from('champions AS a');
        $this->db->join('schools AS b', 'a.school_id = b.id');
        $this->db->join('contests AS c', 'a.contest_id = c.id');
        if ($category != '') {
            $this->db->where('a.category', $category);
        }
        if ($contest != '') {
            $this->db->where('a.contest_id', $contest);
        }
        $this->db->order_by('a.category ASC, a.contest_id ASC, a.rank ASC');
        $data = $this->db->get()->result_object();

        return [$data, $category];
    }

    public function getContestant($mmu, $contest, $category)
    {
        return $this->db->get_where('participants', [
            'school_id' => $mmu, 'contest_id' => $contest, 'category' => $category
        ])->result_object();
    }

    public function checkData()
    {
        $id = str_replace('_', '', $this->input->post('id', true));
        $contest = $this->input->post('contest', true);
        $category = $this->input->post('category', true);

        //CEK MMU
        $checkMMU = $this->db->get_where('schools', ['id' => $id])->row_object();

        //CEK CONTESTANTS
        $this->db->select('*')->from('participants')->where([
            'school_id' => $id, 'contest_id' => $contest, 'category' => $category
        ]);
        $checkContestant = $this->db->get();

        //CEK CHAMPIONS
        $checkChampion = $this->db->get_where('champions', [
            'school_id' => $id, 'contest_id' => $contest, 'category' => $category
        ])->num_rows();

        //CHECK PAYMENT
        $checkPayment = $this->db->get_where('payments', [
            'school_id' => $id, 'status' => 'LUNAS'
        ])->num_rows();

        if (!$checkMMU) {
            return [
                400,
                'ID MMU tidak valid',
                NULL
            ];
        }

        if ($checkContestant->num_rows() <= 0) {
            return [
                400,
                'MMU ini tidak berpartisipasi dalam lomba terpilih',
                NULL
            ];
        }

        if ($checkChampion > 0) {
            return [
                400,
                'Kejuarawaan MMU ini untuk lomba terpilih sudah ada',
                NULL
            ];
        }

        if ($checkPayment <= 0) {
            return [
                400,
                'MMU ini belum melunasi pembayaran',
                NULL
            ];
        }

        return [
            200,
            $checkContestant->result_object(),
            $checkMMU->name . '<br>' . $checkMMU->village . ', ' . $checkMMU->city
        ];
    }

    public function checkMMU($id, $contest, $type)
    {
        if ($id == '' && $contest != 2) {
            return [
                400,
                'Sebagian ID MMU kosong'
            ];
        }
        
        //CHECK CONTEST CHAMPIONS
        $checkContestChampion = $this->db->get_where('champions', [
            'contest_id' => $contest, 'category' => $type
        ])->num_rows();
        if ($contest == 2 && $checkContestChampion >= 1) {
            return [
                400,
                'Kejuaraan untuk lomba terpilih sudah ditambahkan seluruhnya'
            ];
        }

        if ($contest != 2 && $checkContestChampion >= 3) {
            return [
                400,
                'Kejuaraan untuk lomba terpilih sudah ditambahkan seluruhnya'
            ];
        }

        $checkMMU = $this->db->get_where('schools', ['id' => $id])->num_rows();
        if ($checkMMU <= 0) {
            return [
                400,
                'Sebagian ID MMU tidak valid .'.$id
            ];
        }

        $checkContestant = $this->db->get_where('participants', [
            'school_id' => $id, 'contest_id' => $contest, 'category' => $type
        ])->num_rows();
        if ($checkContestant <= 0) {
            return [
                400,
                'Sebagian MMU tidak berpartisipasi dalam lomba terpilih'
            ];
        }

        $checkChampion = $this->db->get_where('champions', [
            'school_id' => $id, 'contest_id' => $contest, 'category' => $type
        ])->num_rows();
        if ($checkChampion > 0) {
            return [
                400,
                'Sebagian MMU dalam lomba yang sama sudah ada'
            ];
        }

        $checkPayment = $this->db->get_where('payments', [
            'school_id' => $id, 'status' => 'LUNAS'
        ])->num_rows();
        if ($checkPayment <= 0) {
            return [
                400,
                'Sebagian MMU tidak melunasi pembayaran'
            ];
        }

        return [
            200,
            ''
        ];
    }

    public function save()
    {
        $rank = str_replace('_', '', $this->input->post('rank', true));
        $contest = $this->input->post('contest', true);
        $category = $this->input->post('category', true);

        if ($contest == 1 || $contest == 2) {
            $point = [1 => 4, 3, 2];
        } else {
            $point = [1 => 3, 2, 1];
        }

        $datas = [];
        foreach ($rank as $key => $value) {
            $check = $this->checkMMU($value, $contest, $category);
            if ($check[0] == 400) {
                return [
                    'status' => $check[0],
                    'message' => $check[1]
                ];
                break;
            }

            $datas[] = [
                'school_id' => $value,
                'contest_id' => $contest,
                'category' => $category,
                'rank' => $key,
                'point' => $point[$key]
            ];
        }

        $this->db->insert_batch('champions', $datas);
        if ($this->db->affected_rows() <= 0) {
            return [
                'status' => 400,
                'message' => 'Kesalahan server'
            ];
        }

        return [
            'status' => 200,
            'message' => $this->db->affected_rows()
        ];
    }

    public function loadDataPoint()
    {
        $category = $this->input->post('category', true);
        if ($category == '') {
            return [
                400,
                'Anda belum memilih kategori'
            ];
        }

        $this->db->select('SUM(a.point) AS points, a.school_id, b.name, b.village, b.city, b.pjgb, b.gb');
        $this->db->from('valuations AS a')->join('schools AS b', 'a.school_id = b.id');
        $this->db->where('a.category', $category);
        $data = $this->db->group_by('a.school_id')->order_by('points', 'DESC')->get()->result_object();

        if (!$data) {
            return [
                400,
                'Tidak ada yang bisa ditampilkan'
            ];
        }

        return [
            200,
            $data
        ];
    }

    public function pointByContest($mmu, $contest)
    {
        return $this->db->get_where('valuations', ['school_id' => $mmu, 'contest_id' => $contest])->row_object();
    }

    public function pointByContestAjax($mmu, $contest)
    {
        $data = $this->db->get_where('valuations', ['school_id' => $mmu, 'contest_id' => $contest])->row_object();
        if ($data) {
            return $data->point;
        }

        return 0;
    }
}

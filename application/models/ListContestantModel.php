<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ListContestantModel extends CI_Model
{
    public function contest()
    {
        return $this->db->get('contests')->result_object();
    }

    public function loadData()
    {
        $category = $this->input->post('category', true);
        $contest = $this->input->post('contest', true);

        $this->db->select('a.*, b.name AS mmu, b.undian, c.name AS contest')->from('participants AS a');
        $this->db->join('schools AS b', 'a.school_id = b.id');
        $this->db->join('contests AS c', 'a.contest_id = c.id');
        if ($category != '') {
            $this->db->where('a.category', $category);
        }

        if ($contest != '') {
            $this->db->where('a.contest_id', $contest);
        }
        $result = $this->db->order_by('b.undian ASC, a.category ASC, a.contest_id ASC')->get();
        return [
            $result->result_object(),
            $result->num_rows()
        ];
    }

    public function loadDataMc()
    {
        $category = $this->input->post('category', true);
        $contest = $this->input->post('contest', true);

        if ($category == '' || $contest == '') {
            return [
                400,
                'Jenis Lomba atau Kategori harus dipilih',
                '',
                0
            ];
        }

        //GET CONTEST
        $getContest = $this->db->get_where('contests', [
            'id' => $contest
        ])->row_object();

        $this->db->select('a.*, b.name AS mmu, b.undian, b.village, b.city')->from('participants AS a');
        $this->db->join('schools AS b', 'a.school_id = b.id');
        $this->db->where([
            'a.category' => $category, 'a.contest_id' => $contest
        ]);
        $result = $this->db->order_by('b.undian', 'ASC')->get()->result_object();
        if (!$result) {
            return [
                400,
                'Tidak ada data untuk ditampikan',
                '',
                0
            ];
        }

        return [
            200,
            $result,
            $getContest->name,
            $category
        ];
    }

    public function loadDataJury()
    {
        $category = $this->input->post('category', true);
        $contest = $this->input->post('contest', true);
        $contestID = $this->input->post('contest_id', true);
        $jury = $this->input->post('jury', true);

        $juries = ['' => 'JURI', 1 => 'JURI I', 2 => 'JURI II'];

        if ($category == '' || $contest == '') {
            return [
                400,
                'Jenis Lomba atau Kategori harus dipilih',
                '',
                0,
                '',
                '',
                ''
            ];
        }

        if ($contestID == 2 && $jury == '') {
            return [
                400,
                'Juri harus dipilih terlebih dahulu',
                '',
                0,
                '',
                '',
                ''
            ];
        }

        //GET CONTEST
        $getContest = $this->db->get_where('contests', [
            'id' => $contest
        ])->row_object();

        //GET JURY
        if ($contestID == 1) {
            $juryName = '';
            $evaluation = '';
            $head = 'JURI';
        } else {
            $getJury = $this->db->get_where('juries', [
                'type' => $jury, 'category' => $category, 'contest_id' => $contest
            ])->row_object();
            $juryName = $getJury->name;
            $evaluation = $getJury->evaluation;
            $head = $juries[$jury];
        }

        $this->db->select('a.*, b.name AS mmu, b.undian, b.village, b.city')->from('participants AS a');
        $this->db->join('schools AS b', 'a.school_id = b.id');
        $this->db->where([
            'a.category' => $category, 'a.contest_id' => $contest
        ]);
        $result = $this->db->order_by('b.undian', 'ASC')->get()->result_object();
        if (!$result) {
            return [
                400,
                'Tidak ada data untuk ditampikan',
                '',
                0,
                '',
                '',
                ''
            ];
        }

        return [
            200,
            $result,
            $getContest->name,
            $category,
            $juryName,
            $evaluation,
            $head
        ];
    }
}

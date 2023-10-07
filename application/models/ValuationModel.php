<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ValuationModel extends CI_Model
{
    public function valuation()
    {
        $contest = $this->input->post('contest', true);
        $category = $this->input->post('category', true);
        $order = $this->input->post('order', true);

        if ($contest && $category) {
            $this->db->select('a.*, b.name, c.name as mmu, c.undian')->from('valuations as a');
            $this->db->join('participants as b', 'b.school_id = a.school_id');
            $this->db->join('schools as c', 'c.id = a.school_id');
            $this->db->where(['a.contest_id' => $contest, 'a.category' => $category]);
            return $this->db->order_by($order, 'ASC')->group_by('a.school_id')->get()->result_object();
        }

        return '';
    }
    public function contest()
    {
        return $this->db->get('contests')->result_object();
    }

    public function participants($contest, $category)
    {
        if ($contest && $category) {
            $check = $this->checkPoint($contest, $category);
            if ($check) {
                return $this->edit($contest, $category);
            }

            $this->db->select('a.*, b.name as mmu, b.id as id_mmu, b.undian')->from('participants as a')->join('schools as b', 'b.id = a.school_id');
            $this->db->where(['a.contest_id' => $contest, 'a.category' => $category]);
            return $this->db->order_by('b.undian', 'ASC')->group_by('a.school_id')->get()->result_object();
        }

        return '';
    }

    public function edit($contest, $category)
    {
        $this->db->select('a.*, b.name, c.name as mmu, c.undian')->from('valuations as a');
        $this->db->join('participants as b', 'b.school_id = a.school_id');
        $this->db->join('schools as c', 'c.id = a.school_id');
        $this->db->where(['a.contest_id' => $contest, 'a.category' => $category]);
        return $this->db->order_by('c.undian', 'ASC')->group_by('a.school_id')->get()->result_object();
    }

    public function checkPoint($contest, $category)
    {
        return $this->db->get_where('valuations', [
            'contest_id' => $contest, 'category' => $category
        ])->row_object();
    }

    public function save()
    {
        $contest = $this->input->post('contest', true);
        $category = $this->input->post('category', true);
        $nilai = $this->input->post('nilai', true);
        foreach ($nilai as $key => $value) {
            if ($value > 0) {
                $this->db->insert('valuations', [
                    'school_id' => $key,
                    'contest_id' => $contest,
                    'category' => $category,
                    'nilai' => $value
                ]);
            }
        }

        $this->setPoint($contest, $category);
    }

    public function setPoint($contest, $category)
    {
        $result = $this->db->select('*')->from('valuations')->where([
            'contest_id' => $contest, 'category' => $category
        ])->order_by('nilai', 'desc')->get()->result_object();
        $points = [1 => 100, 95, 90, 87, 84, 81, 78, 75, 72, 69, 66, 63, 60, 57, 54, 51, 48, 45, 42, 39, 36, 33, 30];

        if ($result) {
            $no = 0;
            $lastNilai = 0;
            foreach ($result as $i) {
                if ($i->nilai != $lastNilai) {
                    $no++;
                }
                if ($no >= 1 && $no <= 23) {
                    $point = $points[$no];
                }else{
                    $point = 30;
                }
                $lastNilai = $i->nilai;

                $this->db->where('id', $i->id)->update('valuations', [
                    'point' => $point, 'rank' => $no
                ]);
            }
        }
    }

    public function update()
    {
        $nilai = $this->input->post('nilai', true);
        foreach ($nilai as $key => $value) {
            if ($value > 0) {
                $this->db->where('id', $key)->update('valuations', [
                    'nilai' => $value
                ]);
            }else{
                $this->db->where('id', $key)->delete('valuations');
            }
        }

        $contest = $this->input->post('contest', true);
        $category = $this->input->post('category', true);
        $this->setPoint($contest, $category);
    }

    public function getContestById()
    {
        $contest = $this->input->post('contest', true);
        $category = $this->input->post('category', true);
        $gender = [1 => 'PUTRA', 'PUTRI'];
        $data = $this->db->get_where('contests', ['id' => $contest])->row_object();
        if ($data) {
            return $data->name.' '.$gender[$category];
        }

        return '';
    }
}

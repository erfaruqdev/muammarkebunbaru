<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ValuationModel extends CI_Model
{
    public function valuation()
    {
        $contest = $this->input->post('contest', true);
        $category = $this->input->post('category', true);
        $order = $this->input->post('order', true);

        $data = [];

        if ($contest && $category) {
            $this->db->select('a.*, c.name as mmu, c.undian')->from('participants as a');
            $this->db->join('schools as c', 'c.id = a.school_id');
            $this->db->where(['a.contest_id' => $contest, 'a.category' => $category]);
            $result =  $this->db->order_by($order, 'ASC')->group_by('a.school_id')->get()->result_object();
            if ($result) {
                foreach ($result as $d) {
                    $id = $d->school_id;
                    $valuation = $this->getValuation($id, $contest, $category);
                    $data[] = [
                        'undi' => $d->undian,
                        'name' => $d->name,
                        'mmu' => $d->mmu,
                        'nilai' => $valuation[0],
                        'point' => $valuation[1],
                        'rank' => $valuation[2]
                    ];
                }
            }

            return $data;
        }

//        if ($contest && $category) {
//            $this->db->select('a.*, b.name, c.name as mmu, c.undian')->from('valuations as a');
//            $this->db->join('participants as b', 'b.school_id = a.school_id');
//            $this->db->join('schools as c', 'c.id = a.school_id');
//            $this->db->where(['b.contest_id' => $contest, 'a.category' => $category]);
//            return $this->db->order_by($order, 'ASC')->group_by('a.school_id')->get()->result_object();
//        }

        return '';
    }

    public function getValuation($mmu, $contest, $category)
    {
        $data = $this->db->get_where('valuations', [
            'school_id' => $mmu, 'contest_id' => $contest, 'category' => $category
        ])->row_object();
        if ($data) {
            return [
                $data->nilai,
                $data->rank,
                $data->point,
            ];
        }else{
            return [
                0,
                0,
                0
            ];
        }
    }
    public function contest()
    {
        return $this->db->get('contests')->result_object();
    }

    public function participants($contest, $category)
    {
        $data = [];

        if ($contest && $category) {
            $this->db->select('a.*, c.name as mmu, c.undian')->from('participants as a');
            $this->db->join('schools as c', 'c.id = a.school_id');
            $this->db->where(['a.contest_id' => $contest, 'a.category' => $category]);
            $result = $this->db->order_by('c.undian', 'ASC')->group_by('a.school_id')->get()->result_object();
            if ($result) {
                foreach ($result as $d) {
                    $id = $d->school_id;
                    $valuation = $this->getValuation($id, $contest, $category);
                    $data[] = [
                        'undi' => $d->undian,
                        'name' => $d->name,
                        'mmu' => $d->mmu,
                        'nilai' => $valuation[0],
                        'point' => $valuation[1],
                        'rank' => $valuation[2]
                    ];
                }
            }
        }

        return $data;
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
        $contest = $this->input->post('contest', true);
        $category = $this->input->post('category', true);
        $nilai = $this->input->post('nilai', true);
        foreach ($nilai as $key => $value) {
            if ($value > 0) {
                $this->db->where([
                    'school_id' => $key, 'contest_id' => $contest, 'category' => $category
                ])->update('valuations', [
                    'nilai' => $value
                ]);
            }else{
                $this->db->where([
                    'school_id' => $key, 'contest_id' => $contest, 'category' => $category
                ])->delete('valuations');
            }
        }

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

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ResultModel extends CI_Model
{
    public function valuation()
    {
        $contest = $this->input->post('contest', true);
        $category = $this->input->post('category', true);

        $data = [];

        if ($contest && $category) {
            $this->db->select('a.*, c.name as mmu, c.undian')->from('participants as a');
            $this->db->join('schools as c', 'c.id = a.school_id');
            $this->db->where(['a.contest_id' => $contest, 'a.category' => $category, 'a.rank !=' => 0]);
            $result =  $this->db->order_by('a.rank', 'ASC')->group_by('a.school_id')->get()->result_object();
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
                $data->point,
                $data->rank
            ];
        }else{
            return [
                0,
                0,
                0
            ];
        }
    }
    public function contests()
    {
        return $this->db->get('contests')->result_object();
    }
}

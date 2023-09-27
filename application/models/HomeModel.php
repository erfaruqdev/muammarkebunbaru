<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeModel extends CI_Model
{
    public function loadData()
    {
        //PARTICIAPNTS
        $total = $this->db->select('COUNT(id) AS total')->from('participants')->get()->row_object();
        //CATEGORY
        $this->db->select('COUNT(id) AS total, category')->from('participants');
        $category = $this->db->group_by('category')->get()->result_object();
        //SCHOOL
        $school = $this->db->select('COUNT(DISTINCT(school_id)) AS total')->from('participants')->get()->row_object();

        $male = 0;
        $female = 0;

        foreach ($category as $c) {
            if ($c->category == 1) {
                $male = $c->total;
            } else {
                $female = $c->total;
            }
        }

        return [
            $total->total,
            $male,
            $female,
            $school->total
        ];
    }

    public function getUndian()
    {
        $data = $this->db->get_where('schools', [
            'id' => $this->session->userdata('user_id')
        ])->row_object();
        if ($data) {
            return $data->undian;
        } else {
            return 0;
        }
    }

    public function school()
    {
        $data = $this->db->select('COUNT(DISTINCT school_id) as total')->from('participants')->get()->row_object();
        if ($data) {
            return $data->total;
        }

        return 0;
    }

    public function participants()
    {
        $data = $this->db->select('category, COUNT(id) as total')->from('participants')->group_by('category')->get()->result_object();
        $male = 0;
        $female = 0;
        if ($data) {
            foreach ($data as $d) {
                if ($d->category == 1) {
                    $male += $d->total;
                }else{
                    $female += $d->total;
                }
            }
        }

        return [$male, $female, $male + $female];
    }

    public function contests()
    {
        $this->db->select('b.name, COUNT(a.id) as total')->from('participants as a');
        $this->db->join('contests as b', 'b.id = a.contest_id');
        return $this->db->group_by('a.contest_id')->order_by('b.id')->get()->result_object();
    }

    public function contestsByGender($category)
    {
        $this->db->select('b.name, COUNT(a.id) as total')->from('participants as a');
        $this->db->join('contests as b', 'b.id = a.contest_id')->where('a.category', $category);
        return $this->db->group_by('a.contest_id')->order_by('b.id')->get()->result_object();
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PerfomeModel extends CI_Model
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
}

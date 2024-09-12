<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ContestantModel extends CI_Model
{
    public function setting()
    {
        return $this->db->get('contest_setting')->num_rows();
    }

    public function mmu()
    {
        return $this->db->order_by('undian', 'ASC')->get('schools')->result_object();
    }

    public function contest()
    {
        return $this->db->get('contests')->result_object();
    }

    public function checkContest($mmu, $contest, $category)
    {
        $check = $this->db->get_where('participants', [
            'school_id' => $mmu,
            'contest_id' => $contest,
            'category' => $category
        ])->num_rows();

        if ($contest == 1 && $check == 3 || $contest == 6 && $check == 3 || $contest == 9 && $check == 3) {
            return 1;
        }

        if ($contest != 1 && $contest != 6 && $contest != 9 && $check == 1) {
            return 1;
        }

        return 0;
    }

    public function save()
    {
        $mmu = $this->input->post('mmu', true);
        $category = $this->input->post('category', true);
        $address = $this->input->post('address', true);
        $name = $this->input->post('name', true);

        if ($this->setting() > 0) {
            return [
                'status' => 400,
                'message' => 'Tambah peserta sudah ditutup'
            ];
        }

        if ($mmu == '' || $category == '' || $address == '') {
            return [
                'status' => 400,
                'message' => 'Pastikan MMU dan Kategori sudah dipilih'
            ];
        }

        $rows = 0;
        $arrays = [
            1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 6, 6, 1, 1, 9, 9
        ];
        foreach ($name as $key => $value) {
            $k = $arrays[$key];

            if ($this->checkContest($mmu, $k, $category) <= 0 && $value != '') {
                $this->db->insert('participants', [
                    'school_id' => $mmu,
                    'contest_id' => $k,
                    'name' => strtoupper($value),
                    'address' => ucwords($address),
                    'category' => $category
                ]);

                if ($this->db->affected_rows() > 0) {
                    $rows++;
                }
            }
        }

        if ($rows <= 0) {
            return [
                'status' => 200,
                'message' => $rows
            ];
        }

        return [
            'status' => 200,
            'message' => $rows
        ];
    }

    public function saveEdit()
    {
        $id = $this->input->post('id_edit', true);
        $mmu = $this->input->post('mmu_edit', true);
        $name = $this->input->post('name_edit', true);
        $address = $this->input->post('address_edit', true);

         if ($this->setting() > 0) {
             return [
                 'status' => 400,
                 'message' => 'Fitur tambah dan edit sudah diblokir'
             ];
         }

        $check = $this->db->get_where('participants', [
            'id' => $id, 'school_id' => $mmu
        ])->num_rows();
        if ($check <= 0) {
            return [
                'status' => 400,
                'message' => 'Data tidak ditemukan'
            ];
        }

        if ($name == '' || $address == '') {
            return [
                'status' => 400,
                'message' => 'Pastikan semua inputan sudah diisi'
            ];
        }

        $this->db->where('id', $id)->update('participants', [
            'name' => strtoupper($name),
            'address' => ucwords($address)
        ]);

        if ($this->db->affected_rows() <= 0) {
            return [
                'status' => 500,
                'message' => 'Server tidak merespon. Coba muat ulang'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sukses'
        ];
    }

    public function loadData()
    {
        $mmu = $this->input->post('mmu', true);
        $category = $this->input->post('category', true);
        $contest = $this->input->post('contest', true);

        $this->db->select('a.*, b.id AS contest, b.name AS contest_name, c.name AS mmu')->from('participants AS a');
        $this->db->join('contests AS b', 'b.id = a.contest_id');
        $this->db->join('schools AS c', 'c.id = a.school_id');
        if ($mmu != '') {
            $this->db->where('a.school_id', $mmu);
        }
        if ($category != '') {
            $this->db->where('a.category', $category);
        }
        if ($contest != '') {
            $this->db->where('a.contest_id', $contest);
        }
        $this->db->order_by('b.id', 'ASC');
        $data = $this->db->get();
        
        $this->db->select('DISTINCT(school_id)')->from('participants');
        if ($category != '') {
            $this->db->where('category', $category);
        }
        if ($contest != '') {
            $this->db->where('contest_id', $contest);
        }
        $total = $this->db->get()->num_rows();

        return [
            $data->result_object(),
            $data->num_rows(),
            $total
        ];
    }

    public function delete($id)
    {
        $check = $this->db->get_where('participants', [
            'id' => $id
        ])->num_rows();
        if ($check <= 0) {
            return [
                'status' => 400,
                'message' => 'Data tidak ditemukan'
            ];
        }

        $this->db->where('id', $id)->delete('participants');
        if ($this->db->affected_rows() <= 0) {
            return [
                'status' => 500,
                'message' => 'Server tidak merespon. Coba muat ulang'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sukses'
        ];
    }

    public function getData()
    {
        $id = $this->input->post('id', true);

        $check = $this->db->get_where('participants', [
            'id' => $id
        ])->num_rows();
        if ($check <= 0) {
            return [
                'status' => 400,
                'message' => 'Data tidak ditemukan'
            ];
        }

        $this->db->select('a.*, b.id AS contest, b.name AS contest_name')->from('participants AS a');
        $this->db->join('contests AS b', 'b.id = a.contest_id');
        $data = $this->db->where('a.id', $id)->get()->row_object();

        if (!$data) {
            return [
                'status' => 400,
                'message' => 'Data tidak ditemukan'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sukses',
            'data' => $data
        ];
    }

    public function checkContestPerMmu($mmu, $contest, $category)
    {
        return $this->db->get_where('participants', [
            'school_id' => $mmu,
            'contest_id' => $contest,
            'category' => $category
        ])->num_rows();
    }
}

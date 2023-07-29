<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SchoolModel extends CI_Model
{
    public function export()
    {
        return $this->db->get('schools')->result_object();
    }

    public function getData()
    {
        $zone = $this->input->post('zone', true);
        $name = $this->input->post('name', true);

        $this->db->select('*')->from('schools');
        if ($zone != '') {
            if ($zone == 'Luar Madura') {
                $this->db->where_not_in('city', [
                    'Sumenep', 'Pamekasan', 'Sampang', 'Bangkalan'
                ]);
            } else {
                $this->db->where('city', $zone);
            }
        }

        if ($name != '') {
            $this->db->like('name', $name);
        }
        $data = $this->db->order_by('undian', 'ASC')->get()->result_object();

        $this->db->select('*')->from('schools');
        if ($zone != '') {
            if ($zone == 'Luar Madura') {
                $this->db->where_not_in('city', [
                    'Sumenep', 'Pamekasan', 'Sampang', 'Bangkalan'
                ]);
            } else {
                $this->db->where('city', $zone);
            }
        }
        if ($name != '') {
            $this->db->like('name', $name);
        }
        $amount = $this->db->get()->num_rows();

        return [$data, $amount];
    }

    public function print()
    {
        $zone = $this->input->post('zone', true);
        $this->db->select('*')->from('schools');
        if ($zone != '') {
            if ($zone == 'Luar Madura') {
                $this->db->where_not_in('city', [
                    'Sumenep', 'Pamekasan', 'Sampang', 'Bangkalan'
                ]);
            } else {
                $this->db->where('city', $zone);
            }
        }

        return $this->db->order_by('undian', 'ASC')->get()->result_object();
    }

    public function getUsername($id)
    {
        $data = $this->db->get_where('users', [
            'id' => $id
        ])->row_object();
        if ($data) {
            return $data->username;
        } else {
            return 0;
        }
    }
    
    public function getAnaliytic()
    {
        //$this->db->select('id, name, pjgb, undian')->from('schools')->where('id !=', 1391008521);
        //return $this->db->order_by('undian', 'ASC')->get()->result_object();
        return $this->db->query("SELECT * FROM schools WHERE id != '1391008521' AND status = 'ACTIVE' AND id NOT IN (SELECT school_id FROM payments WHERE STATUS = 'LUNAS') ORDER BY undian ASC")->result_object();
    }

    public function analyticDetail($id)
    {
        $man = $this->db->get_where('participants', [
            'school_id' => $id, 'category' => 1
        ])->num_rows();

        $women = $this->db->get_where('participants', [
            'school_id' => $id, 'category' => 2
        ])->num_rows();

        $payment = $this->db->order_by('created_at', 'DESC')->get_where('payments', [
            'school_id' => $id
        ])->row_object();

        if ($man > 0) {
            $manResult = $man . ' Org';
        } else {
            $manResult = 'X';
        }

        if ($women > 0) {
            $womenResult = $women . ' Org';
        } else {
            $womenResult = 'X';
        }

        if ($payment) {
            $paymentResult = $payment->status;
        } else {
            $paymentResult = 'BELUM BAYAR';
        }

        return [
            $manResult,
            $womenResult,
            $paymentResult
        ];
    }
}

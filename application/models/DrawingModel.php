<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DrawingModel extends CI_Model
{
    public function schools()
    {
        return $this->db->get_where('schools', ['status' => 'ACTIVE'])->result_object();
    }

    public function save()
    {
        $drawing = $this->input->post('drawing', true);
        $rows = 1;
        foreach ($drawing as $key => $value) {
            if ($value != '') {
                $this->db->where('id', $key)->update('schools', [
                    'undian' => $value
                ]);
                if ($this->db->affected_rows() > 0) {
                    $rows++;
                }
            }
        }

        if ($rows <= 0) {
            return [
                'status' => 400,
                'message' => 'Tidak ada data yang berhasil diupdate'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sukses'
        ];
    }
}

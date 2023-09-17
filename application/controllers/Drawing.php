<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Drawing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataModel', 'dm');
        $this->load->model('DrawingModel', 'drm');
        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Undian Urut Tampil',
            'schools' => $this->drm->schools()
        ];
        $this->load->view('drawing/drawing', $data);
    }

    public function save()
    {
        $result = $this->drm->save();

        echo json_encode($result);
    }

    public function set()
    {
        $this->db->update('schools', ['undian' => null]);
    }


}

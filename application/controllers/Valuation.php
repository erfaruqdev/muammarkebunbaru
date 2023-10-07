<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Valuation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataModel', 'dm');
        $this->load->model('ValuationModel', 'vm');
        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Nilai',
            'contest' => $this->vm->contest()
        ];
        $this->load->view('valuation/valuation', $data);
    }

    public function valuation()
    {
        $data = [
            'valuation' => $this->vm->valuation()
        ];
        $this->load->view('valuation/ajax-data', $data);
    }

    public function create()
    {
        $contest = $this->input->post('contest', true);
        $category = $this->input->post('category', true);
        $check = $this->vm->checkPoint($contest, $category);
        $data = [
            'title' => $check ? 'Edit Nilai' : 'Input Nilai',
            'contests' => $this->vm->contest(),
            'contest' => $contest,
            'category' => $category,
            'participants' => $this->vm->participants($contest, $category)
        ];
        if ($check) {
            $this->load->view('valuation/create/valuation-edit', $data);
        }else{
            $this->load->view('valuation/create/valuation-create', $data);
        }
    }

    public function save()
    {
        $this->vm->save();

        redirect('valuation/create');
    }

    public function update()
    {
        $this->vm->update();

        redirect('valuation/create');
    }

    public function printResult()
    {
        $data = [
            'title' => 'Print Daftar Nilai',
            'valuations' => $this->vm->valuation(),
            'contest' => $this->vm->getContestById()
        ];
        $this->load->view('print/print-point', $data);
    }

    public function coba()
    {
        $data = $this->db->select('id, nilai')->from('valuations')->order_by('nilai', 'DESC')->get()->result();

        $no = 0;
        $last = 0;
        foreach ($data as $d) {
            if ($d->nilai != $last) {
                $no++;
            }
            $last = $d->nilai;

            $this->db->where('id', $d->id)->update('valuations', ['rank' => $no]);
        }
    }
}

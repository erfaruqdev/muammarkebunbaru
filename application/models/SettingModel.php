<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SettingModel extends CI_Model
{
    private $_batchImportSchool;
    private $_batchImportCalendar;

    public function setBatchImportCalendar($batchImport)
    {
        $this->_batchImportCalendar = $batchImport;
    }

    public function importDataCalendar()
    {
        $data = $this->_batchImportCalendar;
        $this->db->insert_batch('calendar', $data);
    }

    public function setBatchImportSchool($batchImport)
    {
        $this->_batchImportSchool = $batchImport;
    }

    public function importDataSchool()
    {
        $data = $this->_batchImportSchool;
        $this->db->insert_batch('schools', $data);
    }
}
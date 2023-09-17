<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataModel', 'dm');
        $this->load->model('SettingModel', 'sm');
        $this->load->helper('download');
        CekLoginAkses();
    }

    public function index()
    {
        $data = [
            'title' => 'Setting Awal Sistem'
        ];
        $this->load->view('setting/setting', $data);
    }

    public function importCalendar()
    {
        $file_mimes = array(
            'text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );


        $arr_file = explode('.', $_FILES['file']['name']);
        $extension = end($arr_file);

        if (($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') && in_array($_FILES['file']['type'], $file_mimes)) {

            $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

            if ($extension == 'csv') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } elseif ($extension == 'xlsx') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            }
            // file path
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
            $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            // array Count
            $arrayCount = count($allDataInSheet);
            $flag = 0;
            $createArray = ['hijri', 'masehi'];
            $makeArray = ['hijri' => 'hijri', 'masehi' => 'masehi'];
            $SheetDataKey = array();
            foreach ($allDataInSheet as $dataInSheet) {
                foreach ($dataInSheet as $key => $value) {
                    if (in_array(trim($value), $createArray)) {
                        $value = preg_replace('/\s+/', '', $value);
                        $SheetDataKey[trim($value)] = $key;
                    }
                }
            }
            $dataDiff = array_diff_key($makeArray, $SheetDataKey);
            if (empty($dataDiff)) {
                $flag = 1;
            }
            // match excel sheet column
            if ($flag == 1) {
                for ($i = 2; $i <= $arrayCount; $i++) {

                    $hijri = filter_var(trim($allDataInSheet[$i][$SheetDataKey['hijri']]), FILTER_SANITIZE_STRING);
                    $masehi = filter_var(trim($allDataInSheet[$i][$SheetDataKey['masehi']]), FILTER_SANITIZE_STRING);
                    $fetchData[] = [
                        'hijri' => $hijri,
                        'masehi' => ucwords($masehi)
                    ];
                }
                $this->sm->setBatchImportCalendar($fetchData);
                $this->sm->importDataCalendar();

                $this->session->set_flashdata('import-calendar', 1);
            } else {
                $this->session->set_flashdata('import-calendar', 2);
            }
        } else {
            $this->session->set_flashdata('import-calendar', 3);
        }

        redirect('setting');
    }

    public function importSchool()
    {
        $file_mimes = array(
            'text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );


        $arr_file = explode('.', $_FILES['file']['name']);
        $extension = end($arr_file);

        if (($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') && in_array($_FILES['file']['type'], $file_mimes)) {

            $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

            if ($extension == 'csv') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } elseif ($extension == 'xlsx') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            }
            // file path
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
            $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            // array Count
            $arrayCount = count($allDataInSheet);
            $flag = 0;
            $createArray = ['name', 'address', 'village', 'district', 'city', 'pjgb', 'gb', 'phone'];
            $makeArray = [
                'name' => 'name', 'address' => 'address', 'village' => 'village',
                'district' => 'district', 'city' => 'city', 'pjgb' => 'pjgb',
                'gb' => 'gb', 'phone' => 'phone'
            ];
            $SheetDataKey = array();
            foreach ($allDataInSheet as $dataInSheet) {
                foreach ($dataInSheet as $key => $value) {
                    if (in_array(trim($value), $createArray)) {
                        $value = preg_replace('/\s+/', '', $value);
                        $SheetDataKey[trim($value)] = $key;
                    }
                }
            }
            $dataDiff = array_diff_key($makeArray, $SheetDataKey);
            if (empty($dataDiff)) {
                $flag = 1;
            }
            // match excel sheet column
            if ($flag == 1) {
                for ($i = 2; $i <= $arrayCount; $i++) {

                    $name = filter_var(trim($allDataInSheet[$i][$SheetDataKey['name']]), FILTER_SANITIZE_STRING);
                    $address = filter_var(trim($allDataInSheet[$i][$SheetDataKey['address']]), FILTER_SANITIZE_STRING);
                    $village = filter_var(trim($allDataInSheet[$i][$SheetDataKey['village']]), FILTER_SANITIZE_STRING);
                    $district = filter_var(trim($allDataInSheet[$i][$SheetDataKey['district']]), FILTER_SANITIZE_STRING);
                    $city = filter_var(trim($allDataInSheet[$i][$SheetDataKey['city']]), FILTER_SANITIZE_STRING);
                    $pjgb = filter_var(trim($allDataInSheet[$i][$SheetDataKey['pjgb']]), FILTER_SANITIZE_STRING);
                    $gb = filter_var(trim($allDataInSheet[$i][$SheetDataKey['gb']]), FILTER_SANITIZE_STRING);
                    $phone = filter_var(trim($allDataInSheet[$i][$SheetDataKey['phone']]), FILTER_SANITIZE_STRING);
                    $fetchData[] = [
                        'id' => '1391'.mt_rand(100000, 999999),
                        'name' => strtoupper($name),
                        'address' => ucwords($address),
                        'village' => ucwords($village),
                        'district' => ucwords($district),
                        'city' => ucwords($city),
                        'pjgb' => ucwords($pjgb),
                        'gb' => ucwords($gb),
                        'phone' => ucwords($phone),
                        'status' => 'ACTIVE'
                    ];
                }
                $this->sm->setBatchImportSchool($fetchData);
                $this->sm->importDataSchool();

                $this->session->set_flashdata('import-school', 1);
            } else {
                $this->session->set_flashdata('import-school', 2);
            }
        } else {
            $this->session->set_flashdata('import-school', 3);
        }

        redirect('setting');
    }

    public function setUser()
    {
        $data = $this->db->get('schools')->result_object();
        $no = 10;
        foreach ($data as $item) {
            $this->db->insert('users', [
                'id' => $no++,
                'name' => $item->name,
                'username' => $item->id,
                'password' => password_hash(123456, PASSWORD_DEFAULT),
                'role' => 'MMU',
                'status' => 'ACTIVE',
                'type' => 3
            ]);
        }
    }

    public function qrcode()
    {
        $this->load->library('ciqrcode');
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']             = './assets/'; //string, the default is application/cache/
        $config['errorlog']             = './assets/'; //string, the default is application/logs/
        $config['imagedir']             = './assets/images/qrcodes/'; //direktori penyimpanan qr code
        $config['quality']              = true; //boolean, the default is true
        $config['size']                 = '1024'; //interger, the default is 1024
        $config['black']                = array(224,255,255); // array, default is array(255,255,255)
        $config['white']                = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $data = $this->db->get('schools')->result_object();
        foreach ($data as $item) {
            $image_name = $item->id.'.png';
            $params['data'] = $item->id; //data yang akan di jadikan QR CODE
            $params['level'] = 'H'; //H=High
            $params['size'] = 10;
            $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
            $this->ciqrcode->generate($params);
        }

    }

    public function setID()
    {
        $data = $this->db->get_where('users', ['id >' => 9])->result_object();
        foreach ($data as $item) {
            $this->db->where('id', $item->id)->update('users', ['id' => $item->username]);
        }
    }

    public function qrcodemid()
    {
        $this->load->library('ciqrcode');
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']             = './assets/'; //string, the default is application/cache/
        $config['errorlog']             = './assets/'; //string, the default is application/logs/
        $config['imagedir']             = './assets/images/qrcodes/'; //direktori penyimpanan qr code
        $config['quality']              = true; //boolean, the default is true
        $config['size']                 = '1024'; //interger, the default is 1024
        $config['black']                = array(224,255,255); // array, default is array(255,255,255)
        $config['white']                = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = '1391092023.png';
        $params['data'] = 1391092023; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params);
    }
}
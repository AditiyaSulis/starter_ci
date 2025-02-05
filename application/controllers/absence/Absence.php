<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Absence extends MY_Controller{

    function __construct()
    {
        parent::__construct();

    }

    public function absence_page()
    {
        $this->_ONLYSELECTED([1,2]);
        $data = $this->_basicData();

        $data['title'] = 'Absence';
        $data['view_name'] = 'absence/index';
        $data['breadcrumb'] = 'Absence';
        $data['menu'] = '';

        if($data['user']) { 
            $this->load->view('templates/index' ,$data);
        } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
            redirect('fetch/login');
        }
    }




}

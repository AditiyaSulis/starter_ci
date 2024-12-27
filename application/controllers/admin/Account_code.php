<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_code extends MY_Controller{

    function __construct(){
        parent::__construct();

        $this->load->model('m_Account_code');
        $this->load->model('m_Categories');
    }

    public function ac_page(){
        $this->_ONLYSELECTED([1,2]);
       $data = $this->_basicData();

       $data['title'] = 'Account Code & Category';
       $data['view_name'] = 'admin/account_code';
       $data['breadcrumb'] = 'Account Code';

       $data['categories'] = $this->m_Categories->findAll_get();
       $data['account_code'] = $this->m_Account_code->findAllWithJoin_get();

       if($data['user']) {
            $this->load->view('templates/index', $data);
       } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
            redirect('fetch/login');
       }
        
       
    }
}
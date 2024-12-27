<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('m_Employees');
        $this->load->model('m_Products');
        $this->load->model('m_Finance_records');
    }


    public function dashboard_page(){

        $this->_ONLYSELECTED([1,2]);
        $data = $this->_basicData();

      
        $data['allUsers'] = $this->m_Admin->totalUsers_get();
        $data['allSuperUsers'] = $this->m_Admin->totalSuperUsers_get();
        $data['allAdmins']= $this->m_Admin->totalAdmins_get();
        $data['allProducts']= $this->m_Products->totalProducts_get();
        $data['allEmployees']= $this->m_Employees->totalEmployees_get();
        $data['allRecords']= $this->m_Finance_records->totalFinanceRecords_get();

        $data['title'] = 'Admin ';
        $data['view_name'] = 'admin/index';
        $data['breadcrumb'] = 'Dashboard';
        if($data['user']) { 
            $this->load->view('templates/index' ,$data);
        } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
            redirect('fetch/login');
        }
    }
   
}
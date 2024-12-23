<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('m_Employees');
        $this->load->model('m_Products');
        $this->load->model('m_Finance_records');
    }

    // public function dashboard_page(){


    //     $id = $this->session->userdata('user');
    //     $data['user'] = $this->m_Admin->findById($id);
    //     $data['allUsers'] = $this->m_Admin->total_users();
    //     $data['allSuperUsers'] = $this->m_Admin->total_super_users();
    //     $data['allAdmins']= $this->m_Admin->total_admins();

    //     $data['title'] = 'Admin ';
    //     $data['view_name'] = 'admin/index';
    //     $data['breadcrumb'] = 'Dashboard';
    //     // if($data['user']) { 
    //     //     if($data['user']['role'] == 1){
    //     //         $this->load->view('templates/index' ,$data);
    //     //     } else {
    //     //         redirect('super_user/super_user/super_user_page');
    //     //     }
    //     if($data['user']) { 
    //         $this->load->view('templates/index' ,$data);
    //     } else {
    //         $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
    //         redirect('fetch/login');
    //     }
    // }


    public function dashboard_page(){

        $this->_ONLYSELECTED([1,2]);
        $data = $this->_basicData();

      
        $data['allUsers'] = $this->m_Admin->total_users();
        $data['allSuperUsers'] = $this->m_Admin->total_super_users();
        $data['allAdmins']= $this->m_Admin->total_admins();
        $data['allProducts']= $this->m_Products->total_products();
        $data['allEmployees']= $this->m_Employees->total_employees();
        $data['allRecords']= $this->m_Finance_records->total_finance_records();

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
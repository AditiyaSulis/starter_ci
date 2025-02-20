<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_Employees');
        $this->load->model('m_Products');
        $this->load->model('m_Finance_records');
        $this->load->model('m_Piutang');
        $this->load->model('m_Schedule');
    }


    public function dashboard_page()
    {
        $this->_ONLYSELECTED([1,2]);
        $data = $this->_basicData();

        $data['allUsers'] = $this->m_Admin->totalUsers_get();
        $data['allSuperUsers'] = $this->m_Admin->totalSuperUsers_get();
        $data['allAdmins']= $this->m_Admin->totalAdmins_get();
        $data['allProducts']= $this->m_Products->totalProducts_get();
        $data['allEmployees']= $this->m_Employees->totalEmployees_get();
        $data['allRecords']= $this->m_Finance_records->totalFinanceRecords_get();

        $data['totalJatuhTempo']= $this->m_Piutang->totalJatuhTempo_get();
        $data['jatuhTempo']= $this->m_Piutang->jatuhTempo_get();
		$data['totalUnpaid']= $this->m_Piutang->totalUnpaid_get();
		$data['totalPaid']= $this->m_Piutang->totalPaid_get();

		$data['view_data'] = 'core/piutang/data_piutang';
		$data['view_components'] = 'core/piutang/data_piutang_components';

		$updatedRows = $this->m_Schedule->mark_absent_if_no_checkin();

        $data['title'] = 'Admin';
        $data['view_name'] = 'admin/index';
        $data['breadcrumb'] = 'Dashboard';
        $data['menu'] = '';

        if($data['user']) { 
            $this->load->view('templates/index' ,$data);
        } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
            redirect('fetch/login');
        }
    }




}

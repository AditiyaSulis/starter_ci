<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_employees');
        $this->load->model('M_products');
        $this->load->model('M_finance_records');
        $this->load->model('M_piutang');
        $this->load->model('M_schedule');
    }

    public function dashboard_page()
    {
        $this->_ONLYSELECTED([1,2,4]);
        $data = $this->_basicData();

        $data['allUsers'] = $this->M_admin->totalUsers_get();
        $data['allSuperUsers'] = $this->M_admin->totalSuperUsers_get();
        $data['allAdmins']= $this->M_admin->totalAdmins_get();
        $data['allProducts']= $this->M_products->totalProducts_get();
        $data['allEmployees']= $this->M_employees->totalEmployees_get();
        $data['allRecords']= $this->M_finance_records->totalFinanceRecords_get();

        $data['totalJatuhTempo']= $this->M_piutang->totalJatuhTempo_get();
        $data['jatuhTempo']= $this->M_piutang->jatuhTempo_get();
		$data['totalUnpaid']= $this->M_piutang->totalUnpaid_get();
		$data['totalPaid']= $this->M_piutang->totalPaid_get();

		$data['view_data'] = 'core/piutang/data_piutang';
		$data['view_components'] = 'core/piutang/data_piutang_components';

		$updatedRows = $this->M_schedule->mark_absent_if_no_checkin();

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

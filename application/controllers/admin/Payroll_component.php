<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_component extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_Overtime');
		$this->load->model('M_employees');
		$this->load->model('M_division');
		$this->load->model('M_products');
	}

	public function payroll_component_page()
	{
		$this->_ONLYSELECTED([1, 2]);
		$data = $this->_basicData();

		$data['title'] = 'Payroll Component';
		$data['view_name'] = 'core/payroll_component/view_payroll_component';
		$data['breadcrumb'] = 'Payroll Component';
		$data['menu'] = '';

		$data['products'] = $this->M_products->findAll_get();
		$data['divisions'] = $this->M_division->findAll_get();

//		$data['view_data'] = 'core/payroll_component/data_payroll_component';
//		$data['view_components'] = 'core/payroll_component/data_payroll_component_components';

		if ($data['user']) {
			$this->load->view('core/payroll_component/data_payroll_component', $data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}
}

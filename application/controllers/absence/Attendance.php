<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_Day_off');
		$this->load->model('m_Products');
		$this->load->model('m_Employees');
		$this->load->model('m_Schedule');

	}

	public function attendance_page()
	{
		$this->_ONLYSELECTED([3]);
		$data = $this->_basicData();

		$data['title'] = 'Attendance';
		$data['view_name'] = 'absence/rekap';
		$data['breadcrumb'] = 'Attendance';
		$data['menu'] = '';

		$id = $this->m_Employees->findByEmail_get($data['user']['email']);
		$data['employee'] = $id['id_employee'];

		//	$data['products'] = $this->m_Products->findAll_get();
		$data['view_data'] = 'core/attendance/data_attendance';

		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}

	public function su_attendance_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Data Attendance';
		$data['view_name'] = 'absence/data/attendance';
		$data['breadcrumb'] = 'Data - Attendance';
		$data['menu'] = 'Data';

		$data['employee'] = 'false';

		$data['view_data'] = 'core/attendance/data_attendance';
		$data['products'] = $this->m_Products->findAll_get();


		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}

	public function log_attendance_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Data Attendance';
		$data['view_name'] = 'absence/data/log_attendance';
		$data['breadcrumb'] = 'Data - Attendance';
		$data['menu'] = 'Data';

		$data['employee'] = 'false';

		$data['view_data'] = 'core/log_attendance/data_log_attendance';
		$data['products'] = $this->m_Products->findAll_get();


		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}


}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataAttendance extends MY_Controller{

	function __construct()
	{
		parent::__construct();

	}

	public function data_attendance_page()
	{
		$this->_ONLYSELECTED([1,2,4]);
		$data = $this->_basicData();

		$data['title'] = 'Data Attendance';
		$data['view_name'] = 'absence/data/data_attendance';
		$data['breadcrumb'] = 'Data - Attendance';
		$data['menu'] = '';

		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}




}

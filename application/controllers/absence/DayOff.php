<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DayOff extends MY_Controller{

	function __construct()
	{
		parent::__construct();

	}

	public function day_off_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Day Off';
		$data['view_name'] = 'absence/day_off';
		$data['breadcrumb'] = 'Day Off';
		$data['menu'] = '';

		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}




}

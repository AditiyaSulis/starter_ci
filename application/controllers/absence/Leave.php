<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends MY_Controller{

	function __construct()
	{
		parent::__construct();

	}

	public function leave_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Leave';
		$data['view_name'] = 'absence/leave';
		$data['breadcrumb'] = 'Leave';
		$data['menu'] = '';

		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}




}

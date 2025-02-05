<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Holyday extends MY_Controller{

	function __construct()
	{
		parent::__construct();

	}

	public function holyday_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Holyday';
		$data['view_name'] = 'absence/holyday';
		$data['breadcrumb'] = 'Holyday';
		$data['menu'] = '';

		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}




}

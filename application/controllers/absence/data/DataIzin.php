<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataIzin extends MY_Controller{

	function __construct()
	{
		parent::__construct();

	}

	public function data_izin_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Data Izin';
		$data['view_name'] = 'absence/data/data_izin';
		$data['breadcrumb'] = 'Data - Izin';
		$data['menu'] = '';

		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}




}

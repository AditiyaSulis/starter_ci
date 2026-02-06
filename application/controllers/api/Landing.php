<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Landing extends RestController{


	function __construct()
	{
		parent::__construct();
		$this->load->model('M_setting');
		$this->load->model('M_karir');
		$this->load->model('M_product_homepage');
		$this->load->model('M_partner');
		validate_header();

	}

	//===========COMPANY PROFILE=============
	/* Mengambil 1 Data Company Profile */
	public function company_get()
	{

		$company_profile = $this->M_setting->getCp_get();

		if($company_profile){
			$this->response([
				'status' => true,
				'data' => $company_profile
			], 200);
		} else {
			$this->response([
				'status' => false,
				'message' => 'Data tidak ditemukan'
			], 404);
		}
	}


	//===========Product Homepage=============
	public function product_get()
	{
		$products = $this->M_product_homepage->findAll_get();

		if ($products) {
			$this->response([
				'status' => true,
				'data' => $products
			], 200);
		} else {
			$this->response([
				'status' => false,
				'message' => 'Data tidak ditemukan'
			], 404);
		}
	}



	//===========Carier=============
	public function carier_get()
	{
		$products = $this->M_karir->findAllAvailable_get();

		if ($products) {
			$this->response([
				'status' => true,
				'data' => $products
			], 200);
		} else {
			$this->response([
				'status' => false,
				'message' => 'Data tidak ditemukan'
			], 404);
		}
	}  

	public function partner_get()
	{
		$partner = $this->M_partner->findAllShow_get();

		if ($partner) {
			$this->response([
				'status' => true,
				'data' => $partner
			], 200);
		} else {
			$this->response([
				'status' => false,
				'message' => 'Data tidak ditemukan'
			], 404);
		}
	}





}

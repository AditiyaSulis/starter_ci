<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Holyday extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_Holyday');
		$this->load->model('M_products');
		$this->load->model('M_division');
		$this->load->model('M_schedule');
	}

	public function holyday_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Data Holyday';
		$data['view_name'] = 'absence/data/holyday';
		$data['breadcrumb'] = 'Data Holyday';
		$data['menu'] = 'Data';

		$data['products'] = $this->M_products->findAll_get();
		$data['divisions'] = $this->M_division->findAll_get();

		$data['view_data'] = 'core/holyday/data_holyday';
		$data['view_components'] = 'core/holyday/data_holyday_components';

		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}

	public function add_holyday() {
		$this->_ONLY_SU();
		$this->_isAjax();

		$this->form_validation->set_rules('type_group', 'type_group', 'required', [
			'required' => 'Type Group harus diisi',
		]);

		$this->form_validation->set_rules('type_day', 'type_day', 'required', [
			'required' => 'Type day harus diisi',
		]);

		$this->form_validation->set_rules('start_day', 'start_day', 'required', [
			'required' => 'Tanggal Mulai harus diisi',
		]);

		$this->form_validation->set_rules('code_holyday', 'code_holyday', 'required', [
			'required' => 'Kode Holiday harus diisi',
		]);

		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => false,
				'message' => validation_errors('<p>', '</p>'),
				'confirmationbutton' => true,
				'timer' => 0,
				'icon' => 'error',
			]);
			return;
		}



		$typeGroup = $this->input->post('type_group', true);
		$typeDay = $this->input->post('type_day', true);
		$totalDays = $this->input->post('total', true);

		$dataBatch = [];
		$product = [];
		$division = [];

		if ($typeGroup == 1) {
			$product = $this->M_products->getAllIds_get();
			$division = (array) $this->input->post('id_division', true);
		} elseif ($typeGroup == 2) {
			$division = $this->M_division->getAllIds_get();
			$product = (array) $this->input->post('id_product', true);
		} elseif ($typeGroup == 3) {
			$product = $this->M_products->getAllIds_get();
			$division = $this->M_division->getAllIds_get();
		} elseif ($typeGroup == 4) {
			$product = (array) $this->input->post('id_product', true);
			$division = (array) $this->input->post('id_division', true);
		}




		if($typeDay == 1) {
			foreach ($product as $productId) {
				foreach ($division as $divisionId) {
					$idProduct = is_array($productId) ? $productId['id_product'] : $productId;
					$idDivision = is_array($divisionId) ? $divisionId['id_division'] : $divisionId;
					$this->M_schedule->setStatusFromHolyday_post($idProduct, $idDivision, $this->input->post('start_day', true), 3);
					$dataBatch[] = [
						'id_product' => is_array($productId) ? $productId['id_product'] : $productId,
						'id_division' => is_array($divisionId) ? $divisionId['id_division'] : $divisionId,
						'code_holyday' => $this->input->post('code_holyday', true),
						'type_day' => $typeDay,
						'type_group' => $typeGroup,
						'date' => $this->input->post('start_day', true),
						'end_day' => $typeDay == 2 ? $this->input->post('end_day', true) : null,
						'status_day' => $this->input->post('status_day', true),
					];
				}
			}
		} else {
			for($i = 0; $i < $totalDays; $i++) {
				foreach ($product as $productId) {
					foreach ($division as $divisionId) {
						$idProduct = is_array($productId) ? $productId['id_product'] : $productId;
						$idDivision = is_array($divisionId) ? $divisionId['id_division'] : $divisionId;
		//						$this->M_schedule->setStatusFromHolyday_post($idProduct, $idDivision, $this->input->post('start_day', true));
						$dataBatch[] = [
							'id_product' => is_array($productId) ? $productId['id_product'] : $productId,
							'id_division' => is_array($divisionId) ? $divisionId['id_division'] : $divisionId,
							'code_holyday' => $this->input->post('code_holyday', true),
							'type_day' => $typeDay,
							'type_group' => $typeGroup,
							'start_day' => $this->input->post('start_day', true),
							'date' => date('Y-m-d', strtotime("+$i day", strtotime($this->input->post('start_day', true)))),
							'end_day' => $typeDay == 2 ? $this->input->post('end_day', true) : null,
							'status_day' => $this->input->post('status_day', true)
						];
						if($this->input->post('status_day', true) == 1 ){
							$this->M_schedule->setStatusFromHolyday_post($idProduct, $idDivision, date('Y-m-d', strtotime("+$i day", strtotime($this->input->post('start_day', true)))), 3);
						} else {
							$this->M_schedule->setStatusFromHolyday_post($idProduct, $idDivision, date('Y-m-d', strtotime("+$i day", strtotime($this->input->post('start_day', true)))), 8);
						}

					}
				}
			}
		}

		$holyday = $this->m_Holyday->create_batch_post($dataBatch);

		echo json_encode([
			'status' => $holyday ? true : false,
			'message' => $holyday ? 'Data libur berhasil dibuat' : 'Data libur gagal ditambahkan',
			'product' => $product,
			'division' => $division,
			'typeproduct' => gettype($product),
			'typedivision' => gettype($division),
		]);

	}


	public function delete()
	{
		$this->_ONLY_SU();
		$this->_isAjax();

		$id = $this->input->post('id');
		$data = $this->m_Holyday->findById_get($id);

		if($this->m_Holyday->delete($id)){
			$this->M_schedule->setStatusFromHolyday_post($data['id_product'], $data['id_division'], $data['date'], 1);
			$response = [
				'status' => true,
				'message' => 'Data libur berhasil dihapus',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Data libur gagal dihapus',
			];
		}

		echo json_encode($response);

	}

}

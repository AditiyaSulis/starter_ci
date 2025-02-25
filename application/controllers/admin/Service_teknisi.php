<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_teknisi extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_Service_teknisi');
		$this->load->model('m_Employees');
		$this->load->model('m_Schedule');
		$this->load->model('m_Products');
		$this->load->model('m_Division');

	}

	public function service_teknisi_page()
	{
		$this->_ONLYSELECTED([3]);
		$data = $this->_basicData();

		$data['title'] = 'Technician Service Record';
		$data['view_name'] = 'admin/service_teknisi';
		$data['breadcrumb'] = 'Technician Service Record';
		$data['menu'] = '';

		$id = $this->m_Employees->findByEmail_get($data['user']['email']);
		$data['products'] = $this->m_Products->findAll_get();
		$data['employee'] = $id['id_employee'];
		$data['total_service_teknisi'] = $this->m_Service_teknisi->totalServiceTeknisiByEmployeeId_get($id['id_employee']);
		$data['total_service_teknisi_this_month'] = $this->m_Service_teknisi->totalServiceTeknisiThisMonthByEmployeeId_get($id['id_employee']);

		$data['view_data'] = 'core/service_teknisi/data_service_teknisi';
		$data['view_components'] = 'core/service_teknisi/data_service_teknisi_components';

		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}

	public function su_service_teknisi_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Technician Service Record';
		$data['view_name'] = 'admin/data_service_teknisi';
		$data['breadcrumb'] = 'Data - Technician Service Record';
		$data['menu'] = '';

		$data['products'] = $this->m_Products->findAll_get();
		$data['employee'] = 'false';
		$data['employees'] = $this->m_Employees->findAllTechnician_get();

		$data['this_month'] = $this->m_Service_teknisi->totalServiceTeknisiThisMonth_get();
		$data['this_year'] = $this->m_Service_teknisi->totalServiceTeknisi_get();

		$data['view_data'] = 'core/service_teknisi/data_service_teknisi';
		$data['view_components'] = 'core/service_teknisi/data_service_teknisi_components';

		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}

	public function add_service_teknisi(){
		$this->_ONLYSELECTED([1,3]);
		$this->_isAjax();

		$this->form_validation->set_rules('pendapatan_service', 'pendapatan_service', 'required', [
			'required' => 'Pendapatan Service harus diisi',
		]);
		$this->form_validation->set_rules('tanggal_service', 'tanggal_service', 'required', [
			'required' => 'Tanggal service harus diisi',
		]);
		$this->form_validation->set_rules('description', 'description', 'required', [
			'required' => 'Deskripsi harus diisi',
		]);
		$this->form_validation->set_rules('type_service', 'type_service', 'required', [
			'required' => 'Jenis Service harus diisi',
		]);

		if ($this->form_validation->run() == FALSE) {
			$response = [
				'status' => false,
				'message' => validation_errors('<p>', '</p>'),
				'confirmationbutton' => true,
				'timer' => 0,
				'icon' => 'error',
			];
			echo json_encode($response);
			return;
		}


		$email = $this->input->post('id_employee');
		$emp = $this->m_Employees->findByEmail_get($email);

		$data = [
			'id_employee' => $emp['id_employee'],
			'input_at' => $this->input->post('input_at',true),
			'tanggal_service' => $this->input->post('tanggal_service',true),
			'type_service' => $this->input->post('type_service',true),
			'input_at' => date('Y-m-d'),
			'pendapatan_service' => $this->input->post('pendapatan_service',true),
			'description' => $this->input->post('description',true),
			'status' => 3,
		];

		$serviceRecord = $this->m_Service_teknisi->create_post($data);

		if ($serviceRecord) {
			$response = [
				'status' => true,
				'message' => 'Data service teknisi berhasil dibuat',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Data service teknisi ditambahkan',
			];
		}

		echo json_encode($response);
	}

	public function option_employee()
	{
		$idProduct = $this->input->post('id_product', true);

		if (empty($idProduct)) {
			$employees = $this->m_Employees->findAllTechnician_get();
		} else {
			$employees = $this->m_Employees->findByProductNTechnicianId_get($idProduct);
		}

		echo json_encode([
			'status' => !empty($employees),
			'data' => $employees
		]);
	}

	public function su_add_service_teknisi(){
		$this->_ONLY_SU();
		$this->_isAjax();

		$this->form_validation->set_rules('pendapatan_service', 'pendapatan_service', 'required', [
			'required' => 'Pendapatan Service harus diisi',
		]);
		$this->form_validation->set_rules('tanggal_service', 'tanggal_service', 'required', [
			'required' => 'Tanggal service harus diisi',
		]);
		$this->form_validation->set_rules('description', 'description', 'required', [
			'required' => 'Deskripsi harus diisi',
		]);
		$this->form_validation->set_rules('type_service', 'type_service', 'required', [
			'required' => 'Jenis Service harus diisi',
		]);
		$this->form_validation->set_rules('id_employee', 'id_employee', 'required', [
			'required' => 'Karyawan harus diisi',
		]);
		$this->form_validation->set_rules('total_service', 'total_service', 'required', [
			'required' => 'Upah Karyawan harus diisi',
		]);

		if ($this->form_validation->run() == FALSE) {
			$response = [
				'status' => false,
				'message' => validation_errors('<p>', '</p>'),
				'confirmationbutton' => true,
				'timer' => 0,
				'icon' => 'error',
			];
			echo json_encode($response);
			return;
		}

		if( $this->input->post('total_service',true) > $this->input->post('pendapatan_service',true) ) {
			$response = [
				'status' => false,
				'message' => 'Upah karyawan tidak boleh melebihi pendapatan',
			];

			echo json_encode($response);

			return;
		}

		$data = [
			'id_employee' => $this->input->post('id_employee'),
			'input_at' => $this->input->post('input_at',true),
			'tanggal_service' => $this->input->post('tanggal_service',true),
			'type_service' => $this->input->post('type_service',true),
			'pendapatan_service' => $this->input->post('pendapatan_service',true),
			'total_service' => $this->input->post('total_service',true),
			'description' => $this->input->post('description',true),
			'input_at' => date('Y-m-d'),
			'status' => 2,
		];

		$overtime = $this->m_Service_teknisi->create_post($data);

		if ($overtime) {
			$response = [
				'status' => true,
				'message' => 'Data Service teknisi berhasil dibuat',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Data Service teknisi gagal ditambahkan',
			];
		}

		echo json_encode($response);
	}

	public function set_status()
	{

		$this->_ONLY_SU();
		$this->_isAjax();

		$id = $this->input->post('id_service_teknisi', true);


		$this->form_validation->set_rules('status', 'status', 'required', [
			'required' => 'Status harus diisi',
		]);
		$this->form_validation->set_rules('total_service', 'total_service', 'required', [
			'required' => 'Status harus diisi',
		]);


		if ($this->form_validation->run() == false) {
			$response = [
				'status' => false,
				'message' => validation_errors('<p>', '</p>'),
				'confirmationbutton' => true,
				'timer' => 0,
				'icon' => 'error'
			];

			echo json_encode($response);

			return;
		}


		$setstatus = $this->input->post('status', true);
		$pay = $this->input->post('total_service', true);


		if ($this->m_Service_teknisi->setStatus_post($id, $setstatus,$pay)) {
			$response = [
				'status' => true,
				'message' => 'Status berhasil diperbarui.'
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Gagal memperbarui Status.'
			];
		}

		echo json_encode($response);


	}

	public function delete()
	{
		$this->_ONLY_SU();
		$this->_isAjax();

		$id = $this->input->post('id');

		if($this->m_Service_teknisi->delete($id)){
			$response = [
				'status' => true,
					'message' => 'Data service teknisi berhasil dihapus',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Data service teknisi gagal dihapus',
			];
		}

		echo json_encode($response);

	}

}

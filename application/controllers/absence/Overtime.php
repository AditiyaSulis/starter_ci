<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Overtime extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_Overtime');
		$this->load->model('M_employees');
		$this->load->model('m_Division');
		$this->load->model('M_products');
	}

	public function overtime_page()
	{
		$this->_ONLYSELECTED([3]);
		$data = $this->_basicData();

		$data['title'] = 'Overtime';
		$data['view_name'] = 'absence/overtime';
		$data['breadcrumb'] = 'Overtime';
		$data['menu'] = '';

		$id = $this->M_employees->findByEmail_get($data['user']['email']);
		$data['products'] = $this->M_products->findAll_get();
		$data['employee'] = $id['id_employee'];
		$data['view_data'] = 'core/overtime/data_overtime';
		$data['view_components'] = 'core/overtime/data_overtime_components';

		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}

	public function su_overtime_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Overtime';
		$data['view_name'] = 'absence/data/overtime';
		$data['breadcrumb'] = 'Overtime';
		$data['menu'] = '';


		$data['employee'] = 'false';

		$data['employees'] = $this->M_employees->findAll_get();
		$data['divisions'] = $this->m_Division->findAll_get();
		$data['products'] = $this->M_products->findAll_get();

		$data['this_month'] = $this->m_Overtime->totalOvertimeThisMonth_get();
		$data['this_year'] = $this->m_Overtime->totalOvertime_get();


		$data['view_data'] = 'core/overtime/data_overtime';
		$data['view_components'] = 'core/overtime/data_overtime_components';


		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}

	public function option_employee()
	{
		$idProduct = $this->input->post('id_product', true);
		$idDivision = $this->input->post('id_division', true);

		$employee = $this->M_employees->findByProductNDivisionId_get($idProduct, $idDivision);

		if(empty($employee)){
			echo json_encode([
				'status' => false,
				'message' =>  'Data tidak ditemukan'
			]);
			return false;
		}

		$response = [
			'status' => true,
			'data' => $employee
		];

		echo json_encode($response);

	}

	public function add_overtime()
	{
		$this->_ONLYSELECTED([3]);
		$this->_isAjax();

		$this->form_validation->set_rules('input_at', 'input_at', 'required', [
			'required' => 'Tanggal input harus diisi',
		]);
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required', [
			'required' => 'Tanggal lembur harus diisi',
		]);
		$this->form_validation->set_rules('time_spend', 'time_spend', 'required', [
			'required' => 'Total jam harus diisi',
		]);
		$this->form_validation->set_rules('start', 'start', 'required', [
			'required' => 'Mulai Lembur harus diisi',
		]);
		$this->form_validation->set_rules('end', 'end', 'required', [
			'required' => 'Selesai lembur harus diisi',
		]);
		$this->form_validation->set_rules('description', 'description', 'required', [
			'required' => 'Deskripsi harus diisi',
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
		$emp = $this->M_employees->findByEmail_get($email);

		$data = [
			'id_employee' => $emp['id_employee'],
			'input_at' => $this->input->post('input_at',true),
			'tanggal' => $this->input->post('tanggal',true),
			'time_spend' => $this->input->post('time_spend',true),
			'start' => $this->input->post('start',true),
			'end' => $this->input->post('end',true),
			'description' => $this->input->post('description',true),
			];


		$overtime = $this->m_Overtime->create_post($data);

		if ($overtime) {
			$response = [
				'status' => true,
				'message' => 'Data lembur berhasil dibuat',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Izin gagal ditambahkan',
			];
		}

		echo json_encode($response);
	}

	public function su_add_overtime()
	{
		$this->_ONLY_SU();
		$this->_isAjax();

		$this->form_validation->set_rules('input_at', 'input_at', 'required', [
			'required' => 'Tanggal input harus diisi',
		]);
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required', [
			'required' => 'Tanggal lembur harus diisi',
		]);
		$this->form_validation->set_rules('time_spend', 'time_spend', 'required', [
			'required' => 'Total jam harus diisi',
		]);
		$this->form_validation->set_rules('start', 'start', 'required', [
			'required' => 'Mulai Lembur harus diisi',
		]);
		$this->form_validation->set_rules('end', 'end', 'required', [
			'required' => 'Selesai lembur harus diisi',
		]);
		$this->form_validation->set_rules('description', 'description', 'required', [
			'required' => 'Deskripsi harus diisi',
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
		$emp = $this->M_employees->findById_get($email);

		$data = [
			'id_employee' => $emp['id_employee'],
			'input_at' => $this->input->post('input_at',true),
			'tanggal' => $this->input->post('tanggal',true),
			'time_spend' => $this->input->post('time_spend',true),
			'start' => $this->input->post('start',true),
			'end' => $this->input->post('end',true),
			'status' => 2,
			'description' => $this->input->post('description',true),
		];


		$overtime = $this->m_Overtime->create_post($data);

		if ($overtime) {
			$response = [
				'status' => true,
				'message' => 'Data lembur berhasil dibuat',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Izin gagal ditambahkan',
			];
		}

		echo json_encode($response);
	}

	public function set_status()
	{

		$this->_ONLY_SU();
		$this->_isAjax();

		$id = $this->input->post('id_overtime', true);


		$this->form_validation->set_rules('status', 'status', 'required', [
			'required' => 'Status harus diisi',
		]);
		$this->form_validation->set_rules('pay', 'pay', 'required', [
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
		$pay = $this->input->post('pay', true);


		if ($this->m_Overtime->setStatus_post($id, $setstatus,$pay)) {
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

	public function su_add_batch_overtime() 
	{
		$this->_ONLY_SU();
		$this->_isAjax();

		$this->form_validation->set_rules('input_at', 'input_at', 'required', ['required' => 'Tanggal input harus diisi']);
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required', ['required' => 'Tanggal lembur harus diisi']);
		$this->form_validation->set_rules('time_spend', 'time_spend', 'required', ['required' => 'Total jam harus diisi']);
		$this->form_validation->set_rules('start', 'start', 'required', ['required' => 'Mulai Lembur harus diisi']);
		$this->form_validation->set_rules('end', 'end', 'required', ['required' => 'Selesai lembur harus diisi']);
		$this->form_validation->set_rules('description', 'description', 'required', ['required' => 'Deskripsi harus diisi']);
		$this->form_validation->set_rules('pay', 'pay', 'required', ['required' => 'Upah harus diisi']);

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


		$employees = $this->input->post('id_employee', true);

		if (empty($employees)) {
			echo json_encode([
				'status' => false,
				'message' => 'Harap pilih minimal satu karyawan',
			]);
			return;
		}


		$dataBatch = [];
		foreach ($employees as $employeeId) {
			$dataBatch[] = [
				'id_employee' => $employeeId,
				'input_at' => $this->input->post('input_at', true),
				'tanggal' => $this->input->post('tanggal', true),
				'time_spend' => $this->input->post('time_spend', true),
				'start' => $this->input->post('start', true),
				'end' => $this->input->post('end', true),
				'pay' => $this->input->post('pay', true),
				'status' => 2,
				'description' => $this->input->post('description', true),
			];
		}

		$insert = $this->m_Overtime->create_batch_post($dataBatch);

		if ($insert) {
			echo json_encode([
				'status' => true,
				'message' => 'Data lembur berhasil dibuat untuk ' . count($dataBatch) . ' karyawan.',
			]);
		} else {
			echo json_encode([
				'status' => false,
				'message' => 'Gagal menambahkan data lembur.',
			]);
		}
	}

	public function delete()
	{
		$this->_ONLY_SU();
		$this->_isAjax();

		$id = $this->input->post('id');


		if($this->m_Overtime->delete($id)){
			$response = [
				'status' => true,
				'message' => 'Data lembur karyawan berhasil dihapus',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Data lembur karyawan gagal dihapus',
			];
		}

		echo json_encode($response);

	}



}

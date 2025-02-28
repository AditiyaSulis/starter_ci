<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DayOff extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_Day_off');
		$this->load->model('M_employees');
		$this->load->model('m_Schedule');
		$this->load->model('m_Products');

	}

	public function day_off_page()
	{
		$this->_ONLYSELECTED([3]);
		$data = $this->_basicData();

		$data['title'] = 'Day Off';
		$data['view_name'] = 'absence/day_off';
		$data['breadcrumb'] = 'Day Off';
		$data['menu'] = '';

		$id = $this->M_employees->findByEmail_get($data['user']['email']);
		$data['products'] = $this->m_Products->findAll_get();
		$data['employee'] = $id['id_employee'];
		$data['total_dayoff'] = $this->m_Day_off->totalDayOffByEmployeeId_get($id['id_employee']);
		$data['total_dayoff_this_month'] = $this->m_Day_off->totalDayOffThisMonthByEmployeeId_get($id['id_employee']);

		$data['view_data'] = 'core/dayoff/data_day_off';
		$data['view_components'] = 'core/dayoff/data_day_off_components';

		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}

	public function su_day_off_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Data Day Off';
		$data['view_name'] = 'absence/data/day_off';
		$data['breadcrumb'] = 'Data - Day Off';
		$data['menu'] = 'Data';

		$data['products'] = $this->m_Products->findAll_get();
		$data['employee'] = 'false';
		$data['employees'] = $this->M_employees->findAll_get();

		$data['this_month'] = $this->m_Day_off->totalDayOffThisMonth_get();
		$data['this_year'] = $this->m_Day_off->totalDayOff_get();

		$data['view_data'] = 'core/dayoff/data_day_off';
		$data['view_components'] = 'core/dayoff/data_day_off_components';

		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}

	public function add_day_off(){
		$this->_ONLYSELECTED([1,3]);
		$this->_isAjax();

		$this->form_validation->set_rules('input_at', 'input_at', 'required', [
			'required' => 'Tanggal input harus diisi',
		]);
		$this->form_validation->set_rules('tgl_day_off', 'tgl_day_off', 'required', [
			'required' => 'Tanggal lembur harus diisi',
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
			'tgl_day_off' => $this->input->post('tgl_day_off',true),
			'description' => $this->input->post('description',true),
		];

		$overtime = $this->m_Day_off->create_post($data);

		if ($overtime) {
			$response = [
				'status' => true,
				'message' => 'Data libur berhasil dibuat',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Izin libur  ditambahkan',
			];
		}

		echo json_encode($response);
	}

	public function su_add_day_off(){
		$this->_ONLY_SU();
		$this->_isAjax();

		$this->form_validation->set_rules('input_at', 'input_at', 'required', [
			'required' => 'Tanggal input harus diisi',
		]);
		$this->form_validation->set_rules('tgl_day_off', 'tgl_day_off', 'required', [
			'required' => 'Tanggal lembur harus diisi',
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
			'tgl_day_off' => $this->input->post('tgl_day_off',true),
			'description' => $this->input->post('description',true),
			'status' => 2,
		];

		$overtime = $this->m_Day_off->create_post($data);

		if ($overtime) {
			$this->m_Schedule->setStatus_post($emp['id_employee'], $this->input->post('tgl_day_off',true), 2);
			$response = [
				'status' => true,
				'message' => 'Data libur berhasil dibuat',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Data libur gagal ditambahkan',
			];
		}

		echo json_encode($response);
	}

	public function set_status()
	{

		$this->_ONLY_SU();
		$this->_isAjax();

		$id = $this->input->post('id_day_off', true);
		$idEmployee = $this->input->post('id_employee', true);
		$tanggal = $this->input->post('tgl_day_off', true);


		$this->form_validation->set_rules('status', 'status', 'required', [
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

		if($setstatus == 2) {
			$setStatus1 = $this->m_Schedule->setStatus_post($idEmployee, $tanggal, 2);
		} else {
			$setStatus1 = $this->m_Schedule->setStatus_post($idEmployee, $tanggal, 1);
		}

		if ($this->m_Day_off->setStatus_post($id, $setstatus)) {
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
		$data = $this->m_Day_off->findById_get($id);

		if($this->m_Day_off->delete($id)){
			$this->m_Schedule->setStatus_post($data['id_employee'], $data['tgl_day_off'], 1);
			$response = [
				'status' => true,
				'message' => 'Data Libur karyawan berhasil dihapus',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Data Libur karyawan gagal dihapus',
			];
		}

		echo json_encode($response);

	}

}

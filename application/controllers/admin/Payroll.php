<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_Overtime');
		$this->load->model('m_Employees');
		$this->load->model('m_Division');
		$this->load->model('m_Products');
	}

	public function payroll_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Payroll';
		$data['view_name'] = 'admin/payroll';
		$data['breadcrumb'] = 'Payroll';
		$data['menu'] = '';

		$data['products'] = $this->m_Products->findAll_get();
		$data['divisions'] = $this->m_Division->findAll_get();

		$data['view_data'] = 'core/payroll/data_payroll';
		$data['view_components'] = 'core/payroll/data_payroll_component';
		$data['view_pc'] = 'core/payroll_component/data_payroll_component';
		$data['view_pc_component'] = 'core/payroll_component/data_payroll_component_components';

		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}


	public function detail()
	{
		$idProduct = $this->input->post('id_product', true);
		$idDivision = $this->input->post('id_division', true);

		$employee = $this->m_Employees->findByProductNDivisionId_get($idProduct, $idDivision);

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

	public function add_payroll()
	{
		$this->_ONLYSELECTED([3]);
		$this->_isAjax();

		$this->form_validation->set_rules('input_at', 'input_at', 'required', [
			'required' => 'Tanggal input harus diisi',
		]);
		$this->form_validation->set_rules('tanggal_gajian', 'tanggal_gajian', 'required', [
			'required' => 'Tanggal gajianlembur harus diisi',
		]);
		$this->form_validation->set_rules('id_product', 'id_product', 'required', [
			'required' => 'Product harus diisi',
		]);
		$this->form_validation->set_rules('id_division', 'id_division', 'required', [
			'required' => 'Division harus diisi',
		]);
//		$this->form_validation->set_rules('id_employee', 'id_employee', 'required', [
//			'required' => 'Karyawan harus diisi',
//		]);
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
		$emp = $this->m_Employees->findByEmail_get($email);

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

	public function add_batch_payroll()
	{
		$this->_ONLY_SU();
		$this->_isAjax();

		$this->form_validation->set_rules('input_at', 'input_at', 'required', [
			'required' => 'Tanggal input harus diisi',
		]);
		$this->form_validation->set_rules('tanggal_gajian', 'tanggal_gajian', 'required', [
			'required' => 'Tanggal gajianlembur harus diisi',
		]);
		$this->form_validation->set_rules('id_product', 'id_product', 'required', [
			'required' => 'Product harus diisi',
		]);
		$this->form_validation->set_rules('id_division', 'id_division', 'required', [
			'required' => 'Division harus diisi',
		]);
		$this->form_validation->set_rules('description', 'description', 'required', [
			'required' => 'Deskripsi harus diisi',
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


		$employees = $this->input->post('id_employee', true);

		if (empty($employees)) {
			echo json_encode([
				'status' => false,
				'message' => 'Harap pilih minimal satu karyawan',
			]);
			return;
		}

		$dataPayroll = [
			'code_payroll' => $this->input->post('code_payroll', true),
			'input_at' => $this->input->post('input_at', true),
		];

		$idPayroll = $this->m_Payroll->create_post($dataPayroll);
		if(!$idPayroll) {
			echo json_encode([
				'status' => false,
				'message' => 'Gagal membuat payroll.',
			]);
		}

		$dataBatch = [];
		foreach ($employees as $employeeId) {
			$totalCuti =$this->m_Leave->totalLeaveLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true));
			$totalIzin =$this->m_Izin->totalIzinLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true));
			$totalDayoff =$this->m_Day_off->totalDayOffLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true));
			$totalOvertime =$this->m_Overtime->totalOvertimeLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true));
			$totalAbsent =$this->m_Schedule->totalAbsentLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true));
			$employee = $this->m_Employees->findById_get($employeeId);

			$potIzin=(round($employee['uang_makan']) / 27) * $totalIzin;

			$potAbsen = (round($employee['basic_salary']) / 27) * $totalAbsent;

			$totalGaji = $employee['basic_salary'] + $potIzin  + $this->input->post('bonus', true) - $potAbsen;
			///menghitung piutang, dll


			$dataBatch[] = [
				'id_employee' => $employeeId,
				'id_payroll' => $idPayroll,
				'bonus' => $this->input->post('bonus', true),
				'tanggal_gajian' => $this->input->post('tanggal_gajian', true),
				'description' => $this->input->post('description', true),
				'total_izin' => $totalIzin,
				'total_cuti' =>$totalCuti,
				'total_overtime' => $totalOvertime,
				'total_dayoff' => $totalDayoff,
				'total' => $this->input->post('total', true),
			];
		}

		$insert = $this->m_Payroll->create_batch_post($dataBatch);

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


		if($this->m_Payroll->delete($id)){
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

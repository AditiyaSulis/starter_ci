<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uang_makan extends MY_Controller{

	function __construct()
	{
		parent::__construct();

		$this->load->model('M_batch_uang_makan');
		$this->load->model('M_uang_makan');
		$this->load->model('M_employees');
		$this->load->model('M_division');
		$this->load->model('M_products');
		$this->load->model('M_leave');
		$this->load->model('M_izin');
		$this->load->model('M_schedule');
		$this->load->model('M_finance_records');
		$this->load->model('M_holyday');
		$this->load->model('M_attendance');
	}


	public function batch_uang_makan_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Batch Uang Makan';
		$data['view_name'] = 'admin/batch_uang_makan';
		$data['breadcrumb'] = 'Payroll';
		$data['menu'] = '';

		$data['products'] = $this->M_products->findAll_get();
		$data['divisions'] = $this->M_division->findAll_get();

		$data['view_data'] = 'core/batch_uang_makan/data_batch_uang_makan';
		$data['view_components'] = 'core/batch_uang_makan/data_batch_uang_makan_components';

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


	public function add_batch_uang_makan()
	{
		$this->_ONLYSELECTED([1,2]);
		$this->_isAjax();

		$this->form_validation->set_rules('code_batch_uang_makan', 'code_batch_uang_makan', 'trim|required|is_unique[batch_uang_makan.code_batch_uang_makan]',[
			'is_unique' => 'Kode sudah digunakan'
		]);
		$this->form_validation->set_rules('tanggal_batch_uang_makan', 'tanggal_batch_uang_makan', 'required', [
			'required' => 'Tanggal input harus diisi',
		]);
		$this->form_validation->set_rules('auto_finance_record', 'auto_finance_record', 'required', [
			'required' => 'Include Finance Record harus diisi',
		]);
		$this->form_validation->set_rules('include_holiday', 'include_holiday', 'required', [
			'required' => 'Include Holiday harus diisi',
		]);
		$this->form_validation->set_rules('include_leave', 'include_leave', 'required', [
			'required' => 'Include Cuti harus diisi',
		]);
		$this->form_validation->set_rules('include_absen', 'include_absen', 'required', [
			'required' => 'Include Absen harus diisi',
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

		$this->db->trans_start();

		$dataPayroll = [
			'code_batch_uang_makan' => $this->input->post('code_batch_uang_makan', true),
			'tanggal_batch_uang_makan' => $this->input->post('tanggal_batch_uang_makan', true),
			'auto_finance_record' => $this->input->post('auto_finance_record', true),
			'include_holiday' => $this->input->post('include_holiday', true),
			'include_leave' => $this->input->post('include_leave', true),
			'include_absen' => $this->input->post('include_absen', true),
		];

		$idBatchUangMakan = $this->M_batch_uang_makan->create_post($dataPayroll);

		if (!$idBatchUangMakan) {
			$this->db->trans_rollback();
			echo json_encode([
				'status' => false,
				'message' => 'Gagal membuat batch uang makan.',
			]);
			return;
		}

		//		$dataBatch = [];
		$dataFinanceRecord = [];

		foreach ($employees as $employeeId) {


			$potAbsen = 0;
			$potIzin = 0;
			$potHoliday = 0;
			$potCuti = 0;

			$totalHolyday = 0;
			$totalCuti = 0;
			$totalAbsen = 0;
			$totalIzin = 0;

			$potPerDay = 0;
			//mengambil total izin, cuti, absen,dan hari libur nasional
			$employee = $this->M_employees->findByIdJoin_get($employeeId);
			if($employee['type_uang_makan'] == 2) {
				$potPerDay = $employee['uang_makan'] / 6;
				$totalIzin = $this->M_schedule->totalScheduleByStatusForUangMakan_get($employeeId, 'minggu', $this->input->post('tanggal_batch_uang_makan', true), 5 );
				if($this->input->post('include_holiday',true) == 1) {
					$totalHolyday = $this->M_schedule->totalScheduleByStatusForUangMakan_get($employeeId, 'minggu', $this->input->post('tanggal_batch_uang_makan', true), 3 );
				}
				if($this->input->post('include_leave',true) == 1) {
					$totalCuti = $this->M_schedule->totalScheduleByStatusForUangMakan_get($employeeId, 'minggu', $this->input->post('tanggal_batch_uang_makan', true), 4 );
				}
				if($this->input->post('include_absen',true) == 1) {
					$totalAbsen = $this->M_schedule->totalScheduleByStatusForUangMakan_get($employeeId, 'minggu', $this->input->post('tanggal_batch_uang_makan', true), 7 );;
				}
			} else if ($employee['type_uang_makan'] == 3) {
				$potPerDay = $employee['uang_makan'] / 24;
				$totalIzin = $this->M_schedule->totalScheduleByStatusForUangMakan_get($employeeId, 'bulan', $this->input->post('tanggal_batch_uang_makan', true), 5 );
				if($this->input->post('include_holiday',true) == 1) {
					$totalHolyday = $this->M_schedule->totalScheduleByStatusForUangMakan_get($employeeId, 'bulan', $this->input->post('tanggal_batch_uang_makan', true), 3 );
				}
				if($this->input->post('include_leave',true) == 1) {
					$totalCuti = $this->M_schedule->totalScheduleByStatusForUangMakan_get($employeeId, 'bulan', $this->input->post('tanggal_batch_uang_makan', true), 4 );
				}
				if($this->input->post('include_absen',true) == 1) {
					$totalAbsen = $this->M_schedule->totalScheduleByStatusForUangMakan_get($employeeId, 'bulan', $this->input->post('tanggal_batch_uang_makan', true), 7 );;
				}
			}



			$potIzin = $potPerDay * $totalIzin;
			$potAbsen = $potPerDay * $totalAbsen;
			$potCuti = $potPerDay * $totalCuti;
			$potHoliday = $potPerDay * $totalHolyday;
			$totalPotUangMakan = $potIzin + $potAbsen + $potCuti + $potHoliday;
			$uang_makan_bersih = $employee['uang_makan'] - $totalPotUangMakan;


			//Finance record Insert
			if ($this->input->post('auto_finance_record') == 1) {
				$dataFinanceRecord[] = [
					'record_date' => $this->input->post('tanggal_batch_uang_makan', true),
					'product_id' => $employee['id_product'],
					'amount' => $uang_makan_bersih,
					'id_code' => 22,
					'description' => $this->input->post('code_batch_uang_makan', true),
				];
			}


			$dataBatch = [
				'id_employee' => $employeeId,
				'id_batch_uang_makan' => $idBatchUangMakan,
				'total_izin' => $totalIzin,
				'total_holiday' => $totalHolyday,
				'total_cuti' =>$totalCuti,
				'pot_izin' => $potIzin,
				'pot_cuti' => $potCuti,
				'pot_holiday' => $potHoliday,
				'total_absen' => $totalAbsen,
				'pot_absen' => $potAbsen,
				'total_pot_uang_makan' => $totalPotUangMakan,
				'total_uang_makan' => $uang_makan_bersih,
				'input_at' => $this->input->post('tanggal_batch_uang_makan', true),
			];

			$insertPayroll = $this->M_uang_makan->create_post($dataBatch);

			if (!$insertPayroll) {
				$this->db->trans_rollback();
				echo json_encode([
					'status' => false,
					'message' => 'Gagal menambahkan payroll.',
				]);
				return;
			}

		}




		if (!empty($dataFinanceRecord)) {
			$insertFinanceRecord = $this->M_finance_records->create_batch_post($dataFinanceRecord);
			if (!$insertFinanceRecord) {
				$this->db->trans_rollback();
				echo json_encode([
					'status' => false,
					'message' => 'Gagal menambahkan data finance record.',
				]);
				return;
			}
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo json_encode([
				'status' => false,
				'message' => 'Gagal membuat batch uang makan.',
			]);
		} else {
			echo json_encode([
				'status' => true,
				'message' => 'Batch uang makan berhasil dibuat',
			]);
		}
	}


	public function detail()
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


		$overtime = $this->M_overtime->create_post($data);

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


	public function delete()
	{
		$this->_ONLYSELECTED([1,2]);
		$this->_isAjax();

		$id = $this->input->post('id');


		if($this->M_payroll->delete($id)){
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


	public function detail_uang_makan(){
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Uang Makan';
		$data['view_name'] = 'admin/uang_makan';
		$data['breadcrumb'] = 'Detail Uang Makan';
		$data['menu'] = '';

		$data['products'] = $this->M_products->findAll_get();
		$data['divisions'] = $this->M_division->findAll_get();

		$data['view_data'] = 'core/uang_makan/data_uang_makan';
		//$data['view_components'] = 'core/uang_makan/data_uang_makan_components';


		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}


}




<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_Overtime');
		$this->load->model('m_Payroll');
		$this->load->model('m_Payroll_component');
		$this->load->model('M_employees');
		$this->load->model('m_Division');
		$this->load->model('M_products');
		$this->load->model('m_Leave');
		$this->load->model('m_Izin');
		$this->load->model('m_Day_off');
		$this->load->model('M_schedule');
		$this->load->model('M_finance_records');
		$this->load->model('m_Service_teknisi');
		$this->load->model('m_Piutang');
		$this->load->model('m_Purchase_piutang');
		$this->load->model('m_Holyday');
	}


	public function payroll_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Payroll';
		$data['view_name'] = 'admin/payroll';
		$data['breadcrumb'] = 'Payroll';
		$data['menu'] = '';

		$data['products'] = $this->M_products->findAll_get();
		$data['divisions'] = $this->m_Division->findAll_get();

		$data['view_data'] = 'core/payroll/data_payroll';
		$data['view_components'] = 'core/payroll/data_payroll_component';

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


	public function add_batch_payroll()
	{
		$this->_ONLY_SU();
		$this->_isAjax();

		$this->form_validation->set_rules('input_at', 'input_at', 'required', [
			'required' => 'Tanggal input harus diisi',
		]);
		$this->form_validation->set_rules('tanggal_gajian', 'tanggal_gajian', 'required', [
			'required' => 'Tanggal gajian harus diisi',
		]);
		$this->form_validation->set_rules('periode_gajian', 'periode_mulai', 'required', [
			'required' => 'Periode mulai gajian harus diisi',
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
		$this->form_validation->set_rules('holyday', 'holyday', 'required', [
			'required' => 'holyday harus diisi',
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
			'code_payroll' => $this->input->post('code_payroll', true),
			'input_at' => $this->input->post('input_at', true),
			'include_piutang' => $this->input->post('piutang', true),
			'include_finance_record' => $this->input->post('finance_record', true),
			'include_holiday' => $this->input->post('holyday', true),
		];
		$idPayroll = $this->m_Payroll->create_post($dataPayroll);

		if (!$idPayroll) {
			$this->db->trans_rollback();
			echo json_encode([
				'status' => false,
				'message' => 'Gagal membuat payroll.',
			]);
			return;
		}

		$dataBatch = [];
		$dataFinanceRecord = [];

		foreach ($employees as $employeeId) {

			$potPiutang = 0;
			$totalPotHolyday = 0;

			$totalCuti = $this->m_Leave->totalLeaveLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true));
			$totalIzin = $this->m_Izin->totalIzinLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true));
			$totalDayoff = $this->m_Day_off->totalDayOffLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true));
			$totalOvertime = $this->m_Overtime->totalOvertimeLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true));
			$totalAbsent = $this->M_schedule->totalAbsentLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true));
			$totalHolyday = $this->m_Holyday->totalHolydayLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true));
			$employee = $this->M_employees->findByIdJoin_get($employeeId);
			
			$izinPerhari = round($employee['uang_makan'] / 24);
			$absenPerhari = round($employee['basic_salary'] / 27);
			$totalPotAbsen = $absenPerhari * $totalAbsent;
			$totalPotIzin = $izinPerhari * $totalIzin;

			if($this->input->post('holyday', true) == 1) {
				$totalPotHolyday = $izinPerhari * $totalHolyday;
			}


			if ($this->input->post('piutang', true) == 1) {
				$thisMonth = date('m' , strtotime($this->input->post('tanggal_gajian', true)));
				$thisYear = date('Y', strtotime($this->input->post('tanggal_gajian', true)));

				$piutang = $this->m_Piutang->findPiutangThisMonthByEmployeeId_get($employeeId, $thisMonth, $thisYear);
				if ($piutang) {
					$changeStatus = $piutang['remaining_piutang'] - $piutang['angsuran'];

					if($changeStatus == 0 || $changeStatus < 1 ) {
						$this->m_Piutang->setStatus_post($piutang['id_piutang'], 1);
					}
					$this->m_Piutang->updateRemaining_post($piutang['id_piutang'], $changeStatus);

					$dataPiutang = [
						'id_piutang' => $piutang['id_piutang'],
						'pay_date' =>$this->input->post('tanggal_gajian', true),
						'pay_amount' => $piutang['angsuran'],
						//						'include_piutang' => $this->input->post('piutang', true),
						//						'include_finance_record' => $this->input->post('finance_record', true),
						//						'include_holiday' => $this->input->post('holyday', true),
						'description' => $this->input->post('tanggal_gajian', true) . "-" . $this->input->post('description', true) . "-" . $this->input->post('code_payroll', true),
					];

					$piutang_payment = $this->m_Purchase_piutang->create_post($dataPiutang);

					$potPiutang = $piutang['angsuran'];
				}
			}

			$totalPotongan = $totalPotAbsen + $totalPotIzin + $potPiutang + $totalPotHolyday;

			// Fitur Teknisi gaji
			//if ($employee['code_division'] == 'TKS') {
			//	$totalPendapatan = $this->m_Service_teknisi->totalServicePay_get($employeeId, $this->input->post('tanggal_gajian', true));
			// 	$totalGaji = $totalPendapatan + $employee['uang_makan']+ $employee['bonus'] + $totalOvertime - $totalPotongan;
			//} else {
			//	$totalGaji = $employee['basic_salary'] + $employee['uang_makan'] + $employee['bonus'] + $totalOvertime - $totalPotongan;
			//}

			//hapus ini jika mengaktifkan gaji teknisi
			$totalGaji = $employee['basic_salary'] + $employee['uang_makan'] + $employee['bonus'] + $totalOvertime - $totalPotongan;

			if ($this->input->post('finance_record') == 1) {
				$dataFinanceRecord[] = [
					'record_date' => $this->input->post('tanggal_gajian', true),
					'product_id' => $employee['id_product'],
					'amount' => $totalGaji,
					'id_code' => 22,
					'description' => $this->input->post('tanggal_gajian', true) . "-" . $this->input->post('description', true) . "-" . $this->input->post('code_payroll', true),
				];
			}


			$dataBatch[] = [
				'id_employee' => $employeeId,
				'id_payroll' => $idPayroll,
				'bonus' => $employee['bonus'],
				'tanggal_gajian' => $this->input->post('tanggal_gajian', true),
				'periode_gajian' =>$this->input->post('periode_gajian', true),
				'description' => $this->input->post('description', true),
				'total_izin' => $totalIzin,
				'total_cuti' => $totalCuti,
				'total_absen' => $totalAbsent,
				'total_overtime' => $totalOvertime,
				'total_dayoff' => $totalDayoff,
				'total_libur_nasional' => $totalHolyday,
				'piutang' => $potPiutang,
				'total' => $totalGaji,
				'potongan_libur_nasional' => $totalPotHolyday,
				'potongan_absen' => $totalPotAbsen,
				'potongan_izin' => $totalPotIzin,
				'absen_hari' => $absenPerhari,
				'izin_hari' => $izinPerhari,
				'libur_nasional_hari' => $izinPerhari,
				'total_potongan' => $totalPotongan,
			];
		}

		$insertPayroll = $this->m_Payroll_component->create_batch_post($dataBatch);

		if (!$insertPayroll) {
			$this->db->trans_rollback();
			echo json_encode([
				'status' => false,
				'message' => 'Gagal menambahkan payroll.',
			]);
			return;
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
				'message' => 'Gagal menambahkan payroll.',
			]);
		} else {
			echo json_encode([
				'status' => true,
				'message' => 'Payroll berhasil dibuat untuk ' . count($dataBatch) . ' karyawan.',
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


	public function detail_payroll(){
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Payroll';
		$data['view_name'] = 'admin/detail_payroll';
		$data['breadcrumb'] = 'Detail Payroll';
		$data['menu'] = '';

		$data['products'] = $this->M_products->findAll_get();
		$data['divisions'] = $this->m_Division->findAll_get();

		$data['view_data'] = 'core/payroll_component/data_payroll_component';
		$data['view_components'] = 'core/payroll_component/data_payroll_component_components';


		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}


}


//public function add_batch_payroll()
	//{
	//	$this->_ONLY_SU();
	//	$this->_isAjax();
	//
	//	$this->form_validation->set_rules('input_at', 'input_at', 'required', [
	//		'required' => 'Tanggal input harus diisi',
	//	]);
	//	$this->form_validation->set_rules('tanggal_gajian', 'tanggal_gajian', 'required', [
	//		'required' => 'Tanggal gajian harus diisi',
	//	]);
	//	$this->form_validation->set_rules('id_product', 'id_product', 'required', [
	//		'required' => 'Product harus diisi',
	//	]);
	//	$this->form_validation->set_rules('id_division', 'id_division', 'required', [
	//		'required' => 'Division harus diisi',
	//	]);
	//	$this->form_validation->set_rules('description', 'description', 'required', [
	//		'required' => 'Deskripsi harus diisi',
	//	]);
	//
	//	if ($this->form_validation->run() == FALSE) {
	//		echo json_encode([
	//			'status' => false,
	//			'message' => validation_errors('<p>', '</p>'),
	//			'confirmationbutton' => true,
	//			'timer' => 0,
	//			'icon' => 'error',
	//		]);
	//		return;
	//	}
	//
	//
	//	$employees = $this->input->post('id_employee', true);
	//
	//	if (empty($employees)) {
	//		echo json_encode([
	//			'status' => false,
	//			'message' => 'Harap pilih minimal satu karyawan',
	//		]);
	//		return;
	//	}
	//
	//	$dataPayroll = [
	//		'code_payroll' => $this->input->post('code_payroll', true),
	//		'input_at' => $this->input->post('input_at', true),
	//	];
	//
	//	$idPayroll = $this->m_Payroll->create_post($dataPayroll);
	//	if(!$idPayroll) {
	//		echo json_encode([
	//			'status' => false,
	//			'message' => 'Gagal membuat payroll.',
	//		]);
	//
	//		return;
	//	}
	//
	//	$dataBatch = [];
	//	foreach ($employees as $employeeId) {
	//
	//		$totalGaji = 0;
	//
	//		$totalCuti =$this->m_Leave->totalLeaveLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true));
	//		$totalIzin =$this->m_Izin->totalIzinLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true));
	//		$totalDayoff =$this->m_Day_off->totalDayOffLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true));
	//		$totalOvertime =$this->m_Overtime->totalOvertimeLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true));
	//		$totalAbsent =$this->M_schedule->totalAbsentLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true));
	//		$employee = $this->M_employees->findById_get($employeeId);
	//
	//		$potIzin=(round($employee['uang_makan']) / 26) * $totalIzin;
	//
	//		if($employee['code_division'] == 'TKS' )  {
	//			$totalPendapatan = $this->m_Service_teknisi->totalServicePay_get($employeeId, $this->input->post('tanggal_gajian', true));
	//			$totalGaji = $totalPendapatan + $potIzin  + $employee['bonus'] + $totalOvertime;
	//		} else {
	//			$potAbsen = (round($employee['basic_salary']) / 27) * $totalAbsent;
	//			$totalGaji = $employee['basic_salary'] + $potIzin  + $employee['bonus'] + $totalOvertime - $potAbsen;
	//		}
	//
	//		if($this->input->post('finance_record') == 1 ) {
	//			$dataFinanceRecord[] = [
	//				'record_date' => $this->input->post('tanggal_gajian', true),
	//				'product_id' => $employee['id_product'],
	//				'amount' => $totalGaji,
	//				'id_code' => 22,
	//				'description' => $this->input->post('tanggal_gajian', true)."-".$this->input->post('description', true)."-".$this->input->post('code_payroll', true),
	//			];
	//
	//			//	$record = $this->M_finance_records->create_post($dataFinanceRecord);
	//		}
	//
	//		$dataBatch[] = [
	//			'id_employee' => $employeeId,
	//			'id_payroll' => $idPayroll,
	//			'bonus' =>  $employee['bonus'],
	//			'tanggal_gajian' => $this->input->post('tanggal_gajian', true),
	//			'description' => $this->input->post('description', true),
	//			'total_izin' => $totalIzin,
	//			'total_cuti' =>$totalCuti,
	//			'total_absen' => $totalAbsent,
	//			'total_overtime' => $totalOvertime,
	//			'total_dayoff' => $totalDayoff,
	//			'total' => $totalGaji,
	//		];
	//	}
	//
	//	$insert = $this->m_Payroll->create_batch_post($dataBatch);
	//
	//
	//	if ($insert) {
	//		$insertFinanceRecord = $this->m_Finance_record->create_batch_post($dataFinanceRecord);
	//		echo json_encode([
	//			'status' => true,
	//			'message' => 'Payroll berhasil dibuat untuk ' . count($dataBatch) . ' karyawan.',
	//		]);
	//	} else {
	//		echo json_encode([
	//			'status' => false,
	//			'message' => 'Gagal menambahkan payroll.',
	//		]);
	//	}
//}

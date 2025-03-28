<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_overtime');
		$this->load->model('M_payroll');
		$this->load->model('M_payroll_component');
		$this->load->model('M_employees');
		$this->load->model('M_division');
		$this->load->model('M_products');
		$this->load->model('M_leave');
		$this->load->model('M_izin');
		$this->load->model('M_day_off');
		$this->load->model('M_schedule');
		$this->load->model('M_finance_records');
		$this->load->model('M_service_teknisi');
		$this->load->model('M_piutang');
		$this->load->model('M_purchase_piutang');
		$this->load->model('M_holyday');
		$this->load->model('M_attendance');
		$this->load->model('M_pph_config');
		$this->load->model('M_bpjs_config');
		$this->load->model('M_tax_config');
		$this->load->model('M_pkp');
		$this->load->model('M_ptkp');
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
		$data['divisions'] = $this->M_division->findAll_get();

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
		$this->_ONLYSELECTED([1,2]);
		$this->_isAjax();

		$this->form_validation->set_rules('code_payroll', 'code_payroll', 'required', [
			'required' => 'Code payroll harus diisi',
		]);
		$this->form_validation->set_rules('input_at', 'input_at', 'required', [
			'required' => 'Tanggal input harus diisi',
		]);
		$this->form_validation->set_rules('tanggal_gajian', 'tanggal_gajian', 'required', [
			'required' => 'Tanggal gajian harus diisi',
		]);
		$this->form_validation->set_rules('periode_gajian', 'periode_gajian', 'required', [
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
		$this->form_validation->set_rules('include_potongan_telat', 'include_potongan_telat', 'required', [
			'required' => 'Opsi Potongan telat harus diisi',
		]);
		$this->form_validation->set_rules('include_pph', 'include_pph', 'required', [
			'required' => 'Opsi Potongan PPH 21 harus diisi',
		]);
		$this->form_validation->set_rules('include_bpjs', 'include_bpjs', 'required', [
			'required' => 'Opsi Potongan BPJS harus diisi',
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
			'include_uang_makan' => $this->input->post('include_uang_makan', true) == 1 ? 1 : 0,
			'include_finance_record' => $this->input->post('finance_record', true),
			'include_potongan_telat' => $this->input->post('include_potongan_telat', true),
			'include_bpjs' => $this->input->post('include_bpjs', true),
			'include_pph' => $this->input->post('include_pph', true),
		];

		$idPayroll = $this->M_payroll->create_post($dataPayroll);

		if (!$idPayroll) {
			$this->db->trans_rollback();
			echo json_encode([
				'status' => false,
				'message' => 'Gagal membuat payroll.',
			]);
			return;
		}

		//		$dataBatch = [];
		$dataTax = [];
		$dataFinanceRecord = [];
		$dataFinanceRecordTax = [];

		foreach ($employees as $employeeId) {

			$potPiutang = 0;
			$jht = 0;
			$jp = 0;
			$totalPotPph = 0;
			$bruto = 0;
			$pkp = 0;
			$biaya_jabatan = 0;
			$netto = 0;
			$pot_ptkp = 0;
			$pph_akumulatif = 0;
			$pengurangan_pajak = 0;
			$uang_makan = 0;
			$bonus = $this->input->post('bonus');


			//V2

			$totalDayoff = $this->M_schedule->totalScheduleByStatusV2_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true), 2);
			$totalAbsent = $this->M_schedule->totalScheduleByStatusV2_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true), 7);
			$totalOvertime = $this->M_overtime->totalOvertimeLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true));
			$totalTelat = 0;
			$employee = $this->M_employees->findByIdJoin_get($employeeId);


			$absenPerhari = round($employee['basic_salary'] / 27);
			$totalPotAbsen = $absenPerhari * $totalAbsent;



			if($this->input->post('include_uang_makan',true) == 1) {
				$uang_makan = $employee['uang_makan'];
			}

			if($this->input->post('include_potongan_telat', true) == 1) {
				$totalTelat = $this->M_attendance->totalTelatLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true));
			}

			if ($this->input->post('piutang', true) == 1) {
				$thisMonth = date('m' , strtotime($this->input->post('tanggal_gajian', true)));
				$thisYear = date('Y', strtotime($this->input->post('tanggal_gajian', true)));

				$piutang = $this->M_piutang->findPiutangThisMonthByEmployeeId_get($employeeId, $thisMonth, $thisYear);
				if ($piutang) {
					$changeStatus = $piutang['remaining_piutang'] - $piutang['angsuran'];

					if($changeStatus == 0 || $changeStatus < 1 ) {
						$this->M_piutang->setStatus_post($piutang['id_piutang'], 1);
					}
					$this->M_piutang->updateRemaining_post($piutang['id_piutang'], $changeStatus);

					$dataPiutang = [
						'id_piutang' => $piutang['id_piutang'],
						'pay_date' =>$this->input->post('tanggal_gajian', true),
						'pay_amount' => $piutang['angsuran'],
						'description' => $this->input->post('tanggal_gajian', true) . "-" . $this->input->post('description', true) . "-" . $this->input->post('code_payroll', true),
					];

					$piutang_payment = $this->M_purchase_piutang->create_post($dataPiutang);

					$potPiutang = $piutang['angsuran'];
				}
			}

			/*$totalPotongan = $totalPotAbsen + $totalPotIzin + $potPiutang + $totalPotHolyday + $totalPotCuti + $totalTelat;

			 Fitur Teknisi gaji
			if ($employee['code_division'] == 'TKS') {
				$totalPendapatan = $this->M_service_teknisi->totalServicePay_get($employeeId, $this->input->post('tanggal_gajian', true));
			 	$totalGaji = $totalPendapatan + $employee['uang_makan']+ $employee['bonus'] + $totalOvertime - $totalPotongan;
			} else {
				$totalGaji = $employee['basic_salary'] + $employee['uang_makan'] + $employee['bonus'] + $totalOvertime - $totalPotongan;
			}

			hapus ini jika mengaktifkan gaji teknisi
			$totalGaji = $employee['basic_salary'] + $employee['uang_makan'] + $employee['bonus'] + $totalOvertime - $totalPotongan; */

			/*if ($this->input->post('finance_record') == 1) {
				$dataFinanceRecord[] = [
					'record_date' => $this->input->post('tanggal_gajian', true),
					'product_id' => $employee['id_product'],
					'amount' => $totalGaji,
					'id_code' => 22,
					'description' => $this->input->post('tanggal_gajian', true) . "-" . $this->input->post('description', true) . "-" . $this->input->post('code_payroll', true),
				];
			}*/


			// Perhitungan PPH 21

				if($this->input->post('include_pph', true) == 1) {

					$bruto = (float) $this->M_payroll_component->findTotalSalaryByEmployeeId_get($employeeId);
					$bruto += $employee['basic_salary'];
					if(!$bruto) {
						$bruto = (float)$employee['basic_salary'];
					}



					$ptkp = $this->M_pph_config->findByEmployeeId_get($employeeId);


					$pot_ptkp = (float) $ptkp['pot_ptkp'];
					if($bruto >= $pot_ptkp) {
						$biaya_jabatan = 0.05 * $bruto;
						if($biaya_jabatan > 6_000_000) {
							$biaya_jabatan = 6_000_000;
						}
						if($this->input->post('include_bpjs', true) == 1) {
							$bpjs = $this->M_bpjs_config->findByEmployeeId_get($employeeId);
							if($bpjs['no_bpjs'] !== null || !empty($bpjs['no_bpjs'])) {
								$jht = 0.02 * $bruto;
								if($employee['basic_salary'] > 9_810_000) {
									$jp = 0.01 * 9_810_000;
								} else {
									$jp = 0.01 * $bruto;
								}

							}
						}
						$pengurangan_pajak = $biaya_jabatan + $jht + $jp;

						$netto = $bruto - $pengurangan_pajak;
						//dibulatkan ke ribuan
						$netto = floor($netto / 1000) * 1000;

						$pkp = $netto - $pot_ptkp;
						//dibulatkan ke ribuan
						$pkp = floor($pkp / 1000) * 1000;

						$data_pkp = $this->M_pkp->findAll_get();

						$sisa_pkp = $pkp;
						for ($i = 0; $i < count($data_pkp); $i++) {
							$batas_bawah = $data_pkp[$i]['lapisan_pkp'];
							$tarif_progressif = $data_pkp[$i]['tarif_pajak'];


							if ($sisa_pkp  > 0) {
								$batas_atas = isset($data_pkp[$i + 1]) ? (float)$data_pkp[$i + 1]['lapisan_pkp'] : $sisa_pkp + $batas_bawah;
								$pkp_terkena_pajak = min($sisa_pkp, $batas_atas - $batas_bawah);
								$totalPotPph += $pkp_terkena_pajak * $tarif_progressif;
								$sisa_pkp -= $pkp_terkena_pajak;


							}
						}

						$npwp = $this->M_pph_config->findByEmployeeId_get($employeeId);
						$periode_gajian = $this->input->post('periode_gajian', true);
						$date = new DateTime($periode_gajian);
						$date->modify('-1 month');
						$bulan = $date->format('m');
						$lastPph = $this->M_tax_config->findLastAkumulationPPH_get($employeeId, $bulan);
						$pph_akumulatif = $totalPotPph;
						if($lastPph){
							$totalPotPph = $totalPotPph - $lastPph['akumulatif_pph'];
						}
						if($npwp['npwp'] == null || empty($npwp['npwp'])) {
							$totalPotPph = $totalPotPph * 1.2;
						}

					}
				}



			// Selesai PPH

			$totalPotongan = $totalPotAbsen  + $potPiutang   + $totalTelat;

			if($this->input->post('include_bpjs', true) == 1 && $this->input->post('include_pph', true) == 2 ) {
				$bpjs = $this->M_bpjs_config->findByEmployeeId_get($employeeId);
				if($bpjs['no_bpjs'] == null || empty($bpjs['no_bpjs'])) {
					$jht = 0.02 * $employee['basic_salary'];
					$jp = 0.01 *  $employee['basic_salary'];
					$totalPotongan = $totalPotAbsen  + $potPiutang   + $totalTelat + $jht + $jp;
				}
			}
			$totalGaji = $employee['basic_salary']  + $totalOvertime - $totalPotongan + $bonus + $uang_makan;
			$totalGajiSetelahPph = $totalGaji - $totalPotPph;

			//Finance record Insert
			if ($this->input->post('finance_record') == 1) {
				$dataFinanceRecord[] = [
					'record_date' => $this->input->post('tanggal_gajian', true),
					'product_id' => $employee['id_product'],
					'amount' => $totalGajiSetelahPph,
					'id_code' => 22,
					'description' => "Gaji ".$employee['name']." Dengan Code ".$this->input->post('code_payroll', true),
				];
				if( $this->input->post('include_pph', true) == 1) {
					$dataFinanceRecordTax[] = [
						'record_date' => $this->input->post('tanggal_gajian', true),
						'product_id' => $employee['id_product'],
						'amount' => $totalPotPph,
						'id_code' => 32,
						'description' => "Potongann PPH ".$employee['name']." Dengan Code ".$this->input->post('code_payroll', true),
					];
				}
			}


			$dataBatch = [
				'id_employee' => $employeeId,
				'id_payroll' => $idPayroll,
				'tanggal_gajian' => $this->input->post('tanggal_gajian', true),
				'periode_gajian' =>$this->input->post('periode_gajian', true),
				'description' => $this->input->post('description', true),
				'total_absen' => $totalAbsent,
				'total_overtime' => $totalOvertime,
				'total_dayoff' => $totalDayoff,
				'total_potongan_telat' => $totalTelat,
				'piutang' => $potPiutang,
				'total' => $totalGaji,
				'potongan_absen' => $totalPotAbsen,
				'absen_hari' => $absenPerhari,
				'total_potongan' => $totalPotongan,
				'jht' => $jht,
				'jp' => $jp,
				'bonus' => $bonus,
				'gaji_bersih' => $totalGajiSetelahPph,
				'basic_uang_makan' => $uang_makan,
				'gaji_pokok' => $employee['basic_salary'],
			];

			$insertPayroll = $this->M_payroll_component->create_post($dataBatch);

			if (!$insertPayroll) {
				$this->db->trans_rollback();
				echo json_encode([
					'status' => false,
					'message' => 'Gagal menambahkan payroll.',
				]);
				return;
			}

			if($this->input->post('include_pph', true) == 1) {
				$dataTax[] = [
					'id_payroll_component' => $insertPayroll,
					'pkp' => $pkp,
					'pot_ptkp' => $pot_ptkp,
					'bruto' => $bruto,
					'netto' => $netto,
					'biaya_jabatan' => $biaya_jabatan,
					'pengurang_pajak' => $pengurangan_pajak,
					'akumulatif_pph' => $pph_akumulatif,
					'hasil_pph' => $totalPotPph,
				];
			}
		}

		if($this->input->post('include_pph', true) == 1 ) {
			$insertTax = $this->M_tax_config->create_batch_post($dataTax);
			$insertFinanceRecords = $this->M_finance_records->create_batch_post($dataFinanceRecordTax);

			if (!$insertTax || !$insertFinanceRecords) {
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
				'message' => 'Gagal menambahkan payroll.',
			]);
		} else {
			echo json_encode([
				'status' => true,
				'message' => 'Payroll berhasil dibuat',
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


		if($this->M_payroll_component->delete($id)){
			$response = [
				'status' => true,
				'message' => 'Slip Gaji berhasil dihapus',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Slip Gaji gagal dihapus',
			];
		}

		echo json_encode($response);

	}

	public function delete_by_payroll()
	{
		$this->_ONLYSELECTED([1,2]);
		$this->_isAjax();

		$id = $this->input->post('id');

		if($this->M_payroll->delete($id)){
			$pc = $this->M_payroll_component->findByPayrollId_get($id);
			if($pc) {
				foreach ($pc as $paco) {
					$this->M_payroll_component->delete($paco['id_payroll_component']);
				}
			}
			$response = [
				'status' => true,
				'message' => 'Slip Gaji berhasil dihapus',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Slip Gaji gagal dihapus',
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

		$data['employee'] = 'false';
		$data['products'] = $this->M_products->findAll_get();
		$data['divisions'] = $this->M_division->findAll_get();

		$data['view_data'] = 'core/payroll_component/data_payroll_component';
		$data['view_components'] = 'core/payroll_component/data_payroll_component_components';


		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}


	public function payroll_employee(){
		$this->_ONLYSELECTED([3]);
		$data = $this->_basicData();

		$data['title'] = 'Payroll';
		$data['view_name'] = 'employee/payroll_employee';
		$data['breadcrumb'] = 'Detail Payroll';
		$data['menu'] = '';

		$data['products'] = $this->M_products->findAll_get();
		$id = $this->M_employees->findByEmail_get($data['user']['email']);
		$data['employee'] = $id['id_employee'];

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
	//	$idPayroll = $this->M_payroll->create_post($dataPayroll);
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
	//		$totalCuti =$this->M_leave->totalLeaveLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true));
	//		$totalIzin =$this->M_izin->totalIzinLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true));
	//		$totalDayoff =$this->M_day_off->totalDayOffLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true));
	//		$totalOvertime =$this->M_overtime->totalOvertimeLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true));
	//		$totalAbsent =$this->M_schedule->totalAbsentLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true));
	//		$employee = $this->M_employees->findById_get($employeeId);
	//
	//		$potIzin=(round($employee['uang_makan']) / 26) * $totalIzin;
	//
	//		if($employee['code_division'] == 'TKS' )  {
	//			$totalPendapatan = $this->M_service_teknisi->totalServicePay_get($employeeId, $this->input->post('tanggal_gajian', true));
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
	//	$insert = $this->M_payroll->create_batch_post($dataBatch);
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


//V1
//			$totalCuti = $this->M_leave->totalLeaveLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true));
//			$totalIzin = $this->M_izin->totalIzinLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true));
//			$totalDayoff = $this->M_day_off->totalDayOffLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true));
//			$totalAbsent = $this->M_schedule->totalAbsentLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true));
//			$totalHolyday = $this->M_holyday->totalHolydayLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true));



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
//	$this->form_validation->set_rules('periode_gajian', 'periode_mulai', 'required', [
//		'required' => 'Periode mulai gajian harus diisi',
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
//	$this->form_validation->set_rules('holyday', 'holyday', 'required', [
//		'required' => 'holyday harus diisi',
//	]);
//	$this->form_validation->set_rules('include_cuti', 'include_cuti', 'required', [
//		'required' => 'Opsi Potongan cuti harus diisi',
//	]);
//	$this->form_validation->set_rules('include_potongan_telat', 'include_potongan_telat', 'required', [
//		'required' => 'Opsi Potongan telat harus diisi',
//	]);
//	$this->form_validation->set_rules('include_pph_21', 'include_pph_21', 'required', [
//		'required' => 'Opsi Potongan PPH 21 harus diisi',
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
//	if (empty($employees)) {
//		echo json_encode([
//			'status' => false,
//			'message' => 'Harap pilih minimal satu karyawan',
//		]);
//		return;
//	}
//
//	$this->db->trans_start();
//
//	$dataPayroll = [
//		'code_payroll' => $this->input->post('code_payroll', true),
//		'input_at' => $this->input->post('input_at', true),
//		'include_piutang' => $this->input->post('piutang', true),
//		'include_finance_record' => $this->input->post('finance_record', true),
//		'include_holiday' => $this->input->post('holyday', true),
//		'include_cuti' => $this->input->post('include_cuti', true),
//		'include_potongan_telat' => $this->input->post('include_potongan_telat', true),
//	];
//
//	$idPayroll = $this->M_payroll->create_post($dataPayroll);
//
//	if (!$idPayroll) {
//		$this->db->trans_rollback();
//		echo json_encode([
//			'status' => false,
//			'message' => 'Gagal membuat payroll.',
//		]);
//		return;
//	}
//
//	$dataBatch = [];
//	$dataTax = [];
//	$dataFinanceRecord = [];
//	$dataFinanceRecordTax = [];
//
//	foreach ($employees as $employeeId) {
//
//		$potPiutang = 0;
//		$totalPotHolyday = 0;
//		$totalPotCuti = 0;
//		$jht = 0;
//		$jp = 0;
//		$totalPotPph = 0;
//
//
//		//V2
//		$totalCuti = $this->M_schedule->totalScheduleByStatusV2_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true), 4 );
//		$totalIzin = $this->M_schedule->totalScheduleByStatusV2_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true), 5);
//		$totalDayoff = $this->M_schedule->totalScheduleByStatusV2_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true), 2);
//		$totalAbsent = $this->M_schedule->totalScheduleByStatusV2_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true), 7);
//		$totalHolyday = $this->M_schedule->totalScheduleByStatusV2_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true), 3);
//		$totalOvertime = $this->M_overtime->totalOvertimeLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true));
//		$totalTelat = 0;
//		$employee = $this->M_employees->findByIdJoin_get($employeeId);
//
//		$izinPerhari = round($employee['uang_makan'] / 24);
//		$absenPerhari = round($employee['basic_salary'] / 27);
//		$totalPotAbsen = $absenPerhari * $totalAbsent;
//		$totalPotIzin = $izinPerhari * $totalIzin;
//
//		if($this->input->post('holyday', true) == 1) {
//			$totalPotHolyday = $izinPerhari * $totalHolyday;
//		}
//
//		if($this->input->post('include_potongan_telat', true) == 1) {
//			$totalTelat = $this->M_attendance->totalTelatLastMonthToNowByEmployeeId_get($employeeId, $this->input->post('tanggal_gajian', true), $this->input->post('periode_gajian', true));
//		}
//
//		if($this->input->post('include_cuti', true) == 1) {
//			$totalPotCuti = $izinPerhari * $totalCuti;
//		}
//
//		if ($this->input->post('piutang', true) == 1) {
//			$thisMonth = date('m' , strtotime($this->input->post('tanggal_gajian', true)));
//			$thisYear = date('Y', strtotime($this->input->post('tanggal_gajian', true)));
//
//			$piutang = $this->M_piutang->findPiutangThisMonthByEmployeeId_get($employeeId, $thisMonth, $thisYear);
//			if ($piutang) {
//				$changeStatus = $piutang['remaining_piutang'] - $piutang['angsuran'];
//
//				if($changeStatus == 0 || $changeStatus < 1 ) {
//					$this->M_piutang->setStatus_post($piutang['id_piutang'], 1);
//				}
//				$this->M_piutang->updateRemaining_post($piutang['id_piutang'], $changeStatus);
//
//				$dataPiutang = [
//					'id_piutang' => $piutang['id_piutang'],
//					'pay_date' =>$this->input->post('tanggal_gajian', true),
//					'pay_amount' => $piutang['angsuran'],
//					'description' => $this->input->post('tanggal_gajian', true) . "-" . $this->input->post('description', true) . "-" . $this->input->post('code_payroll', true),
//				];
//
//				$piutang_payment = $this->M_purchase_piutang->create_post($dataPiutang);
//
//				$potPiutang = $piutang['angsuran'];
//			}
//		}
//
//		//$totalPotongan = $totalPotAbsen + $totalPotIzin + $potPiutang + $totalPotHolyday + $totalPotCuti + $totalTelat;
//
//		// Fitur Teknisi gaji
//		//if ($employee['code_division'] == 'TKS') {
//		//	$totalPendapatan = $this->M_service_teknisi->totalServicePay_get($employeeId, $this->input->post('tanggal_gajian', true));
//		// 	$totalGaji = $totalPendapatan + $employee['uang_makan']+ $employee['bonus'] + $totalOvertime - $totalPotongan;
//		//} else {
//		//	$totalGaji = $employee['basic_salary'] + $employee['uang_makan'] + $employee['bonus'] + $totalOvertime - $totalPotongan;
//		//}
//
//		//hapus ini jika mengaktifkan gaji teknisi
//		//$totalGaji = $employee['basic_salary'] + $employee['uang_makan'] + $employee['bonus'] + $totalOvertime - $totalPotongan;
//
//		/*if ($this->input->post('finance_record') == 1) {
//			$dataFinanceRecord[] = [
//				'record_date' => $this->input->post('tanggal_gajian', true),
//				'product_id' => $employee['id_product'],
//				'amount' => $totalGaji,
//				'id_code' => 22,
//				'description' => $this->input->post('tanggal_gajian', true) . "-" . $this->input->post('description', true) . "-" . $this->input->post('code_payroll', true),
//			];
//		}*/
//
//
//		// Perhitungan PPH 21
//
//		if($this->input->post('include_pph_21', true) == 1) {
//
//			$bruto = $this->M_payroll_component->findTotalSalaryByEmployeeId_get($employeeId);
//
//			$ptkp = $this->M_pph_config->findByEmployeeId_get($employeeId);
//
//			if($bruto >= $ptkp['pot_ptkp']) {
//				$biaya_jabatan = 0.05 * $bruto;
//				if($biaya_jabatan > 500_000) {
//					$biaya_jabatan = 500_000;
//				}
//				if($this->input->post('include_bpjs', true) == 1) {
//					$jht = 0.02 * $bruto;
//					$jp = 0.01 * $bruto;
//				}
//				$pengurangan_pajak = $biaya_jabatan + $jht + $jp;
//
//				$netto = $bruto - $pengurangan_pajak;
//
//				$pkp = round($netto - $ptkp['pot_ptkp']);
//				$data_pkp = $this->M_pkp->findAll_get();
//				switch(true) {
//					case($pkp >= $data_pkp[0]['lapisan_pkp'] && $pkp <= $data_pkp[1]['lapisan_pkp']):
//						$tarif_progressif = $data_pkp[0]['tarif_progressif'] * $pkp;
//						break;
//					case($pkp > $data_pkp[1]['lapisan_pkp'] && $pkp <= $data_pkp[2]['lapisan_pkp']):
//						$tarif_progressif = $data_pkp[1]['tarif_progressif'] * $pkp;
//						break;
//					case($pkp > $data_pkp[2]['lapisan_pkp'] && $pkp <= $data_pkp[3]['lapisan_pkp']):
//						$tarif_progressif = $data_pkp[2]['tarif_progressif'] * $pkp;
//						break;
//					case($pkp > $data_pkp[3]['lapisan_pkp'] && $pkp <= $data_pkp[4]['lapisan_pkp']):
//						$tarif_progressif = $data_pkp[3]['tarif_progressif'] * $pkp;
//						break;
//					case($pkp > $data_pkp[4]['lapisan_pkp']):
//						$tarif_progressif = $data_pkp[4]['tarif_progressif'] * $pkp;
//						break;
//					default:
//						$tarif_progressif = 1;
//				}
//
//				$totalPotPph = $tarif_progressif * $pkp;
//
//
//			}
//		}
//
//		// Selesai PPH
//
//		$totalPotongan = $totalPotAbsen + $totalPotIzin + $potPiutang + $totalPotHolyday + $totalPotCuti + $totalTelat;
//		$totalGaji = $employee['basic_salary'] + $employee['uang_makan'] + $employee['bonus'] + $totalOvertime - $totalPotongan;
//		if($this->input->post('include_bpjs', true) == 1 && $this->input->post('include_pph_21', true) == 2 ) {
//			$jht = 0.02 * $totalGaji;
//			$jp = 0.01 * $totalGaji;
//			$totalGaji = $totalGaji - $jht - $jp;
//		}
//
//		$totalGajiSetelahPph = $totalGaji + $totalPotPph;
//
//		//Finance record Insert
//		if ($this->input->post('finance_record') == 1) {
//			$dataFinanceRecord[] = [
//				'record_date' => $this->input->post('tanggal_gajian', true),
//				'product_id' => $employee['id_product'],
//				'amount' => $totalGaji,
//				'id_code' => 22,
//				'description' => $this->input->post('tanggal_gajian', true) . "-" . $this->input->post('description', true) . "-" . $this->input->post('code_payroll', true),
//			];
//			if($this->input->post('include_pph_21', true) == 1) {
//				$dataFinanceRecordTax[] = [
//					'record_date' => $this->input->post('tanggal_gajian', true),
//					'product_id' => $employee['id_product'],
//					'amount' => $totalPotPph,
//					'id_code' => 28,
//					'description' => $this->input->post('tanggal_gajian', true) . "-" . $this->input->post('description', true) . "-" . $this->input->post('code_payroll', true),
//				];
//			}
//
//		}
//
//		$dataBatch[] = [
//			'id_employee' => $employeeId,
//			'id_payroll' => $idPayroll,
//			'bonus' => $employee['bonus'],
//			'tanggal_gajian' => $this->input->post('tanggal_gajian', true),
//			'periode_gajian' =>$this->input->post('periode_gajian', true),
//			'description' => $this->input->post('description', true),
//			'total_izin' => $totalIzin,
//			'total_cuti' => $totalCuti,
//			'total_absen' => $totalAbsent,
//			'total_overtime' => $totalOvertime,
//			'total_dayoff' => $totalDayoff,
//			'total_potongan_telat' => $totalTelat,
//			'potongan_cuti' => $totalPotCuti,
//			'cuti_hari' => $izinPerhari,
//			'total_libur_nasional' => $totalHolyday,
//			'piutang' => $potPiutang,
//			'total' => $totalGaji,
//			'potongan_libur_nasional' => $totalPotHolyday,
//			'potongan_absen' => $totalPotAbsen,
//			'potongan_izin' => $totalPotIzin,
//			'absen_hari' => $absenPerhari,
//			'izin_hari' => $izinPerhari,
//			'libur_nasional_hari' => $izinPerhari,
//			'total_potongan' => $totalPotongan,
//			//				'potongan_pph_21' => $pph_21,
//		];
//
//		//			$dataTax[] = [
//		//				'id_employee' => $employeeId,
//		//				'id_ptkp' => $employee['ptkp'],
//		//				'id_pkp' =>	$employees,
//		//				'tax_method' =>	$employees,
//		//				'bruto' =>	$employees,
//		//				'id_pkp' =>	$employees,
//		//				'id_pkp' =>	$employees,
//		//
//		//			];
//
//	}
//
//	$insertPayroll = $this->M_payroll_component->create_batch_post($dataBatch);
//
//	if (!$insertPayroll) {
//		$this->db->trans_rollback();
//		echo json_encode([
//			'status' => false,
//			'message' => 'Gagal menambahkan payroll.',
//		]);
//		return;
//	}
//
//	if (!empty($dataFinanceRecord)) {
//		$insertFinanceRecord = $this->M_finance_records->create_batch_post($dataFinanceRecord);
//		if (!$insertFinanceRecord) {
//			$this->db->trans_rollback();
//			echo json_encode([
//				'status' => false,
//				'message' => 'Gagal menambahkan data finance record.',
//			]);
//			return;
//		}
//	}
//
//	$this->db->trans_complete();
//
//	if ($this->db->trans_status() === FALSE) {
//		echo json_encode([
//			'status' => false,
//			'message' => 'Gagal menambahkan payroll.',
//		]);
//	} else {
//		echo json_encode([
//			'status' => true,
//			'message' => 'Payroll berhasil dibuat untuk ' . count($dataBatch) . ' karyawan.',
//		]);
//	}
//}

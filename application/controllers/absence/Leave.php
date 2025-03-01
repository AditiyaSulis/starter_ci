<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_leave');
		$this->load->model('M_employees');
		$this->load->model('M_schedule');
		$this->load->model('M_products');

	}


	public function leave_page()
	{
		$this->_ONLYSELECTED([3]);
		$data = $this->_basicData();

		$data['title'] = 'Leave';
		$data['view_name'] = 'absence/leave';
		$data['breadcrumb'] = 'Leave';
		$data['menu'] = '';

		$email = $data['user']['email'];
		$data['products'] = $this->M_products->findAll_get();
		$emp = $this->M_employees->findByEmail_get($email);
		$data['employee'] = $emp['id_employee'];
		$data['total_cuti'] = $this->M_leave->totalLeaveByEmployeeId_get($emp['id_employee']);

		$data['view_data'] = 'core/leave/data_leave';
		$data['view_components'] = 'core/leave/data_leave_components';

		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}


	public function su_leave_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Data Leave';
		$data['view_name'] = 'absence/data/leave';
		$data['breadcrumb'] = 'Data - Leave';
		$data['menu'] = 'Data';

		$data['products'] = $this->M_products->findAll_get();
		$data['employee'] = 'false';
		$data['employees'] = $this->M_employees->findAll_get();

		$data['this_month'] = $this->M_leave->totalLeaveThisMonth_get();
		$data['this_year'] = $this->M_leave->totalLeave_get();

		$data['view_data'] = 'core/leave/data_leave';
		$data['view_components'] = 'core/leave/data_leave_components';

		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}


	public function add_Leave(){
		$this->_ONLYSELECTED([1,3]);
		$this->_isAjax();
		$this->form_validation->set_rules('input_at', 'input_at', 'required', [
			'required' => 'Tanggal input harus diisi',
		]);
		$this->form_validation->set_rules('total_days', 'total_days', 'required', [
			'required' => 'Total hari harus diisi',
		]);
		$this->form_validation->set_rules('type', 'type', 'required', [
			'required' => 'Type harus diisi',
		]);
		$this->form_validation->set_rules('start_day', 'start_day', 'required', [
			'required' => 'Mulai cuti harus diisi',
		]);
		$this->form_validation->set_rules('end_day', 'end_day', 'required', [
			'required' => 'Selesai cuti harus diisi',
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

		$type = $this->input->post('type');
		$email = $this->input->post('id_employee');
		$emp = $this->M_employees->findByEmail_get($email);
		$totalDays = $this->input->post('total_days');

		//perhitungan untuk menghitung masa kerja
		$today = strtotime(date('Y-m-d'));
		$dateIn = strtotime($emp['date_in']);
		$diffInMonths = ($today - $dateIn) / (30 * 24 * 60 * 60);

		if($diffInMonths < 12) {
			$response = [
				'status' => false,
				'message' => 'Masa kerja karyawan kurang dari 12 bulan.',
				'confirmationbutton' => true,
				'timer' => 0,
			];
			echo json_encode($response);
			return;
		}
		//selesai

		//validasi cuti tidak boleh lebih 2 hari berturut2
		if($totalDays > 2 ){
			$response = [
				'status' => false,
				'message' => 'Cuti tidak boleh melebihi 2 hari berturut-turut',
				'confirmationbutton' => true,
				'timer' => 0,
			];
			echo json_encode($response);
			return;
		}

		//validasi dalam setahun tidak boleh melebih 12x
		$totalLeaves = $this->M_leave->totalLeaveByEmployeeId_get($emp['id_employee']);
		if($totalLeaves > 12 ) {
			$response = [
				'status' => false,
				'message' => 'Karyawan sudah melakukan cuti selama 12x tahun ini.',
				'confirmationbutton' => true,
				'timer' => 0,
			];
			echo json_encode($response);
			return;
		}

		$totalLeavesThisMonth = $this->M_leave->totalLeaveThisMonthByEmployeeId_get($emp['id_employee']);
		if($totalLeavesThisMonth > 2 ) {
			$response = [
				'status' => false,
				'message' => 'Karyawan sudah melakukan cuti selama 2x bulan ini.',
				'confirmationbutton' => true,
				'timer' => 0,
			];
			echo json_encode($response);
			return;
		}


		$endDay = $type == 1 ? null : $this->input->post('end_day');


		$data = [
			'id_employee' => $emp['id_employee'],
			'input_at' => $this->input->post('input_at',true),
			'total_days' => $this->input->post('total_days',true),
			'type' => $this->input->post('type',true),
			'start_day' => $this->input->post('start_day',true),
			'end_day' => $endDay,
			'description' => $this->input->post('description',true),
		];


		$overtime = $this->M_leave->create_post($data);

		if ($overtime) {
			$response = [
				'status' => true,
				'message' => 'Data cuti berhasil dibuat',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Data cuti gagal ditambahkan',
			];
		}

		echo json_encode($response);
	}


	public function su_add_Leave(){
		$this->_ONLY_SU();
		$this->_isAjax();

		$this->form_validation->set_rules('input_at', 'input_at', 'required', [
			'required' => 'Tanggal input harus diisi',
		]);
		$this->form_validation->set_rules('total_days', 'total_days', 'required', [
			'required' => 'Total hari harus diisi',
		]);
		$this->form_validation->set_rules('type', 'type', 'required', [
			'required' => 'Type harus diisi',
		]);
		$this->form_validation->set_rules('start_day', 'start_day', 'required', [
			'required' => 'Mulai cuti harus diisi',
		]);
		$this->form_validation->set_rules('end_day', 'end_day', 'required', [
			'required' => 'Selesai cuti harus diisi',
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

		$type = $this->input->post('type');
		$email = $this->input->post('id_employee');
		$emp = $this->M_employees->findById_get($email);
		$totalDays = $this->input->post('total_days');

		//perhitungan untuk menghitung masa kerja
		$today = strtotime(date('Y-m-d'));
		$dateIn = strtotime($emp['date_in']);
		$diffInMonths = ($today - $dateIn) / (30 * 24 * 60 * 60);

		if($diffInMonths < 12) {
			$response = [
				'status' => false,
				'message' => 'Masa kerja karyawan kurang dari 12 bulan.',
				'confirmationbutton' => true,
				'timer' => 0,
			];
			echo json_encode($response);
			return;
		}
		//selesai

		//validasi cuti tidak boleh lebih 2 hari berturut2
		if($totalDays > 2 ){
			$response = [
				'status' => false,
				'message' => 'Cuti tidak boleh melebihi 2 hari berturut-turut',
				'confirmationbutton' => true,
				'timer' => 0,
			];
			echo json_encode($response);
			return;
		}

		//validasi dalam setahun tidak boleh melebih 12x
		$totalLeaves = $this->M_leave->totalLeaveByEmployeeId_get($emp['id_employee']);
		if($totalLeaves > 12 ) {
			$response = [
				'status' => false,
				'message' => 'Karyawan sudah melakukan cuti selama 12x tahun ini.',
				'confirmationbutton' => true,
				'timer' => 0,
			];
			echo json_encode($response);
			return;
		}

		//validasi dalam sebulan tidak boleh melebih 2x
		$totalLeavesThisMonth = $this->M_leave->totalLeaveThisMonthByEmployeeId_get($emp['id_employee']);
		if($totalLeavesThisMonth > 1 ) {
			$response = [
				'status' => false,
				'message' => 'Karyawan sudah melakukan cuti selama 2x bulan ini.',
				'confirmationbutton' => true,
				'timer' => 0,
			];
			echo json_encode($response);
			return;
		}


		$endDay = $type == 1 ? null : $this->input->post('end_day');


		$data = [
			'id_employee' => $emp['id_employee'],
			'input_at' => $this->input->post('input_at',true),
			'total_days' => $this->input->post('total_days',true),
			'type' => $this->input->post('type',true),
			'start_day' => $this->input->post('start_day',true),
			'end_day' => $endDay,
			'status' => 2,
			'description' => $this->input->post('description',true),
		];



		$leave = $this->M_leave->create_post($data);

		if ($leave) {
			if($type == 2) {
				$set1 = $this->M_schedule->setStatus_post($emp['id_employee'], $this->input->post('start_day',true), 4);
				$set2 = $this->M_schedule->setStatus_post($emp['id_employee'], $this->input->post('end_day'), 4);
			} else {
				$set1 = $this->M_schedule->setStatus_post($emp['id_employee'], $this->input->post('start_day',true), 4);
			}
			$response = [
				'status' => true,
				'set1' => $set1,
				'set2' => $type == 2 ? $set2 : null,
				'message' => 'Data cuti berhasil dibuat',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Data cuti gagal ditambahkan',
			];
		}

		echo json_encode($response);
	}


	public function set_status()
	{
		$this->_ONLY_SU();
		$this->_isAjax();

		$id = $this->input->post('id_cuti', true);
		$idEmployee = $this->input->post('id_employee', true);
		$type = $this->input->post('type', true);
		$start_day = $this->input->post('start_day', true);
		$end_day = $this->input->post('end_day', true);

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
			if($type == 1) {
				$set1 = $this->M_schedule->setStatus_post($idEmployee, $start_day, 4);
			} else {
				$set1 = $this->M_schedule->setStatus_post($idEmployee, $start_day, 4);
				$set2 = $this->M_schedule->setStatus_post($idEmployee, $end_day, 4);
			}
		} else {
			if($type == 1) {
				$set1 = $this->M_schedule->setStatus_post($idEmployee, $start_day, 1);
			} else {
				$set1 = $this->M_schedule->setStatus_post($idEmployee, $start_day, 1);
				$set2 = $this->M_schedule->setStatus_post($idEmployee, $end_day, 1);
			}
		}


		if ($this->M_leave->setStatus_post($id, $setstatus)) {
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
		$data = $this->M_leave->findById_get($id);

		if($this->M_leave->delete($id)){
			$this->M_schedule->setStatus_post($data['id_employee'], $data['start_day'], 1);
			if($data['end_day'] != null){
				$this->M_schedule->setStatus_post($data['id_employee'], $data['end_day'], 1);
			}
			$response = [
				'status' => true,
				'message' => 'Data cuti karyawan berhasil dihapus',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Data cuti karyawan gagal dihapus',
			];
		}

		echo json_encode($response);

	}



}

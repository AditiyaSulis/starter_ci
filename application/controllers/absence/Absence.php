<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Absence extends MY_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model('m_Employees');
		$this->load->model('m_Schedule');
		$this->load->model('m_Attendance');

    }

    public function absence_page()
    {
        $this->_ONLYSELECTED([3]);
        $data = $this->_basicData();

        $data['title'] = 'Absence';
        $data['view_name'] = 'absence/index';
        $data['breadcrumb'] = 'Absence';
        $data['menu'] = '';

		$id = $this->m_Employees->findByEmail_get($data['user']['email']);
		$data['employee'] = $id['id_employee'];

		$today = date('Y-m-d');

		$data['schedule'] = $this->m_Schedule->findScheduleToday_get($data['employee'], $today);
		$data['view_log_attendance'] = 'core/log_attendance/data_log_attendance';

        if($data['user']) { 
            $this->load->view('templates/index' ,$data);
        } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
            redirect('fetch/login');
        }
    }


	public function add_attendance()
	{
		$this->_ONLYSELECTED([3]);
		$this->_isAjax();

		$this->form_validation->set_rules('id_employee', 'id_employee', 'required', [
			'required' => 'id_employee input harus diisi',
		]);
		$this->form_validation->set_rules('id_schedule', 'id_schedule', 'required', [
			'required' => 'id_schedule input harus diisi',
		]);
		$this->form_validation->set_rules('jam_masuk', 'jam_masuk', 'required', [
			'required' => 'jam_masuk input harus diisi',
		]);
		$this->form_validation->set_rules('tanggal_masuk', 'tanggal_masuk', 'required', [
			'required' => 'tanggal_masuk input harus diisi',
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

		$idSchedule = $this->input->post('id_schedule', true);
		$idEmployee = $this->input->post('id_employee', true);
		$tanggal = $this->input->post('tanggal_masuk', true);

		$dataAtt = [
			'id_employee' =>$idEmployee,
			'id_schedule' =>$idSchedule,
			'jam_masuk' => $this->input->post('jam_masuk', true),
			'tanggal_masuk' => $this->input->post('tanggal_masuk', true),
			'status' => 2,
		];


		$attendance = $this->m_Attendance->create_post($dataAtt);

		if ($attendance) {
			$this->m_Schedule->setStatus_post($idEmployee, $tanggal, '6');
			$response = [
				'status' => true,
				'sc' => $idSchedule,
				'message' => 'Absen berhasil',
			];
		} else {
			$response = [
				'status' => false,
				'sc' => $idSchedule,
				'message' => 'Absen Gagal',
			];
		}

		echo json_encode($response);
	}

}

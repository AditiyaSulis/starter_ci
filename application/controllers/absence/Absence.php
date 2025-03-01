<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Absence extends MY_Controller{

    function __construct()
    {
        parent::__construct();
		$this->load->model('M_employees');
		$this->load->model('M_schedule');
		$this->load->model('M_attendance');
		$this->load->model('M_products');
		$this->load->model('m_Location');

    }

    public function absence_page()
    {
        $this->_ONLYSELECTED([3]);
        $data = $this->_basicData();

        $data['title'] = 'Absence';
        $data['view_name'] = 'absence/index';
        $data['breadcrumb'] = 'Absence';
        $data['menu'] = '';

		$id = $this->M_employees->findByEmail_get($data['user']['email']);
		$data['employee'] = $id['id_employee'];

		$today = date('Y-m-d');

		$data['schedule'] = $this->M_schedule->findScheduleToday_get($data['employee'], $today);
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
		$this->form_validation->set_rules('latitude', 'latitude', 'required', [
			'required' => 'Gagal Absen',
		]);
		$this->form_validation->set_rules('longitude', 'longitude', 'required', [
			'required' => 'Longitude harus diisi, pastikan GPS/Browser memiliki akses lokasi anda.',
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
		$latitude = $this->input->post('latitude', true);
		$longitude = $this->input->post('longitude', true);

		$employee = $this->M_employees->findById_get($idEmployee);
		$product  =$this->M_products->findById_get($employee['id_product']);
		$location = $this->m_Location->get_location($product['id_location']);

		$latitudeDecimal = floatval($location['latitude']);
		$longitudeDecimal = floatval($location['longitude']);

		//		echo '<pre>';
		//		print_r($latitudeDecimal.' long : '.$longitudeDecimal);
		//		echo '</pre>';
		//		die();
		// Gunakan geoPHP untuk menghitung jarak
		//		$this->load->library('geoGPS');
		//		$point1 = geoPHP::load("POINT($longitude $latitude)", 'wkt'); // Absensi karyawan
		//		$point2 = geoPHP::load("POINT({$longitudeDecimal} {$latitudeDecimal})", 'wkt'); // Lokasi kantor


		$this->load->helper('distance');
		$distance =  haversine_distance_in_meter($latitudeDecimal, $longitudeDecimal, $latitude, $longitude);
		//		$distance = $point1->distance($point2) * 111320; // Hasil dalam meter
		//		echo '<pre>';
		//		print_r($distance);
		//		echo '</pre>';
		//		die();

		if ($distance > 250) {
			echo json_encode(['status' => false, 'message' => "Anda berjarak $distance meter dari lokasi tempat anda bekerja"]);
			return;
		}

		$dataAtt = [
			'id_employee' =>$idEmployee,
			'id_schedule' =>$idSchedule,
			'jam_masuk' => $this->input->post('jam_masuk', true),
			'tanggal_masuk' => $this->input->post('tanggal_masuk', true),
			'location_latitude' => $latitude,
			'location_longitude' => $longitude,
			'status' => 2,
		];


		$attendance = $this->M_attendance->create_post($dataAtt);

		if ($attendance) {
			$this->M_schedule->setStatus_post($idEmployee, $tanggal, '6');
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

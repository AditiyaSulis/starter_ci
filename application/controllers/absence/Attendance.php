<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_day_off');
		$this->load->model('M_products');
		$this->load->model('M_employees');
		$this->load->model('M_schedule');
		$this->load->model('M_attendance');

	}

	public function attendance_page()
	{
		$this->_ONLYSELECTED([3]);
		$data = $this->_basicData();

		$data['title'] = 'Attendance';
		$data['view_name'] = 'absence/rekap';
		$data['breadcrumb'] = 'Attendance';
		$data['menu'] = '';

		$id = $this->M_employees->findByEmail_get($data['user']['email']);
		$data['employee'] = $id['id_employee'];

		//	$data['products'] = $this->M_products->findAll_get();
		$data['view_data'] = 'core/attendance/data_attendance';

		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('panel');
		}
	}

	public function su_attendance_page()
	{
		$this->_ONLYSELECTED([1,2,4]);
		$data = $this->_basicData();

		$data['title'] = 'Data Attendance';
		$data['view_name'] = 'absence/data/attendance';
		$data['breadcrumb'] = 'Data - Attendance';
		$data['menu'] = 'Data';

		$data['employee'] = 'false';

		$data['view_data'] = 'core/attendance/data_attendance';
		$data['products'] = $this->M_products->findAll_get();


		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('panel');
		}
	}

	public function log_attendance_page()
	{
		$this->_ONLYSELECTED([1,2,4]);
		$data = $this->_basicData();

		$data['title'] = 'Data Attendance';
		$data['view_name'] = 'absence/data/log_attendance';
		$data['breadcrumb'] = 'Data - Attendance';
		$data['menu'] = 'Data';

		$data['employee'] = 'false';

		$data['view_data'] = 'core/log_attendance/data_log_attendance';
		$data['products'] = $this->M_products->findAll_get();


		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('panel');
		}
	}

	//TEST GEO GPS
	public function test_geoPHP()
	{
		$this->load->library('GeoGPS');

		$wkt = 'POINT(106.816666 -6.200000)'; // Koordinat Jakarta
		$point = geoPHP::load($wkt, 'wkt');

		echo "Latitude: " . $point->getY() . "<br>";
		echo "Longitude: " . $point->getX();
	}

	public function calculate_distance()
	{
		$this->load->helper('distance');

		$jakarta_lat = -6.200000;
		$jakarta_lon = 106.816666;
		$bandung_lat = -6.917464;
		$bandung_lon = 107.619122;

		$distance = haversine_distance($jakarta_lat, $jakarta_lon, $bandung_lat, $bandung_lon, "km");

		echo "Jarak antara Jakarta dan Bandung: " . round($distance, 2) . " km";
	}

	public function set_potongan_telat()
	{

		$this->_ONLYSELECTED([1,2,4]);
		$this->_isAjax();

		$id = $this->input->post('id_attendance', true);


		$this->form_validation->set_rules('potongan_telat', 'potongan_telat', 'required', [
			'required' => 'Potongan telat harus diisi',
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


		$potongan_telat = $this->input->post('potongan_telat', true);


		if ($this->M_attendance->setPotongan_post($id, $potongan_telat)) {
			$response = [
				'status' => true,
				'message' => 'Potongan telat berhasil diperbarui.'
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Gagal memperbarui Status.'
			];
		}

		echo json_encode($response);


	}

	public function set_time_management()
	{
		$this->_ONLYSELECTED([1,2,4]);
		$this->_isAjax();

		$id = $this->input->post('id_attendance', true);


		$this->form_validation->set_rules('time_management', 'time_management', 'required', [
			'required' => 'Status Kehadiran harus diisi',
		]);

		$this->form_validation->set_rules('jam_masuk', 'jam_masuk', 'required', [
			'required' => 'Jam Masuk harus diisi',
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

		$setstatus = $this->input->post('time_management', true);
		$jamMasuk = $this->input->post('jam_masuk', true);

		if($setstatus == 1) {
			$setStatus1 = $this->M_attendance->setTimeManagement_post($id, 1, $jamMasuk);
		} else {
			$setStatus1 = $this->M_attendance->setTimeManagement_post($id, 0, $jamMasuk);
		}

		if ($setStatus1) {
			$response = [
				'status' => true,
				'message' => 'Status kehadiran berhasil diperbarui.'
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Gagal memperbarui Status kehadiran.'
			];
		}

		echo json_encode($response);

	}
}

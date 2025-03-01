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
			redirect('fetch/login');
		}
	}

	public function su_attendance_page()
	{
		$this->_ONLYSELECTED([1,2]);
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
			redirect('fetch/login');
		}
	}

	public function log_attendance_page()
	{
		$this->_ONLYSELECTED([1,2]);
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
			redirect('fetch/login');
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

}

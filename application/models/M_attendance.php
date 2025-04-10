<?php

defined('BASEPATH') or exit('No direct script access allowed');

class m_attendance extends CI_Model
{

	private $column_search = array('attendance.id_attendance', 'attendance.id_employee', 'attendance.id_schedule',  'attendance.jam_masuk', 'attendance.status', 'attendance.tanggal_masuk',  'schedule.id_workshift', 'workshift.clock_in', 'workshift.clock_out', 'employee.id_employee', 'employee.name', 'employee.id_product', 'products.name_product');
	private $column_order = array('attendance.id_attendance', 'attendance.id_employee', 'attendance.id_schedule',  'attendance.jam_masuk', 'attendance.status', 'attendance.tanggal_masuk',  'schedule.id_workshift', 'workshift.clock_in', 'workshift.clock_out', 'employee.id_employee', 'employee.name', 'employee.id_product', 'products.name_product');
	private $order = array('attendance.tanggal_masuk' => 'asc');

	public function findAll_get()
	{
		return $this->db->get('attendance')->result_array();
	}


	public function findById_get($id)
	{
		return $this->db->get_where('attendance', ['id_attendance' => $id])->row_array();
	}


	public function findAllWithJoin_get()
	{
		$this->db->select('attendance.id_attendance, attendance.id_employee, attendance.id_schedule, attendance.jam_masuk, attendance.status, attendance.tanggal_masuk,  schedule.id_workshift, workshift.clock_in, workshift.clock_out, employee.id_employee, employee.name');
		$this->db->from('attendance');
		$this->db->join('employee', 'employee.id_employee = attendance.id_employee', 'left');
		$this->db->join('schedule', 'schedule.id_schedule = attendance.id_schedule', 'left');
		$this->db->join('workshift', 'workshift.id_workshift = schedule.id_workshify', 'left');
		$this->db->order_by('attendance.tanggal_masuk', 'ASC');

		return $this->db->get()->result_array();
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_attendance', $id);
		return $this->db->update('attendance', $data);
	}


	public function delete($id)
	{
		return $this->db->delete('attendance', ['id_attendance' => $id]);
	}


	public function findByEmployeeId_get($id)
	{
		return $this->db->get_where('attendance', ['id_employee' => $id])->result_array();
	}


	public function findByEmployeeIdAtDate_get($id, $date)
	{
		return $this->db->get_where('attendance', ['id_employee' => $id, 'tanggal_masuk' => $date, 'status' => 2])->result_array();
	} 

	public function isAlreadyAbsence_get($id, $schedule)
	{
		return $this->db->get_where('attendance', ['id_employee' => $id, 'id_schedule' => $schedule, 'status' => 2])->row_array();
	}


	public function create_post($data)
	{
		if ($this->db->insert('attendance', $data)) {
			return true;
		} else {
			return false;
		}
	}


	private function _filterDATE($type)
	{
		switch ($type) {
			case 'today':
				$this->db->where('DATE(attendance.tanggal_masuk) = CURDATE()');
				break;
			case 'yesterday':
				$this->db->where('DATE(attendance.tanggal_masuk) = CURDATE() - INTERVAL 1 DAY');
				break;
			case 'this_week':
				$this->db->where('attendance.tanggal_masuk >=', date('Y-m-d', strtotime('monday this week')));
				$this->db->where('attendance.tanggal_masuk <=', date('Y-m-d', strtotime('sunday this week')));
				break;
			case 'last_week':
				$this->db->where('attendance.tanggal_masuk >=', date('Y-m-d', strtotime('monday last week')));
				$this->db->where('attendance.tanggal_masuk <=', date('Y-m-d', strtotime('sunday last week')));
				break;
			case 'this_month':
				$this->db->where('attendance.tanggal_masuk BETWEEN DATE_FORMAT(CURDATE(), "%Y-%m-01") AND LAST_DAY(CURDATE())');
				break;
			case 'last_month':
				$this->db->where('attendance.tanggal_masuk BETWEEN DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, "%Y-%m-01") AND LAST_DAY(CURDATE() - INTERVAL 1 MONTH)');
				break;
			case 'this_year':
				$this->db->where('attendance.tanggal_masuk BETWEEN DATE_FORMAT(CURDATE(), "%Y-01-01") AND CURDATE()');
				break;
			case 'last_year':
				$this->db->where('attendance.tanggal_masuk BETWEEN DATE_FORMAT(CURDATE() - INTERVAL 1 YEAR, "%Y-01-01") AND DATE_FORMAT(CURDATE() - INTERVAL 1 YEAR, "%Y-12-31")');
				break;
			case 'custom':
				$startDate = $this->input->post('startDate');
				$endDate = $this->input->post('endDate');
				if ($startDate && $endDate) {
					$this->db->where('attendance.tanggal_masuk >=', $startDate);
					$this->db->where('attendance.tanggal_masuk <=', $endDate);
				}
				break;
			default:
				break;
		}
	}


	public function getAttendanceDataCore_get()
	{

		$option = $this->input->post('option', true);
		$product = $this->input->post('product', true);
		$timeManagement = $this->input->post('timeManagement', true);

		$id = $this->input->post('employee', true);

		$this->db->select('attendance.id_attendance, attendance.id_employee, attendance.id_schedule,  attendance.jam_masuk, attendance.status, attendance.tanggal_masuk, attendance.time_management, attendance.potongan_telat,  schedule.id_workshift, schedule.waktu, workshift.clock_in, workshift.clock_out,  workshift.name_workshift, employee.id_employee, employee.name, employee.id_product, products.name_product');
		if($id != 'false') {
			$this->db->where('attendance.id_employee', $id);
		}
		if($timeManagement != 'all') {
			if($timeManagement == 'on_time') {
				$this->db->where('attendance.time_management', true);
			}
			else if($timeManagement == 'telat_masuk') {
				$this->db->where('attendance.time_management', false);
			}
		}
		if($product != '' || !empty($product)) {
			$this->db->where('employee.id_product', $product);
		}
		$this->db->from('attendance');
		$this->db->join('employee', 'employee.id_employee = attendance.id_employee', 'left');
		$this->db->join('schedule', 'schedule.id_schedule = attendance.id_schedule', 'left');
		$this->db->join('products', 'products.id_product = employee.id_product', 'left');
		$this->db->join('workshift', 'workshift.id_workshift = schedule.id_workshift', 'left');
		if(!empty($option) ){
			$this->_filterDATE($option);
		}


		$i = 0;
		foreach ($this->column_search as $item) {
			if (@$_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search) - 1 === $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by(key($this->order), $this->order[key($this->order)]);
		}


	}


	public function get_datatables()
	{
		$this->getAttendanceDataCore_get();
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}


	public function count_filtered()
	{
		$this->getAttendanceDataCore_get();
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function count_all()
	{
		$this->db->from('attendance');
		return $this->db->count_all_results();
	}


	public function setStatus_post($id, $status)
	{

		$this->db->set('status', $status);
		$this->db->where('id_attendance', $id);
		$this->db->update('attendance');

		return true;

	}

	public function anyAttendance_get($id){

			$this->db->select('*');
			$this->db->where('id_schedule', $id);
			$this->db->from('attendance');

			return $this->db->get()->row_array();

	}


	public function setPotongan_post($id, $potongan)
	{

		$this->db->set(['potongan_telat' => $potongan]);
		$this->db->where('id_attendance', $id);
		$this->db->update('attendance');

		return true;

	}


	public function totalTelatLastMonthToNowByEmployeeId_get($id, $tanggal, $tanggal2)
	{

		$this->db->select_sum('potongan_telat', 'total_telat');
		$this->db->where('id_employee', $id);
		$this->db->where('status', 2);
		$this->db->where('time_management', false);
		$this->db->where('tanggal_masuk >=', $tanggal2);
		$this->db->where('tanggal_masuk <=', $tanggal);
		$query = $this->db->get('attendance')->row();

		return $query->total_telat ?? 0;
	}

	public function deleteByScheduleNEmployee($id_schedule, $id_employee)
	{
		return $this->db->delete('attendance', ['id_schedule' => $id_schedule, 'id_employee' => $id_employee]);
	}

}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_schedule extends CI_Model
{

	private $column_search = array('schedule.id_schedule, schedule.id_employee, schedule.id_workshift, schedule.status, schedule.waktu, workshift.id_workshift, workshift.name_workshift, workshift.clock_in, workshift.clock_out, employee.id_employee, employee.name');
	private $column_order = array('schedule.id_schedule, schedule.id_employee, schedule.id_workshift, schedule.status, schedule.waktu, workshift.id_workshift, workshift.name_workshift, workshift.clock_in, workshift.clock_out, employee.id_employee, employee.name');
	private $order = array('schedule.waktu' => 'asc');

	public function findAll_get()
	{
		return $this->db->get('schedule')->result_array();
	}


	public function findById_get($id)
	{
		return $this->db->get_where('schedule', ['id_schedule' => $id])->row_array();
	}


	public function findByEmployeeId_get($id)
	{
		$this->db->select('schedule.id_schedule, schedule.id_employee, schedule.status, schedule.waktu, schedule.id_workshift, workshift.name_workshift, workshift.clock_in, workshift.clock_out');
		$this->db->where('schedule.id_employee', $id);
		$this->db->where('schedule.waktu >=', date('Y-m-01'));
		$this->db->where('schedule.waktu <=', date('Y-m-t'));
		$this->db->from('schedule');
		$this->db->join('workshift', 'workshift.id_workshift = schedule.id_workshift', 'left');
		return $this->db->get()->result_array();
	}


	public function findByEmployeeIdAndTimeSpecific_get($id, $year, $month)
	{
		$this->db->select('schedule.id_schedule, schedule.id_employee, schedule.status, schedule.waktu, schedule.id_workshift, workshift.name_workshift, workshift.clock_in, workshift.clock_out, attendance.jam_masuk');
		$this->db->from('schedule');
		$this->db->join('workshift', 'workshift.id_workshift = schedule.id_workshift', 'left');
		$this->db->join('attendance', 'attendance.id_schedule = schedule.id_schedule', 'left');
		$this->db->where('schedule.id_employee', $id);
		$this->db->where('YEAR(schedule.waktu)', $year);
		$this->db->where('MONTH(schedule.waktu)', $month);

		return $this->db->get()->result_array();
	}


	public function findScheduleToday_get($id, $today)
	{
		$this->db->select('schedule.id_schedule, schedule.id_employee, schedule.status, schedule.waktu, schedule.id_workshift, workshift.name_workshift, workshift.clock_in, workshift.clock_out, attendance.jam_masuk');
		$this->db->where('schedule.id_employee', $id);
		$this->db->where('schedule.waktu', $today);
		$this->db->from('schedule');
		$this->db->join('workshift', 'workshift.id_workshift = schedule.id_workshift', 'left');
		$this->db->join('attendance', 'attendance.id_schedule = schedule.id_schedule', 'left');
		return $this->db->get()->row_array();
	}


	public function findAllWithJoin_get()
	{
		$this->db->select('schedule.id_schedule, schedule.id_employee, schedule.id_workshift, schedule.status, schedule.waktu, workshift.id_workshift, workshift.name_workshift, workshift.clock_in, workshift.clock_out, employee.id_employee, employee.name_employee');
		$this->db->from('schedule');
		$this->db->join('employee', 'employee.id_employee = schedule.id_employee', 'left');
		$this->db->join('workshift', 'workshift.id_workshift = schedule.id_workshift', 'left');
		$this->db->order_by('schedule.waktu', 'ASC');

		return $this->db->get()->result_array();
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_schedule', $id);
		return $this->db->update('schedule', $data);
	}


	public function delete($id)
	{
		return $this->db->delete('schedule', ['id_schedule' => $id]);
	}


	public function findByEmplooyeeId_get($id)
	{
		return $this->db->get_where('schedule', ['id_employee' => $id])->result_array();
	}

	
	public function findByWorkshiftId_get($id)
	{
		return $this->db->get_where('schedule', ['id_workshift' => $id])->result_array();
	}


	public function create_post($data)
	{
		if ($this->db->insert('schedule', $data)) {
			return true;
		} else {
			return false;
		}
	}


	public function create_batch_post($data) 
	{
		return $this->db->insert_batch('schedule', $data);
	}


	private function _filterDATE($type)
	{
		switch ($type) {
			case 'today':
				$this->db->where('DATE(schedule.waktu) = CURDATE()');
				break;
			case 'tomorrow':
				$this->db->where('DATE(schedule.waktu) = DATE_ADD(CURDATE(), INTERVAL 1 DAY)');
				break;
			case 'this_week':
				$this->db->where('schedule.waktu >=', date('Y-m-d', strtotime('monday this week')));
				$this->db->where('schedule.waktu <=', date('Y-m-d', strtotime('sunday this week')));
				break;
			case 'next_week':
				$this->db->where('schedule.waktu >=', date('Y-m-d', strtotime('monday next week')));
				$this->db->where('schedule.waktu <=', date('Y-m-d', strtotime('sunday next week')));
				break;
			case 'this_month':
				$this->db->where('schedule.waktu >=', date('Y-m-01'));
				$this->db->where('schedule.waktu <=', date('Y-m-t'));
				break;
			case 'next_month':
				$this->db->where('schedule.waktu >=', date('Y-m-01', strtotime('+1 month')));
				$this->db->where('schedule.waktu <=', date('Y-m-t', strtotime('+1 month')));
				break;
			case 'this_year':
				$this->db->where('schedule.waktu >=', date('Y-01-01'));
				$this->db->where('schedule.waktu <=', date('Y-12-31'));
				break;
			case 'next_year':
				$this->db->where('schedule.waktu >=', date('Y-01-01', strtotime('+1 year')));
				$this->db->where('schedule.waktu <=', date('Y-12-31', strtotime('+1 year')));
				break;
			case 'custom':
				$startDate = $this->input->post('startDate');
				$endDate = $this->input->post('endDate');
				if ($startDate && $endDate) {
					$this->db->where('schedule.waktu >=', $startDate);
					$this->db->where('schedule.waktu <=', $endDate);
				}
				break;
			default:
				break;
		}
	}


	public function getScheduleDataCore_get()
	{

		$option = $this->input->post('option', true);
		$status_schedule = $this->input->post('status_schedule', true);
		$employee = $this->input->post('employee', true);

		$this->db->select('schedule.id_schedule, schedule.id_employee, schedule.id_workshift, schedule.status, schedule.waktu, workshift.id_workshift, workshift.name_workshift, workshift.clock_in, workshift.clock_out, employee.id_employee, employee.name, employee.id_product, products.name_product, employee.id_division, division.name_division, employee.id_position, position.name_position');
		if (!empty($status_schedule)) {
			$this->db->where('schedule.status', $status_schedule);
		}
		if (!empty($employee)) {
			$this->db->where('schedule.id_employee', $employee);
		}
		$this->db->from('schedule');
		$this->db->join('employee', 'employee.id_employee = schedule.id_employee', 'left');
		$this->db->join('products', 'products.id_product = employee.id_product', 'left');
		$this->db->join('position', 'position.id_position = employee.id_position', 'left');
		$this->db->join('division', 'division.id_division = employee.id_division', 'left');
		$this->db->join('workshift', 'workshift.id_workshift = schedule.id_workshift', 'left');
		if (!empty($option)) {
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
		$this->getScheduleDataCore_get();
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}


	public function count_filtered()
	{
		$this->getScheduleDataCore_get();
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function count_all()
	{
		$this->db->from('schedule');
		return $this->db->count_all_results();
	}


	public function setStatus_post($id, $tanggal, $status)
	{


		$this->db->set(['status' => $status]);

		$this->db->where('id_employee', $id);
		$this->db->where('waktu', $tanggal);
		$this->db->update('schedule');

		return true;
	}


	public function setStatusById_post($id, $status)
	{

		$this->db->set(['status' => $status]);

		$this->db->where('id_schedule', $id);
		$this->db->update('schedule');

		return true;
	}



	public function setStatusFromHolyday_post($idProduct, $idDivision, $tanggal, $status)
	{
		$this->db->set(['status' => $status]);
		$this->db->where("id_employee IN (SELECT id_employee FROM employee WHERE id_product = $idProduct AND id_division = $idDivision)", NULL, FALSE);
		$this->db->where('waktu', $tanggal);
		$this->db->update('schedule');

		return true;
	}


	public function mark_absent_if_no_checkin() {
		$currentDate = date('Y-m-d', strtotime('-1 day'));

		$this->db->where('status', 1);
		$this->db->where('waktu <=', $currentDate);
		$this->db->update('schedule', ['status' => 7]);

		return $this->db->affected_rows(); // Mengembalikan jumlah baris yang diupdate
	}
	

	public function totalAbsentLastMonthToNowByEmployeeId_get($id, $tanggal, $tanggal2)
	{
		$today = $tanggal;

		// $lastMonthDate = date('Y-m-d', strtotime('-1 month', strtotime($tanggal)));

		$count = $this->db
			->where('id_employee', $id)
			->where('status', 7)
			->where('waktu >=', $tanggal2)
			->where('waktu <=', $today)
			->count_all_results('schedule');

		return $count;
	}

	public function totalAttendance($id, $tanggal1, $tanggal2)
	{
		$count = $this->db
			->where('id_employee', $id)
			->where('status', 7)
			->where('waktu >=', $tanggal1)
			->where('waktu <=', $tanggal2)
			->count_all_results('schedule');

		return $count;
	}

	public function totalScheduleByStatus_get($id, $tanggal1, $tanggal2, $status)
	{
		$count = $this->db
			->where('id_employee', $id)
			->where('status', $status)
			->where('waktu >=', $tanggal1)
			->where('waktu <=', $tanggal2)
			->count_all_results('schedule');

		return $count;
	}


	public function totalScheduleByStatusV2_get($id,  $tanggal1, $tanggal2, $status)
	{
		$count = $this->db
			->where('id_employee', $id)
			->where('status', $status)
			->where('waktu >=', $tanggal2)
			->where('waktu <=', $tanggal1)
			->count_all_results('schedule');

		return $count;
	}

	public function totalScheduleByStatusForUangMakan_get($id, $type, $tanggal1, $status)
	{

		if($type == 'minggu') {
			$tanggal2 = date('Y-m-d', strtotime($tanggal1 . '-6 days'));
		} else if ($type == 'bulan') {
			$tanggal2 = date('Y-m-d', strtotime($tanggal1 . '-1 months'));
		}

		$count = $this->db
			->where('id_employee', $id)
			->where('status', $status)
			->where('waktu >=', $tanggal2)
			->where('waktu <=', $tanggal1)
			->count_all_results('schedule');

		return $count;
	}




	public function totalAbsentThisMonthByEmployeeId_get($id)
	{
		$currentMonth = date('m');

		$count = $this->db
			->where('id_employee', $id)
			->where('status', 7)
			->where('MONTH(waktu)', $currentMonth)
			->count_all_results('schedule');

		return $count;

	}

	public function totalAbsentByEmployeeId_get($id)
	{
		$currentYear = date('Y');

		$count = $this->db
			->where('id_employee', $id)
			->where('status', 7)
			->where('YEAR(waktu)', $currentYear)
			->count_all_results('schedule');

		return $count;
	}

}

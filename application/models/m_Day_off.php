<?php

defined('BASEPATH') or exit('No direct script access allowed');

class m_Day_off extends CI_Model
{

	private $column_search = array('day_off.id_day_off', 'day_off.id_employee', 'day_off.tgl_day_off', 'day_off.input_at', 'day_off.description', 'day_off.status', 'employee.id_employee', 'employee.name', 'employee.id_division', 'employee.id_product', 'division.id_division', 'division.name_division', 'products.id_product', 'products.name_product');
	private $column_order = array('day_off.id_day_off', 'day_off.id_employee', 'day_off.tgl_day_off', 'day_off.input_at', 'day_off.description', 'day_off.status', 'employee.id_employee', 'employee.name', 'employee.id_division', 'employee.id_product', 'division.id_division', 'division.name_division', 'products.id_product', 'products.name_product');
	private $order = array('day_off.tgl_day_off' => 'asc');

	public function findAll_get()
	{
		return $this->db->get('day_off')->result_array();
	}


	public function findById_get($id)
	{
		return $this->db->get_where('day_off', ['id_day_off' => $id])->row_array();
	}
	

	public function findAllWithJoin_get()
	{
		$this->db->select('day_off.id_day_off, day_off.id_employee, day_off.tgl_day_off, day_off.input_at, day_off.description, day_off.status, employee.id_employee, employee.name, employee.id_division, employee.id_product, division.id_division, division.name_division, products.id_product, products.name_product');
		$this->db->from('day_off');
		$this->db->join('employee', 'employee.id_employee = day_off.id_employee', 'left');
		$this->db->join('division', 'division.id_division = employee.id_division', 'left');
		$this->db->join('products', 'products.id_product = employee.id_product', 'left');
		$this->db->order_by('day_off.tgl_day_off', 'ASC');


		return $this->db->get()->result_array();
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_day_off', $id);
		return $this->db->update('day_off', $data);
	}



	public function delete($id)
	{
		return $this->db->delete('day_off', ['id_day_off' => $id]);
	}


	public function findByEmployeeId_get($id)
	{
		return $this->db->get_where('day_off', ['id_employee' => $id])->result_array();
	}


	public function findByEmployeeIdAtDate_get($id, $date)
	{
		return $this->db->get_where('day_off', ['id_employee' => $id, 'tgl_day_off' => $date, 'status' => 2])->result_array();
	}


	public function create_post($data)
	{
		if ($this->db->insert('day_off', $data)) {
			return true;
		} else {
			return false;
		}
	}

	private function _filterDATE($type)
	{
		switch ($type) {
			case 'today':
				$this->db->where('DATE(day_off.tgl_day_off) = CURDATE()');
				break;
			case 'tomorrow':
				$this->db->where('DATE(day_off.tgl_day_off) = DATE_ADD(CURDATE(), INTERVAL 1 DAY)');
				break;
			case 'this_week':
				$this->db->where('day_off.tgl_day_off >=', date('Y-m-d', strtotime('monday this week')));
				$this->db->where('day_off.tgl_day_off <=', date('Y-m-d', strtotime('sunday this week')));
				break;
			case 'next_week':
				$this->db->where('day_off.tgl_day_off >=', date('Y-m-d', strtotime('monday next week')));
				$this->db->where('day_off.tgl_day_off <=', date('Y-m-d', strtotime('sunday next week')));
				break;
			case 'this_month':
				$this->db->where('day_off.tgl_day_off >=', date('Y-m-01'));
				$this->db->where('day_off.tgl_day_off <=', date('Y-m-t'));
				break;
			case 'next_month':
				$this->db->where('day_off.tgl_day_off >=', date('Y-m-01', strtotime('+1 month')));
				$this->db->where('day_off.tgl_day_off <=', date('Y-m-t', strtotime('+1 month')));
				break;
			case 'this_year':
				$this->db->where('day_off.tgl_day_off >=', date('Y-01-01'));
				$this->db->where('day_off.tgl_day_off <=', date('Y-12-31'));
				break;
			case 'next_year':
				$this->db->where('day_off.tgl_day_off >=', date('Y-01-01', strtotime('+1 year')));
				$this->db->where('day_off.tgl_day_off <=', date('Y-12-31', strtotime('+1 year')));
				break;
			case 'custom':
				$startDate = $this->input->post('startDate');
				$endDate = $this->input->post('endDate');
				if ($startDate && $endDate) {
					$this->db->where('day_off.tgl_day_off >=', $startDate);
					$this->db->where('day_off.tgl_day_off <=', $endDate);
				}
				break;
			default:
				break;
		}
	}


	public function getDayoffDataCore_get()
	{

		$option = $this->input->post('option', true);
		$status_day_off = $this->input->post('status_day_off', true);
		$id = $this->input->post('employee', true);
		$product = $this->input->post('product', true);


		if (!empty($status_day_off)) {
			$this->db->select('day_off.id_day_off, day_off.id_employee, day_off.tgl_day_off, day_off.input_at, day_off.description, day_off.status, employee.id_employee, employee.name, employee.id_division, employee.id_product, division.id_division, division.name_division, products.id_product, products.name_product');
			$this->db->where('day_off.status', $status_day_off);
			if($id != 'false') {
				$this->db->where('day_off.id_employee', $id);
			}
			$this->db->from('day_off');
			$this->db->join('employee', 'employee.id_employee = day_off.id_employee', 'left');
			$this->db->join('division', 'division.id_division = employee.id_division', 'left');
			$this->db->join('products', 'products.id_product = employee.id_product', 'left');
			if (!empty($option)) {
				$this->_filterDATE($option);
			}
			if(!empty($product) && $product != 'all'){
				$this->db->where('employee.id_product', $product);
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


	}


	public function get_datatables()
	{
		$this->getDayoffDataCore_get();
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}


	public function count_filtered()
	{
		$this->getDayoffDataCore_get();
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function count_all()
	{
		$this->db->from('day_off');
		return $this->db->count_all_results();
	}


	public function setStatus_post($id, $status)
	{

		$this->db->set('status', $status);
		$this->db->where('id_day_off', $id);
		$this->db->update('day_off');

		return true;

	}


	public function totalDayOffByEmployeeId_get($id)
	{
		$currentYear = date('Y');

		$count = $this->db
			->where('id_employee', $id)
			->where('status', 2)
			->where('YEAR(tgl_day_off)', $currentYear)
			->count_all_results('day_off');


		return $count;
	}


	public function totalDayOffThisMonthByEmployeeId_get($id)
	{
		$currentMonth = date('m');

		$count = $this->db
			->where('id_employee', $id)
			->where('status', 2)
			->where('MONTH(tgl_day_off)', $currentMonth)
			->count_all_results('day_off');


		return $count;
	}


	public function totalDayOffLastMonthToNowByEmployeeId_get($id, $tanggal)
	{

		$today = $tanggal;


		$lastMonthDate = date('Y-m-d', strtotime('-1 month', strtotime($tanggal)));

		$count = $this->db
			->where('id_employee', $id)
			->where('status', 2)
			->where('tgl_day_off >=', $lastMonthDate)
			->where('tgl_day_off <=', $today)
			->count_all_results('day_off');

		return $count;
	}

	public function totalAttendance($id, $tanggal1, $tanggal2)
	{

		$count = $this->db
			->where('id_employee', $id)
			->where('status', 2)
			->where('tgl_day_off >=', $tanggal1)
			->where('tgl_day_off <=', $tanggal2)
			->count_all_results('day_off');

		return $count;
	}

	public function totalDayOff_get()
	{
		$currentYear = date('Y');

		$count = $this->db
			->where('status', 2)
			->where('YEAR(tgl_day_off)', $currentYear)
			->count_all_results('day_off');


		return $count;
	}
	public function totalDayOffThisMonth_get()
	{
		$currentYear = date('m');

		$count = $this->db
			->where('status', 2)
			->where('MONTH(tgl_day_off)', $currentYear)
			->count_all_results('day_off');


		return $count;
	}

}

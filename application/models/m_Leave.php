
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class m_Leave extends CI_Model
{

	private $column_search = array('cuti.id_cuti', 'cuti.id_employee', 'cuti.total_days', 'cuti.input_at', 'cuti.start_day', 'cuti.description', 'cuti.end_day', 'cuti.type', 'cuti.status', 'employee.id_employee', 'employee.name', 'employee.id_division', 'employee.id_product', 'division.id_division', 'division.name_division', 'products.id_product', 'products.name_product');
	private $column_order = array('cuti.id_cuti', 'cuti.id_employee', 'cuti.total_days', 'cuti.input_at', 'cuti.start_day', 'cuti.description', 'cuti.end_day', 'cuti.type', 'cuti.status', 'employee.id_employee', 'employee.name', 'employee.id_division', 'employee.id_product', 'division.id_division', 'division.name_division', 'products.id_product', 'products.name_product');
	private $order = array('cuti.start_day' => 'asc');

	public function findAll_get()
	{
		return $this->db->get('cuti')->result_array();
	}


	public function findById_get($id)
	{
		return $this->db->get_where('cuti', ['id_cuti' => $id])->row_array();
	}


	public function findAllWithJoin_get()
	{
		$this->db->select('cuti.id_cuti, cuti.id_employee, cuti.total_days, cuti.input_at, cuti.start_day, cuti.description, cuti.end_day, cuti.type, cuti.status, employee.id_employee, employee.name, employee.id_division, employee.id_product, division.id_division, division.name_division, products.id_product, products.name_product');
		$this->db->from('cuti');
		$this->db->join('employee', 'employee.id_employee = cuti.id_employee', 'left');
		$this->db->join('division', 'division.id_division = employee.id_division', 'left');
		$this->db->join('products', 'products.id_product = employee.id_product', 'left');
		$this->db->order_by('cuti.tanggal', 'ASC');


		return $this->db->get()->result_array();
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_cuti', $id);
		return $this->db->update('cuti', $data);
	}


	public function delete($id)
	{
		return $this->db->delete('cuti', ['id_cuti' => $id]);
	}


	public function findByEmployeeId_get($id)
	{
		return $this->db->get_where('cuti', ['id_employee' => $id])->result_array();
	}

	public function findByEmployeeIdAtDate_get($id, $date)
	{
		$this->db->from('cuti');
		$this->db->where('id_employee', $id);
		$this->db->where('status', 2);


		$this->db->group_start();
		$this->db->where('start_day =', $date);
		$this->db->or_where('end_day =', $date);
		$this->db->group_end();
		return $this->db->get()->result_array();
	}


	public function create_post($data)
	{
		if ($this->db->insert('cuti', $data)) {
			return true;
		} else {
			return false;
		}
	}


	private function _filterDATE($type)
	{
		switch ($type) {
			case 'today':
				$this->db->where('DATE(cuti.start_day) = CURDATE()');
				break;
			case 'tomorrow':
				$this->db->where('DATE(cuti.start_day) = DATE_ADD(CURDATE(), INTERVAL 1 DAY)');
				break;
			case 'this_week':
				$this->db->where('cuti.start_day >=', date('Y-m-d', strtotime('monday this week')));
				$this->db->where('cuti.start_day <=', date('Y-m-d', strtotime('sunday this week')));
				break;
			case 'next_week':
				$this->db->where('cuti.start_day >=', date('Y-m-d', strtotime('monday next week')));
				$this->db->where('cuti.start_day <=', date('Y-m-d', strtotime('sunday next week')));
				break;
			case 'this_month':
				$this->db->where('cuti.start_day >=', date('Y-m-01'));
				$this->db->where('cuti.start_day <=', date('Y-m-t'));
				break;
			case 'next_month':
				$this->db->where('cuti.start_day >=', date('Y-m-01', strtotime('+1 month')));
				$this->db->where('cuti.start_day <=', date('Y-m-t', strtotime('+1 month')));
				break;
			case 'this_year':
				$this->db->where('cuti.start_day >=', date('Y-01-01'));
				$this->db->where('cuti.start_day <=', date('Y-12-31'));
				break;
			case 'next_year':
				$this->db->where('cuti.start_day >=', date('Y-01-01', strtotime('+1 year')));
				$this->db->where('cuti.start_day <=', date('Y-12-31', strtotime('+1 year')));
				break;
			case 'custom':
				$startDate = $this->input->post('startDate');
				$endDate = $this->input->post('endDate');
				if ($startDate && $endDate) {
					$this->db->where('cuti.start_day >=', $startDate);
					$this->db->where('cuti.start_day <=', $endDate);
				}
				break;
			default:
				break;
		}
	}


	public function getLeaveDataCore_get()
	{

		$option = $this->input->post('option', true);
		$status_leave = $this->input->post('status_leave', true);
		$id = $this->input->post('employee', true);
		$product = $this->input->post('product', true);


		if (!empty($status_leave)) {
			$this->db->select('cuti.id_cuti, cuti.id_employee, cuti.total_days, cuti.input_at, cuti.start_day, cuti.description, cuti.end_day, cuti.type, cuti.status, employee.id_employee, employee.name, employee.id_division, employee.id_product, division.id_division, division.name_division, products.id_product, products.name_product');
			$this->db->where('cuti.status', $status_leave);
			if($id != 'false') {
				$this->db->where('cuti.id_employee', $id);
			}
			$this->db->from('cuti');
			$this->db->join('employee', 'employee.id_employee = cuti.id_employee', 'left');
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
		$this->getLeaveDataCore_get();
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}


	public function count_filtered()
	{
		$this->getLeaveDataCore_get();
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function count_all()
	{
		$this->db->from('cuti');
		return $this->db->count_all_results();
	}


	public function setStatus_post($id, $status)
	{

		$this->db->set('status', $status);
		$this->db->where('id_cuti', $id);
		$this->db->update('cuti');

		return true;

	}


	public function totalLeaveByEmployeeId_get($id)
	{
		$currentYear = date('Y');

		$count = $this->db
			->where('id_employee', $id)
			->where('status', 2)
			->where('YEAR(start_day)', $currentYear)
			->count_all_results('cuti');
		$count2 = $this->db
			->where('id_employee', $id)
			->where('status', 2)
			->where('YEAR(end_day)', $currentYear)
			->count_all_results('cuti');

		return $count + $count2;
	}


	public function totalLeaveThisMonthByEmployeeId_get($id)
	{
		$currentMonth = date('m');

		$count = $this->db
			->where('id_employee', $id)
			->where('status', 2)
			->where('MONTH(start_day)', $currentMonth)
			->count_all_results('cuti');
		$count2 = $this->db
			->where('id_employee', $id)
			->where('status', 2)
			->where('MONTH(end_day)', $currentMonth)
			->count_all_results('cuti');

		return $count + $count2;
	}


	public function totalLeaveLastMonthToNowByEmployeeId_get($id, $tanggal, $tanggal2)
	{
		

		$this->db->where('id_employee', $id);
		$this->db->where('status', 2);
		$this->db->where('(start_day BETWEEN "'.$tanggal2.'" AND "'.$tanggal.'" OR end_day BETWEEN "'.$tanggal2.'" AND "'.$tanggal.'")');

		return $this->db->count_all_results('cuti');
	}


	public function totalAttendance($id, $tanggal1, $tanggal2)
	{

		$this->db->where('id_employee', $id);
		$this->db->where('status', 2);
		$this->db->where('(start_day BETWEEN "'.$tanggal1.'" AND "'.$tanggal2.'" OR end_day BETWEEN "'.$tanggal1.'" AND "'.$tanggal2.'")');

		return $this->db->count_all_results('cuti');
	}

	public function totalLeave_get()
	{
		$currentYear = date('Y');

		$count = $this->db
			->where('status', 2)
			->where('YEAR(start_day)', $currentYear)
			->count_all_results('cuti');
		$count2 = $this->db
			->where('status', 2)
			->where('YEAR(end_day)', $currentYear)
			->count_all_results('cuti');

		return $count + $count2;
	}


	public function totalLeaveThisMonth_get()
	{
		$currentMonth = date('m');

		$count = $this->db
			->where('status', 2)
			->where('MONTH(start_day)', $currentMonth)
			->count_all_results('cuti');
		$count2 = $this->db
			->where('status', 2)
			->where('MONTH(end_day)', $currentMonth)
			->count_all_results('cuti');

		return $count + $count2;
	}



}

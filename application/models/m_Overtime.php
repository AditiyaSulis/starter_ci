<?php

defined('BASEPATH') or exit('No direct script access allowed');

class m_Overtime extends CI_Model
{

	private $column_search = array('overtime.id_overtime', 'overtime.id_employee', 'overtime.tanggal', 'overtime.input_at', 'overtime.pay','overtime.time_spend', 'overtime.start', 'overtime.description', 'overtime.end', 'overtime.status', 'employee.id_employee', 'employee.name', 'employee.id_division', 'employee.id_product', 'division.id_division', 'division.name_division', 'products.id_product', 'products.name_product');
	private $column_order = array('overtime.id_overtime', 'overtime.id_employee', 'overtime.tanggal', 'overtime.input_at', 'overtime.pay','overtime.time_spend', 'overtime.start', 'overtime.description', 'overtime.end', 'overtime.status', 'employee.id_employee', 'employee.name', 'employee.id_division', 'employee.id_product', 'division.id_division', 'division.name_division', 'products.id_product', 'products.name_product');
	private $order = array('overtime.tanggal' => 'asc');

	public function findAll_get()
	{
		return $this->db->get('overtime')->result_array();
	}


	public function findById_get($id)
	{
		return $this->db->get_where('overtime', ['id_overtime' => $id])->row_array();
	}


	public function findAllWithJoin_get()
	{
		$this->db->select('overtime.id_overtime, overtime.id_employee, overtime.tanggal, overtime.input_at, overtime.pay, overtime.time_spend, overtime.start, overtime.description, overtime.end, overtime.status, employee.id_employee, employee.name, employee.id_division, employee.id_product, division.id_division, division.name_division, products.id_product, products.name_product');
		$this->db->from('overtime');
		$this->db->join('employee', 'employee.id_employee = overtime.id_employee', 'left');
		$this->db->join('division', 'division.id_division = employee.id_division', 'left');
		$this->db->join('products', 'products.id_product = employee.id_product', 'left');
		$this->db->order_by('overtime.tanggal', 'ASC');


		return $this->db->get()->result_array();
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_overtime', $id);
		return $this->db->update('overtime', $data);
	}


	public function delete($id)
	{
		return $this->db->delete('overtime', ['id_overtime' => $id]);
	}


	public function findByEmplooyeeId_get($id)
	{
		return $this->db->get_where('overtime', ['id_employee' => $id])->result_array();
	}


	public function create_post($data)
	{
		if ($this->db->insert('overtime', $data)) {
			return true;
		} else {
			return false;
		}
	}

	
	public function create_batch_post($data)
	{
		return $this->db->insert_batch('overtime', $data);
	}


	private function _filterDATE($type)
	{
		switch ($type) {
			case 'today':
				$this->db->where('DATE(overtime.tanggal) = CURDATE()');
				break;
			case 'tomorrow':
				$this->db->where('DATE(overtime.tanggal) = DATE_ADD(CURDATE(), INTERVAL 1 DAY)');
				break;
			case 'this_week':
				$this->db->where('overtime.tanggal >=', date('Y-m-d', strtotime('monday this week')));
				$this->db->where('overtime.tanggal <=', date('Y-m-d', strtotime('sunday this week')));
				break;
			case 'next_week':
				$this->db->where('overtime.tanggal >=', date('Y-m-d', strtotime('monday next week')));
				$this->db->where('overtime.tanggal <=', date('Y-m-d', strtotime('sunday next week')));
				break;
			case 'this_month':
				$this->db->where('overtime.tanggal >=', date('Y-m-01'));
				$this->db->where('overtime.tanggal <=', date('Y-m-t'));
				break;
			case 'next_month':
				$this->db->where('overtime.tanggal >=', date('Y-m-01', strtotime('+1 month')));
				$this->db->where('overtime.tanggal <=', date('Y-m-t', strtotime('+1 month')));
				break;
			case 'this_year':
				$this->db->where('overtime.tanggal >=', date('Y-01-01'));
				$this->db->where('overtime.tanggal <=', date('Y-12-31'));
				break;
			case 'next_year':
				$this->db->where('overtime.tanggal >=', date('Y-01-01', strtotime('+1 year')));
				$this->db->where('overtime.tanggal <=', date('Y-12-31', strtotime('+1 year')));
				break;
			case 'custom':
				$startDate = $this->input->post('startDate');
				$endDate = $this->input->post('endDate');
				if ($startDate && $endDate) {
					$this->db->where('overtime.tanggal >=', $startDate);
					$this->db->where('overtime.tanggal <=', $endDate);
				}
				break;
			default:
				break;
		}
	}


	public function getOvertimeDataCore_get()
	{

		$option = $this->input->post('option', true);
		$status_overtime = $this->input->post('status_overtime', true);
		$id = $this->input->post('employee', true);
		$product = $this->input->post('product', true);


		if (!empty($status_overtime)) {
			$this->db->select('overtime.id_overtime, overtime.id_employee, overtime.tanggal, overtime.input_at, overtime.pay, overtime.time_spend, overtime.start, overtime.description, overtime.end, overtime.status, employee.id_employee, employee.name, employee.id_division, employee.id_product, division.id_division, division.name_division, products.id_product, products.name_product');
			$this->db->where('overtime.status', $status_overtime);
			if($id != 'false') {
				$this->db->where('overtime.id_employee', $id);
			}
			$this->db->from('overtime');
			$this->db->join('employee', 'employee.id_employee = overtime.id_employee', 'left');
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
		$this->getOvertimeDataCore_get();
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}


	public function count_filtered()
	{
		$this->getOvertimeDataCore_get();
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function count_all()
	{
		$this->db->from('overtime');
		return $this->db->count_all_results();
	}


	public function setStatus_post($id, $status, $pay)
	{

		$this->db->set(['status' => $status, 'pay' => $pay]);
		$this->db->where('id_overtime', $id);
		$this->db->update('overtime');

		return true;

	}


	public function totalOvertimeLastMonthToNowByEmployeeId_get($id, $tanggal)
	{
		$lastMonthDate = date('Y-m-d', strtotime('-1 month', strtotime($tanggal)));

		$this->db->select_sum('pay', 'total_overtime');
		$this->db->where('id_employee', $id);
		$this->db->where('status', 2);
		$this->db->where('tanggal >=', $lastMonthDate);
		$this->db->where('tanggal <=', $tanggal);
		$query = $this->db->get('overtime')->row();

		return $query->total_overtime ?? 0;
	}


	public function totalOvertime_get()
	{
		$curentDate = date('Y');

		$this->db->select_sum('time_spend', 'total_overtime');
		$this->db->where('status', 2);
		$this->db->where('YEAR(tanggal)', $curentDate);
		$query = $this->db->get('overtime')->row();

		return $query->total_overtime ?? 0;
	}


	public function totalOvertimeThisMonth_get()
	{
		$curentDate = date('m');

		$this->db->select_sum('time_spend', 'total_overtime');
		$this->db->where('status', 2);
		$this->db->where('MONTH(tanggal)', $curentDate);
		$query = $this->db->get('overtime')->row();

		return $query->total_overtime ?? 0;
	}
	

}

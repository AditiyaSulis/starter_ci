<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_holyday extends CI_Model
{

	private $column_search = array('holyday.id_product', 'holyday.date', 'holyday.code_holyday', 'holyday.type_day', 'division.id_division', 'division.name_division', 'products.id_product', 'products.name_product');
	private $column_order = array('holyday.id_holyday', 'holyday.id_division', 'holyday.id_product', 'holyday.start_day', 'holyday.date', 'holyday.code_holyday',  'holyday.type_group', 'holyday.type_day', 'holyday.end_day', 'division.id_division', 'division.name_division', 'products.id_product', 'products.name_product');
	private $order = array('holyday.start_day' => 'asc');

	public function findAll_get()
	{
		return $this->db->get('holyday')->result_array();
	}


	public function findById_get($id)
	{
		return $this->db->get_where('holyday', ['id_holyday' => $id])->row_array();
	} 

	public function findByCode_get($code)
	{
		return $this->db->get_where('holyday', ['code_holyday' => $code])->result_array();
	}

	public function findAllWithJoin_get()
	{
		$this->db->select('holyday.id_holyday, holyday.id_division, holyday.id_product, holyday.start_day, holyday.type_group, holyday.date, holyday.status_day, holyday.code_holyday, holyday.type_day, holyday.end_day, division.id_division, division.name_division, products.id_product, products.name_product');
		$this->db->from('holyday');
		$this->db->join('division', 'division.id_division = holyday.id_division', 'left');
		$this->db->join('products', 'products.id_product = holyday.id_product', 'left');
		$this->db->order_by('holyday.start_day', 'ASC');


		return $this->db->get()->result_array();
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_holyday', $id);
		return $this->db->update('holyday', $data);
	}


	public function delete($id)
	{
		return $this->db->delete('holyday', ['id_holyday' => $id]);
	}
	

	public function findByEmplooyeeId_get($id)
	{
		return $this->db->get_where('holyday', ['id_employee' => $id])->result_array();
	}


	public function findByProductNDivisionIdAtDate_get($id, $division, $date)
	{
		return $this->db->get_where('holyday', ['id_product' => $id, 'id_division' => $division, 'date' => $date, 'status_day' => 1])->result_array();
	}
	

	public function isSunday_get($id, $division, $date)
	{
		return $this->db->get_where('holyday', ['id_product' => $id, 'id_division' => $division, 'date' => $date, 'status_day' => 2])->result_array();
	}


	private function _filterDATE($type)
	{
		switch ($type) {
			case 'today':
				$this->db->where('DATE(holyday.date) = CURDATE()');
				break;
			case 'tomorrow':
				$this->db->where('DATE(holyday.date) = DATE_ADD(CURDATE(), INTERVAL 1 DAY)');
				break;
			case 'this_week':
				$this->db->where('holyday.date >=', date('Y-m-d', strtotime('monday this week')));
				$this->db->where('holyday.date <=', date('Y-m-d', strtotime('sunday this week')));
				break;
			case 'next_week':
				$this->db->where('holyday.date >=', date('Y-m-d', strtotime('monday next week')));
				$this->db->where('holyday.date <=', date('Y-m-d', strtotime('sunday next week')));
				break;
			case 'this_month':
				$this->db->where('holyday.date >=', date('Y-m-01'));
				$this->db->where('holyday.date <=', date('Y-m-t'));
				break;
			case 'next_month':
				$this->db->where('holyday.date >=', date('Y-m-01', strtotime('+1 month')));
				$this->db->where('holyday.date <=', date('Y-m-t', strtotime('+1 month')));
				break;
			case 'this_year':
				$this->db->where('holyday.date >=', date('Y-01-01'));
				$this->db->where('holyday.date <=', date('Y-12-31'));
				break;
			case 'next_year':
				$this->db->where('holyday.date >=', date('Y-01-01', strtotime('+1 year')));
				$this->db->where('holyday.date <=', date('Y-12-31', strtotime('+1 year')));
				break;
			case 'custom':
				$startDate = $this->input->post('startDate');
				$endDate = $this->input->post('endDate');
				if ($startDate && $endDate) {
					$this->db->where('holyday.date >=', $startDate);
					$this->db->where('holyday.date <=', $endDate);
				}
				break;
			default:
				break;
		}
	}

	public function getHolydayDataCore_get()
	{

		$option = $this->input->post('option', true);
		$product = $this->input->post('product', true);

		$this->db->select('holyday.id_holyday, holyday.id_division, holyday.id_product, holyday.start_day, holyday.type_group, holyday.type_day, holyday.date, holyday.status_day, holyday.code_holyday, holyday.end_day, division.id_division, division.name_division, products.id_product, products.name_product');
		$this->db->from('holyday');
		$this->db->join('division', 'division.id_division = holyday.id_division', 'left');
		$this->db->join('products', 'products.id_product = holyday.id_product', 'left');
		if (!empty($option)) {
			$this->_filterDATE($option);
		}
		if(!empty($product) && $product != 'all'){
			$this->db->where('holyday.id_product', $product);
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
		$this->getHolydayDataCore_get();
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_filtered()
	{
		$this->getHolydayDataCore_get();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from('holyday');
		return $this->db->count_all_results();
	}

	public function create_post($data, $products, $divisions, $typeGroup) {

		if($typeGroup == 1 || $typeGroup == 3) {
			foreach ($products as $product) {
				$data['id_product'] = $product['id_product'];
				foreach ($divisions as $division) {
					$data['id_division'] = $division['id_division'];
					$this->db->insert('holyday', $data);
				}

			}
		} else if ($typeGroup == 2) {
			foreach ($divisions as $division) {
				$data['id_division'] = $division['id_division'];
				foreach ($products as $product) {
					$data['id_product'] = $product['id_product'];
					$this->db->insert('holyday', $data);
				}

			}
		}


		return true;
	}

	public function create_batch_post($data)
	{
		if ($this->db->insert_batch('holyday', $data)) {
			return true;
		} else {
			return false;
		}
	}

	public function totalHolydayLastMonthToNowByEmployeeId_get($id, $tanggal, $tanggal2)
	{
		$today = $tanggal;

		$count = $this->db
			->where('id_employee', $id)
			->where('status', 3)
			->where('waktu >=', $tanggal2)
			->where('waktu <=', $today)
			->count_all_results('schedule');

		return $count;
	}


}

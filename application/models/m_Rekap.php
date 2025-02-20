<?php

defined('BASEPATH') or exit('No direct script access allowed');

class m_Rekap extends CI_Model
{

	private $column_search = array('employee.id_employee', 'employee.name', 'employee.id_product', 'products.name_product', 'employee.id_division', 'division.name_division', 'employee.id_position', 'position.name_position');
	private $column_order = array('employee.id_employee', 'employee.name', 'employee.id_product', 'products.name_product', 'employee.id_division', 'division.name_division', 'employee.id_position', 'position.name_position');
	private $order = array('products.name_product' => 'asc');



	public function getScheduleDataCore_get()
	{
		$employee = $this->input->post('employee', true);
		$product = $this->input->post('product', true);

		$this->db->select('employee.id_employee, employee.name, employee.id_product, products.name_product, employee.id_division, division.name_division, employee.id_position, position.name_position');
		if (!empty($product)) {
			$this->db->where('employee.id_product', $product);
		}
		if (!empty($employee)) {
			$this->db->where('employee.id_employee', $employee);
		}

		$this->db->from('employee');
		$this->db->join('position', 'position.id_position = employee.id_position', 'left');
		$this->db->join('division', 'division.id_division = employee.id_division', 'left');
		$this->db->join('products', 'products.id_product = employee.id_product', 'left');


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
		$this->db->from('employee');
		return $this->db->count_all_results();
	}



}

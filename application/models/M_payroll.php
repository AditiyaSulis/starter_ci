<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_payroll extends CI_Model
{

	private $column_search = array('payroll.id_payroll','payroll.code_payroll', 'payroll.input_at','payroll.total_salary', 'payroll.code_payroll', 'payroll.total_employee', 'payroll.include_piutang', 'payroll.include_finance_record','payroll.include_holiday', 'payroll_component.id_payroll', 'payroll_component.tanggal_gajian', );
	private $column_order = array('payroll.id_payroll','payroll.code_payroll', 'payroll.input_at','payroll.total_salary', 'payroll.code_payroll', 'payroll.total_employee', 'payroll.include_piutang', 'payroll.include_finance_record','payroll.include_holiday', 'payroll_component.id_payroll', 'payroll_component.tanggal_gajian');
	private $order = array('payroll.input_at' => 'asc');

	public function findAll_get()
	{
		return $this->db->get('payroll')->result_array();
	}


	public function findById_get($id)
	{
		return $this->db->get_where('payroll', ['id_payroll' => $id])->row_array();
	}

	public function findAllWithJoin_get()
	{
		$this->db->select('payroll.id_payroll','payroll.code_payroll', 'payroll.input_at','payroll.total_salary', 'payroll.code_payroll', 'payroll.total_employee','payroll_component.id_payroll', 'payroll_component.tanggal_gajian');
		$this->db->from('payroll');
		$this->db->join('payroll_component', 'payroll_component.id_payroll = payroll.id_payroll', 'left');
		$this->db->order_by('payroll.input_at', 'ASC');


		return $this->db->get()->result_array();
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_payroll', $id);
		return $this->db->update('payroll', $data);
	}


	public function delete($id)
	{
		return $this->db->delete('payroll', ['id_payroll' => $id]);
	}

	public function findByPayrollComponentId_get($id)
	{
		return $this->db->get_where('payroll', ['id_payroll_component' => $id])->result_array();
	}

	private function _filterDATE($type)
	{
		switch ($type) {
			case 'today':
				$this->db->where('DATE(payroll.input_at) = CURDATE()');
				break;
			case 'tomorrow':
				$this->db->where('DATE(payroll.input_at) = DATE_ADD(CURDATE(), INTERVAL 1 DAY)');
				break;
			case 'this_week':
				$this->db->where('payroll.input_at >=', date('Y-m-d', strtotime('monday this week')));
				$this->db->where('payroll.input_at <=', date('Y-m-d', strtotime('sunday this week')));
				break;
			case 'next_week':
				$this->db->where('payroll.input_at >=', date('Y-m-d', strtotime('monday next week')));
				$this->db->where('payroll.input_at <=', date('Y-m-d', strtotime('sunday next week')));
				break;
			case 'this_month':
				$this->db->where('payroll.input_at >=', date('Y-m-01'));
				$this->db->where('payroll.input_at <=', date('Y-m-t'));
				break;
			case 'next_month':
				$this->db->where('payroll.input_at >=', date('Y-m-01', strtotime('+1 month')));
				$this->db->where('payroll.input_at <=', date('Y-m-t', strtotime('+1 month')));
				break;
			case 'this_year':
				$this->db->where('payroll.input_at >=', date('Y-01-01'));
				$this->db->where('payroll.input_at <=', date('Y-12-31'));
				break;
			case 'next_year':
				$this->db->where('payroll.input_at >=', date('Y-01-01', strtotime('+1 year')));
				$this->db->where('payroll.input_at <=', date('Y-12-31', strtotime('+1 year')));
				break;
			case 'custom':
				$startDate = $this->input->post('startDate');
				$endDate = $this->input->post('endDate');
				if ($startDate && $endDate) {
					$this->db->where('payroll.input_at >=', $startDate);
					$this->db->where('payroll.input_at <=', $endDate);
				}
				break;
			default:
				break;
		}
	}

	public function getPayrollDataCore_get()
	{

		$option = $this->input->post('option', true);

		$this->db->select('payroll.id_payroll, payroll.code_payroll, payroll.input_at, payroll.total_salary, payroll.include_piutang, payroll.include_finance_record,payroll.include_holiday,  payroll.total_employee, MAX(payroll_component.tanggal_gajian) AS tanggal_gajian');
		$this->db->from('payroll');
		$this->db->join('payroll_component', 'payroll_component.id_payroll = payroll.id_payroll', 'left');
		$this->db->group_by('payroll.id_payroll');
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
		$this->getPayrollDataCore_get();
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_filtered()
	{
		$this->getPayrollDataCore_get();
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function count_all()
	{
		$this->db->from('payroll');
		return $this->db->count_all_results();
	}


	public function create_post($data)
	{
		if ($this->db->insert('payroll', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}



}

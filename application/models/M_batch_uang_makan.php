<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_batch_uang_makan extends CI_Model
{

	private $column_search = array('batch_uang_makan.code_batch_uang_makan','batch_uang_makan.auto_finance_record', 'batch_uang_makan.total_uang_makan','batch_uang_makan.total_employee', 'batch_uang_makan.tanggal_batch_uang_makan', 'batch_uang_makan.tanggal_batch_uang_makan');
	private $column_order = array('batch_uang_makan.code_batch_uang_makan','batch_uang_makan.auto_finance_record', 'batch_uang_makan.total_uang_makan','batch_uang_makan.total_employee', 'batch_uang_makan.tanggal_batch_uang_makan' ,'batch_uang_makan.tanggal_batch_uang_makan');
	private $order = array('batch_uang_makan.tanggal_batch_uang_makan' => 'asc');


	public function findAll_get()
	{
		return $this->db->get('batch_uang_makan')->result_array();
	}


	public function findById_get($id)
	{
		return $this->db->get_where('batch_uang_makan', ['id_batch_uang_makan' => $id])->row_array();
	}


	public function findAllWithJoin_get()
	{
		$this->db->select('batch_uang_makan.code_batch_uang_makan, batch_uang_makan.auto_finance_record, batch_uang_makan.total_uang_makan,batch_uang_makan.total_employee, batch_uang_makan.tanggal_batch_uang_makan, batch_uang_makan.tanggal_batch_uang_makan');
		$this->db->from('batch_uang_makan');
		$this->db->join('uang_makan', 'uang_makan.id_batch_uang_makan = batch_uang_makan.id_batch_uang_makan', 'left');
		$this->db->join('employee', 'employee.id_employee = uang_makan.id_employee', 'left');
		$this->db->order_by('batch_uang_makan.tanggal_batch_uang_makan', 'ASC');


		return $this->db->get()->result_array();
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_batch_uang_makan', $id);
		return $this->db->update('batch_uang_makan', $data);
	}


	public function delete($id)
	{
		return $this->db->delete('batch_uang_makan', ['id_batch_uang_makan' => $id]);
	}

	public function findByUangMakanId_get($id)
	{
		return $this->db->get_where('batch_uang_makan', ['id_batch_uang_makan' => $id])->result_array();
	}

	private function _filterDATE($type)
	{
		switch ($type) {
			case 'today':
				$this->db->where('DATE(batch_uang_makan.tanggal_batch_uang_makan) = CURDATE()');
				break;
			case 'tomorrow':
				$this->db->where('DATE(batch_uang_makan.tanggal_batch_uang_makan) = DATE_ADD(CURDATE(), INTERVAL 1 DAY)');
				break;
			case 'this_week':
				$this->db->where('batch_uang_makan.tanggal_batch_uang_makan >=', date('Y-m-d', strtotime('monday this week')));
				$this->db->where('batch_uang_makan.tanggal_batch_uang_makan <=', date('Y-m-d', strtotime('sunday this week')));
				break;
			case 'next_week':
				$this->db->where('batch_uang_makan.tanggal_batch_uang_makan >=', date('Y-m-d', strtotime('monday next week')));
				$this->db->where('batch_uang_makan.tanggal_batch_uang_makan <=', date('Y-m-d', strtotime('sunday next week')));
				break;
			case 'this_month':
				$this->db->where('batch_uang_makan.tanggal_batch_uang_makan >=', date('Y-m-01'));
				$this->db->where('batch_uang_makan.tanggal_batch_uang_makan <=', date('Y-m-t'));
				break;
			case 'next_month':
				$this->db->where('batch_uang_makan.tanggal_batch_uang_makan >=', date('Y-m-01', strtotime('+1 month')));
				$this->db->where('batch_uang_makan.tanggal_batch_uang_makan <=', date('Y-m-t', strtotime('+1 month')));
				break;
			case 'this_year':
				$this->db->where('batch_uang_makan.tanggal_batch_uang_makan >=', date('Y-01-01'));
				$this->db->where('batch_uang_makan.tanggal_batch_uang_makan <=', date('Y-12-31'));
				break;
			case 'next_year':
				$this->db->where('batch_uang_makan.tanggal_batch_uang_makan >=', date('Y-01-01', strtotime('+1 year')));
				$this->db->where('batch_uang_makan.tanggal_batch_uang_makan <=', date('Y-12-31', strtotime('+1 year')));
				break;
			case 'custom':
				$startDate = $this->input->post('startDate');
				$endDate = $this->input->post('endDate');
				if ($startDate && $endDate) {
					$this->db->where('batch_uang_makan.tanggal_batch_uang_makan >=', $startDate);
					$this->db->where('batch_uang_makan.tanggal_batch_uang_makan <=', $endDate);
				}
				break;
			default:
				break;
		}
	}

	public function getBatchUangMakanDataCore_get()
	{

		$option = $this->input->post('option', true);

		$this->db->select('batch_uang_makan.id_batch_uang_makan, batch_uang_makan.code_batch_uang_makan, batch_uang_makan.auto_finance_record, batch_uang_makan.include_holiday, batch_uang_makan.include_leave, batch_uang_makan.include_absen, batch_uang_makan.total_uang_makan,batch_uang_makan.total_employee, batch_uang_makan.tanggal_batch_uang_makan, batch_uang_makan.tanggal_batch_uang_makan');
		$this->db->from('batch_uang_makan');
		$this->db->join('uang_makan', 'uang_makan.id_batch_uang_makan = batch_uang_makan.id_batch_uang_makan', 'left');
		$this->db->join('employee', 'employee.id_employee = uang_makan.id_employee', 'left');
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
		$this->getBatchUangMakanDataCore_get();
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}


	public function count_filtered()
	{
		$this->getBatchUangMakanDataCore_get();
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function count_all()
	{
		$this->db->from('batch_uang_makan');
		return $this->db->count_all_results();
	}


	public function create_post($data)
	{
		if ($this->db->insert('batch_uang_makan', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}



}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_uang_makan extends CI_Model
{

	private $column_search = array('uang_makan.id_uang_makan', 'uang_makan.id_batch_uang_makan', 'uang_makan.id_employee', 'uang_makan.total_izin' , 'uang_makan.total_holiday', 'uang_makan.total_cuti', 'uang_makan.pot_izin', 'uang_makan.pot_cuti', 'uang_makan.pot_holiday', 'uang_makan.total_pot_uang_makan', 'uang_makan.total_uang_makan', 'employee.name', 'employee.id_product', 'employee.id_division', 'employee.uang_makan', 'employee.type_uang_makan', 'products.name_product', 'division.name_division');
	private $column_order = array('uang_makan.id_uang_makan', 'uang_makan.id_batch_uang_makan', 'uang_makan.id_employee', 'uang_makan.total_izin' , 'uang_makan.total_holiday', 'uang_makan.total_cuti', 'uang_makan.pot_izin', 'uang_makan.pot_cuti', 'uang_makan.pot_holiday', 'uang_makan.total_pot_uang_makan', 'uang_makan.total_uang_makan', 'employee.name', 'employee.id_product', 'employee.id_division',  'employee.uang_makan', 'employee.type_uang_makan', 'products.name_product', 'division.name_division');
	private $order = array('uang_makan.id_uang_makan' => 'asc');


	public function findAll_get()
	{
		return $this->db->get('uang_makan')->result_array();
	}


	public function findById_get($id)
	{
		return $this->db->get_where('uang_makan', ['id_uang_makan' => $id])->row_array();
	}


	public function findAllWithJoin_get()
	{
		$this->db->select('uang_makan.id_uang_makan, uang_makan.id_batch_uang_makan, uang_makan.id_employee, uang_makan.total_izin, uang_makan.total_holiday, uang_makan.total_cuti, uang_makan.pot_izin, uang_makan.pot_cuti, uang_makan.pot_holiday, uang_makan.total_pot_uang_makan, uang_makan.total_uang_makan, uang_makan.input_at, employee.name, employee.id_product, employee.id_division,  employee.uang_makan, employee.type_uang_makan, products.name_product, division.name_division');
		$this->db->from('uang_makan');
		$this->db->join('employee', 'employee.id_employee = uang_makan.id_employee', 'left');
		$this->db->join('products', 'products.id_product = employee.id_product', 'left');
		$this->db->join('division', 'division.id_division = employee.id_division', 'left');
		$this->db->order_by('uang_makan.id_uang_makan', 'ASC');

		return $this->db->get()->result_array();
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_uang_makan', $id);
		return $this->db->update('uang_makan', $data);
	}


	public function delete($id)
	{
		return $this->db->delete('uang_makan', ['id_uang_makan' => $id]);
	}


	public function findByEmployeeId_get($id)
	{
		return $this->db->get_where('uang_makan', ['id_employee' => $id])->result_array();
	}


	private function _filterDATE($type)
	{
		switch ($type) {
			case 'today':
				$this->db->where('DATE(uang_makan.input_at) = CURDATE()');
				break;
			case 'tomorrow':
				$this->db->where('DATE(uang_makan.input_at) = DATE_ADD(CURDATE(), INTERVAL 1 DAY)');
				break;
			case 'this_week':
				$this->db->where('uang_makan.input_at >=', date('Y-m-d', strtotime('monday this week')));
				$this->db->where('uang_makan.input_at <=', date('Y-m-d', strtotime('sunday this week')));
				break;
			case 'next_week':
				$this->db->where('uang_makan.input_at >=', date('Y-m-d', strtotime('monday next week')));
				$this->db->where('uang_makan.input_at <=', date('Y-m-d', strtotime('sunday next week')));
				break;
			case 'this_month':
				$this->db->where('uang_makan.input_at >=', date('Y-m-01'));
				$this->db->where('uang_makan.input_at <=', date('Y-m-t'));
				break;
			case 'next_month':
				$this->db->where('uang_makan.input_at >=', date('Y-m-01', strtotime('+1 month')));
				$this->db->where('uang_makan.input_at <=', date('Y-m-t', strtotime('+1 month')));
				break;
			case 'this_year':
				$this->db->where('uang_makan.input_at >=', date('Y-01-01'));
				$this->db->where('uang_makan.input_at <=', date('Y-12-31'));
				break;
			case 'next_year':
				$this->db->where('uang_makan.input_at >=', date('Y-01-01', strtotime('+1 year')));
				$this->db->where('uang_makan.input_at <=', date('Y-12-31', strtotime('+1 year')));
				break;
			case 'custom':
				$startDate = $this->input->post('startDate');
				$endDate = $this->input->post('endDate');
				if ($startDate && $endDate) {
					$this->db->where('uang_makan.input_at >=', $startDate);
					$this->db->where('uang_makan.input_at <=', $endDate);
				}
				break;
			default:
				break;
		}
	}


	public function getUangMakanDataCore_get()
	{

		$product = $this->input->post('product', true);
		$uang_makan = $this->input->post('uang_makan',true);

		$this->db->select('uang_makan.id_uang_makan, uang_makan.id_batch_uang_makan, uang_makan.id_employee, uang_makan.total_izin, uang_makan.total_holiday, uang_makan.total_cuti, uang_makan.pot_izin, uang_makan.pot_cuti, uang_makan.pot_holiday, uang_makan.total_absen, uang_makan.pot_absen, uang_makan.total_pot_uang_makan, uang_makan.total_uang_makan, uang_makan.input_at, employee.name, employee.id_product, employee.id_division, employee.id_position, employee.uang_makan, employee.type_uang_makan, products.name_product, division.name_division, position.name_position, batch_uang_makan.code_batch_uang_makan');
		$this->db->from('uang_makan');
		if (!empty($uang_makan) ) {
			$this->db->where('uang_makan.id_batch_uang_makan', $uang_makan);
		}
		if(!empty($product) && $product != 'all'){
			$this->db->where('products.id_product', $product);
		}
		$this->db->join('employee', 'employee.id_employee = uang_makan.id_employee', 'left');
		$this->db->join('products', 'products.id_product = employee.id_product', 'left');
		$this->db->join('division', 'division.id_division = employee.id_division', 'left');
		$this->db->join('position', 'position.id_position = employee.id_position', 'left');
		$this->db->join('batch_uang_makan', 'batch_uang_makan.id_batch_uang_makan = uang_makan.id_batch_uang_makan', 'left');

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
		$this->getUangMakanDataCore_get();
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}


	public function count_filtered()
	{
		$this->getUangMakanDataCore_get();
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function count_all()
	{
		$this->db->from('uang_makan');
		return $this->db->count_all_results();
	}


	public function create_batch_post($data)
	{
		if ($this->db->insert_batch('uang_makan', $data)) {
			return true;
		} else {
			return false;
		}
	}


	public function findTotalSalaryByEmployeeId_get($employee_id) {
		$this->db->select('COALESCE(SUM(pc.gaji_pokok), 0) AS total_penghasilan', false);
		$this->db->from('uang_makan pc');
		$this->db->join('payroll', 'payroll.id_payroll = pc.id_payroll', 'left');
		$this->db->where('pc.id_employee', $employee_id);
		$this->db->where('YEAR(pc.tanggal_gajian)', date('Y')); // Pastikan tanggal_gajian ada di uang_makan
		$this->db->where('payroll.include_pph', 1);


		$query = $this->db->get()->row();
		return intval($query->total_penghasilan);
	}


	public function create_post($data)
	{
		if ($this->db->insert('uang_makan', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}



}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_izin extends CI_Model {

	private $column_search = array('izin.id_izin', 'izin.id_employee', 'izin.alasan_izin', 'izin.input_at', 'izin.tanggal_izin', 'izin.bukti_surat_sakit', 'izin.description', 'izin.status', 'employee.id_employee', 'employee.name', 'employee.id_division', 'employee.id_product', 'division.id_division', 'division.name_division', 'products.id_product', 'products.name_product');
	private $column_order = array('izin.id_izin', 'izin.id_employee', 'izin.alasan_izin', 'izin.input_at', 'izin.tanggal_izin', 'izin.bukti_surat_sakit', 'izin.description', 'izin.status', 'employee.id_employee', 'employee.name', 'employee.id_division', 'employee.id_product', 'division.id_division', 'division.name_division', 'products.id_product', 'products.name_product');
	private $order = array('izin.tanggal_izin' => 'asc');

	public function findAll_get()
	{
		return $this->db->get('izin')->result_array();
	}


	public function findById_get($id)
	{
		return $this->db->get_where('izin', ['id_izin' => $id])->row_array();
	}


	public function findAllWithJoin_get()
	{
		$this->db->select('izin.id_izin, izin.id_employee, izin.alasan_izin, izin.input_at, izin.tanggal_izin, izin.bukti_surat_sakit, izin.description, izin.status, employee.id_employee, employee.name, employee.id_division, employee.id_product, division.id_division, division.name_division, products.id_product, products.name_product');
		$this->db->from('izin');
		$this->db->join('employee', 'employee.id_employee = izin.id_employee', 'left');
		$this->db->join('division', 'division.id_division = employee.id_division', 'left');
		$this->db->join('products', 'products.id_product = employee.id_product', 'left');
		$this->db->order_by('izin.input_at', 'ASC');


		return $this->db->get()->result_array();
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_izin', $id);
		return $this->db->update('izin', $data);
	}


	public function delete($id)
	{
		return $this->db->delete('izin', ['id_izin' => $id]);
	}

	public function findByEmployeeId_get($id)
	{
		return $this->db->get_where('izin', ['id_employee' => $id])->result_array();
	}

	public function findByEmployeeIdAtDate_get($id, $date)
	{
		return $this->db->get_where('izin', ['id_employee' => $id, 'tanggal_izin' => $date, 'status' => 2])->result_array();
	}

	public function create_post($data)
	{
		if ($this->db->insert('izin', $data)) {
			return true;
		} else {
			return false;
		}
	}

	private function _filterDATE($type)
	{
		switch ($type) {
			case 'today':
				$this->db->where('DATE(izin.tanggal_izin) = CURDATE()');
				break;
			case 'tomorrow':
				$this->db->where('DATE(izin.tanggal_izin) = DATE_ADD(CURDATE(), INTERVAL 1 DAY)');
				break;
			case 'this_week':
				$this->db->where('izin.tanggal_izin >=', date('Y-m-d', strtotime('monday this week')));
				$this->db->where('izin.tanggal_izin <=', date('Y-m-d', strtotime('sunday this week')));
				break;
			case 'next_week':
				$this->db->where('izin.tanggal_izin >=', date('Y-m-d', strtotime('monday next week')));
				$this->db->where('izin.tanggal_izin <=', date('Y-m-d', strtotime('sunday next week')));
				break;
			case 'this_month':
				$this->db->where('izin.tanggal_izin >=', date('Y-m-01'));
				$this->db->where('izin.tanggal_izin <=', date('Y-m-t'));
				break;
			case 'next_month':
				$this->db->where('izin.tanggal_izin >=', date('Y-m-01', strtotime('+1 month')));
				$this->db->where('izin.tanggal_izin <=', date('Y-m-t', strtotime('+1 month')));
				break;
			case 'this_year':
				$this->db->where('izin.tanggal_izin >=', date('Y-01-01'));
				$this->db->where('izin.tanggal_izin <=', date('Y-12-31'));
				break;
			case 'next_year':
				$this->db->where('izin.tanggal_izin >=', date('Y-01-01', strtotime('+1 year')));
				$this->db->where('izin.tanggal_izin <=', date('Y-12-31', strtotime('+1 year')));
				break;
			case 'custom':
				$startDate = $this->input->post('startDate');
				$endDate = $this->input->post('endDate');
				if ($startDate && $endDate) {
					$this->db->where('izin.tanggal_izin >=', $startDate);
					$this->db->where('izin.tanggal_izin <=', $endDate);
				}
				break;
			default:
				break;
		}
	}

	public function getIzinDataCore_get()
	{

		$option = $this->input->post('option', true);
		$status_izin = $this->input->post('status_izin', true);
		$id = $this->input->post('employee', true);
		$product = $this->input->post('product', true);



		if(!empty($status_izin)){
			$this->db->select('izin.id_izin, izin.id_employee, izin.alasan_izin, izin.input_at, izin.tanggal_izin, izin.bukti_surat_sakit, izin.description, izin.status, employee.id_employee, employee.name, employee.id_division, employee.id_product, division.id_division, division.name_division, products.id_product, products.name_product');
			$this->db->where('izin.status', $status_izin);
			if($id != 'false') {
				$this->db->where('izin.id_employee', $id);
			}
			$this->db->from('izin');
			$this->db->join('employee', 'employee.id_employee = izin.id_employee', 'left');
			$this->db->join('division', 'division.id_division = employee.id_division', 'left');
			$this->db->join('products', 'products.id_product = employee.id_product', 'left');
			if(!empty($option) ){
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
		$this->getIzinDataCore_get();
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_filtered()
	{
		$this->getIzinDataCore_get();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from('izin');
		return $this->db->count_all_results();
	}


	public function count_pending_get()
	{
		$this->db->where('status', 3);
		return $this->db->count_all_results('izin');
	}

	public function setStatus_post($id, $status)
	{

		$this->db->set('status', $status);
		$this->db->where('id_izin', $id);
		$this->db->update('izin');

		return true;

	}

	public function totalIzinByEmployeeId_get($id)
	{
		$currentYear = date('Y');

		$count = $id != null ?
			$this->db
			->where('id_employee', $id)
			->where('status', 2)
			->where('YEAR(tanggal_izin)', $currentYear)
			->count_all_results('izin') :
			$this->db
			->where('YEAR(tanggal_izin)', $currentYear)
			->count_all_results('izin');

		return $count;
	}

	public function totalIzinThisMonthByEmployeeId_get($id)
	{
		$currentMonth = date('m');

		$count = $id != null ?
			$this->db
				->where('id_employee', $id)
				->where('status', 2)
				->where('MONTH(tanggal_izin)', $currentMonth)
				->count_all_results('izin'):
			$this->db
				->where('MONTH(tanggal_izin)', $currentMonth)
				->count_all_results('izin');

		return $count;
	}

	public function totalIzinLastMonthToNowByEmployeeId_get($id, $tanggal)
	{

		$today = $tanggal;


		$lastMonthDate = date('Y-m-d', strtotime('-1 month', strtotime($tanggal)));

		$count = $this->db
			->where('id_employee', $id)
			->where('status', 2)
			->where('bukti_surat_sakit', '-')
			->where('tanggal_izin >=', $lastMonthDate)
			->where('tanggal_izin <=', $today)
			->count_all_results('izin');

		return $count;
	}

	public function totalIzinLastMonthToNowWithPictureByEmployeeId_get($id, $tanggal, $tanggal2)
	{

		$today = $tanggal;

		$count = $this->db
			->where('id_employee', $id)
			->where('status', 2)
			->where('bukti_surat_sakit !=', '-')
			->where('tanggal_izin >=', $$tanggal2)
			->where('tanggal_izin <=', $today)
			->count_all_results('izin');
		return $count;
	}

	public function totalAttendance($id, $tanggal1, $tanggal2)
	{

		$count = $this->db
			->where('id_employee', $id)
			->where('status', 2)
			->where('tanggal_izin >=', $tanggal1)
			->where('tanggal_izin <=', $tanggal2)
			->count_all_results('izin');

		return $count;
	}


	public function totalIzin_get()
	{
		$currentYear = date('Y');

		$count = $this->db
			->where('status', 2)
			->where('YEAR(tanggal_izin)', $currentYear)
			->count_all_results('day_off');


		return $count;
	}
	public function totalIzinThisMonth_get()
	{
		$currentYear = date('m');

		$count = $this->db
			->where('status', 2)
			->where('MONTH(tanggal_izin)', $currentYear)
			->count_all_results('day_off');


		return $count;
	}

}

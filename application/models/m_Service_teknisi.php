<?php

defined('BASEPATH') or exit('No direct script access allowed');

class m_Service_teknisi extends CI_Model
{

	private $column_search = array('service_teknisi.id_service_teknisi', 'service_teknisi.input_at', 'service_teknisi.id_employee', 'service_teknisi.tanggal_service', 'service_teknisi.total_service', 'service_teknisi.pendapatan_service', 'service_teknisi.type_service', 'service_teknisi.type_service','service_teknisi.description', 'service_teknisi.status', 'employee.id_employee', 'employee.name', 'employee.id_division', 'employee.id_product', 'division.id_division', 'division.name_division', 'products.id_product', 'products.name_product');
	private $column_order = array('service_teknisi.id_service_teknisi', 'service_teknisi.input_at', 'service_teknisi.id_employee', 'service_teknisi.tanggal_service', 'service_teknisi.total_service', 'service_teknisi.pendapatan_service', 'service_teknisi.type_service', 'service_teknisi.type_service','service_teknisi.description', 'service_teknisi.status', 'employee.id_employee', 'employee.name', 'employee.id_division', 'employee.id_product', 'division.id_division', 'division.name_division', 'products.id_product', 'products.name_product');
	private $order = array('service_teknisi.tanggal_service' => 'asc');

	public function findAll_get()
	{
		return $this->db->get('service_teknisi')->result_array();
	}


	public function findById_get($id)
	{
		return $this->db->get_where('service_teknisi', ['id_service_teknisi' => $id])->row_array();
	}


	public function findAllWithJoin_get()
	{
		$this->db->select('service_teknisi.id_service_teknisi, service_teknisi.input_at,service_teknisi.id_employee, service_teknisi.tanggal_service, service_teknisi.total_service, service_teknisi.pendapatan_service, service_teknisi.type_service, service_teknisi.type_service,service_teknisi.description, service_teknisi.status, employee.id_employee, employee.name, employee.id_division, employee.id_product, division.id_division, division.name_division, products.id_product, products.name_product');
		$this->db->from('service_teknisi');
		$this->db->join('employee', 'employee.id_employee = service_teknisi.id_employee', 'left');
		$this->db->join('division', 'division.id_division = employee.id_division', 'left');
		$this->db->join('products', 'products.id_product = employee.id_product', 'left');
		$this->db->order_by('service_teknisi.tanggal_service', 'ASC');


		return $this->db->get()->result_array();
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_service_teknisi', $id);
		return $this->db->update('service_teknisi', $data);
	}



	public function delete($id)
	{
		return $this->db->delete('service_teknisi', ['id_service_teknisi' => $id]);
	}


	public function findByEmployeeId_get($id)
	{
		return $this->db->get_where('service_teknisi', ['id_employee' => $id])->result_array();
	}


	public function findByEmployeeIdAtDate_get($id, $date)
	{
		return $this->db->get_where('service_teknisi', ['id_employee' => $id, 'tanggal_service' => $date, 'status' => 2])->result_array();
	}


	public function create_post($data)
	{
		if ($this->db->insert('service_teknisi', $data)) {
			return true;
		} else {
			return false;
		}
	}


	private function _filterDATE($type)
	{
		switch ($type) {
			case 'today':
				$this->db->where('DATE(service_teknisi.tanggal_service) = CURDATE()');
				break;
			case 'tomorrow':
				$this->db->where('DATE(service_teknisi.tanggal_service) = DATE_ADD(CURDATE(), INTERVAL 1 DAY)');
				break;
			case 'this_week':
				$this->db->where('service_teknisi.tanggal_service >=', date('Y-m-d', strtotime('monday this week')));
				$this->db->where('service_teknisi.tanggal_service <=', date('Y-m-d', strtotime('sunday this week')));
				break;
			case 'next_week':
				$this->db->where('service_teknisi.tanggal_service >=', date('Y-m-d', strtotime('monday next week')));
				$this->db->where('service_teknisi.tanggal_service <=', date('Y-m-d', strtotime('sunday next week')));
				break;
			case 'this_month':
				$this->db->where('service_teknisi.tanggal_service >=', date('Y-m-01'));
				$this->db->where('service_teknisi.tanggal_service <=', date('Y-m-t'));
				break;
			case 'next_month':
				$this->db->where('service_teknisi.tanggal_service >=', date('Y-m-01', strtotime('+1 month')));
				$this->db->where('service_teknisi.tanggal_service <=', date('Y-m-t', strtotime('+1 month')));
				break;
			case 'this_year':
				$this->db->where('service_teknisi.tanggal_service >=', date('Y-01-01'));
				$this->db->where('service_teknisi.tanggal_service <=', date('Y-12-31'));
				break;
			case 'next_year':
				$this->db->where('service_teknisi.tanggal_service >=', date('Y-01-01', strtotime('+1 year')));
				$this->db->where('service_teknisi.tanggal_service <=', date('Y-12-31', strtotime('+1 year')));
				break;
			case 'custom':
				$startDate = $this->input->post('startDate');
				$endDate = $this->input->post('endDate');
				if ($startDate && $endDate) {
					$this->db->where('service_teknisi.tanggal_service >=', $startDate);
					$this->db->where('service_teknisi.tanggal_service <=', $endDate);
				}
				break;
			default:
				break;
		}
	}


	public function getServiceTeknisiDataCore_get()
	{

		$option = $this->input->post('option', true);
		$status_service_teknisi = $this->input->post('status_service_teknisi', true);
		$id = $this->input->post('employee', true);
		$product = $this->input->post('product', true);


		if (!empty($status_service_teknisi)) {
			$this->db->select('service_teknisi.id_service_teknisi, service_teknisi.input_at,    service_teknisi.id_employee, service_teknisi.tanggal_service, service_teknisi.total_service, service_teknisi.pendapatan_service, service_teknisi.type_service, service_teknisi.type_service,service_teknisi.description, service_teknisi.status, employee.id_employee, employee.name, employee.id_division, employee.id_product, division.id_division, division.name_division, products.id_product, products.name_product');
			$this->db->where('service_teknisi.status', $status_service_teknisi);
			if($id != 'false') {
				$this->db->where('service_teknisi.id_employee', $id);
			}
			$this->db->from('service_teknisi');
			$this->db->join('employee', 'employee.id_employee = service_teknisi.id_employee', 'left');
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
		$this->getServiceTeknisiDataCore_get();
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}


	public function count_filtered()
	{
		$this->getServiceTeknisiDataCore_get();
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function count_all()
	{
		$this->db->from('service_teknisi');
		return $this->db->count_all_results();
	}


	public function setStatus_post($id, $status, $pay)
	{

		$this->db->set(['status' => $status, 'total_service' => $pay]);
		$this->db->where('id_service_teknisi', $id);
		$this->db->update('service_teknisi');

		return true;

	}


	public function totalServiceTeknisiByEmployeeId_get($id)
	{
		$currentYear = date('Y');

		$count = $this->db
			->where('id_employee', $id)
			->where('status', 2)
			->where('YEAR(tanggal_service)', $currentYear)
			->count_all_results('service_teknisi');


		return $count;
	}


	public function totalServiceTeknisiThisMonthByEmployeeId_get($id)
	{
		$currentMonth = date('m');

		$count = $this->db
			->where('id_employee', $id)
			->where('status', 2)
			->where('MONTH(tanggal_service)', $currentMonth)
			->count_all_results('service_teknisi');


		return $count;
	}


	public function totalServiceTeknisiLastMonthToNowByEmployeeId_get($id, $tanggal)
	{

		$today = $tanggal;


		$lastMonthDate = date('Y-m-d', strtotime('-1 month', strtotime($tanggal)));

		$count = $this->db
			->where('id_employee', $id)
			->where('status', 2)
			->where('tanggal_service >=', $lastMonthDate)
			->where('tanggal_service <=', $today)
			->count_all_results('service_teknisi');

		return $count;
	}


	public function totalAttendance($id, $tanggal1, $tanggal2)
	{

		$count = $this->db
			->where('id_employee', $id)
			->where('status', 2)
			->where('tanggal_service >=', $tanggal1)
			->where('tanggal_service <=', $tanggal2)
			->count_all_results('service_teknisi');

		return $count;
	}


	public function totalServiceTeknisi_get()
	{
		$currentYear = date('Y');

		$count = $this->db
			->where('status', 2)
			->where('YEAR(tanggal_service)', $currentYear)
			->count_all_results('service_teknisi');


		return $count;
	}


	public function totalServiceTeknisiThisMonth_get()
	{
		$currentYear = date('m');

		$count = $this->db
			->where('status', 2)
			->where('MONTH(tanggal_service)', $currentYear)
			->count_all_results('service_teknisi');


		return $count;
	}
	

	public function totalServicePay_get($id, $tanggal){

		$lastMonthDate = date('Y-m-d', strtotime('-1 month', strtotime($tanggal)));

		$this->db->select_sum('total_service', 'total_service');
		$this->db->where('id_employee', $id);
		$this->db->where('status', 2);
		$this->db->where('tanggal_service >=', $lastMonthDate);
		$this->db->where('tanggal_service <=', $tanggal);
		$query = $this->db->get('service_teknisi')->row();

		return $query->total_service ?? 0;

	}

}

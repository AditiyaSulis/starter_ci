<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_koperasi extends CI_Model {
	private $column_order = array('products.name_product', 'koperasi.remaining', 'koperasi.amount_koperasi');
	private $column_search = array('products.name_product', 'koperasi.remaining', 'koperasi.amount_koperasi');
	private $order = array('koperasi.id_koperasi' => 'asc');

	public function findById_get($id)
	{
		return $this->db->get_where('koperasi', ['id_koperasi' => $id])->row_array();
	}


	public function findByProductId_get($id)
	{
		return $this->db->get_where('products', ['id_product' => $id])->row_array();
	}


	public function findByProductId($id){
		return $this->db->get_where('koperasi', ['id_product' => $id])->row_array();
	}


	public function unpaid_get($id){
		return $this->db->get_where('koperasi', ['id_product' => $id, 'status' => 2])->row_array();
	}


	public function findAllWithUnpaid_get($id){
		return $this->db->get_where('koperasi', ['status' => 2])->result_array();
	}


	public function findAll_get()
	{
		return $this->db->get('koperasi')->result_array();
	}


	public function findAllJoin_get()
	{
		$this->db->select('koperasi.id_koperasi, koperasi.id_product, koperasi.type_koperasi, koperasi.tenor_koperasi, koperasi.amount_koperasi, koperasi.tgl_lunas, koperasi.remaining, koperasi.status,  koperasi.koperasi_date, koperasi.description, koperasi.type_tenor, koperasi.angsuran, koperasi.tgl_jatuh_tempo, products.name_product');
		$this->db->from('koperasi');
		$this->db->join('products', 'products.id_product = koperasi.id_product', 'left');
		$query = $this->db->get();
		return $query->result_array();
	}


	public function create_post($data)
	{
		if ($this->db->insert('koperasi', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}


	public function delete($id)
	{
		return $this->db->delete('koperasi', ['id_koperasi' => $id]);
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_koperasi', $id);
		return $this->db->update('koperasi', $data);
	}


	public function getKoperasiDataCore_get()
	{
		$type_koperasi = $this->input->post("type_koperasi", true);
		$tgl_lunas = $this->input->post("tgl_lunas", true);
		$status = $this->input->post("status", true);
		$with_alerts = $this->input->post("with_alerts", true);

		if(!empty($status)) {
			$this->db->select('koperasi.id_koperasi, koperasi.id_product, koperasi.type_koperasi, koperasi.tenor_koperasi, koperasi.amount_koperasi, koperasi.tgl_lunas, koperasi.remaining, koperasi.status, koperasi.description, koperasi.koperasi_date, koperasi.type_tenor, koperasi.angsuran, koperasi.tgl_jatuh_tempo, products.name_product');
			$this->db->from('koperasi');
			$this->db->where('koperasi.status', $status);
			$this->db->join('products', 'products.id_product = koperasi.id_product', 'left');

			if (!empty($type_koperasi) && $type_koperasi !== 'All') {
				$this->db->where('koperasi.type_koperasi', $type_koperasi);
			}

			if (!empty($tgl_lunas) && $tgl_lunas !== 'All') {
				if ($tgl_lunas === 'next_month') {
					$this->db->where('koperasi.tgl_lunas >=', date('Y-m-01', strtotime('first day of next month')));
					$this->db->where('koperasi.tgl_lunas <=', date('Y-m-t', strtotime('last day of next month')));
				} else if ($tgl_lunas === 'this_month') {
					$this->db->where('koperasi.tgl_lunas >=', date('Y-m-01'));
					$this->db->where('koperasi.tgl_lunas <=', date('Y-m-t'));
				}
			}
		}

		if(!empty($with_alerts)) {
			$today = (int) date('d');
			//$today = 1;
			$three_days_later = $today + 3;
			$paydate = date('Y-m-d');

			$this->db->select('koperasi.*, products.name_product');
			$this->db->from('koperasi');
			$this->db->join('purchase_koperasi', 'purchase_koperasi.id_koperasi = koperasi.id_koperasi', 'left');
			$this->db->join('products', 'products.id_product = koperasi.id_product', 'left');

			if ($today == 30) {
				$this->db->group_start();
				$this->db->where('koperasi.tgl_jatuh_tempo', 30);
				$this->db->or_where('koperasi.tgl_jatuh_tempo', 31);
				$this->db->or_where('koperasi.tgl_jatuh_tempo', 1);
				$this->db->or_where('koperasi.tgl_jatuh_tempo', 2);
				$this->db->group_end();
			} elseif ($today == 31) {
				$this->db->group_start();
				$this->db->where('koperasi.tgl_jatuh_tempo', 31);
				$this->db->or_where('koperasi.tgl_jatuh_tempo', 1);
				$this->db->or_where('koperasi.tgl_jatuh_tempo', 2);
				$this->db->or_where('koperasi.tgl_jatuh_tempo', 3);
				$this->db->group_end();
			} else {
				$this->db->where('koperasi.tgl_jatuh_tempo >=', $today);
				$this->db->where('koperasi.tgl_jatuh_tempo <=', $three_days_later);
			}

			$this->db->where('koperasi.status_koperasi', 2);
			$this->db->group_start();
			$this->db->where('purchase_koperasi.pay_date !=', $paydate);
			$this->db->or_where('purchase_koperasi.pay_date IS NULL', null, false);
			$this->db->group_end();

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
		$this->getKoperasiDataCore_get();
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}


	public function count_filtered()
	{
		$this->getKoperasiDataCore_get();
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function count_all()
	{
		$this->db->from('koperasi');
		return $this->db->count_all_results();
	}


	public function setStatus_post($id, $status)
	{

		$this->db->set('status', $status);
		$this->db->where('id_koperasi', $id);
		$this->db->update('koperasi');

		return true;

	}



	public function updateRemaining_post($id, $remaining)
	{

		$this->db->set('remaining', $remaining);
		$this->db->where('id_koperasi', $id);
		$this->db->update('koperasi');

		return true;

	}


	public function getTotalAmountKoperasi_get($id)
	{
		$this->db->select_sum('amount', 'total_amount');
		$this->db->where('id_product', $id);
		$this->db->where('status', 2);
		$query = $this->db->get('koperasi');

		if ($query->num_rows() > 0) {
			return $query->row()->total_amount;
		}

		return 0;
	}


	public function jatuhTempo_get(){
		$today = (int) date('d');
		//$today = 2;
		$three_days_later = $today + 3;
		$paydate = date('Y-m-d');

		$this->db->select('koperasi.*, products.name_product');
		$this->db->from('koperasi');
		$this->db->join('purchase_koperasi', 'purchase_koperasi.id_koperasi = koperasi.id_koperasi', 'left');
		$this->db->join('products', 'products.id_product = koperasi.id_product', 'left');

		if ($today == 30) {
			$this->db->group_start();
			$this->db->where('koperasi.jatuh_tempo', 30);
			$this->db->or_where('koperasi.jatuh_tempo', 31);
			$this->db->or_where('koperasi.jatuh_tempo', 1);
			$this->db->or_where('koperasi.jatuh_tempo', 2);
			$this->db->group_end();
		} elseif ($today == 31) {
			$this->db->group_start();
			$this->db->where('koperasi.jatuh_tempo', 31);
			$this->db->or_where('koperasi.jatuh_tempo', 1);
			$this->db->or_where('koperasi.jatuh_tempo', 2);
			$this->db->or_where('koperasi.jatuh_tempo', 3);
			$this->db->group_end();
		} else {
			$this->db->where('koperasi.jatuh_tempo >=', $today);
			$this->db->where('koperasi.jatuh_tempo <=', $three_days_later);
		}

		$this->db->where('koperasi.status_koperasi', 2);
		$this->db->group_start();
		$this->db->where('purchase_koperasi.pay_date !=', $paydate);
		$this->db->or_where('purchase_koperasi.pay_date IS NULL', null, false);
		$this->db->group_end();

		$query = $this->db->get();
		return $query->result();
	}


	public function totalJatuhTempo_get() {
		$today = (int) date('d');
		//$today = 2;
		$three_days_later = $today + 3;
		$paydate = date('Y-m-d');

		$this->db->select('koperasi.*, products.name_product');
		$this->db->from('koperasi');
		$this->db->join('purchase_koperasi', 'purchase_koperasi.id_koperasi = koperasi.id_koperasi', 'left');
		$this->db->join('products', 'products.id_product = koperasi.id_product', 'left');

		if ($today == 30) {
			$this->db->group_start();
			$this->db->where('koperasi.jatuh_tempo', 30);
			$this->db->or_where('koperasi.jatuh_tempo', 31);
			$this->db->or_where('koperasi.jatuh_tempo', 1);
			$this->db->or_where('koperasi.jatuh_tempo', 2);
			$this->db->group_end();
		} elseif ($today == 31) {
			$this->db->group_start();
			$this->db->where('koperasi.jatuh_tempo', 31);
			$this->db->or_where('koperasi.jatuh_tempo', 1);
			$this->db->or_where('koperasi.jatuh_tempo', 2);
			$this->db->or_where('koperasi.jatuh_tempo', 3);
			$this->db->group_end();
		} else {
			$this->db->where('koperasi.jatuh_tempo >=', $today);
			$this->db->where('koperasi.jatuh_tempo <=', $three_days_later);
		}

		$this->db->where('koperasi.status_koperasi', 2);
		$this->db->group_start();
		$this->db->where('purchase_koperasi.pay_date !=', $paydate);
		$this->db->or_where('purchase_koperasi.pay_date IS NULL', null, false);
		$this->db->group_end();

		$data = $this->db->count_all_results();

		return $data;
	}


	public function findKoperasiThisMonthByEmployeeId_get($id, $month, $year) {
		$this->db->select('koperasi.*, products.name_product');
		$this->db->from('koperasi');
		$this->db->join('purchase_koperasi', 'purchase_koperasi.id_koperasi = koperasi.id_koperasi', 'left');
		$this->db->join('products', 'products.id_product = koperasi.id_product', 'left');

		// Filter berdasarkan id_employee dan status koperasi
		$this->db->where('koperasi.id_product', $id);
		$this->db->where('koperasi.status', 2); // Hanya koperasi yang masih aktif

		// Cek apakah pay_date di bulan yang dikirim NULL atau bukan bulan yang dikirim
		$this->db->group_start();
		$this->db->where('purchase_koperasi.pay_date IS NULL', null, false);
		$this->db->or_where('MONTH(purchase_koperasi.pay_date) !=', $month);
		$this->db->or_where('YEAR(purchase_koperasi.pay_date) !=', $year);
		$this->db->group_end();

		return $this->db->get()->result_array(); // Mengembalikan array data
	}


	public function totalUnpaid_get()
	{
		$count = $this->db->where('status', 2)->count_all_results('koperasi');

		return $count;
	}


	public function totalPaid_get()
	{
		$count = $this->db->where('status', 1)->count_all_results('koperasi');

		return $count;
	}






}

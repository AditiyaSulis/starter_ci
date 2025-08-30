<?php

defined('BASEPATH') or exit('No direct script access allowed');


class M_saldo_koperasi extends CI_Model
{

	private $column_search = array('products.name_product', 'saldo_koperasi.tanggal');
	private $column_order = array('products.name_product', 'saldo_koperasi.tanggal');
	private $order = array('saldo_koperasi.tanggal' => 'asc');

	public function findAll_get()
	{
		return $this->db->get('saldo_koperasi')->result_array();
	}


	public function findById_get($id)
	{
		$this->db->select('saldo_koperasi.*, koperasi.id_product, products.name_product');
		$this->db->from('saldo_koperasi');
		$this->db->where('saldo_koperasi.id_saldo_koperasi', $id);
		$this->db->join('koperasi', 'koperasi.id_koperasi = saldo_koperasi.id_koperasi', 'left');
		$this->db->join('products', 'products.id_product = koperasi.id_product', 'left');

		return $this->db->get()->row_array();
	}


	public function findAllWithJoin_get()
	{
		$this->db->select('saldo_koperasi.*, koperasi.id_product,  products.name_product');
		$this->db->from('saldo_koperasi');
		$this->db->join('koperasi', 'koperasi.id_koperasi = saldo_koperasi.id_koperasi', 'left');
		$this->db->join('products', 'products.id_product = koperasi.id_product', 'left');
		$this->db->order_by('saldo_koperasi.tanggal', 'ASC');

		return $this->db->get()->result_array();
	}



	public function delete($id)
	{
		return $this->db->delete('saldo_koperasi', ['id_saldo_koperasi' => $id]);
	}

	public function deleteByKoperasi($id)
	{
		return $this->db->delete('saldo_koperasi', ['id_koperasi' => $id]);
	}


	public function create_post($data)
	{
		if ($this->db->insert('saldo_koperasi', $data)) {
			return $this->db->insert_id();;
		} else {
			return false;
		}
	}


	public function saldo_get()
	{
		// Jumlah saldo_koperasi untuk status 1 dan 2
		$this->db->select_sum('nominal');
		$this->db->where_in('status', [1, 2]);
		$query1 = $this->db->get('saldo_koperasi');
		$total_12 = $query1->row()->nominal ?? 0;

		// Jumlah saldo_koperasi untuk status 3
		$this->db->select_sum('nominal');
		$this->db->where_in('status', [3,4]);
		$query2 = $this->db->get('saldo_koperasi');
		$total_3 = $query2->row()->nominal ?? 0;

		// Hasil akhir: saldo_koperasi status 1 dan 2 dikurangi saldo_koperasi status 3
		return $total_12 - $total_3;
	}


	//SSR RIWAYAT SALDO

	private function _filterSaldoDATE($type)
	{
		switch ($type) {
			case 'today':
				$this->db->where('DATE(saldo_koperasi.tanggal) = CURDATE()');
				break;
			case 'yesterday':
				$this->db->where('DATE(saldo_koperasi.tanggal) = CURDATE() - INTERVAL 1 DAY');
				break;
			case 'this_week':
				$this->db->where('saldo_koperasi.tanggal >=', date('Y-m-d', strtotime('monday this week')));
				$this->db->where('saldo_koperasi.tanggal <=', date('Y-m-d', strtotime('sunday this week')));
				break;
			case 'last_week':
				$this->db->where('saldo_koperasi.tanggal >=', date('Y-m-d', strtotime('monday last week')));
				$this->db->where('saldo_koperasi.tanggal <=', date('Y-m-d', strtotime('sunday last week')));
				break;
			case 'this_month':
				$this->db->where('saldo_koperasi.tanggal BETWEEN DATE_FORMAT(CURDATE(), "%Y-%m-01") AND LAST_DAY(CURDATE())');
				break;
			case 'last_month':
				$this->db->where('saldo_koperasi.tanggal BETWEEN DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, "%Y-%m-01") AND LAST_DAY(CURDATE() - INTERVAL 1 MONTH)');
				break;
			case 'this_year':
				$this->db->where('DATE(saldo_koperasi.tanggal) BETWEEN DATE_FORMAT(CURDATE(), "%Y-01-01") AND CURDATE()');
				break;
			case 'last_year':
				$this->db->where('saldo_koperasi.tanggal BETWEEN DATE_FORMAT(CURDATE() - INTERVAL 1 YEAR, "%Y-01-01") AND DATE_FORMAT(CURDATE() - INTERVAL 1 YEAR, "%Y-12-31")');
				break;
			case 'custom':
				$startDate = $this->input->post('startDate');
				$endDate = $this->input->post('endDate');
				if ($startDate && $endDate) {
					$this->db->where('DATE(saldo_koperasi.tanggal) >=', $startDate);
					$this->db->where('DATE(saldo_koperasi.tanggal) <=', $endDate);
				}
				break;
			default:
				break;
		}
	}


	public function getRiwayatSaldoCore_get($option = null, $startDate = null, $endDate = null)
	{



		$this->db->select('saldo_koperasi.*, koperasi.id_product, products.name_product');
		$this->db->from('saldo_koperasi');
		$this->db->join('koperasi', 'koperasi.id_koperasi = saldo_koperasi.id_koperasi', 'left');
		$this->db->join('products', 'products.id_product = koperasi.id_product', 'left');
		if(!empty($option) ){
			$this->_filterSaldoDATE($option);
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


	public function get_datatables($option = null, $startDate = null, $endDate = null)
	{
		$this->getRiwayatSaldoCore_get($option, $startDate , $endDate);
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}


	public function count_filtered($option = null, $startDate = null, $endDate = null)
	{
		$this->getRiwayatSaldoCore_get($option, $startDate, $endDate);
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function count_all($option, $startDate, $endDate)
	{
		$this->db->select('saldo_koperasi.*, koperasi.id_product,products.name_product');
		$this->db->from('saldo_koperasi');
		$this->db->join('koperasi', 'koperasi.id_koperasi = saldo_koperasi.id_koperasi', 'left');
		$this->db->join('products', 'products.id_product = koperasi.id_product', 'left');
		if(!empty($option) ){
			$this->_filterSaldoDATE($option);
		}
		return $this->db->count_all_results();
	}


}

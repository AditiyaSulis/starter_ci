<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_karir extends CI_Model
{

	private $column_search = array('karir.id_karir', 'karir.id_product', 'karir.posisi',  'karir.lokasi_penempatan', 'karir.mulai_posting', 'karir.akhir_posting',  'karir.whatsapp', 'karir.email', 'karir.kualifikasi', 'karir.benefit', 'karir.gaji', 'karir.jam_kerja', 'products.name_product', 'products.logo');
	private $column_order = array('karir.id_karir', 'karir.id_product', 'karir.posisi',  'karir.lokasi_penempatan', 'karir.mulai_posting', 'karir.akhir_posting',  'karir.whatsapp', 'karir.email', 'karir.kualifikasi', 'karir.benefit', 'karir.gaji', 'karir.jam_kerja', 'products.name_product', 'products.logo');
	private $order = array('karir.mulai_posting' => 'asc');

	public function findAll_get()
	{
		return $this->db->get('karir')->result_array();
	}


	public function findById_get($id)
	{
		$this->db->select('karir.id_karir, karir.id_product, karir.posisi, karir.lokasi_penempatan, karir.mulai_posting, karir.akhir_posting,  karir.whatsapp, karir.email, karir.kualifikasi, karir.benefit, karir.gaji, karir.jam_kerja, products.name_product, products.logo');
		$this->db->from('karir');
		$this->db->where('id_karir', $id);
		$this->db->join('products', 'products.id_product = karir.id_product', 'left');
		$this->db->order_by('karir.mulai_posting', 'ASC');

		return $this->db->get()->result_array();
	}


	public function findAllWithJoin_get()
	{


		$this->db->select('karir.id_karir, karir.id_product, karir.posisi, karir.lokasi_penempatan, karir.mulai_posting, karir.akhir_posting,  karir.whatsapp, karir.email, karir.kualifikasi, karir.benefit, karir.gaji, karir.jam_kerja, products.name_product, products.logo');
		$this->db->from('karir');
		$this->db->join('products', 'products.id_product = karir.id_product', 'left');
		$this->db->order_by('karir.mulai_posting', 'ASC');

		return $this->db->get()->result_array();
	}


	public function findAllAvailable_get()
	{
		$now = date('Y-m-d');

		$this->db->select('karir.id_karir, karir.id_product, karir.posisi, karir.lokasi_penempatan, karir.mulai_posting, karir.akhir_posting,  karir.whatsapp, karir.email, karir.kualifikasi, karir.benefit, karir.gaji, karir.jam_kerja, products.name_product, products.logo');
		$this->db->from('karir');
		$this->db->where('karir.mulai_posting <=', $now);
		$this->db->where('karir.akhir_posting >=', $now);
		$this->db->join('products', 'products.id_product = karir.id_product', 'left');
		$this->db->order_by('karir.mulai_posting', 'ASC');

		return $this->db->get()->result_array();
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_karir', $id);
		return $this->db->update('karir', $data);
	}


	public function delete($id)
	{
		return $this->db->delete('karir', ['id_karir' => $id]);
	}


	public function create_post($data)
	{
		if ($this->db->insert('karir', $data)) {
			return true;
		} else {
			return false;
		}
	}


	private function _filterDATE($type)
	{
		switch ($type) {
			case 'today':
				$this->db->where('DATE(karir.mulai_posting) = CURDATE()');
				break;
			case 'yesterday':
				$this->db->where('DATE(karir.mulai_posting) = CURDATE() - INTERVAL 1 DAY');
				break;
			case 'this_week':
				$this->db->where('karir.mulai_posting >=', date('Y-m-d', strtotime('monday this week')));
				$this->db->where('karir.mulai_posting <=', date('Y-m-d', strtotime('sunday this week')));
				break;
			case 'last_week':
				$this->db->where('karir.mulai_posting >=', date('Y-m-d', strtotime('monday last week')));
				$this->db->where('karir.mulai_posting <=', date('Y-m-d', strtotime('sunday last week')));
				break;
			case 'this_month':
				$this->db->where('karir.mulai_posting BETWEEN DATE_FORMAT(CURDATE(), "%Y-%m-01") AND LAST_DAY(CURDATE())');
				break;
			case 'last_month':
				$this->db->where('karir.mulai_posting BETWEEN DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, "%Y-%m-01") AND LAST_DAY(CURDATE() - INTERVAL 1 MONTH)');
				break;
			case 'this_year':
				$this->db->where('karir.mulai_posting BETWEEN DATE_FORMAT(CURDATE(), "%Y-01-01") AND CURDATE()');
				break;
			case 'last_year':
				$this->db->where('karir.mulai_posting BETWEEN DATE_FORMAT(CURDATE() - INTERVAL 1 YEAR, "%Y-01-01") AND DATE_FORMAT(CURDATE() - INTERVAL 1 YEAR, "%Y-12-31")');
				break;
			case 'custom':
				$startDate = $this->input->post('startDate');
				$endDate = $this->input->post('endDate');
				if ($startDate && $endDate) {
					$this->db->where('karir.mulai_posting >=', $startDate);
					$this->db->where('karir.mulai_posting <=', $endDate);
				}
				break;
			default:
				break;
		}
	}


	public function getKarirDataCore_get($option = null, $startDate = null, $endDate = null, $product = null)
	{

		$this->db->select('karir.id_karir, karir.id_product, karir.posisi, karir.lokasi_penempatan, karir.mulai_posting, karir.akhir_posting,  karir.whatsapp, karir.email, karir.kualifikasi, karir.benefit, karir.gaji, karir.jam_kerja, products.name_product, products.logo');
		if($product != '' || !empty($product)) {
			$this->db->where('karir.id_product', $product);
		}
		$this->db->from('karir');
		$this->db->join('products', 'products.id_product = karir.id_product', 'left');
		if(!empty($option) ){
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


	public function get_datatables($option = null, $startDate = null, $endDate = null, $product = null)
	{
		$this->getKarirDataCore_get($option, $startDate , $endDate , $product );
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}


	public function count_filtered($option = null, $startDate = null, $endDate = null, $product = null)
	{
		$this->getKarirDataCore_get($option, $startDate, $endDate, $product);
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function count_all()
	{
		$this->db->from('karir');
		return $this->db->count_all_results();
	}

}

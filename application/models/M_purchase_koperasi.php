<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_purchase_koperasi extends CI_Model {

	public function findAll_get()
	{
		return $this->db->get('purchase_koperasi')->result_array();
	}

	public function findByPiutangId_get($id)
	{
		return $this->db->get_where('purchase_koperasi', ['id_koperasi' => $id])->result_array();
	}



	public function create_post($data)
	{
		if ($this->db->insert('purchase_koperasi', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}


	public function delete($id)
	{
		return $this->db->delete('purchase_koperasi', ['id_koperasi' => $id]);
	}

	public function delete_purchase($id)
	{
		return $this->db->delete('purchase_koperasi', ['id_purchase_koperasi' => $id]);
	}


	public function getTotalPaymentAmount_get()
	{
		$this->db->select_sum('pay_amount');

		$query = $this->db->get('purchase_koperasi');
		return $query->row()->payment_amount;
	}

	public function deleteByKoperasiId_get($id)
	{
		return $this->db->delete('purchase_koperasi', ['id_koperasi' => $id]);
	}

	//========================V2
	public function findByPiutangIdV2_get($id)
	{

		$this->db->select('purchase_koperasi.id_purchase_koperasi, purchase_koperasi.id_koperasi, purchase_koperasi.pay_amount, purchase_koperasi.description, purchase_koperasi.pay_date, purchase_koperasi.jatuh_tempo, purchase_koperasi.status, koperasi.id_koperasi, koperasi.angsuran');
		$this->db->from('purchase_koperasi');
		$this->db->where('purchase_koperasi.id_koperasi', $id);
		$this->db->join('koperasi', 'koperasi.id_koperasi = purchase_koperasi.id_koperasi', 'left');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function pay_post($id, $data)
	{
		$this->db->where('id_purchase_koperasi', $id);
		return $this->db->update('purchase_koperasi', $data);
	}



}

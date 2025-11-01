<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_white_list extends CI_Model {

	public function findAll_get()
	{
		return $this->db->get('ip_white_list')->result_array();
	}

	public function findById_get($id)
	{
		return $this->db->get_where('ip_white_list', ['id_ip_white_list' => $id])->row_array();
	}

	public function findByEmployeeId_get($id)
	{
		return $this->db->get_where('ip_white_list', ['id_ip_white_list' => $id])->result_array();
	}

	public function create_post($data)
	{
		if ($this->db->insert('ip_white_list', $data)) {
			return true;
		} else {
			return false;
		}
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_ip_white_list', $id);
		return $this->db->update('ip_white_list', $data);
	}


	public function delete($id)
	{
		return $this->db->delete('ip_white_list', ['id_ip_white_list' => $id]);
	}

	public function findByWhiteList_get($whiteList){
		return $this->db->get_where('ip_white_list', ['white_list' => $whiteList])->row_array();
	}

	public function getAllIds_get() {
		$this->db->select('id_ip_white_list');
		$this->db->from('ip_white_list');
		$query = $this->db->get();

		return $query->result_array();
	}

}

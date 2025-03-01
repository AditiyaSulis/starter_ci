<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_log_contract_extension extends CI_Model {

	public function findAll_get()
	{
		return $this->db->get('log_contract_extension')->result_array();
	}

	public function delete_post($id){
		return $this->db->delete('log_contract_extension', ['id_log_contract_extension' => $id]);
	}


	public function findByEmployeeId_get($id)
	{
		return $this->db->get_where('log_contract_extension', ['id_employee' => $id])->result_array();
	}


	public function create_post($data)
	{
		if ($this->db->insert('log_contract_extension', $data)) {
			return true;
		} else {
			return false;
		}
	}


	public function delete($id)
	{
		return $this->db->delete('log_contract_extension', ['id_log_contract_extension' => $id]);
	}

	public function deleteByEmployeeId_get($id)
	{
		return $this->db->delete('log_contract_extension', ['id_employee' => $id]);
	}

}

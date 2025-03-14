<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pkp extends CI_Model {

	public function findAll_get()
	{
		return $this->db->get('pkp')->result_array();
	}


	public function findById_get($id)
	{
		return $this->db->get_where('pkp', ['id_pkp' => $id])->row_array();
	}


	public function findByEmployeeId_get($id)
	{
		return $this->db->get_where('pkp', ['id_pkp' => $id])->result_array();
	}


	public function create_post($data)
	{
		if ($this->db->insert('pkp', $data)) {
			return true;
		} else {
			return false;
		}
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_pkp', $id);
		return $this->db->update('pkp', $data);
	}


	public function delete($id)
	{
		return $this->db->delete('pkp', ['id_pkp' => $id]);
	}


	public function findByCodePtkp_get($code){
		return $this->db->get_where('pkp', ['code_pkp' => $code])->row_array();
	}


}

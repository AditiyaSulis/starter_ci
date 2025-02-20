<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Workshift extends CI_Model {

	public function findAll_get()
	{
		return $this->db->get('workshift')->result_array();
	}

	public function findById_get($id)
	{
		return $this->db->get_where('workshift', ['id_workshift' => $id])->row_array();
	}

	public function create_post($data)
	{
		if ($this->db->insert('workshift', $data)) {
			return true;
		} else {
			return false;
		}
	}

	public function update_post($id, $data)
	{
		$this->db->where('id_workshift', $id);
		return $this->db->update('workshift', $data);
	}


	public function delete($id)
	{
		return $this->db->delete('workshift', ['id_workshift' => $id]);
	}

	public function findByCodeWorkshift_get($code){
		return $this->db->get_where('workshift', ['code_workshift' => $code])->row_array();
	}


}

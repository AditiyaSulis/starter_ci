<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Domisili extends CI_Model {

	public function findAll_get()
	{
		return $this->db->get('domisili')->result_array();
	}


	public function delete_post($id)
	{
		return $this->db->delete('domisili', ['id_domisili' => $id]);
	}


	public function findByEmployeeId_get($id)
	{
		return $this->db->get_where('domisili', ['id_employee' => $id])->result_array();
	}


	public function create_post($data)
	{
		if ($this->db->insert('domisili', $data)) {
			return true;
		} else {
			return false;
		}
	}


	public function delete($id)
	{
		return $this->db->delete('domisili', ['id_domisili' => $id]);
	}


	public function deleteByEmployeeId_get($id)
	{
		return $this->db->delete('domisili', ['id_employee' => $id]);
	}


	public function update_post($id, $data) 
    {
        $this->db->where('id_employee', $id);
        return $this->db->update('domisili', $data);
    }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_address extends CI_Model {

	public function findAll_get()
	{
		return $this->db->get('address')->result_array();
	}


	public function delete_post($id){
		return $this->db->delete('address', ['id_address' => $id]);
	}


	public function findByEmployeeId_get($id)
	{
		return $this->db->get_where('address', ['id_employee' => $id])->result_array();
	}

	
    public function update_post($id, $data) 
    {
        $this->db->where('id_employee', $id);
        return $this->db->update('address', $data);
    }


	public function create_post($data)
	{
		if ($this->db->insert('address', $data)) {
			return true;
		} else {
			return false;
		}
	}


	public function delete($id)
	{
		return $this->db->delete('address', ['id_address' => $id]);
	}


	public function deleteByEmployeeId_get($id)
	{
		return $this->db->delete('address', ['id_employee' => $id]);
	}

}

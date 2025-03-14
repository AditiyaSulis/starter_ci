<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bpjs_config extends CI_Model {

	public function findAll_get()
	{
		return $this->db->get('bpjs_config')->result_array();
	}


	public function delete_post($id){
		return $this->db->delete('bpjs_config', ['id_bpjs_config' => $id]);
	}


	public function findByEmployeeId_get($id)
	{
		return $this->db->get_where('bpjs_config', ['id_employee' => $id])->row_array();
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_employee', $id);
		return $this->db->update('bpjs_config', $data);
	}


	public function create_post($data)
	{
		if ($this->db->insert('bpjs_config', $data)) {
			return true;
		} else {
			return false;
		}
	}


	public function delete($id)
	{
		return $this->db->delete('bpjs_config', ['id_bpjs_config' => $id]);
	}


	public function deleteByEmployeeId_get($id)
	{
		return $this->db->delete('bpjs_config', ['id_employee' => $id]);
	}

}

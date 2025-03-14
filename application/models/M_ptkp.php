<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ptkp extends CI_Model {

	public function findAll_get()
	{
		return $this->db->get('ptkp')->result_array();
	}


	public function findById_get($id)
	{
		return $this->db->get_where('ptkp', ['id_ptkp' => $id])->row_array();
	}


	public function findByEmployeeId_get($id)
	{
		return $this->db->get_where('ptkp', ['id_ptkp' => $id])->result_array();
	}


	public function create_post($data)
	{
		if ($this->db->insert('ptkp', $data)) {
			return true;
		} else {
			return false;
		}
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_ptkp', $id);
		return $this->db->update('ptkp', $data);
	}


	public function delete($id)
	{
		return $this->db->delete('ptkp', ['id_ptkp' => $id]);
	}


	public function findByCodePtkp_get($code){
		return $this->db->get_where('ptkp', ['code_ptkp' => $code])->row_array();
	}


}

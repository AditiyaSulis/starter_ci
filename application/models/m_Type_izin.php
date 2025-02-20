<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Type_izin extends CI_Model {

	public function findAll_get()
	{
		return $this->db->get('type_izin')->result_array();
	}

	public function findById_get($id)
	{
		return $this->db->get_where('type_izin', ['id_type_izin' => $id])->row_array();
	}

	public function findByEmployeeId_get($id)
	{
		return $this->db->get_where('type_izin', ['id_type_izin' => $id])->result_array();
	}


	public function create_post($data)
	{
		if ($this->db->insert('type_izin', $data)) {
			return true;
		} else {
			return false;
		}
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_type_izin', $id);
		return $this->db->update('type_izin', $data);
	}


	public function delete($id)
	{
		return $this->db->delete('type_izin', ['id_type_izin' => $id]);
	}

	public function findByCodetype_izin_get($code){
		return $this->db->get_where('type_izin', ['code_type_izin' => $code])->row_array();
	}

}

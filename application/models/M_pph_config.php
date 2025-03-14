<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pph_config extends CI_Model {

	public function findAll_get()
	{
		return $this->db->get('pph_config')->result_array();
	}


	public function delete_post($id){
		return $this->db->delete('pph_config', ['id_pph_config' => $id]);
	}


	public function findByEmployeeId_get($id)
	{
		$this->db->select('pc.*, ptkp.code_ptkp, ptkp.keterangan_ptkp, ptkp.pot_ptkp');
		$this->db->from('pph_config pc');
		$this->db->join('ptkp', 'ptkp.id_ptkp = pc.id_ptkp', 'left');
		$this->db->where('id_employee', $id);
		return $this->db->get()->row_array();
	}



	public function update_post($id, $data)
	{
		$this->db->where('id_employee', $id);
		return $this->db->update('pph_config', $data);
	}


	public function create_post($data)
	{
		if ($this->db->insert('pph_config', $data)) {
			return true;
		} else {
			return false;
		}
	}


	public function delete($id)
	{
		return $this->db->delete('pph_config', ['id_pph_config' => $id]);
	}


	public function deleteByEmployeeId_get($id)
	{
		return $this->db->delete('pph_config', ['id_employee' => $id]);
	}

}

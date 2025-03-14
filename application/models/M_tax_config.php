<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tax_config extends CI_Model {

	public function findAll_get()
	{
		return $this->db->get('tax_config')->result_array();
	}


	public function delete_post($id){
		return $this->db->delete('tax_config', ['id_tax_config' => $id]);
	}


	public function findByEmployeeId_get($id)
	{
		return $this->db->get_where('tax_config', ['id_employee' => $id])->result_array();
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_employee', $id);
		return $this->db->update('tax_config', $data);
	}


	public function create_post($data)
	{
		if ($this->db->insert('tax_config', $data)) {
			return true;
		} else {
			return false;
		}
	}


	public function delete($id)
	{
		return $this->db->delete('tax_config', ['id_tax_config' => $id]);
	}


	public function deleteByEmployeeId_get($id)
	{
		return $this->db->delete('tax_config', ['id_employee' => $id]);
	} 

    
    public function create_batch_post($data)
	{
		if ($this->db->insert_batch('tax_config', $data)) {
			return true;
		} else {
			return false;
		}
	}


	public function findLastAkumulationPPH_get($emp_id, $date) {
		$this->db->select('tc.*, pc.tanggal_gajian, pc.periode_gajian, pc.id_employee');
		$this->db->from('tax_config tc');
		$this->db->join('payroll_component pc', 'pc.id_payroll_component = tc.id_payroll_component', 'left');
		$this->db->where('pc.id_employee', $emp_id);
		$this->db->where('MONTH(pc.periode_gajian)', $date); // Pastikan tanggal_gajian ada di payroll_component

		$query = $this->db->get()->row_array();
		return $query;
	}
}

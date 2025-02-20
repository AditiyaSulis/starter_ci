<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Division extends CI_Model {

    public function findAll_get()
    {
        return $this->db->get('division')->result_array();
    }

    public function findById_get($id)
    {
        return $this->db->get_where('division', ['id_division' => $id])->row_array();
    }

    public function findByEmployeeId_get($id)
    {
        return $this->db->get_where('division', ['id_division' => $id])->result_array();
    }


    public function create_post($data)
    {
        if ($this->db->insert('division', $data)) {
            return true;
        } else {
            return false;
        }
    }


    public function update_post($id, $data)
    {
        $this->db->where('id_division', $id);
        return $this->db->update('division', $data);
    }
    

    public function delete($id)
    {
        return $this->db->delete('division', ['id_division' => $id]);
    }

    public function findByCodeDivision_get($code){
        return $this->db->get_where('division', ['code_division' => $code])->row_array();
    }

	public function getAllIds_get() {
		$this->db->select('id_division');
		$this->db->from('division');
		$query = $this->db->get();

		return $query->result_array();
	}

}

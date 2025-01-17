<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Position extends CI_Model {

    public function findAll_get()
    {
        return $this->db->get('position')->result_array();
    }

    public function findById_get($id)
    {
        return $this->db->get_where('position', ['id_position' => $id])->row_array();
    }


    public function findByEmployeeId_get($id)
    {
        return $this->db->get_where('position', ['id_position' => $id])->result_array();
    }


    public function create_post($data)
    {
        if ($this->db->insert('position', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function update_post($id, $data)
    {
        $this->db->where('id_position', $id);
        return $this->db->update('position', $data);
    }
    

    public function delete($id)
    {
        return $this->db->delete('position', ['id_position' => $id]);
    }


    public function findByCodePosition_get($code){
        return $this->db->get_where('position', ['code_position' => $code])->row_array();
    }
}
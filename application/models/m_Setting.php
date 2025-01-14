<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Setting extends CI_Model {
  
    public function findAll_get()
    {
        return $this->db->get('company_profile')->result_array();
    }


    public function update_post($id, $data) 
    {
        $this->db->where('id', $id);
        return $this->db->update('company_profile', $data);
    }
    

    public function findById_get($id) 
    {
        if (!is_numeric($id)) {
            return null;
        }

        $this->db->where('id', $id);
        $query = $this->db->get('company_profile'); 

        if ($query->num_rows() > 0) {
            return $query->row_array();  
        }
        
        return null;
    }

}
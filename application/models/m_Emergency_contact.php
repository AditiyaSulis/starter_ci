<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Emergency_contact extends CI_Model {

    public function findAll_get()
    {
        return $this->db->get('emergency_contact')->result_array();
    }


    //Test
    public function delete_post($id){
        return $this->db->delete('emergency_contact', ['id_contact' => $id]);
    }


    public function findByEmployeeId_get($id)
    {
        return $this->db->get_where('emergency_contact', ['id_employee' => $id])->result_array();
    }


    public function create_post($data)
    {
        if ($this->db->insert('emergency_contact', $data)) {
            return true;
        } else {
            return false;
        }
    }
    

    public function delete($id)
    {
        return $this->db->delete('emergency_contact', ['id_contact' => $id]);
    }

    public function deleteByEmployeeId_get($id)
    {
        return $this->db->delete('emergency_contact', ['id_employee' => $id]);
    }

}
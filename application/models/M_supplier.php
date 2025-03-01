<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_supplier extends CI_Model {

    public function create_post($data)
    {
        if ($this->db->insert('supplier', $data)) {
            return true;
        } else {
            return false;
        }
    }


    public function findById_get($id) 
    {
      return $this->db->get_where('supplier', ['id_supplier' => $id])->row_array();
    }


    public function findAllIsActive() 
    {
      return $this->db->get_where('supplier', ['status_supplier' => 1])->result_array();
    }


    public function findByName_get($name) 
    {
      return $this->db->get_where('supplier', ['name_supplier' => $name])->row_array();
    }


    public function findAll_get()
    {
        return $this->db->get('supplier')->result_array();
    }


    public function delete($id)
    {
        return $this->db->delete('supplier', ['id_supplier' => $id]);
    }


    public function update_post($id, $data) 
    {
        $this->db->where('id_supplier', $id);
        return $this->db->update('supplier', $data);
    }
    

    public function setStatus_post($id, $status)
    {

      $this->db->set('status_supplier', $status);
      $this->db->where('id_supplier', $id);
      $this->db->update('supplier');

      return true;

    }

}

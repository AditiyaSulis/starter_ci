<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Products extends CI_Model {
    public function create_post($data){
        if ($this->db->insert('products', $data)) {
            return true;
        } else {
            return false;
        }
    }


    public function findById_get($id) {
        if (!is_numeric($id)) {
            return null;
        }

        $this->db->where('id_product', $id);
        $query = $this->db->get('products'); 

        if ($query->num_rows() > 0) {
            return $query->row_array();  
        }
        
        return null;
    }

    public function findAll_get(){
        return $this->db->get('products')->result_array();
    }

    public function delete($id){

        return $this->db->delete('products', ['id_product' => $id]);
    }

    public function update_post($id, $data) {
        $this->db->where('id_product', $id);
        return $this->db->update('products', $data);
    }

    public function totalProducts_get(){
        $count =  $this->db->get('products')->num_rows();
    
        return $count;
       }
}
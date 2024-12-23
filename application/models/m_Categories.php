<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Categories extends CI_Model {
    
    public function findById($id){
        return $this->db->get_where('categories', ['id_kategori' => $id])->row_array();
    }
    
    public function get_all(){
        return $this->db->get('categories')->result_array();
    }

    public function get_by_i(){
        return $this->db->get_where('categories', ['id_kategori' => '1'])->result_array();
    }

    public function get_by_e(){
        $db = $this->db->select('id_kategori, name_kategori');
        $this->db->from('categories');
        $this->db->where(['id_kategori' => 2]);
        $query = $this->db->get();
        
        return $query->result();
    }

    public function get_by_a(){
        return $this->db->get_where('categories', ['id_kategori' => '3'])->result_array();
    }

    public function get_by_l(){
        return $this->db->get_where('categories', ['id_kategori' => '4'])->result_array();
    }

    public function get_by_eq(){
        return $this->db->get_where('categories', ['id_kategori' => '5'])->result_array();
    }

}
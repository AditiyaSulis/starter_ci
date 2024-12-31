<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Categories extends CI_Model {
    
    public function findById_get($id)
    {
        return $this->db->get_where('categories', ['id_kategori' => $id])->row_array();
    }
    
    public function findAll_get()
    {
        return $this->db->get('categories')->result_array();
    }

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_categories extends CI_Model {
    
    public function findById_get($id)
    {
        return $this->db->get_where('categories', ['id_kategori' => $id])->row_array();
    }
    
    public function findAll_get()
    {
        return $this->db->get('categories')->result_array();
    } 

    public function findCashflow_get()
    {
        $this->db->where_in('id_kategori', [1,2]);
        $query =  $this->db->get('categories')->result_array();
        $query[0]['name_kategori'] = 'Pemasukan';
        $query[1]['name_kategori'] = 'Pengeluaran';

        return $query;
    }

}

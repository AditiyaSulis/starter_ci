<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Account_code extends CI_Model {

    public function findAll_get(){
        return $this->db->get('account_code')->result_array();
    }

    public function findByCode_get($code){
        return $this->db->get_where('account_code', ['code' => $code])->row_array();
    }
    public function findById_get($id){
        return $this->db->get_where('account_code', ['id_code' => $id])->row_array();
    }

    public function findAllWithJoin_get(){
        $this->db->select('account_code.id_code, account_code.code, account_code.name_code, account_code.id_kategori, categories.name_kategori ');
        $this->db->from('account_code');
        $this->db->join('categories', 'categories.id_kategori = account_code.id_kategori', 'left');
        $this->db->order_by('categories.name_kategori', 'ASC');
        $this->db->order_by('account_code.code', 'ASC');
    
        return $this->db->get()->result_array();
    }

    public function update_post($id, $data) {
        $this->db->where('id_code', $id);
        return $this->db->update('account_code', $data);
    }

    public function delete($id){

        return $this->db->delete('account_code', ['id_code' => $id]);
    }

    public function findByCategoryId_get($id){

        return $this->db->get_where('account_code', ['id_kategori' => $id])->result_array();
    }

    public function create_post($data){
        if ($this->db->insert('account_code', $data)) {
            return true;
        } else {
            return false;
        }
    }

}
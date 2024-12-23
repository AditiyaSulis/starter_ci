<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Account_code extends CI_Model {
    
    public function create($data){
        if ($this->db->insert('account_code', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_all(){
        return $this->db->get('account_code')->result_array();
    }

    public function get_all_join(){
        $sql = "SELECT account_code.id_code,account_code.code, account_code.name_code, categories.name_kategori
        FROM account_code 
        LEFT JOIN categories ON categories.id_kategori = account_code.id_kategori";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function delete($id){

        return $this->db->delete('account_code', ['id_code' => $id]);
    }

    public function findByCategoryId($id){

        return $this->db->get_where('account_code', ['id_kategori' => $id])->result_array();
    }

}
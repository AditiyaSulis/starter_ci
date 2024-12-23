<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Finance_records extends CI_Model {
    
    public function findByProductId($id){
        return $this->db->get_where('finance_records', ['product_id' => $id])->row_array();
    }

    public function get_all_join(){

        $this->db->select('F.*, A.name_code, A.code, P.name_product, C.id_kategori, C.name_kategori');
        $this->db->from('finance_records F');
        $this->db->join('products P', 'P.id_product = F.product_id');
        $this->db->join('account_code A', 'A.id_code = F.id_code');
        $this->db->join('categories C', 'C.id_kategori = A.id_kategori');
        $this->db->order_by('F.created_at', 'DESC');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function create($data){
        if ($this->db->insert('finance_records', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function update($id, $data) {
        $this->db->where('id_record', $id);
        return $this->db->update('finance_records', $data);
    }

    public function delete($id){

        return $this->db->delete('finance_records', ['id_record' => $id]);
    }

    public function total_finance_records(){
        $count =  $this->db->get('finance_records')->num_rows();
    
        return $count;
       }
}
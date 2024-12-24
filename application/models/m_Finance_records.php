<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Finance_records extends CI_Model {

    private $table = 'finance_records F'; 
    private $column_order = array('F.created_at', 'F.record_date', 'C.name_kategori', 'P.name_product', 'F.amount', 'A.name_code', 'F.description'); 
    private $column_search = array('F.created_at', 'F.record_date', 'C.name_kategori', 'P.name_product', 'F.amount', 'A.name_code', 'F.description'); 
    private $order = array('F.created_at' => 'desc'); 
    
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

    public function findById($id){
        return $this->db->get_where('finance_records', ['id_record' => $id])->row_array();
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


    private function _get_datatables_query()
    {
            $this->db->select('F.*, A.name_code, A.code, P.name_product, C.id_kategori, C.name_kategori');
            $this->db->from($this->table);
            $this->db->join('products P', 'P.id_product = F.product_id');
            $this->db->join('account_code A', 'A.id_code = F.id_code');
            $this->db->join('categories C', 'C.id_kategori = A.id_kategori');
   
           $i = 0;
           foreach ($this->column_search as $item) {
               if (@$_POST['search']['value']) {
                   if ($i === 0) { 
                       $this->db->group_start();
                       $this->db->like($item, $_POST['search']['value']);
                   } else {
                       $this->db->or_like($item, $_POST['search']['value']);
                   }
                   if (count($this->column_search) - 1 === $i) {
                       $this->db->group_end();
                   }
               }
               $i++;
           }
   
           if (isset($_POST['order'])) { 
               $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
           } else { 
               $this->db->order_by(key($this->order), $this->order[key($this->order)]);
           }
       }
   
    public function get_datatables()
    {
           $this->_get_datatables_query();
           if (@$_POST['length'] != -1) {
               $this->db->limit(@$_POST['length'], @$_POST['start']);
           }
           $query = $this->db->get();
           return $query->result();
       }
   
       public function count_filtered()
       {
           $this->_get_datatables_query();
           $query = $this->db->get();
           return $query->num_rows();
       }
   
       public function count_all()
       {
           $this->db->from($this->table);
           return $this->db->count_all_results();
       }
}
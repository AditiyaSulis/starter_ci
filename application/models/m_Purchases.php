<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Purchases extends CI_Model {
  
    public function create_post($data)
    {
        if ($this->db->insert('purchases', $data)) {
            return true;
        } else {
            return false;
        }
    }


    public function findById_get($id) 
    {
      return $this->db->get_where('purchases', ['id_purchases' => $id])->row_array();
    }


    public function findBySupplierId_get($id) 
    {
      return $this->db->get_where('purchases', ['id_supplier' => $id])->row_array();
    }


    public function findAll_get()
    {
        return $this->db->get('purchases')->result_array();
    }


    public function findAllWithJoin_get()
    {
        $this->db->select('P.*, S.id_supplier, S.name_supplier');
        $this->db->where('status_purchases', '0');
        $this->db->where('S.status_supplier', '1');
        $this->db->from('purchases P');
        $this->db->join('supplier S', 'S.id_supplier = P.id_supplier');
        $this->db->order_by('P.input_at', 'DESC');

        $query = $this->db->get();

        return $query->result_array();
    }


    public function findAllByPaidWithJoin_get()
    {
        $this->db->select('P.*, S.id_supplier, S.name_supplier');
        $this->db->where('status_purchases', '1');
        $this->db->where('S.status_supplier', '1');
        $this->db->from('purchases P');
        $this->db->join('supplier S', 'S.id_supplier = P.id_supplier');
        $this->db->order_by('P.input_at', 'DESC');

        $query = $this->db->get();

        return $query->result_array();
    }


    public function delete($id)
    {
        return $this->db->delete('purchases', ['id_purchases' => $id]);
    }
    

    public function update_post($id, $data) 
    {
        $this->db->where('id_purchases', $id);
        return $this->db->update('purchases', $data);
    }

}
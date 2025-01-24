<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Purchase_piutang extends CI_Model {

    public function findAll_get()
    {
        return $this->db->get('purchase_piutang')->result_array();
    }


    public function findByPiutangId_get($id)
    {
        return $this->db->get_where('purchase_piutang', ['id_piutang' => $id])->result_array();
    }

    public function create_post($data)
    {
        if ($this->db->insert('purchase_piutang', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        return $this->db->delete('purchase_piutang', ['id_piutang' => $id]);
    }

    public function getTotalPaymentAmount_get()
    {
        $this->db->select_sum('pay_amount'); 

        $query = $this->db->get('purchase_piutang'); 
        return $query->row()->payment_amount; 
    }

    public function deleteByPiutangId_get($id)
    {
        return $this->db->delete('purchase_piutang', ['id_piutang' => $id]);
    }

}
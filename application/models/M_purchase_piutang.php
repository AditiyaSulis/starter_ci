<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_purchase_piutang extends CI_Model {

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

    //========================V2
    public function findByPiutangIdV2_get($id)
    {

        $this->db->select('purchase_piutang.id_purchase_piutang, purchase_piutang.id_piutang, purchase_piutang.pay_amount, purchase_piutang.description, purchase_piutang.pay_date, purchase_piutang.jatuh_tempo, purchase_piutang.status, piutang.id_piutang, piutang.angsuran');
        $this->db->from('purchase_piutang'); 
        $this->db->where('purchase_piutang.id_piutang', $id);
        $this->db->join('piutang', 'piutang.id_piutang = purchase_piutang.id_piutang', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function pay_post($id, $data)
    {
        $this->db->where('id_purchase_piutang', $id);
        return $this->db->update('purchase_piutang', $data);
    }

    

}

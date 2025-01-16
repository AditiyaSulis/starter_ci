<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Purchase_payment extends CI_Model {

    public function findAll_get()
    {
        return $this->db->get('purchase_payments')->result_array();
    }


    public function findByPurchasesId_get($id)
    {
        return $this->db->get_where('purchase_payments', ['id_purchases' => $id])->result_array();
    }

    public function create_post($data)
    {
        if ($this->db->insert('purchase_payments', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        return $this->db->delete('purchase_payments', ['id_purchases' => $id]);
    }

}
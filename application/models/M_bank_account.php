<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bank_account extends CI_Model {

    public function findAll_get()
    {
        return $this->db->get('bank_account')->result_array();
    }


    public function findByEmployeeId_get($id)
    {
        return $this->db->get_where('bank_account', ['id_employee' => $id])->result_array();
    }

    public function create_post($data)
    {
        if ($this->db->insert('bank_account', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        return $this->db->delete('bank_account', ['id_bank' => $id]);
    }

    public function deleteByEmployeeId_get($id)
    {
        return $this->db->delete('bank_account', ['id_employee' => $id]);
    }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Employees extends CI_Model {
    
    public function findById_get($id){
        return $this->db->get_where('employee', ['id_employee' => $id])->row_array();
    }
    public function findByProductId_get($id){
        return $this->db->get_where('employee', ['id_product' => $id])->row_array();
    }
    
    public function findAll_get(){
        return $this->db->get('employee')->result_array();
    }

    public function findAllJoin_get(){
        $sql = "SELECT employee.id_employee, employee.date_in, employee.nip, employee.name, employee.gender, employee.place_of_birth, employee.date_of_birth, employee.position, employee.status, products.id_product, products.name_product
                FROM employee
                LEFT JOIN products ON products.id_product = employee.id_product";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function create_post($data){
        if ($this->db->insert('employee', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id){

        return $this->db->delete('employee', ['id_employee' => $id]);
    }

    public function findByNip_get($nip) {
       return $this->db->get_where('employee', ['nip' => $nip])->row_array();
    }

    public function update_post($id, $data) {
        $this->db->where('id_employee', $id);
        return $this->db->update('employee', $data);
    }

    public function totalEmployees_get(){
        $count =  $this->db->get('employee')->num_rows();
    
        return $count;
    }


}
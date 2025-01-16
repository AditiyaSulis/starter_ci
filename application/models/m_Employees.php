<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class m_Employees extends CI_Model {
    private $column_search = array('products.name_product', 'employee.date_in', 'employee.nip', 'employee.name', 'employee.gender', 'employee.place_of_birth', 'employee.date_of_birth' , 'employee.basic_salary', 'employee.divisi', 'employee.uang_makan', 'employee.bonus','employee.position'); 
    
    public function findById_get($id)
    {
        return $this->db->get_where('employee', ['id_employee' => $id])->row_array();
    }


    public function findByProductId_get($id)
    {
        return $this->db->get_where('employee', ['id_product' => $id])->row_array();
    }

    
    public function findAll_get()
    {
        return $this->db->get('employee')->result_array();
    }


    public function findAllJoin_get()
    {
        $this->db->select('employee.id_employee, employee.date_in, employee.nip, employee.name, employee.gender, employee.place_of_birth, employee.date_of_birth, employee.basic_salary, employee.uang_makan, employee.bonus, employee.position, employee.divisi, employee.status, products.id_product, products.name_product, products.visibility');
        $this->db->from('employee');
        $this->db->join('products', 'products.id_product = employee.id_product', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function create_post($data)
    {
        if ($this->db->insert('employee', $data)) {
            return true;
        } else {
            return false;
        }
    }


    public function delete($id)
    {
        return $this->db->delete('employee', ['id_employee' => $id]);
    }


    public function findByNip_get($nip) 
    {
       return $this->db->get_where('employee', ['nip' => $nip])->row_array();
    }


    public function update_post($id, $data) 
    {
        $this->db->where('id_employee', $id);
        return $this->db->update('employee', $data);
    }


    public function totalEmployees_get()
    {
        $count =  $this->db->get('employee')->num_rows();
    
        return $count;
    }
    

    public function getEmployeesData($product = null) 
    {
        $this->db->select('employee.id_employee, employee.date_in, employee.nip, employee.name, employee.gender, employee.place_of_birth, employee.date_of_birth, employee.basic_salary, employee.uang_makan, employee.bonus, employee.position, employee.divisi, employee.status, products.id_product, products.name_product');
       
        $this->db->from('employee');
        $this->db->join('products', 'products.id_product = employee.id_product', 'left');
    
        if ($product && $product !== 'All') {  
            $this->db->where('employee.id_product', $product);
        }

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
    
        $query = $this->db->get();
        return $query->result_array();  
    }


}
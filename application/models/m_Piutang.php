<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class m_Piutang extends CI_Model {
    private $column_search = array('employee.name', 'piutang.remaining_piutang', 'piutang.amount_piutang'); 
    
    public function findById_get($id)
    {
        return $this->db->get_where('piutang', ['id_piutang' => $id])->row_array();
    }


    public function findByProductId_get($id)
    {
        return $this->db->get_where('employee', ['id_product' => $id])->row_array();
    }

    public function findByEmployeeId_get($id){
        return $this->db->get_where('piutang', ['id_employee' => $id])->row_array();
    }

    public function unpaid_get($id){
        return $this->db->get_where('piutang', ['id_employee' => $id, 'status_piutang' => 2])->row_array();
    }

    public function findAllWithUnpaid_get($id){
        return $this->db->get_where('piutang', ['status_piutang' => 2])->result_array();
    }

    
    public function findAll_get()
    {
        return $this->db->get('piutang')->result_array();
    }


    public function findAllJoin_get()
    {
        $this->db->select('piutang.id_piutang, piutang.id_employee, piutang.type_piutang, piutang.tenor_piutang, piutang.amount_piutang, piutang.tgl_lunas, piutang.remaining_piutang, piutang.status_piutang, piutang.progress_piutang,  piutang.piutang_date, piutang.angsuran_piutang, piutang.description_piutang, employee.id_employee, employee.name');
        $this->db->from('piutang');
        $this->db->join('employee', 'employee.id_employee = piutang.id_employee', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function create_post($data)
    {
        if ($this->db->insert('piutang', $data)) {
            return true;
        } else {
            return false;
        }
    }


    public function delete($id)
    {
        return $this->db->delete('piutang', ['id_piutang' => $id]);
    }


    public function update_post($id, $data) 
    {
        $this->db->where('id_piutang', $id);
        return $this->db->update('piutang', $data);
    }


    public function getPiutangData_get($type = null, $pelunasan = null ) 
    {
        $this->db->select('piutang.id_piutang, piutang.id_employee, piutang.type_piutang, piutang.tenor_piutang, piutang.amount_piutang, piutang.tgl_lunas, piutang.remaining_piutang, piutang.status_piutang, piutang.progress_piutang, piutang.description_piutang, piutang.piutang_date, piutang.angsuran_piutang, employee.id_employee, employee.name');
        $this->db->from('piutang');
        $this->db->where('status_piutang', 2);
        $this->db->join('employee', 'employee.id_employee = piutang.id_employee', 'left');
    
        if ($type && $type !== 'All') {  
            $this->db->where('piutang.type_piutang', $type);
        }
        if ($pelunasan && $pelunasan !== 'All') {  
            $this->db->where('piutang.tgl_lunas', $pelunasan);
        } else if ($pelunasan && $pelunasan == 'next_month') {
            $this->db->where('piutang.tgl_lunas BETWEEN DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 1 MONTH), "%Y-%m-01") AND LAST_DAY(DATE_ADD(CURDATE(), INTERVAL 1 MONTH))');
        } else if($pelunasan && $pelunasan == 'this_month'){
            $this->db->where('piutang.tgl_lunas BETWEEN DATE_FORMAT(CURDATE(), "%Y-%m-01") AND LAST_DAY(CURDATE())');
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


    public function setStatus_post($id, $status)
    {

      $this->db->set('status_piutang', $status);
      $this->db->where('id_piutang', $id);
      $this->db->update('piutang');

      return true;

    }

    
    public function setProgress_post($id, $status)
    {

      $this->db->set('progress_piutang', $status);
      $this->db->where('id_piutang', $id);
      $this->db->update('piutang');

      return true;

    }


    public function updateRemaining_post($id, $remaining)
    {

      $this->db->set('remaining_piutang', $remaining);
      $this->db->where('id_piutang', $id);
      $this->db->update('piutang');

      return true;

    }


    public function getPiutangWithPaid_get($type = null) 
    {
        $this->db->select('piutang.id_piutang, piutang.id_employee, piutang.type_piutang, piutang.tenor_piutang, piutang.amount_piutang, piutang.tgl_lunas, piutang.remaining_piutang, piutang.status_piutang, piutang.progress_piutang, piutang.description_piutang, piutang.piutang_date, piutang.angsuran_piutang, employee.id_employee, employee.name, employee.nip, employee.id_position, position.id_position, position.name_position ');
        $this->db->from('piutang');
        $this->db->where('status_piutang', 1);
        $this->db->join('employee', 'employee.id_employee = piutang.id_employee', 'left');
        $this->db->join('position', 'employee.id_position = position.id_position', 'left');
    
        if ($type && $type !== 'All') {  
            $this->db->where('piutang.type_piutang', $type);
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


    public function getTotalAmountPiutang_get($id)
    {
        $this->db->select_sum('amount_piutang', 'total_amount');
        $this->db->where('id_employee', $id);
        $this->db->where('status_piutang', 2);
        $query = $this->db->get('piutang');

        if ($query->num_rows() > 0) {
            return $query->row()->total_amount;
        }

        return 0; 
    }
        

}
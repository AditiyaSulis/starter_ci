<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_asset_movement extends CI_Model {

    public function get_history_by_asset($id_asset) {
        $this->db->select('am.*, 
            e1.name as from_employee_name, 
            e2.name as to_employee_name,
            l1.location_name as from_location_name,
            l2.location_name as to_location_name');
        $this->db->from('asset_movement am');
        $this->db->join('employee e1', 'am.from_employee = e1.id_employee', 'left');
        $this->db->join('employee e2', 'am.to_employee = e2.id_employee', 'left');
        $this->db->join('asset_location l1', 'am.from_location = l1.id_asset_location', 'left');
        $this->db->join('asset_location l2', 'am.to_location = l2.id_asset_location', 'left');
        $this->db->where('am.id_asset', $id_asset);
        $this->db->order_by('am.movement_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function insert($data) {
        return $this->db->insert('asset_movement', $data);
    }

    public function delete($id) {
        $this->db->where('id_asset_movement', $id);
        return $this->db->delete('asset_movement');
    }
}
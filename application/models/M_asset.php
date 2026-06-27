<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_asset extends CI_Model {

    private $column_search = array(
        'asset.asset_code', 'asset.asset_name', 'asset.brand', 'asset.model',
        'asset.serial_number', 'asset.status', 'asset.asset_condition',
        'category.category_name', 'location.location_name', 'employee.name'
    );
    private $column_order = array(
        'asset.id_asset', 'asset.asset_code', 'asset.asset_name',
        'category.category_name', 'location.location_name', 'employee.name',
        'asset.status', 'asset.asset_condition', 'asset.purchase_date'
    );
    private $order = array('asset.id_asset' => 'desc');

    public function findAll_get() {
        return $this->db->get('asset')->result();
    }

    public function findById_get($id) {
        $this->db->select('asset.*, category.category_name, location.location_name, employee.name as employee_name');
        $this->db->from('asset');
        $this->db->join('asset_category as category', 'category.id_asset_category = asset.id_asset_category', 'left');
        $this->db->join('asset_location as location', 'location.id_asset_location = asset.id_location', 'left');
        $this->db->join('employee', 'employee.id_employee = asset.id_employee', 'left');
        $this->db->where('asset.id_asset', $id);
        return $this->db->get()->result();
    } 

    public function get_by_id($id){
        return $this->db->get_where('asset', ['id_asset' => $id])->row();
    }

    public function create_post($data) {
        return $this->db->insert('asset', $data);
    }

    public function update_post($id, $data) {
        $this->db->where('id_asset', $id);
        return $this->db->update('asset', $data);
    }

    public function delete($id) {
        $this->db->where('id_asset', $id);
        return $this->db->delete('asset');
    }

    public function checkUniqueCode($code, $id = null) {
        $this->db->where('asset_code', $code);
        if ($id) {
            $this->db->where('id_asset !=', $id);
        }
        $query = $this->db->get('asset');
        return $query->num_rows() == 0;
    }

    // -------- DataTables Server Side --------
    private function _get_datatables_query($category = null, $location = null, $status = null, $condition = null) {
        $this->db->select('asset.*, category.category_name, location.location_name, employee.name as employee_name');
        $this->db->from('asset');
        $this->db->join('asset_category as category', 'category.id_asset_category = asset.id_asset_category', 'left');
        $this->db->join('asset_location as location', 'location.id_asset_location = asset.id_location', 'left');
        $this->db->join('employee', 'employee.id_employee = asset.id_employee', 'left');

        // Filter
        if (!empty($category)) {
            $this->db->where('asset.id_asset_category', $category);
        }
        if (!empty($location)) {
            $this->db->where('asset.id_location', $location);
        }
        if (!empty($status)) {
            $this->db->where('asset.status', $status);
        }
        if (!empty($condition)) {
            $this->db->where('asset.asset_condition', $condition);
        }

        // Pencarian
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

        // Order
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by(key($this->order), $this->order[key($this->order)]);
        }
    }

    public function get_datatables($category = null, $location = null, $status = null, $condition = null) {
        $this->_get_datatables_query($category, $location, $status, $condition);
        if (@$_POST['length'] != -1) {
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered($category = null, $location = null, $status = null, $condition = null) {
        $this->_get_datatables_query($category, $location, $status, $condition);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from('asset');
        return $this->db->count_all_results();
    }
}
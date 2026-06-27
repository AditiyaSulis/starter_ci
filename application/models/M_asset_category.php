<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_asset_category extends CI_Model {

    private $column_search = array('category_name', 'category_code', 'description');
    private $column_order = array('id_asset_category', 'category_code', 'category_name', 'description');
    private $order = array('id_asset_category' => 'desc');

    public function findAll_get() {
        return $this->db->get('asset_category')->result();
    }

    public function findById_get($id) {
        $this->db->where('id_asset_category', $id);
        return $this->db->get('asset_category')->result();
    }

    public function create_post($data) {
        return $this->db->insert('asset_category', $data);
    }

    public function update_post($id, $data) {
        $this->db->where('id_asset_category', $id);
        return $this->db->update('asset_category', $data);
    }

    public function delete($id) {
        $this->db->where('id_asset_category', $id);
        return $this->db->delete('asset_category');
    }

    public function checkUnique($field, $value, $id = null) {
        $this->db->where($field, $value);
        if ($id) {
            $this->db->where('id_asset_category !=', $id);
        }
        $query = $this->db->get('asset_category');
        return $query->num_rows() == 0;
    }

    // DataTables
    private function _get_datatables_query() {
        $this->db->from('asset_category');

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

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by(key($this->order), $this->order[key($this->order)]);
        }
    }

    public function get_datatables() {
        $this->_get_datatables_query();
        if (@$_POST['length'] != -1) {
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from('asset_category');
        return $this->db->count_all_results();
    }
}
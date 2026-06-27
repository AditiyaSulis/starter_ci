<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_asset_report extends CI_Model {

    public function get_total_per_category($start_date = null, $end_date = null) {
        $this->db->select('
            asset_category.id_asset_category,
            asset_category.category_name,
            COUNT(asset.id_asset) as total_assets,
            SUM(asset.purchase_price) as total_price
        ');
        $this->db->from('asset');
        $this->db->join('asset_category', 'asset.id_asset_category = asset_category.id_asset_category', 'left');
        
        if ($start_date && $end_date) {
            $this->db->where('asset.purchase_date >=', $start_date);
            $this->db->where('asset.purchase_date <=', $end_date);
        }
        
        $this->db->group_by('asset_category.id_asset_category');
        $this->db->order_by('total_price', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }

    public function count_all_assets($start_date = null, $end_date = null) {
        if ($start_date && $end_date) {
            $this->db->where('purchase_date >=', $start_date);
            $this->db->where('purchase_date <=', $end_date);
        }
        return $this->db->count_all_results('asset');
    }
}
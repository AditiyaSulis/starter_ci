<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asset_movement extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_asset_movement');
        $this->load->model('M_employees');
        $this->load->model('M_asset_location');
        $this->load->model('M_asset');
    }

    // Ambil riwayat movement berdasarkan id_asset
    public function get_history() {
        $id_asset = $this->input->post('id_asset');
        if (!$id_asset) {
            echo json_encode(['status' => false, 'message' => 'ID aset tidak ditemukan']);
            return;
        }
        $history = $this->M_asset_movement->get_history_by_asset($id_asset);
        echo json_encode(['status' => true, 'data' => $history]);
    }

    // Tambah movement
    public function add() {
        $this->_ONLYSELECTED([1, 2]);
        $this->_isAjax();

       
        $this->form_validation->set_rules('id_asset', 'ID Aset', 'required');
        $this->form_validation->set_rules('from_employee', 'Dari Karyawan', 'required');
        $this->form_validation->set_rules('to_employee', 'Ke Karyawan', 'required');
        $this->form_validation->set_rules('from_location', 'Dari Lokasi', 'required');
        $this->form_validation->set_rules('to_location', 'Ke Lokasi', 'required');
        $this->form_validation->set_rules('movement_date', 'Tanggal Pindah', 'required');

        if ($this->form_validation->run() == FALSE) {
            $response = [
                'status' => false,
                'message' => validation_errors('<p>', '</p>'),
            ];
            echo json_encode($response);
            return;
        } 

        $dataAsset = $this->M_asset->get_by_id($this->input->post('id_asset'));
        if(!$dataAsset){
            $response =[
                'status' => false,
                'message' => 'Data asset tidak ditemukan',
            ];
            echo json_encode($response);
            return;
        }
        $this->db->trans_begin();
        $data = [
            'id_asset'       => $this->input->post('id_asset'),
            'from_employee'  => $this->input->post('from_employee'),
            'to_employee'    => $this->input->post('to_employee'),
            'from_location'  => $this->input->post('from_location'),
            'to_location'    => $this->input->post('to_location'),
            'movement_date'  => $this->input->post('movement_date'),
            'notes'          => $this->input->post('notes'),
            'created_at'     => date('Y-m-d H:i:s'),
        ]; 

        $insertAssetMovement =  $this->M_asset_movement->insert($data);
        if(!$insertAssetMovement){
            $this->db->trans_rollback();
            $response = ['status' => false, 'message' => 'Gagal menambahkan movement'];
            echo json_encode($response);
            return;
        } 

        $dataUpdateAsset = [
            'id_employee' => $data['to_employee'],
            'id_location' => $data['to_location']
        ];

        $updateAsset = $this->M_asset->update_post($this->input->post('id_asset'), $dataUpdateAsset); 
        if(!$updateAsset){
            $this->db->trans_rollback();
            $response = ['status' => false, 'message' => 'Gagal menambahkan update PIC Asset'];
            echo json_encode($response);
            return $response;
        } 

        if($this->db->trans_status() == FALSE){
            $this->db->trans_rollback();
            $response = ['status' => false, 'message' => 'Transaction gagal'];
        } else {
             $this->db->trans_commit();
            $response = ['status' => true, 'message' => 'Berhasil Membuat Asset Movement'];
        }


        echo json_encode($response);
    }

    // Hapus movement (opsional)
    public function delete() {
        $this->_ONLYSELECTED([1, 2]);
        $this->_isAjax();
        $id = $this->input->post('id_movement');
        if ($this->M_asset_movement->delete($id)) {
            echo json_encode(['status' => true, 'message' => 'Movement dihapus']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Gagal hapus']);
        }
    }
}
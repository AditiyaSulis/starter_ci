<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asset extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_asset');
        $this->load->model('M_asset_category');
        $this->load->model('M_asset_location');
        $this->load->model('M_employees');
    }

    public function asset_page() {
        $this->_ONLYSELECTED([1, 2]); // sesuaikan dengan role yang diizinkan
        $data = $this->_basicData();

        $data['title'] = 'Asset Management';
        $data['view_name'] = 'asset/asset';
        $data['breadcrumb'] = 'Asset';
        $data['menu'] = '';

        // Data untuk dropdown
        $data['categories'] = $this->M_asset_category->findAll_get();
        $data['locations']  = $this->M_asset_location->findAll_get();
        $data['employees']  = $this->M_employees->findAll_get();

        $data['employees_json'] = json_encode($data['employees']); // tambahkan
        $data['locations_json'] = json_encode($data['locations']); // tambahkan
        
        if (isset($data['user']) && $data['user']) {
            $this->load->view('templates/index', $data);
        } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
            redirect('login');
        }
    }

    public function add_asset() {
        $this->_ONLYSELECTED([1, 2]);
        $this->_isAjax();

        // Validasi
        $this->form_validation->set_rules('id_asset_category', 'Kategori', 'required', ['required' => 'Kategori harus diisi']);
        $this->form_validation->set_rules('id_location', 'Lokasi', 'required', ['required' => 'Lokasi harus diisi']);
        $this->form_validation->set_rules('id_employee', 'Penanggung Jawab', 'required', ['required' => 'Penanggung jawab harus diisi']);
        $this->form_validation->set_rules('asset_code', 'Kode Aset', 'required|is_unique[asset.asset_code]', [
            'required' => 'Kode aset harus diisi',
            'is_unique' => 'Kode aset sudah terdaftar'
        ]);
        $this->form_validation->set_rules('asset_name', 'Nama Aset', 'required', ['required' => 'Nama aset harus diisi']);
        $this->form_validation->set_rules('brand', 'Merek', 'required', ['required' => 'Merek harus diisi']);
        $this->form_validation->set_rules('model', 'Model', 'required', ['required' => 'Model harus diisi']);
        $this->form_validation->set_rules('serial_number', 'Nomor Seri', 'required', ['required' => 'Nomor seri harus diisi']);
        $this->form_validation->set_rules('purchase_date', 'Tanggal Pembelian', 'required', ['required' => 'Tanggal pembelian harus diisi']);
        $this->form_validation->set_rules('purchase_price', 'Harga Beli', 'required|numeric', [
            'required' => 'Harga beli harus diisi',
            'numeric' => 'Harga beli harus berupa angka'
        ]);
        $this->form_validation->set_rules('status', 'Status', 'required', ['required' => 'Status harus dipilih']);
        $this->form_validation->set_rules('asset_condition', 'Kondisi', 'required', ['required' => 'Kondisi harus dipilih']);

        if ($this->form_validation->run() == FALSE) {
            $response = [
                'status' => false,
                'message' => validation_errors('<p>', '</p>'),
                'confirmationbutton' => true,
                'timer' => 0,
                'icon' => 'error',
            ];
            echo json_encode($response);
            return;
        }

        $data = [
            'id_asset_category' => $this->input->post('id_asset_category', true),
            'id_location'       => $this->input->post('id_location', true),
            'id_employee'       => $this->input->post('id_employee', true),
            'asset_code'        => $this->input->post('asset_code', true),
            'asset_name'        => $this->input->post('asset_name', true),
            'brand'             => $this->input->post('brand', true),
            'model'             => $this->input->post('model', true),
            'serial_number'     => $this->input->post('serial_number', true),
            'purchase_date'     => $this->input->post('purchase_date', true),
            'purchase_price'    => $this->input->post('purchase_price', true),
            'status'            => $this->input->post('status', true),
            'asset_condition'   => $this->input->post('asset_condition', true),
            'noted'             => $this->input->post('noted', true),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ];

        $insert = $this->M_asset->create_post($data);

        if ($insert) {
            $response = [
                'status' => true,
                'message' => 'Aset berhasil ditambahkan',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Aset gagal ditambahkan',
            ];
        }

        echo json_encode($response);
    }

    public function update() {
        $this->_ONLYSELECTED([1, 2]);
        $this->_isAjax();

        // Validasi (sama seperti add, tapi tanpa unique untuk asset_code karena bisa sama dengan dirinya sendiri)
        $this->form_validation->set_rules('id_asset_category', 'Kategori', 'required', ['required' => 'Kategori harus diisi']);
        $this->form_validation->set_rules('id_location', 'Lokasi', 'required', ['required' => 'Lokasi harus diisi']);
        $this->form_validation->set_rules('id_employee', 'Penanggung Jawab', 'required', ['required' => 'Penanggung jawab harus diisi']);
        $this->form_validation->set_rules('asset_code', 'Kode Aset', 'required', ['required' => 'Kode aset harus diisi']);
        // Untuk update, kita cek unique kecuali dirinya sendiri (akan dihandle di model)
        $this->form_validation->set_rules('asset_name', 'Nama Aset', 'required', ['required' => 'Nama aset harus diisi']);
        $this->form_validation->set_rules('brand', 'Merek', 'required', ['required' => 'Merek harus diisi']);
        $this->form_validation->set_rules('model', 'Model', 'required', ['required' => 'Model harus diisi']);
        $this->form_validation->set_rules('serial_number', 'Nomor Seri', 'required', ['required' => 'Nomor seri harus diisi']);
        $this->form_validation->set_rules('purchase_date', 'Tanggal Pembelian', 'required', ['required' => 'Tanggal pembelian harus diisi']);
        $this->form_validation->set_rules('purchase_price', 'Harga Beli', 'required|numeric', [
            'required' => 'Harga beli harus diisi',
            'numeric' => 'Harga beli harus berupa angka'
        ]);
        $this->form_validation->set_rules('status', 'Status', 'required', ['required' => 'Status harus dipilih']);
        $this->form_validation->set_rules('asset_condition', 'Kondisi', 'required', ['required' => 'Kondisi harus dipilih']);

        if ($this->form_validation->run() == FALSE) {
            $response = [
                'status' => false,
                'message' => validation_errors('<p>', '</p>'),
                'confirmationbutton' => true,
                'timer' => 0,
                'icon' => 'error',
            ];
            echo json_encode($response);
            return;
        }

        $id = $this->input->post('id_asset');
        $data = [
            'id_asset_category' => $this->input->post('id_asset_category', true),
            'id_location'       => $this->input->post('id_location', true),
            'id_employee'       => $this->input->post('id_employee', true),
            'asset_code'        => $this->input->post('asset_code', true),
            'asset_name'        => $this->input->post('asset_name', true),
            'brand'             => $this->input->post('brand', true),
            'model'             => $this->input->post('model', true),
            'serial_number'     => $this->input->post('serial_number', true),
            'purchase_date'     => $this->input->post('purchase_date', true),
            'purchase_price'    => $this->input->post('purchase_price', true),
            'status'            => $this->input->post('status', true),
            'asset_condition'   => $this->input->post('asset_condition', true),
            'noted'             => $this->input->post('noted', true),
            'updated_at'        => date('Y-m-d H:i:s'),
        ];

        // Cek duplikasi asset_code untuk update (kecuali dirinya sendiri)
        $existing = $this->M_asset->findById_get($id);
        if ($existing && $existing[0]->asset_code != $data['asset_code']) {
            $check = $this->M_asset->checkUniqueCode($data['asset_code'], $id);
            if (!$check) {
                $response = [
                    'status' => false,
                    'message' => 'Kode aset sudah terdaftar untuk aset lain',
                ];
                echo json_encode($response);
                return;
            }
        }

        $update = $this->M_asset->update_post($id, $data);

        if ($update) {
            $response = [
                'status' => true,
                'message' => 'Data aset berhasil diupdate',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Data aset gagal diupdate',
            ];
        }

        echo json_encode($response);
    }

    public function delete() {
        $this->_ONLYSELECTED([1, 2]);
        $this->_isAjax();

        $id = $this->input->post('id');

        if ($this->M_asset->delete($id)) {
            $response = [
                'status' => true,
                'message' => 'Data aset berhasil dihapus',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Data aset gagal dihapus',
            ];
        }

        echo json_encode($response);
    }

    public function dtSideserver() {
        // Ambil parameter filter dari POST (opsional)
        $category = $this->input->post('category');
        $location = $this->input->post('location');
        $status   = $this->input->post('status');
        $condition = $this->input->post('condition');

        $list = $this->M_asset->get_datatables($category, $location, $status, $condition);
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $item) {
            $action = '
                <div class="no-print">
                    <a href="javascript:void(0)" onclick="editAssetBtn(this)" class="btn gradient-btn-edit btn-sm btn-sm mb-2 rounded-pill" style="width : 70px" 
                        data-id_asset="' . htmlspecialchars($item->id_asset) . '"
                        data-id_asset_category="' . htmlspecialchars($item->id_asset_category) . '"
                        data-id_location="' . htmlspecialchars($item->id_location) . '"
                        data-id_employee="' . htmlspecialchars($item->id_employee) . '"
                        data-asset_code="' . htmlspecialchars($item->asset_code) . '"
                        data-asset_name="' . htmlspecialchars($item->asset_name) . '"
                        data-brand="' . htmlspecialchars($item->brand) . '"
                        data-model="' . htmlspecialchars($item->model) . '"
                        data-serial_number="' . htmlspecialchars($item->serial_number) . '"
                        data-purchase_date="' . htmlspecialchars($item->purchase_date) . '"
                        data-purchase_price="' . htmlspecialchars($item->purchase_price) . '"
                        data-status="' . htmlspecialchars($item->status) . '"
                        data-asset_condition="' . htmlspecialchars($item->asset_condition) . '"
                        data-noted="' . htmlspecialchars($item->noted) . '">
                        EDIT
                    </a>
                    <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-asset" style="width : 70px"
                        onClick="handleDeleteAssetButton(' . htmlspecialchars($item->id_asset) . ')">
                        DELETE 
                    </button>
                </div>
            ';

            $assetMovement = '
                <div class="no-print">
                    <button class="btn btn-info btn-sm mb-2 rounded-pill btn-movement" style="width:120px" 
                        data-id_asset="'.$item->id_asset.'" 
                        data-id_employee="'.$item->id_employee.'" 
                        data-id_location="'.$item->id_location.'" 
                        onclick="openMovementModal(this)">MOVEMENT
                    </button>
                </div>
            ';

            $row = array();
            $row[] = $item->asset_code;
            $row[] = $item->asset_name;
            $row[] = $item->category_name;
            $row[] = $item->location_name;
            $row[] = $item->employee_name;
            $row[] = ucfirst($item->status);
            $row[] = ucfirst($item->asset_condition);
            $row[] = date('d-m-Y', strtotime($item->purchase_date));
            $row[] = 'Rp ' . number_format($item->purchase_price, 0, ',', '.');
            $row[] = $assetMovement;
            $row[] = $action;

            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_asset->count_all(),
            "recordsFiltered" => $this->M_asset->count_filtered($category, $location, $status, $condition),
            "data" => $data,
        );

        echo json_encode($output);
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asset_location extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_asset_location');
    }

    public function index() {
        $this->_ONLYSELECTED([1, 2]); // sesuaikan role
        $data = $this->_basicData();

        $data['title'] = 'Lokasi Asset';
        $data['view_name'] = 'asset/asset_location';
        $data['breadcrumb'] = 'Asset Location';
        $data['menu'] = 'ASSET';

        if (isset($data['user']) && $data['user']) {
            $this->load->view('templates/index', $data);
        } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
            redirect('login');
        }
    }

    public function add() {
        $this->_ONLYSELECTED([1, 2]);
        $this->_isAjax();

        $this->form_validation->set_rules('location_name', 'Nama Lokasi', 'required|is_unique[asset_location.location_name]', [
            'required' => 'Nama lokasi harus diisi',
            'is_unique' => 'Nama lokasi sudah terdaftar'
        ]);
        $this->form_validation->set_rules('building', 'Gedung', 'required', ['required' => 'Gedung harus diisi']);
        $this->form_validation->set_rules('floor', 'Lantai', 'required', ['required' => 'Lantai harus diisi']);
        $this->form_validation->set_rules('room', 'Ruangan', 'required', ['required' => 'Ruangan harus diisi']);
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim');

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
            'location_name' => $this->input->post('location_name', true),
            'building'      => $this->input->post('building', true),
            'floor'         => $this->input->post('floor', true),
            'room'          => $this->input->post('room', true),
            'description'   => $this->input->post('description', true),
        ];

        if ($this->M_asset_location->create_post($data)) {
            $response = ['status' => true, 'message' => 'Lokasi berhasil ditambahkan'];
        } else {
            $response = ['status' => false, 'message' => 'Lokasi gagal ditambahkan'];
        }
        echo json_encode($response);
    }

    public function update() {
        $this->_ONLYSELECTED([1, 2]);
        $this->_isAjax();

        $id = $this->input->post('id_asset_location');

        $this->form_validation->set_rules('location_name', 'Nama Lokasi', 'required', ['required' => 'Nama lokasi harus diisi']);
        $this->form_validation->set_rules('building', 'Gedung', 'required', ['required' => 'Gedung harus diisi']);
        $this->form_validation->set_rules('floor', 'Lantai', 'required', ['required' => 'Lantai harus diisi']);
        $this->form_validation->set_rules('room', 'Ruangan', 'required', ['required' => 'Ruangan harus diisi']);
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim');

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

        // Cek duplikasi nama (kecuali dirinya sendiri)
        $existing = $this->M_asset_location->findById_get($id);
        if ($existing && $existing[0]->location_name != $this->input->post('location_name')) {
            $check = $this->M_asset_location->checkUniqueName($this->input->post('location_name'), $id);
            if (!$check) {
                $response = [
                    'status' => false,
                    'message' => 'Nama lokasi sudah terdaftar untuk lokasi lain',
                ];
                echo json_encode($response);
                return;
            }
        }

        $data = [
            'location_name' => $this->input->post('location_name', true),
            'building'      => $this->input->post('building', true),
            'floor'         => $this->input->post('floor', true),
            'room'          => $this->input->post('room', true),
            'description'   => $this->input->post('description', true),
        ];

        if ($this->M_asset_location->update_post($id, $data)) {
            $response = ['status' => true, 'message' => 'Lokasi berhasil diupdate'];
        } else {
            $response = ['status' => false, 'message' => 'Lokasi gagal diupdate'];
        }
        echo json_encode($response);
    }

    public function delete() {
        $this->_ONLYSELECTED([1, 2]);
        $this->_isAjax();

        $id = $this->input->post('id');
        // Cek apakah lokasi sedang digunakan oleh aset
        $this->load->model('M_asset');
        $used = $this->db->where('id_location', $id)->get('asset')->num_rows();
        if ($used > 0) {
            $response = [
                'status' => false,
                'message' => 'Lokasi tidak dapat dihapus karena masih digunakan oleh aset',
            ];
            echo json_encode($response);
            return;
        }

        if ($this->M_asset_location->delete($id)) {
            $response = ['status' => true, 'message' => 'Lokasi berhasil dihapus'];
        } else {
            $response = ['status' => false, 'message' => 'Lokasi gagal dihapus'];
        }
        echo json_encode($response);
    }

    public function dtSideserver() {
        $list = $this->M_asset_location->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $item) {
            $action = '
                <div class="no-print">
                    <a href="javascript:void(0)" onclick="editLocationBtn(this)" class="btn gradient-btn-edit btn-sm mb-2 rounded-pill" style="width:70px"
                        data-id_asset_location="' . $item->id_asset_location . '"
                        data-location_name="' . htmlspecialchars($item->location_name) . '"
                        data-building="' . htmlspecialchars($item->building) . '"
                        data-floor="' . htmlspecialchars($item->floor) . '"
                        data-room="' . htmlspecialchars($item->room) . '"
                        data-description="' . htmlspecialchars($item->description) . '">
                        EDIT
                    </a>
                    <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-location" style="width:70px"
                        onClick="handleDeleteLocationButton(' . $item->id_asset_location . ')">
                        DELETE
                    </button>
                </div>
            ';
            $row = array();
            $row[] = $item->location_name;
            $row[] = $item->building;
            $row[] = $item->floor;
            $row[] = $item->room;
            $row[] = $item->description;
            $row[] = $action;
            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_asset_location->count_all(),
            "recordsFiltered" => $this->M_asset_location->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asset_category extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_asset_category');
    }

    public function index() {
        $this->_ONLYSELECTED([1, 2]);
        $data = $this->_basicData();

        $data['title'] = 'Kategori Asset';
        $data['view_name'] = 'asset/asset_category';
        $data['breadcrumb'] = 'Asset Category';
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

        $this->form_validation->set_rules('category_name', 'Nama Kategori', 'required|is_unique[asset_category.category_name]', [
            'required' => 'Nama kategori harus diisi',
            'is_unique' => 'Nama kategori sudah terdaftar'
        ]);
        $this->form_validation->set_rules('category_code', 'Kode Kategori', 'required|is_unique[asset_category.category_code]', [
            'required' => 'Kode kategori harus diisi',
            'is_unique' => 'Kode kategori sudah terdaftar'
        ]);
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
            'category_name' => $this->input->post('category_name', true),
            'category_code' => $this->input->post('category_code', true),
            'description'   => $this->input->post('description', true),
        ];

        if ($this->M_asset_category->create_post($data)) {
            $response = ['status' => true, 'message' => 'Kategori berhasil ditambahkan'];
        } else {
            $response = ['status' => false, 'message' => 'Kategori gagal ditambahkan'];
        }
        echo json_encode($response);
    }

    public function update() {
        $this->_ONLYSELECTED([1, 2]);
        $this->_isAjax();

        $id = $this->input->post('id_asset_category');

        $this->form_validation->set_rules('category_name', 'Nama Kategori', 'required', ['required' => 'Nama kategori harus diisi']);
        $this->form_validation->set_rules('category_code', 'Kode Kategori', 'required', ['required' => 'Kode kategori harus diisi']);
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

        // Cek duplikasi (name dan code) kecuali dirinya sendiri
        $existing = $this->M_asset_category->findById_get($id);
        if ($existing) {
            $old = $existing[0];
            if ($old->category_name != $this->input->post('category_name')) {
                $check = $this->M_asset_category->checkUnique('category_name', $this->input->post('category_name'), $id);
                if (!$check) {
                    $response = ['status' => false, 'message' => 'Nama kategori sudah terdaftar untuk kategori lain'];
                    echo json_encode($response);
                    return;
                }
            }
            if ($old->category_code != $this->input->post('category_code')) {
                $check = $this->M_asset_category->checkUnique('category_code', $this->input->post('category_code'), $id);
                if (!$check) {
                    $response = ['status' => false, 'message' => 'Kode kategori sudah terdaftar untuk kategori lain'];
                    echo json_encode($response);
                    return;
                }
            }
        }

        $data = [
            'category_name' => $this->input->post('category_name', true),
            'category_code' => $this->input->post('category_code', true),
            'description'   => $this->input->post('description', true),
        ];

        if ($this->M_asset_category->update_post($id, $data)) {
            $response = ['status' => true, 'message' => 'Kategori berhasil diupdate'];
        } else {
            $response = ['status' => false, 'message' => 'Kategori gagal diupdate'];
        }
        echo json_encode($response);
    }

    public function delete() {
        $this->_ONLYSELECTED([1, 2]);
        $this->_isAjax();

        $id = $this->input->post('id');
        // Cek apakah kategori digunakan oleh aset
        $this->load->model('M_asset');
        $used = $this->db->where('id_asset_category', $id)->get('asset')->num_rows();
        if ($used > 0) {
            $response = [
                'status' => false,
                'message' => 'Kategori tidak dapat dihapus karena masih digunakan oleh aset',
            ];
            echo json_encode($response);
            return;
        }

        if ($this->M_asset_category->delete($id)) {
            $response = ['status' => true, 'message' => 'Kategori berhasil dihapus'];
        } else {
            $response = ['status' => false, 'message' => 'Kategori gagal dihapus'];
        }
        echo json_encode($response);
    }

    public function dtSideserver() {
        $list = $this->M_asset_category->get_datatables();
        $data = array();
        $no = @$_POST['start'];

        foreach ($list as $item) {
            $action = '
                <div class="no-print">
                    <a href="javascript:void(0)" onclick="editCategoryBtn(this)" class="btn gradient-btn-edit btn-sm mb-2 rounded-pill" style="width:70px"
                        data-id_asset_category="' . $item->id_asset_category . '"
                        data-category_name="' . htmlspecialchars($item->category_name) . '"
                        data-category_code="' . htmlspecialchars($item->category_code) . '"
                        data-description="' . htmlspecialchars($item->description) . '">
                        EDIT
                    </a>
                    <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-category" style="width:70px"
                        onClick="handleDeleteCategoryButton(' . $item->id_asset_category . ')">
                        DELETE
                    </button>
                </div>
            ';
            $row = array();
            $row[] = $item->category_code;
            $row[] = $item->category_name;
            $row[] = $item->description;
            $row[] = $action;
            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_asset_category->count_all(),
            "recordsFiltered" => $this->M_asset_category->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
}
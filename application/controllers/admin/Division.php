<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Division extends MY_Controller{

    function __construct()
    {
        parent::__construct();

        $this->load->model('M_division');
        $this->load->model('M_employees');
    }


    public function division_page()
    {
       $this->_ONLY_SU();
       $data = $this->_basicData();

       $data['title'] = 'Division';
       $data['view_name'] = 'admin/division';
       $data['breadcrumb'] = 'Division';
       $data['menu'] = '';
       
       $data['division'] = $this->M_division->findAll_get();

       if($data['user']) {
            $this->load->view('templates/index', $data);
       } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
            redirect('panel');
       }

    }


    public function add_division()
    {
        $this->_isAjax();
        $this->_ONLY_SU();

        $this->form_validation->set_rules('code_division', 'Code_division', 'required|is_unique[division.code_division]', [
            'required' => 'Code Divisi harus diisi',
            'is_unique' => 'Code Divisi sudah dipakai',
        ]);
        $this->form_validation->set_rules('name_division', 'name_division', 'required|min_length[2]|max_length[80]', [
            'required' => 'Name harus diisi',
            'min_length' => 'Name minimal 2 karakter',
            'max_length' => 'Name maksimal 80 karakter',
        ]);

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
            'code_division' => $this->input->post('code_division', true),
            'name_division' => $this->input->post('name_division', true),
        ];

        $division = $this->M_division->create_post($data);

        if ($division) {
            $response = [
                'status' => true,
                'message' => 'Divisi berhasil ditambahkan',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Divisi gagal ditambahkan',
            ];
        }

        echo json_encode($response);
    }


    public function update() 
    {
        $this->_isAjax();
        $this->_ONLY_SU();
        $id = $this->input->post('id_division', true);
        if (!$id) {
            $response = [
                'status' => false,
                'message' => 'ID tidak valid',
            ];
            echo json_encode($response);
            return;
        }

        $ac = $this->M_division->findById_get($id);
        $oldCode = $ac['code_division'];

        $this->form_validation->set_rules('name_division', 'name_division', 'required|min_length[2]|max_length[80]', [
            'required' => 'Name harus diisi',
            'min_length' => 'Name minimal 2 karakter',
            'max_length' => 'Name maksimal 80 karakter',
        ]);


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

        $newCode = $this->input->post('code_division',true);

        if($oldCode != $newCode){
            $codeExist = $this->M_division->findByCodeDivision_get($newCode);
            if($codeExist){
                $response = [
                    'status' => false,
                    'message' => 'Code sudah digunakan'
                ];

                echo json_encode($response);

                return;
            }
        }

        $data = [
            'code_division' => $this->input->post('code_division', true),
            'name_division' => $this->input->post('name_division', true),
        ];

        $account_code = $this->M_division->update_post($id, $data);

        if ($account_code) {
            $response = [
                'status' => true,
                'message' => 'Divisi berhasil diupdate',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Divisi gagal diupdate',
            ];
        }

        echo json_encode($response);

    }
    

    public function delete()
    {
        $this->_isAjax();
        $this->_ONLY_SU();
    
        $id = $this->input->post('id_division');
        log_message('debug', 'Delete Division ID: ' . $id);
    
        if ($this->M_employees->findByDivisionId_get($id)) {
            $response = [
                'status' => false,
                'message' => 'Code ini tidak bisa dihapus karena memiliki relasi dengan tabel lain'
            ];
            echo json_encode($response);
            return;
        }
    
        if ($this->M_division->delete($id)) {
            $response = [
                'status' => true,
                'message' => 'Divisi berhasil dihapus',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Divisi gagal dihapus',
            ];
        }
    
        echo json_encode($response);
    }


}

<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Position extends MY_Controller{

    function __construct()
    {
        parent::__construct();

        $this->load->model('M_position');
        $this->load->model('M_employees');
    }


    public function position_page()
    {
       $this->_ONLYSELECTED([1,2]);
       $data = $this->_basicData();

       $data['title'] = 'Position';
       $data['view_name'] = 'admin/position';
       $data['breadcrumb'] = 'Position';
       $data['menu'] = '';


       $data['position'] = $this->M_position->findAll_get();

       if($data['user']) {
            $this->load->view('templates/index', $data);
       } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
            redirect('fetch/login');
       }
        
       
    }


    public function add_position()
    {
        $this->_isAjax();
        $this->_ONLY_SU();

        $this->form_validation->set_rules('code_position', 'code_position', 'required|is_unique[position.code_position]', [
            'required' => 'Code Posisi harus diisi',
            'is_unique' => 'Code Posisi sudah dipakai',
        ]);
        $this->form_validation->set_rules('name_position', 'name_position', 'required|min_length[2]|max_length[80]', [
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
            'code_position' => $this->input->post('code_position', true),
            'name_position' => $this->input->post('name_position', true),
        ];

        $position = $this->M_position->create_post($data);

        if ($position) {
            $response = [
                'status' => true,
                'message' => 'Posisi berhasil ditambahkan',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Posisi gagal ditambahkan',
            ];
        }

        echo json_encode($response);
    }


    public function update_position() 
    {

        $this->_isAjax();
        $this->_ONLY_SU();
        $id = $this->input->post('id_position', true);
        if (!$id) {
            $response = [
                'status' => false,
                'message' => 'ID tidak valid',
            ];
            echo json_encode($response);
            return;
        }

        $ac = $this->M_position->findById_get($id);
        $oldCode = $ac['code_position'];

        $this->form_validation->set_rules('name_position', 'name_position', 'required|min_length[2]|max_length[80]', [
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

        $newCode = $this->input->post('code_position',true);

        if($oldCode != $newCode){
            $codeExist = $this->M_position->findByCodePosition_get($newCode);
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
            'code_position' => $this->input->post('code_position', true),
            'name_position' => $this->input->post('name_position', true),
        ];

        $account_code = $this->M_position->update_post($id, $data);

        if ($account_code) {
            $response = [
                'status' => true,
                'message' => 'Posisi berhasil diupdate',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Posisi gagal diupdate',
            ];
        }

        echo json_encode($response);

    }
    

    public function delete_position()
    {
        $this->_isAjax();
        $this->_ONLY_SU();

        $id = $this->input->post('id');
        
        if($this->M_employees->findByPositionId_get($id) ){
            $response = [
                'status' => false,
                'message' => 'Code ini tidak bisa dihapus karena memiliki relasi dengan tabel lain ' 
            ];
            echo json_encode($response);
            return;
        }


        if($this->M_position->delete($id)){
            $response = [
                'status' => true,
                'message' => 'Posisi berhasil dihapus',
            ];
        } else {
            $response = [
               'status' => false,  
               'message' => 'Posisi gagal dihapus',  
            ];
        }
        
        echo json_encode($response);

    }

}

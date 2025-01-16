<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_code extends MY_Controller{

    function __construct()
    {
        parent::__construct();

        $this->load->model('m_Account_code');
        $this->load->model('m_Finance_records');
        $this->load->model('m_Categories');
    }


    public function ac_page()
    {
       $this->_ONLYSELECTED([1,2]);
       $data = $this->_basicData();

       $data['title'] = 'Account Code';
       $data['view_name'] = 'admin/account_code';
       $data['breadcrumb'] = 'Account Code';
       $data['menu'] = '';
       
       $data['categories'] = $this->m_Categories->findAll_get();
       $data['account_code'] = $this->m_Account_code->findAllWithJoin_get();

       if($data['user']) {
            $this->load->view('templates/index', $data);
       } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
            redirect('fetch/login');
       }
        
       
    }


    public function add_account_code()
    {
        $this->_isAjax();
        $this->_ONLY_SU();

        $this->form_validation->set_rules('id_kategori', 'Id_kategori', 'required', [
            'required' => 'Category harus diisi',
        ]);
        $this->form_validation->set_rules('code', 'Code', 'required|is_unique[account_code.code]', [
            'required' => 'Code harus diisi',
            'is_unique' => 'Code sudah dipakai',
        ]);
        $this->form_validation->set_rules('name_code', 'Name_code', 'required|min_length[3]|max_length[80]', [
            'required' => 'Name harus diisi',
            'min_length' => 'Name minimal 3 karakter',
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
            'id_kategori' => $this->input->post('id_kategori', true),
            'code' => $this->input->post('code', true),
            'name_code' => $this->input->post('name_code', true),
        ];

        $account = $this->m_Account_code->create_post($data);

        if ($account) {
            $response = [
                'status' => true,
                'message' => 'Account code berhasil ditambahkan',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Account code gagal ditambahkan',
            ];
        }

        echo json_encode($response);
    }


    public function update() 
    {

        $this->_isAjax();
        $this->_ONLY_SU();
        $id = $this->input->post('id_code', true);
        if (!$id) {
            $response = [
                'status' => false,
                'message' => 'ID tidak valid',
            ];
            echo json_encode($response);
            return;
        }

        $ac = $this->m_Account_code->findById_get($id);
        $oldCode = $ac['code'];

        $this->form_validation->set_rules('id_kategori', 'Id_kategori', 'required', [
            'required' => 'Category harus diisi',
        ]);

        $this->form_validation->set_rules('name_code', 'Name_code', 'required|min_length[3]|max_length[80]', [
            'required' => 'Name harus diisi',
            'min_length' => 'Name minimal 3 karakter',
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

        $newCode = $this->input->post('code',true);

        if($oldCode != $newCode){
            $codeExist = $this->m_Account_code->findByCode_get($newCode);
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
            'id_kategori' => $this->input->post('id_kategori', true),
            'code' => $this->input->post('code', true),
            'name_code' => $this->input->post('name_code', true),
        ];

        $account_code = $this->m_Account_code->update_post($id, $data);

        if ($account_code) {
            $response = [
                'status' => true,
                'message' => 'Data Account berhasil diupdate',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Data Account gagal diupdate',
            ];
        }

        echo json_encode($response);

    }
    

    public function delete()
    {
        $this->_isAjax();
        $this->_ONLY_SU();

        $id = $this->input->post('id_code');
        
        if($this->m_Finance_records->findByIdAc_get($id) ){
            $response = [
                'status' => false,
                'message' => 'Code ini tidak bisa dihapus karena memiliki relasi dengan tabel lain ' 
            ];
            echo json_encode($response);
            return;
        }


        if($this->m_Account_code->delete($id)){
            $response = [
                'status' => true,
                'message' => 'Product berhasil dihapus',
            ];
        } else {
            $response = [
               'status' => false,  
               'message' => 'Product gagal dihapus',  
            ];
        }
        
        echo json_encode($response);

    }

}
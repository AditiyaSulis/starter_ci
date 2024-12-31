<?php
class Employee extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_Employees');
        $this->load->model('m_Products');

    }

    public function employee_page()
    {
        $this->_ONLYSELECTED([1,2]);
        $data = $this->_basicData();

        $data['title'] = 'Employee';
        $data['view_name'] = 'admin/employee';
        $data['breadcrumb'] = 'Employee';

        $data['employees'] = $this->m_Employees->findAllJoin_get();
        $data['products'] = $this->m_Products->findAll_get();

        if($data['user']){
            $this->load->view('templates/index',$data);
        } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
        }

    }

    public function add_employees()
    {
        $this->_ONLY_SU();

        $this->form_validation->set_rules('gender', 'Gender', 'required', [
            'required' => 'Gender harus diisi',
        ]);
        $this->form_validation->set_rules('nip', 'NIP', 'required|min_length[8]|max_length[18]|is_unique[employee.nip]', [
            'required' => 'NIP harus diisi',
            'min_length' => 'NIP minimal 8 karakter',
            'max_length' => 'NIP maksimal 18 karakter',
            'is_unique' => 'NIP sudah dipakai',
        ]);
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[50]', [
            'required' => 'Name harus diisi',
            'min_length' => 'Name minimal 3 karakter',
            'max_length' => 'Name maksimal 50 karakter',
        ]);
        $this->form_validation->set_rules('place_of_birth', 'Place_of_birth', 'required|min_length[4]|max_length[30]', [
            'required' => 'Tempat lahir harus diisi',
            'min_length' => 'Tempat lahir minimal 4 karakter',
            'max_length' => 'Tempat lahir maksimal 50 karakter',
        ]);

        $this->form_validation->set_rules('position', 'Position', 'required|min_length[4]|max_length[30]', [
            'required' => 'Position harus diisi',
            'min_length' => 'Position minimal 4 karakter',
            'max_length' => 'Position maksimal 30 karakter',
        ]);

        $this->form_validation->set_rules('gender', 'Gender', 'required', [
            'required' => 'Gender harus diisi',
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
            'id_product' => $this->input->post('id_product', true),
            'date_in' => $this->input->post('date_in', true),
            'nip' => $this->input->post('nip', true),
            'name' => $this->input->post('name', true),
            'gender' => $this->input->post('gender', true),
            'place_of_birth' => $this->input->post('place_of_birth', true),
            'date_of_birth' => $this->input->post('date_of_birth', true),
            'position' => $this->input->post('position', true),
          
        ];

        $employee = $this->m_Employees->create_post($data);

        if ($employee) {
            $response = [
                'status' => true,
                'message' => 'Employee berhasil ditambahkan',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Employee gagal ditambahkan',
            ];
        }

        echo json_encode($response);
    }

    public function update() {

        $this->_ONLY_SU();
        $id = $this->input->post('id_employee', true);

        $emp = $this->m_Employees->findById_get($id);
        $oldNip = $emp['nip'];

        $this->form_validation->set_rules('gender', 'Gender', 'required', [
            'required' => 'Gender harus diisi',
        ]);
        $this->form_validation->set_rules('nip', 'NIP', 'required|min_length[8]|max_length[18]', [
            'required' => 'NIP harus diisi',
            'min_length' => 'NIP minimal 8 karakter',
            'max_length' => 'NIP maksimal 18 karakter',
        ]);
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[50]', [
            'required' => 'Name harus diisi',
            'min_length' => 'Name minimal 3 karakter',
            'max_length' => 'Name maksimal 50 karakter',
        ]);
        $this->form_validation->set_rules('place_of_birth', 'Place_of_birth', 'required|min_length[4]|max_length[30]', [
            'required' => 'Tempat lahir harus diisi',
            'min_length' => 'Tempat lahir minimal 4 karakter',
            'max_length' => 'Tempat lahir maksimal 50 karakter',
        ]);
        
        $this->form_validation->set_rules('position', 'Position', 'required|min_length[4]|max_length[30]', [
            'required' => 'Position harus diisi',
            'min_length' => 'Position minimal 4 karakter',
            'max_length' => 'Position maksimal 30 karakter',
        ]);

        $this->form_validation->set_rules('gender', 'Gender', 'required', [
            'required' => 'Gender harus diisi',
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

        $newNip = $this->input->post('nip',true);

        if($oldNip != $newNip){
            $nipExist = $this->m_Employees->findByNip_get($newNip);
            if($nipExist){
                $response = [
                    'status' => false,
                    'message' => 'NIP sudah digunakan'
                ];

                echo json_encode($response);

                return;
            }
        }

        $data = [
            'id_product' => $this->input->post('id_product', true),
            'date_in' => $this->input->post('date_in', true),
            'nip' => $this->input->post('nip', true),
            'name' => $this->input->post('name', true),
            'gender' => $this->input->post('gender', true),
            'place_of_birth' => $this->input->post('place_of_birth', true),
            'date_of_birth' => $this->input->post('date_of_birth', true),
            'position' => $this->input->post('position', true),
        ];

        $employee = $this->m_Employees->update_post($id, $data);

        if ($employee) {
            $response = [
                'status' => true,
                'message' => 'Data karyawan berhasil diupdate',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Data karyawan gagal diupdate',
            ];
        }

        echo json_encode($response);


        
    }

    public function delete()
    {
        $this->_ONLY_SU();

        $id = $this->input->post('id_employee');


        if($this->m_Employees->delete($id)){
            $response = [
                'status' => true,
                'message' => 'Data karyawan berhasil dihapus',
            ];
        } else {
            $response = [
               'status' => false,  
               'message' => 'Data karyawan gagal dihapus',  
            ];
        }
        
        echo json_encode($response);

    }


}
<?php
class Employee extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_Employees');
        $this->load->model('m_Products');
        $this->load->model('m_Bank_account');
        $this->load->model('m_Emergency_contact');

    }


    public function employee_page()
    {
        $this->_ONLYSELECTED([1,2]);
        $data = $this->_basicData();

        $data['title'] = 'Employee';
        $data['view_name'] = 'admin/employee';
        $data['breadcrumb'] = 'Employee';
        $data['menu'] = '';

        $data['employees'] = $this->m_Employees->findAllJoin_get();
        $data['products'] = $this->m_Products->findAll_get();
        $data['products_show'] = $this->m_Products->findAllShow_get();

        if($data['user']){
            $this->load->view('templates/index',$data);
        } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
        }

    }


    public function add_employees()
    {
        $this->_ONLY_SU();
        $this->_isAjax();

        $this->form_validation->set_rules('gender', 'Gender', 'required', [
            'required' => 'Gender harus diisi',
        ]);
        $this->form_validation->set_rules('basic_salary', 'basic_salary', 'required', [
            'required' => 'Salary harus diisi',
        ]);
        $this->form_validation->set_rules('uang_makan', 'uang_makan', 'required', [
            'required' => 'Uang makan harus diisi',
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
        $this->form_validation->set_rules('divisi', 'divisi', 'required|min_length[2]|max_length[30]', [
            'required' => 'Divisi harus diisi',
            'min_length' => 'Divisi minimal 2 karakter',
            'max_length' => 'Divisi maksimal 30 karakter',
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
            'divisi' => $this->input->post('divisi', true),
            'uang_makan' => $this->input->post('uang_makan', true),
            'basic_salary' => $this->input->post('basic_salary', true),
            'bonus' => $this->input->post('bonus', true),
          
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


    public function update() 
    {

        $this->_ONLY_SU();
        $this->_isAjax();
        $id = $this->input->post('id_employee', true);

        $emp = $this->m_Employees->findById_get($id);
        $oldNip = $emp['nip'];

        $this->form_validation->set_rules('gender', 'Gender', 'required', [
            'required' => 'Gender harus diisi',
        ]);
        $this->form_validation->set_rules('basic_salary', 'basic_salary', 'required', [
            'required' => 'Salary harus diisi',
        ]);
        $this->form_validation->set_rules('uang_makan', 'uang_makan', 'required', [
            'required' => 'Uang makan harus diisi',
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
        $this->form_validation->set_rules('divisi', 'divisi', 'required|min_length[2]|max_length[30]', [
            'required' => 'Divisi harus diisi',
            'min_length' => 'Divisi minimal 2 karakter',
            'max_length' => 'Divisi maksimal 30 karakter',
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
            'divisi' => $this->input->post('divisi', true),
            'basic_salary' => $this->input->post('basic_salary', true),
            'uang_makan' => $this->input->post('uang_makan', true),
            'bonus' => $this->input->post('bonus', true),
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
        $this->_isAjax();

        $id = $this->input->post('id');


        if($this->m_Employees->delete($id)){
            $response = [
                'status' => true,
                'message' => 'Data karyawan berhasil dihapus',
                'id' => $id
            ];
        } else {
            $response = [
               'status' => false,  
               'message' => 'Data karyawan gagal dihapus',  
            ];
        }
        
        echo json_encode($response);

    }


    public function dtSideServer() 
    {
        $product = $this->input->post('product'); 
    
        $list = $this->m_Employees->getEmployeesData($product);
        
        $data = [];
        $no = $this->input->post('start');  
    
        foreach($list as $item) {
            $action = ' <a href="javascript:void(0)" onclick="editEmployeeBtn(this)" class="btn gradient-btn-edit mb-2 btn-sm rounded-pill btn-edit-emp" style="width : 70px" 
                                data-id="'.htmlspecialchars($item['id_employee']).'"
                                data-product="'.htmlspecialchars($item['id_product']).'"
                                data-date_in="'.htmlspecialchars($item['date_in']).'"
                                data-nip="'.htmlspecialchars($item['nip']).'"
                                data-name="'.htmlspecialchars($item['name']).'"
                                data-gender="'.htmlspecialchars($item['gender']).'"
                                data-place_of_birth="'.htmlspecialchars($item['place_of_birth']).'"
                                data-date_of_birth="'.htmlspecialchars($item['date_of_birth']).'"
                                data-divisi="'.htmlspecialchars($item['divisi']).'"
                                data-basic_salary="'.htmlspecialchars($item['basic_salary']).'"
                                data-uang_makan="'.htmlspecialchars($item['uang_makan']).'"
                                data-bonus="'.htmlspecialchars($item['bonus']).'"
                                data-divisi="'.htmlspecialchars($item['divisi']).'"
                                data-position="'.htmlspecialchars($item['position']).'">
                            EDIT
                        </a>
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-emp" onclick="handleDeleteButton('.htmlspecialchars($item['id_employee']).')" style="width : 70px">
                            DELETE
                        </button>
                     ';  
            $bank_info = '<button 
                            class="btn btn-info btn-sm rounded-pill btn-bank" 
                            data-bs-toggle="modal" 
                            data-bs-target="#bankModal"
                            data-id_employee="'.htmlspecialchars($item['id_employee']).'">
                            <i class="bi bi-info-circle"></i>
                           </button>';
            $ec_info = '<button 
                            class="btn btn-primary btn-sm rounded-pill btn-ec" 
                            data-bs-toggle="modal" 
                            data-bs-target="#ecModal"
                            data-id_employees="'.htmlspecialchars($item['id_employee']).'">
                            <i class="bi bi-people"></i>
                           </button>';
            
            $row = [];
            $row[] = ++$no;  
            $row[] = $item['name_product']; 
            $row[] = date('d M Y', strtotime($item['date_in']));  
            $row[] = $item['nip'];  
            $row[] = $item['name'];  
            $row[] = $item['gender'] == 'L' ? 'Pria' : 'Wanita';  
            $row[] = $item['place_of_birth'];  
            $row[] = date('d M Y', strtotime($item['date_of_birth']));  
            $row[] = $item['divisi'];  
            $row[] = $item['position'];  
            $row[] = 'Rp.'. number_format($item['basic_salary'], 0 , ',', '.');  
            $row[] = 'Rp.'. number_format($item['uang_makan'], 0 , ',', '.');  
            $row[] = 'Rp.'. number_format($item['bonus'], 0 , ',', '.');  
            $row[] = $bank_info;  
            $row[] = $ec_info;  
            $row[] = $action;  
            $data[] = $row;
        }
    
        $output = [
            "draw" =>@$_POST['draw'],
            "recordsTotal" => count($list),  
            "recordsFiltered" => count($list),  
            "data" => $data,
        ];
    
        echo json_encode($output);
    }

     //---------BANK ACCOUNT INFO
     public function bank_info() 
     {
    
         $id = $this->input->post('id');
 
 
         if (!$id) {
             echo json_encode([
                 'status' => false,
                 'message' => 'ID tidak valid.',
             ]);
             return;
         }
 
         $banklist = $this->m_Bank_account->findByEmployeeId_get($id);
 
         
         echo json_encode([
             'status' => true,
             'banks' => $banklist,
         ]);
     }

     public function add_bank()
    {
        $this->_isAjax();
        $this->_ONLY_SU();

        $this->form_validation->set_rules('bank_name', 'bank_name', 'required', [
            'required' => 'Bank name harus diisi',
        ]);

        $this->form_validation->set_rules('bank_number', 'bank_number', 'required', [
            'required' => 'Account number harus diisi',
        ]);
        $this->form_validation->set_rules('bank_holder_name', 'bank_holder_name', 'required', [
            'required' => 'Account holder name harus diisi',
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

        $id_employee = $this->input->post('id_employee', true);


        $data = [
            'id_employee' => $this->input->post('id_employee', true),
            'bank_name' => $this->input->post('bank_name', true),
            'bank_number' => $this->input->post('bank_number', true),
            'bank_holder_name' => $this->input->post('bank_holder_name', true),
        ];

        $add_bank = $this->m_Bank_account->create_post($data);

        if ($add_bank) {
            $response = [
                'status' => true,
                'message' => 'Pembayaran berhasil ditambahkan',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Pembayaran gagal ditambahkan',
            ];
        }

        echo json_encode($response);
    }

    public function delete_bank()
    {
        $this->_ONLY_SU();
        $this->_isAjax();

        $id = $this->input->post('id_bank');


        if($this->m_Bank_account->delete($id)){
            $response = [
                'status' => true,
                'message' => 'Data Bank berhasil dihapus',
                'id' => $id
            ];
        } else {
            $response = [
               'status' => false,  
               'message' => 'Data Bank gagal dihapus',  
            ];
        }
        
        echo json_encode($response);

    }


    //---------CONTACT INFO
    public function contact_info() 
    {
   
        $id = $this->input->post('id_employees');


        if (!$id) {
            echo json_encode([
                'status' => false,
                'message' => 'ID tidak valid.',
            ]);
            return;
        }

        $contactList = $this->m_Emergency_contact->findByEmployeeId_get($id);

        
        echo json_encode([
            'status' => true,
            'contacts' => $contactList,
        ]);
    }

    public function add_contact()
    {
        $this->_isAjax();
        $this->_ONLY_SU();

        $this->form_validation->set_rules('name_contact', 'name_contact', 'required', [
            'required' => 'Contact name harus diisi',
        ]);

        $this->form_validation->set_rules('number_contact', 'number_contact', 'required', [
            'required' => 'No.Hp harus diisi',
        ]);
        $this->form_validation->set_rules('as_contact', 'as_contact', 'required', [
            'required' => 'Hubungan harus diisi',
        ]);
        $this->form_validation->set_rules('address_contact', 'address_contact', 'required', [
            'required' => 'Address harus diisi',
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

        $id_employee = $this->input->post('id_employee', true);


        $data = [
            'id_employee' => $this->input->post('id_employee', true),
            'name_contact' => $this->input->post('name_contact', true),
            'number_contact' => $this->input->post('number_contact', true),
            'as_contact' => $this->input->post('as_contact', true),
            'address_contact' => $this->input->post('address_contact', true),
        ];

        $add_contact = $this->m_Emergency_contact->create_post($data);

        if ($add_contact) {
            $response = [
                'status' => true,
                'message' => 'Emergency contact berhasil ditambahkan',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Emergency contact gagal ditambahkan',
            ];
        }

        echo json_encode($response);
    }

    public function delete_contact()
    {
        $this->_ONLY_SU();
        $this->_isAjax();

        $id = $this->input->post('id_contact');


        if($this->m_Emergency_contact->delete($id)){
            $response = [
                'status' => true,
                'message' => 'Data berhasil dihapus',
                'id' => $id
            ];
        } else {
            $response = [
               'status' => false,  
               'message' => 'Data gagal dihapus',  
            ];
        }
        
        echo json_encode($response);

    }


}
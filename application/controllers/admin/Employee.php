<?php
class Employee extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_Employees');
        $this->load->model('m_Products');
        $this->load->model('m_Position');
        $this->load->model('m_Division');
        $this->load->model('m_Bank_account');
        $this->load->model('m_Emergency_contact');
        $this->load->model('m_Log_contract_extension');
        $this->load->model('m_Address');
        $this->load->model('m_Domisili');

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
        $data['division'] = $this->m_Division->findAll_get();
        $data['position'] = $this->m_Position->findAll_get();
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

        $this->form_validation->set_rules('id_position', 'id_position', 'required', [
            'required' => 'Posisi harus diisi',
        ]);
        $this->form_validation->set_rules('id_division', 'id_division', 'required', [
            'required' => 'Divisi harus diisi',
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
            'id_position' => $this->input->post('id_position', true),
            'id_division' => $this->input->post('id_division', true),
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


	public function add_all_data_employee(){
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
		$this->form_validation->set_rules('id_position', 'id_position', 'required', [
			'required' => 'Posisi harus diisi',
		]);
		$this->form_validation->set_rules('id_division', 'id_division', 'required', [
			'required' => 'Divisi harus diisi',
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[20]',[
			'required' => 'password harus diisi',
			'min_length'=> 'password minimal memiliki 4 karakter huruf',
			'max_length'=> 'password tidak boleh melebihi 20 huruf',
		]);
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[admin.email]',[
			'valid_email' => 'Invalid email',
			'is_unique' => 'Email sudah digunakan'
		]);
		$this->form_validation->set_rules('bank_name', 'bank_name', 'required', [
			'required' => 'Bank name harus diisi',
		]);
		$this->form_validation->set_rules('bank_number', 'bank_number', 'required', [
			'required' => 'Account number harus diisi',
		]);
		$this->form_validation->set_rules('bank_holder_name', 'bank_holder_name', 'required', [
			'required' => 'Account holder name harus diisi',
		]);
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
		$this->form_validation->set_rules('type_employee', 'type_employee', 'required', [
			'required' => 'Type karyawan harus diisi',
		]);
		$this->form_validation->set_rules('rewrite_password', 'rewrite_password', 'required', [
			'required' => 'Ketik Ulang password harus diisi!',
		]);
		$this->form_validation->set_rules('kabupaten', 'kabupaten', 'required', [
			'required' => 'Kabupaten/kota harus diisi!',
		]);
		$this->form_validation->set_rules('kecamatan', 'kecamatan', 'required', [
			'required' => 'Kecamatan harus diisi!',
		]);
		$this->form_validation->set_rules('desa', 'desa', 'required', [
			'required' => 'Desa harus diisi!',
		]);
		$this->form_validation->set_rules('blok', 'blok', 'required', [
			'required' => 'Blok harus diisi!',
		]);
		$this->form_validation->set_rules('kode_pos', 'kode_pos', 'required', [
			'required' => 'Kode pos harus diisi!',
		]);
		$this->form_validation->set_rules('spesifik', 'spesifik', 'required', [
			'required' => 'Spesifik harus diisi!',
		]);
		$this->form_validation->set_rules('kabupaten_domisili', 'kabupaten_domisili', 'required', [
			'required' => 'Kabupaten/kota domisili harus diisi!',
		]);
		$this->form_validation->set_rules('kecamatan_domisili', 'kecamatan_domisili', 'required', [
			'required' => 'Kecamatan domisili harus diisi!',
		]);
		$this->form_validation->set_rules('desa_domisili', 'desa_domisili', 'required', [
			'required' => 'Desa domisili harus diisi!',
		]);
		$this->form_validation->set_rules('blok_domisili', 'blok_domisili', 'required', [
			'required' => 'Blok domisili harus diisi!',
		]);
		$this->form_validation->set_rules('kode_pos_domisili', 'kode_pos_domisli', 'required', [
			'required' => 'Kode pos domisili  harus diisi!',
		]);
		$this->form_validation->set_rules('spesifik_domisili', 'spesifik_domisili', 'required', [
			'required' => 'Spesifik Domisili harus diisi!',
		]);
		$this->form_validation->set_rules('no_hp', 'no_hp', 'required', [
			'required' => 'Nomer Hp harus diisi!',
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
		if ($this->input->post('password', true) !== $this->input->post('rewrite_password', true)) {
			$response = [
				'status' => false,
				'message' => 'Password tidak sama',
			];
			echo json_encode($response);
			return;
		}

		$contract_expired = $this->input->post('type_employee', true) == 1 || $this->input->post('type_employee', true) == 2 ? $this->input->post('contract_expired', true) : null;

		$lb = new Opensslencryptdecrypt();
		$encrypt =$lb->encrypt($this->input->post('password', true));

		$emp = [
			'id_product' => $this->input->post('id_product', true),
			'date_in' => $this->input->post('date_in', true),
			'nip' => $this->input->post('nip', true),
			'name' => $this->input->post('name', true),
			'gender' => $this->input->post('gender', true),
			'email' => $this->input->post('email', true),
			'no_hp' => $this->input->post('no_hp', true),
			'place_of_birth' => $this->input->post('place_of_birth', true),
			'date_of_birth' => $this->input->post('date_of_birth', true),
			'id_position' => $this->input->post('id_position', true),
			'id_division' => $this->input->post('id_division', true),
			'uang_makan' => $this->input->post('uang_makan', true),
			'type_employee' => $this->input->post('type_employee', true),
			'contract_expired' => $contract_expired,
			'basic_salary' => $this->input->post('basic_salary', true),
			'bonus' => $this->input->post('bonus', true),
		];
		$account = [
			'name' => $this->input->post('name', true),
			'email' => $this->input->post('email', true),
			'password' => $encrypt,
			'role' => 3,
		];
		$bank = [
			'bank_name' => $this->input->post('bank_name', true),
			'bank_number' => $this->input->post('bank_number', true),
			'bank_holder_name' => $this->input->post('bank_holder_name', true),
		];
		$ec = [
			'name_contact' => $this->input->post('name_contact', true),
			'number_contact' => $this->input->post('number_contact', true),
			'as_contact' => $this->input->post('as_contact', true),
			'address_contact' => $this->input->post('address_contact', true),
		];
		$address = [
			'kabupaten' => $this->input->post('kabupaten', true),
			'kecamatan' => $this->input->post('kecamatan', true),
			'desa' => $this->input->post('desa', true),
			'blok' => $this->input->post('blok', true),
			'kode_pos' => $this->input->post('kode_pos', true),
			'spesifik' => $this->input->post('spesifik', true),
		];
		$domisili = [
			'kabupaten_domisili' => $this->input->post('kabupaten_domisili', true),
			'kecamatan_domisili' => $this->input->post('kecamatan_domisili', true),
			'desa_domisili' => $this->input->post('desa_domisili', true),
			'blok_domisili' => $this->input->post('blok_domisili', true),
			'kode_pos_domisili' => $this->input->post('kode_pos_domisili', true),
			'spesifik_domisili' => $this->input->post('spesifik_domisili', true),
		];

		$employee = $this->m_Employees->create_allDataEmployees($emp, $account, $bank, $ec, $address, $domisili);

		if ($employee) {
			$response = [
				'status' => true,
				'type' =>  $this->input->post('type_employee', true),
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

	public function edit_address(){
		$this->_ONLY_SU();
		$this->_isAjax();

		$this->form_validation->set_rules('kabupaten', 'kabupaten', 'required', [
			'required' => 'Kabupaten/kota harus diisi!',
		]);
		$this->form_validation->set_rules('kecamatan', 'kecamatan', 'required', [
			'required' => 'Kecamatan harus diisi!',
		]);
		$this->form_validation->set_rules('desa', 'desa', 'required', [
			'required' => 'Desa harus diisi!',
		]);
		$this->form_validation->set_rules('blok', 'blok', 'required', [
			'required' => 'Blok harus diisi!',
		]);
		$this->form_validation->set_rules('kode_pos', 'kode_pos', 'required', [
			'required' => 'Kode pos harus diisi!',
		]);
		$this->form_validation->set_rules('spesifik', 'spesifik', 'required', [
			'required' => 'Spesifik harus diisi!',
		]);
		$this->form_validation->set_rules('kabupaten_domisili', 'kabupaten_domisili', 'required', [
			'required' => 'Kabupaten/kota domisili harus diisi!',
		]);
		$this->form_validation->set_rules('kecamatan_domisili', 'kecamatan_domisili', 'required', [
			'required' => 'Kecamatan domisili harus diisi!',
		]);
		$this->form_validation->set_rules('desa_domisili', 'desa_domisili', 'required', [
			'required' => 'Desa domisili harus diisi!',
		]);
		$this->form_validation->set_rules('blok_domisili', 'blok_domisili', 'required', [
			'required' => 'Blok domisili harus diisi!',
		]);
		$this->form_validation->set_rules('kode_pos_domisili', 'kode_pos_domisli', 'required', [
			'required' => 'Kode pos domisili  harus diisi!',
		]);
		$this->form_validation->set_rules('spesifik_domisili', 'spesifik_domisili', 'required', [
			'required' => 'Spesifik Domisili harus diisi!',
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

		$id = $this->input->post('id_employee');

		$address = [
			'kabupaten' => $this->input->post('kabupaten', true),
			'kecamatan' => $this->input->post('kecamatan', true),
			'desa' => $this->input->post('desa', true),
			'blok' => $this->input->post('blok', true),
			'kode_pos' => $this->input->post('kode_pos', true),
			'spesifik' => $this->input->post('spesifik', true),
		];
		$domisili = [
			'kabupaten_domisili' => $this->input->post('kabupaten_domisili', true),
			'kecamatan_domisili' => $this->input->post('kecamatan_domisili', true),
			'desa_domisili' => $this->input->post('desa_domisili', true),
			'blok_domisili' => $this->input->post('blok_domisili', true),
			'kode_pos_domisili' => $this->input->post('kode_pos_domisili', true),
			'spesifik_domisili' => $this->input->post('spesifik_domisili', true),
		];

		if(!$this->m_Address->findByEmployeeId_get($id) && !$this->m_Domisili->findByEmployeeId_get($id)){
			$address = ['id_employee' => $id];
			$domisili = ['id_employee' => $id];
			if ($this->m_Address->create_post($address) && $this->m_Domisili->create_post($domisili)) {
				$response = [
					'status' => true,
					'message' => 'Data address karyawan berhasil ditambahkan',
				];
			} else {
				$response = [
					'status' => false,
					'message' => 'Data address karyawan gagal ditambahkan',
				];
			}

			echo json_encode($response);

			return;
		}

		if ($this->m_Address->update_post($id, $address) && $this->m_Domisili->update_post($id, $domisili)) {
			$response = [
				'status' => true,
				'message' => 'Data address karyawan berhasil diupdate',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Data address karyawan gagal diupdate',
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
        
        $this->form_validation->set_rules('id_position', 'Position', 'required', [
            'required' => 'Position harus diisi',
        ]);
        $this->form_validation->set_rules('id_division', 'division', 'required', [
            'required' => 'Divisi harus diisi',
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
            'id_position' => $this->input->post('id_position', true),
            'id_division' => $this->input->post('id_division', true),
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


        if($this->m_Employees->delete($id) && $this->m_Bank_account->deleteByEmployeeId_get($id) && $this->m_Emergency_contact->deleteByEmployeeId_get($id)){
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
    
        $list = $this->m_Employees->get_datatables($product);
        
        $data = [];
        $no = $this->input->post('start');  
    
        foreach($list as $item) {

			$type = '';
			if ($item['type_employee'] == 1) {
				$type = 'Kontrak';
			} else if ($item['type_employee'] == 2) {
				$type = 'Magang';
			} else {
				$type = 'Permanent';
			}

			$contract = $item['contract_expired'] == null ? '-' : '<button 
                            class="btn btn-warning btn-sm rounded-pill btn-ec" 
                            data-bs-toggle="modal" 
                            data-bs-target="#contractModal"
                            data-id_employees="'.htmlspecialchars($item['id_employee']).'"
                            data-old_contract="'.htmlspecialchars($item['contract_expired']).'">
                            '.date('d M Y', strtotime($item['contract_expired'])).'
                           </button>';

            $action = ' <a href="javascript:void(0)" onclick="editEmployeeBtn(this)" 
                            class="btn gradient-btn-edit mb-2 btn-sm rounded-pill btn-edit-emp"  
                            style="width: 70px"
                            data-edit_id="'. htmlspecialchars($item['id_employee']) .'"
                            data-edit_product="'. htmlspecialchars($item['id_product']) .'"
                            data-edit_date_in="'. htmlspecialchars($item['date_in']) .'"
                            data-edit_nip="'. htmlspecialchars($item['nip']) .'"
                            data-edit_name="'. htmlspecialchars($item['name']) .'"
                            data-edit_gender="'. htmlspecialchars($item['gender']) .'"
                            data-edit_pob="'. htmlspecialchars($item['place_of_birth']) .'"
                            data-edit_dob="'. htmlspecialchars($item['date_of_birth']) .'"
                            data-edit_division="'. htmlspecialchars($item['id_division']) .'"
                            data-edit_basic_salary="'. htmlspecialchars($item['basic_salary']) .'"
                            data-edit_uang_makan="'. htmlspecialchars($item['uang_makan']) .'"
                            data-edit_bonus="'. htmlspecialchars($item['bonus']) .'"
                            data-edit_position="'. htmlspecialchars($item['id_position']) .'">
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
                            <i class="bi bi-credit-card"></i>
                           </button>';
            $ec_info = '<button 
                            class="btn btn-primary btn-sm rounded-pill btn-ec" 
                            data-bs-toggle="modal" 
                            data-bs-target="#ecModal"
                            data-id_employees="'.htmlspecialchars($item['id_employee']).'">
                            <i class="bi bi-people"></i>
                           </button>';
			$address_info = '<button 
                            class="btn btn-success btn-sm rounded-pill btn-bank" 
                            data-bs-toggle="modal" 
                            data-bs-target="#addressShowModal"
                            data-id_employee="'.htmlspecialchars($item['id_employee']).'"
                            data-name="'.htmlspecialchars($item['name']).'"
                            data-product="'.htmlspecialchars($item['name_product']).'"
                             data-desa="'.htmlspecialchars($item['desa']).'"
                             data-blok="'.htmlspecialchars($item['blok']).'"
                             data-kecamatan="'.htmlspecialchars($item['kecamatan']).'"
                             data-kode_pos="'.htmlspecialchars($item['kode_pos']).'"
                             data-spesifik="'.htmlspecialchars($item['spesifik']).'"
                             data-kabupaten="'.htmlspecialchars($item['kabupaten']).'"
                             data-desa_domisili="'.htmlspecialchars($item['desa_domisili']).'"
                             data-blok_domisili="'.htmlspecialchars($item['blok_domisili']).'"
                             data-kecamatan_domisili="'.htmlspecialchars($item['kecamatan_domisili']).'"
                             data-kode_pos_domisili="'.htmlspecialchars($item['kode_pos_domisili']).'"
                             data-spesifik_domisili="'.htmlspecialchars($item['spesifik_domisili']).'"
                             data-kabupaten_domisili="'.htmlspecialchars($item['kabupaten_domisili']).'">
                            <i class="bi bi-pin-map"></i>
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
            $row[] = $item['name_division'];  
            $row[] = $item['name_position'];  
            $row[] = $type;
            $row[] = $contract;
            $row[] = 'Rp.'. number_format($item['basic_salary'], 0 , ',', '.');
            $row[] = 'Rp.'. number_format($item['uang_makan'], 0 , ',', '.');  
            $row[] = 'Rp.'. number_format($item['bonus'], 0 , ',', '.');  
            $row[] = $address_info;
            $row[] = $bank_info;
            $row[] = $ec_info;
            $row[] = $action;  
            $data[] = $row;
        }
    
        $output = [
            "draw" =>@$_POST['draw'],
            "recordsTotal" => $this->m_Employees->count_all(),
            "recordsFiltered" => $this->m_Employees->count_filtered($product),
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
                'message' => 'Bank berhasil ditambahkan',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Bank gagal ditambahkan',
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

    public function get_employee()
    {
        $id_employee = $this->input->post('id_employee');
        if (!$id_employee) {
            echo json_encode(['status' => false, 'message' => 'Invalid Employee ID']);
            return;
        }

        $data = $this->m_Employees->findById_get($id_employee); // Replace with your model logic
        echo json_encode(['status' => true, 'data' => $data]);
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


    //------------ RENEW CONTRACT INFO
    public function contract_info() 
    {
   
        $id = $this->input->post('id_employees');


        if (!$id) {
            echo json_encode([
                'status' => false,
                'message' => 'ID tidak valid.',
            ]);
            return;
        }

        $contractList = $this->m_Log_contract_extension->findByEmployeeId_get($id);

        
        echo json_encode([
            'status' => true,
            'contract' => $contractList,
        ]);
    }

	public function add_contract()
	{
		$this->_isAjax();
		$this->_ONLY_SU();

		$this->form_validation->set_rules('new_contract', 'new_contract', 'required', [
			'required' => 'Kontrak baru harus diisi',
		]);

		$this->form_validation->set_rules('description', 'description', 'required', [
			'required' => 'Description harus diisi',
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
			'old_contract' => $this->input->post('old_contract', true),
			'new_contract' => $this->input->post('new_contract', true),
			'description' => $this->input->post('description', true),
		];

		$renewContract = $this->m_Employees->renewContract_post($id_employee, $data['new_contract']);

		if ($renewContract) {
			$this->m_Log_contract_extension->create_post($data);
			$response = [
				'status' => true,
				'message' => 'Perpanjangan kontrak berhasil dibuat',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Perpanjangan kontrak gagal dibuat',
			];
		}

		echo json_encode($response);
	}



}

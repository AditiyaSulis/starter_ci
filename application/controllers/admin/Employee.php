<?php
class Employee extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_employees');
        $this->load->model('M_products');
        $this->load->model('M_position');
        $this->load->model('M_division');
        $this->load->model('M_bank_account');
        $this->load->model('M_emergency_contact');
        $this->load->model('M_log_contract_extension');
        $this->load->model('M_address');
        $this->load->model('M_domisili');
        $this->load->model('M_ptkp');
        $this->load->model('M_bpjs_config');
        $this->load->model('M_pph_config');

    }


    public function employee_page()
    {
        $this->_ONLYSELECTED([1,2]);
        $data = $this->_basicData();

        $data['title'] = 'Employee';
        $data['view_name'] = 'admin/employee';
        $data['breadcrumb'] = 'Employee';
        $data['menu'] = '';

        $data['employees'] = $this->M_employees->findAllJoin_get();
        $data['division'] = $this->M_division->findAll_get();
        $data['position'] = $this->M_position->findAll_get();
        $data['products'] = $this->M_products->findAll_get();
        $data['pph'] = $this->M_ptkp->findAll_get();
        $data['products_show'] = $this->M_products->findAllShow_get();

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

		$this->form_validation->set_rules('type_uang_makan', 'type_uang_makan', 'required', [
			'required' => 'Type uang makan harus diisi',
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
            'type_uang_makan' => $this->input->post('type_uang_makan', true),
          
        ];

        $employee = $this->M_employees->create_post($data);

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
		$this->_ONLYSELECTED([1,2]);
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
		$this->form_validation->set_rules('type_uang_makan', 'type_uang_makan', 'required', [
			'required' => 'Type uang makan harus diisi',
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
		$this->form_validation->set_rules('type_employee', 'type_employee', 'required', [
			'required' => 'Type karyawan harus diisi',
		]);
		$this->form_validation->set_rules('rewrite_password', 'rewrite_password', 'required', [
			'required' => 'Ketik Ulang password harus diisi!',
		]);

		//USER ACCOUNT
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[20]',[
			'required' => 'password harus diisi',
			'min_length'=> 'password minimal memiliki 4 karakter huruf',
			'max_length'=> 'password tidak boleh melebihi 20 huruf',
		]);
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[admin.email]',[
			'valid_email' => 'Invalid email',
			'is_unique' => 'Email sudah digunakan'
		]);

		//BANK ACCOUNT
		$this->form_validation->set_rules('bank_name', 'bank_name', 'callback_empty_to_null');
		$this->form_validation->set_rules('bank_number', 'bank_number', 'callback_empty_to_null');
		$this->form_validation->set_rules('bank_holder_name', 'bank_holder_name', 'callback_empty_to_null');

		//EMERGENCY CONTACT
		$this->form_validation->set_rules('name_contact', 'name_contact', 'callback_empty_to_null');
		$this->form_validation->set_rules('number_contact', 'number_contact', 'callback_empty_to_null');
		$this->form_validation->set_rules('as_contact', 'as_contact', 'callback_empty_to_null');
		$this->form_validation->set_rules('address_contact', 'address_contact', 'callback_empty_to_null');

		//ADDRESS
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
		$this->form_validation->set_rules('npwp', 'npwp', 'is_unique[pph_config.npwp]',[
			'is_unique' => 'NPWP sudah dipakai',
		]);
		$this->form_validation->set_rules('no_bpjs', 'no_bpjs', 'is_unique[bpjs_config.no_bpjs]|callback_empty_to_null',[
			'is_unique' => 'BPJS sudah dipakai',

		]);
		$this->form_validation->set_rules('nik', 'nik', 'min_length[16]|max_length[16]|is_unique[pph_config.nik]|callback_empty_to_null',[
			'is_unique' => 'NIK sudah dipakai',
			'min_length'=> 'NIK minimal memiliki 16 karakter huruf',
			'max_length'=> 'NIK tidak boleh melebihi 16 huruf',
		]);
		$this->form_validation->set_rules('id_ptkp', 'id_ptkp', 'callback_empty_to_null');

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
			'type_uang_makan' => $this->input->post('type_uang_makan', true),
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
		$pph = [
			'id_ptkp' => $this->input->post('id_ptkp', true),
			'nik' => $this->input->post('nik', true),
			'npwp' => $this->input->post('npwp', true) == '' ? null : $this->input->post('npwp', true),
		];
		$bpjs = [
			'no_bpjs' => $this->input->post('no_bpjs', true) == '' ? null : $this->input->post('no_bpjs', true),
		];


		$employee = $this->M_employees->create_allDataEmployees($emp, $account, $bank, $ec, $address, $domisili, $pph, $bpjs);

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


	public function empty_to_null($input)
	{
		return $input === "" ? NULL : $input;
	}


	public function edit_address(){
		$this->_ONLYSELECTED([1,2]);
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

		if(!$this->M_address->findByEmployeeId_get($id) && !$this->M_domisili->findByEmployeeId_get($id)){
			$address = [
				'id_employee' => $id,
				'kabupaten' => $this->input->post('kabupaten', true),
				'kecamatan' => $this->input->post('kecamatan', true),
				'desa' => $this->input->post('desa', true),
				'blok' => $this->input->post('blok', true),
				'kode_pos' => $this->input->post('kode_pos', true),
				'spesifik' => $this->input->post('spesifik', true),
			];
			$domisili = [
				'id_employee' => $id,
				'kabupaten_domisili' => $this->input->post('kabupaten_domisili', true),
				'kecamatan_domisili' => $this->input->post('kecamatan_domisili', true),
				'desa_domisili' => $this->input->post('desa_domisili', true),
				'blok_domisili' => $this->input->post('blok_domisili', true),
				'kode_pos_domisili' => $this->input->post('kode_pos_domisili', true),
				'spesifik_domisili' => $this->input->post('spesifik_domisili', true),
			];
			if ($this->M_address->create_post($address) && $this->M_domisili->create_post($domisili)) {
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

		if ($this->M_address->update_post($id, $address) && $this->M_domisili->update_post($id, $domisili)) {
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

		$this->_ONLYSELECTED([1,2]);
		$this->_isAjax();
        $id = $this->input->post('id_employee', true);

        $emp = $this->M_employees->findById_get($id);
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
			$this->form_validation->set_rules('type_uang_makan', 'type_uang_makan', 'required', [
				'required' => 'Type uang makan harus diisi',
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

		$this->form_validation->set_rules('type_employee', 'type_employee', 'required', [
			'required' => 'Type employee harus diisi',
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
            $nipExist = $this->M_employees->findByNip_get($newNip);
            if($nipExist){
                $response = [
                    'status' => false,
                    'message' => 'NIP sudah digunakan'
                ];

                echo json_encode($response);

                return;
            }
        }

		$contract_expired = $this->input->post('contract_expired',true);

		if($this->input->post('type_employee',true) == 3) {
			$contract_expired = null;
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
            'type_employee' => $this->input->post('type_employee', true),
            'type_uang_makan' => $this->input->post('type_uang_makan', true),
            'contract_expired' => $contract_expired,
            'no_hp' => $this->input->post('no_hp', true),
        ];



        $employee = $this->M_employees->update_post($id, $data);


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
		$this->_ONLYSELECTED([1,2]);
		$this->_isAjax();

        $id = $this->input->post('id');


        if($this->M_employees->delete($id) && $this->M_bank_account->deleteByEmployeeId_get($id) && $this->M_emergency_contact->deleteByEmployeeId_get($id)){
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
    
        $list = $this->M_employees->get_datatables($product);
        
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

			$type_uang_makan = '';
			if ($item['type_uang_makan'] == 1) {
				$type_uang_makan = 'Hari';
			} else if ($item['type_uang_makan'] == 2) {
				$type_uang_makan = 'Minggu';
			} else {
				$type_uang_makan = 'Bulan';
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
                            data-edit_type_uang_makan="'. htmlspecialchars($item['type_uang_makan']) .'"
                            data-type_employee="'. htmlspecialchars($item['type_employee']) .'"
                            data-contract_expired="'. htmlspecialchars($item['contract_expired']) .'"
                            data-edit_no_hp="'. htmlspecialchars($item['no_hp']) .'"
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
              $account_info = ' <button 
                             class="btn btn-primary btn-sm rounded-pill btn-acc" 
                             data-bs-toggle="modal" 
                             data-bs-target="#userShowModal"
                             data-id_employees="'.htmlspecialchars($item['id_employee']).'"
                             data-email="'.htmlspecialchars($item['email']).'">
                             <i class="bi bi-person-fill-gear"></i>
                            </button>';

			$bpjs_info = ' <button 
                             class="btn gradient-btn-unpaid btn-sm rounded-pill btn-bpjs" 
                             data-bs-toggle="modal" 
                             data-bs-target="#bpjsShowModal"
                             data-id_employee="'.htmlspecialchars($item['id_employee']).'"
                             data-no_bpjs="'.htmlspecialchars($item['no_bpjs']).'">
                             <i class="bi bi-prescription2"></i>
                            </button>';
			$pph_info = ' <button 
                             class="btn gradient-btn-paid btn-sm rounded-pill btn-pph" 
                             data-bs-toggle="modal" 
                             data-bs-target="#pphShowModal"
                             data-id_employee="'.htmlspecialchars($item['id_employee']).'"
                             data-nik="'.htmlspecialchars($item['nik']).'"
                             data-npwp="'.htmlspecialchars($item['npwp']).'"
                             data-id_ptkp="'.htmlspecialchars($item['id_ptkp']).'">
                             <i class="bi bi-cash"></i>
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
			$row[] = $item['no_hp'];
            $row[] = $item['name_division'];  
            $row[] = $item['name_position'];
            $row[] = $type;
            $row[] = $contract;
            $row[] = 'Rp.'. number_format($item['basic_salary'], 0 , ',', '.');
            $row[] = 'Rp.'. number_format($item['uang_makan'], 0 , ',', '.').'/'.$type_uang_makan;
			$row[] = $account_info;
			$row[] = $bpjs_info;
			$row[] = $pph_info;
            $row[] = $address_info;
            $row[] = $bank_info;
            $row[] = $ec_info;
            $row[] = $action;  
            $data[] = $row;
        }
    
        $output = [
            "draw" =>@$_POST['draw'],
            "recordsTotal" => $this->M_employees->count_all(),
            "recordsFiltered" => $this->M_employees->count_filtered($product),
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
 
         $banklist = $this->M_bank_account->findByEmployeeId_get($id);
 
         
         echo json_encode([
             'status' => true,
             'banks' => $banklist,
         ]);
     }


     public function add_bank()
    {
        $this->_isAjax();
		$this->_ONLYSELECTED([1,2]);

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

        $add_bank = $this->M_bank_account->create_post($data);

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
		$this->_ONLYSELECTED([1,2]);
        $this->_isAjax();

        $id = $this->input->post('id_bank');


        if($this->M_bank_account->delete($id)){
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

        $data = $this->M_employees->findById_get($id_employee); // Replace with your model logic
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

        $contactList = $this->M_emergency_contact->findByEmployeeId_get($id);

        
        echo json_encode([
            'status' => true,
            'contacts' => $contactList,
        ]);
    }


    public function add_contact()
    {
        $this->_isAjax();
		$this->_ONLYSELECTED([1,2]);

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

        $add_contact = $this->M_emergency_contact->create_post($data);

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
		$this->_ONLYSELECTED([1,2]);
        $this->_isAjax();

        $id = $this->input->post('id_contact');


        if($this->M_emergency_contact->delete($id)){
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

        $contractList = $this->M_log_contract_extension->findByEmployeeId_get($id);

        
        echo json_encode([
            'status' => true,
            'contract' => $contractList,
        ]);
    }


	public function add_contract()
	{
		$this->_isAjax();
		$this->_ONLYSELECTED([1,2]);

		$id_employee = $this->input->post('id_employee', true);
		$employee = $this->M_employees->findById_get($id_employee);

		if($employee['type_employee'] == 3){
			$response = [
				'status' => false,
				'message' => 'Tidak bisa melakukan perpanjangan pada karyawan bertype permanent',
			];

			echo json_encode($response);

			return;
		}

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



		$data = [
			'id_employee' => $this->input->post('id_employee', true),
			'old_contract' => $this->input->post('old_contract', true),
			'new_contract' => $this->input->post('new_contract', true),
			'description' => $this->input->post('description', true),
		];


		$renewContract = $this->M_employees->renewContract_post($id_employee, $data['new_contract']);

		if ($renewContract) {
			$this->M_log_contract_extension->create_post($data);
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


    //--------------- ACCOUNT INFO 
    public function find_user()
    {
        $email = $this->input->post('email', true);

        // Ambil data user berdasarkan email
        $account = $this->M_admin->findByEmailOnly_get($email);

		$lb = new Opensslencryptdecrypt();
		$decryptPassword =$lb->decrypt($account['password']);

        if (empty($account)) {
            echo json_encode([
                'status' => false,
				'email' => $email,
                'message' => 'Data tidak ditemukan',
            ]);
            return;
        } 
    
        // Kirim data email & password ke frontend
        echo json_encode([
            'status' => true,
            'email' => $email,
            'data' => [
                'email' => $account['email'],
                'password' => $decryptPassword  // Pastikan password tidak di-hash jika ingin ditampilkan
            ]
        ]);
    }


	public function edit_user(){
		$this->_ONLYSELECTED([1,2]);
		$this->_isAjax();

		$this->form_validation->set_rules('email', 'email', 'required', [
			'required' => 'Email harus diisi!',
		]);
		$this->form_validation->set_rules('password', 'password', 'required', [
			'required' => 'Password harus diisi!',
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

		$newEmail = $this->input->post('email', true);
		$oldEmail = $this->input->post('old_email', true);
		$password = $this->input->post('password', true);


		if ($this->M_admin->changeEmailNPassword_post($oldEmail, $newEmail, $password) && $this->M_employees->changeEmail_post($oldEmail, $newEmail)) {
		$response = [
			'status' => true,
			'message' => 'User account karyawan berhasil diupdate',
		];
		} else {
			$response = [
				'status' => false,
				'message' => 'User account karyawan gagal diupdate',
			];
		}

		echo json_encode($response);

	}


	//----------------BPJS INFO
	public function edit_bpjs(){
		$this->_ONLYSELECTED([1,2]);
		$this->_isAjax();

		$id = $this->input->post('id_employee');
		$bpjs = $this->M_bpjs_config->findByEmployeeId_get($id);
		$oldBpjs = $bpjs['no_bpjs'];

		$this->form_validation->set_rules('no_bpjs', 'no_bpjs', 'min_length[11]|max_length[13]', [
			'min_length' => 'BPJS minimal 11 karakter',
			'max_length' => 'BPJS maksimal 13 karakter',
		]);

		$newBpjs = $this->input->post('no_bpjs', true);

		if($newBpjs != $oldBpjs){
			$this->form_validation->set_rules('no_bpjs', 'bpjs', 'min_length[11]|max_length[13]|is_unique[bpjs_config.no_bpjs]', [
				'min_length' => 'BPJS minimal 11 karakter',
				'max_length' => 'BPJS maksimal 13 karakter',
				'is_unique' => 'BPJS sudah dipakai',
			]);
		}



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


		$address = [
			'no_bpjs' => $this->input->post('no_bpjs', true) == '' ? null :  $this->input->post('no_bpjs', true) ,
		];

		if(!$this->M_bpjs_config->findByEmployeeId_get($id)){
			$address = [
				'id_employee' => $id,
				'no_bpjs' => $this->input->post('no_bpjs', true) == '' ? null :  $this->input->post('no_bpjs', true) ,
			];
			if ($this->M_bpjs_config->create_post($address)) {
				$response = [
					'status' => true,
					'message' => 'Data BPJS karyawan berhasil ditambahkan',
				];
			} else {
				$response = [
					'status' => false,
					'message' => 'Data BPJS karyawan gagal ditambahkan',
				];
			}

			echo json_encode($response);

			return;
		}

		if ($this->M_bpjs_config->update_post($id, $address) ) {
			$response = [
				'status' => true,
				'message' => 'Data BPJS karyawan berhasil diupdate',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Data BPJS karyawan gagal diupdate',
			];
		}

		echo json_encode($response);

	}


	//----------------PPH INFO

	public function edit_pph(){
		$this->_ONLYSELECTED([1,2]);
		$this->_isAjax();

		$this->form_validation->set_rules('id_ptkp', 'id_ptkp', 'required', [
			'required' => 'Jenis PPH harus diisi!',
		]);
		$this->form_validation->set_rules('nik', 'nik', 'required', [
			'required' => 'NIK harus diisi!',
		]);

		$id = $this->input->post('id_employee');
		$pph = $this->M_pph_config->findByEmployeeId_get($id);
		$oldNpwp = $pph['npwp'];
		$oldNik = $pph['nik'];

		$newNpwp = $this->input->post('npwp', true);
		$newNik = $this->input->post('nik', true);
		if($newNpwp != $oldNpwp){
			$this->form_validation->set_rules('npwp', 'npwp', 'min_length[16]|max_length[16]|is_unique[pph_config.npwp]', [
				'min_length' => 'NPWP minimal 16 karakter',
				'max_length' => 'NPWP maksimal 16 karakter',
				'is_unique' => 'NPWP sudah dipakai',
			]);
		}

		if($newNik != $oldNik){
			$this->form_validation->set_rules('nik', 'nik', 'min_length[16]|max_length[16]|is_unique[pph_config.nik]', [
				'min_length' => 'NIK minimal 16 karakter',
				'max_length' => 'NIK maksimal 16 karakter',
				'is_unique' => 'NIK sudah dipakai',
			]);
		}

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



		$address = [
			'id_ptkp' => $this->input->post('id_ptkp', true),
			'npwp' => $this->input->post('npwp', true) == '' ? null : $this->input->post('npwp', true),
			'nik' => $this->input->post('nik', true),
		];

		if(!$this->M_pph_config->findByEmployeeId_get($id)){
			$address = [
				'id_employee' => $id,
				'id_ptkp' => $this->input->post('id_ptkp', true),
				'npwp' => $this->input->post('npwp', true) == '' ? null : $this->input->post('npwp', true),
				'nik' => $this->input->post('nik', true),
			];
			if ($this->M_pph_config->create_post($address)) {
				$response = [
					'status' => true,
					'message' => 'Data PPH karyawan berhasil ditambahkan',
				];
			} else {
				$response = [
					'status' => false,
					'message' => 'Data PPH karyawan gagal ditambahkan',
				];
			}

			echo json_encode($response);

			return;
		}

		if ($this->M_pph_config->update_post($id, $address) ) {
			$response = [
				'status' => true,
				'message' => 'Data PPH karyawan berhasil diupdate',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Data PPH karyawan gagal diupdate',
			];
		}

		echo json_encode($response);

	}
}

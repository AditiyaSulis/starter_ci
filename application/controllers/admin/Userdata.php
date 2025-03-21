<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Userdata extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->library('upload');

    }

    public function datauser_page()
    {
        $this->_ONLY_SU();
        $data = $this->_basicData();
        $data['data_user'] = $this->m_Admin->findAll_get();
       
        $data['title'] = 'Data User';
        $data['view_name'] = 'admin/user_data';
        $data['breadcrumb'] = 'Data User';
        if($data['user']){
                $this->load->view('templates/index', $data);
            } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
            redirect('fetch/login');
        }
    }


    public function add_user()
    {
        $this->_ONLY_SU();
        $this->_isAjax();

        $this->form_validation->set_rules('name', 'name', 'required|max_length[60]|min_length[3]',[
            'required' => 'Nama harus diisi',
            'max_length' => 'Nama tidak boleh melebihi 60 karakter',
            'min_length' => 'Nama minimal memiliki 3 karakter',
        ]);
        $this->form_validation->set_rules('email', 'email', 'required|is_unique[admin.email]',[
            'required' => 'email harus diisi',
            'is_unique' => 'Email telah digunakan'
        ]);

        $this->form_validation->set_rules('role', 'role', 'required',[
            'required' => 'Role harus diisi',
        ]);

        $this->form_validation->set_rules('status', 'status', 'required',[
            'required' => 'Status harus diisi',
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

        $this->load->helper('image_helper');

        $upload_path = 'avatar/'; 
        $resize_width = 500;
        $resize_height = 500;
        $resize_quality = 60;

        $upload_result = upload_and_resize('avatar', $upload_path, $resize_width, $resize_height, $resize_quality);

        if (!$upload_result['status']) {
            $response = [
                'status' => false,
                'message' => $upload_result['message'],
            ];
            echo json_encode($response);
            return;
        }

        $logo_name = $upload_result['message'];

        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'avatar' => $logo_name,
            'status' => $this->input->post('status'),
            'role' => $this->input->post('role'),
        ];

        $usercreate = $this->m_Admin->create_post($data);

        if ($usercreate) {
            $response = [
                'status' => true,
                'message' => 'User berhasil ditambahkan',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'User gagal ditambahkan',
            ];
        }

        echo json_encode($response);
    }


    public function update_post()
    {
        $this->_ONLY_SU();

        $id = $this->input->post('id', true);
        if(!$id){
            $response = [
                'status' => false,
                'message' => 'ID tidak valid'
            ];
            return;
        }

        $account = $this->m_Admin->findById_get($id);

        $old_email = $account['email'];


        $this->form_validation->set_rules('name', 'name', 'required|max_length[60]|min_length[3]',[
            'required' => 'Nama harus diisi',
            'max_length' => 'Nama tidak boleh melebihi 60 karakter',
            'min_length' => 'Nama minimal memiliki 3 karakter',
        ]);
        $this->form_validation->set_rules('role', 'role', 'required',[
            'required' => 'Role harus diisi',
        ]);
        $this->form_validation->set_rules('status', 'status', 'required',[
            'required' => 'Status harus diisi',
        ]);

        if($this->form_validation->run()==false) {
            $response = [
                'status' => false,
                'message' => validation_errors('<p>', '</p>'),
                'confirmationbutton' => true,
                'timer' => 0,
                'icon' => 'error'
            ];
            echo json_encode($response);

            return;
        }

        $new_email = $this->input->post('email', true);

        if($old_email != $new_email) {
            $emailExist = $this->m_Admin->findByEmailForEdit_get($new_email);
            if($emailExist){
                $response = [
                    'status' => false,
                    'message' => 'Email sudah digunakan'
                ];

                echo json_encode($response);

                return;
            }
        }

        if (empty($_FILES['avatar']['name'])) {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'status' => $this->input->post('status'),
                'role' => $this->input->post('role'),
            ];
    
            if ($this->m_Admin->update_post($id, $data)) {
                $response = [
                    'status' => true,
                    'message' => 'Account berhasil diperbarui.'
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Gagal memperbarui account.'
                ];
            }
            echo json_encode($response);
            return;
        }

        $data_account = $this->m_Admin->findById_get($id);
        if ($data_account && !empty($data_account['avatar'])) {
            $old_logo_path = './uploads/avatar/' . $data_account['avatar'];
            if (file_exists($old_logo_path)) {
                unlink($old_logo_path); 
            }
         }
    
    
        $this->load->helper('image_helper');
        $upload_path = 'avatar/';
        $resize_width = 500;
        $resize_height = 500;
        $resize_quality = 60;
    
        $upload_result = upload_and_resize('avatar', $upload_path, $resize_width, $resize_height, $resize_quality);
    
        if (!$upload_result['status']) {
            $response = [
                'status' => false,
                'message' => $upload_result['message'],
            ];
            echo json_encode($response);
            return;
        }

        $logo_name = $upload_result['message'];

        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'avatar' => $logo_name,
            'status' => $this->input->post('status'),
            'role' => $this->input->post('role'),
        ];

		$account = [
			'email' => $this->input->post('email')
		];

        $account_updated = $this->m_Admin->update_post($id, $data);

        if($account_updated) {
            $response = [
                'status' => true,
                'message' => 'Data Account berhasil diupdate',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Data account gagal diupdate'
            ];
        }

        echo json_encode($response);
    }


    public function edit()
    {
        $this->_ONLY_SU();

        $id = $this->input->post('id', true);
        if(!$id) {
            $response = [
                'status' => false,
                'message' => 'ID tidak valid'
            ];
        }

        $account = $this->m_Admin->findById_get($id);

        $old_email = $account['email'];

        $this->form_validation->set_rules('name', 'Name', 'required|max_length[60]|min_length[3]', [
            'required' => 'Nama harus diisi',
            'max_length' => 'Nama tidak boleh melebihi 60 karakter',
            'min_length' => 'Nama minimal memiliki 3 karakter'
        ]);

        $this->form_validation->set_ruler('role', 'role', 'required',[
            'required' => 'Role harus diisi'
        ]);

        $this->form_validation->set_rules('status', 'status', 'required', [
            'required' => 'Status harus diisi'
        ]);

        $this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[18]', [
            'required' => 'Password harus diisi',
            'min_length' => 'Password minimal memliki 6 karakter',
            'max_length' => 'Password tidak boleh melebihi 18 karakter'
        ]);

        if($this->form_validation->run()==false){
            $response = [
                'status'=> false,
                'message' => validation_errors('<p>', '</p>'),
                'confirmationbutton' => true,
                'timer' => 0,
                'icon' => 'error'
            ];
            echo jeson_Encode($response);

            return;
        }

        $password = $this->input->post('password', true);

        $lb = new Opensslencryptdecrypt();
        $encrypt = $lb->encrypt($password);

        $new_email = $this->input->post('email', true);

        if($old_email != $new_email) {
            $emailExist = $this->m_Admin->findByEmailForEdit_get($new_email);
            if($emailExist){
                $response = [ 
                    'status' => false,
                    'message' => 'Email sudah digunakan'
                ];
                
                echo json_encode($response);

                return;
            }
        }

        if(empty($_FILES['avatar']['name'])){
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'status' => $this->input->post('status'),
                'role' => $this->input->post('role'),
                'password'=> $encrypt
            ];
            if ($this->m_Admin->update_post($id, $data)) {
                $response = [
                    'status' => true,
                    'message' => 'Account berhasil diperbarui.'
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Gagal memperbarui account.'
                ];
            }
            echo json_encode($response);
            return;
        }

        if($account && !empty($account['avatar'])) {
            $old_logo_path = './uploads/avatar/' . $data_account['avatar'];
            if(file_exists($old_logo_path)){
                unlink($old_logo_path);
            }
        }

        $this->load->helper('image_helper');
        $upload_path = 'avatar/';
        $resize_width = 500;
        $resize_height = 500;
        $resize_quality = 60;
    
        $upload_result = upload_and_resize('avatar', $upload_path, $resize_width, $resize_height, $resize_quality);
    
        if (!$upload_result['status']) {
            $response = [
                'status' => false,
                'message' => $upload_result['message'],
            ];
            echo json_encode($response);
            return;
        }

        $logo_name = $upload_result['message'];

        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'avatar' => $logo_name,
            'status' => $this->input->post('status'),
            'role' => $this->input->post('role'),
        ];

        $account_updated = $this->m_Admin->update_post($id, $data);

        if($account_updated) {
            $response = [
                'status' => true,
                'message' => 'Data Account berhasil diupdate',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Data account gagal diupdate'
            ];
        }

        echo json_encode($response);


    }


    public function update()
    {
        $this->_ONLY_SU();

        $id = $this->input->post('id', true);
        if(!$id){
            $response = [
                'status' => false,
                'message' => 'ID tidak valid'
            ];
            return;
        }

        $account = $this->m_Admin->findById_get($id);

        $old_email = $account['email'];


        $this->form_validation->set_rules('name', 'name', 'required|max_length[60]|min_length[3]',[
            'required' => 'Nama harus diisi',
            'max_length' => 'Nama tidak boleh melebihi 60 karakter',
            'min_length' => 'Nama minimal memiliki 3 karakter',
        ]);
        $this->form_validation->set_rules('role', 'role', 'required',[
            'required' => 'Role harus diisi',
        ]);
        $this->form_validation->set_rules('status', 'status', 'required',[
            'required' => 'Status harus diisi',
        ]);

        if($this->form_validation->run()==false) {
            $response = [
                'status' => false,
                'message' => validation_errors('<p>', '</p>'),
                'confirmationbutton' => true,
                'timer' => 0,
                'icon' => 'error'
            ];
            echo json_encode($response);

            return;
        }

        $new_email = $this->input->post('email', true);

        if($old_email != $new_email) {
            $emailExist = $this->m_Admin->findByEmailForEdit_get($new_email);
            if($emailExist){
                $response = [
                    'status' => false,
                    'message' => 'Email sudah digunakan'
                ];

                echo json_encode($response);

                return;
            }
        }

        if (empty($_FILES['avatar']['name'])) {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'status' => $this->input->post('status'),
                'role' => $this->input->post('role'),
            ];
    
            if ($this->m_Admin->update_post($id, $data)) {
                $response = [
                    'status' => true,
                    'message' => 'Account berhasil diperbarui.'
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Gagal memperbarui account.'
                ];
            }
            echo json_encode($response);
            return;
        }

        $data_account = $this->m_Admin->findById_get($id);
        if ($data_account && !empty($data_account['avatar'])) {
            $old_logo_path = './uploads/avatar/' . $data_account['avatar'];
            if (file_exists($old_logo_path)) {
                unlink($old_logo_path); 
            }
         }
    
    
        $this->load->helper('image_helper');
        $upload_path = 'avatar/';
        $resize_width = 500;
        $resize_height = 500;
        $resize_quality = 60;
    
        $upload_result = upload_and_resize('avatar', $upload_path, $resize_width, $resize_height, $resize_quality);
    
        if (!$upload_result['status']) {
            $response = [
                'status' => false,
                'message' => $upload_result['message'],
            ];
            echo json_encode($response);
            return;
        }

        $logo_name = $upload_result['message'];

        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'avatar' => $logo_name,
            'status' => $this->input->post('status'),
            'role' => $this->input->post('role'),
        ];

        $account_updated = $this->m_Admin->update_post($id, $data);

        if($account_updated) {
            $response = [
                'status' => true,
                'message' => 'Data Account berhasil diupdate',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Data account gagal diupdate'
            ];
        }

        echo json_encode($response);
    }
    

    public function delete()
    {
        $this->_ONLY_SU();
        $this->_isAjax();
        
        $id = $this->input->post('id');

        $user_data = $this->m_Admin->findById_get($id);

        if ($user_data) {

            if (isset($user_data['avatar']) && !empty($user_data['avatar'])) {
                $imagePath = './uploads/avatar/' . $user_data['avatar'];
                if (file_exists($imagePath)) {
                    unlink($imagePath); 
                }
                
            }

        }

        if($this->m_Admin->delete($id)){
            $response = [
                'status' => true,
                'message' => 'User berhasil dihapus',
            ];
        } else {
            $response = [
               'status' => false,  
               'message' => 'User gagal dihapus',  
            ];
        }
        
        echo json_encode($response);

    }


	public function signup()
	{
		$this->_ONLY_SU();
		$data = $this->_basicData();


		$data['title'] = 'Add Account';
		$data['view_name'] = 'login/signup';
		$data['menu'] = '';
		$data['breadcrumb'] = 'Add Account';
		if($data['user']){
			$this->load->view('templates/index', $data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('panel');
		}
	}


	public function regist()
	{
		$this->_ONLY_SU();
		$this->_isAjax();

		$this->form_validation->set_rules('name', 'Name', 'required|min_length[4]|max_length[50]', [
			'required' => 'Nama harus diisi',
			'min_length' => 'Nama minimal memiliki 4 karakter huruf',
			'max_length' => 'Nama tidak boleh melebihi 50 huruf',
		]);
		$this->form_validation->set_rules('role', 'role', 'required', [
			'required' => 'Role harus diisi',
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[20]', [
			'required' => 'Password harus diisi',
			'min_length' => 'Password minimal memiliki 4 karakter huruf',
			'max_length' => 'Password tidak boleh melebihi 20 huruf',
		]);
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[admin.email]', [
			'valid_email' => 'Invalid email',
			'is_unique' => 'Email sudah digunakan'
		]);

		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => false,
				'message' => validation_errors('<p>', '</p>'),
				'confirmationbutton' => true,
				'timer' => 0,
				'icon' => 'error'
			]);
			return;
		}

		if (empty($_FILES['avatar']['name'])) {
			echo json_encode([
				'status' => false,
				'message' => 'Avatar harus diunggah',
				'confirmationbutton' => true,
				'timer' => 0,
				'icon' => 'error'
			]);
			return;
		}

		$this->load->helper('image_helper');

		$upload_path = 'avatar/';
		$resize_width = 500;
		$resize_height = 500;
		$resize_quality = 60;

		$upload_result = upload_and_resize('avatar', $upload_path, $resize_width, $resize_height, $resize_quality);

		if (!$upload_result['status']) {
			$response = [
				'status' => false,
				'message' => $upload_result['message'],
			];
			echo json_encode($response);
			return;
		}

		$logo_name = $upload_result['message'];;


		$lb = new Opensslencryptdecrypt();

		$encrypt =$lb->encrypt($this->input->post('password', true));

		$data = [
			'avatar' => $logo_name,
			'name' => $this->input->post('name', true),
			'email' => $this->input->post('email', true),
			'password' => $encrypt,
			'role' => $this->input->post('role', true),
		];



		if ($this->M_admin->create_post($data)) {
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
}

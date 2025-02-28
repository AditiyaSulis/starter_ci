<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
        $this->load->library('upload');

    }


    public function login() 
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'valid_email' => 'Email salah',
            'required' => 'Email harus diisi'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]', [
            'required' => 'Password harus diisi',
            'min_length' => 'Password minimal 4 huruf',
        ]);
    
        if ($this->form_validation->run() == FALSE) {
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
    
        $data = [
            'email' => $this->input->post('email', true),
            'password' => $this->input->post('password', true)
        ];
    

        $infoAccount = $this->M_admin->findByEmail_get($data['email'], $data['password']);
        if ($infoAccount) {
            if ($infoAccount['status'] != 1) {
                $response = [
                    'status' => false,
                    'message' => 'Akun anda telah dibanned',
                ];
                echo json_encode($response);
                return;
            }
    
            $this->M_admin->updateLogin_post($data['email']);
            $this->session->set_userdata('user', $infoAccount['id']);

			$url = $infoAccount['role'] == 1 || $infoAccount['role'] == 2 ? 'admin/dashboard/dashboard_page?with_alerts=1' : 'absence/absence/absence_page';


            $response = [
                'status' => true,
                'message' => 'Berhasil Login',
                'redirect' => base_url($url),
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Email atau password salah',
            ];
        }
    
        echo json_encode($response);  
    }
    

    public function logout()
    {
        $this->session->unset_userdata('user');

        redirect('fetch/login');
    }


    public function signup()
    {
        $id = $this->session->userdata('user');
        if(!$id) {
            $this->load->view('login/signup');
        } else {
            $this->session->set_flashdata('authorize', 'Anda sudah login');
            redirect('admin/admin/admin_page');
        }
    }


    public function regist() 
    {
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[4]|max_length[50]', [
            'required' => 'Nama harus diisi',
            'min_length' => 'Nama minimal memiliki 4 karakter huruf',
            'max_length' => 'Nama tidak boleh melebihi 50 huruf',
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
    
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|png|jpg|jpeg';
        $config['max_size'] = 2048;
        $config['file_name'] = time() . '_' . $_FILES['avatar']['name'];
    
        $this->upload->initialize($config);
    
        if (!$this->upload->do_upload('avatar')) {
            $error = $this->upload->display_errors();
            echo json_encode([
                'status' => false,
                'message' => 'Gagal mengunggah avatar: ' . $error,
                'confirmationbutton' => true,
                'timer' => 0,
                'icon' => 'error'
            ]);
            return;
        }
    
        $file_data = $this->upload->data();
        $avatar = $file_data['file_name'];

        $lb = new Opensslencryptdecrypt();

        $encrypt =$lb->encrypt($this->input->post('password', true));
    
        $data = [
            'avatar' => $avatar,
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'password' => $encrypt,
            'role' => $this->input->post('role', true),
        ];
    
        if ($this->M_admin->create_post($data)) {
            echo json_encode([
                'status' => true,
                'confirmationbutton' => false,
                'message' => 'Pendaftaran berhasil',
                'icon' => 'success',
                'timer' => 1500,
                'redirect' => site_url('fetch/admin')
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Pendaftaran gagal',
                'confirmationbutton' => true,
                'timer' => 0,
                'icon' => 'error'
            ]);
        }
    }


    public function edit_get()
    {
        $id = $this->input->post('id');

        if(!$id){
            echo json_encode([
                'status' => true,
                'message' => 'ID User tidak valid',
            ]);
            return;
        }

        $account = $this->M_admin->findById_get($id);
        $accountDto = [
            'id' => $account['id'],
            'name' => $account['name'],
            'email' => $account['email'],
           

        ];

        if($accountDto) {
            echo json_encode([
                'status' => true,
                'account' => $accountDto,
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

    }


    public function update_post()
    {
        //$this->_ONLYSELECTED([1,2]);

        $id = $this->input->post('id', true);
        if(!$id){
            $response = [
                'status' => false,
                'message' => 'ID tidak valid'
            ];
            return;
        }

        $account = $this->M_admin->findById_get($id);

        $old_email = $account['email'];


        $this->form_validation->set_rules('name', 'name', 'required|max_length[60]|min_length[3]',[
            'required' => 'Nama harus diisi',
            'max_length' => 'Nama tidak boleh melebihi 60 karakter',
            'min_length' => 'Nama minimal memiliki 3 karakter',
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
            $emailExist = $this->M_admin->findByEmailForEdit_get($new_email);
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
            ];
    
            if ($this->M_admin->update_post($id, $data)) {
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

        $data_account = $this->M_admin->findById_get($id);
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
            
        ];

        $account_updated = $this->M_admin->update_post($id, $data);

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
    
    
} 


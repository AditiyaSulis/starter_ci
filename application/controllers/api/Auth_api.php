<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Auth_api extends RestController{


    function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
        validate_header();

    }

    public function getAll_get()
    {
        $data = $this->m_Admin->findAll_get();

        if($data){
            $this->response([
                'status' => true,
                'data'=> $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message'=> 'Tidak ada data'
            ], RestController::HTTP_NOT_FOUND); 
        }
    }

    public function register_post()
    {

        $this->form_validation->set_rules('name', 'Name', 'required|min_length[4]|max_length[50]',[
            'required' => 'Nama harus diisi',
            'min_length'=> 'Nama minimal memiliki 4 karakter huruf',
            'max_length'=> 'Nama tidak boleh melebihi 50 huruf',

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

        $this->form_validation->set_rules('role', 'Role', 'required',[
            'required' => 'role harus diisi',

        ]);

        if ($this->form_validation->run() == FALSE){
            print_r(validation_errors());
            return;
        }

        $lb = new Opensslencryptdecrypt();

        $encrypt =$lb->encrypt($this->input->post('password', true));

        $data = [
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'password' => $encrypt,
            'role' => $this->input->post('role', true),
        ];

        // echo 'Pendaftaran berhasil'.PHP_EOL;
    
        if($this->m_Admin->create_post($data)){
            if($data['role']== 1){
                $this->response([
                    'status' => true,
                    'message' => 'Akun anda berhasil didaftarkan dengan role super user.'
                ],RestController::HTTP_OK);
            } else if($data['role']== 2){
                $this->response([
                    'status' => true,
                    'message' => 'Akun anda berhasil didaftarkan dengan role admin.'
                ],RestController::HTTP_OK);
            }
        } else {
            $this->response([
                'status' => FALSE,
                'error' => 'Pendaftaran gagal.'
            ],RestController::HTTP_BAD_REQUEST);
        }
  
    }

    public function update_put($id) 
    {
        // Periksa apakah akun dengan ID tertentu ada
        $account = $this->m_Admin->findById_get($id);
        

        if (!$account) {
            $this->response([
                'status' => false,
                'message' => 'Akun tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
            return;
        }

        $oldEmail = $account['email'];
    
        // Validasi input
        $this->form_validation->set_data($this->input->input_stream());
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[4]|max_length[50]', [
            'required' => 'Nama harus diisi',
            'min_length' => 'Nama minimal memiliki 4 karakter huruf',
            'max_length' => 'Nama tidak boleh melebihi 50 huruf',
        ]);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Email harus diisi',
            'valid_email' => 'Email tidak valid',
        ]);
        $this->form_validation->set_rules('role', 'Role', 'required', [
            'required' => 'Role harus diisi',
        ]);
        
        if ($this->form_validation->run() === FALSE) {
            $this->response([
                'status' => false,
                'errors' => validation_errors()
            ], RestController::HTTP_BAD_REQUEST);
            return;
        }

        
        if($oldEmail != $data['email']){
           $emailValid = $this->db->get_where('admin', ['email' => $data['email']])->row_array();
            if($emailValid) {
                $this->response([
                    'status' => false,
                    'message' => 'Email sudah digunakan'
                ], 500);
            }
        }

        $data = [
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'password' => $encrypt,
            'role' => $this->input->post('role', true),
        ];

        $updateResult = $this->m_Admin->update($data, $id);
    
        if ($updateResult) {
            $this->response([
                'status' => true,
                'message' => 'Akun berhasil diperbarui',
                'data' => $data
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal memperbarui akun'
            ], 500);
        }
    }

    public function isLogin_post()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',[
            'valid_email' => 'Invalid email'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');   

        if ($this->form_validation->run() == FALSE){
            $this->response([
                'status' => false,
                'error'=> validation_errors()
            ], RestController::HTTP_BAD_REQUEST);
        }

        $data = [
            'email' => $this->input->post('email',true),
            'password' => $this->input->post('password', true)
        ];

        $Lib = new Informationclient();
        $ip  = $Lib->ipclient();


        // echo $ip.PHP_EOL;

        $lb = new Opensslencryptdecrypt();

        $encrypt =$lb->encrypt($data['password']);

        $infoAccount = $this->db->get_where('admin', ['email' => $data['email'], 'password' => $encrypt])->row_array();
        if($infoAccount){
            if($infoAccount['status']!=1){
                $this->response([
                    'status'=> FALSE,
                    'message'=>'akun dibanned'
                ],RestController::HTTP_BAD_REQUEST);
            }

             $this->db->set('last_login', date('Y-m-d H:i:s'));
             $this->db->set('ip_address', $ip);
             $this->db->where('email', $data['email']);
             $this->db->update('admin');

            if($infoAccount['role'] == 1) {
                $this->response([
                    'status'=> true,
                    'role' => 'super user'
                ],200);
                
            } else if($infoAccount['role'] == 2) {
                $this->response([
                    'status'=> true,
                    'role' => 'admin'
                ],200);
            } 
        } else {
            $this->response([
                'status' => 'false',
                'message'=> 'Email atau password salah'
            ], 500);
        }
    }
    
}

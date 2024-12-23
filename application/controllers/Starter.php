<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Starter extends CI_Controller{

    function __construct(){
        parent::__construct();
        // $this->load->model('m_Admin');


    }

    public function login(){

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',[
            'valid_email' => 'Invalid email'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');   

        if ($this->form_validation->run() == FALSE){
            print_r(validation_errors());
            return;
        }

        $data = [
            'email' => $this->input->post('email',true),
            'password' => $this->input->post('password', true)
        ];

        $Lib = new Informationclient();
        $ip  = $Lib->ipclient();


        echo $ip.PHP_EOL;

        $lb = new Opensslencryptdecrypt();

        $encrypt =$lb->encrypt($data['password']);


        echo $encrypt;
        
        


        
    }

    public function register(){

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
            'required' => 'Email harus diisi'
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

        echo 'Pendaftaran berhasil'.PHP_EOL;
    
        switch($data['role']){
            case 1:
                echo 'Akun berhasil didaftarkan dengan role SUPER USER'.PHP_EOL;
                break;
            case 2: 
                echo 'Akun berhasil didaftarkan dengan role admin'.PHP_EOL;
                break;
        }

        echo "Nama : {$data['name']}".PHP_EOL;
        echo "Password : {$data['password']}";
  
    }

   
}

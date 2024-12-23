<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Super_user extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('m_Admin');


    }

    // public function super_user_page(){
    //     $id = $this->session->userdata('user');
    //     $data['user'] = $this->m_Admin->findById($id);
    //     $data['allUsers'] = $this->m_Admin->total_users();
    //     $data['allSuperUsers'] = $this->m_Admin->total_super_users();
    //     $data['allAdmins']= $this->m_Admin->total_admins();

    //     $data['title'] = 'Super User ';
    //     $data['view_name'] = 'super_user/index';
    //     if($data['user']) { 
    //         if($data['user']['role'] == 2){
    //             $this->load->view('templates/index' ,$data);
    //         } else {
    //             redirect('admin/admin/admin_page');
    //         }
    //     } else {
    //         $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
    //         redirect('fetch/login');
    //     }
     
    // }
}
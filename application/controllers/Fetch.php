<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Client;

class Fetch extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('m_Admin');
    }

    public function login(){
        $id = $this->session->userdata('user');
        if(!$id) {
            $this->load->view('login/index');
        } else {
            $this->session->set_flashdata('authorize', 'Anda sudah login');
            redirect('admin/dashboard/dashboard_page');
        }
        
        

    }

    // public function admin(){
    //     $id = $this->session->userdata('user');
    //     $user = $this->m_Admin->findById($id);
    //     $allUsers = $this->m_Admin->total_users();
    //     $allSuperUsers = $this->m_Admin->total_super_users();
    //     $allAdmins= $this->m_Admin->total_admins();
    //     if($user){
    //         if($user['role'] == 1){
    //             $this->load->view('templates/header', ['user'=> $user]);
    //             $this->load->view('admin/index', ['user'=> $user, 'allusers' => $allUsers, 'allsuperusers' => $allSuperUsers, 'alladmins' => $allAdmins]);
    //             $this->load->view('templates/footer');
    //         } else {
    //             redirect('super_user/super_user');
    //         }
    //     } else {
    //         $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
    //         redirect('fetch/login');
    //     }
    // }

}
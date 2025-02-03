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

}

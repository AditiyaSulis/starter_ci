<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Fetch extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('M_admin');
    }

    public function login(){
        $id = $this->session->userdata('user');
        if(!$id) {
            $this->load->view('login/index');
        } else {
            $this->session->set_flashdata('authorize', 'Anda sudah login');
            redirect('admin/dashboard/dashboard_page?with_alerts=1');
        }

    }

}

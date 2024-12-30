<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Super_user extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('m_Admin');


    }

}
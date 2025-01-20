<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Account_code_api extends RestController{


    function __construct()
    {
        parent::__construct();
        $this->load->model('m_Account_code');
        validate_header();

    }
  
    public function getAll_get()
    {

        $ac = $this->m_Account_code->findAll_get();

        if($ac){
            $this->response([
                'status' => true, 
                'data' => $ac
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }


}
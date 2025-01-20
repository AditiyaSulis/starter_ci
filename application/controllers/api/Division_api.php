<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Division_api extends RestController{


    function __construct()
    {
        parent::__construct();
        $this->load->model('m_Division');
        validate_header();

    }

    
    public function getAll_get()
    {

        $division = $this->m_Division->findAll_get();

        if($division){
            $this->response([
                'status' => true, 
                'data' => $division
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }


}
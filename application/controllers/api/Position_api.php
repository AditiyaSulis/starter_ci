<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Position_api extends RestController{


    function __construct()
    {
        parent::__construct();
        $this->load->model('m_Position');
        validate_header();

    }
  
    public function getAll_get()
    {

        $position = $this->m_Position->findAll_get();

        if($position){
            $this->response([
                'status' => true, 
                'data' => $position
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }


}
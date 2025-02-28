<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Employee_api extends RestController{


    function __construct()
    {
        parent::__construct();
        $this->load->model('M_employees');
        validate_header();

    }

    
    public function getAll_get()
    {

        $employees = $this->M_employees->findAllJoin_get();

        if($employees){
            $this->response([
                'status' => true, 
                'data' => $employees
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }


}

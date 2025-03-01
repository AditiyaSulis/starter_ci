<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Supplier_api extends RestController {

    function __construct() 
    {
        parent::__construct();
        $this->load->model('M_supplier');
        validate_header();
    }

    public function getAllActive_get()
    {

        $suppliers = $this->M_supplier->findAllIsActive();

        if($suppliers){
            $this->response([
                'status' => true,
                'data' => $suppliers,
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], 404);
        }
    }

    public function getAll_get()
    {
        $suppliers = $this->M_supplier->findAll_get();

        if($suppliers){
            $this->response([
                'status' => true,
                'data' => $suppliers
            ], 200);
        } else {
            $this->response([
                'status'=> false,
                'message' => 'Data not found.'
            ], 404);
        }
    }

}

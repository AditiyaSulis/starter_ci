<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Product_api extends RestController{

    function __construct(){
        parent::__construct();
        $this->load->model('m_Products');


    }

    public function getAll_get(){

        $products = $this->m_Products->findAllShow_get();

        if($products){
            $this->response([
                'status' => true, 
                'products' => $products
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }


}
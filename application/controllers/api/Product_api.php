<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Product_api extends RestController{

    function __construct(){
        parent::__construct();
        $this->load->model('m_Products');


    }

    /* Mengambil semua data product 
       dengan kondisi visibility = true
    */
    public function getAllVisibility_get()
    {

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


    /* Mengambil semua data product 
    */
    public function getAll_get()
    {

        $products = $this->m_Products->findAll_get();

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
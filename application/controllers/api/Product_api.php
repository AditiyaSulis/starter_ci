<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Product_api extends RestController {

    function __construct() 
    {
        parent::__construct();
        $this->load->model('M_products');
        validate_header();
    }

    public function getAllVisibility_get() 
    {
        $products = $this->M_products->findAllShow_get();

        if ($products) {
            $this->response([
                'status' => true, 
                'data' => $products
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    public function getAll_get() 
    {
        $products = $this->M_products->findAll_get();

        if ($products) {
            $this->response([
                'status' => true, 
                'data' => $products
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    public function getById_get($id) 
    {
        $product = $this->M_products->findById_get($id);

        if ($product) {
            $this->response([
                'status' => true,
                'data' => $product
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }
    }
}

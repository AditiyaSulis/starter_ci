<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Company_profile_api extends RestController{


    function __construct()
    {
        parent::__construct();
        $this->load->model('M_setting');
        validate_header();

    }

    /* Mengambil 1 Data Company Profile */
    public function getOne_get()
    {

        $company_profile = $this->M_setting->getCp_get();

        if($company_profile){
            $this->response([
                'status' => true, 
                'data' => $company_profile
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }


}

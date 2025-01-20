<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Company_profile_api extends RestController{

    function __construct(){
        parent::__construct();
        $this->load->model('m_Setting');


    }

    /* Mengambil 1 Data Company Profile */

    public function getOne_get(){

        $company_profile = $this->m_Setting->getCp_get();

        if($company_profile){
            $this->response([
                'status' => true, 
                'company_profile' => $company_profile
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }


}
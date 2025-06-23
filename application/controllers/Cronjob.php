<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjob extends CI_Controller{

    protected $pwd = 'mgrf22s2';

	function __construct()
	{
		parent::__construct();

        $this->load->model('M_cronjob');
	}

    public function sync_kehadiran($pwd = null) {
        if(empty($pwd) || $pwd !== $this->pwd) {
            echo 'Unauthorized';
            exit();
        }

        
         $this->M_cronjob->mark_absent_if_no_checkin();
        
    }

}
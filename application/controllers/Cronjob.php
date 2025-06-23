<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjob extends MY_Controller{

    protected $pwd = 'mgrf22s2';

	function __construct()
	{
		parent::__construct();

        $this->load->model('M_cronjob');
	}

    public function sync_kehadiran($pwd = null) {
        if($pwd = null) {
            echo 'Unauthorized';
            exit();
        }
         
        if($pwd == $this->pwd) {
            $this->M_cronjob->mark_absent_if_no_checkin();
        }
    }

}
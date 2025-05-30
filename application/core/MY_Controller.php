<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	// =========== variable global
	protected $idUSER   = '';
	protected $roleUSER = '';
	protected $arrUSER  = '';


	public function __construct()
	{
		parent::__construct();
		//load segala kebutuhan yang sering digunakan
        $this->load->model('M_admin');
		$id  = $this->session->userdata('user') ;//ambil dari session
		$current = $this->M_admin->findById_get($id) ;// query ke table admin mencari berdasarkan id
		if (!$current) {
			$this->session->set_flashdata('forbidden', 'Silahkan login');
            $this->session->unset_userdata('user');
			redirect('panel'); // lempar ke login dan destroy session
		}

		$this->idUSER   = $current['id'];  //data id hasil query
		$this->roleUSER = $current['role']; //data role hasil query
		$this->arrUSER  = $current;
	}


	public function _ONLY_SU()
	{
		if ($this->roleUSER == 1) {
			return true;
		} else {
			$this->session->unset_userdata('user');
			$this->session->set_flashdata('forbidden', 'Silahkan login');
			redirect('panel'); // lempar ke login dan destroy session
		}
	}


	public function _ONLYSELECTED($arr)
	{
		if (in_array($this->roleUSER, $arr)) {
			return true;
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login');
			$this->session->unset_userdata('user');
			redirect('panel'); // lempar ke login dan destroy session
		}
	}


	public function _isAjax()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
	}


	public function _basicData()
	{
		$data['idUser']     = $this->idUSER;
		$data['user']       = $this->arrUSER;
		$data['role']       = $this->roleUSER;
		$data['info_attendance'] = $this->M_admin->count_info_data_get();
		return $data;
	}


}

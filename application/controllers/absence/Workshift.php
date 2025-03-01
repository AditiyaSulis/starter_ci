<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workshift extends MY_Controller{

	function __construct()
	{
		parent::__construct();

		$this->load->model('M_workshift');
	}


	public function workshift_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Workshift';
		$data['view_name'] = 'absence/data/workshift';
		$data['breadcrumb'] = 'Workshift';
		$data['menu'] = 'Data';


		$data['workshift'] = $this->M_workshift->findAll_get();

		if($data['user']) {
			$this->load->view('templates/index', $data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}


	public function add_workshift()
	{
		$this->_isAjax();
		$this->_ONLY_SU();

		$this->form_validation->set_rules('code_workshift', 'code_workshift', 'required|is_unique[workshift.code_workshift]', [
			'required' => 'Code shift harus diisi',
			'is_unique' => 'Code shift sudah dipakai',
		]);
		$this->form_validation->set_rules('name_workshift', 'name_workshift', 'required|min_length[2]|max_length[80]', [
			'required' => 'Name harus diisi',
			'min_length' => 'Name minimal 2 karakter',
			'max_length' => 'Name maksimal 80 karakter',
		]);
		$this->form_validation->set_rules('clock_in', 'clock_in', 'required', [
			'required' => 'Jam masuk harus diisi',
		]);
		$this->form_validation->set_rules('clock_out', 'clock_out', 'required', [
			'required' => 'Jam keluar harus diisi',
		]);
		$this->form_validation->set_rules('clock_out', 'clock_out', 'required', [
			'required' => 'Jam keluar harus diisi',
		]);
		$this->form_validation->set_rules('description', 'description', 'required|min_length[2]|max_length[80]', [
			'required' => 'Deskripsi harus diisi',
			'min_length' => 'Deskripsi minimal 2 karakter',
			'max_length' => 'Deskripsi maksimal 80 karakter',
		]);

		if ($this->form_validation->run() == FALSE) {
			$response = [
				'status' => false,
				'message' => validation_errors('<p>', '</p>'),
				'confirmationbutton' => true,
				'timer' => 0,
				'icon' => 'error',
			];
			echo json_encode($response);
			return;
		}

		$data = [
			'code_workshift' => $this->input->post('code_workshift', true),
			'name_workshift' => $this->input->post('name_workshift', true),
			'clock_in' => $this->input->post('clock_in', true),
			'clock_out' => $this->input->post('clock_out', true),
			'description' => $this->input->post('description', true),
		];

		$position = $this->M_workshift->create_post($data);

		if ($position) {
			$response = [
				'status' => true,
				'message' => 'Shift berhasil ditambahkan',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Shift gagal ditambahkan',
			];
		}

		echo json_encode($response);
	}


	public function update_workshift()
	{

		$this->_isAjax();
		$this->_ONLY_SU();
		$id = $this->input->post('id_workshift', true);
		if (!$id) {
			$response = [
				'status' => false,
				'message' => 'ID tidak valid',
			];
			echo json_encode($response);
			return;
		}

		$ac = $this->M_workshift->findById_get($id);
		$oldCode = $ac['code_workshift'];

		$this->form_validation->set_rules('name_workshift', 'name_workshift', 'required|min_length[2]|max_length[80]', [
			'required' => 'Name harus diisi',
			'min_length' => 'Name minimal 2 karakter',
			'max_length' => 'Name maksimal 80 karakter',
		]);
		$this->form_validation->set_rules('clock_in', 'clock_in', 'required', [
			'required' => 'Jam masuk harus diisi',
		]);
		$this->form_validation->set_rules('clock_out', 'clock_out', 'required', [
			'required' => 'Jam keluar harus diisi',
		]);
		$this->form_validation->set_rules('clock_out', 'clock_out', 'required', [
			'required' => 'Jam keluar harus diisi',
		]);
		$this->form_validation->set_rules('description', 'description', 'required|min_length[2]|max_length[80]', [
			'required' => 'Deskripsi harus diisi',
			'min_length' => 'Deskripsi minimal 2 karakter',
			'max_length' => 'Deskripsi maksimal 80 karakter',
		]);


		if ($this->form_validation->run() == FALSE) {
			$response = [
				'status' => false,
				'message' => validation_errors('<p>', '</p>'),
				'confirmationbutton' => true,
				'timer' => 0,
				'icon' => 'error',
			];
			echo json_encode($response);
			return;
		}

		$newCode = $this->input->post('code_workshift',true);

		if($oldCode != $newCode){
			$codeExist = $this->M_workshift->findByCodeWorkshift_get($newCode);
			if($codeExist){
				$response = [
					'status' => false,
					'message' => 'Code sudah digunakan'
				];

				echo json_encode($response);

				return;
			}
		}

		$data = [
			'code_workshift' => $this->input->post('code_workshift', true),
			'name_workshift' => $this->input->post('name_workshift', true),
			'clock_in' => $this->input->post('clock_in', true),
			'clock_out' => $this->input->post('clock_out', true),
			'description' => $this->input->post('description', true)
		];

		$workshift = $this->M_workshift->update_post($id, $data);

		if ($workshift) {
			$response = [
				'status' => true,
				'message' => 'Shift berhasil diupdate',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Shift gagal diupdate',
			];
		}

		echo json_encode($response);

	}


	public function delete()
	{
		$this->_isAjax();
		$this->_ONLY_SU();

		$id = $this->input->post('id');

//		if($this->M_workshift->findByWorkshiftId_get($id) ){
//			$response = [
//				'status' => false,
//				'message' => 'Code ini tidak bisa dihapus karena memiliki relasi dengan tabel lain '
//			];
//			echo json_encode($response);
//			return;
//		}


		if($this->M_workshift->delete($id)){
			$response = [
				'status' => true,
				'message' => 'Shift berhasil dihapus',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Shift gagal dihapus',
			];
		}

		echo json_encode($response);

	}

}

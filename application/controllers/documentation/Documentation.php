<?php
class Documentation extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('M_artikel');
	}

	public function index() {

		$this->_ONLYSELECTED([1,2,3]);
		$data = $this->_basicData();

		$data['title'] = 'Documentation';
		$data['view_name'] = 'documentation/documentation';
		$data['breadcrumb'] = 'Documentation';
		$data['menu'] = '';

		$data['artikel'] = $this->M_artikel->get_all_artikels();

		if($data['user']) {
			$this->load->view('templates/documentation', $data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}

	public function add_documentation() {
		$this->_isAjax();
		$this->_ONLY_SU();

		$data = [
			'judul' => $this->input->post('judul'),
			'content' => $this->input->post('content')
		];
		$documentation = $this->M_artikel->create_post($data);

		if ($documentation) {
			$response = [
				'status' => true,
				'message' => 'Dokumentasi berhasil ditambahkan',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Dokumentasi gagal ditambahkan',
			];
		}

		echo json_encode($response);
	}

	public function list_documentation($id) {
		$this->_ONLYSELECTED([1,2,3]);
		$data = $this->_basicData();


		$data['title'] = 'Edit Documentation';
		$data['view_name'] = 'documentation/list_documentation';
		$data['breadcrumb'] = 'Documentation';

		$data['artikel'] = $this->M_artikel->get_all_artikels();
		$data['artikels'] = $this->M_artikel->get_note_by_id($id);

		if($data['user']) {
			$this->load->view('templates/documentation', $data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}

	public function edit($id) {
		$this->_ONLY_SU();
		$data = $this->_basicData();

		$data['title'] = 'Edit Documentation';
		$data['view_name'] = 'documentation/edit_documentation';
		$data['breadcrumb'] = 'Documentation';

		$data['artikels'] = $this->M_artikel->get_note_by_id($id);
		$data['artikel'] = $this->M_artikel->get_all_artikels();

		if($data['user']) {
			$this->load->view('templates/documentation', $data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}

	public function update($id) {
		$this->_ONLY_SU();

		$data = [
			'title' => $this->input->post('title'),
			'content' => $this->input->post('content')
		];
		$this->M_artikel->update_post($id, $data);
		redirect('notes');
	}

	public function delete($id) {
		$this->_ONLY_SU();
		$this->M_artikel->delete_note($id);
		redirect('notes');
	}
}

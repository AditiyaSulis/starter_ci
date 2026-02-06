<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_partner');
		$this->load->library('upload');

	}


	public function partner_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();
		$data['list_partner'] = $this->M_partner->findAllShow_get();

		$data['title'] = 'Partner';
		$data['view_name'] = 'admin/partner';
		$data['breadcrumb'] = 'Partner';
		$data['menu'] = '';
		if($data['user']){
			$this->load->view('templates/index', $data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}


	public function add_partner()
	{
		$this->_ONLYSELECTED([1,2]);
		$this->_isAjax();
		$this->form_validation->set_rules('name', 'Name Partner', 'trim|required|min_length[3]|max_length[90]', [
			'required' => 'Nama harus diisi',
			'min_length' => 'Nama minimal harus mempunyai 3 huruf',
			'max_length' => 'Nama tidak boleh melebihi 90 karakter',
		]);
		$this->form_validation->set_rules('description', 'Description', 'trim|required', [
			'required' => 'Deskripsi harus diisi'
		]);
		$this->form_validation->set_rules('url', 'url', 'max_length[120]', [
			'max_length' => 'Url maksimal 120 character',
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

		$url = $this->input->post('url', true);
		if($url == '' || empty($url)) {
			$url = null;
		}

		$this->load->helper('image_helper');

		$upload_path = 'partner/';
		$resize_width = 500;
		$resize_height = 500;
		$resize_quality = 60;

		$upload_result = upload_and_resize('logo', $upload_path, $resize_width, $resize_height, $resize_quality);

		if (!$upload_result['status']) {
			$response = [
				'status' => false,
				'message' => $upload_result['message'],
			];
			echo json_encode($response);
			return;
		}

		$logo_name = $upload_result['message'];

		$data = [
			'name_partner' => $this->input->post('name', true),
			'description' => $this->input->post('description', true),
			'url' => $url,
			'image_partner' => $logo_name,
		];

		$partner = $this->M_partner->create_post($data);

		if ($partner) {
			$response = [
				'status' => true,
				'message' => 'Partner berhasil ditambahkan',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Partner gagal ditambahkan',
			];
		}

		echo json_encode($response);
	}


	public function update()
	{
		$this->_ONLYSELECTED([1,2]);
		$this->_isAjax();

		$this->form_validation->set_rules('name', 'Partner Name', 'trim|required|min_length[3]|max_length[90]', [
			'required' => 'Nama harus diisi',
			'min_length' => 'Nama minimal harus mempunyai 3 huruf',
			'max_length' => 'Nama tidak boleh melebihi 90 karakter',
		]);
		$this->form_validation->set_rules('description', 'Description', 'trim|required', [
			'required' => 'Deskripsi harus diisi',
		]);
		$this->form_validation->set_rules('url', 'url', 'max_length[120]', [
			'max_length' => 'Url maksimal 120 character',
		]);

		if ($this->form_validation->run() === FALSE) {
			$response = [
				'status' => false,
				'message' => validation_errors('<p>', '</p>')
			];
			echo json_encode($response);
			return;
		} 

        $id = $this->input->post('id_partner', true);
		$name = $this->input->post('name', true);
		$description = $this->input->post('description', true);
		$url = $this->input->post('url', true);


		if($url == '' || empty($url)) {
			$url = null;
		}

		if (empty($_FILES['logo']['name'])) {
			$data = [
				'name_partner' => $name,
				'description' => $description,
				'url' => $url,
			];

			if ($this->M_partner->update_post($id, $data)) {
				$response = [
					'status' => true,
					'message' => 'Partner berhasil diperbarui.'
				];
			} else {
				$response = [
					'status' => false,
					'message' => 'Gagal memperbarui partner.'
				];
			}
			echo json_encode($response);
			return;
		}

		$partner = $this->M_partner->findById_get($id);
		if ($partner && !empty($partner['image_partner'])) {
			$old_logo_path = './uploads/partner/' . $partner['image_partner'];
			if (file_exists($old_logo_path)) {
				unlink($old_logo_path);
			}

			$this->load->helper('image_helper');
			$upload_path = 'partner/';
			$resize_width = 500;
			$resize_height = 500;
			$resize_quality = 60;

			$upload_result = upload_and_resize('logo', $upload_path, $resize_width, $resize_height, $resize_quality);

			if (!$upload_result['status']) {
				$response = [
					'status' => false,
					'message' => $upload_result['message'],
				];
				echo json_encode($response);
				return;
			}

			$logo_name = $upload_result['message'];
			$data = [
				'name_partner' => $name,
				'description' => $description,
				'url' => $url,
				'image_partner' => $logo_name
			];

			if ($this->M_partner->update_post($id, $data)) {
				$response = [
					'status' => true,
					'message' => 'Partner berhasil diperbarui.'
				];
			} else {
				$response = [
					'status' => false,
					'message' => 'Gagal memperbarui Partner.'
				];
			}

			echo json_encode($response);
			return;

		}
	}


	public function delete()
	{
		$this->_ONLYSELECTED([1,2]);
		$this->_isAjax();

		$id = $this->input->post('id_partner');


		$partner = $this->M_partner->findById_get($id);

		if ($partner) {

			if (isset($partner['image_partner']) && !empty($partner['image_partner'])) {
				$imagePath = './uploads/partner/' . $partner['image_partner'];
				if (file_exists($imagePath)) {
					unlink($imagePath);
				}

			}

		}

		if($this->M_partner->delete($id)){
			$response = [
				'status' => true,
				'message' => 'Partner berhasil dihapus',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Partner gagal dihapus',
			];
		}

		echo json_encode($response);

	}




}

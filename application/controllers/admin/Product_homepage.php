<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_homepage extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_product_homepage');
		$this->load->library('upload');

	}


	public function product_homepage_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();
		$data['products'] = $this->M_product_homepage->findAll_get();

		$data['title'] = 'Product Homepage';
		$data['view_name'] = 'admin/product_homepage';
		$data['breadcrumb'] = 'Product Homepage';
		$data['menu'] = '';
		if($data['user']){
			$this->load->view('templates/index', $data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}


	public function add_products()
	{
		$this->_ONLYSELECTED([1,2]);
		$this->_isAjax();
		$this->form_validation->set_rules('name', 'Name_product', 'trim|required|min_length[3]|max_length[50]', [
			'required' => 'Nama harus diisi',
			'min_length' => 'Nama minimal harus mempunyai 3 huruf',
			'max_length' => 'Nama tidak boleh melebihi 50 karakter',
		]);
		$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[4]|max_length[50]', [
			'required' => 'Deskripsi harus diisi',
			'min_length' => 'Deskripsi minimal 4 huruf',
			'max_length' => 'Deskripsi maksimal 50 character',
		]);
		$this->form_validation->set_rules('url', 'url', 'max_length[150]', [
			'max_length' => 'Url maksimal 150 character',
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

		$upload_path = 'product_homepage/';
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
			'name' => $this->input->post('name', true),
			'description' => $this->input->post('description', true),
			'url' => $url,
			'logo' => $logo_name,
		];

		$product = $this->M_product_homepage->create_post($data);

		if ($product) {
			$response = [
				'status' => true,
				'message' => 'Product Homepage berhasil ditambahkan',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Product Homepage gagal ditambahkan',
			];
		}

		echo json_encode($response);
	}


	public function update()
	{
		$this->_ONLYSELECTED([1,2]);
		$this->_isAjax();

		$id = $this->input->post('id_product_homepage', true);
		$name = $this->input->post('name', true);
		$description = $this->input->post('description', true);
		$url = $this->input->post('url', true);

		$this->form_validation->set_rules('name', 'Product Name', 'trim|required|min_length[3]|max_length[50]', [
			'required' => 'Nama harus diisi',
			'min_length' => 'Nama minimal harus mempunyai 3 huruf',
			'max_length' => 'Nama tidak boleh melebihi 40 karakter',
		]);
		$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[4]|max_length[50]', [
			'required' => 'Deskripsi harus diisi',
			'min_length' => 'Deskripsi minimal 4 huruf',
			'max_length' => 'Deskripsi maksimal 50 character',
		]);
		$this->form_validation->set_rules('url', 'url', 'max_length[150]', [
			'max_length' => 'Url maksimal 150 character',
		]);

		if ($this->form_validation->run() === FALSE) {
			$response = [
				'status' => false,
				'message' => validation_errors('<p>', '</p>')
			];
			echo json_encode($response);
			return;
		}


		if($url == '' || empty($url)) {
			$url = null;
		}

		if (empty($_FILES['logo']['name'])) {
			$data = [
				'name' => $name,
				'description' => $description,
				'url' => $url,
			];

			if ($this->M_product_homepage->update_post($id, $data)) {
				$response = [
					'status' => true,
					'message' => 'Product berhasil diperbarui.'
				];
			} else {
				$response = [
					'status' => false,
					'message' => 'Gagal memperbarui product.'
				];
			}
			echo json_encode($response);
			return;
		}

		$product = $this->M_product_homepage->findById_get($id);
		if ($product && !empty($product['logo'])) {
			$old_logo_path = './uploads/product_homepage/' . $product['logo'];
			if (file_exists($old_logo_path)) {
				unlink($old_logo_path);
			}

			$this->load->helper('image_helper');
			$upload_path = 'product_homepage/';
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
				'name' => $name,
				'description' => $description,
				'url' => $url,
				'logo' => $logo_name
			];

			if ($this->M_product_homepage->update_post($id, $data)) {
				$response = [
					'status' => true,
					'message' => 'Product berhasil diperbarui.'
				];
			} else {
				$response = [
					'status' => false,
					'message' => 'Gagal memperbarui product.'
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

		$id = $this->input->post('id_product_homepage');


		$product = $this->M_product_homepage->findById_get($id);

		if ($product) {

			if (isset($product['logo']) && !empty($product['logo'])) {
				$imagePath = './uploads/product_homepage/' . $product['logo'];
				if (file_exists($imagePath)) {
					unlink($imagePath);
				}

			}

		}

		if($this->M_product_homepage->delete($id)){
			$response = [
				'status' => true,
				'message' => 'Product berhasil dihapus',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Product gagal dihapus',
			];
		}

		echo json_encode($response);

	}




}

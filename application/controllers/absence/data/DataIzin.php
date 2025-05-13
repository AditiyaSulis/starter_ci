<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataIzin extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_izin');
		$this->load->model('M_employees');
		$this->load->model('M_schedule');
		$this->load->model('M_products');
	}

	public function data_izin_page()
	{
		$this->_ONLYSELECTED([1,2,4]);
		$data = $this->_basicData();


		$data['title'] = 'Data Izin';
		$data['view_name'] = 'absence/data/izin';
		$data['breadcrumb'] = 'Data - Izin';
		$data['menu'] = 'Data';

		$data['products'] = $this->M_products->findAll_get();
		$data['employee'] = 'false';
		$data['employees'] = $this->M_employees->findAll_get();

		$data['this_month'] = $this->M_izin->totalIzinThisMonthByEmployeeId_get(null);
		$data['this_year'] = $this->M_izin->totalIzinByEmployeeId_get(null);

		$data['view_data'] = 'core/izin/data_izin';
		$data['view_components'] = 'core/izin/data_izin_components';

		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}

	public function emp_data_izin_page()
	{
		$this->_ONLYSELECTED([3]);
		$data = $this->_basicData();

		$data['title'] = 'Izin';
		$data['view_name'] = 'absence/izin';
		$data['breadcrumb'] = 'Izin';
		$data['menu'] = '';

		$id = $this->M_employees->findByEmail_get($data['user']['email']);
		$data['products'] = $this->M_products->findAll_get();
		$data['employee'] = $id['id_employee'];
		$data['employees'] = $this->M_employees->findAll_get();
		$data['total_izin'] = $this->M_izin->totalIzinByEmployeeId_get($id['id_employee']);
		$data['total_izin_this_month'] = $this->M_izin->totalIzinThisMonthByEmployeeId_get($id['id_employee']);


		$data['view_data'] = 'core/izin/data_izin';
		$data['view_components'] = 'core/izin/data_izin_components';

		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}

	public function add_izin()
	{
		$this->_ONLYSELECTED([1, 2, 3, 4]);
		$this->_isAjax();
		$this->form_validation->set_rules('alasan_izin', 'alasan_izin', 'required', [
			'required' => 'Alasan Izin harus diisi',
		]);
		$this->form_validation->set_rules('tanggal_izin', 'tanggal_izin', 'required', [
			'required' => 'Tanggal Izin harus diisi',
		]);

		$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[4]', [
			'required' => 'Deskripsi harus diisi',
			'min_length' => 'Deskripsi minimal 4 huruf',
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

		$surat_sakit = '-';
		$alasan_izin = $this->input->post('alasan_izin');
		$email = $this->input->post('id_employee');
		$id = $this->M_employees->findByEmail_get($email);

		if (!$id) {
			$response = [
				'status' => false,
				'message' => 'Data tidak ditemukan',
			];
			echo json_encode($response);
			return;
		}


		if (isset($_FILES['bukti_surat_sakit']) && $_FILES['bukti_surat_sakit']['error'] != 4) {
			$this->load->helper('image_helper');

			$upload_path = 'bukti/compressed';
			$resize_width = 500;
			$resize_height = 500;
			$resize_quality = 60;

			$upload_result = upload_and_resize('bukti_surat_sakit', $upload_path, $resize_width, $resize_height, $resize_quality);

			if (!$upload_result['status']) {
				$response = [
					'status' => false,
					'message' => $upload_result['message'],
				];
				echo json_encode($response);
				return;
			}

			$surat_sakit = $upload_result['message'];
		}

		$type_day = $this->input->post('type_day', true);

		if ($type_day == '1') {
			$data = [
				'input_at' => $this->input->post('input_at', true),
				'id_employee' => $id['id_employee'],
				'description' => $this->input->post('description', true),
				'alasan_izin' => $this->input->post('alasan_izin', true),
				'tanggal_izin' => $this->input->post('tanggal_izin', true),
				'type_day' => $type_day,
				'end_date' => null,
				'bukti_surat_sakit' => $surat_sakit,
			];
		} else {
			$data = [
				'input_at' => $this->input->post('input_at', true),
				'id_employee' => $id['id_employee'],
				'description' => $this->input->post('description', true),
				'alasan_izin' => $this->input->post('alasan_izin', true),
				'tanggal_izin' => $this->input->post('tanggal_izin', true),
				'type_day' => $type_day,
				'end_date' => $this->input->post('end_date', true),
				'bukti_surat_sakit' => $surat_sakit,
			];
		}


		$product = $this->M_izin->create_post($data);

		if ($product) {
			$response = [
				'status' => true,
				'message' => 'Izin berhasil dibuat',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Izin gagal ditambahkan',
			];
		}

		echo json_encode($response);
	}

	public function set_status()
	{
		$this->_ONLYSELECTED([1,2,4]);
		$this->_isAjax();

		$id = $this->input->post('id_izin', true);
		$idEmployee = $this->input->post('id_employee', true);
		$tanggal = $this->input->post('tanggal_izin', true);
		$end_date = $this->input->post('end_date', true);


		$this->form_validation->set_rules('status', 'status', 'required', [
			'required' => 'Status harus diisi',
		]);

		if ($this->form_validation->run() == false) {
			$response = [
				'status' => false,
				'message' => validation_errors('<p>', '</p>'),
				'confirmationbutton' => true,
				'timer' => 0,
				'icon' => 'error'
			];

			echo json_encode($response);

			return;
		}

		$setstatus = $this->input->post('status', true);

		if($setstatus == 2) {
			$setStatus1 = $this->M_schedule->setStatusFromIzin_post($idEmployee, $tanggal, $end_date, 5);
		} else {
			$setStatus1 = $this->M_schedule->unsetStatusFromIzin_post($idEmployee, $tanggal,  $end_date);
		}

		if(!$setStatus1) {
			$response = [
				'status' => false,
				'message' => 'Gagal memperbarui status dan mengubah jadwal.'
			];

			echo $response;
			return;
		}
		if ($this->M_izin->setStatus_post($id, $setstatus)) {
			$response = [
				'status' => true,
				'message' => 'Status berhasil diperbarui.'
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Gagal memperbarui Status.'
			];
		}

		echo json_encode($response);


	}

	public function delete()
	{
		$this->_ONLYSELECTED([1,2,4]);
		$this->_isAjax();

		$id = $this->input->post('id');

		$dataIzin = $this->M_izin->findById_get($id);

		if(!empty($dataIzin)){
			if (isset($dataIzin['bukti_surat_sakit']) && !empty($dataIzin['bukti_surat_sakit'])) {
				$imagePath = './uploads/bukti/compressed/' . $dataIzin['bukti_surat_sakit'];
				if (file_exists($imagePath)) {
					unlink($imagePath);
				}

			}
		}


		if($this->M_izin->delete($id)){
			$this->M_schedule->setStatus_post($dataIzin['id_employee'], $dataIzin['tanggal_izin'], 1);

			$response = [
				'status' => true,
				'message' => 'Data izin karyawan berhasil dihapus',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Data izin karyawan gagal dihapus',
			];
		}

		echo json_encode($response);

	}

	public function update_bukti()
	{
		$this->_ONLYSELECTED([1,2,3,4]);
		$this->_isAjax();

		$id = $this->input->post('id_izin', true);

		$izin = $this->M_izin->findById_get($id);

		if ($izin && !empty($izin['bukti_surat_sakit'])) {
			$old_logo_path = './uploads/bukti/compressed/' . $izin['bukti_surat_sakit'];
			if (file_exists($old_logo_path)) {
				unlink($old_logo_path);
			}

			$this->load->helper('image_helper');
			$upload_path = 'bukti/compressed';
			$resize_width = 500;
			$resize_height = 500;
			$resize_quality = 60;

			$upload_result = upload_and_resize('bukti_surat_sakit', $upload_path, $resize_width, $resize_height, $resize_quality);

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
				'bukti_surat_sakit' => $logo_name
			];

			if ($this->M_izin->update_post($id, $data)) {
				$response = [
					'status' => true,
					'message' => 'Bukti berhasil diperbarui.'
				];
			} else {
				$response = [
					'status' => false,
					'message' => 'Bukti memperbarui product.'
				];
			}

			echo json_encode($response);
			return;
		}

	}


}

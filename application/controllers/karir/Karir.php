<?php
class Karir extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('M_karir');
		$this->load->model('M_products');

	}


	public function carrier_page()
	{
		$this->_ONLYSELECTED([1, 2]);
		$data = $this->_basicData();

		$data['title'] = 'Carrier';
		$data['view_name'] = 'karir/karir';
		$data['breadcrumb'] = 'Carrier';
		$data['menu'] = '';

		$data['product'] = $this->M_products->findAll_get();


		if (isset($data['user']) && $data['user']) {
			$this->load->view('templates/index', $data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('login');
		}
	}

	public function add_karir()
	{
		$this->_ONLYSELECTED([1, 2]);
		$this->_isAjax();

		$this->form_validation->set_rules('id_product', 'id_poduct', 'required', [
			'required' => 'Product harus diisi',
		]);
		$this->form_validation->set_rules('posisi', 'posisi', 'required', [
			'required' => 'posisi tidak boleh kosong',
		]);
		$this->form_validation->set_rules('lokasi_penempatan', 'lokasi_penempatan', 'required', [
			'required' => 'Lokasi Penempatan harus diisi',
		]);
		$this->form_validation->set_rules('mulai_posting', 'mulai_posting', 'required', [
			'required' => 'Tanggal Mulai posting harus diisi',
		]);
		$this->form_validation->set_rules('akhir_posting', 'akhir_posting', 'required', [
			'required' => 'Tanggal akhir posting harus diisi',
		]);
		$this->form_validation->set_rules('whatsapp', 'whatsapp', 'required', [
			'required' => 'Whatsapp harus diisi',
		]);
		$this->form_validation->set_rules('email', 'email', 'required|valid_email', [
			'required' => 'Whatsapp harus diisi',
			'valid_email' => 'Email tidak valid',
		]);
		$this->form_validation->set_rules('kualifikasi', 'kualifikasi', 'required', [
			'required' => 'Kualifikasi harus diisi',
		]);
		$this->form_validation->set_rules('benefit', 'benefit', 'required', [
			'required' => 'Benefit harus diisi',
		]);
		$this->form_validation->set_rules('jam_kerja', 'jam_kerja', 'required', [
			'required' => 'Jam kerja harus diisi',
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

		$gaji = $this->input->post('gaji');

		if($gaji == '' || empty($gaji)){
			$gaji = null;
		}

		$data = [
			'id_product' => $this->input->post('id_product', true),
			'posisi' => $this->input->post('posisi', true),
			'lokasi_penempatan' => $this->input->post('lokasi_penempatan', true),
			'mulai_posting' => $this->input->post('mulai_posting', true),
			'akhir_posting' => $this->input->post('akhir_posting', true),
			'whatsapp' => $this->input->post('whatsapp', true),
			'email' => $this->input->post('email', true),
			'kualifikasi' => $this->input->post('kualifikasi', true),
			'benefit' => $this->input->post('benefit', true),
			'gaji' => $this->input->post('gaji', true),
			'jam_kerja' => $this->input->post('jam_kerja', true),
		];

		$karir = $this->M_karir->create_post($data);

		if ($karir) {
			$response = [
				'status' => true,
				'message' => 'Karir berhasil ditambahkan',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Karir gagal ditambahkan',
			];
		}

		echo json_encode($response);
	}


	public function update()
	{

		$this->_ONLYSELECTED([1, 2]);
		$this->_isAjax();


		$this->form_validation->set_rules('id_product', 'id_product', 'required', [
			'required' => 'Product harus diisi',
		]);

		$this->form_validation->set_rules('posisi', 'posisi', 'required', [
			'required' => 'posisi tidak boleh kosong',
		]);
		$this->form_validation->set_rules('lokasi_penempatan', 'lokasi_penempatan', 'required', [
			'required' => 'Lokasi Penempatan harus diisi',
		]);
		$this->form_validation->set_rules('mulai_posting', 'mulai_posting', 'required', [
			'required' => 'Tanggal Mulai posting harus diisi',
		]);
		$this->form_validation->set_rules('akhir_posting', 'akhir_posting', 'required', [
			'required' => 'Tanggal akhir posting harus diisi',
		]);
		$this->form_validation->set_rules('whatsapp', 'whatsapp', 'required', [
			'required' => 'Whatsapp harus diisi',
		]);
		$this->form_validation->set_rules('email', 'email', 'required|valid_email', [
			'required' => 'Whatsapp harus diisi',
			'valid_email' => 'Email tidak valid',
		]);
		$this->form_validation->set_rules('kualifikasi', 'kualifikasi', 'required', [
			'required' => 'Kualifikasi harus diisi',
		]);
		$this->form_validation->set_rules('benefit', 'benefit', 'required', [
			'required' => 'Benefit harus diisi',
		]);
		$this->form_validation->set_rules('jam_kerja', 'jam_kerja', 'required', [
			'required' => 'Jam kerja harus diisi',
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

		$gaji = $this->input->post('gaji');
		$id = $this->input->post('id_karir');

		if($gaji == '' || empty($gaji)){
			$gaji = null;
		}


		$data = [
			'id_product' => $this->input->post('id_product', true),
			'posisi' => $this->input->post('posisi', true),
			'lokasi_penempatan' => $this->input->post('lokasi_penempatan', true),
			'mulai_posting' => $this->input->post('mulai_posting', true),
			'akhir_posting' => $this->input->post('akhir_posting', true),
			'whatsapp' => $this->input->post('whatsapp', true),
			'email' => $this->input->post('email', true),
			'kualifikasi' => $this->input->post('kualifikasi', true),
			'benefit' => $this->input->post('benefit', true),
			'gaji' => $this->input->post('gaji', true),
			'jam_kerja' => $this->input->post('jam_kerja', true),
		];

		$karir = $this->M_karir->update_post($id, $data);

		if ($karir) {
			$response = [
				'status' => true,
				'message' => 'Data Karir berhasil diupdate',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Data Karir gagal diupdate',
			];
		}

		echo json_encode($response);

	}


	public function delete()
	{
		$this->_ONLYSELECTED([1, 2]);
		$this->_isAjax();

		$id = $this->input->post('id');


		if($this->M_karir->delete($id)){
			$response = [
				'status' => true,
				'message' => 'Data Karir berhasil dihapus',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Data Karir gagal dihapus',
			];
		}

		echo json_encode($response);

	}


	public function dtSideserver()
	{
		$option = $this->input->post('option');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');
		$product = $this->input->post('product');

		$list = $this->M_karir->get_datatables($option, $startDate, $endDate, $product);
		$data = array();
		$no = @$_POST['start'];

		foreach ($list as $item) {
			$action = '
                        <div class="no-print">
                            <a href="javascript:void(0)" onclick="editKarirBtn(this)" class="btn gradient-btn-edit btn-sm btn-sm mb-2 rounded-pill" style="width : 70px" 
                                data-id_karir="' . htmlspecialchars($item->id_karir) . '"
                                data-id_product="' . htmlspecialchars($item->id_product) . '"
                                data-posisi="' . htmlspecialchars($item->posisi) . '"
                                data-lokasi_penempatan="' . htmlspecialchars($item->lokasi_penempatan) . '"
                                data-mulai_posting="' . htmlspecialchars($item->mulai_posting) . '"
                                data-akhir_posting="' . htmlspecialchars($item->akhir_posting) . '"
                                data-whatsapp="' . htmlspecialchars($item->whatsapp) . '"
                                data-email="' . htmlspecialchars($item->email) . '"
                                data-kualifikasi="' . htmlspecialchars($item->kualifikasi) . '"
                                data-benefit="' . htmlspecialchars($item->benefit) . '"
                                data-gaji="' . htmlspecialchars($item->gaji) . '"
                                data-jam_kerja="' . htmlspecialchars($item->jam_kerja) . '">
                                EDIT
                            </a>

                            <button 
                                class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-karir" style="width : 70px"
                                onClick="handleDeleteKarirButton(' . htmlspecialchars($item->id_karir) . ')">
                                DELETE
                            </button>
                        </div>
                    ';
			$row = array();
			$row[] = $item->mulai_posting;
			$row[] = $item->akhir_posting;
			$row[] = $item->name_product;
			$row[] = $item->posisi;
			$row[] = $item->lokasi_penempatan;
			$row[] = $item->gaji;
			$row[] = substr($item->kualifikasi,0, 15).'. . .';
			$row[] = substr($item->benefit, 0,15).'. . .';
			$row[] = $item->jam_kerja;
			$row[] = $item->whatsapp;
			$row[] = $item->email;
			$row[] = $action;

			$data[] = $row;
		}

		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_karir->count_all(),
			"recordsFiltered" => $this->M_karir->count_filtered($option, $startDate, $endDate, $product),
			"data" => $data,
		);

		echo json_encode($output);
	}



}

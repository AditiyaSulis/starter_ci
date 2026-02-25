<?php
class Pengaduan extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('M_pengaduan');

	}


	public function index()
	{
		$this->_ONLYSELECTED([3]);
		$data = $this->_basicData();
		$data['title'] = 'Pengaduan';
		$data['view_name'] = 'pengaduan/pengaduan';
		$data['breadcrumb'] = 'Pengaduan';
		$data['menu'] = '';

		if($data['user']){
			$this->load->view('templates/index', $data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}

	public function add_pengaduan()
	{
		$this->_ONLYSELECTED([3]);

		$this->form_validation->set_rules('title_pengaduan', 'Judul Pengaduan', 'trim|required|min_length[3]|max_length[70]', [
			'required' => 'Judul Pengaduan harus diisi',
			'min_length' => 'Judul Pengaduan minimal harus mempunyai 3 huruf',
			'max_length' => 'Judul Pengaduan tidak boleh melebihi 70 karakter',
		]);
		$this->form_validation->set_rules('text_pengaduan', 'Text Pengaduan', 'trim|required|min_length[4]', [
			'required' => 'Isi Pengaduan harus diisi',
			'min_length' => 'Isi Pengaduan minimal 4 huruf',
		]); 

		$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required', [
			'required' => 'Kategori harus diisi',
		]);

		$kategori = $this->input->post('kategori');
		if ($kategori === 'lainnya') {
			$kategori = $this->input->post('kategori_lainnya');
			if (empty($kategori)) {
				$this->form_validation->set_rules('kategori_lainnya', 'Kategori Lainnya', 'trim|required|min_length[4]', [
					'required' => 'Kategori lainnya harus diisi',
					'min_length' => 'Kategori lainnya minimal 4 huruf',
				]);
			}
		}

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

		$imagePengaduan = null;
		$imgInput = $this->input->post('logo');
		if (!empty($_FILES['logo']['name'])) {

			$this->load->helper('image_helper');

			$upload_path = 'pengaduan/';
			$resize_width = 500;
			$resize_height = 500;
			$resize_quality = 40;

			$upload_result = upload_and_resize('logo', $upload_path, $resize_width, $resize_height, $resize_quality);

			if (!$upload_result['status']) {
				$response = [
					'status' => false,
					'message' => $upload_result['message'],
				];
				echo json_encode($response);
				return;
			}

			$imagePengaduan = $upload_result['message'];
		}

		$dataInsert = [
			'title_pengaduan' => $this->input->post('title_pengaduan', true),
			'text_pengaduan' => $this->input->post('text_pengaduan', true),
			'created_at' => date('Y-m-d'),
			'kode_pengaduan' => $this->randomText(),
			'image_pengaduan' => $imagePengaduan,
			'kategori' => $kategori,
		];

		$pengaduanInsert = $this->M_pengaduan->create_post($dataInsert);

		if ($pengaduanInsert) {
			$response = [
				'status' => true,
				'message' => 'Pesan Pengaduan berhasil ditambahkan',
				'kode_pengaduan' => $dataInsert['kode_pengaduan']
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Pesan Pengaduan gagal ditambahkan',
			];
		}

		echo json_encode($response); 
	}

	public function test(){
		$this->load->view('pengaduan/sample');
	}
	
	private function randomText($length = 10) {
		$characters = '123456789ABCDEFGHJKLMNPQRSTUVWXYZ';
		$randomString = '';

		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}

		return $randomString;
	} 

	public function search_by_kode()
	{
		$kode = $this->input->post('kode');
		if (!$kode) {
			echo json_encode(['status' => false, 'message' => 'Kode tidak boleh kosong']);
			return;
		}

		$this->load->model('M_pengaduan');
		$data = $this->M_pengaduan->get_by_kode($kode);

		if ($data) {
			// Siapkan data yang akan dikembalikan
			$result = [
				'found' => true,
				'data' => [
					'id' => $data->id_pengaduan,
					'kode' => $data->kode_pengaduan,
					'kategori' => $data->kategori,
					'judul' => $data->title_pengaduan,
					'tanggal' => date('d-m-Y', strtotime($data->created_at)),
					'status' => $data->status_pengaduan,
					'pesan' => substr($data->text_pengaduan, 0, 100) . '...' // cuplikan
				]
			];
			echo json_encode($result);
		} else {
			echo json_encode(['found' => false]);
		}
	}


}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
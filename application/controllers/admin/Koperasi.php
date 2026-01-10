<?php
class Koperasi extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_products');
		$this->load->model('M_koperasi');
		$this->load->model('M_purchase_koperasi');
		$this->load->model('M_saldo_koperasi');
		$this->load->model('M_employees');
	}

	public function koperasi_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Koperasi';
		$data['view_name'] = 'admin/koperasi';
		$data['breadcrumb'] = 'Koperasi';
		$data['menu'] = '';

		$data['saldo_pinjaman'] = $this->M_saldo_koperasi->saldo_get(1);
		$data['saldo_kasbon'] = $this->M_saldo_koperasi->saldo_get(2);
		$data['products'] = $this->M_products->findAllShow_get();
		$data['koperasi'] = $this->M_koperasi->findAllJoin_get();
		$data['data_karyawan'] = $this->M_employees->findForOption_get();

		$data['view_data'] = 'core/koperasi/data_koperasi';
		$data['view_components'] = 'core/koperasi/data_koperasi_components';


		if($data['user']){
			$this->load->view('templates/index',$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
		}

	}

	public function koperasi_paid_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Koperasi';
		$data['view_name'] = 'admin/koperasi_paid_page';
		$data['breadcrumb'] = 'Koperasi';
		$data['menu'] = '';

		$data['saldo_pinjaman'] = $this->M_saldo_koperasi->saldo_get(1);
		$data['saldo_kasbon'] = $this->M_saldo_koperasi->saldo_get(2);
		$data['koperasi'] = $this->M_koperasi->findAllJoin_get();

		$data['view_data'] = 'core/koperasi/data_koperasi';
		$data['view_components'] = 'core/koperasi/data_koperasi_components';


		if($data['user']){
			$this->load->view('templates/index',$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
		}

	}

	public function add_koperasi()
	{
		$this->_ONLYSELECTED([1,2]);
		$this->_isAjax();

		$this->form_validation->set_rules('id_employee', 'Karyawan', 'required', [
			'required' => 'Karyawan harus diisi',
		]);
		$this->form_validation->set_rules('amount_koperasi', 'amount_koperasi', 'required', [
			'required' => 'Amount harus diisi',
		]);
		$this->form_validation->set_rules('type_tenor', 'Type Tenor', 'required', [
			'required' => 'Type Tenor',
		]);
		$this->form_validation->set_rules('angsuran', 'angsuran', 'required', [
			'required' => 'Type harus diisi',
		]);
		$this->form_validation->set_rules('tgl_jatuh_tempo', 'tgl_jatuh_tempo', 'required', [
			'required' => 'Jatuh tempo harus diisi',
		]);
		$this->form_validation->set_rules('description', 'description', 'required|min_length[4]|max_length[100]', [
			'required' => 'Deskripsi harus diisi',
			'min_length' => 'Deskripsi minimal 4 karakter',
			'max_length' => 'Deskripsi maksimal 100 karakter',
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

		$amount_koperasi = $this->input->post('amount_koperasi',true);
		$type_tenor = $this->input->post('type_tenor');
		$type_koperasi = 1;
		$satuan = $this->input->post('tenor_koperasi',true);
		$angsuran = $this->input->post('angsuran',true);

		$tgl_lunas = $this->input->post('tgl_lunas',true);

		if($type_koperasi == 1) {
			//Jika pengeluaran lebih besar dari saldo maka input gagal
			$saldo = $this->M_saldo_koperasi->saldo_get(1);
			if($amount_koperasi > $saldo) {
				$response = [
					'status' => false,
					'message' => 'Pinjaman tidak boleh melebihi saldo',
				];

				echo json_encode($response);
				return;
			}
			//End
		}


		//validasi berdasarkan type tenor
		if($type_tenor == 1){

			if($satuan > 30) {
				$response = [
					'status' => false,
					'message' => 'Jika type harian maka satuan tidak boleh melebihi 30.',
				];

				echo json_encode($response);

				return;
			}
		}

		//validasi angsuran tidak boleh melebihi amount
		if($angsuran > $amount_koperasi){

			$response = [
				'status' => false,
				'message' => 'Angsuran tidak boleh melebihi amount.',
			];

			echo json_encode($response);
			return;

		}


		if($this->input->post('jatuh_tempo',true) > 31) {
			$response = [
				'status' => false,
				'message' => 'Jatuh tempo tidak lebih dari tanggal 31',
			];
			echo json_encode($response);
			return;
		}

		$data = [
			'id_product' => null,
			'id_employee' => $this->input->post('id_employee', true),
			'type_koperasi' => 1,
			'tenor_koperasi' => $satuan,
			'amount_koperasi' => $this->input->post('amount_koperasi', true),
			'remaining' => $this->input->post('amount_koperasi', true),
			'description' => $this->input->post('description', true),
			'koperasi_date' => $this->input->post('koperasi_date', true),
			'status' => 2,
			'tgl_lunas' => $tgl_lunas,
			'type_tenor' => $type_tenor,
			'angsuran' => $angsuran,
			'tgl_jatuh_tempo' => $this->input->post('tgl_jatuh_tempo', true),
		];



		$this->db->trans_start();
		$idPiutang = $this->M_koperasi->create_post($data);
		$dataSaldo = [
			'id_koperasi' => $idPiutang,
			'nominal' => $data['amount_koperasi'],
			'type_saldo' => $type_koperasi,
			'status' => 3,
		];


		$kurang_Saldo = $this->M_saldo_koperasi->create_post($dataSaldo);


		$this->db->trans_complete();


		if ($this->db->trans_status() === FALSE) {
			echo json_encode([
				'status' => false,
				'message' => 'Gagal menginput piutang.',
			]);
		} else {
			echo json_encode([
				'status' => true,
				'message' => 'Piutang berhasil dibuat',
			]);
		}
	}

	public function pay_logs()
	{

		$id = $this->input->post('id_koperasi');


		if (!$id) {
			echo json_encode([
				'status' => false,
				'message' => 'ID tidak valid.',
			]);
			return;
		}

		$logs = $this->M_purchase_koperasi->findByPiutangId_get($id);


		echo json_encode([
			'status' => true,
			'id' => $id,
			'logs' => $logs,
		]);
	}

	public function add_pay()
	{
		$this->_isAjax();
		$this->_ONLYSELECTED([1,2]);


		$this->form_validation->set_rules('id_koperasi', 'id_koperasi', 'required', [
			'required' => 'ID Purchase harus diisi',
		]);

		$this->form_validation->set_rules('pay_amount', 'pay_amount', 'required', [
			'required' => 'Amount harus diisi',
		]);

		$this->form_validation->set_rules('description', 'description', 'required', [
			'required' => 'Deskripsi harus diisi',
		]);

		$this->form_validation->set_rules('pay_date', 'pay_date', 'required', [
			'required' => 'Tanggal pembayaran harus diisi',
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

		$id_koperasi = $this->input->post('id_koperasi', true);
		$amount = $this->input->post('pay_amount', true);

		$piutang = $this->M_koperasi->findById_get($id_koperasi);

		if($amount > $piutang['remaining']) {
			$response = [
				'status' => false,
				'message' => 'Amount tidak boleh melebihi sisa',
			];
			echo json_encode($response);
			return;
		}

		$change_status = $piutang['remaining'] - $amount;

		if($change_status == 0 || $change_status < 1 ) {
			$this->M_koperasi->setStatus_post($id_koperasi, 1);

		}

		$this->M_koperasi->updateRemaining_post($id_koperasi, $change_status);

		$data = [
			'id_koperasi' => $this->input->post('id_koperasi', true),
			'pay_date' => $this->input->post('pay_date', true),
			'pay_amount' => $this->input->post('pay_amount', true),
			'description' => $this->input->post('description', true),
		];

		$this->db->trans_start();
		$piutang_payment = $this->M_purchase_koperasi->create_post($data);
		$dataSaldo = [
			'id_koperasi' => $id_koperasi,
			'nominal' => $data['pay_amount'],
			'status' => 2,
			'type_saldo' => $piutang['type_koperasi'],
		];


		$this->M_saldo_koperasi->create_post($dataSaldo);


		$this->db->trans_complete();


		if ($this->db->trans_status() === FALSE) {
			echo json_encode([
				'status' => false,
				'message' => 'Gagal membayar piutang.',
			]);
		} else {
			echo json_encode([
				'status' => true,
				'message' => 'Piutang berhasil dibayar',
			]);
		}
	}

	public function delete()
	{
		$this->_isAjax();
		$this->_ONLYSELECTED([1,2]);

		$id = $this->input->post('id');

		// $riwayatBayar $this->M_saldo_piutang->


		if($this->M_koperasi->delete($id) && $this->M_purchase_koperasi->deleteByKoperasiId_get($id) ){
			$response = [
				'status' => true,
				'message' => 'Transaksi berhasil dihapus',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Transaksi gagal dihapus',
			];
		}

		echo json_encode($response);

	}

	public function add_saldo()
	{
		$this->_isAjax();
		$this->_ONLY_SU();

		$this->form_validation->set_rules('nominal', 'nominal', 'required', [
			'required' => 'Nominal saldo harus diisi',
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

		$dataSaldo = [
			'nominal' => $this->input->post('nominal', true),
			'type_saldo' => $this->input->post('type_saldo', true),
			'status' => 1,
		];

		$saldo = $this->M_saldo_koperasi->create_post($dataSaldo);

		if ($saldo) {
			$response = [
				'status' => true,
				'message' => 'Saldo berhasil ditambahkan',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Saldo gagal ditambahkan',
			];
		}

		echo json_encode($response);
	}
	public function riwayat_saldo($type){
		$this->_ONLYSELECTED([1,2,3,4]);
		$data = $this->_basicData();
		$data['type'] = $type;

		$data['title'] = 'Riwayat Saldo';
		$data['view_name'] = 'admin/riwayat_saldo_koperasi';
		$data['breadcrumb'] = 'Riwayat Saldo';
		$data['menu'] = '';



		if($data['user']){
			$this->load->view('templates/index',$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
		}
	}
	public function riwayat_saldo_ssr()
	{
		$option = $this->input->post('option');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');
		$type = $this->input->post('type_saldo');

		$list = $this->M_saldo_koperasi->get_datatables($option, $startDate, $endDate, $type);
		$data = array();
		$no = @$_POST['start'];

		foreach ($list as $item) {

			$keterangan = '';
			if($item->status == 2) {
				$keterangan = "$item->name melakukan pengembalian sebesar <span style='color : forestgreen'>Rp.". number_format($item->nominal, 0 , ',', '.').".</span>";
			} else if($item->status == 1) {
				$keterangan = "Admin melakukan penambahan nominal sebesar <span style='color : orange'>Rp.". number_format($item->nominal, 0 , ',', '.').".</span>";
			} else if ($item->status == 3) {
				$keterangan = "$item->name melakukan pinjaman sebesar <span style='color : red'>Rp.". number_format($item->nominal, 0 , ',', '.').".</span>";
			} else if ($item->status == 4) {
				$keterangan = "$item->name pembatalan pembayaran <span style='color : red'>Rp.". number_format($item->nominal, 0 , ',', '.').".</span>";
			} else {
				$keterangan = 'not found';
			}

			$row = array();
			$row[] = date('d/m/Y - H:i', strtotime($item->tanggal));
			$row[] = $keterangan;

			$data[] = $row;
		}

		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_saldo_koperasi->count_all($option, $startDate, $endDate, $type),
			"recordsFiltered" => $this->M_saldo_koperasi->count_filtered($option, $startDate, $endDate, $type),
			"data" => $data,
		);

		echo json_encode($output);
	}

}

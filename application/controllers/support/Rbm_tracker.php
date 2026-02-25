<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rbm_tracker extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_rbm_tracker');
	}

	public function index()
	{
		$this->_ONLYSELECTED([5]);
		$data = $this->_basicData();

		$data['title'] = 'RBM Progress Tracker';
		$data['view_name'] = 'support/rbm_tracker';
		$data['breadcrumb'] = 'RBM Progress Tracker';
		$data['menu'] = '';
		if($data['user']){
			$this->load->view('templates/index', $data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	} 


    public function add_rbm_tracker()
	{
		$this->_ONLYSELECTED([5]);
		$this->_isAjax();

		$this->form_validation->set_rules('fitur', 'Fitur', 'required', [
			'required' => 'Fitur tidak boleh kosong',
		]);
		$this->form_validation->set_rules('sumber', 'Sumber', 'required', [
			'required' => 'Sumber harus diisi',
		]);
		$this->form_validation->set_rules('dampak', 'Dampak', 'required', [
			'required' => 'Dampak harus diisi',
		]);
		$this->form_validation->set_rules('status', 'Status', 'required', [
			'required' => 'Status harus diisi',
		]);
		$this->form_validation->set_rules('prioritas', 'Prioritas', 'required', [
			'required' => 'Prioritas harus diisi',
		]);
		$this->form_validation->set_rules('catatan', 'Catatan', 'required', [
			'required' => 'Catatan harus diisi',
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
			'fitur' => $this->input->post('fitur', true),
			'sumber' => $this->input->post('sumber', true),
			'dampak' => $this->input->post('dampak', true),
			'status' => $this->input->post('status', true),
			'prioritas' => $this->input->post('prioritas', true),
			'catatan' => $this->input->post('catatan', true),
		];

		$rbm_tracker = $this->M_rbm_tracker->create_post($data);

		if ($rbm_tracker) {
			$response = [
				'status' => true,
				'message' => 'Request berhasil ditambahkan',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Request gagal ditambahkan',
			];
		}

		echo json_encode($response);
	} 

    public function update()
	{

		$this->_ONLYSELECTED([5]);
		$this->_isAjax();


		$this->form_validation->set_rules('id_rbm_tracker', 'ID RBM', 'required', [
			'required' => 'ID KOSONG',
		]);

		$this->form_validation->set_rules('fitur', 'Fitur', 'required', [
			'required' => 'Fitur tidak boleh kosong',
		]);
		$this->form_validation->set_rules('sumber', 'Sumber', 'required', [
			'required' => 'Sumber harus diisi',
		]);
		$this->form_validation->set_rules('dampak', 'Dampak', 'required', [
			'required' => 'Dampak harus diisi',
		]);
		$this->form_validation->set_rules('status', 'Status', 'required', [
			'required' => 'Status harus diisi',
		]);
		$this->form_validation->set_rules('prioritas', 'Prioritas', 'required', [
			'required' => 'Prioritas harus diisi',
		]);
		$this->form_validation->set_rules('catatan', 'Catatan', 'required', [
			'required' => 'Catatan harus diisi',
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

        $id = $this->input->post('id_rbm_tracker', true);

		$data = [
			'fitur' => $this->input->post('fitur', true),
			'sumber' => $this->input->post('sumber', true),
			'dampak' => $this->input->post('dampak', true),
			'status' => $this->input->post('status', true),
			'prioritas' => $this->input->post('prioritas', true),
			'catatan' => $this->input->post('catatan', true),
		];

		$rbm_tracker = $this->M_rbm_tracker->update_post($id, $data);

		if ($rbm_tracker) {
			$response = [
				'status' => true,
				'message' => 'Data Request berhasil diupdate',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Data Request gagal diupdate',
			];
		}

		echo json_encode($response);

	} 

    public function delete()
	{
		$this->_ONLYSELECTED([5]);
		$this->_isAjax();

		$id = $this->input->post('id');

		if($this->M_rbm_tracker->delete($id)){
			$response = [
				'status' => true,
				'message' => 'Data Request berhasil dihapus',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Data Request gagal dihapus',
			];
		}

		echo json_encode($response);

	} 
    

    public function detail($id)
	{
		$this->_ONLYSELECTED([5]);
		$data = $this->_basicData();

        $data['pengaduan'] = $this->M_pengaduan->findById_get($id);

		$data['title'] = 'Detail Pengaduan';
		$data['view_name'] = 'pengaduan/detail';
		$data['breadcrumb'] = 'Detail Pengaduan';
		$data['menu'] = '';
		if($data['user']){
			$this->load->view('templates/index', $data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}

    public function ubah_status()
    {
        // Validasi request
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        
        $this->form_validation->set_rules('id_rbm_tracker', 'ID RBM Tracker', 'required|numeric');
        $this->form_validation->set_rules('status_progress', 'Status', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'message' => validation_errors()
            ]);
            return;
        }
        
        $id = $this->input->post('id_rbm_tracker');
        $status = $this->input->post('status_progress');
    
        
        // Update status
        $update = $this->M_rbm_tracker->update_status($id, $status);
        
        if ($update) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Status progress berhasil diperbarui'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal memperbarui status progress'
            ]);
        }
    }

	public function dtSideserver()
	{
		$option = $this->input->post('option');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');
		$priority = $this->input->post('prioritas');

		$list = $this->M_rbm_tracker->get_datatables($option, $startDate, $endDate, $priority);
		$data = array();
		$no = @$_POST['start'];

		foreach ($list as $item) {
			// $action = '
            //             <div class="no-print">
            //                 <a 
            //                     class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-karir" style="width : 70px"
            //                     href="' . base_url('admin/Pengaduan_karyawan/detail/'.htmlspecialchars($item->id_pengaduan)).'">
            //                     Detail
            //                 </a> 
                            
            //             </div>
            //         '; 

            $action = '
                        <div class="no-print">
                            <a href="javascript:void(0)" onclick="editRbmTracker(this)" class="btn gradient-btn-edit btn-sm btn-sm mb-2 rounded-pill" style="width : 70px" 
                                data-id_rbm_tracker="' . htmlspecialchars($item->id_rbm_tracker) . '"
                                data-status="' . htmlspecialchars($item->status) . '"
                                data-fitur="' . htmlspecialchars($item->fitur) . '"
                                data-sumber="' . htmlspecialchars($item->sumber) . '"
                                data-dampak="' . htmlspecialchars($item->dampak) . '"
                                data-prioritas="' . htmlspecialchars($item->prioritas) . '"
                                data-catatan="' . htmlspecialchars($item->catatan) . '">
                                EDIT
                            </a>

                            <button 
                                class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-karir" style="width : 70px"
                                onClick="handleDeleteRbmTrackerButton(' . htmlspecialchars($item->id_rbm_tracker) . ')">
                                DELETE
                            </button>
                        </div>
                    ';
        
            if(strlen($item->catatan) > 20 ) {
                $pesan = substr($item->catatan, 0 , 20).'.......';
            } else {
                $pesan = $item->catatan;
            } 


             switch($item->status) {
                case 'Belum': 
                    $status = '<button type="button" 
                                    class="btn btn-sm btn-primary rounded-pill btn-change-status" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#statusModal"
                                    data-id="' . $item->id_rbm_tracker . '"
                                    data-status="' . $item->status . '"
                                    data-judul="' . htmlspecialchars($item->fitur) . '">
                                <i class="bi bi-arrow-repeat me-1"></i>'.$item->status.'
                            </button>';
                    break;
                case 'Diskusi': 
                    $status = '<button type="button" 
                                    class="btn btn-sm btn-warning rounded-pill btn-change-status" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#statusModal"
                                    data-id="' . $item->id_rbm_tracker . '"
                                    data-status="' . $item->status . '"
                                    data-judul="' . htmlspecialchars($item->fitur) . '">
                                <i class="bi bi-arrow-repeat me-1"></i>'.$item->status.'
                            </button>';
                    break;
                case 'Proses': 
                    $status = '<button type="button" 
                                    class="btn btn-sm btn-danger rounded-pill btn-change-status" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#statusModal"
                                    data-id="' . $item->id_rbm_tracker . '"
                                    data-status="' . $item->status . '"
                                    data-judul="' . htmlspecialchars($item->fitur) . '">
                                <i class="bi bi-arrow-repeat me-1"></i>'.$item->status.'
                            </button>';
                    break; 

                    case 'Selesai': 
                    $status = '<button type="button" 
                                    class="btn btn-sm btn-success rounded-pill btn-change-status" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#statusModal"
                                    data-id="' . $item->id_rbm_tracker . '"
                                    data-status="' . $item->status . '"
                                    data-judul="' . htmlspecialchars($item->fitur) . '">
                                <i class="bi bi-arrow-repeat me-1"></i>'.$item->status.'
                            </button>';
                    break;
                default: 
                $status = '<span class="badge badge-danger badge-lg py-3 px-4">
                                <i class="bi bi-x-circle me-2"></i>
                                Undefined
                            </span>';
                break;
            }
			$row = array();
			$row[] = date('d-m-Y H:i', strtotime($item->created_at));
			$row[] = $item->fitur;
			$row[] = $item->sumber;
			$row[] = $item->dampak;
			$row[] = $status;
			$row[] = $item->prioritas;
			$row[] = $pesan;
			$row[] = $action;

			$data[] = $row;
		}

		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_rbm_tracker->count_all(),
			"recordsFiltered" => $this->M_rbm_tracker->count_filtered($option, $startDate, $endDate, $priority),
			"data" => $data,
		);

		echo json_encode($output);
	}
}

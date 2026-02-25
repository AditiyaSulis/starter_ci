<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan_karyawan extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_pengaduan');
	}

	public function index()
	{
		$this->_ONLYSELECTED([4]);
		$data = $this->_basicData();

		$data['title'] = 'Pengaduan Karyawan';
		$data['view_name'] = 'pengaduan/admin_page';
		$data['breadcrumb'] = 'Penganduan Karyawan';
		$data['menu'] = '';
		if($data['user']){
			$this->load->view('templates/index', $data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	} 

    public function detail($id)
	{
		$this->_ONLYSELECTED([4]);
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
        
        $this->form_validation->set_rules('id_pengaduan', 'ID Pengaduan', 'required|numeric');
        $this->form_validation->set_rules('status_pengaduan', 'Status', 'required|in_list[1,2,3,4]');
        
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'message' => validation_errors()
            ]);
            return;
        }
        
        $id = $this->input->post('id_pengaduan');
        $status = $this->input->post('status_pengaduan');
    
        
        // Update status
        $update = $this->M_pengaduan->update_status($id, $status);
        
        if ($update) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Status pengaduan berhasil diperbarui'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal memperbarui status pengaduan'
            ]);
        }
    }

	public function dtSideserver()
	{
		$option = $this->input->post('option');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');

		$list = $this->M_pengaduan->get_datatables($option, $startDate, $endDate);
		$data = array();
		$no = @$_POST['start'];

		foreach ($list as $item) {
			$action = '
                        <div class="no-print">
                            <a 
                                class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-karir" style="width : 70px"
                                href="' . base_url('admin/Pengaduan_karyawan/detail/'.htmlspecialchars($item->id_pengaduan)).'">
                                Detail
                            </a> 
                             <button type="button" 
                                    class="btn btn-sm btn-warning rounded-pill btn-change-status" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#statusModal"
                                    data-id="' . $item->id_pengaduan . '"
                                    data-status="' . $item->status_pengaduan . '"
                                    data-judul="' . htmlspecialchars($item->title_pengaduan) . '">
                                <i class="bi bi-arrow-repeat me-1"></i> Ubah Status
                            </button>
                        </div>
                    ';
            if(strlen($item->text_pengaduan) > 20 ) {
                $pesan = substr($item->text_pengaduan, 0 , 20).'.......';
            } else {
                $pesan = $item->text_pengaduan;
            } 


             switch($item->status_pengaduan) {
                case 1: 
                    $status = '<span class="badge badge-warning badge-lg py-3 px-4">
                                    <i class="bi bi-clock-history me-2"></i>
                                    Menunggu Diproses
                                </span>';
                    break;
                case 2: 
                    $status = '<span class="badge badge-primary badge-lg py-3 px-4">
                                    <i class="bi bi-arrow-repeat me-2"></i>
                                    Sedang Diproses
                                </span>';
                    break;
                case 3: 
                    $status = '<span class="badge badge-success badge-lg py-3 px-4">
                                    <i class="bi bi-check2-circle me-2"></i>
                                    Selesai
                                </span>';
                    break;
                case 4: 
                    $status = '<span class="badge badge-danger badge-lg py-3 px-4">
                                    <i class="bi bi-x-circle me-2"></i>
                                    Tidak Selesai
                                </span>';
                    break;
                default: 
                $status = '<span class="badge badge-danger badge-lg py-3 px-4">
                                <i class="bi bi-x-circle me-2"></i>
                                Undefined
                            </span>';
                break;
            }
			$row = array();
			$row[] = $item->kategori != null ? $item->kategori : '-';
			$row[] = $item->title_pengaduan;
			$row[] = $pesan;
			$row[] = date('d-m-Y', strtotime($item->created_at));
			$row[] = $status;
			$row[] = $action;

			$data[] = $row;
		}

		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_pengaduan->count_all(),
			"recordsFiltered" => $this->M_pengaduan->count_filtered($option, $startDate, $endDate),
			"data" => $data,
		);

		echo json_encode($output);
	}
}

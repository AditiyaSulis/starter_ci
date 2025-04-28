<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashflow extends MY_Controller{

	function __construct()
	{
		parent::__construct();

		$this->load->model('M_products');
		$this->load->model('M_categories');
		$this->load->model('M_account_code');
		$this->load->model('M_cashflow');
		$this->load->model('M_finance_records');
		
	}



	public function cashflow_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Kas Kecil';
		$data['view_name'] = 'admin/cashflow';
		$data['breadcrumb'] = 'Kas Kecil';
		$data['menu'] = '';

		$data['categories'] = $this->M_categories->findCashflow_get();
        $data['products'] = $this->M_products->findAll_get();
        $data['products_show'] = $this->M_products->findAllShow_get();
        $data['account_code'] = $this->M_account_code->findAll_get();

		

		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('panel');
		}
	}



	public function add_cashflow()
	{
		$this->_ONLYSELECTED([1,2]);
		$this->_isAjax();

		$this->form_validation->set_rules('id_product', 'id_product', 'required', [
			'required' => 'Product harus diisi',
		]);

		$this->form_validation->set_rules('id_code', 'id_code', 'required', [
			'required' => 'Code harus diisi',
		]);
		$this->form_validation->set_rules('auto_finance_record', 'auto_finance_record', 'required', [
			'required' => 'Include Finance Record harus diisi',
		]);
		$this->form_validation->set_rules('jumlah', 'jumlah', 'required', [
			'required' => 'Jumlah harus diisi',
		]);
		$this->form_validation->set_rules('tgl_cash_flow', 'tgl_cash_flow', 'required', [
			'required' => 'Tangal harus diisi',
		]);
		$this->form_validation->set_rules('description', 'description', 'required|min_length[2]|max_length[100]', [
			'required' => 'Deskripsi harus diisi',
			'min_length' => 'Deskripsi minimal memiliki 2 karakter',
			'max_length' => 'Deskripsi tidak boleh melebihi 100 karakter',
		]); 

        $this->form_validation->set_rules('catatan', 'catatan', 'required|min_length[2]|max_length[100]', [
			'required' => 'Catatan harus diisi',
			'min_length' => 'Catatan minimal memiliki 2 karakter',
			'max_length' => 'Catatan tidak boleh melebihi 100 karakter',
		]);


		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => false,
				'message' => validation_errors('<p>', '</p>'),
				'confirmationbutton' => true,
				'timer' => 0,
				'icon' => 'error',
			]);
			return;
		}


		$kode = 'KAS-'. date('md').''.date('Hs').''.mt_rand(1,99);


		$this->db->trans_start();
		//input data cashflow
		$kas = [
			'kode_cash_flow' => $kode,
			'id_product' => $this->input->post('id_product', true),
			'id_code' => $this->input->post('id_code', true),
			'jumlah' => $this->input->post('jumlah', true),
			'tgl_cash_flow' => $this->input->post('tgl_cash_flow', true),
			'description' => $this->input->post('description', true),
			'catatan' => $this->input->post('catatan', true),
		];

		$create_kas = $this->M_cashflow->create_post($kas);

		if (!$create_kas) {
			$this->db->trans_rollback();
			echo json_encode([ 
				'status' => false,
				'message' => 'Gagal menyimpan data ke kas',
			]);
			return;
		}

		
		$dataFinanceRecord = [];


		//Finance record Insert
		if ($this->input->post('auto_finance_record') == 1) {
			
			$dataFinanceRecord = [
				'record_date' => $this->input->post('tgl_cash_flow', true),
				'product_id' => $this->input->post('id_product', true), 
				'amount' => $this->input->post('jumlah', true),
				'id_code' => $this->input->post('id_code', true),
				'description' => $kode,
			];

			$insertFinanceRecord = $this->M_finance_records->create_post($dataFinanceRecord);
			if (!$insertFinanceRecord) {
				$this->db->trans_rollback();
				echo json_encode([
					'status' => false,
					'message' => 'Gagal menambahkan data finance record.',
				]);
				return;
			}

		}
 

		

		$this->db->trans_complete();
        //End Finance Record


		if ($this->db->trans_status() === FALSE) {
			echo json_encode([
				'status' => false,
				'message' => 'Gagal menyimpan data ke kas kecil.',
			]);
		} else {
			echo json_encode([
				'status' => true,
				'message' => 'Kas kecil berhasil dsimpan',
			]);
		}
	}


	public function delete()
	{
		$this->_ONLYSELECTED([1,2]);
		$this->_isAjax();

		$kas =$this->M_cashflow->findById_get($this->input->post('id', true)); 

		if($this->M_cashflow->delete($kas['id_cash_flow'])){
			$finance_record = $this->M_finance_records->findByDesc_get($kas['kode_cash_flow']);
			if($finance_record){
				$this->M_finance_records->delete($finance_record['id_record']);
			}
			$response = [
				'status' => true,
				'message' => 'Kas kecil berhasil dihapus',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Kas Kecil gagal dihapus'
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
        $type = $this->input->post('type');
        $code = $this->input->post('code');

        $list = $this->M_cashflow->get_datatables($option, $startDate, $endDate, $product, $code, $type); 
        $data = array();
        $no = @$_POST['start']; 
    


        foreach ($list as $item) {

            $pengeluaran = $item['id_kategori'] == 2 ?'Rp '.number_format($item['jumlah'], 0, ',', '.') : '-';
            $penghasilan = $item['id_kategori'] == 1 ?'Rp '.number_format($item['jumlah'], 0, ',', '.') : '-';

            $action = '
                            <button 
                                class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-kas" style="width : 70px"
                                onClick="handleDeleteKasButton(' . htmlspecialchars($item['id_cash_flow']) . ')">
                                DELETE
                            </button>
                        </div>
                    ';
            $row = array();
            $row[] = $item['kode_cash_flow']; 
            $row[] = date('d F Y', strtotime($item['tgl_cash_flow'])); 
            //$row[] = $item['name_kategori'];
			$row[] = $item['name_code']; 
            $row[] = $item['name_product']; 
            $row[] =$item['description'];
            $row[] = $penghasilan; 
            $row[] = $pengeluaran; 
            $row[] =$item['catatan'];
            $row[] = $action;
         
            $data[] = $row;
        }
    
        $output = array(
            "draw" => @$_POST['draw'], 
            "recordsTotal" => $this->M_cashflow->count_all(),
            "recordsFiltered" => $this->M_cashflow->count_filtered($option, $startDate, $endDate, $product, $code, $type), 
            "data" => $data, 
        );
    
        echo json_encode($output); 
    } 



	public function getFilteredSummary()
    {
        $filter = $this->input->post('option');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        if($filter){
            $categories = $this->M_cashflow->getTotalAmountByCategory($filter, $startDate, $endDate);
            $products = $this->M_cashflow->getTotalAmountByProductAndCategory($filter, $startDate, $endDate);
        } else {
            $categories = $this->M_cashflow->getTotalAmountByCategory('this_month', $startDate, $endDate);
            $products = $this->M_cashflow->getTotalAmountByProductAndCategory('this_month', $startDate, $endDate);
        }
        

        echo json_encode([
            'status' => true,
            'categories' => $categories,
            'products' => $products
        ]);
    }

}




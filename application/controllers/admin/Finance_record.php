<?php
class Finance_record extends MY_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('M_finance_records');
        $this->load->model('m_Account_code');
        $this->load->model('M_products');
        $this->load->model('m_Categories');

    }

   
    public function finance_record_page()
    {
        $this->_ONLYSELECTED([1, 2]); 
        $data = $this->_basicData();
    
        $data['title'] = 'Finance Record';
        $data['view_name'] = 'admin/finance_record';
        $data['breadcrumb'] = 'Finance Record - Transaction';
        $data['menu'] = 'FR';
    
        
        $data['categories'] = $this->m_Categories->findAll_get();
        $data['products'] = $this->M_products->findAll_get();
        $data['products_show'] = $this->M_products->findAllShow_get();
        $data['account_code'] = $this->m_Account_code->findAll_get();

    
        if (isset($data['user']) && $data['user']) {
            $this->load->view('templates/index', $data);
        } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
            redirect('login'); 
        }
    }


    public function option_acc()
    {
        $id = $this->input->post('category_id', true);

        $account = $this->m_Account_code->findByCategoryId_get($id);

        if(empty($account)){
			echo json_encode([
				'status' => false,
				'message' =>  'Data tidak ditemukan'
			]);
			return false;
		} 

        $response = [
            'status' => true,
			'data' => $account
        ];

        echo json_encode($response);

    }


    public function edit_option_acc()
    {
        $id = $this->input->post('category_id', true);

        $account = $this->m_Account_code->findByCategoryId_get($id);

        if(empty($account)){
			echo json_encode([
				'status' => false,
				'message' =>  'Data tidak ditemukan'
			]);
			return false;
		} 

        $response = [
            'status' => true,
			'data' => $account
        ];

        echo json_encode($response);

    }

    
    public function add_finance()
    {
        $this->_ONLY_SU();

        $this->_isAjax();
        $this->form_validation->set_rules('product_id', 'Product_id', 'required', [
            'required' => 'Product harus diisi',
        ]);

        $this->form_validation->set_rules('amount', 'Amount', 'required', [
            'required' => 'Amount tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('id_code', 'Id_code', 'required', [
            'required' => 'Code account harus diisi',
        ]);
        $this->form_validation->set_rules('description', 'description', 'required', [
            'required' => 'Description harus diisi',
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
                'id_record' => $this->input->post('id_record', true),
                'record_date' => $this->input->post('record_date', true),
                'product_id' => $this->input->post('product_id', true),
                'amount' => $this->input->post('amount', true),
                'id_code' => $this->input->post('id_code', true),
                'description' => $this->input->post('description', true),
        ];

        $record = $this->M_finance_records->create_post($data);

        if ($record) {
            $response = [
                'status' => true,
                'message' => 'Record berhasil ditambahkan',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Record gagal ditambahkan',
            ];
        }

        echo json_encode($response);
    }


    public function update() 
    {

        $this->_ONLY_SU();
        $this->_isAjax();

        $this->form_validation->set_rules('product_id', 'Product_id', 'required', [
            'required' => 'Product harus diisi',
        ]);

        $this->form_validation->set_rules('amount', 'Amount', 'required', [
            'required' => 'Amount tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('id_code', 'Id_code', 'required', [
            'required' => 'Code account harus diisi',
        ]);
        $this->form_validation->set_rules('description', 'description', 'required|min_length[4]|max_length[300]', [
            'required' => 'Description harus diisi',
            'min_length' => 'Description minimal 4 karakter',
            'max_length' => 'Description lahir maksimal 300 karakter',
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
            'id_record' => $this->input->post('id_record', true),
            'product_id' => $this->input->post('product_id', true),
            'amount' => $this->input->post('amount', true),
            'id_code' => $this->input->post('id_code', true),
            'description' => $this->input->post('description', true),
            'record_date' => $this->input->post('record_date', true)
        ];

        $record = $this->M_finance_records->update_post($data['id_record'], $data);

        if ($record) {
            $response = [
                'status' => true,
                'message' => 'Data record berhasil diupdate',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Data record gagal diupdate',
            ];
        }

        echo json_encode($response);
        
    }


    public function delete()
    {
        $this->_ONLY_SU();
        $this->_isAjax();

        $id = $this->input->post('id');


        if($this->M_finance_records->delete($id)){
            $response = [
                'status' => true,
                'message' => 'Data record berhasil dihapus',
            ];
        } else {
            $response = [
               'status' => false,  
               'message' => 'Data record gagal dihapus',  
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

        $list = $this->M_finance_records->get_datatables($option, $startDate, $endDate, $product, $code, $type); 
        $data = array();
        $no = @$_POST['start']; 
    
        foreach ($list as $item) {
            $action = '
                        <div class="no-print">
                            <a href="javascript:void(0)" onclick="editFinanceBtn(this)" class="btn gradient-btn-edit btn-sm btn-sm mb-2 rounded-pill" style="width : 70px" 
                                data-id="' . htmlspecialchars($item->id_record) . '"
                                data-id_code="' . htmlspecialchars($item->id_code) . '"
                                data-product="' . htmlspecialchars($item->product_id) . '"
                                data-kategori="' . htmlspecialchars($item->id_kategori) . '"
                                data-amount="' . htmlspecialchars($item->amount) . '"
                                data-record_date="' . htmlspecialchars($item->record_date) . '"
                                data-description="' . htmlspecialchars($item->description) . '">
                                EDIT
                            </a>

                            <button 
                                class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-finrec" style="width : 70px"
                                onClick="handleDeleteButton(' . htmlspecialchars($item->id_record) . ')">
                                DELETE
                            </button>
                        </div>
                    ';
            $row = array();
            $row[] = '<div class="no-print">'.date('d M Y H:i:s', strtotime($item->created_at)).'</div>'; 
            $row[] = date('d F Y', strtotime($item->record_date)); 
            $row[] = $item->name_kategori;
            $row[] = $item->name_product; 
            $row[] = 'Rp '.number_format($item->amount, 0, ',', '.'); 
            $row[] = ''.$item->code.' - '.$item->name_code; 
            $row[] = $item->description;
            $row[] = $action;
         
            $data[] = $row;
        }
    
        $output = array(
            "draw" => @$_POST['draw'], 
            "recordsTotal" => $this->M_finance_records->count_all(),
            "recordsFiltered" => $this->M_finance_records->count_filtered($option, $startDate, $endDate, $product, $code, $type), 
            "data" => $data, 
        );
    
        echo json_encode($output); 
    }


    public function get_record()
    {
        $id = $this->input->post('id');
    
        if (!$id) {
            echo json_encode([
                'status' => false,
                'message' => 'ID tidak valid.',
            ]);
            return;
        }
    
        $record = $this->M_finance_records->findById_get($id);
    
        if ($record) {
            echo json_encode([
                'status' => true,
                'record' => $record,
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Data tidak ditemukan.',
            ]);
        }
    }
    

    public function getFilteredSummary()
    {
        $filter = $this->input->post('option');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        if($filter){
            $categories = $this->M_finance_records->getTotalAmountByCategory($filter, $startDate, $endDate);
            $products = $this->M_finance_records->getTotalAmountByProductAndCategory($filter, $startDate, $endDate);
        } else {
            $categories = $this->M_finance_records->getTotalAmountByCategory('this_month', $startDate, $endDate);
            $products = $this->M_finance_records->getTotalAmountByProductAndCategory('this_month', $startDate, $endDate);
        }
        

        echo json_encode([
            'status' => true,
            'categories' => $categories,
            'products' => $products
        ]);
    }
}

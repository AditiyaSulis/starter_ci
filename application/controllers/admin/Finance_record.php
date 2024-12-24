<?php
class Finance_record extends MY_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('m_Finance_records');
        $this->load->model('m_Account_code');
        $this->load->model('m_Products');
        $this->load->model('m_Categories');

    }

    public function finance_record_page(){
        $this->_ONLYSELECTED([1,2]);
        $data = $this->_basicData();

        $data['title'] = 'Finance Record';
        $data['view_name'] = 'admin/finance_record';
        $data['breadcrumb'] = 'Finance Record';


        // $data['view_name'] = 'admin/backup/finance_record_backup';
        // $data['finance_records'] = $this->m_Finance_records->get_all_join();

        $data['categories'] = $this->m_Categories->get_all();
        
        //$data['finance_records'] = $this->m_Finance_records->get_all_join();
        $data['products'] = $this->m_Products->get_all();
        $data['account_code'] = $this->m_Account_code->get_all();

        if($data['user']){
            $this->load->view('templates/index',$data);
        } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
        }

    }

    public function option_acc(){
        $id = $this->input->post('category_id', true);

        $account = $this->m_Account_code->findByCategoryId($id);

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
    public function edit_option_acc(){
        $id = $this->input->post('category_id', true);

        $account = $this->m_Account_code->findByCategoryId($id);

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
            'product_id' => $this->input->post('product_id', true),
            'amount' => $this->input->post('amount', true),
            'id_code' => $this->input->post('id_code', true),
            'description' => $this->input->post('description', true),
        ];

        $record = $this->m_Finance_records->create($data);

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

    public function update() {

        $this->_ONLY_SU();

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
        ];

        $record = $this->m_Finance_records->update($data['id_record'], $data);

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

    public function delete(){
        $this->_ONLY_SU();

        $id = $this->input->post('id');


        if($this->m_Finance_records->delete($id)){
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
        $list = $this->m_Finance_records->get_datatables(); 
        $data = array();
        $no = @$_POST['start']; 
    
        foreach ($list as $item) {
            $action = '
                             <button class="btn btn-warning btn-sm btn-edit-finrec btn-sm mb-2 rounded-pill" 
                                data-id="' . htmlspecialchars($item->id_record) . '"
                                data-id_code="' . htmlspecialchars($item->id_code) . '"
                                data-product="' . htmlspecialchars($item->product_id) . '"
                                data-kategori="' . htmlspecialchars($item->id_kategori) . '"
                                data-amount="' . htmlspecialchars($item->amount) . '"
                                data-description="' . htmlspecialchars($item->description) . '">
                                Edit
                            </button>

                            <button 
                                class="btn btn-danger btn-sm mb-2 rounded-pill btn-delete-finrec" 
                                onClick="handleDeleteButton(' . htmlspecialchars($item->id_record) . ')">
                                Delete
                            </button>
                    ';
            $row = array();
            $row[] = date('Y-m-d H:i:s', strtotime($item->created_at)); 
            $row[] = date('Y-m-d', strtotime($item->record_date)); 
            $row[] = $item->name_kategori;
            $row[] = $item->name_product; 
            $row[] = number_format($item->amount, 2, ',', '.'); 
            $row[] = $item->name_code; 
            $row[] = $item->description;
            $row[] = $action;
         
            $data[] = $row;
        }
    
        $output = array(
            "draw" => @$_POST['draw'], 
            "recordsTotal" => $this->m_Finance_records->count_all(), 
            "recordsFiltered" => $this->m_Finance_records->count_filtered(), 
            "data" => $data, 
        );
    
        echo json_encode($output); 
    }

    public function get_record() {
        $id = $this->input->post('id');
    
        if (!$id) {
            echo json_encode([
                'status' => false,
                'message' => 'ID tidak valid.',
            ]);
            return;
        }
    
        $record = $this->m_Finance_records->findById($id);
    
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
    


}
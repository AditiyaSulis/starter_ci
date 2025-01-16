<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchases extends MY_Controller{

    function __construct()
    {
        parent::__construct();

        $this->load->model('m_Purchases');
        $this->load->model('m_Purchase_payment');
        $this->load->model('m_Supplier');
    }
    

    public function purchases_unpaid_page()
    {
       $this->_ONLYSELECTED([1,2]);
       $data = $this->_basicData();

       $data['title'] = 'Purchases Unpaid';
       $data['view_name'] = 'admin/purchases_unpaid';
       $data['breadcrumb'] = 'Supplier - Purchases Unpaid';
       $data['tab'] = 'Unpaid';
       $data['menu'] = 'Supplier';
       
       $data['purchases'] = $this->m_Purchases->findAllWithJoin_get();
       $data['suppliers'] = $this->m_Supplier->findAllIsActive();
   

       if($data['user']) {
            $this->load->view('templates/index', $data);
       } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
            redirect('fetch/login');
       }
        
    }


    public function purchases_paid_page()
    {
        
       $this->_ONLYSELECTED([1,2]);
       $data = $this->_basicData();

       $data['title'] = 'Purchases Unpaid';
       $data['view_name'] = 'admin/purchases_paid';
       $data['breadcrumb'] = 'Supplier - Purchases Paid';
       $data['tab'] = 'Unpaid';
       $data['menu'] = 'Supplier';
       
       $data['purchases'] = $this->m_Purchases->findAllByPaidWithJoin_get();
       $data['suppliers'] = $this->m_Supplier->findAllIsActive();
   

       if($data['user']) {
            $this->load->view('templates/index', $data);
       } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
            redirect('fetch/login');
       }
        
    }


    public function add_purchases()
    {
        $this->_isAjax();
        $this->_ONLY_SU();

        $this->form_validation->set_rules('id_supplier', 'id_supplier', 'required', [
            'required' => 'Supplier harus diisi',
        ]);

        $this->form_validation->set_rules('input_at', 'input_at', 'required', [
            'required' => 'Input harus diisi',
        ]);

        $this->form_validation->set_rules('total_amount', 'total_amount', 'required', [
            'required' => 'Total harus diisi',
        ]);

        $this->form_validation->set_rules('pot_amount', 'pot_amount', 'required', [
            'required' => 'Potongan harus diisi',
        ]);

        $this->form_validation->set_rules('payment_type', 'payment_type', 'required', [
            'required' => 'Payment type harus diisi',
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
        $final_amount = $this->input->post('total_amount',true) - $this->input->post('pot_amount', true);

        if($this->input->post('payment_type',true) ==1) {
            $status = 1;
            $remaining_amount = 0;
        } else {
            $status = 0;
            $remaining_amount = $final_amount;
        }

        $data = [
            'id_supplier' => $this->input->post('id_supplier', true),
            'input_at' => $this->input->post('input_at', true),
            'total_amount' => $this->input->post('total_amount', true),
            'pot_amount' => $this->input->post('pot_amount', true),
            'final_amount' => $final_amount,
            'remaining_amount' => $remaining_amount,
            'status_purchases' => $status,
            'description' => $this->input->post('description', true),
            'payment_type' => $this->input->post('payment_type', true),
        ];

        $purchases = $this->m_Purchases->create_post($data);

        if ($purchases) {
            $response = [
                'status' => true,
                'message' => 'Purchase berhasil ditambahkan',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Purchases gagal ditambahkan',
            ];
        }

        echo json_encode($response);
    }


    public function delete()
    {
        $this->_isAjax();
        $this->_ONLY_SU();

        $id = $this->input->post('id_purchases');
        


        if($this->m_Purchases->delete($id) || $this->m_Purchase_payment->deleteByPurchaseId($id) ){
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


   //---------PAY PURCHASE PAYMENT
    public function pay_logs() 
    {
   
        $id = $this->input->post('id');


        if (!$id) {
            echo json_encode([
                'status' => false,
                'message' => 'ID tidak valid.',
            ]);
            return;
        }

        $logs = $this->m_Purchase_payment->findByPurchasesId_get($id);

        
        echo json_encode([
            'status' => true,
            'logs' => $logs,
        ]);
    }

    public function add_pay()
    {
        $this->_isAjax();
        $this->_ONLY_SU();

        $this->form_validation->set_rules('id_purchases', 'id_purchase', 'required', [
            'required' => 'ID Purchase harus diisi',
        ]);

        $this->form_validation->set_rules('payment_amount', 'payment_amount', 'required', [
            'required' => 'Amount harus diisi',
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

        $id_purchase = $this->input->post('id_purchases', true);
        $amount = $this->input->post('payment_amount', true);

        $purchases = $this->m_Purchases->findById_get($id_purchase);

        if($amount > $purchases['remaining_amount']) {
            $response = [
                'status' => false,
                'message' => 'Amount tidak boleh melebihi sisa',
            ];
            echo json_encode($response);
            return;
        }


        $data = [
            'id_purchases' => $this->input->post('id_purchases', true),
            'payment_date' => $this->input->post('payment_date', true),
            'payment_amount' => $this->input->post('payment_amount', true),
            'description' => $this->input->post('description', true),
        ];

        $purchase_payments = $this->m_Purchase_payment->create_post($data);

        if ($purchase_payments) {
            $response = [
                'status' => true,
                'message' => 'Pembayaran berhasil ditambahkan',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Pembayaran gagal ditambahkan',
            ];
        }

        echo json_encode($response);
    }

}
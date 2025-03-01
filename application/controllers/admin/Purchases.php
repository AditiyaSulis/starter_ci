<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchases extends MY_Controller{

    function __construct()
    {
        parent::__construct();

        $this->load->model('M_purchases');
        $this->load->model('M_purchase_payment');
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
       $data['total_paid'] = $this->M_purchases->totalPaid_get();
       $data['total_unpaid'] = $this->M_purchases->totalUnpaid_get();

	   $data['jatuh_tempo'] = $this->M_purchases->jatuhTempo_get();
	   $data['total_jatuh_tempo'] = $this->M_purchases->totalJatuhTempo_get();

	   $data['view_data'] = 'core/purchases/data_purchases';
	   $data['view_component'] = 'core/purchases/data_purchases_components';

       $data['purchases'] = $this->M_purchases->findAllWithJoin_get();
       $data['suppliers'] = $this->m_Supplier->findAllIsActive();
       $data['totalFinalAmount'] = $this->M_purchases->getTotalFinalAmount_get();
       $data['totalPaymentAmount'] = $this->M_purchase_payment->getTotalPaymentAmount_get();
       $data['totalRemainingAmount'] = $data['totalFinalAmount'] - $data['totalPaymentAmount'];

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
       $data['total_paid'] = $this->M_purchases->totalPaid_get();
       $data['total_unpaid'] = $this->M_purchases->totalUnpaid_get();
       $data['totalFinalAmount'] = $this->M_purchases->getTotalFinalAmount_get();
       $data['totalPaymentAmount'] = $this->M_purchase_payment->getTotalPaymentAmount_get();
       $data['totalRemainingAmount'] = $data['totalFinalAmount'] - $data['totalPaymentAmount'];

	   $data['jatuh_tempo'] = $this->M_purchases->jatuhTempo_get();
	   $data['total_jatuh_tempo'] = $this->M_purchases->totalJatuhTempo_get();
       

	   $data['view_data'] = 'core/purchases/data_purchases';
	   $data['view_component'] = 'core/purchases/data_purchases_components';

       $data['suppliers'] = $this->m_Supplier->findAllIsActive();
   

       if($data['user']) {
            $this->load->view('templates/index', $data);
       } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
            redirect('fetch/login');
       }
        
    }

	public function dtSideServer()
	{
		$option = $this->input->post('option');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');

		$list = $this->M_purchases-> getPurchasesDataPaid_get($option, $startDate, $endDate);

		$data = [];
		$no = $this->input->post('start');

		foreach($list as $item) {

			$action =
				'   
                        <button 
                            class="btn btn-warning btn-sm mb-2 rounded-pill btn-pay-piutang" style="width : 70px"
                            data-bs-toggle="modal" 
                            data-bs-target="#payModal"
                            data-id-supplier="'.htmlspecialchars($item['id_purchases']).'"
                            data-final-amount="'.htmlspecialchars($item['final_amount']).'"
                            data-remaining-amount="'.htmlspecialchars($item['remaining_amount']).'">
                             PAY
                        </button>
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-pc" onclick="handleDeleteButton('.htmlspecialchars($item['id_purchases']).')" style="width : 70px">
                            DELETE
                        </button>
                     '
			;

			$status = $item['status_purchases'] == 0 ?
							'
                              <td>
                                  <span class="badge gradient-btn-unpaid btn-sm " style="width : 50px">
                                      Unpaid
                                  </span>
                              </td>
                           '
							:
							'
                              <td>
                                  <span class="badge gradient-btn-paid btn-sm " style="width : 50px">
                                      Paid
                                  </span>
                              </td>
                           ';

			$type = $item['payment_type'] == 1 ?
				     		'
                              <td>
                                 <span class="badge gradient-btn-debit btn-sm" style="width:50px">
                                 	Debit
                           		 </span>
                              </td>
                           	'
							:
							'
                              <td>
                                  <span class="badge gradient-btn-kredit btn-sm" style="width:50px">
                                 	Kredit
                            	  </span>
                              </td>
                           ';

			$row = [];
			$row[] = ++$no;
			$row[] = date('d M Y', strtotime($item['input_at']));
			$row[] = $item['name_supplier'];
			$row[] = 'Rp.'. number_format($item['total_amount'], 0 , ',', '.');
			$row[] = 'Rp.'. number_format($item['pot_amount'], 0 , ',', '.');
			$row[] = 'Rp.'. number_format($item['final_amount'], 0 , ',', '.');
			$row[] = 'Rp.'. number_format($item['remaining_amount'], 0 , ',', '.');
			$row[] = $status;
			$row[] = $type;
			$row[] = date('d M Y', strtotime($item['jatuh_tempo']));
			$row[] = $item['description'];
			$row[] = $action;
			$data[] = $row;
		}

		$output = [
			"draw" =>@$_POST['draw'],
			"recordsTotal" => count($list),
			"recordsFiltered" => count($list),
			"option" => $option,
			"startDate" => $startDate,
			"endDate" => $endDate,
			"data" => $data,
		];

		echo json_encode($output);
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
		$this->form_validation->set_rules('jatuh_tempo', 'jatuh_tempo', 'required', [
            'required' => 'Jatuh tempo harus diisi',
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
			'jatuh_tempo' => $this->input->post('jatuh_tempo', true),
        ];

        $purchases = $this->M_purchases->create_post($data);

        if ($purchases) {
            $response = [
                'status' => true,
                'message' => 'Purchase berhasil ditambahkan',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Purchase gagal ditambahkan',
            ];
        }

        echo json_encode($response);
    }

    public function delete()
    {
        $this->_isAjax();
        $this->_ONLY_SU();

        $id = $this->input->post('id', true);


        if($this->M_purchases->delete($id) && $this->M_purchase_payment->deleteByPurchaseId_get($id)){
            $response = [
                'status' => true,
				'id' => $id,
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

        $logs = $this->M_purchase_payment->findByPurchasesId_get($id);

        
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

        $purchases = $this->M_purchases->findById_get($id_purchase);

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

        $purchase_payments = $this->M_purchase_payment->create_post($data);

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

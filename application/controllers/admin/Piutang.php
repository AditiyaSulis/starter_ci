<?php
class Piutang extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_Employees');
        $this->load->model('m_Piutang');
        $this->load->model('m_Purchase_piutang');
    }


    public function piutang_page()
    {
        $this->_ONLYSELECTED([1,2]);
        $data = $this->_basicData();

        $data['title'] = 'Piutang';
        $data['view_name'] = 'admin/piutang';
        $data['breadcrumb'] = 'Piutang';
        $data['menu'] = '';

        $data['employee'] = $this->m_Employees->findAll_get();
        $data['piutang'] = $this->m_Piutang->findAllJoin_get();


        if($data['user']){
            $this->load->view('templates/index',$data);
        } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
        }

    }


    public function add_piutang()
    {
        $this->_ONLY_SU();
        $this->_isAjax();



        $this->form_validation->set_rules('id_employee', 'id_employee', 'required', [
            'required' => 'Karyawan harus diisi',
        ]);
        $this->form_validation->set_rules('type_piutang', 'type_piutang', 'required', [
            'required' => 'Type harus diisi',
        ]);
        $this->form_validation->set_rules('amount_piutang', 'amount_piutang', 'required', [
            'required' => 'Amount harus diisi',
        ]);
        $this->form_validation->set_rules('description_piutang', 'description_piutang', 'required|min_length[4]|max_length[100]', [
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

        $id_emp = $this->input->post('id_employee', true);
        $emp = $this->m_Employees->findById_get($id_emp);
        $amount_piutang = $this->input->post('amount_piutang',true);

        $total_unpaid = $this->m_Piutang->getTotalAmountPiutang_get($id_emp) + $amount_piutang;
        if($total_unpaid > $emp['basic_salary'] ){
            $response = [
                'status' => false,
                'message' => 'Piutang yang belum lunas sudah melebihi gaji',
            ];
            echo json_encode($response);
            return;
        }

        if($amount_piutang > $emp['basic_salary']){
            $response = [
                'status' => false,
                'message' => 'Piutang karyawan tidak boleh melebihi gaji karyawan',
            ];
            echo json_encode($response);
            return;
        }


        $type = $this->input->post('type_piutang', true);
        $tenor = $this->input->post('tenor_piutang', true);
        $tgl_lunas = date('Y-m-d');

        if($type == 2) {
            $tgl_lunas = date('Y-m-d', strtotime('+1 months'));
            $tenor = 1;
        } else if($tenor == 2) {
            $tgl_lunas = date('Y-m-d', strtotime('+2 months'));
            $tenor = 2;
        } else if($tenor == 3) {
            $tgl_lunas = date('Y-m-d', strtotime('+3 months'));
            $tenor = 3;
        } else if($tenor == 4) {
            $tgl_lunas = date('Y-m-d', strtotime('+4 months'));
            $tenor = 4;
        } else if($tenor == 5) {
            $tgl_lunas = date('Y-m-d', strtotime('+5 months'));
            $tenor = 5;
        } else if($tenor == 6) {
            $tgl_lunas = date('Y-m-d', strtotime('+6 months'));
            $tenor = 6;
        } 


        $data = [
            'id_employee' => $this->input->post('id_employee', true),
            'type_piutang' => $this->input->post('type_piutang', true),
            'tenor_piutang' => $tenor,
            'amount_piutang' => $this->input->post('amount_piutang', true),
            'remaining_piutang' => $this->input->post('amount_piutang', true),
            'description_piutang' => $this->input->post('description_piutang', true),
            'piutang_date' => $this->input->post('piutang_date', true),
            'status_piutang' => 2,
            'progress_piutang' => 2,
            'tgl_lunas' => $tgl_lunas,
        ];

        $employee = $this->m_Piutang->create_post($data);

        if ($employee) {
            $response = [
                'status' => true,
                'message' => 'Piutang berhasil ditambahkan',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Piutang gagal ditambahkan',
            ];
        }

        echo json_encode($response);
    }


    public function dtSideServer() 
    {
        $tenor = $this->input->post('tanggal_pelunasan'); 
        $type = $this->input->post('type'); 
    
        $list = $this->m_Piutang->getPiutangData_get($type, $tenor);
        
        $data = [];
        $no = $this->input->post('start');  
    
        foreach($list as $item) {
            $action = $item['progress_piutang'] == 2 ? 
                    '   
                        <button 
                            class="btn btn-warning btn-sm mb-2 rounded-pill btn-pay-piutang" style="width : 70px"
                            data-bs-toggle="modal" 
                            data-bs-target="#payPiutangModal"
                            data-id_piutang="'.htmlspecialchars($item['id_piutang']).'" 
                            data-remaining_piutang="'.htmlspecialchars($item['remaining_piutang']).'"
                            data-tgl_lunas="'.htmlspecialchars($item['tgl_lunas']).'"
                            data-tenor_piutang="'.htmlspecialchars($item['tenor_piutang']).'"disabled>
                             PAY 
                        </button>
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-piutang" onclick="handleDeleteButton('.htmlspecialchars($item['id_piutang']).')" style="width : 70px">
                            DELETE
                        </button>
                    ' :  
                    '   
                        <button 
                            class="btn btn-warning btn-sm mb-2 rounded-pill btn-pay-piutang" style="width : 70px"
                            data-bs-toggle="modal" 
                            data-bs-target="#payPiutangModal"
                            data-id_piutang="'.htmlspecialchars($item['id_piutang']).'"
                            data-remaining_piutang="'.htmlspecialchars($item['remaining_piutang']).'"
                            data-tgl_lunas="'.htmlspecialchars($item['tgl_lunas']).'"
                            data-tenor_piutang="'.htmlspecialchars($item['tenor_piutang']).'">
                             PAY
                        </button>
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-piutang" onclick="handleDeleteButton('.htmlspecialchars($item['id_piutang']).')" style="width : 70px">
                            DELETE
                        </button>
                     '
                    ;
            
            $progress = $item['progress_piutang'] == 2 ?
                            '
                                <td>
                                    <a href="javascript:void(0)" onclick="setProgress(this)" class="btn btn-info btn-sm rounded-pill btn-progress" 
                                    data-id_piutang=" '. htmlspecialchars($item['id_piutang']) .'" 
                                    data-progress_piutang="'. htmlspecialchars($item['progress_piutang']).'">
                                        <i class="bi bi-clock-history"></i>
                                    </a>
                                </td>
                             '
                                :
                            '
                                <td>
                                    <a href="javascript:void(0)" onclick="setProgress(this)" class="btn btn-success btn-sm rounded-pill btn-progress"
                                    data-id_piutang=" '. htmlspecialchars($item['id_piutang']) .'" 
                                    data-progress_piutang="'. htmlspecialchars($item['progress_piutang']).'">
                                        <i class="bi bi-check-lg"></i>
                                    </a>
                                </td>
                             '
                          ;
            
            $status = $item['status_piutang'] == 2 ?
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
                           '
                        ;
          
            $row = [];
            $row[] = ++$no;  
            $row[] = date('d M Y', strtotime($item['piutang_date']));  
            $row[] = $item['name'];  
            $row[] = $item['type_piutang'] == '2' ? 'Kasbon' : 'Pinjaman';  
            $row[] = $item['tenor_piutang'] . ' ' . 'Bulan';  
            $row[] = date('d M Y', strtotime($item['tgl_lunas']));  
            $row[] = 'Rp.'. number_format($item['amount_piutang'], 0 , ',', '.');  
            $row[] = 'Rp.'. number_format($item['remaining_piutang'], 0 , ',', '.');  
            $row[] = $status;
            $row[] = $progress;;  
            $row[] = $item['description_piutang'];  
            $row[] = $action;  
            $data[] = $row;
        }
    
        $output = [
            "draw" =>@$_POST['draw'],
            "recordsTotal" => count($list),  
            "recordsFiltered" => count($list),  
            "tenor" => $tenor,
            "type" => $type,
            "data" => $data,
        ];
    
        echo json_encode($output);
    }


    public function pay_logs() 
    {
   
        $id = $this->input->post('id_piutang');


        if (!$id) {
            echo json_encode([
                'status' => false,
                'message' => 'ID tidak valid.',
            ]);
            return;
        }

        $logs = $this->m_Purchase_piutang->findByPiutangId_get($id);

        
        echo json_encode([
            'status' => true,
            'logs' => $logs,
        ]);
    }


    public function add_pay()
    {
        $this->_isAjax();
        $this->_ONLY_SU();


        $this->form_validation->set_rules('id_piutang', 'id_piutang', 'required', [
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

        $id_piutang = $this->input->post('id_piutang', true);
        $amount = $this->input->post('pay_amount', true);

        $piutang = $this->m_Piutang->findById_get($id_piutang);

        if($amount > $piutang['remaining_piutang']) {
            $response = [
                'status' => false,
                'message' => 'Amount tidak boleh melebihi sisa',
            ];
            echo json_encode($response);
            return;
        }

        $change_status = $piutang['remaining_piutang'] - $amount;

        if($change_status == 0 || $change_status < 1 ) {
            $this->m_Piutang->setStatus_post($id_piutang, 1);
           
        }

        $this->m_Piutang->updateRemaining_post($id_piutang, $change_status);

        $data = [
            'id_piutang' => $this->input->post('id_piutang', true),
            'pay_date' => $this->input->post('pay_date', true),
            'pay_amount' => $this->input->post('pay_amount', true),
            'description' => $this->input->post('description', true),
        ];

        $piutang_payment = $this->m_Purchase_piutang->create_post($data);

        if ($piutang_payment) {
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

    public function set_progress()
    {
  
        $this->_ONLY_SU();
        $this->_isAjax();
  
        $id = $this->input->post('id_piutang', true);
  
        
        $this->form_validation->set_rules('progress_piutang', 'Progress', 'required', [
          'required' => 'Progress harus diisi',
        ]);
  
  
        if($this->form_validation->run() == false) {
          $response = [
            'status' => false,
            'message' => validation_errors('<p>' , '</p>'),
            'confirmationbutton' => true,
            'timer' => 0,
            'icon' => 'error'
          ];
  
          echo json_encode($response);
  
          return;
        }
  
  
      
         $setstatus = $this->input->post('progress_piutang', true);
  
  
        if ($this->m_Piutang->setProgress_post($id, $setstatus)) {
          $response = [
              'status' => true,
              'message' => 'Progress berhasil diperbarui.'
          ];
      } else {
          $response = [
              'status' => false,
              'message' => 'Gagal memperbarui Porgress.'
          ];
      }
  
      echo json_encode($response);
      return;
  
    }

//-------------------------------PAID
    public function piutang_paid_page()
    {
        $this->_ONLYSELECTED([1,2]);
        $data = $this->_basicData();

        $data['title'] = 'Piutang';
        $data['view_name'] = 'admin/piutang_paid';
        $data['breadcrumb'] = 'Piutang';
        $data['menu'] = '';

        $data['employee'] = $this->m_Employees->findAll_get();
        $data['piutang'] = $this->m_Piutang->findAllJoin_get();


        if($data['user']){
            $this->load->view('templates/index',$data);
        } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
        }

    }

    public function dtSideServer_paid() 
    {

        $type = $this->input->post('type'); 
    
        $list = $this->m_Piutang->getPiutangWithPaid_get($type);
        
        $data = [];
        $no = $this->input->post('start');  
    
        foreach($list as $item) {
            $action = $item['progress_piutang'] == 2 ? 
                    '   
                        <button 
                            class="btn btn-warning btn-sm mb-2 rounded-pill btn-pay-piutang" style="width : 70px"
                            data-bs-toggle="modal" 
                            data-bs-target="#logPiutangModal"
                            data-id_piutang="'.htmlspecialchars($item['id_piutang']).'" disabled>
                             LOG
                        </button>
                        <button 
                            class="btn btn-warning btn-sm mb-2 rounded-pill btn-print" style="width : 70px"
                            data-id_employee="'.htmlspecialchars($item['name']).'"
                            data-id_position="'.htmlspecialchars($item['name_position']).'"
                            data-nip="'.htmlspecialchars($item['nip']).'"
                            data-amount_piutang="'.htmlspecialchars($item['amount_piutang']).'"
                            data-description_piutang="'.htmlspecialchars($item['description_piutang']).'"
                            data-tgl_lunas="'.htmlspecialchars($item['tgl_lunas']).'"
                            data-piutang_date="'.htmlspecialchars($item['piutang_date']).'">
                            PRINT
                        </button>
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-emp" onclick="handleDeleteButton('.htmlspecialchars($item['id_piutang']).')" style="width : 70px">
                            DELETE
                        </button>
                    ' :  
                    '   
                        <button 
                            class="btn btn-warning btn-sm mb-2 rounded-pill btn-pay-piutang" style="width : 70px"
                            data-bs-toggle="modal" 
                            data-bs-target="#payPiutangModal"
                            data-id_piutang="'.htmlspecialchars($item['id_piutang']).'">
                             LOG
                        </button>
                        <button 
                            class="btn btn-warning btn-sm mb-2 rounded-pill btn-print" style="width : 70px"
                            data-id_employee="'.htmlspecialchars($item['name']).'"
                            data-id_position="'.htmlspecialchars($item['name_position']).'"
                            data-nip="'.htmlspecialchars($item['nip']).'"
                            data-amount_piutang="'.htmlspecialchars($item['amount_piutang']).'"
                            data-description_piutang="'.htmlspecialchars($item['description_piutang']).'"
                            data-tgl_lunas="'.htmlspecialchars($item['tgl_lunas']).'"
                            data-piutang_date="'.htmlspecialchars($item['piutang_date']).'">
                            PRINT
                        </button>
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-emp" onclick="handleDeleteButton('.htmlspecialchars($item['id_piutang']).')" style="width : 70px">
                            DELETE
                        </button>
                     '
                    ;
            
            $progress = $item['progress_piutang'] == 2 ?
                            '
                                <td>
                                    <a href="javascript:void(0)" onclick="setProgress(this)" class="btn btn-info btn-sm rounded-pill btn-progress" 
                                    data-id_piutang=" '. htmlspecialchars($item['id_piutang']) .'" 
                                    data-progress_piutang="'. htmlspecialchars($item['progress_piutang']).'">
                                        <i class="bi bi-clock-history"></i>
                                    </a>
                                </td>
                             '
                                :
                            '
                                <td>
                                    <a href="javascript:void(0)" onclick="setProgress(this)" class="btn btn-success btn-sm rounded-pill btn-progress"
                                    data-id_piutang=" '. htmlspecialchars($item['id_piutang']) .'" 
                                    data-progress_piutang="'. htmlspecialchars($item['progress_piutang']).'">
                                        <i class="bi bi-check-lg"></i>
                                    </a>
                                </td>
                             '
                          ;
            
            $status = $item['status_piutang'] == 2 ?
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
                           '
                        ;
          
            $row = [];
            $row[] = ++$no;  
            $row[] = date('d M Y', strtotime($item['piutang_date']));  
            $row[] = $item['name'];  
            $row[] = $item['type_piutang'] == '2' ? 'Kasbon' : 'Pinjaman';  
            $row[] = $item['tenor_piutang'] == '2' ? '1 Bulan' : '2 Bulan';  
            $row[] = date('d M Y', strtotime($item['tgl_lunas']));  
            $row[] = 'Rp.'. number_format($item['amount_piutang'], 0 , ',', '.');  
            $row[] = 'Rp.'. number_format($item['remaining_piutang'], 0 , ',', '.');  
            $row[] = $status;
            $row[] = $progress;;  
            $row[] = $item['description_piutang'];  
            $row[] = $action;  
            $data[] = $row;
        }
    
        $output = [
            "draw" =>@$_POST['draw'],
            "recordsTotal" => count($list),  
            "recordsFiltered" => count($list),  
            "type" => $type,
            "data" => $data,
        ];
    
        echo json_encode($output);
    }
     

    public function delete()
    {
        $this->_isAjax();
        $this->_ONLY_SU();

        $id = $this->input->post('id');
        


        if($this->m_Piutang->delete($id) && $this->m_Purchase_piutang->deleteByPiutangId_get($id) ){
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


    //---------------------------------------- V2  

    
   
}
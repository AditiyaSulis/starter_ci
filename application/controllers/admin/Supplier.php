<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends MY_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_Supplier');
    $this->load->model('m_Purchases');
  }


  public function data_supplier_page()
  {

    $this->_ONLYSELECTED([1,2]);
    $data =  $this->_basicData();

    $data['supplier'] = $this->m_Supplier->findAll_get();

    $data['title'] = 'Supplier';
    $data['Supplier'] = 'Supplier';
    $data['view_name'] = 'admin/supplier';
    $data['breadcrumb'] = 'Supplier - Data';
    $data['menu'] = 'Supplier';

      if($data['user']) {
        $this->load->view('templates/index', $data);
      } else {
        $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
        redirect('fetch/login');
      }
    
  }


  public function add_supplier()
  {

      $this->_ONLY_SU();
      $this->_isAjax();

      $this->form_validation->set_rules('name_supplier', 'name_supplier', 'required|min_length[3]|max_length[50]|is_unique[supplier.name_supplier]', [
        'required' => 'Nama harus diisi',
        'min_length' => 'Nama minimal memiliki 3 karakter',
        'max_length' => 'Nama tidak boleh melebihi 50 karakter',
        'is_unique' => 'Nama untuk supplier sudah digunakan'
      ]);

      $this->form_validation->set_rules('status_supplier', 'status_supplier', 'required', [
        'required' => 'Status harus diisi',
      ]);

      $this->form_validation->set_rules('contact_info', 'contact_info', 'required|min_length[3]|max_length[50]', [
        'required' => 'Contact harus diisi',
        'min_length' => 'Contact minimal memiliki 3 karakter',
        'max_length' => 'Contact tidak boleh melebihi 50 karakter',
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

      $data = [
        'name_supplier' => $this->input->post('name_supplier', true),
        'contact_info' => $this->input->post('contact_info', true),
        'status_supplier' => $this->input->post('status_supplier', true),
      ];

      $supplier = $this->m_Supplier->create_post($data);

      if($supplier){
        $response = [
          'status' => true,
          'message' =>  'Supplier berhasil ditambahkan',
        ];
      } else {
        $response = [
          'status' => true,
          'message' => 'Supplier gagal ditambahkan',
        ];
      }

      echo json_encode($response);

  }


  public function update()
  {

      $this->_ONLY_SU();
      $this->_isAjax();

      $id = $this->input->post('id_supplier', true);
      $newname = $this->input->post('name_supplier', true);
      $supname = $this->m_Supplier->findById_get($id);
      $oldname = $supname['name_supplier'];
      
      $this->form_validation->set_rules('name_supplier', 'name_supplier', 'required|min_length[3]|max_length[50]', [
        'required' => 'Nama harus diisi',
        'min_length' => 'Nama minimal memiliki 3 karakter',
        'max_length' => 'Nama tidak boleh melebihi 50 karakter',
      ]);

      $this->form_validation->set_rules('status_supplier', 'status_supplier', 'required', [
        'required' => 'Status harus diisi',
      ]);

      $this->form_validation->set_rules('contact_info', 'contact_info', 'required|min_length[3]|max_length[50]', [
        'required' => 'Contact harus diisi',
        'min_length' => 'Contact minimal memiliki 3 karakter',
        'max_length' => 'Contact tidak boleh melebihi 50 karakter',
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

      if($oldname != $newname) {
        if($this->m_Supplier->findByName_get($newname)) {
          $response = [
            'status' => false,
            'message' => 'Nama untuk supplier sudah digunakan'
          ];
          echo json_encode($response);

          return;
        }
      }

      $data = [
        'name_supplier' => $this->input->post('name_supplier', true),
        'contact_info' => $this->input->post('contact_info', true),
        'status_supplier' => $this->input->post('status_supplier', true),
      ];

      if ($this->m_Supplier->update_post($id, $data)) {
        $response = [
            'status' => true,
            'message' => 'Supplier berhasil diperbarui.'
        ];
    } else {
        $response = [
            'status' => false,
            'message' => 'Gagal memperbarui supplier.'
        ];
    }

    echo json_encode($response);
    return;

  }

  
  public function delete()
  {
       $this->_ONLY_SU();
        $this->_isAjax();
        
        $id = $this->input->post('id_supplier');
        
        if($this->m_Purchases->findBySupplierId_get($id)){
            $response = [
                'status' => false,
                'message' => 'Supplier ini tidak bisa dihapus karena memiliki relasi dengan tabel lain' 
            ];
            echo json_encode($response);
            return;
        }

      

        if($this->m_Supplier->delete($id)){
            $response = [
                'status' => true,
                'message' => 'Supplier berhasil dihapus',
            ];
        } else {
            $response = [
               'status' => false,  
               'message' => 'Supplier gagal dihapus',  
            ];
        }
        
        echo json_encode($response);

  }
  

  public function set_status()
  {

      $this->_ONLY_SU();
      $this->_isAjax();

      $id = $this->input->post('id_supplier', true);

      
      $this->form_validation->set_rules('status_supplier', 'status_supplier', 'required', [
        'required' => 'Status harus diisi',
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


    
       $setstatus = $this->input->post('status_supplier', true);


      if ($this->m_Supplier->setStatus_post($id, $setstatus)) {
        $response = [
            'status' => true,
            'message' => 'Status berhasil diperbarui.'
        ];
    } else {
        $response = [
            'status' => false,
            'message' => 'Gagal memperbarui Status.'
        ];
    }

    echo json_encode($response);
    return;

  }

}



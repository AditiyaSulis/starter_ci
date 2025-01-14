<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MY_Controller{

    function __construct()
    {
        parent::__construct();

        $this->load->model('m_Setting');
        $this->load->library('upload');
    }


    public function setting_page()
    {
       $this->_ONLYSELECTED([1,2]);
       $data = $this->_basicData();

       $data['title'] = 'Setting';
       $data['view_name'] = 'admin/setting';
       $data['breadcrumb'] = 'Setting - Company Profile';
      
       $data['cp'] = $this->m_Setting->findAll_get();
       
       if($data['user']) {
            $this->load->view('templates/index', $data);
       } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
            redirect('fetch/login');
       }
        
    }
    

    public function update()
    {
        $this->_ONLY_SU();
        $this->_isAjax();
    
        $id = $this->input->post('id', true);
    
        
        $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[3]|max_length[50]', [
            'required' => 'Nama harus diisi',
            'min_length' => 'Nama minimal harus mempunyai 3 huruf',
            'max_length' => 'Nama tidak boleh melebihi 50 karakter',
        ]);
        $this->form_validation->set_rules('contact', 'contact', 'trim|required|min_length[3]|max_length[50]', [
            'required' => 'Contact harus diisi',
            'min_length' => 'Contact minimal harus mempunyai 3 huruf',
            'max_length' => 'Contact tidak boleh melebihi 50 karakter',
        ]);
        $this->form_validation->set_rules('address', 'address', 'trim|required|min_length[3]|max_length[100]', [
            'required' => 'Address harus diisi',
            'min_length' => 'Address minimal harus mempunyai 3 huruf',
            'max_length' => 'Address tidak boleh melebihi 100 karakter',
        ]);
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email', [
            'required' => 'Email harus diisi',
            'valid_email' => 'Email tidak valid',
        ]);
    
        if ($this->form_validation->run() === FALSE) {
            echo json_encode(['status' => false, 'message' => validation_errors('<p>', '</p>')]);
            return;
        }
    
       
        $data = [
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'email' => $this->input->post('email'),
            'contact' => $this->input->post('contact'),
        ];

        
        
        if (!empty($_FILES['logo']['name'])) {
            $product = $this->m_Setting->findById_get($id);
            if ($product && !empty($product['logo'])) {
                $old_logo_path = './uploads/logos/' . $product['logo'];
                if (file_exists($old_logo_path)) {
                    unlink($old_logo_path);
                }
            }
           
          
            $this->load->helper('image_helper');
            $upload_path = './logos/';
            $resize_width = 500;
            $resize_height = 500;
            $resize_quality = 60;
    
            $upload_result = upload_and_resize('logo', $upload_path, $resize_width, $resize_height, $resize_quality);
    
            if (!$upload_result['status']) {
                echo json_encode(['status' => false, 'message' => $upload_result['message']]);
                return;
            }
    
            $data['logo'] = $upload_result['message'];
        } else {
            $product = $this->m_Setting->findById_get($id);
            $old_logo_path = './uploads/logos/' . $product['logo'];
                if (file_exists($old_logo_path)) {
                    unlink($old_logo_path);
                }
            $data['logo'] = $this->input->post('logo_remove');
        }
    
      
        if ($this->m_Setting->update_post($id, $data)) {
            echo json_encode(['status' => true, 'message' => 'Profile berhasil diperbarui.']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Gagal memperbarui profile.']);
        }
    }
    

}
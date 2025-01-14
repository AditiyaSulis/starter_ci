<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_Products');
        $this->load->model('m_Employees');
        $this->load->model('m_Finance_records');
        $this->load->library('upload');

    }


    public function product_page()
    {
        $this->_ONLYSELECTED([1,2]);
        $data = $this->_basicData();
        $data['products'] = $this->m_Products->findAll_get();
       
        $data['title'] = 'Product';
        $data['view_name'] = 'admin/products';
        $data['breadcrumb'] = 'Product';
        if($data['user']){
                $this->load->view('templates/index', $data);
            } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
            redirect('fetch/login');
        }
    }


    public function add_products()
    {
        $this->_ONLY_SU();
        $this->_isAjax();
        $this->form_validation->set_rules('name_product', 'Name_product', 'trim|required|min_length[3]|max_length[40]', [
            'required' => 'Nama harus diisi',
            'min_length' => 'Nama minimal harus mempunyai 3 huruf',
            'max_length' => 'Nama tidak boleh melebihi 40 karakter',
        ]);
        
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[4]', [
            'required' => 'Deskripsi harus diisi',
            'min_length' => 'Deskripsi minimal 4 huruf',
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

        $this->load->helper('image_helper');

        $upload_path = 'products/compressed'; 
        $resize_width = 500;
        $resize_height = 500;
        $resize_quality = 60;

        $upload_result = upload_and_resize('logo', $upload_path, $resize_width, $resize_height, $resize_quality);

        if (!$upload_result['status']) {
            $response = [
                'status' => false,
                'message' => $upload_result['message'],
            ];
            echo json_encode($response);
            return;
        }

        $logo_name = $upload_result['message'];

        $data = [
            'name_product' => $this->input->post('name_product', true),
            'description' => $this->input->post('description', true),
            'url' => $this->input->post('url', true),
            'logo' => $logo_name,
        ];

        $product = $this->m_Products->create_post($data);

        if ($product) {
            $response = [
                'status' => true,
                'message' => 'Product berhasil ditambahkan',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Product gagal ditambahkan',
            ];
        }

        echo json_encode($response);
    }


    public function update() 
    {
        $this->_ONLY_SU();
        $this->_isAjax();
        
        $id = $this->input->post('id_product', true);
        $name = $this->input->post('name_product', true);
        $description = $this->input->post('description', true);
        $url = $this->input->post('url', true);

        $this->form_validation->set_rules('name_product', 'Product Name', 'trim|required|min_length[3]|max_length[40]', [
            'required' => 'Nama harus diisi',
            'min_length' => 'Nama minimal harus mempunyai 3 huruf',
            'max_length' => 'Nama tidak boleh melebihi 40 karakter',
        ]);
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[4]', [
            'required' => 'Deskripsi harus diisi',
            'min_length' => 'Deskripsi minimal 4 huruf',
        ]);
    
        if ($this->form_validation->run() === FALSE) {
            $response = [
                'status' => false,
                'message' => validation_errors('<p>', '</p>')
            ];
            echo json_encode($response);
            return;
        }
    
        if (empty($_FILES['logo']['name'])) {
            $data = [
                'name_product' => $name,
                'description' => $description,
                'url' => $url,
            ];
    
            if ($this->m_Products->update_post($id, $data)) {
                $response = [
                    'status' => true,
                    'message' => 'Product berhasil diperbarui.'
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Gagal memperbarui product.'
                ];
            }
            echo json_encode($response);
            return;
        }
    
        $product = $this->m_Products->findById_get($id);
        if ($product && !empty($product['logo'])) {
            $old_logo_path = './uploads/products/compressed/' . $product['logo'];
            if (file_exists($old_logo_path)) {
                unlink($old_logo_path); 
        }
    
        $this->load->helper('image_helper');
        $upload_path = 'products/compressed';
        $resize_width = 500;
        $resize_height = 500;
        $resize_quality = 60;
    
        $upload_result = upload_and_resize('logo', $upload_path, $resize_width, $resize_height, $resize_quality);
    
        if (!$upload_result['status']) {
            $response = [
                'status' => false,
                'message' => $upload_result['message'],
            ];
            echo json_encode($response);
            return;
        }
    
        $logo_name = $upload_result['message'];
        $data = [
            'name_product' => $name,
            'description' => $description,
            'url' => $url,
            'logo' => $logo_name
        ];
    
        if ($this->m_Products->update_post($id, $data)) {
            $response = [
                'status' => true,
                'message' => 'Product berhasil diperbarui.'
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Gagal memperbarui product.'
            ];
        }
    
        echo json_encode($response);
        return;

        }
    }


    public function delete()
    {
        $this->_ONLY_SU();
        $this->_isAjax();
        
        $id = $this->input->post('id_product');
        
        if($this->m_Finance_records->findByProductId_get($id) || $this->m_Employees->findByProductId_get($id) ){
            $response = [
                'status' => false,
                'message' => 'Product ini tidak bisa dihapus karena memiliki relasi dengan tabel lain ' 
            ];
            echo json_encode($response);
            return;
        }

        $product = $this->m_Products->findById_get($id);

        if ($product) {

            if (isset($product['logo']) && !empty($product['logo'])) {
                $imagePath = './uploads/products/compressed/' . $product['logo'];
                if (file_exists($imagePath)) {
                    unlink($imagePath); 
                }
                
            }

        }

        if($this->m_Products->delete($id)){
            $response = [
                'status' => true,
                'message' => 'Product berhasil dihapus',
            ];
        } else {
            $response = [
               'status' => false,  
               'message' => 'Product gagal dihapus',  
            ];
        }
        
        echo json_encode($response);

    }
    

    public function set_visibility()
    {
  
        $this->_ONLY_SU();
        $this->_isAjax();
  
        $id = $this->input->post('id_product', true);
  
        
        $this->form_validation->set_rules('visibility', 'visibility', 'required', [
          'required' => 'Visibility harus diisi',
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
  
  
      
         $setstatus = $this->input->post('visibility', true);
  
  
        if ($this->m_Products->setVisibility_post($id, $setstatus)) {
          $response = [
              'status' => true,
              'message' => 'Visibility berhasil diperbarui.'
          ];
      } else {
          $response = [
              'status' => false,
              'message' => 'Gagal memperbarui Visibility.'
          ];
      }
  
      echo json_encode($response);
      return;
  
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('m_Products');
        $this->load->model('m_Admin');
        $this->load->library('upload');


    }

    public function products(){
        $id = $this->session->userdata('user');
        $user = $this->m_Admin->findById($id);
        $products = $this->m_Products->get_all();
        if($user){
            if($user['role'] == 2){
                $this->load->view('templates/header', ['user'=> $user, 'products' => $products]);
                $this->load->view('admin/products');
                $this->load->view('templates/footer');
            } else {
                redirect('admin/dashboard/dashboard_page');
            }
        } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
            redirect('fetch/login');
        }
    }

    public function add_products()
    {
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
        
            $config['upload_path'] =  './uploads/products/';
            $config['allowed_types'] = 'gif|png|jpg|jpeg';
            $config['max_size'] = 2048;
            $config['file_name'] = time() . '_' . $_FILES['logo']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('logo')) {
                $response = [
                    'status' => false,
                    'message' => $this->upload->display_errors('', ''),
                ];
                echo json_encode($response);
                return;
            }

            $file_data = $this->upload->data(); 
            $logo_name = $file_data['file_name'];

            $compressed_path = './uploads/products/compressed/';
            if (!is_dir($compressed_path)) {
                mkdir($compressed_path, 0755, true);
            }

            $config['image_library'] = 'gd2'; 
            $config['source_image'] = $file_data['full_path'];
            $config['new_image'] = $compressed_path; 
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 800; 
            $config['height'] = 800; 
            $config['quality'] = '60%';

            $this->load->library('image_lib', $config);

            if (!$this->image_lib->resize()) {
                $response = [
                    'status' => false,
                    'message' => $this->image_lib->display_errors('', ''),
                ];
                echo json_encode($response);
                return;
            }

            $compressed_image_path = $config['new_image'] . $logo_name;

            $data = [
                'name_product' => $this->input->post('name_product', true),
                'description' => $this->input->post('description', true),
                'url' => $this->input->post('url', true),
                'logo' => $logo_name,
            ];

            $product = $this->m_Products->create($data);

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


}
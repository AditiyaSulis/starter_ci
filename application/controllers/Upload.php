<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('m_Admin');
        $this->load->library('upload');


    }

    public function do_upload(){
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|png|pdf|jpg|jpeg';
        $config['max_size'] = 2048;
        $config['file_name'] = time().'_'.$_FILES['userfile']['name'];

        $this->upload->initialize($config);

        if($this->upload->do_upload('userfile')){
            $file_data = $this->upload->data();
            $data = [
                'file_name' => $file_data['file_name'],
                'file_type' => $file_data['file_type'],
                'file_path' => $file_data['file_path'],
            ];

            $this->session->set_flashdata('success', 'Berhasil di upload'. $file_data['file_name']);
            redirect('super_user/super_user/super_user_page');
        } else {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('super_user/super_user/super_user_page');
        }
    }


}
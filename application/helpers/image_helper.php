<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function upload_and_resize($field_name, $path, $width, $height, $quality = 60) {
	$CI =& get_instance();

	// Upload konfigurasi
	$config['upload_path'] = FCPATH.'uploads/' . $path; // path image, bisa di sesuaikan
	$config['allowed_types'] = 'jpg|jpeg|png|webp';
	$config['encrypt_name'] = true;
	$config['max_size'] = 1000;
	$CI->load->library('upload', $config);
	$CI->upload->initialize($config);

	if (!$CI->upload->do_upload($field_name)) {
		return [
			'status' => false,
			'message' => $CI->upload->display_errors()
		];
	}

	$file = $CI->upload->data();

	// Resize konfigurasi
	$resize_config['image_library'] = 'gd2';
	$resize_config['source_image'] = $file['full_path'];
	$resize_config['create_thumb'] = FALSE;
	$resize_config['maintain_ratio'] = FALSE;
	$resize_config['quality'] = "$quality%";
	$resize_config['width'] = $width;
	$resize_config['height'] = $height;
	$CI->load->library('image_lib', $resize_config);

	if (!$CI->image_lib->resize()) {
		return [
			'status' => false,
			'message' => $CI->upload->display_errors()
		];
	}
	return [
		'status' => true,
		'message' => $file['file_name']
	];
}
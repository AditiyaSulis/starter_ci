<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('validate_api_key')) {
    function validate_api_key() {
        $ci =& get_instance();
        $ci->load->config('rest');
        $rest_key_name = $ci->config->item('rest_key_name');
        $key = $ci->input->get_request_header('API-Key');
        if ($key !== $rest_key_name) {
            $ci->output
                ->set_status_header(401)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => false,
                    'message' => 'Invalid API Key'
                ]))
                ->_display();
            exit;
        }
    }
}

if (!function_exists('validate_hattps')) {
    function validate_hattps() {
        $ci =& get_instance();
        if (!$ci->input->server('HTTPS') || $ci->input->server('HTTPS') != 'on') {
            $ci->output
                ->set_status_header(403)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => false,
                    'message' => 'The page has been removed permanently'
                ]))
                ->_display();
            exit;
        }
    }
}

if (!function_exists('validate_domain')) {
    function validate_domain($allowed_domains) {
        $ci =& get_instance();
        $origin = $ci->input->get_request_header('Origin');
        if (!in_array($origin, $allowed_domains)) {
            $ci->output
                ->set_status_header(403)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => false,
                    'message' => 'Invalid origin'
                ]))
                ->_display();
            exit;
        }
    }
}

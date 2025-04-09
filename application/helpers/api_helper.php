<?php

function api_key(): string
{
	return 'mgr-api-10519190';
}


function validate_key()
{
	$CI =& get_instance();
	$apiKey = $CI->input->get_request_header('X-API-KEY', true);
	if ($apiKey !== api_key()) {
		responseApi(401, 'Unauthorized');
	}
}


function validate_https()
{
	if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
		responseApi(301, 'a page has been permanently moved to a new location');
	}
}


function validate_origin()
{
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
	header("Access-Control-Allow-Headers: Content-Type, Authorization, X-API-KEY");
	//	$allowed_origins = [
	//		'*',
	//	];
	//
	//	$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
	//	if (in_array($origin, $allowed_origins)) {
	//		header("Access-Control-Allow-Origin: $origin");
	//		header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
	//		header("Access-Control-Allow-Headers: Content-Type, Authorization, X-API-KEY");
	//	} else {
	//		responseApi(403, 'Access forbidden: Origin not allowed');
	//	}
}


function validate_header()
{
	//validate_https();
	//validate_origin();
	//validate_key();
}


function responseApi($http_code, $message, $data = null)
{
	$CI = &get_instance();
	$response = [
		'status' => $http_code === 200,
		'message' => $message,
	];
	if (!is_null($data)) {
		$response['data'] = $data;
	}
	$CI->response($response, $http_code);
}


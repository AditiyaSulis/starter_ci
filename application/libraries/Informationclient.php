<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informationclient {
	private $CI;

	public function __construct() {
		$this->CI =& get_instance();
	}
	public function ipclient(){
		if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
			$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
		} else {
			$ip = $this->CI->input->ip_address();
			if(empty($ip) || $ip == '::1'){
				$ip = '127.0.0.1';
			}
		}
		return $ip;
	}
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_user_ip')) {
	function get_user_ip()
	{
		$ipaddress = '';

		if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
			// Jika pakai Cloudflare
			$ipaddress = $_SERVER['HTTP_CF_CONNECTING_IP'];
		} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			// Jika lewat proxy
			$ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			$ipaddress = trim(end($ipList));
		} elseif (isset($_SERVER['REMOTE_ADDR'])) {
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		} else {
			$ipaddress = 'UNKNOWN';
		}

		// Pastikan hanya IPv4 yang diambil
		if (filter_var($ipaddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
			return $ipaddress;
		} else {
			return '0.0.0.0';
		}
	}
}

if (!function_exists('match_ip')) {
	function match_ip($ip)
	{
		// Prefix IP yang ingin kamu cocokkan (misalnya jaringan tertentu)
		$allowed_prefix = '182.253.128';

		// Ambil prefix dari IP client sepanjang prefix yang ingin dicocokkan
		$ip_prefix = substr($ip, 0, strlen($allowed_prefix));

		// Bandingkan
		return $ip_prefix === $allowed_prefix;
	}
}

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
		// Daftar prefix IP yang diizinkan
		$allowed_prefixes = [
			'182.253.128',  // jaringan kantor
			'180.252.122',
		];

		foreach ($allowed_prefixes as $prefix) {
			$ip_prefix = substr($ip, 0, strlen($prefix));
			similar_text($ip_prefix, $prefix, $percent);

			// Jika kemiripan lebih dari 90%, anggap cocok
			if ($percent >= 90) {
				return true;
			}
		}

		return false;
	}
}

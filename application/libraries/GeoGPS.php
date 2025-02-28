<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class GeoGPS {
	public function __construct()
	{
		require_once APPPATH . 'libraries/geoPHP/geoPHP.inc'; // Sesuaikan path jika perlu
	}

	public function load($wkt, $format = 'wkt')
	{
		return geoPHP::load($wkt, $format);
	}
}
?>

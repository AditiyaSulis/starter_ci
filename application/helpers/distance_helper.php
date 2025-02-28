<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('haversine_distance')) {
	function haversine_distance($lat1, $lon1, $lat2, $lon2, $unit = "km")
	{
		$earth_radius_km = 6371;
		$earth_radius_mi = 3958.8;

		$dLat = deg2rad($lat2 - $lat1);
		$dLon = deg2rad($lon2 - $lon1);

		$a = sin($dLat / 2) * sin($dLat / 2) +
			cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
			sin($dLon / 2) * sin($dLon / 2);

		$c = 2 * atan2(sqrt($a), sqrt(1 - $a));

		$radius = ($unit == "mi") ? $earth_radius_mi : $earth_radius_km;
		return $radius * $c; // Hasil dalam km atau mil
	}


	function haversine_distance_in_meter($lat1, $lon1, $lat2, $lon2) {
		$earth_radius = 6371000;

		$lat1 = deg2rad($lat1);
		$lon1 = deg2rad($lon1);
		$lat2 = deg2rad($lat2);
		$lon2 = deg2rad($lon2);

		$dlat = $lat2 - $lat1;
		$dlon = $lon2 - $lon1;

		$a = sin($dlat / 2) * sin($dlat / 2) +
			cos($lat1) * cos($lat2) *
			sin($dlon / 2) * sin($dlon / 2);

		$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
		return round($earth_radius * $c);
	}

}

<?php
if (!function_exists('bulatkan_ribuan')) {
	/**
	 * Membulatkan angka ke ribuan terdekat
	 * Aturan:
	 *  - >= .500 -> naik
	 *  - < .500 -> turun
	 *
	 * @param float|int $angka
	 * @return int
	 */
	function bulatkan_ribuan($angka) {
		$sisa = $angka % 1000;       // ambil sisa pembagian 1000
		$dasar = $angka - $sisa;     // ribuan dasar (166000)

		if ($sisa > 500) {
			return $dasar + 1000;    // naik ke ribuan berikutnya
		} elseif ($sisa < 500) {
			return $dasar;           // tetap di ribuan dasar
		} else {
			return $dasar;           // kalau pas 500 → turun
		}
	}
}

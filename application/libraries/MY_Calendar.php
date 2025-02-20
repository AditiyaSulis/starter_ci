<?php
class MY_Calendar extends CI_Calendar {
	public function get_day_names($day_type = '') {
		return array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
	}
}

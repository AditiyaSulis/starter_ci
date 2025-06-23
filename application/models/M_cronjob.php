<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_schedule extends CI_Model
{

public function mark_absent_if_no_checkin() {
				$currentDate = date('Y-m-d');

				$this->db->where('status', 1);
				$this->db->where('waktu <', $currentDate);
				$this->db->update('schedule', ['status' => 7]);
	}
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_location extends CI_Model {
	public function get_location($id)
	{
		return $this->db->get_where('location', ['id_location' => $id])->row_array();
	}
}

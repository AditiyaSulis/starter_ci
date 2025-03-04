<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_artikel extends CI_Model {

	public function get_all_artikels() {
		return $this->db->get('documentation')->result_array();
	}

	public function get_note_by_id($id) {
		return $this->db->get_where('documentation', ['id_documentation' => $id])->row_array();
	}

	public function create_post($data) {
		return $this->db->insert('documentation', $data);
	}

	public function update_note($id, $data) {
		$this->db->where('id_documentation', $id);
		return $this->db->update('documentation', $data);
	}

	public function delete_note($id) {
		return $this->db->delete('documentation', ['id_documentation' => $id]);
	}
}

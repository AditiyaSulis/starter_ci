<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_product_homepage extends CI_Model {
	public function create_post($data)
	{
		if ($this->db->insert('product_homepage', $data)) {
			return true;
		} else {
			return false;
		}
	}


	public function findById_get($id)
	{
		if (!is_numeric($id)) {
			return null;
		}

		$this->db->where('id_product_homepage', $id);
		$query = $this->db->get('product_homepage');

		if ($query->num_rows() > 0) {
			return $query->row_array();
		}

		return null;
	}



	public function findAll_get()
	{
		$this->db->order_by('name', 'ASC');
		return $this->db->get('product_homepage')->result_array();
	}


	public function delete($id)
	{
		return $this->db->delete('product_homepage', ['id_product_homepage' => $id]);
	}


	public function update_post($id, $data)
	{
		$this->db->where('id_product_homepage', $id);
		return $this->db->update('product_homepage', $data);
	}


	public function totalProducts_get()
	{
		$count =  $this->db->get('product_homepage')->num_rows();

		return $count;
	}


}

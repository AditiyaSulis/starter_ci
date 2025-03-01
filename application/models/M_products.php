<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_products extends CI_Model {
    public function create_post($data)
    {
        if ($this->db->insert('products', $data)) {
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

        $this->db->where('id_product', $id);
        $query = $this->db->get('products'); 

        if ($query->num_rows() > 0) {
            return $query->row_array();  
        }
        
        return null;
    }



	public function findByIdWithJoin_get($id)
	{
		$this->db->select('products.id_product, products.id_location, products.name_product, products.description, products.logo, products.url, products.status, products.visibility, location.id_location, location.name_location, location.latitude, location.longitude');
		$this->db->from('products');
		$this->db->join('location', 'location.id_location = products.id_location', 'left');


		return $this->db->get()->row_array();
	}

    public function findAllShow_get() 
    {

        $this->db->where('visibility', 1);
        $this->db->order_by('name_product', 'ASC');
        $query = $this->db->get('products')->result_array(); 

        return $query;
    }


    public function findAll_get()
    {
        $this->db->order_by('name_product', 'ASC');
        return $this->db->get('products')->result_array();
    }


    public function delete($id)
    {
        return $this->db->delete('products', ['id_product' => $id]);
    }


    public function update_post($id, $data) 
    {
        $this->db->where('id_product', $id);
        return $this->db->update('products', $data);
    }


    public function totalProducts_get()
    {
        $count =  $this->db->get('products')->num_rows();

        return $count;
    }


    public function setVisibility_post($id, $status)
    {

      $this->db->set('visibility', $status);
      $this->db->where('id_product', $id);
      $this->db->update('products');

      return true;

    }


	public function getAllIds_get() {
		$this->db->select('id_product');
		$this->db->from('products');
		$query = $this->db->get();

		return $query->result_array();
	}

}

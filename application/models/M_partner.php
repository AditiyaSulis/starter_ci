<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_partner extends CI_Model {
    public function create_post($data)
    {
        if ($this->db->insert('partner', $data)) {
            return true;
        } else {
            return false;
        }
    }


    public function findById($id)
    {
        if (empty($id)) {
            return null;
        }

        return $this->db
            ->where('id_partner', (int)$id)
            ->get('partner')
            ->row_array();
    }



    public function findAllShow_get() 
    {

        $this->db->where('visibility', 1);
        $this->db->order_by('name_partner', 'ASC');
        $query = $this->db->get('partner')->result_array(); 

        return $query;
    }

    public function findById_get($id){
        return $this->db->get_where('partner' , ['id_partner' => $id])->row_array();
    }

    public function findAll_get()
    {
        $this->db->order_by('name_partner', 'ASC');
        return $this->db->get('partner')->result_array();
    }


    public function delete($id)
    {
        return $this->db->delete('partner', ['id_partner' => $id]);
    }


    public function update_post($id, $data) 
    {
        $this->db->where('id_partner', $id);
        return $this->db->update('partner', $data);
    }


    public function totalpartner_get()
    {
        $count =  $this->db->get('partner')->num_rows();

        return $count;
    }


    public function setVisibility_post($id, $status)
    {

      $this->db->set('visibility', $status);
      $this->db->where('id_partner', $id);
      $this->db->update('partner');

      return true;
    }


	public function getAllIds_get() {
		$this->db->select('id_partner');
		$this->db->where('visibility', 1);
		$this->db->from('partner');
		$query = $this->db->get();

		return $query->result_array();
	}

}

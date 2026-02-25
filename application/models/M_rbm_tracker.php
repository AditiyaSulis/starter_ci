<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_rbm_tracker extends CI_Model
{

	private $column_search = array('fitur', 'sumber', 'dampak');
	private $column_order = array('id_rbm_tracker','created_at');
	private $order = array('created_at' => 'asc');

	public function findAll_get()
	{
		return $this->db->get('rbm_tracker')->result_array();
	}

	public function findById_get($id)
	{
		$this->db->select('fitur,sumber, dampak, status, id_rbm_tracker, prioritas, catatan, created_at, finished_at');
		$this->db->from('rbm_tracker');
		$this->db->where('id_rbm_tracker', $id);

		return $this->db->get()->row();
	}

	public function create_post($data){
		return $this->db->insert('rbm_tracker', $data);
	}


	public function findAllWithJoin_get()
	{
		$this->db->select('fitur,sumber, dampak, status, id_rbm_tracker, prioritas, catatan, created_at, finished_at');
		$this->db->from('rbm_tracker');
		$this->db->order_by('created_at', 'ASC');

		return $this->db->get()->result_array();
	} 

  	public function update_post($id, $data)
	{
		$this->db->where('id_rbm_tracker', $id);
		return $this->db->update('rbm_tracker', $data);
	}


	public function delete($id)
	{
		return $this->db->delete('rbm_tracker', ['id_rbm_tracker' => $id]);
	}



	private function _filterDATE($type)
	{
		switch ($type) {
			case 'today':
				$this->db->where('DATE(created_at) = CURDATE()');
				break;
			case 'yesterday':
				$this->db->where('DATE(created_at) = CURDATE() - INTERVAL 1 DAY');
				break;
			case 'this_week':
				$this->db->where('created_at >=', date('Y-m-d', strtotime('monday this week')));
				$this->db->where('created_at <=', date('Y-m-d', strtotime('sunday this week')));
				break;
			case 'last_week':
				$this->db->where('created_at >=', date('Y-m-d', strtotime('monday last week')));
				$this->db->where('created_at <=', date('Y-m-d', strtotime('sunday last week')));
				break;
			case 'this_month':
				$this->db->where('created_at BETWEEN DATE_FORMAT(CURDATE(), "%Y-%m-01") AND LAST_DAY(CURDATE())');
				break;
			case 'last_month':
				$this->db->where('created_at BETWEEN DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, "%Y-%m-01") AND LAST_DAY(CURDATE() - INTERVAL 1 MONTH)');
				break;
			case 'this_year':
				$this->db->where('created_at BETWEEN DATE_FORMAT(CURDATE(), "%Y-01-01") AND CURDATE()');
				break;
			case 'last_year':
				$this->db->where('created_at BETWEEN DATE_FORMAT(CURDATE() - INTERVAL 1 YEAR, "%Y-01-01") AND DATE_FORMAT(CURDATE() - INTERVAL 1 YEAR, "%Y-12-31")');
				break;
			case 'custom':
				$startDate = $this->input->post('startDate');
				$endDate = $this->input->post('endDate');
				if ($startDate && $endDate) {
					$this->db->where('created_at >=', $startDate);
					$this->db->where('created_at <=', $endDate);
				}
				break;
			default:
				break;
		}
	}


	public function getRbmTrackerDataCore_get($option = null, $startDate = null, $endDate = null, $priority = null)
	{
		$this->db->select('fitur,sumber, dampak, status, id_rbm_tracker, prioritas, catatan, created_at, finished_at');
		$this->db->from('rbm_tracker');
		if(!empty($option) ){
			$this->_filterDATE($option);
		} 

        if($priority != null) {
            $this->db->where('prioritas', $priority);
        }; 
        

		$i = 0;
		foreach ($this->column_search as $item) {
			if (@$_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->column_search) - 1 === $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by(key($this->order), $this->order[key($this->order)]);
		}

	}


	public function get_datatables($option = null, $startDate = null, $endDate = null, $priority = null)
	{
		$this->getRbmTrackerDataCore_get($option, $startDate , $endDate, $priority );
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}


	public function count_filtered($option = null, $startDate = null, $endDate = null, $priority = null)
	{
		$this->getRbmTrackerDataCore_get($option, $startDate, $endDate, $priority);
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function count_all()
	{
		$this->db->from('rbm_tracker');
		return $this->db->count_all_results();
	} 

	public function update_status($id, $status)
	{
		$data = [
			'status' => $status,
		];
		
		
		$this->db->where('id_rbm_tracker', $id);
		return $this->db->update('rbm_tracker', $data);
	}

}


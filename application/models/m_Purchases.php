<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class m_Purchases extends CI_Model {
//	private $column_search = array('purchases.*, supplier.id_supplier, supplier.name_supplier');
//	private $column_order = array('purchases.*, supplier.id_supplier, supplier.name_supplier');
	private $column_search = array('purchases.id_purchases, purchases.id_supplier, purchases.created_at, purchases.input_at, purchases.total_amount, purchases.pot_amount, purchases.final_amount,purchases.remaining_amount, purchases.status_purchases, purchases.description, purchases.payment_type, purchases.jatuh_tempo, supplier.id_supplier, supplier.name_supplier');
	private $column_order = array('purchases.id_purchases, purchases.id_supplier, purchases.created_at, purchases.input_at, purchases.total_amount, purchases.pot_amount, purchases.final_amount,purchases.remaining_amount, purchases.status_purchases, purchases.description, purchases.payment_type, purchases.jatuh_tempo, supplier.id_supplier, supplier.name_supplier');
	private $order = array('purchases.input_at' => 'asc');

	public function create_post($data)
    {
        if ($this->db->insert('purchases', $data)) {
            return true;
        } else {
            return false;
        }
    }


    public function findById_get($id) 
    {
      return $this->db->get_where('purchases', ['id_purchases' => $id])->row_array();
    }


    public function findBySupplierId_get($id) 
    {
      return $this->db->get_where('purchases', ['id_supplier' => $id])->row_array();
    }


    public function findAll_get()
    {
        return $this->db->get('purchases')->result_array();
    }


    public function findAllWithJoin_get()
    {
        $this->db->select('P.*, S.id_supplier, S.name_supplier');
        $this->db->where('status_purchases', '0');
        $this->db->from('purchases P');
        $this->db->join('supplier S', 'S.id_supplier = P.id_supplier');
        $this->db->order_by('P.input_at', 'DESC');

        $query = $this->db->get();

        return $query->result_array();
    }


    public function findAllByPaidWithJoin_get()
    {
        $this->db->select('P.*, S.id_supplier, S.name_supplier');
        $this->db->where('status_purchases', '1');
        $this->db->from('purchases P');
        $this->db->join('supplier S', 'S.id_supplier = P.id_supplier');
        $this->db->order_by('P.input_at', 'DESC');

        $query = $this->db->get();

        return $query->result_array();
    }


    public function delete($id)
    {
        return $this->db->delete('purchases', ['id_purchases' => $id]);
    }
    

    public function update_post($id, $data) 
    {
        $this->db->where('id_purchases', $id);
        return $this->db->update('purchases', $data);
    }


    public function totalUnpaid_get()
    {
        $this->db->where('status_purchases', 0); 
        $query = $this->db->get('purchases'); 
        return $query->num_rows(); 
    }


    public function totalPaid_get()
    {
        $this->db->where('status_purchases', 1); 
        $query = $this->db->get('purchases'); 
        return $query->num_rows(); 
    }
    

    public function getTotalFinalAmount_get()
    {
        $this->db->select_sum('final_amount'); 

        $query = $this->db->get('purchases'); 
        return $query->row()->final_amount; 
    }

	public function jatuhTempo_get(){

		$today = date('Y-m-d');
		//$today =;
		$three_days_later = date('Y-m-d', strtotime('+3 days', strtotime($today)));

		$this->db->from('purchases');
		$this->db->join('supplier', 'supplier.id_supplier = purchases.id_supplier', 'left');
		$this->db->join('purchase_payments', 'purchase_payments.id_purchases = purchases.id_purchases', 'left');

		$this->db->where('purchases.status_purchases', '0');
		$this->db->where('purchases.jatuh_tempo >=', $today);
		$this->db->where('purchases.jatuh_tempo <=', $three_days_later);

		$this->db->select('purchases.*, supplier.id_supplier, supplier.name_supplier');

		$data = $this->db->get()->result_array();

		return $data;

	}

	public function totalJatuhTempo_get() {
		$today = date('Y-m-d');
		$three_days_later = date('Y-m-d', strtotime('+3 days', strtotime($today)));

		$this->db->from('purchases');  // Set the FROM table first
		$this->db->join('supplier', 'supplier.id_supplier = purchases.id_supplier', 'left');
		$this->db->join('purchase_payments', 'purchase_payments.id_purchases = purchases.id_purchases', 'left');

		$this->db->where('purchases.status_purchases', '0');
		$this->db->where('purchases.jatuh_tempo >=', $today);
		$this->db->where('purchases.jatuh_tempo <=', $three_days_later);

		$this->db->select('purchases.*, supplier.id_supplier, supplier.name_supplier'); // Select comes last

		$data = $this->db->count_all_results(); // Get the count of results
		return $data;
	}

	private function _filterDATE($type)
	{
		switch ($type) {
			case 'today':
				$this->db->where('DATE(purchases.jatuh_tempo) = CURDATE()');
				break;
			case 'tomorrow':
				$this->db->where('DATE(purchases.jatuh_tempo) = DATE_ADD(CURDATE(), INTERVAL 1 DAY)');
				break;
			case 'this_week':
				$this->db->where('purchases.jatuh_tempo >=', date('Y-m-d', strtotime('monday this week')));
				$this->db->where('purchases.jatuh_tempo <=', date('Y-m-d', strtotime('sunday this week')));
				break;
			case 'next_week':
				$this->db->where('purchases.jatuh_tempo >=', date('Y-m-d', strtotime('monday next week')));
				$this->db->where('purchases.jatuh_tempo <=', date('Y-m-d', strtotime('sunday next week')));
				break;
			case 'this_month':
				$this->db->where('purchases.jatuh_tempo >=', date('Y-m-01'));
				$this->db->where('purchases.jatuh_tempo <=', date('Y-m-t'));
				break;
			case 'next_month':
				$this->db->where('purchases.jatuh_tempo >=', date('Y-m-01', strtotime('+1 month')));
				$this->db->where('purchases.jatuh_tempo <=', date('Y-m-t', strtotime('+1 month')));
				break;
			case 'this_year':
				$this->db->where('purchases.jatuh_tempo >=', date('Y-01-01'));
				$this->db->where('purchases.jatuh_tempo <=', date('Y-12-31'));
				break;
			case 'next_year':
				$this->db->where('purchases.jatuh_tempo >=', date('Y-01-01', strtotime('+1 year')));
				$this->db->where('purchases.jatuh_tempo <=', date('Y-12-31', strtotime('+1 year')));
				break;
			case 'custom':
				$startDate = $this->input->post('startDate');
				$endDate = $this->input->post('endDate');
				if ($startDate && $endDate) {
					$this->db->where('purchases.jatuh_tempo >=', $startDate);
					$this->db->where('purchases.jatuh_tempo <=', $endDate);
				}
				break;
			default:
				break;
		}
	}
	private function _filterDATECORE($type, $startDate, $endDate)
	{
		switch ($type) {
			case 'today':
				$this->db->where('DATE(purchases.jatuh_tempo) = CURDATE()');
				break;
			case 'tomorrow':
				$this->db->where('DATE(purchases.jatuh_tempo) = DATE_ADD(CURDATE(), INTERVAL 1 DAY)');
				break;
			case 'this_week':
				$this->db->where('purchases.jatuh_tempo >=', date('Y-m-d', strtotime('monday this week')));
				$this->db->where('purchases.jatuh_tempo <=', date('Y-m-d', strtotime('sunday this week')));
				break;
			case 'next_week':
				$this->db->where('purchases.jatuh_tempo >=', date('Y-m-d', strtotime('monday next week')));
				$this->db->where('purchases.jatuh_tempo <=', date('Y-m-d', strtotime('sunday next week')));
				break;
			case 'this_month':
				$this->db->where('purchases.jatuh_tempo >=', date('Y-m-01'));
				$this->db->where('purchases.jatuh_tempo <=', date('Y-m-t'));
				break;
			case 'next_month':
				$this->db->where('purchases.jatuh_tempo >=', date('Y-m-01', strtotime('+1 month')));
				$this->db->where('purchases.jatuh_tempo <=', date('Y-m-t', strtotime('+1 month')));
				break;
			case 'this_year':
				$this->db->where('purchases.jatuh_tempo >=', date('Y-01-01'));
				$this->db->where('purchases.jatuh_tempo <=', date('Y-12-31'));
				break;
			case 'next_year':
				$this->db->where('purchases.jatuh_tempo >=', date('Y-01-01', strtotime('+1 year')));
				$this->db->where('purchases.jatuh_tempo <=', date('Y-12-31', strtotime('+1 year')));
				break;
			case 'custom':
				if ($startDate && $endDate) {
					$this->db->where('purchases.jatuh_tempo >=', $startDate);
					$this->db->where('purchases.jatuh_tempo <=', $endDate);
				}
				break;
			default:
				break;
		}
	}
	public function getPurchasesDataPaid_get($option = null, $startDate = null, $endDate = null )
	{
		$this->db->select('purchases.*, supplier.id_supplier, supplier.name_supplier');
		$this->db->where('status_purchases', '0');
		$this->db->from('purchases');
		$this->db->join('supplier', 'supplier.id_supplier = purchases.id_supplier');
		$this->db->order_by('purchases.input_at', 'DESC');

		$this->_filterDATE($option);

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

		$query = $this->db->get();
		return $query->result_array();
	}

	public function getPurchasesDataCore_get()
	{

		$option = $this->input->post('option', true);
		$status_purchases = $this->input->post('status_purchases', true);
		$with_alerts = $this->input->post('with_alerts', true);


		if(!empty($status_purchases) || $status_purchases == 0){
			$this->db->select('purchases.*, supplier.id_supplier, supplier.name_supplier');
			$this->db->where('status_purchases', $status_purchases);
			$this->db->from('purchases');
			$this->db->join('supplier', 'supplier.id_supplier = purchases.id_supplier');
			if(!empty($option) ){
				$this->_filterDATE($option);
			}


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
		 if(!empty($with_alerts)){
			$today = date('Y-m-d');
			$three_days_later = date('Y-m-d', strtotime('+3 days', strtotime($today)));

			$this->db->from('purchases');
			$this->db->join('supplier', 'supplier.id_supplier = purchases.id_supplier', 'left');
			$this->db->join('purchase_payments', 'purchase_payments.id_purchases = purchases.id_purchases', 'left');

			$this->db->where('purchases.status_purchases', '0');
			$this->db->where('purchases.jatuh_tempo >=', $today);
			$this->db->where('purchases.jatuh_tempo <=', $three_days_later);

			$this->db->select('purchases.*, supplier.id_supplier, supplier.name_supplier');

			 if (isset($_POST['order'])) {
				 $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			 } else {
				 $this->db->order_by(key($this->order), $this->order[key($this->order)]);
			 }

		 }

	}

	public function get_datatables()
	{
		$this->getPurchasesDataCore_get();
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_filtered()
	{
		$this->getPurchasesDataCore_get();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from('purchases');
		return $this->db->count_all_results();
	}


}

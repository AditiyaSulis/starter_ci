<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_finance_records extends CI_Model {

    private $table = 'finance_records F'; 
    private $column_order = array('F.created_at', 'F.record_date', 'C.name_kategori', 'P.name_product', 'F.amount', 'A.name_code', 'F.description'); 
    private $column_search = array('F.created_at', 'F.record_date', 'C.name_kategori', 'P.name_product', 'F.amount', 'A.name_code', 'F.description'); 
    private $order = array('F.record_date' => 'asc'); 
    
    public function findByProductId_get($id)
    {
        return $this->db->get_where('finance_records', ['product_id' => $id])->row_array();
    }


    public function get_all_join()
    {

        $this->db->select('F.*, A.name_code, A.code, P.name_product, C.id_kategori, C.name_kategori');
        $this->db->from('finance_records F');
        $this->db->join('products P', 'P.id_product = F.product_id');
        $this->db->join('account_code A', 'A.id_code = F.id_code');
        $this->db->join('categories C', 'C.id_kategori = A.id_kategori');
        $this->db->order_by('F.record_date', 'DESC');

        $query = $this->db->get();

        return $query->result_array();
    }


    public function findById_get($id)
    {
        return $this->db->get_where('finance_records', ['id_record' => $id])->row_array();
    }


    public function create_post($data)
    {
        if ($this->db->insert('finance_records', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function create_batch_post($data)
	{
		return $this->db->insert_batch('finance_records', $data);
	}


    public function update_post($id, $data)
    {
        $this->db->where('id_record', $id);
        return $this->db->update('finance_records', $data);
    }


    public function findByIdAc_get($id)
    {
       return $this->db->get_where('finance_records', ['id_code' => $id])->row_array();
    }


    public function delete($id)
    {

        return $this->db->delete('finance_records', ['id_record' => $id]);
    }


    public function totalFinanceRecords_get()
    {
        $count =  $this->db->get('finance_records')->num_rows();
    
        return $count;
    }


    private function _filterDATE($type)
    {
		switch ($type) {
			case 'today':
				$this->db->where('DATE(F.record_date ) = CURDATE()');
				break;
			case 'yesterday':
				$this->db->where('DATE(F.record_date) = CURDATE() - INTERVAL 1 DAY');
				break;
			case 'this_week':
                $this->db->where('F.record_date >=', date('Y-m-d', strtotime('monday this week')));
                $this->db->where('F.record_date <=', date('Y-m-d', strtotime('sunday this week')));
                break;
			case 'last_week':
                $this->db->where('F.record_date >=', date('Y-m-d', strtotime('monday last week')));
                $this->db->where('F.record_date <=', date('Y-m-d', strtotime('sunday last week')));
                break;
			case 'this_month':
				$this->db->where('DATE(F.record_date) BETWEEN DATE_FORMAT(CURDATE(), "%Y-%m-01") AND LAST_DAY(CURDATE())');
				break;
			case 'last_month':
				$this->db->where('F.record_date BETWEEN DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, "%Y-%m-01") AND LAST_DAY(CURDATE() - INTERVAL 1 MONTH)');
				break;
			case 'this_year':
				$this->db->where('DATE(F.record_date) BETWEEN DATE_FORMAT(CURDATE(), "%Y-01-01") AND CURDATE()');
				break;
			case 'last_year':
				$this->db->where('F.record_date BETWEEN DATE_FORMAT(CURDATE() - INTERVAL 1 YEAR, "%Y-01-01") AND DATE_FORMAT(CURDATE() - INTERVAL 1 YEAR, "%Y-12-31")');
				break;
			case 'custom':
				$startDate = $this->input->post('startDate', true);
				$endDate = $this->input->post('endDate', true);
				$this->db->where('DATE(F.record_date) BETWEEN "' . $startDate . '" AND "' . $endDate . '"');
				break;
			default:
				break;
		}
	}


    private function _get_datatables_query($option = null, $startDate = null, $endDate = null, $product = null, $code = null, $category = null)
    {

            $this->db->select('F.*, A.name_code, A.code, P.name_product, C.id_kategori, C.name_kategori');
            $this->db->from($this->table);
            $this->db->join('products P', 'P.id_product = F.product_id');
            $this->db->join('account_code A', 'A.id_code = F.id_code');
            $this->db->join('categories C', 'C.id_kategori = A.id_kategori');

            $this->_filterDATE($option);

            if ($category) {
                $this->db->where('C.id_kategori', $category);
            }
        
            if ($product) {
                $this->db->where('P.id_product', $product);
            }
        
            if ($code) {
                $this->db->where('A.id_code', $code);
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


    public function get_datatables($option = null, $startDate = null, $endDate = null, $product = null, $code = null, $category = null )
    {
           $this->_get_datatables_query($option, $startDate, $endDate, $product, $code, $category);
           if (@$_POST['length'] != -1) {
               $this->db->limit(@$_POST['length'], @$_POST['start']);
           }
           $query = $this->db->get();
           return $query->result();
    }
   

     public function count_filtered($option = null, $startDate = null, $endDate = null, $product = null, $code = null, $category = null)
    {
        $this->_get_datatables_query($option, $startDate, $endDate, $product, $code, $category);
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

   
    public function getTotalAmountByCategory($filter, $startDate, $endDate) {
        $this->_filterDATE($filter);  

        $this->db->select('C.id_kategori, C.name_kategori, SUM(F.amount) AS total_amount');
        $this->db->from('finance_records F');
        $this->db->join('account_code A', 'F.id_code = A.id_code');
        $this->db->join('categories C', 'C.id_kategori = A.id_kategori');
        $this->db->group_by('C.id_kategori');

        $query = $this->db->get();
        $result = $query->result_array();

        foreach ($result as &$category) {
            $category['total_amount'] = (float) $category['total_amount'];
        }

        return $result;
    }


    public function getTotalAmountByProductAndCategory($filter, $startDate, $endDate) {

        $this->_filterDATE($filter);  

        $this->db->select('P.id_product, P.name_product, C.id_kategori, SUM(F.amount) AS total_amount');
        $this->db->from('finance_records F');
        $this->db->join('account_code A', 'F.id_code = A.id_code');
        $this->db->join('products P', 'P.id_product = F.product_id');
        $this->db->join('categories C', 'C.id_kategori = A.id_kategori');
        $this->db->group_by(['P.id_product', 'C.id_kategori']);
    
        $query = $this->db->get();
        $result = $query->result_array();
 
        foreach ($result as &$product) {
            $product['total_amount'] = (float) $product['total_amount'];
        }
    
        return $result;
    }
    

    private function _totalFilter($filter)
    {
        switch ($filter) {
            case 'today':
                $this->db->where('DATE(F.record_date ) = CURDATE()');
                break;
            case 'yesterday':
                $this->db->where('F.record_date', date('Y-m-d', strtotime('-1 day')));
                break;
            case 'this_week':
                $this->db->where('F.record_date >=', date('Y-m-d', strtotime('monday this week')));
                $this->db->where('F.record_date <=', date('Y-m-d', strtotime('sunday this week')));
                break;
            case 'last_week':
                $this->db->where('F.record_date >=', date('Y-m-d', strtotime('monday last week')));
                $this->db->where('F.record_date <=', date('Y-m-d', strtotime('sunday last week')));
                break;
            case 'this_month':
               $this->db->where('F.record_date BETWEEN DATE_FORMAT(CURDATE(), "%Y-%m-01") AND LAST_DAY(CURDATE())');
                break;
            case 'last_month':
                $this->db->where('F.record_date BETWEEN DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, "%Y-%m-01") AND LAST_DAY(CURDATE() - INTERVAL 1 MONTH)');
                break;
            case 'this_year':
                $this->db->where('F.record_date BETWEEN DATE_FORMAT(CURDATE(), "%Y-01-01") AND CURDATE()');
                break;
            case 'last_year':
                $this->db->where('YEAR(F.record_date)', date('Y', strtotime('-1 year')));
                break;
        }
    }


	public function updateTotalUangMakan_post($desc, $uang_makan)
	{

		$this->db->set('amount', $uang_makan);
		$this->db->where('description', $desc);
		$this->db->update('finance_records');

		return true;

	}

	public function findByDesc_get($desc)
	{
		return $this->db->get_where('finance_records', ['description' => $desc])->row_array();
	}

}

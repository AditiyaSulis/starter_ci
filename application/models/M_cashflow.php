<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_cashflow extends CI_Model
{

	private $column_search = array('cash_flow.id_cash_flow', 'products.name_product', 'account_code.name_code',  'cash_flow.kode_cash_flow', 'cash_flow.tgl_cash_flow', 'cash_flow.jumlah',  'cash_flow.description' , 'cash_flow.catatan');
	private $column_order = array('cash_flow.id_cash_flow', 'products.name_product', 'account_code.name_code',  'cash_flow.kode_cash_flow', 'cash_flow.tgl_cash_flow', 'cash_flow.jumlah',  'cash_flow.description', 'cash_flow.catatan');
	private $order = array('cash_flow.tgl_cash_flow' => 'asc');

	public function findAll_get()
	{
		return $this->db->get('cash_flow')->result_array();
	}


	public function findById_get($id)
	{
		$this->db->select('cash_flow.*, account_code.name_code, account_code.code, account_code.id_kategori, categories.name_kategori, products.name_product');
		$this->db->from('cash_flow');
		$this->db->where('cash_flow.id_cash_flow', $id);
		$this->db->join('products', 'products.id_product = cash_flow.id_product', 'left');
		$this->db->join('account_code', 'account_code.id_code = cash_flow.id_code', 'left');
		$this->db->join('categories', 'categories.id_kategori = account_code.id_kategori', 'left');
		$this->db->order_by('cash_flow.tgl_cash_flow', 'ASC');

		return $this->db->get()->row_array();
	}


	public function findAllWithJoin_get()
	{

		$this->db->select('cash_flow.*, account_code.name_code, account_code.code, account_code.id_kategori, categories.name_kategori, products.name_product');
		$this->db->from('cash_flow');
		$this->db->join('products', 'products.id_product = cash_flow.id_product', 'left');
		$this->db->join('account_code', 'account_code.id_code = cash_flow.id_code', 'left');
		$this->db->join('categories', 'categories.id_kategori = account_code.id_kategori', 'left');
		$this->db->order_by('cash_flow.tgl_cash_flow', 'ASC');

		return $this->db->get()->result_array();
	}


	

	public function update_post($id, $data)
	{
		$this->db->where('id_cash_flow', $id);
		return $this->db->update('cash_flow', $data);
	}


	public function delete($id)
	{
		return $this->db->delete('cash_flow', ['id_cash_flow' => $id]);
	}


	public function create_post($data)
	{
		if ($this->db->insert('cash_flow', $data)) {
			return $this->db->insert_id();;
		} else {
			return false;
		}
	}


	private function _filterDATE($type)
	{
		switch ($type) {
			case 'today':
				$this->db->where('DATE(cash_flow.tgl_cash_flow) = CURDATE()');
				break;
			case 'yesterday':
				$this->db->where('DATE(cash_flow.tgl_cash_flow) = CURDATE() - INTERVAL 1 DAY');
				break;
			case 'this_week':
				$this->db->where('cash_flow.tgl_cash_flow >=', date('Y-m-d', strtotime('monday this week')));
				$this->db->where('cash_flow.tgl_cash_flow <=', date('Y-m-d', strtotime('sunday this week')));
				break;
			case 'last_week':
				$this->db->where('cash_flow.tgl_cash_flow >=', date('Y-m-d', strtotime('monday last week')));
				$this->db->where('cash_flow.tgl_cash_flow <=', date('Y-m-d', strtotime('sunday last week')));
				break;
			case 'this_month':
				$this->db->where('cash_flow.tgl_cash_flow BETWEEN DATE_FORMAT(CURDATE(), "%Y-%m-01") AND LAST_DAY(CURDATE())');
				break;
			case 'last_month':
				$this->db->where('cash_flow.tgl_cash_flow BETWEEN DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, "%Y-%m-01") AND LAST_DAY(CURDATE() - INTERVAL 1 MONTH)');
				break;
			case 'this_year':
				$this->db->where('cash_flow.tgl_cash_flow BETWEEN DATE_FORMAT(CURDATE(), "%Y-01-01") AND CURDATE()');
				break;
			case 'last_year':
				$this->db->where('cash_flow.tgl_cash_flow BETWEEN DATE_FORMAT(CURDATE() - INTERVAL 1 YEAR, "%Y-01-01") AND DATE_FORMAT(CURDATE() - INTERVAL 1 YEAR, "%Y-12-31")');
				break;
			case 'custom':
				$startDate = $this->input->post('startDate');
				$endDate = $this->input->post('endDate');
				if ($startDate && $endDate) {
					$this->db->where('cash_flow.tgl_cash_flow >=', $startDate);
					$this->db->where('cash_flow.tgl_cash_flow <=', $endDate);
				}
				break;
			default:
				break;
		}
	}


    private function getKasDataCore_get($option = null, $startDate = null, $endDate = null, $product = null, $code = null, $category = null)
    {

        $this->db->select('cash_flow.*, account_code.name_code, account_code.code, account_code.id_kategori, categories.name_kategori, products.name_product');
		$this->db->from('cash_flow');
		$this->db->join('products', 'products.id_product = cash_flow.id_product', 'left');
		$this->db->join('account_code', 'account_code.id_code = cash_flow.id_code', 'left');
		$this->db->join('categories', 'categories.id_kategori = account_code.id_kategori', 'left');
		$this->db->order_by('cash_flow.tgl_cash_flow', 'ASC');


        $this->_filterDATE($option);

        if ($category) {
            $this->db->where('account_code.id_kategori', $category);
        }
    
        if ($product) {
            $this->db->where('cash_flow.id_product', $product);
        }
    
        if ($code) {
            $this->db->where('cash_flow.id_code', $code);
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


	public function get_datatables($option = null, $startDate = null, $endDate = null, $product = null, $code = null, $category = null)
	{
		$this->getKasDataCore_get($option, $startDate, $endDate, $product, $code, $category);
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}


	public function count_filtered($option = null, $startDate = null, $endDate = null, $product = null, $code = null, $category = null)
	{
		$this->getKasDataCore_get($option, $startDate, $endDate, $product, $code, $category);
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function count_all()
	{
		$this->db->from('cash_flow');
		return $this->db->count_all_results();
	}



    public function generateKode() {
        $this->db->select('kode_cash_flow');
        $this->db->from('cash_flow');
        $this->db->order_by('id_cash_flow', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            $lastKode = $query->row()->kode_cash_flow;
            $lastNumber = (int) substr($lastKode, 4); // ambil angka setelah "PRD-"
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
    
        $newKode = 'KAS-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
        return $newKode;
    }


	public function getTotalAmountByCategory($filter, $startDate, $endDate) {
        $this->_filterDATE($filter);  

        $this->db->select('C.id_kategori, C.name_kategori, SUM(cash_flow.jumlah) AS total_amount');
        $this->db->from('cash_flow');
        $this->db->join('account_code A', 'cash_flow.id_code = A.id_code');
        $this->db->join('categories C', 'C.id_kategori = A.id_kategori');
		$this->db->where_in('C.id_kategori' , [1,2]);
        $this->db->group_by('C.id_kategori');

        $query = $this->db->get();
        $result = $query->result_array();

		foreach ($result as &$product) { 
            $product['total_amount'] = (float) $product['total_amount'];
        }
		


        return $result;
    } 

	
	public function getTotalAmountByProductAndCategory($filter, $startDate, $endDate) {

        $this->_filterDATE($filter);  

        $this->db->select('P.id_product, P.name_product, C.id_kategori, SUM(cash_flow.jumlah) AS total_amount');
        $this->db->from('cash_flow');
        $this->db->join('account_code A', 'cash_flow.id_code = A.id_code');
        $this->db->join('products P', 'P.id_product = cash_flow.id_product');
        $this->db->join('categories C', 'C.id_kategori = A.id_kategori');
		$this->db->where_in('C.id_kategori' , [1,2]);
        $this->db->group_by(['P.id_product', 'C.id_kategori']);
    
        $query = $this->db->get();
        $result = $query->result_array();
 
        
		foreach ($result as &$product) {
            $product['total_amount'] = (float) $product['total_amount'];
        } 
		
        return $result;
    }

}

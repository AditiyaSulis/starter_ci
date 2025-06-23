<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_piutang extends CI_Model {
	private $column_order = array('employee.name', 'piutang.remaining_piutang', 'piutang.amount_piutang');
	private $column_search = array('employee.name', 'piutang.remaining_piutang', 'piutang.amount_piutang');
	private $order = array('piutang.id_piutang' => 'asc');

	public function findById_get($id)
    {
        return $this->db->get_where('piutang', ['id_piutang' => $id])->row_array();
    }


    public function findByProductId_get($id)
    {
        return $this->db->get_where('employee', ['id_product' => $id])->row_array();
    }


    public function findByEmployeeId_get($id){
        return $this->db->get_where('piutang', ['id_employee' => $id])->row_array();
    }


    public function unpaid_get($id){
        return $this->db->get_where('piutang', ['id_employee' => $id, 'status_piutang' => 2])->row_array();
    }


    public function findAllWithUnpaid_get($id){
        return $this->db->get_where('piutang', ['status_piutang' => 2])->result_array();
    }
	
    
    public function findAll_get()
    {
        return $this->db->get('piutang')->result_array();
    }


    public function findAllJoin_get()
    {
        $this->db->select('piutang.id_piutang, piutang.id_employee, piutang.type_piutang, piutang.tenor_piutang, piutang.amount_piutang, piutang.tgl_lunas, piutang.remaining_piutang, piutang.status_piutang, piutang.progress_piutang,  piutang.piutang_date, piutang.description_piutang, piutang.type_tenor, piutang.angsuran, piutang.jatuh_tempo, employee.id_employee, employee.name');
        $this->db->from('piutang');
        $this->db->join('employee', 'employee.id_employee = piutang.id_employee', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function create_post($data)
    {
        if ($this->db->insert('piutang', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }


    public function delete($id)
    {
        return $this->db->delete('piutang', ['id_piutang' => $id]);
    }


    public function update_post($id, $data) 
    {
        $this->db->where('id_piutang', $id);
        return $this->db->update('piutang', $data);
    }


	public function getPiutangDataCore_get()
	{
		$type_piutang = $this->input->post("type_piutang", true);
		$tgl_lunas = $this->input->post("tgl_lunas", true);
		$status_piutang = $this->input->post("status_piutang", true);
		$with_alerts = $this->input->post("with_alerts", true);

		if(!empty($status_piutang)) {
			$this->db->select('piutang.id_piutang, piutang.id_employee, piutang.type_piutang, piutang.tenor_piutang, piutang.amount_piutang, piutang.tgl_lunas, piutang.remaining_piutang, piutang.status_piutang, piutang.progress_piutang, piutang.description_piutang, piutang.piutang_date, piutang.type_tenor, piutang.angsuran, piutang.jatuh_tempo, employee.id_employee, employee.name');
			$this->db->from('piutang');
			$this->db->where('status_piutang', $status_piutang);
			$this->db->join('employee', 'employee.id_employee = piutang.id_employee', 'left');

			if (!empty($type_piutang) && $type_piutang !== 'All') {
				$this->db->where('piutang.type_piutang', $type_piutang);
			}

			if (!empty($tgl_lunas) && $tgl_lunas !== 'All') {
				if ($tgl_lunas === 'next_month') {
					$this->db->where('piutang.tgl_lunas >=', date('Y-m-01', strtotime('first day of next month')));
					$this->db->where('piutang.tgl_lunas <=', date('Y-m-t', strtotime('last day of next month')));
				} else if ($tgl_lunas === 'this_month') {
					$this->db->where('piutang.tgl_lunas >=', date('Y-m-01'));
					$this->db->where('piutang.tgl_lunas <=', date('Y-m-t'));
				}
			}
		}

		if(!empty($with_alerts)) {
			$today = (int) date('d');
			//$today = 1;
			$three_days_later = $today + 3;
			$paydate = date('Y-m-d');

			$this->db->select('piutang.*, employee.id_employee, employee.name');
			$this->db->from('piutang');
			$this->db->join('purchase_piutang', 'purchase_piutang.id_piutang = piutang.id_piutang', 'left');
			$this->db->join('employee', 'employee.id_employee = piutang.id_employee', 'left');

			if ($today == 30) {
				$this->db->group_start();
				$this->db->where('piutang.jatuh_tempo', 30);
				$this->db->or_where('piutang.jatuh_tempo', 31);
				$this->db->or_where('piutang.jatuh_tempo', 1);
				$this->db->or_where('piutang.jatuh_tempo', 2);
				$this->db->group_end();
			} elseif ($today == 31) {
				$this->db->group_start();
				$this->db->where('piutang.jatuh_tempo', 31);
				$this->db->or_where('piutang.jatuh_tempo', 1);
				$this->db->or_where('piutang.jatuh_tempo', 2);
				$this->db->or_where('piutang.jatuh_tempo', 3);
				$this->db->group_end();
			} else {
				$this->db->where('piutang.jatuh_tempo >=', $today);
				$this->db->where('piutang.jatuh_tempo <=', $three_days_later);
			}

			$this->db->where('piutang.status_piutang', 2);
			$this->db->group_start();
			$this->db->where('purchase_piutang.pay_date !=', $paydate);
			$this->db->or_where('purchase_piutang.pay_date IS NULL', null, false);
			$this->db->group_end();

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


	public function get_datatables()
	{
		$this->getPiutangDataCore_get();
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}


	public function count_filtered()
	{
		$this->getPiutangDataCore_get();
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function count_all()
	{
		$this->db->from('piutang');
		return $this->db->count_all_results();
	}


    public function setStatus_post($id, $status)
    {

      $this->db->set('status_piutang', $status);
      $this->db->where('id_piutang', $id);
      $this->db->update('piutang');

      return true;

    }

    
    public function setProgress_post($id, $status)
    {

      $this->db->set('progress_piutang', $status);
      $this->db->where('id_piutang', $id);
      $this->db->update('piutang');

      return true;

    }


    public function updateRemaining_post($id, $remaining)
    {

      $this->db->set('remaining_piutang', $remaining);
      $this->db->where('id_piutang', $id);
      $this->db->update('piutang');

      return true;

    }


    public function getTotalAmountPiutang_get($id)
    {
        $this->db->select_sum('amount_piutang', 'total_amount');
        $this->db->where('id_employee', $id);
        $this->db->where('status_piutang', 2);
        $query = $this->db->get('piutang');

        if ($query->num_rows() > 0) {
            return $query->row()->total_amount;
        }

        return 0; 
    }


	public function jatuhTempo_get(){
		$today = (int) date('d');
		//$today = 2;
		$three_days_later = $today + 3;
		$paydate = date('Y-m-d');

		$this->db->select('piutang.*, employee.id_employee, employee.name');
		$this->db->from('piutang');
		$this->db->join('purchase_piutang', 'purchase_piutang.id_piutang = piutang.id_piutang', 'left');
		$this->db->join('employee', 'employee.id_employee = piutang.id_employee', 'left');

		if ($today == 30) {
			$this->db->group_start();
			$this->db->where('piutang.jatuh_tempo', 30);
			$this->db->or_where('piutang.jatuh_tempo', 31);
			$this->db->or_where('piutang.jatuh_tempo', 1);
			$this->db->or_where('piutang.jatuh_tempo', 2);
			$this->db->group_end();
		} elseif ($today == 31) {
			$this->db->group_start();
			$this->db->where('piutang.jatuh_tempo', 31);
			$this->db->or_where('piutang.jatuh_tempo', 1);
			$this->db->or_where('piutang.jatuh_tempo', 2);
			$this->db->or_where('piutang.jatuh_tempo', 3);
			$this->db->group_end();
		} else {
			$this->db->where('piutang.jatuh_tempo >=', $today);
			$this->db->where('piutang.jatuh_tempo <=', $three_days_later);
		}

		$this->db->where('piutang.status_piutang', 2);
		$this->db->group_start();
		$this->db->where('purchase_piutang.pay_date !=', $paydate);
		$this->db->or_where('purchase_piutang.pay_date IS NULL', null, false);
		$this->db->group_end();

		$query = $this->db->get();
		return $query->result();
	}
	

	public function totalJatuhTempo_get() {
		$today = (int) date('d');
		//$today = 2;
		$three_days_later = $today + 3;
		$paydate = date('Y-m-d');

		$this->db->select('piutang.*, employee.id_employee, employee.name');
		$this->db->from('piutang');
		$this->db->join('purchase_piutang', 'purchase_piutang.id_piutang = piutang.id_piutang', 'left');
		$this->db->join('employee', 'employee.id_employee = piutang.id_employee', 'left');

		if ($today == 30) {
			$this->db->group_start();
			$this->db->where('piutang.jatuh_tempo', 30);
			$this->db->or_where('piutang.jatuh_tempo', 31);
			$this->db->or_where('piutang.jatuh_tempo', 1);
			$this->db->or_where('piutang.jatuh_tempo', 2);
			$this->db->group_end();
		} elseif ($today == 31) {
			$this->db->group_start();
			$this->db->where('piutang.jatuh_tempo', 31);
			$this->db->or_where('piutang.jatuh_tempo', 1);
			$this->db->or_where('piutang.jatuh_tempo', 2);
			$this->db->or_where('piutang.jatuh_tempo', 3);
			$this->db->group_end();
		} else {
			$this->db->where('piutang.jatuh_tempo >=', $today);
			$this->db->where('piutang.jatuh_tempo <=', $three_days_later);
		}

		$this->db->where('piutang.status_piutang', 2);
		$this->db->group_start();
		$this->db->where('purchase_piutang.pay_date !=', $paydate);
		$this->db->or_where('purchase_piutang.pay_date IS NULL', null, false);
		$this->db->group_end();

		$data = $this->db->count_all_results();

		return $data;
	}


	public function findPiutangThisMonthByEmployeeId_get($id, $month, $year) {
		$this->db->select('piutang.*, employee.id_employee, employee.name');
        $this->db->from('piutang');
        $this->db->join('purchase_piutang', 'purchase_piutang.id_piutang = piutang.id_piutang', 'left');
        $this->db->join('employee', 'employee.id_employee = piutang.id_employee', 'left');

        // Filter berdasarkan id_employee dan status piutang
        $this->db->where('piutang.id_employee', $id);
        $this->db->where('piutang.status_piutang', 2); // Hanya piutang yang masih aktif

        // Cek apakah pay_date di bulan yang dikirim NULL atau bukan bulan yang dikirim
        $this->db->group_start();
        $this->db->where('purchase_piutang.pay_date IS NULL', null, false);
        $this->db->or_where('MONTH(purchase_piutang.pay_date) !=', $month);
        $this->db->or_where('YEAR(purchase_piutang.pay_date) !=', $year);
        $this->db->group_end();

        return $this->db->get()->result_array(); // Mengembalikan array data
	}


	public function totalUnpaid_get()
	{
		$count = $this->db->where('status_piutang', 2)->count_all_results('piutang');

		return $count;
	}


	public function totalPaid_get()
	{
		$count = $this->db->where('status_piutang', 1)->count_all_results('piutang');

		return $count;
	}


	//================V2=====================

    public function findAllJoinV2_get()
    {
        $this->db->select('piutang.id_piutang, piutang.id_employee, piutang.type_piutang, piutang.tenor_piutang, piutang.amount_piutang, piutang.tgl_lunas, piutang.remaining_piutang, piutang.status_piutang, piutang.description_piutang, piutang.piutang_date, piutang.type_tenor, piutang.angsuran, employee.id_employee, employee.name');
        $this->db->from('piutang');
        $this->db->join('employee', 'employee.id_employee = piutang.id_employee', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPiutangDataV2_get($type = null, $pelunasan = null ) 
    {
        $this->db->select('piutang.id_piutang, piutang.id_employee, piutang.type_piutang, piutang.tenor_piutang, piutang.amount_piutang, piutang.tgl_lunas, piutang.remaining_piutang, piutang.status_piutang, piutang.description_piutang, piutang.piutang_date, piutang.type_tenor, piutang.angsuran, employee.id_employee, employee.name');
        $this->db->from('piutang');
        $this->db->where('status_piutang', 2);
        $this->db->join('employee', 'employee.id_employee = piutang.id_employee', 'left');
    
        if ($type && $type !== 'All') {  
            $this->db->where('piutang.type_piutang', $type);
        }

         if ($pelunasan === 'next_month') {
            $this->db->where('piutang.tgl_lunas >=', date('Y-m-01', strtotime('first day of next month')));
            $this->db->where('piutang.tgl_lunas <=', date('Y-m-t', strtotime('last day of next month')));
        } else if ($pelunasan === 'this_month') {
            $this->db->where('piutang.tgl_lunas >=', date('Y-m-01'));
            $this->db->where('piutang.tgl_lunas <=', date('Y-m-t'));
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
    
        $query = $this->db->get();
        return $query->result_array();  
    }

    public function createV2_post($data)
    {
        if ($this->db->insert('piutang', $data)) {
            return $this->db->insert_id(); 
        } else {
            return false; 
        }
    }


    public function getPiutangWithPaidV2_get($type = null) 
    {
        $this->db->select('piutang.id_piutang, piutang.id_employee, piutang.type_piutang, piutang.tenor_piutang, piutang.amount_piutang, piutang.tgl_lunas, piutang.remaining_piutang, piutang.status_piutang, piutang.description_piutang, piutang.piutang_date, piutang.type_tenor, piutang.angsuran, employee.id_employee, employee.name');
        $this->db->from('piutang');
        $this->db->where('status_piutang', 1);
        $this->db->join('employee', 'employee.id_employee = piutang.id_employee', 'left');
        $this->db->join('position', 'employee.id_position = position.id_position', 'left');
    
        if ($type && $type !== 'All') {  
            $this->db->where('piutang.type_piutang', $type);
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
    
        $query = $this->db->get();
        return $query->result_array();  
    }


	//==========UNUSED======================
	public function getPiutangData_get($type = null, $pelunasan = null )
	{

		$this->db->select('piutang.id_piutang, piutang.id_employee, piutang.type_piutang, piutang.tenor_piutang, piutang.amount_piutang, piutang.tgl_lunas, piutang.remaining_piutang, piutang.status_piutang, piutang.progress_piutang, piutang.description_piutang, piutang.piutang_date, piutang.type_tenor, piutang.angsuran, piutang.jatuh_tempo, employee.id_employee, employee.name');
		$this->db->from('piutang');
		$this->db->where('status_piutang', 2);
		$this->db->join('employee', 'employee.id_employee = piutang.id_employee', 'left');

		if ($type && $type !== 'All') {
			$this->db->where('piutang.type_piutang', $type);
		}
		// if ($pelunasan && $pelunasan !== 'All') {
		//     $this->db->where('piutang.tgl_lunas', $pelunasan);
		// }
		if ($pelunasan === 'next_month') {
			// Filter untuk bulan berikutnya
			$this->db->where('piutang.tgl_lunas >=', date('Y-m-01', strtotime('first day of next month')));
			$this->db->where('piutang.tgl_lunas <=', date('Y-m-t', strtotime('last day of next month')));
		} else if ($pelunasan === 'this_month') {
			// Filter untuk bulan ini
			$this->db->where('piutang.tgl_lunas >=', date('Y-m-01'));
			$this->db->where('piutang.tgl_lunas <=', date('Y-m-t'));
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

		$query = $this->db->get();
		return $query->result_array();
	}


	public function getPiutangWithPaid_get($type = null)
	{
		$this->db->select('piutang.id_piutang, piutang.id_employee, piutang.type_piutang, piutang.tenor_piutang, piutang.amount_piutang, piutang.tgl_lunas, piutang.remaining_piutang, piutang.status_piutang, piutang.progress_piutang, piutang.description_piutang, piutang.piutang_date, employee.id_employee, employee.name, employee.nip,  piutang.type_tenor, piutang.angsuran, piutang.jatuh_tempo, employee.id_position, position.id_position, position.name_position ');
		$this->db->from('piutang');
		$this->db->where('status_piutang', 1);
		$this->db->join('employee', 'employee.id_employee = piutang.id_employee', 'left');
		$this->db->join('position', 'employee.id_position = position.id_position', 'left');

		if ($type && $type !== 'All') {
			$this->db->where('piutang.type_piutang', $type);
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

		$query = $this->db->get();
		return $query->result_array();
	}



}

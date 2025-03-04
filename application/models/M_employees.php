<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_employees extends CI_Model {
    private $column_search = array('products.name_product', 'employee.date_in', 'employee.nip', 'employee.name', 'employee.type_employee' , 'employee.contract_expired' ,'employee.gender', 'employee.place_of_birth', 'employee.date_of_birth' , 'employee.basic_salary', ' division.name_division', 'employee.uang_makan', 'employee.bonus','employee.email', 'position.name_position');
	private $column_order = array('products.name_product', 'employee.date_in', 'employee.nip', 'employee.name', 'employee.type_employee' , 'employee.contract_expired' , 'employee.gender', 'employee.place_of_birth', 'employee.date_of_birth' , 'employee.basic_salary', ' division.name_division', 'employee.uang_makan', 'employee.bonus',  'employee.email', 'position.name_position');
	private $order = array('employee.date_in' => 'asc');
    public function findById_get($id)
    {
        return $this->db->get_where('employee', ['id_employee' => $id])->row_array();
    }


    public function findByIdJoin_get($id) {
        $this->db->select('
            employee.id_employee, employee.date_in, employee.nip, employee.name, employee.type_employee,
            employee.contract_expired, employee.gender, employee.place_of_birth, employee.date_of_birth,
            employee.basic_salary, employee.uang_makan, employee.bonus, employee.email, employee.id_position, employee.id_division,
            division.id_division, division.code_division, position.id_position, division.name_division, position.name_position,
            employee.status, products.id_product, products.name_product,
            address.id_address, address.kabupaten, address.desa, address.kecamatan, address.blok, address.spesifik, address.kode_pos,
            domisili.id_domisili, domisili.kabupaten_domisili, domisili.desa_domisili, domisili.kecamatan_domisili,
            domisili.blok_domisili, domisili.spesifik_domisili, domisili.kode_pos_domisili
        ');
    
        $this->db->from('employee');
        $this->db->where('employee.id_employee', $id);
        $this->db->join('products', 'products.id_product = employee.id_product', 'left');
        $this->db->join('position', 'position.id_position = employee.id_position', 'left');
        $this->db->join('division', 'division.id_division = employee.id_division', 'left');
        $this->db->join('domisili', 'domisili.id_employee = employee.id_employee', 'left');  // Menggunakan RIGHT JOIN
        $this->db->join('address', 'address.id_employee = employee.id_employee', 'left');  // Menggunakan RIGHT JOIN
        
        return $this->db->get()->row_array();
    }


    public function findByProductId_get($id)
    {
        return $this->db->get_where('employee', ['id_product' => $id])->row_array();
    }

    
    public function findAll_get()
    {
        return $this->db->get('employee')->result_array();
    }


    public function findAllJoin_get()
    {
        $this->db->select('employee.id_employee, employee.date_in, employee.nip, employee.name, employee.gender, employee.place_of_birth, employee.date_of_birth, employee.basic_salary, employee.uang_makan, employee.bonus, employee.email, employee.id_position, division.id_division, position.id_position, employee.id_division, division.name_division, position.name_position, employee.status, products.id_product, products.name_product, products.visibility');
        $this->db->from('employee');
        $this->db->join('products', 'products.id_product = employee.id_product', 'left');
        $this->db->join('position', 'position.id_position = employee.id_position', 'left');
        $this->db->join('division', 'division.id_division = employee.id_division', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }


	public function findByEmail_get($email){
		return $this->db->get_where('employee', ['email' => $email])->row_array();
	}


    public function findByEmailJoin_get($email){
        $this->db->select('employee.id_employee, employee.date_in, employee.nip, employee.email, employee.name, employee.gender, employee.place_of_birth, employee.date_of_birth, employee.basic_salary, employee.uang_makan, employee.bonus, employee.id_position, division.id_division, position.id_position, employee.id_division, division.name_division, division.code_division, position.name_position, employee.status, products.id_product, products.name_product, products.visibility');
        $this->db->where('employee.email', $email);
        $this->db->from('employee');
        $this->db->join('products', 'products.id_product = employee.id_product', 'left');
        $this->db->join('position', 'position.id_position = employee.id_position', 'left');
        $this->db->join('division', 'division.id_division = employee.id_division', 'left');
        $query = $this->db->get();
        return $query->result_array();
	}


	public function findByProductNDivisionId_get($idProduct, $idDivision)
	{
		return $this->db->get_where('employee', ['id_product' => $idProduct, 'id_division' => $idDivision])->result_array();
	}


    public function findByProductNTechnicianId_get($idProduct)
	{
        $this->db->select('employee.id_employee, employee.date_in, employee.nip, employee.name, employee.gender, employee.place_of_birth, employee.date_of_birth, employee.basic_salary, employee.uang_makan, employee.bonus, employee.email, employee.id_position, division.id_division, position.id_position, employee.id_division, division.name_division, division.code_division, position.name_position, employee.status, products.id_product, products.name_product, products.visibility');
        $this->db->where('division.code_division', 'TKS');
        $this->db->where('employee.id_product', $idProduct);
        $this->db->from('employee');
        $this->db->join('products', 'products.id_product = employee.id_product', 'left');
        $this->db->join('position', 'position.id_position = employee.id_position', 'left');
        $this->db->join('division', 'division.id_division = employee.id_division', 'left');
        $query = $this->db->get();
        return $query->result_array();
	}


    public function findAllTechnician_get()
	{
        $this->db->select('employee.id_employee, employee.date_in, employee.nip, employee.name, employee.gender, employee.place_of_birth, employee.date_of_birth, employee.basic_salary, employee.uang_makan, employee.bonus, employee.email, employee.id_position, division.id_division, position.id_position, employee.id_division, division.name_division, division.code_division, position.name_position, employee.status, products.id_product, products.name_product, products.visibility');
        $this->db->where('division.code_division', 'TKS');
        $this->db->from('employee');
        $this->db->join('products', 'products.id_product = employee.id_product', 'left');
        $this->db->join('position', 'position.id_position = employee.id_position', 'left');
        $this->db->join('division', 'division.id_division = employee.id_division', 'left');
        $query = $this->db->get();
        return $query->result_array();
	}
    

    public function findForCodeDivision_get($id)
	{
        $this->db->select('
        employee.id_employee, employee.date_in, employee.nip, employee.name, 
        employee.gender, employee.place_of_birth, employee.date_of_birth, 
        employee.basic_salary, employee.uang_makan, employee.bonus, employee.email,
        employee.id_position, division.id_division, position.id_position, 
        employee.id_division, division.name_division, division.code_division, 
        position.name_position, employee.status, 
        products.id_product, products.name_product, products.visibility');
        $this->db->from('employee');
        $this->db->join('products', 'products.id_product = employee.id_product', 'left');
        $this->db->join('position', 'position.id_position = employee.id_position', 'left');
        $this->db->join('division', 'division.id_division = employee.id_division', 'left');
        $this->db->where('employee.id_employee', $id); // Hanya filter berdasarkan id_employee
        
        $query = $this->db->get();
        return $query->result_array();
	}


	public function create_post($data)
    {
        if ($this->db->insert('employee', $data)) {
            return true;
        } else {
            return false;
        }
    }


    public function delete($id)
    {
        return $this->db->delete('employee', ['id_employee' => $id]);
    }


    public function findByNip_get($nip) 
    {
       return $this->db->get_where('employee', ['nip' => $nip])->row_array();
    }
    public function update_post($id, $data) 
    {
        $this->db->where('id_employee', $id);
        return $this->db->update('employee', $data);
    }

    public function totalEmployees_get()
    {
        $count =  $this->db->get('employee')->num_rows();
    
        return $count;
    }




    public function getEmployeesData($product = null) 
    {
		$employee = $this->input->post('employee');

        $this->db->select('employee.id_employee, employee.date_in, employee.nip, employee.name, employee.type_employee , employee.contract_expired, employee.gender, employee.place_of_birth, employee.date_of_birth, employee.basic_salary, employee.uang_makan, employee.bonus, employee.email, employee.id_position, employee.id_division, division.id_division, position.id_position, division.name_division, position.name_position, employee.status, products.id_product, products.name_product, products.visibility, address.id_address, address.kabupaten, address.desa, address.kecamatan, address.blok, address.spesifik, address.kode_pos,
            domisili.id_domisili, domisili.kabupaten_domisili, domisili.desa_domisili, domisili.kecamatan_domisili,
            domisili.blok_domisili, domisili.spesifik_domisili, domisili.kode_pos_domisili');

		if(!empty($employee)){
			$this->db->where('employee.id_employee', $employee);
		}
        $this->db->from('employee');
        $this->db->join('products', 'products.id_product = employee.id_product', 'left');
        $this->db->join('position', 'position.id_position = employee.id_position', 'left');
        $this->db->join('division', 'division.id_division = employee.id_division', 'left');
        $this->db->join('domisili', 'domisili.id_employee = employee.id_employee', 'left');  
        $this->db->join('address', 'address.id_employee = employee.id_employee', 'left'); 
    
        if ($product && $product !== 'All') {  
            $this->db->where('employee.id_product', $product);
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


	public function get_datatables($product = null)
	{
		$this->getEmployeesData($product);
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}


	public function count_filtered($product = null)
	{
		$this->getEmployeesData($product);
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function count_all()
	{
		$this->db->from('employee');
		return $this->db->count_all_results();
	}


    public function findByDivisionId_get($id) 
    {
       return $this->db->get_where('employee', ['id_division' => $id])->row_array();
    }


    public function findByPositionId_get($id) 
    {
       return $this->db->get_where('employee', ['id_position' => $id])->row_array();
    }


	public function create_allDataEmployees($emp, $account, $bank, $ec, $address, $domisili)
	{
		$this->db->trans_start();


		$this->db->insert('employee', $emp);
		$employeeId = $this->db->insert_id();
		if (!$employeeId) {
			$this->db->trans_rollback();
			return false;
		}

		$this->db->insert('admin', $account);

		$bank['id_employee'] = $employeeId;
		$this->db->insert('bank_account', $bank);

		$ec['id_employee'] = $employeeId;
		$this->db->insert('emergency_contact', $ec);

        $address['id_employee'] = $employeeId;
		$this->db->insert('address', $address);

        $domisili['id_employee'] = $employeeId;
		$this->db->insert('domisili', $domisili);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}


	public function renewContract_post($id, $status)
	{

		$this->db->set('contract_expired', $status);
		$this->db->where('id_employee', $id);
		$this->db->update('employee');

		return true;

	}

	public function changeEmail_post($oldEmail, $newEmail)
	{

		$this->db->where('email', $oldEmail);
		$this->db->set('email', $newEmail);
		$this->db->update('employee');

		return true;

	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

	private $column_search = array('name', 'email', 'role', 'status', 'ip_address');
	private $column_order = array('name', 'email', 'role', 'status', 'ip_address');
	private $order = array('name' => 'asc');


   public function findByEmail_get($email, $password) 
   {
    
    $lb = new Opensslencryptdecrypt();
    $encrypt =$lb->encrypt($password);

    $user = $this->db->get_where('admin', ['email' => $email])->row_array();

    if($user && $user['password'] === $encrypt){
        return $user;
    }

    return null;
  
   
   }

	public function changeEmailNPassword_post($oldEmail, $newEmail, $password)
	{

		$lb = new Opensslencryptdecrypt();
		$encrypt =$lb->encrypt($password);

		$this->db->where('email', $oldEmail);
		$this->db->set(['email' => $newEmail, 'password' => $encrypt]);
		$this->db->update('admin');

		return true;


	}


	public function findByEmailOnly_get($email)
	{
		$user = $this->db->get_where('admin', ['email' => $email])->row_array();

		if (!$user) {
			return null; // Jika user tidak ditemukan
		}

		return $user; // Kembalikan data tanpa mengubah password
	}


   public function findByEmailForEdit_get($email)
   {

    return $this->db->get_where('admin', ['email' => $email])->row_array();

   }


   public function findAll_get()
   {
    return $this->db->get('admin')->result_array();
   }


    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('admin', $data);
        return $this->db->affected_rows();
    } 


   public function create_post($data)
   {
    $this->db->insert('admin', $data);
    return $this->db->insert_id(); 
   }


   public function createuser_post($data)
    {
        if ($this->db->insert('admin', $data)) {
            return true;
        } else {
            return false;
        }
    }


   public function findById_get($id)
   {
    return $this->db->get_where('admin', ['id' => $id])->row_array();
   }


   public function updateLogin_post($email)
   {
    $Lib = new Informationclient();
    $ip  = $Lib->ipclient();

    $this->db->set('last_login', date('Y-m-d H:i:s'));
    $this->db->set('ip_address', $ip);
    $this->db->where('email', $email);
    $this->db->update('admin');

   }


   public function totalAdmins_get()
   {
    $count = $this->db->where('role', 1)->count_all_results('admin');

    return $count;
   }


   public function totalSuperUsers_get()
   {
    $count = $this->db->where('role', 2)->count_all_results('admin');

    return $count;
   }


   public function totalUsers_get()
   {
    $count =  $this->db->get('admin')->num_rows();

    return $count;
   }


   public function update_post($id, $data)
   {
       $this->db->where('id', $id);
       return $this->db->update('admin', $data);
   }
   

   public function delete($id)
    {
        return $this->db->delete('admin', ['id' => $id]);
    }


	public function getUserData($role = null, $product = null)
	{

		$this->db->select('admin.id, admin.name, admin.email, admin.role, admin.password, admin.status, admin.last_update, admin.last_login, admin.ip_address, admin.avatar, employee.id_product, products.name_product');
		$this->db->join('employee', 'employee.email = admin.email', 'left');
		$this->db->join('products', 'products.id_product = employee.id_product', 'left');
		$this->db->from('admin');
		if ($role && $role !== 'All') {
			$this->db->where('role', $role);
		}
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

	public function get_datatables($role = null, $product = null)
	{
		$this->getUserData($role, $product);
		if (@$_POST['length'] != -1) {
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}


	public function count_filtered($role = null, $product = null)
	{
		$this->getUserData($role, $product);
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function count_all()
	{
		$this->db->from('admin');
		return $this->db->count_all_results();
	}

}

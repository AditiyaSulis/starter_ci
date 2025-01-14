<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Admin extends CI_Model {

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

}
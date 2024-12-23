<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Admin extends CI_Model {
   public function getBy_email_password($email, $password) {
    $lb = new Opensslencryptdecrypt();
    $encrypt =$lb->encrypt($password);
  
    return $this->db->get_where('admin', ['email' => $email, 'password' => $encrypt])->row_array();
   }

   public function getAll(){
   return $this->db->get('admin')->result();
   }

    public function update($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('admin', $data);
        return $this->db->affected_rows();
    }   

   public function create($data){
    $this->db->insert('admin', $data);
    return $this->db->insert_id(); 
   }

   public function findById($id){
    return $this->db->get_where('admin', ['id' => $id])->row_array();
   }

   public function update_login($email){
    $Lib = new Informationclient();
    $ip  = $Lib->ipclient();

    $this->db->set('last_login', date('Y-m-d H:i:s'));
    $this->db->set('ip_address', $ip);
    $this->db->where('email', $email);
    $this->db->update('admin');
   }

   public function total_admins(){
    $count = $this->db->where('role', 1)->count_all_results('admin');

    return $count;
   }

   public function total_super_users(){
    $count = $this->db->where('role', 2)->count_all_results('admin');

    return $count;
   }

   public function total_users(){
    $count =  $this->db->get('admin')->num_rows();

    return $count;
   }
}
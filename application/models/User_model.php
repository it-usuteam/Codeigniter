<?php

class User_model extends CI_Model {
  private $username, $fullname, $email, $pass, $role, $activationKey, $forgot_key, $registered_on;

  public function __construct() {
    parent::__construct();
  }

  public function get_username() {
    return $this->username;
  }

  public function get_fullname() {
    return $this->fullname;
  }

  public function is_activated() {
    return empty($this->activation_key) || is_null($this->activation_key) ? FALSE : TRUE;
  }

  public function fill_model($username) {
    // Query will be created by Query Builder, which is a bit nice.
    if(! empty($username)) {
      $query = $this->db->get_where('users',[ 'username' => $username, ]);
      if($query->num_rows() > 0) {
          $result = $query->result()[0];
          $this->username = $result->username;
          $this->fullname = $result->fullname;
          $this->pass = $result->pass;
          $this->role = $result->role;
          $this->activation_key = $result->activation_key;
          $this->forgot_key = $result->forgot_key;
          $this->registered_on = $result->registered_on;
          return TRUE;
      }
    }
    return FALSE;
  }

  public function verify_password($password) {
    if(! is_null($this->pass))
      return password_verify($password, $this->pass);
    return FALSE;
  }

  // public function init_admin() {
    // An example for trying bcrypt password

    // $query = $this->db->insert('users', [
    //     'username' => 'matt',
    //     'fullname' => 'Matthew Wu',
    //     'email'    => 'Ruswan.Wu@outlook.com',
    //     'pass'     => password_hash('passwordmusayangku', PASSWORD_BCRYPT, [ 'cost' => 12]),
    //     'role'     => 1,
    //   ]);
  // }
}

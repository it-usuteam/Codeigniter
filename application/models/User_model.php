<?php

class User_model extends CI_Model {
  public $username, $fullname, $email, $pass, $role, $activation_key, $forgot_key, $registered_on;

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
    $password = $this->db->escape($password);
    if(! is_null($this->pass)) {
      var_dump($password);
      return password_verify($password, $this->pass);
    }
    return FALSE;
  }

  public function generate_password($password) {
    $password = $this->db->escape($password);
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 9]);
  }

  // Code for activation key are acquired
  // from http://stackoverflow.com/questions/3290283/what-is-a-good-way-to-produce-a-random-site-salt-to-be-used-in-creating-passwo/3291689#3291689
  public function generate_activation_key() {
    $charset = '12345987ABCEFHKLMNQOPSTVWXYZabthefoxyesabcdghijklmnpqrzuvr';
    $token = "";
    for($i = 0; $i < 62; $i++) {
      $token .= $charset[$this->randomize_key(0, strlen($charset))];
    }
    return $token;
  }

  private function randomize_key($min, $max) {
    if($max - $min < 0) return $min;
    $log = log($max-$min, 2);
    $bytes = (int) $log / 8 + 1;
    $filter = (int) (1 << (intval($log) + 1)) - 1;
    do {
      $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
      $rnd = $rnd & $filter;
    } while($rnd >= ($max - $min));
    return $min + $rnd;
  }

  public function save_new_user() {
    $old = $this->db->db_debug;
    $this->db->db_debug = FALSE;
    // TODO AUTO_INCREMENT always return last user id + sign up attemp, fix this.
    $this->db->trans_start();
    $this->db->simple_query("ALTER TABLE users SET AUTO_INCREMENT = 1");
    $query = $this->db->insert('users', [
        'username' => $this->username,
        'fullname' => $this->fullname,
        'email'    => $this->email,
        'pass'     => $this->password,
        'role'     => $this->role,
        'activation_key' => $this->activation_key,
    ]);
    $this->db->db_debug = $old;
    if($this->db->affected_rows() > 0 && $this->db->error()['code'] == 0 && $this->db->trans_status() == TRUE) {
      $this->db->trans_commit();
      return true;
    } else {
      $this->db->trans_rollback();
      return $this->db->error();
    }
  }

  public function get_role_name() {
    if(!(is_null($this->role) || empty($this->role))) {
      $query = $this->db->get_where('role',[ 'id' => $this->role, ]);
      if($query->num_rows() > 0)
        return $query->result()[0]->name;
    }
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

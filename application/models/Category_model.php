<?php

class Category_model extends CI_Model {
  public $id, $name, $slug, $parent;

  public function __construct($id = NULL) {
    parent::__construct();
    if(!is_null($id))
      $this->fill_model($id);
  }

  public function fill_model($id) {
    // Query will be created by Query Builder, which is a bit nice.
    if(! empty($id)) {
      $query = $this->db->query('SELECT id, name, slug, parent_id FROM category WHERE
        id = ?', $id);
      if($query->num_rows() > 0) {
          $result = $query->result()[0];
          $this->id = $result->id;
          $this->name = $result->name;
          $this->slug = $result->slug;
          $this->parent = $result->parent_id;
          return TRUE;
      }
    }
    return FALSE;
  }

  // Get entries with static context
  public static function get_all_entry() {
    // Source : http://stackoverflow.com/questions/15631078/codeigniter-loading-a-library-in-a-static-function
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->query("SELECT id from category");
    if($query->num_rows() > 0) {
      foreach($query->result() as $result) {
          $res_model[] = new Category_model($result->id);
      }
      return $res_model;
    }
    return FALSE;
  }

  public static function get_entries_count() {
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->query("SELECT count(id) as 'count' from category");
    if($query->num_rows() > 0)
      return $query->result()[0]->count;
    else {
      return false;
    }
  }

  public function get_parent_category() {
    if( ! empty($this->parent) && ! is_null($this->parent)) {
      return new Category_model($this->parent);
    }
  }
}

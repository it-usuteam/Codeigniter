<?php

class Post_model extends CI_Model {
  public $id, $username, $title, $content, $pass, $slug, $comment_enabled, $post_enabled, $created, $modified;

  public function __construct($slug = NULL) {
    parent::__construct();
    if(!is_null($slug))
      $this->fill_model($slug);
  }

  public function fill_model($slug) {
    // Query will be created by Query Builder, which is a bit nice.
    if(! empty($slug)) {
      $query = $this->db->query('SELECT id, (select username from users where id = post.user_id limit 1) as \'username\',
          title, content, pass, comment_status, post_status, time_created, time_modified FROM post where slug = '.
          $this->db->escape($slug));
      if($query->num_rows() > 0) {
          $result = $query->result()[0];
          $this->id = $result->id;
          $this->username = $result->username;
          $this->title= $result->title;
          $this->content = $result->content;
          $this->pass = $result->pass;
          $this->slug = $slug;
          $this->created = $result->time_created;
          $this->modified = $result->time_modified;
          $this->comment_enabled = $result->comment_status;
          $this->post_enabled = $result->post_status;
          return TRUE;
      }
    }
    return FALSE;
  }

  // Function to check entry's flags
  public function is_posted() { return $this->post_enabled; }
  public function is_comment_enabled() { return $this->comment_enabled; }

  // Get entries with static context
  public static function get_all_entry($limit = 5, $page = 1) {
    // Source : http://stackoverflow.com/questions/15631078/codeigniter-loading-a-library-in-a-static-function
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->query("SELECT slug from post order by time_created limit ".$ci->db->escape($limit * ($page - 1)).", ".$ci->db->escape($limit));
    if($query->num_rows() > 0) {
      foreach($query->result() as $result) {
          $res_model[] = new Post_model($result->slug);
      }
      return $res_model;
    }
    return FALSE;
  }

  public static function get_entries_count() {
    $ci =& get_instance();
    $ci->load->database();
    $query = $ci->db->query("SELECT count(id) as 'count' from post");
    if($query->num_rows() > 0)
      return $query->result()[0]->count;
    else {
      return false;
    }
  }
}

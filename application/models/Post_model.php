<?php

class Post_model extends CI_Model {
  public $id, $username, $title, $content, $pass, $slug, $comment_enabled, $post_enabled, $created, $modified;
  public $categories;

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
          $cat_query = $this->db->query('SELECT id FROM post_category WHERE post_id = ?', $this->id);
          if($cat_query->num_rows() > 0) {
            foreach($query->result() as $res) {
              $categories[] = $res->id;
            }
          }
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

  public function save_entries() {
    if(empty($this->id) && !empty($this->slug) && !empty($this->title)) {
      $this->db->trans_start();
      $query = $this->db->query('INSERT INTO post(title, content, pass, slug, post_status,
        comment_status, user_id) VALUES(?, ?, ?, ?, ?, ?, (SELECT id FROM users WHERE username = ?))', [
        $this->title, $this->content, $this->pass, $this->slug, $this->post_enabled, $this->comment_enabled, $this->username,
      ]);
      if($this->db->affected_rows() > 0 && $this->db->error()['code'] == 0 && $this->db->trans_status() == TRUE) {
        $new_id = $this->db->insert_id();
        if(is_array($this->categories)) {
          foreach($this->categories as $category) {
            $this->db->insert('post_category', [
              'post_id' => $new_id,
              'category_id' => $category,
            ]);
          }
        }
        if($this->db->trans_status() && $this->db->error()['code'] == 0) {
          $this->db->trans_commit();
          $this->fill_model($new_id);
          return TRUE;
        } else {
          $this->db->trans_rollback();
          return $this->db->error();
        }
      }
    }
    return FALSE;
  }

  public static function delete_entry($slug) {
      $ci =& get_instance();
      $ci->load->database();
      $ci->db->trans_start();
      $query = $ci->db->query('DELETE FROM post WHERE slug = ?', [$slug]);
      if($ci->db->trans_status()) {
        $ci->db->trans_commit();
        return TRUE;
      }
      else {
        $ci->db->trans_rollback();
        return FALSE;
      }
  }
}

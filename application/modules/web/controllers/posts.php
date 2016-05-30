<?php

	if(!defined('BASEPATH'))
		exit("Access forbidden.");

  class Posts extends MX_Controller {
    function __construct() {
      parent::__construct();
      $this->load->model('Post_model');
    }

    public function view($slug) {
      $model = new Post_model();
      $status = $model->fill_model($slug);
      if($status === TRUE) {
        $writer = new User_model();
        $writer_info = NULL;
        if($writer->fill_model($model->username)) {
          $writer_info = [
            'fullname' => $writer->fullname,
            'member_since' => $writer->registered_on,
            'role_name' => $writer->get_role_name(),
          ];
        }
        $view = $this->load->view('web/posts/view', [
          'news' => $model,
          'writer_info' => $writer_info,
        ], TRUE);
        $this->load->view('web/layout/container_main', [
          'content' => $view,
        ]);
      } else {
        show_404();
      }
    }
  }

<?php

	if(!defined('BASEPATH'))
		exit("Access forbidden.");

	class Posts extends MX_Controller {

		function __construct() {
			parent::__construct();
		}

		public function index($page = 1, $limit = 5) {
      $this->load->model('Post_model'); // Load post model
      $model_list = Post_model::get_all_entry(intval($limit), intval($page)); // Get entries
      $view = $this->load->view("admin/post/index", [
        'news' => $model_list,
        'paging' => [
          'current' => $page,
          'counter' => $limit,
          'total'   => Post_model::get_entries_count(),
        ],
      ], true);
			$this->load->view("admin/site/layout", [
				'content' => $view,
			]);
		}

    public function edit($slug) {
      $this->load->model('Post_model');
      $model = new Post_model();
      $model->fill_model($slug);

      if($model->is_posted())
        $view = $this->load->view('admin/post/edit', [
          'news' => $model,
        ], true);
      else
        $view = (is_bool($model->is_posted()) ? "You don't have access to this page. ": "Content doesn't exist.");

      $this->load->view('admin/site/layout', [
        'content' => $view,
      ]);
    }
	}

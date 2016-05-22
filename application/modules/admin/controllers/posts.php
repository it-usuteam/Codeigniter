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

		public function create() {
			$this->load->model('Post_model');
			$this->load->model('Category_model');
			if($this->input->method(FALSE) == 'post') {
				$model = new Post_model();
				$model->title = $this->input->post('title');
				$model->username = $this->session->userdata('username');
				$model->content = $this->input->post('content');
				$model->pass = $this->input->post('pass');
				$model->slug = strtolower($this->input->post('slug'));
				$model->comment_enabled = $this->input->post('comment_status');
				$model->post_enabled = $this->input->post('post_status');
				$model->categories = $this->input->post('category');
				$status = $model->save_entries();
				if(is_array($status))
					echo $status['message'];
				else if($status === TRUE)
					echo 'true';
			} else {
				$form_view = $this->load->view('admin/post/_form', [
					'category' => Category_model::get_all_entry(),
				], TRUE);
				$view = $this->load->view('admin/post/create',[
					'form' => $form_view,
				], TRUE);
				$this->load->view('admin/site/layout', [
					'content' => $view,
				]);
			}
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

		public function delete($slug) {
			$this->load->model('Post_model');
			// TODO Improve security
			$status = Post_model::delete_entry($slug);
			echo strval($status);
		}
	}

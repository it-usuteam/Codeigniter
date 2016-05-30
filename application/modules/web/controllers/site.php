<?php

	if(!defined('BASEPATH'))
		exit("Access forbidden.");

	class Site extends MX_Controller {

		function __construct() {
			parent::__construct();
				$this->load->library('session');
				$this->load->model("User_model");
		}

		public function index() {
			 // TODO Fix this guy's security problem
			$username = $this->session->userdata('username');
			$model = new User_model();
			if($model->fill_model($username))
				$user = [
					'username' => $model->get_username(),
					'fullname' => $model->get_fullname(),
					'activated' => $model->is_activated(),
				];
			else
				$user = NULL;
			$this->load->helper('form');
			$view = $this->load->view("web/site/index", [
					'user' => $user,
				], TRUE);
			$this->load->view('web/layout/container_main', [
				'content' => $view,
			]);
			$this->session->set_flashdata('prev_dest', $this->router->fetch_module().'/'.
				$this->router->fetch_class().'/'.$this->router->fetch_method());
		}
	}

<?php

	if(!defined('BASEPATH'))
		exit("Access forbidden.");

	class Site extends MX_Controller {

		function __construct() {
			parent::__construct();
		}

		public function index() {

			$view = $this->load->view("admin/site/index", '', true);
			$this->load->view("admin/site/layout", [
				'content' => $view,
			]);
		}

	}

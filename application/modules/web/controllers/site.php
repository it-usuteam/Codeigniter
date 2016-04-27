<?php

	if(!defined('BASEPATH'))
		exit("Access forbidden.");
	
	class Site extends MX_Controller {
		
		function __construct() {
			parent::__construct();
		}
		
		public function index() {
			$this->load->view("web/site/index");
		}
	}
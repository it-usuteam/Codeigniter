<?php

	if(!defined('BASEPATH'))
		exit("Access forbidden.");

	class Login extends MX_Controller {

		function __construct() {
			parent::__construct();
      // Load session library
      $this->load->library('session');
		}

		public function process() {
        // var_dump($this->input->post());
        $this->load->helper('url');
        $this->load->model('User_model');
        $model = new User_model();
        $model->fill_model($this->input->post('username'));
        if( ! is_null($this->input->post('password')) && $model->verify_password($this->input->post('password'))) {
          // This is not safe, someone could use cookie editor to enter our system as anybody else
          // if they know its username. I think we will user's status from database so it'll not
          // be used by somebody else.
          $this->session->set_userdata("username", $this->input->post('username'));
        } else {
          $this->session->set_flashdata('login_error', "Please check again!");
        }
        if(! is_null($this->session->flashdata('prev_dest'))) {
          redirect($this->session->flashdata('prev_dest'));
        }
		}

    public function signup() {

    }

    public function signout() {
      $this->session->sess_destroy();
      if(!is_null($this->session->flashdata('prev_dest')))
        redirect($this->session->flashdata('prev_dest'));
      else
          redirect('/web/site/index');
    }
	}

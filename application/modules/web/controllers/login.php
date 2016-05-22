<?php

	if(!defined('BASEPATH'))
		exit("Access forbidden.");

	class Login extends MX_Controller {

		function __construct() {
			parent::__construct();
      // Load session library
      $this->load->library('session');
		}

		private function is_logged() {
			$username = $this->session->userdata('username');
			if( ! is_null($username) && !empty($username))
				return true;
			return false;
		}

		public function process() {
        // var_dump($this->input->post());
        $this->load->helper('url');
        $this->load->model('User_model');
				if($this->is_logged() === false) {
	        $model = new User_model();
	        $model->fill_model($this->input->post('username'));
	        if( ! is_null($this->input->post('password')) && $model->verify_password($this->input->post('password'))) {
	          // This is not safe, someone could use cookie editor to enter our system as anybody else
	          // if they know its username. I think we will user's status from database so it'll not
	          // be used by somebody else.
	          $this->session->set_userdata("username", $this->input->post('username'));
	        } else {
	          $this->session->set_flashdata('login_error', "Please check again!");
						redirect(site_url('web/login/signup_login'));
	        }
				}
        if(! is_null($this->session->flashdata('prev_dest'))) {
          redirect($this->session->flashdata('prev_dest'));
        } else {
					redirect(base_url());
				}
		}

    public function signup_login() {
			$this->load->model("User_model");
			$this->load->helper('url');
			if($this->input->method(FALSE) == 'post') {
				if(empty($this->input->post('username')) || empty($this->input->post('password')) ||
					 empty($this->input->post('fullname')) || empty($this->input->post('email')))
						 $this->session->set_flashdata('error', 'Please fill the fields or we will dislike you. ');
			 	else {
					$model = new User_model;
					$model->username = $this->input->post('username');
					$model->fullname = $this->input->post('fullname');
					$model->password = $model->generate_password($this->input->post('password'));
					$model->email = $this->input->post('email');
					$model->role = 4;
					$model->activation_key = $model->generate_activation_key();
					$res = $model->save_new_user();
					if(!is_array($res)) {
          	$this->session->set_userdata("username", $model->username);
						redirect(base_url());
					} else {
						$this->load->view('web/login/signup', [
							'error' => $res,
							'data' => $model,
						]);
					}
				}
			} else {
				if(! $this->is_logged())
					$this->load->view('web/login/signup', [
						'title' => 'Sign Up or Log In',
					]);
				else
					show_error("You've been logged in. ", 403, "Prohibited Access");
			}
    }

    public function signout() {
      $this->session->sess_destroy();
      if(!is_null($this->session->flashdata('prev_dest')))
        redirect($this->session->flashdata('prev_dest'));
      else
          redirect('/web/site/index');
    }

		public function check_access() {
			$this->load->model("User_model");
			$this->load->helper('url');
			$user_model = new User_model();
			$user_load = $user_model->fill_model($this->session->userdata('username'));
			if($this->router->fetch_module() == 'admin') {
				if(! $this->is_logged())
					redirect('web/login/signup_login');
				else if ($user_load == false || $user_model->role == 4)
					show_error("You are not allowed to access this page. Please contact administrator for solution. ", 403, 'Restricted Access');
			}
		}
	}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landing extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(
			array(
				"user_model" => "user_m"
			)
		);
        $this->lang->load('menu_lang', 'indonesian');
	}

	public function index()
	{
		// if already login, show index page
		if ($this->session->userdata('login')) {
			$data['page_title'] = "Welcome";
			$data['page_content'] = $this->load->view("landing/index", "", true);

			$this->load->view('layout/head');
			$this->load->view('layout/base', $data);
			$this->load->view('layout/js');
		} else { 
			$this->load->view('landing/head');
			$this->load->view('landing/login');
			$this->load->view('landing/js');
		}
	}

	public function register()
	{
		var_dump($this->session->userdata('user'));
		// if already login, redirect to dashboard
		if ($this->session->userdata('user')) {
			redirect(
				base_url("/index.php/dashboard")
			);
		}
		$this->load->view('landing/head');
		$this->load->view('landing/register');
		$this->load->view('landing/js');
	}
	public function do_login()
	{
		$login_data = array(
			"username" => $_POST['username'],
			"password" => md5($_POST['password'])
		);
 
		// check if login data match in database
		$user_query = $this->user_m->get($login_data);
		// echo json_encode($user_query);exit;
		if ($user_query->num_rows()) {
			// do login
			$this->session->set_userdata(
				array(
					"login" => true,
					"username" => $_POST['username'],
					"name" => $user_query->row()->name,
					"email" => $user_query->row()->email,
					"id" => $user_query->row()->id,
					"branch_id" => $user_query->row()->branch_id,
					"branch_name" => $user_query->row()->branch_name,
				)
			);
		} else {
			$this->session->set_flashdata('error', 'Username and password did not match');
		} 

		redirect(base_url());
	}

	public function do_register()
	{
		$signup_data = array(
			"name" => $_POST['fullname'],
			"email" => $_POST['email'],
			"username" => $_POST['username'],
			"password" => md5($_POST['password'])
		);

		// insert to database
		$user_query = $this->user_m->insert($signup_data);

		// do login
		$this->session->set_userdata(
			array(
				"login" => true,
				"username" => $_POST['username'],
				"name" => $_POST['fullname'],
				"email" => $_POST['email'],
				"id" => $user_query->row()->id,
			)
		);
		redirect(base_url());
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}

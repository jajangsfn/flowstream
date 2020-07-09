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

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}

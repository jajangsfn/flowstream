<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // if already login, redirect to dashboard
        if ($this->session->userdata('login') == null) {
            redirect(
                base_url()
            );
        }
        $this->load->model(
            array(
                "user_model" => "user_m"
            )
        );
    }

    public function index()
    {
        $data['back_url'] = base_url();
        $data['page_title'] = "Dashboard";
        $data['page_content'] = $this->load->view("dashboard/content", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }
}

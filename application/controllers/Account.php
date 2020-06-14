<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
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
        $data['page_title'] = "Profile";
        $data['page_content'] = $this->load->view("profile/content", "", true);
        
        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    function get_md5($char='admin')
    {
        echo md5($char);
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Receiving extends CI_Controller
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
        $this->lang->load('menu_lang', 'indonesian');
        $this->load->model(
            array(
                "user_model" => "user_m",
                "M_partner_model"=>"partner",
                "M_goods_model"=>"goods",
                "Receiving_model" => "rm",
                "Receiving_detail_model" => "rdm",
                "S_history_model" => "history",
            )
        );
    }

    // receiving
    public function index()
    {
        $data['page_title'] = "Receiving";
        $data['page_content'] = $this->load->view("inventori/receiving", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }


    public function add_receiving()
    {
        if (count($_POST)) {

            if (array_key_exists("id", $_POST)) {

            } else {

            }
        }



        $data['page_title']   = "Receiving";
        $data['supplier']     = $this->get_partner(array("is_supplier"=>1));
        $data['po_no']        = generate_po_receive_no();
        $data['master']       = array();
        $data['page_content'] = $this->load->view("inventori/receiving/add_receiving", $data ,true);

        $this->load->view('layout/head');
        $this->load->view('layout/base_maxwidth', $data);
        $this->load->view('layout/js');
        $this->load->view("inventori/receiving/receiving_js");
    }



}
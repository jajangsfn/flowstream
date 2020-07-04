<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login') == null) {
            redirect(
                base_url()
            );
        }
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
        $this->load->model(
            array(
                "user_model" => "user_m",
                "m_partner_model" => "partner",
                "m_goods_model" => "goods",
            )
        );
    }

    public function get_barang($id)
    {
        $data_query = $this->goods->get("m_goods.id = $id")->row();
        $response = array();
        foreach ($data_query as $key => $val) {
            $response[$key] = $val;
        }
        $data['data'] = $response;
        echo json_encode($data);
    }
}

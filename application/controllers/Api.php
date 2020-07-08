<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
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

    public function register()
    {
        $signup_data = array(
            "email" => $_POST['email'],
            "user_id" => $_POST['username'],
            "password" => md5($_POST['password'])
        );

        // insert to database
        $user_query = $this->user_m->insert($signup_data);

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

        // report last login
        $this->user_m->login(array("id" => $user_query->row()->id));
        redirect(base_url());
    }

    public function login()
    {
        $login_data = array(
            "m_user.user_id" => $_POST['username'],
            "password" => md5($_POST['password'])
        );

        // check if login data match in database
        $user_query = $this->user_m->get($login_data);
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

    public function get_barang($id)
    {
        $data_query = $this->goods->get("m_goods.id = $id")->row();
        $data['data'] = $data_query;
        echo json_encode($data);
    }

    public function barang()
    {
        $data_query = $this->goods->get_complete()->result();
        $data['data'] = $data_query;
        echo json_encode($data);
    }

    public function ubah_harga_barang()
    {
        if ($_POST['price_index'] == 0) {
            echo json_encode(array("message" => "masuk 0"));

            $this->goods->change_main_price(
                array(
                    "goods_id" => $_POST['id']
                ),
                array(
                    "price" => $_POST['price'],
                )
            );
        } else {
            echo json_encode(array("message" => "masuk lain"));
            $price_id = $this->goods->get_price(array(
                "goods_id" => $_POST['id']
            ))->row()->id;
            $this->goods->change_price_alternate(
                array(
                    "price_id" => $price_id,
                    "price_index" => $_POST['price_index'],
                ),
                array(
                    "price" => $_POST['price'],
                )
            );
        }
    }

    public function customer()
    {
        $data_query = $this->partner->get_customer()->result();
        $data['data'] = $data_query;
        echo json_encode($data);
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
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
                "M_account_code_model" => "account",
                "m_partner_model" => "partner",
                "m_partner_type_model" => "partner_type",
                "m_partner_salesman_model" => "part_salesman",
                "m_user_salesman_model" => "usr_salesman",
                "m_salesman_map_model" => "salesman_map",
                "m_map_model" => "m_map",
                "m_unit_model" => "unit",
                "m_goods_model" => "goods",
                "m_branch_model" => "branch",
                "m_warehouse_model" => "warehouse",
                "m_employee_model" => "employee",
                "m_journal_mapping_model" => "jurnal_mapping",
                "s_reference_model" => "reference",
                "t_order_request_model" => "or",
                "t_pos_model" => "pos",
                "T_jurnal_model" => "jurnal",
                "Keuangan_model" => "keumod"
            )
        );
    }

    public function index()
    {
        echo json_encode($this->session->userdata);
    }

    public function check_username($username)
    {
        echo json_encode(
            array(
                "data" => array(
                    "message" => $this->user_m->check_username($username)
                )
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
                "role_code" => $user_query->row()->role_code
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

            if ($user_query->row()->role_code != "ROLE_SUPER_ADMIN") {
                // look for branch info
                $branch_query = $this->branch->get(array("m_branch.id" => $user_query->row()->branch_id))->row();
            }

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
                    "level" => $user_query->row()->level_name,
                    "position" => $user_query->row()->position_name,
                    "role_code" => $user_query->row()->role_code,
                    "branch_obj" => $branch_query,
                    "branch_address" => $user_query->row()->address,
                )
            );
            // report last login
            $this->user_m->login(array("id" => $user_query->row()->id));
        } else {
            $this->session->set_flashdata('error', 'Username and password did not match');
        }
        redirect(base_url());
    }

    public function get_all_users()
    {
        // TODO: Require super admin login
        echo json_encode(
            array(
                "data" => $this->user_m->get_all_users()->result()
            )
        );
    }

    public function tambah_super_admin()
    {
        $this->user_m->insert(
            array(
                "user_id" => $_POST['user_id'],
                "account_non_expired" => 1,
                "account_non_locked" => 1,
                "change_pwd_counter" => 0,
                "credentials_non_expired" => 1,
                "email" => $_POST['email'],
                "created_by" => $this->session->userdata("id"),
                "created_date" => date("Y-m-d h:i:s"),
                "enabled" => 1,
                "fail_counter" => 0,
                "password" => md5($_POST['password']),
                "role_code" => "ROLE_SUPER_ADMIN"
            )
        );

        $this->session->set_flashdata("success", "Super Admin berhasil didaftarkan");
        redirect($_SERVER['HTTP_REFERER']);
    }
}

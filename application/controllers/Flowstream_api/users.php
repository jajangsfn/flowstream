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

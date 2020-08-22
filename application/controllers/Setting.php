<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
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
                "Delivery_order_model" => "delivery_order",
                "Delivery_team_model" => "delivery_team",
                "Delivery_cost_model" => "delivery_cost",
                "M_account_code_model" => "account",
                "M_goods_model" => "goods",
                "M_unit_model" => "unit",
                "M_employee_model" => "emp",
                "M_branch_model" => "branch",
                "M_master_model" => "master",
                "M_partner_model" => "partner",
                "M_partner_salesman_model" => "part_salesman",
                "M_user_salesman_model" => "part_usr_salesman",
                "M_partner_type_model" => "partner_type",
                "M_salesman_model" => "salesman",
                "M_salesman_map_model" => "salesman_map",
                "M_map_model" => "map",
                "M_event_model" => "event",
                "M_event_detail_model" => "event_detail",
                "M_promo_model" => "promo",
                "M_delivery_model" => "delivery",
                "M_warehouse_model" => "warehouse",
                "M_rekening_code_model" => "rekening_code",
                "Ol_connection_model" => "connection",
                "Ol_group_model" => "group",
                "Ol_group_detail_model" => "group_det",
                "Purchase_order_parameter_model" => "param_purchase_order",
                "Production_model" => "production",
                "Production_detail_model" => "production_detail",
                "S_reference_model" => "ref",
                "User_model" => "user_m"
            )
        );
    }

    public function index()
    {
        $data['back_url'] = base_url();
        $data['page_title'] = "Setting dan Konfigurasi";
        $data['page_content'] = $this->load->view("setting/index", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function master($category, $first = '', $second = '', $third = '', $fourth = '', $fifth = '')
    {
        $this->load->view('layout/head');
        $this->load->view('layout/base', $this->$category($first, $second, $third, $fourth, $fifth));
        $this->load->view('layout/js');
    }

    private function cabang($id = '', $firstpath = '', $second_path = '', $third_path = '', $fourth_path = '', $fifth_path = '')
    {
        $data['transactional'] = true;
        if ($id) {
            // data cabang
            $content['data_branch'] = $this->branch->get(array("id" => $id))->row();

            switch ($firstpath) {
                case 'barang':

                    if ($second_path == "harga") {
                        // pengaturan harga
                        $data['back_url'] = base_url("/index.php/setting/master/cabang/$id/barang");

                        $data['page_title'] = "Atur Harga Barang " . $content['data_branch']->id;
                        $data['transactional'] = true;
                        $data['page_content'] = $this->load->view("setting/master/cabang/harga", $content, true);
                        $data['page_js'] = $this->load->view("setting/master/cabang/harga_js", $content, true);
                    } else {
                        // pengaturan barang
                        // get division, subdivision, category, subcategory, package, color for goods
                        $content['division'] = $this->ref->get(array("group_data" => "GOODS_DIVISION"))->result();
                        $content['sub_division'] = $this->ref->get(array("group_data" => "GOODS_SUB_DIVISION"))->result();
                        $content['category'] = $this->ref->get(array("group_data" => "GOODS_CATEGORY"))->result();
                        $content['sub_category'] = $this->ref->get(array("group_data" => "GOODS_SUB_CATEGORY"))->result();
                        $content['package'] = $this->ref->get(array("group_data" => "GOODS_PACKAGE"))->result();
                        $content['color'] = $this->ref->get(array("group_data" => "GOODS_COLOR"))->result();
                        $content['unit'] = $this->unit->get_all()->result();
                        $content['accounts'] = $this->account->get(array(
                            "branch_id" => $id,
                            "is_active" => 1
                        ))->result();

                        $data['page_title'] = "Daftar Barang " . $content['data_branch']->name;
                        $data['transactional'] = true;
                        $data['back_url'] = base_url("/index.php/setting/master/cabang/$id");
                        $data['page_content'] = $this->load->view("setting/master/cabang/barang", $content, true);
                        $data['page_js'] = $this->load->view("setting/master/cabang/barang_js", $content, true);
                    }
                    break;
                case 'supplier':

                    if ($fourth_path) {
                        // data supplier nya
                        $content['data_supplier'] = $this->partner->get(
                            array(
                                "id" => $second_path,
                            )
                        )->row();

                        $content['data_salesman'] = $this->part_salesman->get(
                            array(
                                "id" => $fourth_path,
                            )
                        )->row();

                        $data['page_title'] = "Mapping barang untuk " . $content['data_salesman']->name;
                        $data['back_url'] = base_url("/index.php/setting/master/cabang/" . $content['data_branch']->id . "/supplier" . "/" . $content['data_supplier']->id . "/salesman");

                        $data['page_content'] = $this->load->view("setting/master/cabang/mapping_barang", $content, true);
                        $data['page_js'] = $this->load->view("setting/master/cabang/mapping_barang_js", "", true);
                    } else if ($third_path == "salesman") {
                        // data supplier nya
                        $content['data_supplier'] = $this->partner->get(
                            array(
                                "id" => $second_path,
                            )
                        )->row();

                        $content['data_salesman'] = $this->part_salesman->get(
                            array(
                                "partner_id" => $second_path,
                                "flag <> " => "99"
                            )
                        )->result();

                        $data['page_title'] = "Daftar Salesman untuk " . $content['data_supplier']->name;
                        $data['back_url'] = base_url("/index.php/setting/master/cabang/" . $content['data_branch']->id . "/supplier");
                        $data['page_content'] = $this->load->view("setting/master/cabang/salesman", $content, true);
                        $data['page_js'] = $this->load->view("setting/master/cabang/salesman_js", "", true);
                    } else {
                        // pengaturan supplier
                        $data['page_title'] = "Daftar Supplier " . $content['data_branch']->name;

                        $content['m_master'] = $this->master->get_all()->result();
                        $data['back_url'] = base_url("/index.php/setting/master/cabang/" . $content['data_branch']->id);
                        $data['page_content'] = $this->load->view("setting/master/cabang/supplier", $content, true);
                        $data['page_js'] = $this->load->view("setting/master/cabang/supplier_js", $content, true);
                        $data['transactional'] = true;
                    }
                    break;
                case "customer":
                    if ($third_path == "salesman") {
                        // data supplier nya
                        $content['data_customer'] = $this->partner->get(
                            array(
                                "id" => $second_path,
                            )
                        )->row();

                        $content['data_salesman'] = $this->part_usr_salesman->get(
                            array(
                                "partner_id" => $second_path,
                            )
                        )->result();

                        $content['m_employee'] = $this->emp->get(
                            array(
                                "branch_id" => $id,
                            )
                        )->result();

                        $data['page_title'] = "Daftar User Salesman untuk Customer " . $content['data_customer']->name;
                        $data['back_url'] = base_url("/index.php/setting/master/cabang/" . $content['data_branch']->id . "/customer");
                        $data['page_content'] = $this->load->view("setting/master/cabang/customer/salesman", $content, true);
                        $data['page_js'] = $this->load->view("setting/master/cabang/customer/salesman_js", "", true);
                    } else {
                        $data['page_title'] = "Daftar Customer " . $content['data_branch']->name;

                        $content['m_master'] = $this->master->get_all()->result();
                        $content['m_partner_type'] = $this->partner_type->get(array("branch_id" => $id))->result();

                        $data['back_url'] = base_url("/index.php/setting/master/cabang/" . $content['data_branch']->id);
                        $data['page_content'] = $this->load->view("setting/master/cabang/customer/customer", $content, true);
                        $data['page_js'] = $this->load->view("setting/master/cabang/customer/customer_js", $content, true);
                        $data['transactional'] = true;
                    }
                    break;
                case "gudang":
                    $data['page_title'] = "Daftar Gudang " . $content['data_branch']->name;
                    $data['back_url'] = base_url("/index.php/setting/master/cabang/" . $content['data_branch']->id);

                    $data['page_content'] = $this->load->view("setting/master/cabang/gudang/index", $content, true);
                    $data['page_js'] = $this->load->view("setting/master/cabang/gudang/index_js", $content, true);
                    break;
                case "partner_type":
                    $data['page_title'] = "Daftar Tipe Partner " . $content['data_branch']->name;
                    $data['back_url'] = base_url("/index.php/setting/master/cabang/" . $content['data_branch']->id);

                    $data['page_content'] = $this->load->view("setting/master/cabang/partner_type/index", $content, true);
                    $data['page_js'] = $this->load->view("setting/master/cabang/partner_type/index_js", $content, true);
                    break;
                case "map":
                    $data['page_title'] = "Daftar Map Harga " . $content['data_branch']->name;
                    $data['back_url'] = base_url("/index.php/setting/master/cabang/" . $content['data_branch']->id);

                    $content['m_partner_type'] = $this->partner_type->get(array("branch_id" => $id))->result();
                    $content['m_partner_type_unmap'] = $this->partner_type->get_unmap($id)->result();

                    $data['page_content'] = $this->load->view("setting/master/cabang/m_map/index", $content, true);
                    $data['page_js'] = $this->load->view("setting/master/cabang/m_map/index_js", $content, true);
                    break;
                case "unit":
                    $data['page_title'] = "Daftar Unit Barang " . $content['data_branch']->name;
                    $data['back_url'] = base_url("/index.php/setting/master/cabang/" . $content['data_branch']->id);

                    $data['page_content'] = $this->load->view("setting/master/cabang/unit/index", $content, true);
                    $data['page_js'] = $this->load->view("setting/master/cabang/unit/index_js", $content, true);
                    break;
                case "employee":
                    $data['page_title'] = "Daftar Employee " . $content['data_branch']->name;
                    $data['back_url'] = base_url("/index.php/setting/master/cabang/" . $content['data_branch']->id);

                    $content['levels'] = $this->ref->get(
                        array(
                            "group_data" => "EMPLOYEE_LEVEL",
                            "branch_id" => $id
                        )
                    )->result();
                    $content['positions'] = $this->ref->get(
                        array(
                            "group_data" => "EMPLOYEE_POSITION",
                            "branch_id" => $id
                        )
                    )->result();

                    $data['page_content'] = $this->load->view("setting/master/cabang/employee/index", $content, true);
                    $data['page_js'] = $this->load->view("setting/master/cabang/employee/index_js", $content, true);
                    break;

                case "kode_rekening":
                    $content['parent_accs'] = $this->account->get("is_active = 0")->result();

                    $data['page_title'] = "Kode Rekening " . $content['data_branch']->name;
                    $data['back_url'] = base_url("/index.php/setting/master/cabang/" . $content['data_branch']->id);

                    $data['page_content'] = $this->load->view("setting/master/cabang/kode_rekening/kode_rekening", $content, true);
                    $data['page_js'] = $this->load->view("setting/master/cabang/kode_rekening/kode_rekening_js", $content, true);
                    break;

                case "reference":
                    $target = ucwords(str_replace("_", " ", $second_path));

                    $data['page_title'] = "Daftar $target " . $content['data_branch']->name;
                    $data['back_url'] = base_url("/index.php/setting/master/cabang/" . $content['data_branch']->id);

                    $content['target'] = $target;
                    $content['data_target'] = strtoupper($second_path);
                    $data['page_content'] = $this->load->view("setting/master/cabang/reference/index", $content, true);
                    $data['page_js'] = $this->load->view("setting/master/cabang/reference/index_js", $content, true);
                    break;
                default:
                    $data['page_title'] = $content['data_branch']->name;
                    $data['back_url'] = base_url("/index.php/setting/master/cabang");

                    $data['page_content'] = $this->load->view("setting/master/cabang/cabang_spesifik", $content, true);
                    break;
            }
        } else if ($this->session->role_code != "ROLE_SUPER_ADMIN") {
            redirect(current_url() . "/" . $this->session->branch_id);
        } else {
            $content['data_branches'] = $this->branch->get_all()->result();

            $data['page_content'] = $this->load->view("setting/master/cabang/cabang", $content, true);
            $data['page_subheader'] = $this->load->view("setting/master/cabang/cabang_subheader", $content, true);
            $data['page_js'] = $this->load->view("setting/master/cabang/cabang_js", '', true);
        }
        return $data;
    }

    public function parameter($category, $first = '', $second = '', $third = '', $fourth = '', $fifth = '')
    {
        $this->load->view('layout/head');
        $target = "parameter_$category";
        $this->load->view('layout/base', $this->$target($first, $second, $third, $fourth, $fifth));
        $this->load->view('layout/js');
    }

    private function parameter_cabang($id = '', $firstpath = '', $second_path = '', $third_path = '', $fourth_path = '', $fifth_path = '')
    {
        $data['transactional'] = true;
        if ($id) {
            // data cabang
            $content['data_branch'] = $this->branch->get(array("id" => $id))->row();
            switch ($firstpath) {
                case "keuangan":
                    $data['page_title'] = "Parameter Keuangan " . $content['data_branch']->name;
                    $data['back_url'] = base_url("/index.php/setting/parameter/cabang");

                    switch ($second_path) {
                        case 'akuntansi':
                            $data['page_content'] = $this->load->view("setting/parameter/cabang/keuangan/akuntansi/akuntansi.php", $content, true);
                            $data['page_js'] = $this->load->view("setting/parameter/cabang/keuangan/akuntansi/akuntansi_js.php", $content, true);
                            break;
                        case 'kode_rekening':
                            $content['accounts'] = $this->account->get(array(
                                "branch_id" => $id,
                                "is_active" => 1
                            ))->result();
                            
                            $data['page_content'] = $this->load->view("setting/parameter/cabang/keuangan/kode_rekening/kode_rekening.php", $content, true);
                            $data['page_js'] = $this->load->view("setting/parameter/cabang/keuangan/kode_rekening/kode_rekening_js.php", $content, true);
                            break;
                        default:
                            $data['page_content'] = $this->load->view("setting/parameter/cabang/keuangan/master/master.php", $content, true);
                            $data['page_js'] = $this->load->view("setting/parameter/cabang/keuangan/master/master_js.php", $content, true);
                            break;
                    }
                    break;
                default:
                    $data['page_subheader'] = $this->load->view("setting/parameter/cabang/list/list_subheader", $content, true);
                    $data['page_content'] = $this->load->view("setting/parameter/cabang/list/list.php", $content, true);
                    break;
            }
        } else if ($this->session->role_code != "ROLE_SUPER_ADMIN") {
            redirect(current_url() . "/" . $this->session->branch_id);
        } else {
            $content['data_branches'] = $this->branch->get_all()->result();

            $data['page_content'] = $this->load->view("setting/parameter/cabang/cabang", $content, true);
            $data['page_subheader'] = $this->load->view("setting/parameter/cabang/cabang_subheader", $content, true);
            $data['page_js'] = $this->load->view("setting/parameter/cabang/cabang_js", '', true);
        }
        return $data;
    }

    public function user($category)
    {
        switch ($category) {
            case 'user_management':
                $this->user_management();
                break;
            case 'role_management':
                $this->role_management();
                break;
            default:
                break;
        }
    }

    private function user_management()
    {
        $data['page_title'] = "User Management";
        $data['page_content'] = $this->load->view("setting/user/user_management", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function role_management()
    {
        $data['page_title'] = "Role Management";
        $data['page_content'] = $this->load->view("setting/user/role_management", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }
}

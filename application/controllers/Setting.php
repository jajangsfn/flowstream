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
                "M_goods_model" => "goods",
                "M_unit_model" => "unit",
                "M_branch_model" => "branch",
                "M_master_model" => "master",
                "M_partner_model" => "partner",
                "M_partner_salesman_model" => "part_salesman",
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
                "User_model" => "user_m",
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

    public function master($category, $next_path = '', $continue_tab = '', $final_tab = '')
    {
        $this->load->view('layout/head');
        $this->load->view('layout/base', $this->$category($next_path, $continue_tab, $final_tab));
        $this->load->view('layout/js');
    }

    private function cabang()
    {
        $data['page_title'] = "Daftar Cabang";
        $data['page_content'] = $this->load->view("setting/master/cabang/index", "", true);
        $data['page_js'] = $this->load->view("setting/master/cabang/index_js", '', true);

        return $data;
    }

    private function barang($id = '', $next_path = '')
    {
        $data['transactional'] = true;
        if ($id == "harga") {
            $data['page_title'] = "Harga Barang";

            $data['transactional'] = true;

            $data['page_content'] = $this->load->view("setting/master/barang/harga", '', true);
            $data['page_js'] = $this->load->view("setting/master/barang/harga_js", "", true);
        } else {
            $data['page_title'] = "Master Data Barang";

            // get all m_goods join to references
            $content['list_barang'] = $this->goods->get_complete()->result();

            // get division, subdivision, category, subcategory, package, color for goods
            $content['division'] = $this->ref->get(array("group_data" => "GOODS_DIVISION"))->result();
            $content['sub_division'] = $this->ref->get(array("group_data" => "GOODS_SUB_DIVISION"))->result();
            $content['category'] = $this->ref->get(array("group_data" => "GOODS_CATEGORY"))->result();
            $content['sub_category'] = $this->ref->get(array("group_data" => "GOODS_SUB_CATEGORY"))->result();
            $content['package'] = $this->ref->get(array("group_data" => "GOODS_PACKAGE"))->result();
            $content['color'] = $this->ref->get(array("group_data" => "GOODS_COLOR"))->result();
            $content['unit'] = $this->unit->get_all()->result();

            $data['page_content'] = $this->load->view("setting/master/barang/index", $content, true);
            $data['page_js'] = $this->load->view("setting/master/barang/index_js", "", true);
        }
        return $data;
    }

    private function supplier($id = '', $next_path = '', $continu_path = '')
    {
        if ($next_path == "salesman") {
            // data supplier nya
            $content['data_supplier'] = $this->partner->get(
                array(
                    "id" => $id,
                )
            )->row();
            
            // untuk mapping barang
            if ($continu_path) {
                $content['data_salesman'] = $this->part_salesman->get(
                    array(
                        "id" => $continu_path,
                    )
                )->row();

                $data['page_title'] = "Mapping barang untuk " . $content['data_salesman']->name;

                $data['page_content'] = $this->load->view("setting/master/supplier/mapping_barang", $content, true);
                $data['page_js'] = $this->load->view("setting/master/supplier/mapping_barang_js", "", true);
            } else {
                // untuk mapping salesman
                $content['data_salesman'] = $this->part_salesman->get(
                    array(
                        "partner_id" => $id,
                        "flag <> " => "99"
                    )
                )->result();
                $data['page_title'] = "Salesman untuk " . $content['data_supplier']->name;
                $data['page_content'] = $this->load->view("setting/master/supplier/salesman", $content, true);
                $data['page_js'] = $this->load->view("setting/master/supplier/salesman_js", "", true);
            }
        } else {
            $data['page_title'] = "Daftar Supplier";

            $content['m_master'] = $this->master->get_all()->result();
            $content['m_branch'] = $this->branch->get_all()->result();

            $data['page_content'] = $this->load->view("setting/master/supplier/index", $content, true);
            $data['page_js'] = $this->load->view("setting/master/supplier/index_js", $content, true);
            $data['transactional'] = true;
        }


        return $data;
    }

    private function customer()
    {
        $data['page_title'] = "Daftar Customer";

        $content['m_master'] = $this->master->get_all()->result();
        $content['m_branch'] = $this->branch->get_all()->result();
        $content['m_partner_type'] = $this->partner_type->get_all()->result();

        $data['page_content'] = $this->load->view("setting/master/customer/index", $content, true);
        $data['page_js'] = $this->load->view("setting/master/customer/index_js", $content, true);
        $data['transactional'] = true;

        return $data;
    }

    private function gudang()
    {
        $data['page_title'] = "Daftar Gudang";

        $content['m_branch'] = $this->branch->get_all()->result();

        $data['page_content'] = $this->load->view("setting/master/gudang/index", $content, true);
        $data['page_js'] = $this->load->view("setting/master/gudang/index_js", $content, true);

        return $data;
    }

    private function discount()
    {
        $data['page_title'] = "Master Data Discount";
        $data['page_content'] = $this->load->view("setting/master/discount", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function keuangan($path)
    {
        switch ($path) {
            case 'kode_rekening':
                $this->kode_rekening();
                break;
            case 'kode_jenis_biaya':
                $this->kode_jenis_biaya();
                break;
            case 'mata_uang':
                $this->mata_uang();
                break;
            case 'sumber_dana':
                $this->sumber_dana();
                break;
            case 'tipe_jurnal':
                $this->tipe_jurnal();
                break;
            case 'pembagian_laba_rugi':
                $this->pembagian_laba_rugi();
                break;
            case 'ikhtisar_kode_rekening':
                $this->ikhtisar_kode_rekening();
                break;
            case 'aging_kode_rekening':
                $this->aging_kode_rekening();
                break;
            case 'kelompok_rekening':
                $this->kelompok_rekening();
                break;
            case 'kelompok_jenis_biaya':
                $this->kelompok_jenis_biaya();
                break;
            default:
                break;
        }
    }

    private function unit()
    {
        if (count($_POST)) {

            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->unit->delete($where_id);
                    $this->session->set_flashdata("success", "Unit berhasil terhapus");
                } else {
                    $entry_data = array(
                        "name" => $_POST['name'],
                        "initial" => $_POST['initial'],
                        "quantity" => $_POST['quantity']
                    );
                    $this->unit->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Unit berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "name" => $_POST['name'],
                    "initial" => $_POST['initial'],
                    "quantity" => $_POST['quantity']
                );
                $this->unit->insert($entry_data);
                $this->session->set_flashdata("success", "Unit berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > Master > Daftar Unit";
        $content['m_unit'] = $this->unit->get_all()->result();
        $data['page_content'] = $this->load->view("setting/master/unit/index", $content, true);
        $data['page_js'] = $this->load->view("setting/master/unit/index_js", $content, true);

        return $data;
    }

    private function kode_rekening()
    {
        if (count($_POST)) {

            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->rekening_code->delete($where_id);
                    $this->session->set_flashdata("success", "Rekening code berhasil terhapus");
                } else {
                    $entry_data = array(
                        "name" => $_POST['name'],
                        "rekening_no" => $_POST['rekening_no'],
                    );
                    $this->rekening_code->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Rekening code berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "name" => $_POST['name'],
                    "rekening_no" => $_POST['rekening_no'],
                );
                $this->rekening_code->insert($entry_data);
                $this->session->set_flashdata("success", "Rekening code berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Master Data Keuangan > Kode Rekening";
        $content['m_rekening_code'] = $this->rekening_code->get_all()->result();
        $data['page_content'] = $this->load->view("setting/master/keuangan/kode_rekening/index", $content, true);
        $data['page_js'] = $this->load->view("setting/master/keuangan/kode_rekening/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function kode_jenis_biaya()
    {
        $data['page_title'] = "Master Data Keuangan > Kode Jenis Biaya";
        $data['page_content'] = $this->load->view("setting/master/keuangan/kode_jenis_biaya", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function mata_uang()
    {
        $data['page_title'] = "Master Data Keuangan > Mata Uang";
        $data['page_content'] = $this->load->view("setting/master/keuangan/mata_uang", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function sumber_dana()
    {
        $data['page_title'] = "Master Data Keuangan > Sumber Dana";
        $data['page_content'] = $this->load->view("setting/master/keuangan/sumber_dana", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function tipe_jurnal()
    {
        $data['page_title'] = "Master Data Keuangan > Tipe Jurnal";
        $data['page_content'] = $this->load->view("setting/master/keuangan/tipe_jurnal", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function pembagian_laba_rugi()
    {
        $data['page_title'] = "Master Data Keuangan > Pembagian Laba Rugi";
        $data['page_content'] = $this->load->view("setting/master/keuangan/pembagian_laba_rugi", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function ikhtisar_kode_rekening()
    {
        $data['page_title'] = "Master Data Keuangan > Ikhtisar Kode Rekening";
        $data['page_content'] = $this->load->view("setting/master/keuangan/ikhtisar_kode_rekening", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function aging_kode_rekening()
    {
        $data['page_title'] = "Master Data Keuangan > Aging Kode Rekening";
        $data['page_content'] = $this->load->view("setting/master/keuangan/aging_kode_rekening", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function kelompok_rekening()
    {
        $data['page_title'] = "Master Data Keuangan > Kelompok Rekening";
        $data['page_content'] = $this->load->view("setting/master/keuangan/kelompok_rekening", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function kelompok_jenis_biaya()
    {
        $data['page_title'] = "Master Data Keuangan > Kelompok Jenis Biaya";
        $data['page_content'] = $this->load->view("setting/master/keuangan/kelompok_jenis_biaya", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
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

    public function parameter($path, $next_path = '')
    {
        switch ($path) {
            case 'pembelian':
                $this->parameter_pembelian();
                break;
            case 'penjualan':
                $this->parameter_penjualan();
                break;
            case 'barang':
                $this->parameter_barang();
                break;
            case 'inventori':
                $this->parameter_inventori();
                break;
            case 'keuangan':
                switch ($next_path) {
                    case 'master':
                        $this->parameter_master();
                        break;
                    case 'akuntansi':
                        $this->parameter_akuntansi();
                        break;
                    case 'kode_rekening':
                        $this->parameter_kode_rekening();
                        break;

                    default:
                        break;
                }
                break;

            default:
                break;
        }
    }

    private function parameter_pembelian()
    {
        $data['page_title'] = "Parameter Pembelian";
        $data['page_content'] = $this->load->view("setting/parameter/pembelian", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function parameter_penjualan()
    {
        $data['page_title'] = "Parameter Penjualan";
        $data['page_content'] = $this->load->view("setting/parameter/penjualan", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function parameter_barang()
    {
        $data['page_title'] = "Parameter Barang";
        $data['page_content'] = $this->load->view("setting/parameter/barang", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function parameter_inventori()
    {
        $data['page_title'] = "Parameter Inventori";
        $data['page_content'] = $this->load->view("setting/parameter/inventori", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function parameter_master()
    {
        $data['page_title'] = "Parameter Keuangan > Master";
        $data['page_content'] = $this->load->view("setting/parameter/keuangan/master", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function parameter_akuntansi()
    {
        $data['page_title'] = "Parameter Keuangan > Akuntansi";
        $data['page_content'] = $this->load->view("setting/parameter/keuangan/akuntansi", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function parameter_kode_rekening()
    {
        $data['page_title'] = "Parameter Keuangan > Kode Rekening";
        $data['page_content'] = $this->load->view("setting/parameter/keuangan/kode_rekening", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function system($path, $next_path = '')
    {
        $this->$path($next_path);
    }

    private function s_reference($path)
    {
        if (count($_POST)) {

            $entry_data = array(
                "branch_id" => $_POST['branch_id'],
                "group_data" => $_POST['group_data'],
                "detail_data" => $_POST['detail_data']
            );

            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->ref->delete($where_id);
                    $this->session->set_flashdata("success", "Reference berhasil terhapus");
                } else {
                    $this->ref->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Reference berhasil tersimpan");
                }
            } else {
                $this->ref->insert($entry_data);
                $this->session->set_flashdata("success", "Reference berhasil tersimpan");
            }

            if (array_key_exists("back", $_POST)) {
                redirect($_POST['back']);
            } else {
                $content['back_url'] = $_POST['back_url'];
            }
        }

        if ($path) {
            $data['page_title'] = "Konfigurasi s_reference";
            if ($path  == 'goods_division') {
                $content['group_data'] = "GOODS_DIVISION";
            } else if ($path == "goods_category") {
                $content['group_data'] = "GOODS_CATEGORY";
            } else if ($path == "goods_package") {
                $content['group_data'] = "GOODS_PACKAGE";
            } else if ($path == "goods_color") {
                $content['group_data'] = "GOODS_COLOR";
            }
            $data['page_content'] = $this->load->view("setting/system/s_reference/tambah", $content, true);
        } else {
            $data['page_title'] = "Setting > System > Daftar S_Reference";
            $content['s_reference'] = $this->ref->get_all()->result();
            $content['group_data'] = $this->ref->get_group_data()->result_array();
            $content['m_branch'] = $this->branch->get_all()->result();
            $data['page_content'] = $this->load->view("setting/system/s_reference/index", $content, true);
            $data['page_js'] = $this->load->view("setting/system/s_reference/index_js", $content, true);
        }

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function m_master($path)
    {
        if (count($_POST)) {

            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->master->delete($where_id);
                    $this->session->set_flashdata("success", "Master berhasil terhapus");
                } else {
                    $entry_data = array(
                        "code" => $_POST['code'],
                        "name" => $_POST['name'],
                        "description" => $_POST['description'],
                    );
                    $this->master->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Master berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "code" => $_POST['code'],
                    "name" => $_POST['name'],
                    "description" => $_POST['description'],
                );
                $this->master->insert($entry_data);
                $this->session->set_flashdata("success", "Master berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar M_Master";
        $content['m_master'] = $this->master->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/m_master/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/m_master/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function m_partner($path)
    {
        if (count($_POST)) {

            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->partner->delete($where_id);
                    $this->session->set_flashdata("success", "Partner berhasil terhapus");
                } else {
                    $entry_data = array(
                        "master_id" => $_POST['master_id'],
                        "branch_id" => isset($_POST['branch_id']) ? $_POST['branch_id'] : null,
                        "partner_code" => $_POST['partner_code'],
                        "name" => $_POST['name'],
                        "address_1" => $_POST['address_1'],
                        "address_2" => $_POST['address_2'],
                        "city" => $_POST['city'],
                        "province" => $_POST['province'],
                        "zip_code" => $_POST['zip_code'],
                        "phone" => $_POST['phone'],
                        "fax" => $_POST['fax'],
                        "tax_number" => $_POST['tax_number'],
                        "salesman" => $_POST['salesman'],
                        "partner_type" => $_POST['partner_type'],
                        "sales_price_level" => $_POST['sales_price_level'],
                        "tax_address" => $_POST['tax_address'],
                        "is_customer" => isset($_POST['is_customer']) ? 1 : 0,
                        "is_supplier" => isset($_POST['is_supplier']) ? 1 : 0
                    );
                    $this->partner->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Partner berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "master_id" => $_POST['master_id'],
                    "branch_id" => isset($_POST['branch_id']) ? $_POST['branch_id'] : null,
                    "partner_code" => $_POST['partner_code'],
                    "name" => $_POST['name'],
                    "address_1" => $_POST['address_1'],
                    "address_2" => $_POST['address_2'],
                    "city" => $_POST['city'],
                    "province" => $_POST['province'],
                    "zip_code" => $_POST['zip_code'],
                    "phone" => $_POST['phone'],
                    "fax" => $_POST['fax'],
                    "tax_number" => $_POST['tax_number'],
                    "salesman" => $_POST['salesman'],
                    "partner_type" => $_POST['partner_type'],
                    "sales_price_level" => $_POST['sales_price_level'],
                    "tax_address" => $_POST['tax_address'],
                    "is_customer" => isset($_POST['is_customer']) ? 1 : 0,
                    "is_supplier" => isset($_POST['is_supplier']) ? 1 : 0
                );
                $this->partner->insert($entry_data);
                $this->session->set_flashdata("success", "Partner berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar M_Partner";
        $content['m_partner'] = $this->partner->get_all()->result();
        $content['m_master'] = $this->master->get_all()->result();
        $content['m_branch'] = $this->branch->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/m_partner/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/m_partner/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function m_salesman($path)
    {
        if (count($_POST)) {

            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->salesman->delete($where_id);
                    $this->session->set_flashdata("success", "Salesman berhasil terhapus");
                } else {
                    $entry_data = array(
                        "partner_id" => $_POST['partner_id'],
                        "name" => $_POST['name'],
                        "phone" => $_POST['phone'],
                    );
                    $this->salesman->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Salesman berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "partner_id" => $_POST['partner_id'],
                    "name" => $_POST['name'],
                    "phone" => $_POST['phone'],
                );
                $this->salesman->insert($entry_data);
                $this->session->set_flashdata("success", "Salesman berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar M_Salesman";
        $content['m_salesman'] = $this->salesman->get_all()->result();
        $content['m_partner'] = $this->partner->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/m_salesman/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/m_salesman/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function m_salesman_map($path)
    {
        if (count($_POST)) {

            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->salesman_map->delete($where_id);
                    $this->session->set_flashdata("success", "Salesman Map berhasil terhapus");
                } else {
                    $entry_data = array(
                        "salesman_id" => $_POST['salesman_id'],
                        "goods_id" => $_POST['goods_id'],
                    );
                    $this->salesman_map->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Salesman Map berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "salesman_id" => $_POST['salesman_id'],
                    "goods_id" => $_POST['goods_id'],
                );
                $this->salesman_map->insert($entry_data);
                $this->session->set_flashdata("success", "Salesman Map berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar M_Salesman_Map";
        $content['m_salesman'] = $this->salesman->get_all()->result();
        $content['m_goods'] = $this->goods->get_all()->result();
        $content['m_salesman_map'] = $this->salesman_map->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/m_salesman_map/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/m_salesman_map/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function m_event($path)
    {
        if (count($_POST)) {

            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->event->delete($where_id);
                    $this->session->set_flashdata("success", "Event berhasil terhapus");
                } else {
                    $entry_data = array(
                        "branch_id" => $_POST['branch_id'],
                        "name" => $_POST['name'],
                        "description" => $_POST['description'],
                        "start_date" => $_POST['start_date'],
                        "end_date" => $_POST['end_date'],
                        "created_by" => $this->session->userdata("id"),
                    );
                    $this->event->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Event berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "branch_id" => $_POST['branch_id'],
                    "name" => $_POST['name'],
                    "description" => $_POST['description'],
                    "start_date" => $_POST['start_date'],
                    "end_date" => $_POST['end_date'],
                    "created_by" => $this->session->userdata("id"),
                );
                $this->event->insert($entry_data);
                $this->session->set_flashdata("success", "Event berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar M_Event";
        $content['m_branch'] = $this->branch->get_all()->result();
        $content['m_event'] = $this->event->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/m_event/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/m_event/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function m_event_detail($path)
    {
        if (count($_POST)) {

            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->event_detail->delete($where_id);
                    $this->session->set_flashdata("success", "Event detail berhasil terhapus");
                } else {
                    $entry_data = array(
                        "goods_id" => $_POST['goods_id'],
                        "promo_id" => $_POST['promo_id'],
                        "event_id" => $_POST['event_id'],
                        "quantity" => $_POST['quantity'],
                        "multiple_flag" => $_POST['multiple_flag'],
                        "percentage" => $_POST['percentage'],
                        "price" => $_POST['price'],
                        "free_goods" => $_POST['free_goods'],
                    );
                    $this->event_detail->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Event detail berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "goods_id" => $_POST['goods_id'],
                    "promo_id" => $_POST['promo_id'],
                    "event_id" => $_POST['event_id'],
                    "quantity" => $_POST['quantity'],
                    "multiple_flag" => $_POST['multiple_flag'],
                    "percentage" => $_POST['percentage'],
                    "price" => $_POST['price'],
                    "free_goods" => $_POST['free_goods'],
                );
                $this->event_detail->insert($entry_data);
                $this->session->set_flashdata("success", "Event detail berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar m_event_detail";
        $content['m_goods'] = $this->goods->get_all()->result();
        $content['m_promo'] = $this->promo->get_all()->result();
        $content['m_event'] = $this->event->get_all()->result();
        $content['m_event_detail'] = $this->event_detail->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/m_event_detail/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/m_event_detail/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function m_promo($path)
    {
        if (count($_POST)) {

            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->promo->delete($where_id);
                    $this->session->set_flashdata("success", "Promo berhasil terhapus");
                } else {
                    $entry_data = array(
                        "name" => $_POST['name'],
                    );
                    $this->promo->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Promo berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "name" => $_POST['name'],
                );
                $this->promo->insert($entry_data);
                $this->session->set_flashdata("success", "Promo berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar M_Promo";
        $content['m_promo'] = $this->promo->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/m_promo/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/m_promo/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function m_delivery($path)
    {
        if (count($_POST)) {

            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->delivery->delete($where_id);
                    $this->session->set_flashdata("success", "Delivery berhasil terhapus");
                } else {
                    $entry_data = array(
                        "branch_id" => $_POST['branch_id'],
                        "name" => $_POST['name'],
                        "rekening_no" => $_POST['rekening_no'],
                        "description" => $_POST['description'],
                    );
                    $this->delivery->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Delivery berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "branch_id" => $_POST['branch_id'],
                    "name" => $_POST['name'],
                    "rekening_no" => $_POST['rekening_no'],
                    "description" => $_POST['description'],
                );
                $this->delivery->insert($entry_data);
                $this->session->set_flashdata("success", "Delivery berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar M_Delivery";
        $content['m_delivery'] = $this->delivery->get_all()->result();
        $content['m_branch'] = $this->branch->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/m_delivery/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/m_delivery/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function production($path)
    {
        if (count($_POST)) {

            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->production->delete($where_id);
                    $this->session->set_flashdata("success", "Production berhasil terhapus");
                } else {
                    $entry_data = array(
                        "name" => $_POST['name'],
                    );
                    $this->production->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Production berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "name" => $_POST['name'],
                );
                $this->production->insert($entry_data);
                $this->session->set_flashdata("success", "Production berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar Production";
        $content['production'] = $this->production->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/production/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/production/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function production_detail($path)
    {
        if (count($_POST)) {

            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->production_detail->delete($where_id);
                    $this->session->set_flashdata("success", "Production detail berhasil terhapus");
                } else {
                    $entry_data = array(
                        "production_id" => $_POST['production_id'],
                        "goods_id" => $_POST['goods_id'],
                    );
                    $this->production_detail->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Production detail berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "production_id" => $_POST['production_id'],
                    "goods_id" => $_POST['goods_id'],
                );
                $this->production_detail->insert($entry_data);
                $this->session->set_flashdata("success", "Production detail berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar Production Detail";
        $content['production'] = $this->production->get_all()->result();
        $content['m_goods'] = $this->goods->get_all()->result();
        $content['production_detail'] = $this->production_detail->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/production_detail/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/production_detail/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function m_map($path)
    {
        if (count($_POST)) {

            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->map->delete($where_id);
                    $this->session->set_flashdata("success", "Map berhasil terhapus");
                } else {
                    $entry_data = array(
                        "partner_id" => $_POST['partner_id'],
                        "event_id" => $_POST['event_id'],
                        "goods_id" => $_POST['goods_id'],
                        "price" => $_POST['price'],
                    );
                    $this->map->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Map berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "partner_id" => $_POST['partner_id'],
                    "event_id" => $_POST['event_id'],
                    "goods_id" => $_POST['goods_id'],
                    "price" => $_POST['price'],
                );
                $this->map->insert($entry_data);
                $this->session->set_flashdata("success", "Map berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar M_Map";
        $content['m_partner'] = $this->partner->get_all()->result();
        $content['m_goods'] = $this->goods->get_all()->result();
        $content['m_event'] = $this->event->get_all()->result();
        $content['m_map'] = $this->map->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/m_map/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/m_map/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function ol_connection($path)
    {
        if (count($_POST)) {

            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->connection->delete($where_id);
                    $this->session->set_flashdata("success", "Connection berhasil terhapus");
                } else {
                    $entry_data = array(
                        "receive_id" => array_key_exists("receive_id", $_POST) ?  $_POST['receive_id'] : null,
                        "request_id" => array_key_exists("request_id", $_POST) ?  $_POST['request_id'] : null,
                        "request_status" => array_key_exists("request_status", $_POST) ?  $_POST['request_status'] : null,
                        "receive_status" => array_key_exists("receive_status", $_POST) ?  $_POST['receive_status'] : null,
                    );
                    $this->connection->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Connection berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "receive_id" => array_key_exists("receive_id", $_POST) ?  $_POST['receive_id'] : null,
                    "request_id" => array_key_exists("request_id", $_POST) ?  $_POST['request_id'] : null,
                    "request_status" => array_key_exists("request_status", $_POST) ?  $_POST['request_status'] : null,
                    "receive_status" => array_key_exists("receive_status", $_POST) ?  $_POST['receive_status'] : null,
                );
                $this->connection->insert($entry_data);
                $this->session->set_flashdata("success", "Connection berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar ol_connection";
        $content['m_branch'] = $this->branch->get_all()->result();
        $content['ol_connection'] = $this->connection->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/ol_connection/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/ol_connection/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function ol_group($path)
    {
        if (count($_POST)) {

            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->group->delete($where_id);
                    $this->session->set_flashdata("success", "Group berhasil terhapus");
                } else {
                    $entry_data = array(
                        "connection_id" => $_POST['connection_id'],
                        "maker_id" => array_key_exists("maker_id", $_POST) ?  $_POST['maker_id'] : null,
                        "name" => $_POST['name'],
                        "description" => array_key_exists("description", $_POST) ?  $_POST['description'] : null,
                    );
                    $this->group->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Group berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "connection_id" => $_POST['connection_id'],
                    "maker_id" => array_key_exists("maker_id", $_POST) ?  $_POST['maker_id'] : null,
                    "name" => $_POST['name'],
                    "description" => array_key_exists("description", $_POST) ?  $_POST['description'] : null,
                );
                $this->group->insert($entry_data);
                $this->session->set_flashdata("success", "Group berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar ol_group";
        $content['ol_group'] = $this->group->get_all()->result();
        $content['ol_connection'] = $this->connection->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/ol_group/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/ol_group/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function ol_group_detail($path)
    {
        if (count($_POST)) {
            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->group_det->delete($where_id);
                    $this->session->set_flashdata("success", "Group detail berhasil terhapus");
                } else {
                    $entry_data = array(
                        "group_id" => $_POST['group_id'],
                        "member_id" => $_POST['member_id'],
                        "is_admin" => $_POST['is_admin'] ? 1 : 0
                    );
                    $this->group_det->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Group detail berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "group_id" => $_POST['group_id'],
                    "member_id" => $_POST['member_id'],
                    "is_admin" => $_POST['is_admin'] ? 1 : 0
                );
                $this->group_det->insert($entry_data);
                $this->session->set_flashdata("success", "Group detail berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar ol_group_detail";
        $content['ol_group'] = $this->group->get_all()->result();
        $content['m_branch'] = $this->branch->get_all()->result();
        $content['ol_group_detail'] = $this->group_det->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/ol_group_detail/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/ol_group_detail/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function delivery_order($path)
    {
        if (count($_POST)) {
            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->delivery_order->delete($where_id);
                    $this->session->set_flashdata("success", "Delivery Order berhasil terhapus");
                } else {
                    $entry_data = array(
                        "branch_id" => $_POST['branch_id'],
                        "delivery_no" => $_POST['delivery_no'],
                        "description" => $_POST['description'],
                        "delivery_date" => $_POST['delivery_date'],
                        "car_number" => $_POST['car_number'],
                    );
                    $this->delivery_order->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Delivery Order berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "branch_id" => $_POST['branch_id'],
                    "delivery_no" => $_POST['delivery_no'],
                    "description" => $_POST['description'],
                    "delivery_date" => $_POST['delivery_date'],
                    "car_number" => $_POST['car_number'],
                );
                $this->delivery_order->insert($entry_data);
                $this->session->set_flashdata("success", "Delivery Order berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar delivery_order";
        $content['m_branch'] = $this->branch->get_all()->result();
        $content['delivery_order'] = $this->delivery_order->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/delivery_order/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/delivery_order/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function delivery_team($path)
    {
        if (count($_POST)) {
            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->delivery_team->delete($where_id);
                    $this->session->set_flashdata("success", "Delivery Order berhasil terhapus");
                } else {
                    $entry_data = array(
                        "delivery_order_id" => $_POST['delivery_order_id'],
                        "user_id" => $_POST['user_id'],
                        "description" => $_POST['description'],
                        "job_description" => $_POST['job_description'],
                    );
                    $this->delivery_team->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Delivery Order berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "delivery_order_id" => $_POST['delivery_order_id'],
                    "user_id" => $_POST['user_id'],
                    "description" => $_POST['description'],
                    "job_description" => $_POST['job_description'],
                );
                $this->delivery_team->insert($entry_data);
                $this->session->set_flashdata("success", "Delivery Order berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar delivery_order";
        $content['delivery_team'] = $this->delivery_team->get_all()->result();
        $content['delivery_order'] = $this->delivery_order->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/delivery_team/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/delivery_team/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function delivery_cost($path)
    {
        if (count($_POST)) {

            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->delivery_cost->delete($where_id);
                    $this->session->set_flashdata("success", "Delivery Cost berhasil terhapus");
                } else {
                    $entry_data = array(
                        "delivery_order_id" => $_POST['delivery_order_id'],
                        "delivery_id" => $_POST['delivery_id'],
                    );
                    $this->delivery_cost->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Delivery Cost berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "delivery_order_id" => $_POST['delivery_order_id'],
                    "delivery_id" => $_POST['delivery_id'],
                );
                $this->delivery_cost->insert($entry_data);
                $this->session->set_flashdata("success", "Delivery Cost berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar delivery_cost";
        $content['m_delivery'] = $this->delivery->get_all()->result();
        $content['delivery_order'] = $this->delivery_order->get_all()->result();
        $content['delivery_cost'] = $this->delivery_cost->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/delivery_cost/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/delivery_cost/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function purchase_order_parameter($path)
    {
        if (count($_POST)) {
            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->param_purchase_order->delete($where_id);
                    $this->session->set_flashdata("success", "Parameter berhasil terhapus");
                } else {
                    $entry_data = array(
                        "rekening_code_id" => $_POST['rekening_code_id'],
                    );
                    $this->param_purchase_order->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Parameter berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "rekening_code_id" => $_POST['rekening_code_id'],
                );
                $this->param_purchase_order->insert($entry_data);
                $this->session->set_flashdata("success", "Parameter berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar purchase_order_parameter";
        $content['rekening_code'] = $this->rekening_code->get_all()->result();
        $content['purchase_order_parameter'] = $this->param_purchase_order->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/purchase_order_parameter/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/purchase_order_parameter/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }
}

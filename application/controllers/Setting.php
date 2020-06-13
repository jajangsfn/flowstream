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
                "user_model" => "user_m",
                "S_reference_model" => "ref",
                "M_goods_model" => "goods",
                "M_unit_model" => "unit",
                "M_branch_model" => "branch",
                "M_master_model" => "master",
                "M_partner_model" => "partner",
                "M_salesman_model" => "salesman",
                "M_salesman_map_model" => "salesman_map",
                "M_map_model" => "map",
                "M_event_model" => "event",
                "M_promo_model" => "promo",
                "M_delivery_model" => "delivery",
                "M_warehouse_model" => "warehouse",
                "Ol_connection_model" => "connection",
                "Ol_group_model" => "group",
                "Ol_group_detail_model" => "group_det",
                "Production_model" => "production",
                "Production_detail_model" => "production_detail",
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

    public function master($category, $next_path = '')
    {
        switch ($category) {
            case 'barang':
                $this->barang();
                break;
            case 'supplier':
                $this->supplier();
                break;
            case 'customer':
                $this->customer();
                break;
            case 'gudang':
                $this->gudang();
                break;
            case 'discount':
                $this->discount();
                break;
            case 'keuangan':
                $this->keuangan($next_path);
                break;
            default:
                # code...
                break;
        }
    }

    private function barang()
    {
        if (count($_POST)) {
            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->goods->delete($where_id);
                } else {
                    $this->goods->update($where_id, $_POST);
                }
            } else {
                $this->goods->insert($_POST);
            }
            $this->session->set_flashdata("success", "Barang berhasil tersimpan");
            redirect(current_url());
        }

        $data['page_title'] = "Master Data Barang";

        // get all m_goods join to references
        $content['list_barang'] = $this->goods->get_complete()->result();

        // get division, subdivision, category, subcategory, package, color for goods
        $content['division'] = $this->ref->get(array("group_data" => "GOODS_DIVISION"))->result();
        $content['category'] = $this->ref->get(array("group_data" => "GOODS_CATEGORY"))->result();
        $content['package'] = $this->ref->get(array("group_data" => "GOODS_PACKAGE"))->result();
        $content['color'] = $this->ref->get(array("group_data" => "GOODS_COLOR"))->result();
        $content['unit'] = $this->unit->get_all()->result();

        $data['page_content'] = $this->load->view("setting/master/barang/index", $content, true);
        $data['page_js'] = $this->load->view("setting/master/barang/index_js", "", true);
        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function supplier()
    {
        $data['page_title'] = "Master Data Supplier";
        $data['page_content'] = $this->load->view("setting/master/supplier", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function customer()
    {
        $data['page_title'] = "Master Data Customer";
        $data['page_content'] = $this->load->view("setting/master/customer", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function gudang()
    {
        $data['page_title'] = "Master Data Gudang";
        $data['page_content'] = $this->load->view("setting/master/gudang", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
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

    private function kode_rekening()
    {
        $data['page_title'] = "Master Data Keuangan > Kode Rekening";
        $data['page_content'] = $this->load->view("setting/master/keuangan/kode_rekening", "", true);

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
                # code...
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
                } else {
                    $this->ref->update($where_id, $entry_data);
                }
            } else {
                $this->ref->insert($entry_data);
            }

            $this->session->set_flashdata("success", "Reference berhasil tersimpan");

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

    private function m_unit($path)
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
                        "quantity" => $_POST['quantity']
                    );
                    $this->unit->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Unit berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "name" => $_POST['name'],
                    "quantity" => $_POST['quantity']
                );
                $this->unit->insert($entry_data);
                $this->session->set_flashdata("success", "Unit berhasil tersimpan");
            }


            if (array_key_exists("back", $_POST)) {
                redirect($_POST['back']);
            } else {
                $content['back_url'] = $_POST['back_url'];
            }
        }

        $data['page_title'] = "Setting > System > Daftar M_Unit";
        $content['m_unit'] = $this->unit->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/m_unit/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/m_unit/index_js", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function m_branch($path)
    {
        if (count($_POST)) {

            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->branch->delete($where_id);
                    $this->session->set_flashdata("success", "Branch berhasil terhapus");
                } else {
                    $entry_data = array(
                        "name" => $_POST['name'],
                        "owner" => $_POST['owner'],
                        "address" => $_POST['address'],
                        "npwp" => $_POST['npwp'],
                        "tax_status" => $_POST['tax_status'],
                        "online_status" => $_POST['online_status']
                    );
                    $this->branch->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Branch berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "name" => $_POST['name'],
                    "owner" => $_POST['owner'],
                    "address" => $_POST['address'],
                    "npwp" => $_POST['npwp'],
                    "tax_status" => $_POST['tax_status'],
                    "online_status" => $_POST['online_status']
                );
                $this->branch->insert($entry_data);
                $this->session->set_flashdata("success", "Branch berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar M_Branch";
        $content['m_branch'] = $this->branch->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/m_branch/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/m_branch/index_js", $content, true);

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

    private function m_warehouse($path)
    {
        if (count($_POST)) {

            if (array_key_exists("id", $_POST)) {
                $where_id['id'] = $_POST['id'];
                if (array_key_exists("delete", $_POST)) {
                    $this->warehouse->delete($where_id);
                    $this->session->set_flashdata("success", "Warehouse berhasil terhapus");
                } else {
                    $entry_data = array(
                        "branch_id" => $_POST['branch_id'],
                        "code" => $_POST['code'],
                        "name" => $_POST['name'],
                        "address" => $_POST['address'],
                        "length" => $_POST['length'],
                        "width" => $_POST['width'],
                        "capacity" => $_POST['capacity'],
                        "description" => $_POST['description'],
                    );
                    $this->warehouse->update($where_id, $entry_data);
                    $this->session->set_flashdata("success", "Warehouse berhasil tersimpan");
                }
            } else {
                $entry_data = array(
                    "branch_id" => $_POST['branch_id'],
                    "code" => $_POST['code'],
                    "name" => $_POST['name'],
                    "address" => $_POST['address'],
                    "length" => $_POST['length'],
                    "width" => $_POST['width'],
                    "capacity" => $_POST['capacity'],
                    "description" => $_POST['description'],
                );
                $this->warehouse->insert($entry_data);
                $this->session->set_flashdata("success", "Warehouse berhasil tersimpan");
            }
            redirect(current_url());
        }

        $data['page_title'] = "Setting > System > Daftar M_Warehouse";
        $content['m_warehouse'] = $this->warehouse->get_all()->result();
        $content['m_branch'] = $this->branch->get_all()->result();
        $data['page_content'] = $this->load->view("setting/system/m_warehouse/index", $content, true);
        $data['page_js'] = $this->load->view("setting/system/m_warehouse/index_js", $content, true);

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
}

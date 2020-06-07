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
                "M_goods_model" => "goods",
                "S_reference_model" => "ref",
                "M_unit_model" => "unit",
            )
        );
    }

    public function index()
    {
        $data['page_title'] = "Setting dan Konfigurasi";
        $data['page_content'] = $this->load->view("profile/content", "", true);

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
        switch ($path) {
            case 's_reference':
                $this->s_reference($next_path);
                break;
            case 'm_unit':
                $this->m_unit($next_path);
                break;

            default:
                # code...
                break;
        }
    }

    private function s_reference($path)
    {
        if (count($_POST)) {

            $entry_data = array(
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
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
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
                "m_partner_model" => "partner",
                "m_goods_model" => "goods",
                "t_order_request_model" => "or"
            )
        );
    }

    public function home()
    {
        $data['page_title'] = "Daftar Penjualan";
        $data['page_content'] = $this->load->view("penjualan/index", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function order_request()
    {
        // tampilkan list of order request
        $data['page_title'] = "Penjualan - Daftar Order Request";
        $data['back_url'] = base_url("/index.php/penjualan/home");

        $data['page_content'] = $this->load->view("penjualan/order_request/list", "", true);
        $data['page_js'] = $this->load->view("penjualan/order_request/list_js", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function add_order_request()
    {
        $data['page_title'] = "Tambah Order Request";
        $data['back_url'] = base_url("/index.php/penjualan/order_request");

        $content["customers"] = $this->partner->get_customer()->result();

        $data['page_content'] = $this->load->view("penjualan/order_request/index", $content, true);
        $data['page_js'] = $this->load->view("penjualan/order_request/index_js", "", true);
        $data['page_modal'] = $this->load->view("penjualan/order_request/modal", "", true);

        $data['transactional'] = true;
        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function edit_order_request($id_or)
    {
        $data['page_title'] = "Edit Order Request";
        $data['back_url'] = base_url("/index.php/penjualan/order_request");

        $content['data_or'] = $this->or->get_specific($id_or);

        $data['page_content'] = $this->load->view("penjualan/order_request/edit", $content, true);
        $data['page_js'] = $this->load->view("penjualan/order_request/edit_js", "", true);
        $data['page_modal'] = $this->load->view("penjualan/order_request/edit_modal", "", true);

        $data['transactional'] = true;
        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function pos($command = '', $id_or = '')
    {
        if ($command == "cetak_faktur_pajak") {
            $data['page_title'] = "Point of Sales - Cetak Faktur Pajak";
            $data['back_url'] = base_url("/index.php/penjualan/order_request");
            $content['data_or'] = $this->or->get_specific($id_or);

            $data['page_content'] = $this->load->view("penjualan/pos/cetak_faktur_pajak", $content, true);
            $data['page_js'] = $this->load->view("penjualan/pos/cetak_faktur_pajak_js", $content, true);
        } else {
            $data['page_title'] = "Point of Sales";
            $data['page_content'] = $this->load->view("penjualan/pos", "", true);
        }

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function retur()
    {
        $data['page_title'] = "Retur Penjualan";
        $data['page_content'] = $this->load->view("penjualan/retur", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function laporan($path, $next_path = '')
    {
        switch ($path) {
            case 'penjualan':
                $this->laporan_penjualan($next_path);
                break;
            case 'retur':
                $this->laporan_retur($next_path);
                break;
            default:
                break;
        }
    }

    private function laporan_penjualan($path)
    {
        switch ($path) {
            case 'harian':
                $this->laporan_penjualan_harian();
                break;
            case 'bulanan':
                $this->laporan_penjualan_bulanan();
                break;
            default:
                break;
        }
    }

    private function laporan_retur($path)
    {
        switch ($path) {
            case 'harian':
                $this->laporan_retur_harian();
                break;
            case 'bulanan':
                $this->laporan_retur_bulanan();
                break;
            default:
                break;
        }
    }

    private function laporan_penjualan_harian()
    {
        $data['page_title'] = "Laporan Penjualan Harian";
        $data['page_content'] = $this->load->view("penjualan/laporan/penjualan/harian", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function laporan_penjualan_bulanan()
    {
        $data['page_title'] = "Laporan Penjualan Bulanan";
        $data['page_content'] = $this->load->view("penjualan/laporan/penjualan/bulanan", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function laporan_retur_harian()
    {
        $data['page_title'] = "Laporan Retur Harian";
        $data['page_content'] = $this->load->view("penjualan/laporan/retur/harian", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function laporan_retur_bulanan()
    {
        $data['page_title'] = "Laporan Retur Bulanan";
        $data['page_content'] = $this->load->view("penjualan/laporan/retur/bulanan", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }
}

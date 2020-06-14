<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
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
        $this->load->model(
            array(
                "user_model" => "user_m"
            )
        );
    }

    public function index()
    {
        $data['back_url'] = base_url();
        $data['page_title'] = "Pembelian";
        $data['page_content'] = $this->load->view("pembelian/index", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function purchase_order()
    {
        $data['page_title'] = "Purchase Order";
        $data['page_content'] = $this->load->view("pembelian/purchase_order", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function retur()
    {
        $data['page_title'] = "Retur Pembelian";
        $data['page_content'] = $this->load->view("pembelian/retur", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function laporan($path, $next_path = '')
    {
        switch ($path) {
            case 'pembelian':
                $this->laporan_pembelian($next_path);
                break;
            case 'retur':
                $this->laporan_retur($next_path);
                break;
            default:
                break;
        }
    }

    private function laporan_pembelian($path)
    {
        switch ($path) {
            case 'harian':
                $this->laporan_pembelian_harian();
                break;
            case 'bulanan':
                $this->laporan_pembelian_bulanan();
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

    private function laporan_pembelian_harian()
    {
        $data['page_title'] = "Laporan Pembelian Harian";
        $data['page_content'] = $this->load->view("pembelian/laporan/pembelian/harian", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function laporan_pembelian_bulanan()
    {
        $data['page_title'] = "Laporan Pembelian Bulanan";
        $data['page_content'] = $this->load->view("pembelian/laporan/pembelian/bulanan", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function laporan_retur_harian()
    {
        $data['page_title'] = "Laporan Retur Pembelian Harian";
        $data['page_content'] = $this->load->view("pembelian/laporan/retur/harian", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function laporan_retur_bulanan()
    {
        $data['page_title'] = "Laporan Retur Pembelian Bulanan";
        $data['page_content'] = $this->load->view("pembelian/laporan/retur/bulanan", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }
}

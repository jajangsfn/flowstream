<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller
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

    public function receiving()
    {
        $data['page_title'] = "Receiving";
        $data['page_content'] = $this->load->view("inventori/receiving", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function gudang()
    {
        $data['page_title'] = "Gudang";
        $data['page_content'] = $this->load->view("inventori/gudang", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function laporan($path, $next_path = '')
    {
        switch ($path) {
            case 'receiving':
                $this->laporan_receiving($next_path);
                break;
            case 'gudang':
                $this->laporan_gudang($next_path);
                break;
            default:
                break;
        }
    }

    private function laporan_receiving($path)
    {
        switch ($path) {
            case 'harian':
                $this->laporan_receiving_harian();
                break;
            case 'bulanan':
                $this->laporan_receiving_bulanan();
                break;
            default:
                break;
        }
    }

    private function laporan_gudang($path)
    {
        switch ($path) {
            case 'harian':
                $this->laporan_gudang_harian();
                break;
            case 'bulanan':
                $this->laporan_gudang_bulanan();
                break;
            default:
                break;
        }
    }

    private function laporan_receiving_harian()
    {
        $data['page_title'] = "Laporan Receiving Harian";
        $data['page_content'] = $this->load->view("inventori/laporan/receiving/harian", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function laporan_receiving_bulanan()
    {
        $data['page_title'] = "Laporan Receiving Bulanan";
        $data['page_content'] = $this->load->view("inventori/laporan/receiving/bulanan", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function laporan_gudang_harian()
    {
        $data['page_title'] = "Laporan Gudang Harian";
        $data['page_content'] = $this->load->view("inventori/laporan/gudang/harian", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function laporan_gudang_bulanan()
    {
        $data['page_title'] = "Laporan Gudang Bulanan";
        $data['page_content'] = $this->load->view("inventori/laporan/gudang/bulanan", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }
}

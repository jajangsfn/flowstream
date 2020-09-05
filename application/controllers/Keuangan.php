<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keuangan extends CI_Controller
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
                "User_model" => "user_m",
                "M_partner_model" => "partner",
                "Keuangan_model" => "keumod"
            )
        );
        $this->lang->load('menu_lang', 'indonesian');
    }

    public function index()
    {
        $data['page_title'] = "Keuangan";
        $data['page_content'] = $this->load->view("keuangan/index", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function registrasi($path)
    {
        switch ($path) {
            case 'register_jurnal':
                $this->register_jurnal();
                break;
            case 'list_jurnal':
                $this->list_jurnal();
                break;
            case 'cetak_ulang_jurnal':
                $this->cetak_ulang_jurnal();
                break;
            default:
                break;
        }
    }

    private function register_jurnal()
    {
        $data['page_title'] = "Register Jurnal";
        $data['page_content'] = $this->load->view("keuangan/registrasi/register_jurnal", "", true);
        $data['page_js'] = $this->load->view("keuangan/registrasi/register_jurnal_js", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function list_jurnal()
    {
        $data['page_title'] = "List Jurnal";
        $data['page_content'] = $this->load->view("keuangan/registrasi/list_jurnal", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function cetak_ulang_jurnal()
    {
        $data['page_title'] = "Cetak Ulang Jurnal";
        $data['page_content'] = $this->load->view("keuangan/registrasi/cetak_ulang_jurnal", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function pembayaran($path)
    {
        switch ($path) {
            case 'piutang':
                $data = $this->piutang();
                break;
            case 'hutang':
                $data = $this->hutang();
                break;

            default:
                $data = array();
                break;
        }
        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function piutang()
    {
        // Tampilkan seluruh client yang punya invoice
        $content["customers"] = $this->keumod->get_customer_with_invoice_piutang()->result();

        $data['page_title'] = "Pembayaran Piutang";
        $data['page_content'] = $this->load->view("keuangan/pembayaran/piutang", $content, true);
        $data['page_js'] = $this->load->view("keuangan/pembayaran/piutang_js", "", true);

        return $data;
    }

    private function hutang()
    {
        $data['page_title'] = "Pembayaran Hutang";
        $data['page_content'] = $this->load->view("keuangan/pembayaran/hutang", "", true);

        return $data;
    }

    public function jurnal($path)
    {
        switch ($path) {
            case 'jurnal_kas_masuk':
                $this->jurnal_kas_masuk();
                break;
            case 'jurnal_kas_keluar':
                $this->jurnal_kas_keluar();
                break;
            case 'jurnal_rupa_rupa':
                $this->jurnal_rupa_rupa();
                break;
            case 'antar_buku_bantu':
                $this->antar_buku_bantu();
                break;

            default:
                break;
        }
    }

    private function jurnal_kas_masuk()
    {
        $data['page_title'] = "Jurnal Kas Masuk";
        $data['page_content'] = $this->load->view("keuangan/jurnal/jurnal_kas_masuk", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function jurnal_kas_keluar()
    {
        $data['page_title'] = "Jurnal Kas Keluar";
        $data['page_content'] = $this->load->view("keuangan/jurnal/jurnal_kas_keluar", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function jurnal_rupa_rupa()
    {
        $data['page_title'] = "Jurnal Rupa-rupa";
        $data['page_content'] = $this->load->view("keuangan/jurnal/jurnal_rupa_rupa", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function antar_buku_bantu()
    {
        $data['page_title'] = "Antar Buku Bantu";
        $data['page_content'] = $this->load->view("keuangan/jurnal/antar_buku_bantu", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function koreksi($path)
    {
        switch ($path) {
            case 'koreksi_kantor_cabang':
                $this->koreksi_kantor_cabang();
                break;
            case 'koreksi_kantor_pusat':
                $this->koreksi_kantor_pusat();
                break;
            case 'koreksi_akuntan_publik':
                $this->koreksi_akuntan_publik();
                break;
            default:
                break;
        }
    }

    private function koreksi_kantor_cabang()
    {
        $data['page_title'] = "Koreksi Kantor Cabang";
        $data['page_content'] = $this->load->view("keuangan/koreksi/koreksi_kantor_cabang", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function koreksi_kantor_pusat()
    {
        $data['page_title'] = "Koreksi Kantor Pusat";
        $data['page_content'] = $this->load->view("keuangan/koreksi/koreksi_kantor_pusat", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function koreksi_akuntan_publik()
    {
        $data['page_title'] = "Koreksi Akuntan Publik";
        $data['page_content'] = $this->load->view("keuangan/koreksi/koreksi_akuntan_publik", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function tutup_buku($path)
    {
        switch ($path) {
            case 'bulanan':
                $this->tutup_buku_bulanan();
                break;
            case 'status':
                $this->tutup_buku_status();
                break;

            default:
                break;
        }
    }

    private function tutup_buku_bulanan()
    {
        $data['page_title'] = "Tutup Buku Bulanan";
        $data['page_content'] = $this->load->view("keuangan/tutup_buku/bulanan", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function tutup_buku_status()
    {
        $data['page_title'] = "Status Tutup Buku";
        $data['page_content'] = $this->load->view("keuangan/tutup_buku/status", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function report($path, $next_path)
    {
        switch ($path) {
            case 'harian':
                switch ($next_path) {
                    case 'mutasi_harian_kas_bank':
                        $this->mutasi_harian_kas_bank();
                        break;
                    case 'mutasi_jurnal_harian':
                        $this->mutasi_jurnal_harian();
                        break;
                    default:
                        break;
                }
                break;
            case 'bulanan':
                switch ($next_path) {
                    case 'neraca_saldo':
                        $this->neraca_saldo();
                        break;
                    case 'faktur_pajak_harian':
                        $this->faktur_pajak_harian();
                        break;
                    case 'laba_rugi':
                        $this->laba_rugi();
                        break;

                    default:
                        break;
                }
                break;
            case 'ikhtisar':
                switch ($next_path) {
                    case 'buku_besar':
                        $this->ikhtisar_buku_besar();
                        break;
                    case 'pajak':
                        $this->ikhtisar_pajak();
                        break;
                    case 'pendapatan':
                        $this->ikhtisar_pendapatan();
                        break;
                    case 'pembelian':
                        $this->ikhtisar_pembelian();
                        break;

                    default:
                        break;
                }
                break;
            case 'aging':
                switch ($next_path) {
                    case 'piutang':
                        $this->aging_piutang();
                        break;
                    case 'hutang':
                        $this->aging_hutang();
                        break;

                    default:
                        break;
                }
                break;

            default:
                break;
        }
    }

    private function mutasi_harian_kas_bank()
    {
        $data['page_title'] = "Mutasi Harian Kas Bank";
        $data['page_content'] = $this->load->view("keuangan/report/harian/mutasi_harian_kas_bank", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function mutasi_jurnal_harian()
    {
        $data['page_title'] = "Mutasi Jurnal Harian";
        $data['page_content'] = $this->load->view("keuangan/report/harian/mutasi_jurnal_harian", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function neraca_saldo()
    {
        $data['page_title'] = "Neraca Saldo";
        $data['page_content'] = $this->load->view("keuangan/report/bulanan/neraca_saldo", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function faktur_pajak_harian()
    {
        $data['page_title'] = "Faktur Pajak Harian";
        $data['page_content'] = $this->load->view("keuangan/report/bulanan/faktur_pajak_harian", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function laba_rugi()
    {
        $data['page_title'] = "Laporan Keuangan Laba Rugi Bulanan";
        $data['page_content'] = $this->load->view("keuangan/report/bulanan/laba_rugi", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function ikhtisar_buku_besar()
    {
        $data['page_title'] = "Ikhtisar Buku Besar";
        $data['page_content'] = $this->load->view("keuangan/report/ikhtisar/ikhtisar_buku_besar", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function ikhtisar_pajak()
    {
        $data['page_title'] = "Ikhtisar Pajak";
        $data['page_content'] = $this->load->view("keuangan/report/ikhtisar/ikhtisar_pajak", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function ikhtisar_pendapatan()
    {
        $data['page_title'] = "Ikhitsar Pendapatan";
        $data['page_content'] = $this->load->view("keuangan/report/ikhtisar/ikhtisar_pendapatan", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function ikhtisar_pembelian()
    {
        $data['page_title'] = "Ikhtisar Pembelian";
        $data['page_content'] = $this->load->view("keuangan/report/ikhtisar/ikhtisar_pembelian", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function aging_piutang()
    {
        $data['page_title'] = "Aging Piutang";
        $data['page_content'] = $this->load->view("keuangan/report/aging/aging_piutang", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    private function aging_hutang()
    {
        $data['page_title'] = "Aging Hutang";
        $data['page_content'] = $this->load->view("keuangan/report/aging/aging_hutang", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }
}

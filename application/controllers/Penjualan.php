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
                "m_branch_model" => "branch",
                "m_partner_model" => "partner",
                "m_goods_model" => "goods",
                "m_warehouse_model" => "m_ws",
                "t_order_request_model" => "or",
                "t_pos_model" => "pos",
                "t_pos_return_model" => "pos_return",
                "T_pos_report_model" => "pos_report",
                "S_history_model" => "history",
                "S_reference_model" => "ref"
            )
        );
    }

    public function home()
    {
        if ($this->session->role_code != "ROLE_SUPER_ADMIN") {
            $content = array(
                "belum_cetak_faktur" => $this->or->get_non_pos(
                    "branch_id = " . $this->session->branch_id
                )->num_rows(),
                "pos_di_bulan_berjalan" => $this->pos->get_this_month(
                    array(
                        "branch_id" => $this->session->branch_id
                    )
                )->num_rows(),
                "or_di_bulan_berjalan" => $this->or->get_this_month(
                    array(
                        "branch_id" => $this->session->branch_id
                    )
                )->num_rows(),
            );
        } else {
            $content = array(
                "belum_cetak_faktur" => $this->or->get_non_pos()->num_rows(),
                "pos_di_bulan_berjalan" => $this->pos->get_this_month()->num_rows(),
                "or_di_bulan_berjalan" => $this->or->get_this_month()->num_rows()
            );
        }

        $data['page_title'] = "Penjualan";
        $data['page_content'] = $this->load->view("penjualan/index", $content, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function order_request($command = '', $id_or = '')
    {
        if ($command == "view") {
            $data['page_title'] = "Penjualan - Order Request";
            $data['back_url'] = base_url("/index.php/penjualan/order_request");
            $content['data_or'] = $this->or->get_specific($id_or);

            $data['page_content'] = $this->load->view("penjualan/order_request/view/view", $content, true);
        } else if ($command == "checksheet") {
            $data['page_title'] = "Checksheet - Order Request";
            $data['back_url'] = base_url("/index.php/penjualan/order_request");
            $content['data_or'] = $this->or->get_specific($id_or);

            $data['page_content'] = $this->load->view("penjualan/order_request/checksheet", $content, true);
            $data['page_js'] = $this->load->view("penjualan/order_request/checksheet_js", $content, true);
        } else {
            // tampilkan list of order request
            $data['page_title'] = "Penjualan - Daftar Order Request";
            $data['back_url'] = base_url("/index.php/penjualan/home");

            $data['page_content'] = $this->load->view("penjualan/order_request/list", "", true);
            $data['page_js'] = $this->load->view("penjualan/order_request/list_js", "", true);
        }

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function add_order_request()
    {
        $data['page_title']   = "Tambah Order Request";
        $data['back_url']     = base_url("/index.php/penjualan/order_request");
        $content["customers"] = $this->partner->get_customer()->result();
        $data['page_content'] = $this->load->view("penjualan/order_request/index", $content, true);
        $data['page_js']      = $this->load->view("penjualan/order_request/index_js", "", true);
        $data['page_modal']   = $this->load->view("penjualan/order_request/modal", "", true);

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
        $data['page_modal'] = $this->load->view("penjualan/order_request/modal", "", true);

        $data['transactional'] = true;
        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }


    public function print_order_request($id_or, $type = 1)
    {

        $content = $this->or->get_specific($id_or);

        $data = array();
        if ($content) {
            foreach ($content->details as $key => $val) {


                $data[] = array(
                    "id" => $content->id,
                    "branch_id" => $content->branch_id,
                    "branch_name" => $content->branch_name,
                    "partner_id" => $content->partner_id,
                    "user_salesman_id" => $content->user_salesman_id,
                    "order_no" => $content->order_no,
                    "order_date" => $content->order_date,
                    "partner_name" => $content->partner_name,
                    "is_delivery" => $content->is_delivery,
                    "description" => $content->description,
                    "created_by" => $content->created_by,
                    "created_date" => $content->created_date,
                    "updated_date" => $content->updated_date,
                    "updated_by" => $content->updated_by,
                    "id" => "4",
                    "order_request_id" => $val->order_request_id,
                    "warehouse_id" => $val->warehouse_id,
                    "goods_id" => $val->goods_id,
                    "goods_name" => $val->goods_name,
                    "quantity" => $val->quantity,
                    "checksheet_qty" => isset($val->checksheet_qty) ? $val->checksheet_qty : '',
                    "discount" => $val->discount,
                    "discount_code" => $val->discount_code,
                    "price" => $val->price,
                    "tax" => $val->tax,
                    "total" => $val->total,
                    "flag" => $val->flag,
                    "barcode" => $val->barcode,
                    "brand_name" => $val->brand_name,
                    "brand_description" =>  $val->brand_description,
                    "unit_name" => $val->unit_name,
                    "unit_initial" => $val->unit_initial,

                );
            }
            $type_print = $type == 1 ?  "order_request_out" : "checksheet_out";

            $this->pdf->dynamic_print(2, $type_print, $data);
        }
    }

    // POS

    public function pos($command = '', $id_or = '')
    {
        $data['transactional'] = true;
        if ($command == "cetak_faktur") {
        } else if ($command == "add") {
            $data['page_title'] = "Transaksi Baru - Point of Sales";
            $data['back_url'] = base_url("/index.php/penjualan/pos");

            $content["customers"] = $this->partner->get_customer()->result();
            $content['data_branch'] = $this->branch->get(array("id" => $this->session->branch_id))->row();

            $data['page_content'] = $this->load->view("penjualan/pos/add", $content, true);
            $data['page_js'] = $this->load->view("penjualan/pos/add_js", "", true);
            $data['page_modal'] = $this->load->view("penjualan/pos/add_modal", "", true);

            $data['transactional'] = true;
        } else if ($command == "view") {
            $data['page_title'] = "Preview - Point of Sales";
            $data['back_url'] = base_url("/index.php/penjualan/pos");

            $content['data_pos'] = $this->pos->get_specific($id_or);

            $data['page_content'] = $this->load->view("penjualan/pos/view", $content, true);
            $data['page_js'] = $this->load->view("penjualan/pos/view_js", "", true);

            $data['transactional'] = true;
        } else if ($command == "edit") {
            $data['page_title'] = "Edit - Point of Sales";
            $data['back_url'] = base_url("/index.php/penjualan/pos");

            $content['banks'] = $this->ref->get(array("group_data" => "BANK"))->result();
            $content['payment_methods'] = $this->ref->get(array("group_data" => "PAYMENT_METHOD"))->result();
            $content['data_branch'] = $this->branch->get(array("id" => $this->session->branch_id))->row();
            $content['data_pos'] = $this->pos->get_specific($id_or);

            $data['page_content'] = $this->load->view("penjualan/pos/edit", $content, true);
            $data['page_js'] = $this->load->view("penjualan/pos/edit_js", "", true);
            $data['page_modal'] = $this->load->view("penjualan/pos/add_modal", "", true);

            $data['transactional'] = true;
        } else {
            // tampilkan list of Point of Sales
            $data['back_url'] = base_url("/index.php/penjualan/home");

            $content['banks'] = $this->ref->get(array("group_data" => "BANK"))->result();
            $content['payment_methods'] = $this->ref->get(array("group_data" => "PAYMENT_METHOD"))->result();
            $content['data_branch'] = $this->branch->get(array("id" => $this->session->branch_id))->row();

            $data['page_title'] = "Penjualan - Daftar Point of Sales";
            $data['page_content'] = $this->load->view("penjualan/pos/list", $content, true);
            $data['page_js'] = $this->load->view("penjualan/pos/list_js", "", true);
        }

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function print_pos($pos_id)
    {
        $data = $this->pos_report->pos_report("tab1.id=" . $pos_id, "tab3.id")->result_array();
        $this->pdf->dynamic_print(2, "pos_out", $data);
    }

    // return
    public function return()
    {

        $data['page_title'] = "Retur Penjualan";
        $data['return']     = $this->pos_return->get_all();
        $data['page_content'] = $this->load->view("penjualan/return/return", $data, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
        $this->load->view('penjualan/return/return_js');
    }

    public function add_return()
    {

        $data['page_title']   = "Retur Penjualan";
        $data['return_no']    = generate_po_no(5);
        $data['warehouse']    = $this->m_ws->get_all()->result();
        $data['tgl_indo']     = longdate_indo(date('Y-m-d'));
        $data['supplier']     = $this->get_partner(array("is_customer" => 1));
        $data['page_content'] = $this->load->view("penjualan/return/add_return", $data, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base_maxwidth', $data);
        $this->load->view('layout/js');
        $this->load->view('penjualan/return/return_js');
    }

    public function edit_return($id)
    {

        $data['page_title']   = "Retur Pembelian";
        $data['return_no']    = generate_po_no(5);
        $data['tgl_indo']     = longdate_indo(date('Y-m-d'));
        $data['customer']     = $this->get_partner(array("is_customer" => 1));
        $data['warehouse']    = $this->m_ws->get_all()->result();
        $data['master']       = $this->pos_return->get_all("tab1.id=" . $id, "tab2.id");

        $data['page_content'] = $this->load->view("penjualan/return/edit_return", $data, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base_maxwidth', $data);
        $this->load->view('layout/js');
        $this->load->view('penjualan/return/return_js');
    }

    // get all product from pos
    // group_type = 1 group by goods,
    // group_type = 2 group by pos.id
    public function get_goods_json($type = 1)
    {

        $where['partner_id']     = $this->input->get('customer_id');
        // get all invoice no
        if ($type == 1) {
            $group_type          = 1;
            // get all goods
        } else if ($type == 2) {
            $group_type           = 2;
            // get specific goods
        } else if ($type == 3) {
            $where['goods_id']    = $this->input->get('goods_id');
            $group_type          = 1;

            // get specific goods from search column 
        } else if ($type == 4) {
            $where = "partner_id = " . $this->input->get('customer_id');
            if ($this->input->get('goods') != "") {
                $where .=  " and brand_description LIKE '" . $this->input->get('goods') . "%' OR sku_code like '" . $this->input->get('goods') . "%' OR plu_code like '" . $this->input->get('goods') . "%' or barcode like '" . $this->input->get('goods') . "%'";
            }

            $group_type         = 1;
        } else if ($type == 5) {
            $where['invoice_no'] = $this->input->get('invoice_no');
            $group_type          = 1;
        }


        $data                    = $this->pos_return->get_all_product($where, $group_type)->result();

        echo json_encode($data);
    }



    public function get_pos_goods($type = 1)
    {

        if ($type == 1) {
            $invoice_no   = $this->input->get('invoice_no');
            $customer_id  = $this->input->get('customer_id');
            $where        = "tab1.invoice_no='" . $invoice_no . "' and tab1.partner_id=" . $customer_id;
        } else {
            // $invoice_no   = $this->input->get('invoice_no');
            $goods_id     = $this->input->get('goods_id');
            $where        = "tab2.goods_id=" . $goods_id;
        }

        $data       = $this->pos_return->get_all_pos($where, "tab2.goods_id")->result();

        echo json_encode($data);
    }


    public function save_return()
    {
        $param = $this->input->post();

        if (count($param) > 0) {

            if (array_key_exists("id", $param)) {


                $arr_return = array(
                    "branch_id" => $this->session->userdata('branch_id'),
                    "partner_id" => $param['customer_id'],
                    "return_no" => $param['return_no'],
                    "reference_no" => $param['no_ref'],
                    "description" => $param['deskripsi'],
                    "transaction_date" => $param['tgl_trx'],
                    "return_date" => $param['tgl_trx'],
                    "updated_date" => date('Y-m-d H:i:s'),
                    "updated_by" => $this->session->userdata('id'),
                    "flag" => 1
                );

                $this->pos_return->delete($param['id']);
                $this->pos_return->insert($arr_return, $param);


                // insert hitory activity
                $history_data  = array(
                    "branch_id" => $this->session->userdata('branch_id'),
                    "branch_name" => $this->session->userdata('branch_name'),
                    "created_by" => $this->session->userdata('id'),
                    "created_name" => $this->session->userdata('name'),
                    "activity"  => "Mengubah Transaksi Retur",
                    "created_date" => date('Y-m-d H:i:s'),
                );

                $this->history->insert($history_data);
                $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Retur berhasil diperbaharui</div>');

                redirect("penjualan/return");
            } else {

                $arr_return = array(
                    "branch_id" => $this->session->userdata('branch_id'),
                    "partner_id" => $param['customer_id'],
                    "return_no" => $param['return_no'],
                    "reference_no" => $param['no_ref'],
                    "description" => $param['deskripsi'],
                    "transaction_date" => $param['tgl_trx'],
                    "return_date" => $param['tgl_trx'],
                    "created_by" => $this->session->userdata('id'),
                    "created_date" => date('Y-m-d H:i:s'),
                    "updated_date" => date('Y-m-d H:i:s'),
                    "updated_by" => $this->session->userdata('id'),
                    "flag" => 1
                );


                $this->pos_return->insert($arr_return, $param);


                // insert hitory activity
                $history_data  = array(
                    "branch_id" => $this->session->userdata('branch_id'),
                    "branch_name" => $this->session->userdata('branch_name'),
                    "created_by" => $this->session->userdata('id'),
                    "created_name" => $this->session->userdata('name'),
                    "activity"  => "Membuat Transaksi Retur",
                    "created_date" => date('Y-m-d H:i:s'),
                );

                $this->history->insert($history_data);
                $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Retur berhasil disimpan</div>');

                redirect("penjualan/add_return");
            }
        }
    }

    public function print_return($id)
    {
        $where = "tab1.id=" . $id;
        $group = "tab1.id,tab2.id";
        $data = $this->pos_return->get_all($where, $group, 2);
        $this->pdf->dynamic_print(2, "return_out", $data);
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
        $today = date('Y-m-d');
        $where = "DATE(tab1.updated_date) = DATE('" . $today . "')";

        if (count($_GET)) {

            $key   = trim($_GET['key']);
            $where = "(tab4.brand_name LIKE '" . $key . "%' or tab1.invoice_no LIKE '" . $key . "' OR tab1.partner_name LIKE '%" . $key . "%') AND DATE(tab1.updated_date) = '" . $today . "'";
        } else {
            $key   = "";
        }

        $data['page_title']   = "Laporan Penjualan Harian";
        $data['total_trans']  = count($this->pos_report->pos_report($where, "tab1.id")->result());
        $data['total_sum']    = $this->pos_report->pos_report($where)->row()->total;
        $data['master']       = $this->pos_report->pos_report($where, "tab1.id")->result();
        $data['key']          = $key;

        $data['page_content'] = $this->load->view("penjualan/laporan/penjualan/harian", $data, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
        $this->load->view('penjualan/laporan/penjualan/js');
    }


    public function detail_laporan_penjualan($type = 1, $id)
    {
        $data['page_title'] = "<a href='" . base_url('index.php/penjualan/laporan/penjualan/harian') . "'><span class='la la-arrow-left'></span></a> Detail Laporan Penjualan Harian";
        $data['type']       = $type;
        $data['id']         = $id;
        $data['key']        = null;
        $data['master']     = $this->pos_report->pos_report("tab1.id=" . $id, "tab3.id")->result();

        $data['page_content'] = $this->load->view("penjualan/laporan/penjualan/preview", $data, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
        $this->load->view('penjualan/laporan/penjualan/js');
    }

    public function print_laporan_penjualan_harian()
    {

        $where                = ($_GET['id']) ? "tab1.id=" . $_GET['id'] : "(tab4.brand_name LIKE '" . $_GET['key'] . "%' or tab1.invoice_no LIKE '" . $_GET['key'] . "' OR tab1.partner_name LIKE '" . $_GET['key'] . "%' ) AND DATE(tab1.updated_date) = '" . date('Y-m-d') . "'";
        $group                = ($_GET['group']) ? "tab3.id" : "tab1.id";

        $data['total_sum']    = $this->pos_report->pos_report($where)->row()->total;
        $data['master']       = $this->pos_report->pos_report($where, $group)->result_array();
        $data['type']         = $_GET['type'];
        $full                 = $_GET['type'] == 1 ? "" : "_full";

        $this->pdf->dynamic_print(2, "daily_sales_out" . $full, $data['master']);
        // $this->load->view('penjualan/laporan/penjualan/print_laporan_penjualan', $data);
    }



    private function laporan_penjualan_bulanan()
    {

        $where = "DATE_FORMAT(tab1.updated_date,'%Y-%m') = date('Y-m')";
        $group = "DATE(tab1.updated_date)";
        $from  = "";
        $to    = "";

        if (count($_GET)) {

            $from  = trim($_GET['from']);
            $to    = trim($_GET['to']);
            $where = "DATE(tab1.updated_date) >='" . $from . "' and DATE(tab1.updated_date) <='" . $to . "'";
        }


        $data['page_title'] = "Laporan Penjualan Bulanan";
        $data['type']         = 2;
        $data['total_trans']  = $this->pos_report->pos_report($where)->row()->total_trans;
        $data['total_sum']    = $this->pos_report->pos_report($where)->row()->total;
        $data['master']       = $this->pos_report->pos_report($where, $group)->result();
        $data['from']         = $from;
        $data['to']           = $to;
        $data['page_content'] = $this->load->view("penjualan/laporan/penjualan/bulanan", $data, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }

    public function print_laporan_penjualan_bulanan()
    {

        $where = "DATE_FORMAT(tab1.updated_date,'%Y-%m')";
        $group = "DATE(tab1.updated_date)";
        $from  = "";
        $to    = "";

        if (count($_GET)) {

            $from  = !empty($_GET['from'])  ? trim($_GET['from']) : null;
            $to    = !empty($_GET['to']) ? trim($_GET['to']) : null;

            if ($from && $to) {
                $where = "DATE(tab1.updated_date) >='" . $from . "' and DATE(tab1.updated_date) <='" . $to . "'";
            }
        }



        $data['total_trans']  = $this->pos_report->pos_report($where)->row()->total_trans;
        $data['total_sum']    = $this->pos_report->pos_report($where)->row()->total;
        $data['master']       = $this->pos_report->pos_report($where, $group)->result_array();
        $data['type']         = 2;
        $data['from']         = $from;
        $data['to']           = $to;

        $this->pdf->dynamic_print(2, "monthly_sales_out", $data['master']);
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


    public function get_partner($where = array(), $return = false)
    {
        $data = $this->partner->get($where);

        if ($return) {
            return json_encode($data);
        }

        return $data->result();
    }


    public function retur_pos($id = null)
    {
        $this->pos->cut_qty($id);
    }



    public function approve_return()
    {
        $where['id'] = $this->input->get("return_id");
        $data['flag'] = 2;
        $msg   = $this->pos_return->update($where, $data);

        echo json_encode($msg);
    }
}

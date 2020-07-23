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
                "m_warehouse_model" => "m_ws",
                "t_order_request_model" => "or",
                "t_pos_model" => "pos",
                "t_pos_return_model" => "pos_return",
                "T_pos_report_model" => "pos_report",
                "S_history_model" => "history", 
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

    public function order_request($command = '', $id_or = '')
    {
        if ($command == "view") {
            $data['page_title'] = "Penjualan - Order Request";
            $data['back_url'] = base_url("/index.php/penjualan/order_request");
            $content['data_or'] = $this->or->get_specific($id_or);
            
            $data['page_content'] = $this->load->view("penjualan/order_request/view/view", $content, true);
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
        if ($command == "cetak_faktur") {
            $data['page_title'] = "Point of Sales - Cetak Faktur";
            $data['back_url'] = base_url("/index.php/penjualan/order_request");
            $content['data_or'] = $this->or->get_specific($id_or);

            $data['page_content'] = $this->load->view("penjualan/pos/cetak_faktur", $content, true);
            $data['page_js'] = $this->load->view("penjualan/pos/cetak_faktur_js", $content, true);
        } else if ($command == "add") {
            $data['page_title'] = "Transaksi Baru - Point of Sales";
            $data['back_url'] = base_url("/index.php/penjualan/pos");
 
            $content["customers"] = $this->partner->get_customer()->result();

            $data['page_content'] = $this->load->view("penjualan/pos/add", $content, true);
            $data['page_js'] = $this->load->view("penjualan/pos/add_js", "", true);
            $data['page_modal'] = $this->load->view("penjualan/pos/add_modal", "", true);

            $data['transactional'] = true;
        } else {
            // tampilkan list of Point of Sales
            $data['back_url'] = base_url("/index.php/penjualan/home");

            $data['page_title'] = "Penjualan - Daftar Point of Sales";
            $data['page_content'] = $this->load->view("penjualan/pos/list", "", true);
            $data['page_js'] = $this->load->view("penjualan/pos/list_js", "", true);
        }

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }
 
    // return
    public function return()
    {
        $data['page_title'] = "Retur Penjualan";
        $data['return']     = $this->pos_return->get_all();
        // echo json_encode($data);exit;
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
        $data['tgl_indo']     = longdate_indo( date('Y-m-d') ); 
        $data['supplier']     = $this->get_partner(array("is_customer"=>1));
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
        $data['tgl_indo']     = longdate_indo( date('Y-m-d') );
        $data['customer']     = $this->get_partner(array("is_customer"=>1));
        $data['warehouse']    = $this->m_ws->get_all()->result();
        $data['master']       = $this->pos_return->get_all("tab1.id=".$id,"tab2.id");
        // echo json_encode($data['master']);exit;
        $data['page_content'] = $this->load->view("penjualan/return/edit_return", $data, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base_maxwidth', $data);
        $this->load->view('layout/js');
        $this->load->view('penjualan/return/return_js'); 
    }

    public function get_pos_goods($type = 1)
    {

        if ($type == 1) {
            $invoice_no = $this->input->get('invoice_no'); 
            $customer_id  = $this->input->get('customer_id'); 
            $where        = "tab1.invoice_no='".$invoice_no."' and tab1.partner_id=".$customer_id;
        
        }else {
            $invoice_no = $this->input->get('invoice_no'); 
            $goods_id  = $this->input->get('goods_id'); 
            $where        = "tab1.invoice_no='".$invoice_no."' and tab2.goods_id=".$goods_id;
        
        }
        
        $data       = $this->pos_return->get_all_pos($where,"tab2.goods_id")->result();

        echo json_encode($data);
    }


    public function save_return()
    {
        $param = $this->input->post();
        // echo json_encode($param);exit;
        if ( count($param) > 0) {

            if (array_key_exists("id", $param)) {


                    $arr_return = array(
                            "branch_id" => $this->session->userdata('branch_id'),
                            "partner_id" => $param['supplier'],
                            "return_no" => $param['return_no'],
                            "reference_no" => $param['no_ref'],
                            "description" => $param['deskripsi'],
                            "transaction_date" => $param['tgl_trx'],
                            "return_date" => $param['tgl_trx'],
                            "updated_date" => date('Y-m-d H:i:s'),
                            "updated_by" => $this->session->userdata('id'),
                            "flag" => 1);
                    // echo json_encode($arr_return);exit;
                    $this->pos_return->delete($param['id']);
                    $this->pos_return->insert($arr_return, $param);


                     // insert hitory activity
                    $history_data  = array("branch_id" => $this->session->userdata('branch_id'),
                                           "branch_name" => $this->session->userdata('branch_name'),
                                           "created_by" => $this->session->userdata('id'),
                                           "created_name" => $this->session->userdata('name'),
                                           "activity"  => "Mengubah Transaksi Retur",
                                           "created_date" => date('Y-m-d H:i:s'),
                                        );

                    $this->history->insert($history_data);
                    $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Retur berhasil diperbaharui</div>');

                    redirect("penjualan/return");

            }else {
                // echo json_encode($param);exit;
                $arr_return = array(
                            "branch_id" => $this->session->userdata('branch_id'),
                            "partner_id" => $param['supplier'],
                            "return_no" => $param['return_no'],
                            "reference_no" => $param['no_ref'],
                            "description" => $param['deskripsi'],
                            "transaction_date" => $param['tgl_trx'],
                            "return_date" => $param['tgl_trx'],
                            "created_by" => $this->session->userdata('id'),
                            "created_date" => date('Y-m-d H:i:s'),
                            "updated_date" => date('Y-m-d H:i:s'),
                            "updated_by" => $this->session->userdata('id'),
                            "flag" => 1);

            // echo json_encode($arr_return);exit;
                $this->pos_return->insert($arr_return, $param);


                 // insert hitory activity
                $history_data  = array("branch_id" => $this->session->userdata('branch_id'),
                                       "branch_name" => $this->session->userdata('branch_name'),
                                       "created_by" => $this->session->userdata('id'),
                                       "created_name" => $this->session->userdata('name'),
                                       "activity"  => "Membuat Transaksi Retur",
                                       "created_date" => date('Y-m-d H:i:s'),
                                    );

                $this->history->insert($history_data);
                $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Retur berhasil disimpan</div>');

                redirect("penjualan/add_return");

            }
        }
    }

    public function print_return($id)
    {
        $where = "tab1.id=".$id;
        $group = "tab1.id,tab2.id";
        $data = $this->pos_return->get_all($where, $group, 2);
        $this->pdf->dynamic_print(2,"return_out",$data);
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
        $where = "DATE(tab1.updated_date) = DATE('".$today."')";

        if (count($_GET)) {

            $key   = trim($_GET['key']);
            $where = "(tab4.brand_name LIKE '".$key."%' or tab1.invoice_no LIKE '".$key."' OR tab1.partner_name LIKE '%".$key."%') AND DATE(tab1.updated_date) = '".$today."'";

        } else {
            $key   = "";
        }
        // echo $where;exit;
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
        $data['page_title'] = "<a href='".base_url('index.php/penjualan/laporan/penjualan/harian')."'><span class='la la-arrow-left'></span></a> Detail Laporan Penjualan Harian";
        $data['type']       = $type;
        $data['id']         = $id;
        $data['key']        = null;
        $data['master']     = $this->pos_report->pos_report("tab1.id=".$id, "tab3.id")->result(); 
        
         $data['page_content'] = $this->load->view("penjualan/laporan/penjualan/preview", $data, true);
        
        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
        $this->load->view('penjualan/laporan/penjualan/js');
    }

    public function print_laporan_penjualan_harian()
    {
        // echo json_encode($_GET);exit;
        $where = ($_GET['id']) ? "tab1.id=".$_GET['id'] : "(tab4.brand_name LIKE '".$_GET['key']."%' or tab1.invoice_no LIKE '".$_GET['key']."' OR tab1.partner_name LIKE '".$_GET['key']."%' ) AND DATE(tab1.updated_date) = '".date('Y-m-d')."'";
        $group = ($_GET['group']) ? "tab3.id" : "tab1.id";

        $data['total_sum']    = $this->pos_report->pos_report($where)->row()->total;
        $data['master']       = $this->pos_report->pos_report($where,$group)->result(); 
        $data['type']         = $_GET['type'];
        // echo json_encode($data['master']);exit;
        $this->load->view('penjualan/laporan/penjualan/print_laporan_penjualan',$data);

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
            $where = "DATE(tab1.updated_date) >='".$from."' and DATE(tab1.updated_date) <='".$to."'";

        } 


        $data['page_title'] = "Laporan Penjualan Bulanan";
        $data['type']         = 2;
        $data['total_trans']  = $this->pos_report->pos_report($where)->row()->total_trans;
        $data['total_sum']    = $this->pos_report->pos_report($where)->row()->total;
        $data['master']       = $this->pos_report->pos_report($where, $group)->result(); 
        $data['from']         = $from;
        $data['to']           = $to;
        $data['page_content'] = $this->load->view("penjualan/laporan/penjualan/bulanan", $data, true);
        // echo json_encode($data);exit;
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

            if ($from && $to)
            {
                $where = "DATE(tab1.updated_date) >='".$from."' and DATE(tab1.updated_date) <='".$to."'";
            }
            

        }
        

        $data['total_trans']  = $this->pos_report->pos_report($where)->row()->total_trans;
        $data['total_sum']    = $this->pos_report->pos_report($where)->row()->total;
        $data['master']       = $this->pos_report->pos_report($where, $group)->result();
        $data['type']         = 2;
        $data['from']         = $from;
        $data['to']           = $to;
         
         $this->load->view('penjualan/laporan/penjualan/print_laporan_penjualan',$data);

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


    public function get_partner($where=array(),$return=false)
    {
        $data = $this->partner->get($where);

        if($return) 
        {
            return json_encode($data);
        }

        return $data->result();
    }


    public function retur_pos($id=null)
    {
        $this->pos->cut_qty($id);
    }



    public function approve_return()
    {
        $where['id'] = $this->input->get("return_id");
        $data['flag']= 2;
        $msg   = $this->pos_return->update($where,$data);

        echo json_encode($msg);
    }
}

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
        $this->lang->load('menu_lang', 'indonesian');
        $this->load->model(
            array(
                "user_model" => "user_m",
                "M_partner_model"=>"partner",
                "M_goods_model"=>"goods",
                "Purchase_order_model" => "po",
                "Purchase_order_detail_model" => "pod",
                "S_history_model" => "history",
            )
        );
    }

    public function index()
    {
         if (count($_POST)) {
            $id_user           = $this->session->userdata('id');
            $name              = $this->session->userdata('name');
            if (array_key_exists("id",$_POST)) {

                $where_id['id']= $_POST['id'];
                $entry_data    = array("branch_id" => $_POST['branch_id'],
                                "salesman_id" => $_POST['salesman_id'],
                                "purchase_order_no" => $_POST['purchase_order_no'],
                                "reference_no" => $_POST['reference_no'],
                                "description" => $_POST['description'],
                                "created_by" => $id_user,
                                "created_date" => date('Y-m-d H:i:s'),
                                "updated_date" => date('Y-m-d H:i:s'),
                                "updated_by" => $id_user,
                                "flag" => 1);
                
                $this->po->update($where_id, $entry_data);
                $where_id = array();
                $where_id['purchase_order_id']   = $_POST['id'];
                // delete all po detail
                $this->pod->delete($where_id);

                // insert new all po detail
                $this->pod->insert($_POST['id'],$_POST);

                // insert history/activity
                $history_data  = array("branch_id" => $_POST['branch_id'],
                                "branch_name" => $_POST['branch_name'],
                                "created_by" => $id_user,
                                "created_name" => $name,
                                "activity"  => "Memperbaharui Transaksi Pembelian Ke ".$_POST['partner_name'],
                                "created_date" => date('Y-m-d H:i:s'),
                               );

                $this->history->insert($history_data);

                 $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">PO berhasil diperbaharui</div>');


            }else {

               $entry_data   = array("branch_id" => $_POST['branch_id'],
                                "salesman_id" => $_POST['salesman_id'],
                                "purchase_order_no" => $_POST['purchase_order_no'],
                                "reference_no" => $_POST['reference_no'],
                                "description" => $_POST['description'],
                                "purchase_order_date" => $_POST['tgl_po'],
                                "created_by" => $id_user,
                                "created_date" => date('Y-m-d H:i:s'),
                                "updated_date" => date('Y-m-d H:i:s'),
                                "updated_by" => $id_user,
                                "flag" => 1);
               // insert po 
                $po_id        = $this->po->insert($entry_data)->row()->id;

                // insert detail po
                $this->pod->insert($po_id,$_POST);

                // insert hitory activity
                $history_data  = array("branch_id" => $_POST['branch_id'],
                                "branch_name" => $_POST['branch_name'],
                                "created_by" => $id_user,
                                "created_name" => $name,
                                "activity"  => "Membuat Transaksi Pembelian Ke ".$_POST['partner_name'],
                                "created_date" => date('Y-m-d H:i:s'),
                               );

                $this->history->insert($history_data);

                $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">PO berhasil disimpan</div>');

                redirect("pembelian/add_purchase");
            }
        }

        $data['back_url']     = base_url();
        $data['page_title']   = "Daftar Pembelian";
        $data['po_data']      = $this->po->get_all_trx(null,array("tab1.id"))->result();
        $data['page_content'] = $this->load->view("pembelian/index", $data, true);
        $data['master']       = array();

        $this->load->view('layout/head');
        $this->load->view('layout/base_maxwidth', $data);
        $this->load->view('layout/js'); 
        $this->load->view('pembelian/pembelian_js'); 
    }

    public function purchase_order()
    {

        $data['page_title']   = "Purchase Order";
        $data['po_data']      = $this->po->get_all_trx(null,array("tab1.id"))->result();
        $data['master']       = array();
        $data['page_content'] = $this->load->view("pembelian/purchase_order", $data, true); 

        $this->load->view('layout/head');
        // $this->load->view('layout/base', $data);
        $this->load->view('layout/base_maxwidth', $data);
        $this->load->view('layout/js');
        $this->load->view('pembelian/pembelian_js'); 
    }

    public function retur()
    {
        $data['page_title'] = "Retur Pembelian";
        $data['page_content'] = $this->load->view("pembelian/retur", "", true);

        $this->load->view('layout/head');
        // $this->load->view('layout/base', $data);
        $this->load->view('layout/base_maxwidth', $data);
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
        // $this->load->view('layout/base', $data);
        $this->load->view('layout/base_maxwidth', $data);
        $this->load->view('layout/js');
    }

    private function laporan_pembelian_bulanan()
    {
        $data['page_title'] = "Laporan Pembelian Bulanan";
        $data['page_content'] = $this->load->view("pembelian/laporan/pembelian/bulanan", "", true);

        $this->load->view('layout/head');
        // $this->load->view('layout/base', $data);
        $this->load->view('layout/base_maxwidth', $data);
        $this->load->view('layout/js');
    }

    private function laporan_retur_harian()
    {
        $data['page_title'] = "Laporan Retur Pembelian Harian";
        $data['page_content'] = $this->load->view("pembelian/laporan/retur/harian", "", true);

        $this->load->view('layout/head');
        // $this->load->view('layout/base', $data);
        $this->load->view('layout/base_maxwidth', $data);
        $this->load->view('layout/js');
    }

    private function laporan_retur_bulanan()
    {
        $data['page_title'] = "Laporan Retur Pembelian Bulanan";
        $data['page_content'] = $this->load->view("pembelian/laporan/retur/bulanan", "", true);

        $this->load->view('layout/head');
        // $this->load->view('layout/base', $data);
        $this->load->view('layout/base_maxwidth', $data);
        $this->load->view('layout/js');
    }


    public function add_purchase()
    {       

        $data['page_title']   = "Tambah Pembelian";
        $data['supplier']     = $this->get_partner(array("is_supplier"=>1));
        $data['po_no']        = generate_po_no();
        $data['master']       = array();
        $data['page_content'] = $this->load->view("pembelian/add_purchase", $data ,true);

        $this->load->view('layout/head');
        $this->load->view('layout/base_maxwidth', $data);
        $this->load->view('layout/js');
        $this->load->view("pembelian/pembelian_js");
    }


    public function edit_purchase($id)
    {
        
        $data['page_title']   = "Edit Pembelian";
        $data['supplier']     = $this->get_partner(array("is_supplier"=>1));
        $data['po_no']        = generate_po_no();
        $data['master']       = $this->po->get_all_trx(array("tab1.id"=>$id),array("tab1.id","tab5.id"))->result();
        // echo json_encode($data['master']);exit;
        $data['page_content'] = $this->load->view("pembelian/edit_purchase", $data ,true);

        $this->load->view('layout/head');
        $this->load->view('layout/base_maxwidth', $data);
        $this->load->view('layout/js');
        $this->load->view("pembelian/pembelian_js");
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

    public function get_goods_json($type = 1)
    {
        if ( $type == 1)
        {
             $goods = $this->input->get('goods');
             $supplier = $this->input->get('id_supplier');             
             $where = "tab1.id=".$supplier;
             $where = ($goods) ? $where." AND tab4.brand_description like '".$goods."%'" : $where;
             $data  = $this->goods->get_goods_per_supplier($where)->result();

        }else if( $type == 2){
            $goods  = $this->input->get('id_goods');
            $where  = "goods_id=".$goods;
            $data  = $this->goods->get_goods_price($where)->result();
        }else {

            $supplier = $this->input->get("id_supplier");   
            $where = "tab1.id=".$supplier;
            $data  = $this->goods->get_goods_per_supplier($where)->result();
        }
       
        

        echo json_encode($data);

    }


    public function approve_po()
    {
        $data['id'] = $this->input->get("po_id");

        $msg   = $this->po->approve_po($data);

        echo json_encode($msg);
    }

 
    public function print_po($id)
    {
        $data = $this->po->get_all_trx(array("tab1.id"=>$id),array("tab1.id","tab5.id"))->result();  
        
        $this->pdf->print_po(1,$data); 
    }
}

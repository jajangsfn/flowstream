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
                "M_warehouse_model"=>"m_ws",
                "Purchase_order_model" => "po",
                "Purchase_order_detail_model" => "pod",
                "S_history_model" => "history", 
                "Receiving_model" => "rm",
                "Return_model" => "return",
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
        $data['page_content'] = $this->load->view("pembelian/po/purchase_order", $data, true); 

        $this->load->view('layout/head');
        $this->load->view('layout/base_maxwidth', $data);
        $this->load->view('layout/js');
        $this->load->view('pembelian/pembelian_js'); 
    }

    // return
    public function return()
    {
        $data['return']       = $this->return->get_all();
        $data['page_title']   = "Retur Pembelian";
        $data['page_content'] = $this->load->view("pembelian/return/return", $data, true);
        // echo json_encode($data['return']);exit;
        $this->load->view('layout/head');
        $this->load->view('layout/base_maxwidth', $data);
        $this->load->view('layout/js');
        $this->load->view('pembelian/return/return_js'); 
    }

    public function add_return()
    {

        $data['page_title']   = "Retur Pembelian";
        $data['return_no']    = generate_po_no(4);
        $data['warehouse']    = $this->m_ws->get_all()->result();
        $data['tgl_indo']     = longdate_indo( date('Y-m-d') ); 
        $data['supplier']     = $this->get_partner(array("is_supplier"=>1));
        $data['page_content'] = $this->load->view("pembelian/return/add_return", $data, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base_maxwidth', $data);
        $this->load->view('layout/js');
        $this->load->view('pembelian/return/return_js'); 
    }

    public function edit_return($id)
    {

        $data['page_title']   = "Retur Pembelian";
        $data['return_no']    = generate_po_no(4);
        $data['tgl_indo']     = longdate_indo( date('Y-m-d') );
        $data['supplier']     = $this->get_partner(array("is_supplier"=>1));
        $data['warehouse']    = $this->m_ws->get_all()->result();
        $data['master']       = $this->return->get_all("tab1.id=".$id,"tab2.id");
        // echo json_encode($data['master']);exit;
        $data['page_content'] = $this->load->view("pembelian/return/edit_return", $data, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base_maxwidth', $data);
        $this->load->view('layout/js');
        $this->load->view('pembelian/return/return_js'); 
    }


    public function get_receive_goods()
    {
        $receiving_no = $this->input->get('receive_no'); 
        $supplier_id  = $this->input->get('supplier_id'); 
        $where        = "tab1.receiving_no='".$receiving_no."'";
        $where_supplier = "tab4.id=".$supplier_id;
        $data       = $this->rm->get_all_receive($where,$where_supplier,"tab2.goods_id")->result();

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
                    $this->return->delete($param['id']);
                    $this->return->insert($arr_return, $param);


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

                    redirect("pembelian/return");

            }else {
                // echo json_encode($param);exit;
                $arr_return = array(
                            "branch_id" => $this->session->userdata('branch_id'),
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
         
                $this->return->insert($arr_return, $param);


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

                redirect("pembelian/add_return");

            }
        }
        
        

    }

    public function approve_return()
    {
        $where['id'] = $this->input->get("return_id");
        $data['flag']= 2;
        $msg   = $this->return->update($where,$data);

        echo json_encode($msg);
    }

 
    public function print_return($id)
    {
        $where = "tab1.id=".$id;
        $group = "tab1.id,tab2.id";
        $data = $this->return->get_all($where, $group);  
        
        $this->pdf->print_return(1,$data); 
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

        $data['page_title']   = "Pembelian";
        $data['supplier']     = $this->get_partner(array("is_supplier"=>1));
        $data['po_no']        = generate_po_no();
        $data['master']       = array();
        $data['tgl_indo']     = longdate_indo( date('Y-m-d') );
        $data['page_content'] = $this->load->view("pembelian/po/add_purchase", $data ,true);

        $this->load->view('layout/head');
        $this->load->view('layout/base_maxwidth', $data);
        $this->load->view('layout/js');
        $this->load->view("pembelian/pembelian_js");
    }


    public function edit_purchase($id)
    {
        
        $data['page_title']   = "Pembelian";
        $data['supplier']     = $this->get_partner(array("is_supplier"=>1));
        $data['po_no']        = generate_po_no();
        $data['master']       = $this->po->get_all_trx(array("tab1.id"=>$id),array("tab1.id","tab5.id"))->result();
        $data['tgl_indo']     = longdate_indo( date('Y-m-d') );
        $data['page_content'] = $this->load->view("pembelian/po/edit_purchase", $data ,true);

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
             $where = ($goods) ? $where." AND tab4.brand_description like '".$goods."%' or tab4.sku_code like '".$goods."%' or tab4.plu_code like '".$goods."%' or tab4.barcode like '".$goods."%'" : $where;
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
        $data = $this->po->get_all_trx(array("tab1.id"=>$id),array("tab1.id","tab5.id"))->result_array();  
        // echo json_encode($data);exit;   
        // $this->pdf->print_po(1,$data); 

        $this->pdf->dynamic_print(1, "po_in", $data);
    }


    function contoh ()
    {
        $id = 4;

        $index = 0;
        

        for ($i=0; $i <30 ; $i++) { 
            // $data[$index] = new \stdClass();
            // $data[$index] = array();
            // $data[$index]['partner_name'] = "PT ABCD";
            // $data[$index]['salesman_name'] =  $this->generateRandomString(20);
            // $data[$index]['purchase_order_no']     = '00000131202007000001';
            // $data[$index]['purchase_order_date']   = date('Y-m-d');
            // $data[$index]['reference_no']  = '00000125202007000012';
            // $data[$index]['goods_name']    = $this->generateRandomString(20);
            // $data[$index]['sku_code']      = $this->generateRandomString(5);
            // $data[$index]['plu_code']      = rand(000000,9999999);
            // $data[$index]['goods_price']         =  rand(1000, 155000);
            // $data[$index]['goods_qty']      =  rand(10, 2390); 

            $data[$index] = array();
            $data[$index]['partner_name'] = "PT ABCD";
            $data[$index]['salesman_name'] =  $this->generateRandomString(20);
            $data[$index]['receiving_no']     = '00000131202007000001';
            $data[$index]['created_date']   = date('Y-m-d');
            // $data[$index]['reference_no']  = '00000125202007000012';
            $data[$index]['goods_name']    = $this->generateRandomString(20);
            $data[$index]['sku_code']      = $this->generateRandomString(5);
            $data[$index]['plu_code']      = rand(1000, 155000);
            $data[$index]['price']         =  rand(1000, 155000);
            $data[$index]['receive_qty']      =  rand(10, 2390); 
            $data[$index]['discount']      =  rand(0,10); 


            $index+=1;
        }
       


        // echo json_encode($data);
        $this->pdf->dynamic_print(1,"receive_in",$data);
    }


    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }



}

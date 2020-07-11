<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventori extends CI_Controller
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
                "user_model" => "user_m",
                "M_partner_model"=>"partner",
                "M_warehouse_model"=>"m_ws",
                "M_goods_model"=>"goods", 
                "Purchase_order_model" => "po", 
                "Receiving_model" => "rm",
                "Receiving_detail_model" => "rdm",
                "S_history_model" => "history",
                "Warehouse_model" => "t_ws",
            )
        );
        $this->lang->load('menu_lang', 'indonesian');
    }

    public function index()
    {
        $data['back_url'] = base_url();
        $data['page_title'] = "Inventori";
        $data['page_content'] = $this->load->view("inventori/index", "", true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
    }


    // receiving
    public function receiving()
    {
         if (count($_POST)) {
            
            $id_user           = $this->session->userdata('id');
            $name              = $this->session->userdata('name');
            $branch_id         = $this->session->userdata('branch_id');
            $branch_name         = $this->session->userdata('branch_name');

            if (array_key_exists("id", $_POST)) {
                
                $where_id['id']= $_POST['id'];
                $entry_data    = array("branch_id" => $branch_id,
                                "receiving_no" => $_POST['purchase_receive_no'],
                                "reference_no" => $_POST['reference_no'],
                                "warehouse_id" => 1,
                                "description" => $_POST['description'],
                                "purchase_order_id" => $_POST['po_no_list'],
                                "created_by" => $id_user,
                                "updated_date" => date('Y-m-d H:i:s'),
                                "updated_by" => $id_user,
                                "flag" => 1);
                
                $this->rm->update($where_id, $entry_data);
                $where_id = array();
                $where_id['receiving_id']   = $_POST['id'];
                // delete all po detail
                $this->rdm->delete($where_id);

                // insert new all po detail
                $this->rdm->insert($_POST['id'],$_POST);

                // insert history/activity
                $history_data  = array("branch_id" => $branch_id,
                                "branch_name" => $branch_name,
                                "created_by" => $id_user,
                                "created_name" => $name,
                                "activity"  => "Memperbaharui Transaksi Penerimaan barang",
                                "created_date" => date('Y-m-d H:i:s'),
                               );

                $this->history->insert($history_data);

                 $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Penerimaan Barang berhasil diperbaharui</div>');

            } else {

                 $entry_data    = array("branch_id" => $branch_id,
                                "receiving_no" => $_POST['purchase_receive_no'],
                                "reference_no" => $_POST['reference_no'],
                                "warehouse_id" => 1,
                                "description" => $_POST['description'],
                                "purchase_order_id" => $_POST['po_no_list'],
                                "created_by" => $id_user,
                                "created_date" => date('Y-m-d H:i:s'),
                                "updated_date" => date('Y-m-d H:i:s'),
                                "updated_by" => $id_user,
                                "flag" => 1);
                // echo json_encode($_POST);exit;
                // insert receiving data
                $rv_id         = $this->rm->insert($entry_data)->row()->id;
                // insert new all receiving detail
                $this->rdm->insert($rv_id,$_POST);

                // insert hitory activity
                $history_data  = array("branch_id" => $branch_id,
                                "branch_name" => $branch_name,
                                "created_by" => $id_user,
                                "created_name" => $name,
                                "activity"  => "Membuat Transaksi Penerimaan Barang ",
                                "created_date" => date('Y-m-d H:i:s'),
                               );

                $this->history->insert($history_data);

                $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Penerimaan Barang berhasil disimpan</div>');

                redirect("inventori/add_receiving");
            }
        }

        $data['receive']      = $this->rm->get_all_receive()->result();  
        $data['page_title']   = "Receiving";
        $data['page_content'] = $this->load->view("inventori/receiving", $data, true);
        $data['master']       = null;

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
        $this->load->view("inventori/receiving/receiving_js");
    }


    public function add_receiving()
    {

        $data['page_title']   = "Tambah Receiving";
        $data['supplier']     = $this->get_partner(array("is_supplier"=>1));
        $data['po_no']        = generate_po_receive_no();
        $data['master']       = null;
        $data['warehouse']    = $this->m_ws->get("flag<>99")->result();
        $data['tgl_indo']     = longdate_indo( date('Y-m-d') );
        $data['page_content'] = $this->load->view("inventori/receiving/add_receiving", $data ,true);

        $this->load->view('layout/head');
        $this->load->view('layout/base_maxwidth', $data);
        $this->load->view('layout/js');
        $this->load->view("inventori/receiving/receiving_js");
    }


    public function edit_receiving($rv_id)
    {

        $data['page_title']   = "Edit Receiving";
        $data['supplier']     = $this->get_partner(array("is_supplier"=>1));
        $data['po_no']        = generate_po_receive_no();
        $data['master']       = $this->rm->get_all_receive("tab1.id=".$rv_id,"tab2.id")->result(); 
        $data['warehouse']    = $this->m_ws->get("flag<>99")->result();
        $data['tgl_indo']     = longdate_indo( date('Y-m-d') );
        $data['page_content'] = $this->load->view("inventori/receiving/edit_receiving", $data ,true);

        // echo json_encode($data['master']);exit;
        $this->load->view('layout/head');
        $this->load->view('layout/base_maxwidth', $data);
        $this->load->view('layout/js');
        $this->load->view("inventori/receiving/receiving_edit_js");
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
 
    public function get_po_list($type = 1)
    {

        if ( $type == 1 ) {
            $where              = "tab4.id=". $this->input->get('supplier_id');

            $data               = $this->rm->get_goods_receive($where)->result();

        } elseif ( $type == 2 ) {

            $where              = "tab1.id =".$this->input->get('po_id');
            $group              = "tab6.goods_id";
            $data               = $this->rm->get_goods_receive($where,$group)->result();

        } elseif ( $type == 3 ) {

           $where               = 'tab1.id='.$this->input->get('po_id').' and tab6.goods_id='.$this->input->get('goods_id');
           $group               = 'tab6.goods_id';
            
            $data                     = $this->rm->get_goods_receive($where,$group)->result();

        } 

        echo json_encode($data);
    }    

    public function approve_receive()
    {
        $data['id'] = $this->input->get("rv_id");

        $msg   = $this->rm->approve_receive($data);

        echo json_encode($msg);
    }


    public function print_receive($id)
    {
        
        $data = $this->rm->get_all_receive("tab1.id=".$id,"tab3.id")->result(); 
        
        $this->pdf->print_receive(1,$data); 
    }


    // gudang

    public function gudang()
    {

         if ( count($_POST) ) {

            $id_user           = $this->session->userdata('id');
            $name              = $this->session->userdata('name');
            $branch_id         = $this->session->userdata('branch_id');
            $branch_name         = $this->session->userdata('branch_name');

            if (array_key_exists("id", $_POST) ) {
                $id = $_POST['id'];
                $ws = array(
                            "branch_id" => $this->session->userdata('branch_id'),
                            "reference_no" => $_POST['ref_no'],
                            "physical_warehouse_no" => $_POST['trans_no'],
                            "previous_warehouse" => $_POST['prev_ws'],
                            "actual_warehouse" => $_POST['act_ws'],
                            "updated_by" => $this->session->userdata('id'),
                            "updated_date" => date('Y-m-d H:i:s'),
                            );
                // echo json_encode($_POST);exit;
                // update t_pyhsical_warehouse
                $ws_id  = $this->t_ws->update($id,$ws)->row()->id;
                // delete warehouse detail
                $this->t_ws->delete_detail($ws_id);
                // insert warehouse detail
                $this->t_ws->insert_detail($ws_id, $_POST);

                 // insert hitory activity
                $history_data  = array("branch_id" => $branch_id,
                                "branch_name" => $branch_name,
                                "created_by" => $id_user,
                                "created_name" => $name,
                                "activity"  => "Memperbaharui Transaksi Pemindahan Barang di Gudang",
                                "created_date" => date('Y-m-d H:i:s'),
                               );

                $this->history->insert($history_data);

                 $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Data Barang berhasil diperbaharui</div>');


            } else {

                $ws = array(
                            "branch_id" => $this->session->userdata('branch_id'),
                            "reference_no" => $_POST['ref_no'],
                            "physical_warehouse_no" => $_POST['trans_no'],
                            "previous_warehouse" => $_POST['prev_ws'],
                            "actual_warehouse" => $_POST['act_ws'],
                            "updated_by" => $this->session->userdata('id'),
                            "updated_date" => date('Y-m-d H:i:s'),
                            "created_by" => $this->session->userdata('id'),
                            "created_date" => date('Y-m-d H:i:s'),
                            "flag" => 1,
                            );

                // insert t_physical_warehouse
                $ws_id  = $this->t_ws->insert($ws)->row()->id;
                // insert t_physical_warehouse_detail
                $ws_detail = $this->t_ws->insert_detail($ws_id, $_POST);

                // insert hitory activity
                $history_data  = array("branch_id" => $branch_id,
                                "branch_name" => $branch_name,
                                "created_by" => $id_user,
                                "created_name" => $name,
                                "activity"  => "Membuat Transaksi Pemindahan Barang di Gudang",
                                "created_date" => date('Y-m-d H:i:s'),
                               );

                $this->history->insert($history_data);

                $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Data Barang berhasil disimpan</div>');

                redirect('inventori/add_warehouse');
            }
        }

        $data['warehouse']  = $this->t_ws->get_all()->result();
        $data['page_title'] = "Gudang";
        $data['page_content'] = $this->load->view("inventori/gudang", $data, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
        $this->load->view('inventori/warehouse/warehouse_js');
    }


    public function add_warehouse() 
    {
       
        $data['page_title'] = "Add New Warehouse";
        $data['prev_ws']    = $this->m_ws->get_all()->result();
        $data['act_ws']     = $this->m_ws->get("id<>1")->result();
        $data['ws_no']      = generate_ws_no();
        $data['tgl_indo']     = longdate_indo( date('Y-m-d') );
        $data['page_content'] = $this->load->view("inventori/warehouse/add_warehouse", $data, true);

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
        $this->load->view('inventori/warehouse/warehouse_js');
    }


    public function get_goods()
    {
        $branch_id = $this->session->userdata('branch_id');
        $search = trim( $this->input->get('kode_barang') );
        
        $where  = "tab4.brand_description='" . $search . "' or tab4.sku_code='" . $search . "' or tab4.plu_code='" . $search . "' and tab5.id=".$branch_id;
        $data   = $this->goods->get_goods_per_supplier($where)->result();

        echo json_encode($data);

    }

    public function approve_warehouse()
    {
        $id = $this->input->get("ws_id");
        $set['flag']= 2;

        $msg   = $this->t_ws->update($id,$set);

        echo json_encode($msg);
    }

    public function get_ws_goods()
    {
        $receiving_no = $this->input->get('receive_no'); 

        $data       = $this->rm->get_all_receive("tab1.receiving_no=".$receiving_no,"tab2.goods_id")->result();

        echo json_encode($data);
    }

     public function get_ws_goods_detail()
    {
        $receiving_no   = $this->input->get('receive_no');
        $goods_id       = $this->input->get('goods_id');

        $data       = $this->rm->get_all_receive("tab1.receiving_no=".$receiving_no." and tab2.goods_id=".$goods_id)->result();

        echo json_encode($data);
    }

    public function print_warehouse($id)
    {
        
        $data = $this->t_ws->get_all(array("tab1.id"=>$id),array("tab2.id"))->result(); 
        
        $this->pdf->print_warehouse(1,$data); 
    }

    public function edit_warehouse($ws_id) 
    {
       
        $data['page_title']     = "Add New Warehouse";
        $data['prev_ws']        = $this->m_ws->get_all()->result();
        $data['act_ws']         = $this->m_ws->get("id<>1")->result();
        $data['ws_no']          =  generate_ws_no();
        $data['warehouse']      = $this->t_ws->get_all(array("tab1.id"=>$ws_id), array("tab2.id"))->result();
        $data['tgl_indo']       = longdate_indo( date('Y-m-d') );
        $data['page_content']   = $this->load->view("inventori/warehouse/edit_warehouse", $data, true);
        
        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js');
        $this->load->view('inventori/warehouse/warehouse_js');
    }




    // report

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

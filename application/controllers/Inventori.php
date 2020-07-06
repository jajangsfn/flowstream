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
                "M_warehouse_model"=>"warehouse",
                "Purchase_order_model" => "po",
                "Receiving_model" => "rm",
                "Receiving_detail_model" => "rdm",
                "S_history_model" => "history",
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
                                "warehouse_id" => $_POST['ws'],
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
                                "warehouse_id" => $_POST['ws'],
                                "description" => $_POST['description'],
                                "purchase_order_id" => $_POST['po_no_list'],
                                "created_by" => $id_user,
                                "created_date" => date('Y-m-d H:i:s'),
                                "updated_date" => date('Y-m-d H:i:s'),
                                "updated_by" => $id_user,
                                "flag" => 1);
                 
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
        $data['warehouse']    = $this->warehouse->get("flag<>99")->result();
        
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
        $data['master']       = $this->rm->get_all_receive(array("tab1.id"=>$rv_id),array("tab2.id"))->result(); 
        $data['warehouse']    = $this->warehouse->get("flag<>99")->result();
        $data['page_content'] = $this->load->view("inventori/receiving/edit_receiving", $data ,true);

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
            $where['tab4.id']   = $this->input->get('supplier_id');
            $where['tab1.flag'] = 2;
            $group              = array("tab1.id");
            $data               = $this->po->get_all_trx($where,$group)->result();
        } elseif ( $type == 2 ) {

            $where['tab1.id']   = $this->input->get('po_id');
            $group              = array("tab5.id");
            $data               = $this->po->get_all_trx($where,$group)->result();

        } elseif ( $type == 3 ) {

            $pod_id             = $this->input->get('po_detail_id');
            $data               = $this->rm->get_goods_receive($pod_id)->result();
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
        
        $data = $this->rm->get_all_receive(array("tab1.id"=>$id),array("tab2.id"))->result(); 
        
        $this->pdf->print_receive(1,$data); 
    }


    // gudang

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

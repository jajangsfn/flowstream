<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventori extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login') == null) {
            redirect(
                base_url()
            );
        }

        $this->load->model(array(
            "S_history_model" => "history",
            "Receiving_detail_model" => "rdm",
            "Purchase_order_model" => "po",
            "Purchase_order_detail_model" => "pod",
            "S_reference_model" => "ref",
            "Receiving_model" => "rm",
        ));
    }

    public function save_direct_receiving()
    {
        $id_user           = $this->session->userdata('id');
        $name              = $this->session->userdata('name');
        // echo json_encode($_POST);exit;
        $entry_data   = array(
            "branch_id" => $_POST['branch_id'],
            "salesman_id" => $_POST['salesman'],
            "purchase_order_no" => $_POST['purchase_order_no'],
            "reference_no" => $_POST['reference_no'],
            "description" => $_POST['description'],
            "purchase_order_date" => $_POST['tgl_po'],
            "purchase_total" => $_POST['receiving_total'],
            "purchase_discount" => $_POST['disc'],
            "created_by" => $id_user,
            "created_date" => date('Y-m-d H:i:s'),
            "updated_date" => date('Y-m-d H:i:s'),
            "updated_by" => $id_user,
            "flag" => 1
        );

        // insert po 
        $po_id        = $this->po->insert($entry_data)->row()->id;

        // insert detail po
        $this->pod->insert($po_id, $_POST);

        // insert hitory activity
        $history_data  = array(
            "branch_id" => $_POST['branch_id'],
            "branch_name" => $_POST['branch_name'],
            "created_by" => $id_user,
            "created_name" => $name,
            "activity"  => "Membuat Transaksi Pembelian Ke " . $_POST['partner_name'],
            "created_date" => date('Y-m-d H:i:s'),
        );

        $this->history->insert($history_data);

        // auto approve po
        $this->po->approve_po(
            array(
                "id" => $po_id
            )
        );

        // auto receive all
        $id_user           = $this->session->userdata('id');
        $name              = $this->session->userdata('name');
        $branch_id         = $this->session->userdata('branch_id');
        $branch_name       = $this->session->userdata('branch_name');

        // set price method
        // generate $_POST baru untuk receiving
        $receiving_data = array(
            "supplier_id_temp" => $_POST['supplier'],
            "po_id_temp" => $po_id,
            "supplier" => $_POST['supplier'],
            "purchase_receive_no" => $_POST['purchase_order_no'],
            "po_no_list" => $po_id,
            "tgl_receive" => $_POST['receive_date'],
            "receiving_total" => $_POST['receiving_total'],
            "receiving_discount" => $_POST['disc'],
            "description" => $_POST['description'],
            "reference_no" => $_POST['reference_no'],
            "price_method" => $this->ref->get_type_price("flag = 1")->row()->id
        );

        // get seluruh purchase order detail terkait PO ini
        $pos_details = $this->db->get_where(
            "t_purchase_order_detail",
            array(
                "purchase_order_id" => $po_id
            )
        )->result_array();

        $goods_id = array();
        $goods_discount = array();
        $goods_qty = array();
        $goods_price = array();
        $goods_carton = array();
        $po_detail_id = array();
        for ($i = 0; $i < count($pos_details); $i++) {
            array_push($goods_id, $pos_details[$i]['goods_id']);
            array_push($goods_discount, $pos_details[$i]['discount']);
            array_push($goods_qty, $pos_details[$i]['quantity']);
            array_push($goods_price, $pos_details[$i]['price']);
            array_push($goods_carton, $pos_details[$i]['cartons']);
            array_push($po_detail_id, $pos_details[$i]['id']);
        }
        $receiving_data['goods_id'] = $goods_id;
        $receiving_data['goods_discount'] = $goods_discount;
        $receiving_data['goods_qty'] = $goods_qty;
        $receiving_data['goods_price'] = $goods_price;
        $receiving_data['goods_carton'] = $goods_carton;
        $receiving_data['po_detail_id'] = $po_detail_id;

        //get active price method
        $price_method  = $this->ref->get_type_price("flag = 1")->row()->id;

        $entry_data    = array(
            "branch_id" => $branch_id,
            "receiving_no" => $receiving_data['purchase_receive_no'],
            "reference_no" => $receiving_data['reference_no'],
            "warehouse_id" => 1,
            "description" => $receiving_data['description'],
            "purchase_order_id" => $receiving_data['po_no_list'],
            "receiving_total" => $receiving_data['receiving_total'],
            "receiving_discount" => $receiving_data['receiving_discount'],
            "created_by" => $id_user,
            "created_date" => date('Y-m-d H:i:s'),
            "updated_date" => date('Y-m-d H:i:s'),
            "updated_by" => $id_user,
            "price_method_id" => $price_method,
            "flag" => 1
        );

        // insert receiving data 
        $rv_id         = $this->rm->insert($entry_data)->row()->id;

        // get new price based on price method
        for ($i = 0; $i < count($receiving_data['goods_id']); $i++) {
            $param_price_method = array(
                "reference_no" => $receiving_data['purchase_receive_no'],
                "price_method" => $receiving_data['price_method'],
                "goods_id" => $receiving_data['goods_id'][$i],
                "quantity" => $receiving_data['goods_qty'][$i],
                "price" => $receiving_data['goods_price'][$i],
                "discount" => $receiving_data['goods_discount'][$i],
            );
            $receiving_data['goods_price'][$i] = $this->rdm->price_method($param_price_method);
        } 
        $this->rdm->insert($rv_id, $receiving_data);

        // insert hitory activity
        $history_data  = array(
            "branch_id" => $branch_id,
            "branch_name" => $branch_name,
            "created_by" => $id_user,
            "created_name" => $name,
            "activity"  => "Membuat Transaksi Penerimaan Barang",
            "created_date" => date('Y-m-d H:i:s'),
        );

        $this->history->insert($history_data);

        $this->session->set_flashdata("success", "Direct receiving berhasil disimpan");
        redirect(base_url("/index.php/inventori/receiving"));
    }
}

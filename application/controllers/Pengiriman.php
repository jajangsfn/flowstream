<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengiriman extends CI_Controller{
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
                "T_delivery_model" => "delivery",
            )
        );

        $this->lang->load('menu_lang', 'indonesian');
    }

    public function index() {

        $data['page_title']   = "Daftar Pengiriman";
        $data['delivery_data']= $this->delivery->get_delivery()->result();
        $data['page_content'] = $this->load->view("pengiriman/index", $data, true);
        $data['master']       = array();

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js'); 
        $this->load->view('pengiriman/js'); 
    }

    public function add_delivery($id = null) {
        
        $data['back_url']     = base_url('index.php/pengiriman');
        $data['page_title']   = is_null($id) ? "Tambah Pengiriman" : "Edit Pengiriman";
        $data['tgl_indo']     = longdate_indo( date('Y-m-d') );
        $data['delivery_no']  = generate_po_no(6); 
        $data['po_no_list']   = is_null($id) ? $this->delivery->get_po_no()->result() : $this->delivery->get_po_no(null,1)->result();
        $data['employee_data']= $this->delivery->get_employee()->result();
        $data['id']           = $id;
        $data['delivery_data']= is_null($id) ? null : $this->get_delivery_data($id);
        $data['page_content'] = $this->load->view("pengiriman/add_delivery", $data, true);
        $data['master']       = array();

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js'); 
        $this->load->view('pengiriman/js'); 
    }

    public function get_po_no() {
        $po_no = !empty($this->input->post('po_no')) ? trim($this->input->post('po_no')) : null;
        echo json_encode($this->delivery->get_po_no($po_no)->result());
    }

    public function save_delivery() {

        $post       = $this->input->post();echo json_encode($post);exit;
        $branch_id  = ($this->session->userdata('branch_id')!="") ? $this->session->userdata('branch_id') : 1;
        $user_id    = $this->session->userdata('id');
        if (empty($post['id'])) {
            // insert t_delivery order
            $delivery_order  = array(
                                    "branch_id" => $branch_id,
                                    "delivery_no" => trim($post['delivery_no']),
                                    "description" => $post['description'],
                                    "delivery_date"=> $post['delivery_date'], 
                                    "car_number" => $post['car_number'],
                                    "created_date"=> date('Y-m-d H:i:s'),
                                    "updated_date"=> date('Y-m-d H:i:s'),
                                    "created_by" => $user_id,
                                    "flag" =>1
                                );
            $delivery_order_id = $this->delivery->insert_delivery("t_delivery_order", $delivery_order, true);

            // insert t_delivery_order_detail
            if (count($post['good_id']) > 0) {

                foreach($post['good_id'] as $key => $row) {
                    $delivery_detail = array(
                                            "delivery_order_id" => $delivery_order_id,
                                            "goods_id"=>$row,
                                            "created_date"=> date('Y-m-d H:i:s'),
                                            "updated_date"=> date('Y-m-d H:i:s'),
                                            "qty"=> $post['qty'][$key],
                                            "flag"=>1);
                    $this->delivery->insert_delivery("t_delivery_order_detail", $delivery_detail);
                }
            }

            // insert t_delivery_package
            if (count($post['biaya']) > 0) {
                foreach($post['biaya'] as $key => $row){
                    $delivery_package = array(
                                            "delivery_order_id" => $delivery_order_id,
                                            "invoice_no" => trim($post['po_no_list']),
                                            "address" => $post['customer_address'],
                                            "description" => $row,
                                            "charge" => $post['jumlah'][$key],
                                        );
                    $this->delivery->insert_delivery("t_delivery_package", $delivery_package);
                }
            }
            // insert t_delivery_team
            if (count($post['id_pegawai']) > 0) {
                foreach($post['id_pegawai'] as $key => $row){
                    $delivery_team = array(
                                            "delivery_order_id" => $delivery_order_id,
                                            "employee_id" => $row,
                                            "job_description" => $post['tugas_pegawai'][$key],
                                        );
                    $this->delivery->insert_delivery("t_delivery_team", $delivery_team);
                }
            }


        }else {
            
            $data = $this->delivery->get_delivery(array("order.id" =>$post['id']))->result();
            
            // update t_delivery order
            $delivery_order  = array(
                    "branch_id" => $branch_id,
                    "delivery_no" => trim($post['delivery_no']),
                    "description" => $post['description'],
                    "delivery_date"=> date('Y-m-d', strtotime($post['delivery_date'])), 
                    "car_number" => $post['car_number'],
                    "updated_date"=> date('Y-m-d H:i:s'),
                    "updated_by" => $user_id,
                    "flag" =>1
            );

            $delivery_order_id = $this->delivery->update_delivery("t_delivery_order", $delivery_order, array("id"=> $data[0]->delivery_order_id));
            //update t delivery order detail
            if (count($post['good_id']) > 0) {
                // delete data
                $this->delivery->delete_delivery("t_delivery_order_detail", array("delivery_order_id" => $data[0]->delivery_order_id));
                echo json_encode($post['goods_id']);exit;
                //insert t delivery order detail
                foreach($post['good_id'] as $key => $row) {
                    $delivery_detail = array(
                                        "delivery_order_id" => $data[0]->delivery_order_id,
                                        "goods_id"=>$row,
                                        "created_date"=> date('Y-m-d H:i:s'),
                                        "updated_date"=> date('Y-m-d H:i:s'),
                                        "qty"=> $post['qty'][$key],
                                        "flag"=>1);
                    $this->delivery->insert_delivery("t_delivery_order_detail", $delivery_detail);
                }
            }

            // update t_delivery_package
            if (count($post['biaya']) > 0) {
                //delete all delivery package
                $this->delivery->delete_delivery("t_delivery_package", array("delivery_order_id" => $data[0]->delivery_order_id));
                //insert into t_delivery_package
                foreach($post['biaya'] as $key => $row){
                    $delivery_package = array(
                        "delivery_order_id" => $data[0]->delivery_order_id,
                        "invoice_no" => trim($data[0]->invoice_no),
                        "address" => $post['customer_address'],
                        "description" => $row,
                        "charge" => $post['jumlah'][$key],
                    );
                    $this->delivery->insert_delivery("t_delivery_package", $delivery_package);
                }
            }

            // update t_delivery_team
            if (count($post['id_pegawai']) > 0) {
                //delete all delivery team
                $this->delivery->delete_delivery("t_delivery_team", array("delivery_order_id" => $data[0]->delivery_order_id));
                //insert all delivery team
                foreach($post['id_pegawai'] as $key => $row){
                    $delivery_team = array(
                                "delivery_order_id" => $data[0]->delivery_order_id,
                                "employee_id" => $row,
                                "job_description" => $post['tugas_pegawai'][$key],
                                );
                    $this->delivery->insert_delivery("t_delivery_team", $delivery_team);
                }
            }
        }    

        $msg =  empty($post['id']) ? "disimpan" : "diubah";
        $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Pengiriman berhasil '.$msg.'</div>');
        redirect("pengiriman/");

    }

    public function detail_delivery($id) {

        $data['back_url']     = base_url('index.php/pengiriman');
        $data['page_title']   = "Detail Pengiriman";
        $data['delivery_data']= $this->get_delivery_data($id);
        $data['page_content'] = $this->load->view("pengiriman/detail_delivery", $data, true);
        $data['master']       = array();

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js'); 
        $this->load->view('pengiriman/js');
    }

    public function get_delivery_data($id) {
        $data     = $this->delivery->get_delivery(array("order.id"=>$id))->result();
        $detail   = array();
        $goods    = array();
        $pack     = array();
        $employee = array();

        foreach($data as $key => $row) {
            $detail[] = $row;

            $goods[$row->detail_id]['id']                   = $row->detail_id;
            $goods[$row->detail_id]['invoice_no']           = $row->invoice_no;
            $goods[$row->detail_id]['plu_code']             = $row->plu_code;
            $goods[$row->detail_id]['sku_code']             = $row->sku_code;
            $goods[$row->detail_id]['barcode']              = $row->barcode;
            $goods[$row->detail_id]['goods_id']             = $row->goods_id;
            $goods[$row->detail_id]['brand_description']    = $row->brand_description;
            $goods[$row->detail_id]['qty']                  = $row->qty;

            $pack[$row->id]['package_id']   = $row->id;
            $pack[$row->id]['invoice_no']   = $row->invoice_no;
            $pack[$row->id]['address']      = $row->address;
            $pack[$row->id]['description']  = $row->description;
            $pack[$row->id]['charge']       = $row->charge;


            $employee[$row->delivery_team_id]['team_id']        = $row->delivery_team_id;
            $employee[$row->delivery_team_id]['employee_id']    = $row->employee_id;
            $employee[$row->delivery_team_id]['employee_name']  = $row->employee_name;
            $employee[$row->delivery_team_id]['job_description']= $row->job_description;
        }
        
        return array("detail"=> $detail,"goods"=>$goods,"biaya" => $pack, "pegawai"=>$employee);
        
    }

    public function get_delivery_detail() {
        $id   = $this->input->post('id');
        $data = $this->get_delivery_data($id);
        echo json_encode($data);
    }

    public function update_delivery_status() {
        $post = $this->input->post();

        $update_delivery = array(
                                "receive_date" => $post['receive_date'],
                                "receive_name" => $post['receive_name'],
                                "receive_status" => $post['status'],
                                "notes" => $post['notes']
                            );
        $this->delivery->update_delivery("t_delivery_package", $update_delivery, array("delivery_order_id" => $post['id']));
        $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Status Pengiriman berhasil diperbaharui</div>');
        redirect("pengiriman/");
    }


    public function print_delivery($id) {
        $delivery_data = $this->get_delivery_data($id);
        $data          = array();
        $i = 0;
        foreach($delivery_data['goods'] as $key => $row){
            $data[$i]['brand_description'] = $row['brand_description'];
            $data[$i]['qty'] = $row['qty'];
            $data[$i]['plu_code'] = $row['plu_code'];
            $data[$i]['sku_code'] = $row['sku_code'];
            $data[$i]['barcode'] = $row['barcode'];

            $data[$i]['invoice_no'] = $row['invoice_no'];
            $data[$i]['delivery_no'] = $delivery_data['detail'][0]->delivery_no;
            $data[$i]['delivery_date'] = $delivery_data['detail'][0]->delivery_date;
            $data[$i]['receive_name'] = $delivery_data['detail'][0]->receive_name;
            $data[$i]['receive_date'] = $delivery_data['detail'][0]->receive_date;
            $data[$i]['name'] = $delivery_data['detail'][0]->name;
            $data[$i]['address_partner'] = $delivery_data['detail'][0]->address;
            $data[$i]['car_number'] = $delivery_data['detail'][0]->car_number;
            $data[$i]['description'] = $delivery_data['detail'][0]->order_desc;

            $i++;
        }
        // echo json_encode($data);exit;
        $this->pdf->dynamic_print(3, "delivery", $data);
    }
}

?>

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
        $data['delivery_data']= is_null($id) ? null : $this->delivery->get_delivery(array("pack.id"=>$id))->result();
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
        $post       = $this->input->post();
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
            $delivery_package = array(
                                        "delivery_order_id" => $delivery_order_id,
                                        "invoice_no" => trim($post['po_no_list']),
                                        "address" => $post['customer_address'],
                                        "description" => $post['description'],
                                        "charge" => $post['charged'],

                                    );
            $this->delivery->insert_delivery("t_delivery_package", $delivery_package);
            // insert t_delivery_team
            $delivery_team = array(
                                    "delivery_order_id" => $delivery_order_id,
                                    "employee_id" => $post['employee_id'],
                                    "description" => $post['description'],
                                );
            $this->delivery->insert_delivery("t_delivery_team", $delivery_team);
        }else {
            
            $data = $this->delivery->get_delivery(array("pack.id" =>$post['id']))->result();
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

            // delete all data t_delivery_order_detail and
            // insert t_delivery_order_detail
            if (count($post['good_id']) > 0) {
                // delete data
                $this->delivery->delete_delivery("t_delivery_order_detail", array("delivery_order_id" => $data[0]->delivery_order_id));
                
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
                $delivery_package = array(
                                "delivery_order_id" => $data[0]->delivery_order_id,
                                "invoice_no" => trim($post['po_no_list']),
                                "address" => $post['customer_address'],
                                "description" => $post['description'],
                                "charge" => $post['charged'],

                            );
                $this->delivery->update_delivery("t_delivery_package", $delivery_package, array("id"=>$data[0]->id));

                // update t_delivery_team
                $delivery_team = array(
                            "delivery_order_id" => $data[0]->delivery_order_id,
                            "employee_id" => $post['employee_id'],
                            "description" => $post['description'],
                        );
                $this->delivery->update_delivery("t_delivery_team", $delivery_team, array("id"=>$data[0]->delivery_team_id));
        }    

        $msg =  empty($post['id']) ? "disimpan" : "diubah";
        $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Pengiriman berhasil '.$msg.'</div>');
        empty($post['id']) ? redirect("pengiriman/add_delivery") : redirect("pengiriman/");
    }

    public function detail_delivery($id) {

        $data['back_url']     = base_url('index.php/pengiriman');
        $data['page_title']   = "Detail Pengiriman";
        $data['delivery_data']= $this->delivery->get_delivery(array("order.id" => $id))->result();
        $data['page_content'] = $this->load->view("pengiriman/detail_delivery", $data, true);
        $data['master']       = array();

        $this->load->view('layout/head');
        $this->load->view('layout/base', $data);
        $this->load->view('layout/js'); 
        $this->load->view('pengiriman/js');
    }

    public function get_delivery_detail() {
        $id   = $this->input->post('id');
        $data = $this->delivery->get_delivery(array("pack.id" => $id))->result();
        echo json_encode($data);
    }

    public function update_delivery_status() {
        $post = $this->input->post();

        echo json_encode($post);

        $update_delivery = array(
                                "receive_date" => $post['receive_date'],
                                "receive_name" => $post['receive_name'],
                                "receive_status" => $post['status'],
                                "notes" => $post['notes']
                            );
        $this->delivery->update_delivery("t_delivery_package", $update_delivery, array("id" => $post['id']));
        $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Status Pengiriman berhasil diperbaharui</div>');
        redirect("pengiriman/");
    }


    public function print_delivery($id) {
        $data = $this->delivery->get_delivery(array("pack.id" => $id))->result_array();
        
        $this->pdf->dynamic_print(3, "delivery", $data);
        // echo json_encode($data);exit;
    }
}

?>
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Goods extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
        $this->load->model(
            array(
                "user_model" => "user_m",
                "M_account_code_model" => "account",
                "m_partner_model" => "partner",
                "m_partner_type_model" => "partner_type",
                "m_partner_salesman_model" => "part_salesman",
                "m_user_salesman_model" => "usr_salesman",
                "m_salesman_map_model" => "salesman_map",
                "m_map_model" => "m_map",
                "m_unit_model" => "unit",
                "m_goods_model" => "goods",
                "m_branch_model" => "branch",
                "m_warehouse_model" => "warehouse",
                "m_employee_model" => "employee",
                "m_journal_mapping_model" => "jurnal_mapping",
                "s_reference_model" => "reference",
                "t_order_request_model" => "or",
                "t_pos_model" => "pos",
                "T_jurnal_model" => "jurnal",
                "Keuangan_model" => "keumod"
            )
        );
    }

    public function get_barang($id)
    {
        $where['m_goods.id'] = $id;

        $data_query = $this->goods->get($where)->row();
        $data['data'] = $data_query;
        echo json_encode($data);
    }

    public function barang($id = '')
    {
        if ($id) {
            $data_query = $this->goods->get(array("m_goods.id" => $id))->result();
        } else {
            $data_query = $this->goods->get_complete()->result();
        }
        $data['data'] = $data_query;
        echo json_encode($data);
    }

    public function barang_cabang_data_only($id_cabang)
    {
        $where = array("m_goods.branch_id" => $id_cabang);
        if (count($_GET)) {
            if (isset($_GET['brand']) && $_GET['brand'] != "all") {
                $where['brand_name'] = $_GET['brand'];
            }

            if (isset($_GET['with_stock']) && $_GET['with_stock'] == "on") {
                $where['m_goods.quantity >'] = 0;
            }
        }
        $data_query = $this->goods->get_data()->result();
        $data['data'] = $data_query;
        echo json_encode($data);
    }

    public function barang_cabang_harga_only($id_cabang)
    {
        $data_query = $this->goods->get_harga(array("m_goods.branch_id" => $id_cabang))->result();
        $data['data'] = $data_query;
        echo json_encode($data);
    }

    public function barang_cabang_diskon_only($id_cabang)
    {
        $data_query = $this->goods->get_diskon(array("m_goods.branch_id" => $id_cabang))->result();
        $data['data'] = $data_query;
        echo json_encode($data);
    }

    public function barang_for_customer()
    {
        echo json_encode(
            array(
                "data" => $this->goods->get_simple($_POST['branch_id'])->result()
            )
        );
    }

    public function add_barang()
    {
        $entry_data = array(
            "branch_id" => $_POST['branch_id'],
            "brand_name" => $_POST['brand_name'],
            "brand_description" => $_POST['brand_description'],
            "sku_code" => $_POST['sku_code'],
            "plu_code" => $_POST['plu_code'],
            "tax" => $_POST['tax'],
            "quantity" => $_POST['quantity'],
            "rekening_no" => $_POST['rekening_no'],
            "division" => $_POST['division'],
            "sub_division" => $_POST['sub_division'],
            "category" => $_POST['category'],
            "sub_category" => $_POST['sub_category'],
            "package" => $_POST['package'],
            "color" => $_POST['color'],
            "unit" => $_POST['unit'],
            "ratio_flag" => $_POST['ratio_flag']
        );
        if (isset($_POST['barcode']) && $_POST['barcode']) {
            $entry_data['barcode'] = $_POST['barcode'];
        }
        $this->goods->insert($entry_data);
        $this->session->set_flashdata("success", "Barang berhasil tersimpan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit_barang()
    {
        $where_id['id'] = $_POST['id'];
        $entry_data = array(
            "brand_name" => $_POST['brand_name'],
            "brand_description" => $_POST['brand_description'],
            "barcode" => isset($_POST['barcode']) ? $_POST['barcode'] : null,
            "sku_code" => $_POST['sku_code'],
            "plu_code" => isset($_POST['plu_code']) ? $_POST['plu_code'] : null,
            "tax" => $_POST['tax'],
            "quantity" => $_POST['quantity'],
            "rekening_no" => $_POST['rekening_no'],
            "division" => $_POST['division'],
            "sub_division" => $_POST['sub_division'],
            "category" => $_POST['category'],
            "sub_category" => $_POST['sub_category'],
            "package" => $_POST['package'],
            "color" => $_POST['color'],
            "unit" => $_POST['unit'],
            "ratio_flag" => $_POST['ratio_flag']
        );
        $this->goods->update($where_id, $entry_data);
        if (stripos($_SERVER['HTTP_REFERER'], base_url()) >= 0) {
            $this->session->set_flashdata("success", "Barang berhasil diubah");
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            echo json_encode(
                array(
                    "message" => "Barang berhasil diubah"
                )
            );
        }
    }

    public function delete_barang()
    {
        $where_id['id'] = $_POST['id'];
        $this->goods->delete($where_id);
        $this->session->set_flashdata("success", "Barang berhasil dihapus");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function ubah_harga_barang()
    {
        if ($_POST['price_index'] == 0) {
            echo json_encode(array("message" => "masuk 0"));

            $this->goods->change_main_price(
                array(
                    "goods_id" => $_POST['id']
                ),
                array(
                    "price" => $_POST['price'],
                )
            );
        } else {
            echo json_encode(array("message" => "masuk lain"));
            $price_id = $this->goods->get_price(array(
                "goods_id" => $_POST['id']
            ))->row()->id;
            $this->goods->change_price_alternate(
                array(
                    "price_id" => $price_id,
                    "price_index" => $_POST['price_index'],
                ),
                array(
                    "price" => $_POST['price'],
                )
            );
        }
    }

    public function ubah_diskon_barang()
    {
        if ($_POST['price_index'] == 0) {
            $this->goods->change_main_price(
                array(
                    "goods_id" => $_POST['id']
                ),
                array(
                    "discount" => $_POST['discount'],
                )
            );
        } else {
            $price_id = $this->goods->get_price(array(
                "goods_id" => $_POST['id']
            ))->row()->id;
            $this->goods->change_price_alternate(
                array(
                    "price_id" => $price_id,
                    "price_index" => $_POST['price_index'],
                ),
                array(
                    "discount_percent" => $_POST['discount'],
                )
            );
        }
        echo json_encode(array(
            "message" => "success"
        ));
    }
}

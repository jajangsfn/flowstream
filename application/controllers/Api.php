<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
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

    public function index()
    {
        echo json_encode($this->session->userdata);
    }

    // Suppliers
    public function supplier()
    {
        $data_query = $this->partner->get_supplier()->result();
        $data['data'] = $data_query;
        echo json_encode($data);
    }

    public function supplier_branch($id_branch)
    {
        $data_query = $this->partner->get_supplier_where(array("p.branch_id" => $id_branch))->result();
        $data['data'] = $data_query;
        echo json_encode($data);
    }

    public function add_supplier()
    {
        $entry_data = array(
            "master_code" => $_POST['master_code'],
            "branch_id" => $_POST['branch_id'],
            "partner_code" => $_POST['partner_code'],
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "address_1" => $_POST['address_1'],
            "address_2" => $_POST['address_2'],
            "city" => $_POST['city'],
            "province" => $_POST['province'],
            "zip_code" => $_POST['zip_code'],
            "phone" => $_POST['phone'],
            "fax" => $_POST['fax'],
            "tax_number" => $_POST['tax_number'],
            "tax_address" => $_POST['tax_address'],
            "is_customer" => 0,
            "is_supplier" => 1
        );

        // tambahkan entry supplier
        $newsupp = $this->partner->insert($entry_data);

        // buat salesman general nya
        $this->part_salesman->register_general($newsupp->row()->id);

        // done
        $this->session->set_flashdata("success", "Supplier berhasil tersimpan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit_supplier()
    {
        $where_id['id'] = $_POST['id'];

        $entry_data = array(
            "master_code" => $_POST['master_code'],
            "partner_code" => $_POST['partner_code'],
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "address_1" => $_POST['address_1'],
            "address_2" => $_POST['address_2'],
            "city" => $_POST['city'],
            "province" => $_POST['province'],
            "zip_code" => $_POST['zip_code'],
            "phone" => $_POST['phone'],
            "fax" => $_POST['fax'],
            "tax_number" => $_POST['tax_number'],
            "tax_address" => $_POST['tax_address'],
        );

        $this->partner->update($where_id, $entry_data);
        $this->session->set_flashdata("success", "Supplier berhasil diperbarui");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_supplier()
    {
        $where_id['id'] = $_POST['id'];

        $this->partner->delete($where_id);
        $this->session->set_flashdata("success", "Supplier telah terhapus");
        redirect($_SERVER['HTTP_REFERER']);
    }

    // Customers
    public function customer()
    {
        $data_query = $this->partner->get_customer()->result();
        $data['data'] = $data_query;
        echo json_encode($data);
    }

    public function customer_branch($id_branch)
    {
        $data_query = $this->partner->get_customer_where(array("p.branch_id" => $id_branch))->result();
        $data['data'] = $data_query;
        echo json_encode($data);
    }

    public function get_customer($id)
    {
        $data_query = $this->partner->get_customer_where(array("p.id" => $id))->row();
        $data['data'] = $data_query;
        echo json_encode($data);
    }

    public function add_customer()
    {
        $entry_data = array(
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "partner_code" => $_POST['partner_code'],
            "master_code" => $_POST['master_code'],
            "branch_id" => $_POST['branch_id'],
            "address_1" => $_POST['address_1'],
            "address_2" => $_POST['address_2'],
            "city" => $_POST['city'],
            "province" => $_POST['province'],
            "zip_code" => $_POST['zip_code'],
            "phone" => $_POST['phone'],
            "fax" => $_POST['fax'],
            "tax_number" => $_POST['tax_number'],
            "partner_type" => $_POST['partner_type'],
            "sales_price_level" => $_POST['sales_price_level'],
            "tax_address" => $_POST['tax_address'],
            "is_customer" => 1,
            "is_supplier" => 0,
        );
        $this->partner->insert($entry_data);
        $this->session->set_flashdata("success", "Customer berhasil tersimpan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit_customer()
    {
        $where_id['id'] = $_POST['id'];

        $entry_data = array(
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "partner_code" => $_POST['partner_code'],
            "master_code" => $_POST['master_code'],
            "branch_id" => $_POST['branch_id'],
            "address_1" => $_POST['address_1'],
            "address_2" => $_POST['address_2'],
            "city" => $_POST['city'],
            "province" => $_POST['province'],
            "zip_code" => $_POST['zip_code'],
            "phone" => $_POST['phone'],
            "fax" => $_POST['fax'],
            "tax_number" => $_POST['tax_number'],
            "partner_type" => $_POST['partner_type'],
            "sales_price_level" => $_POST['sales_price_level'],
            "tax_address" => $_POST['tax_address'],
        );
        $this->partner->update($where_id, $entry_data);
        $this->session->set_flashdata("success", "Customer berhasil diperbarui");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_customer()
    {
        $where_id['id'] = $_POST['id'];
        $this->partner->delete($where_id);
        $this->session->set_flashdata("success", "Customer berhasil terhapus");
        redirect($_SERVER['HTTP_REFERER']);
    }

    // Salesman

    public function add_salesman()
    {
        $this->part_salesman->insert($_POST);
        $this->session->set_flashdata("success", "Salesman berhasil ditambahkan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit_salesman()
    {
        $where['id'] = $_POST['id'];
        $data['name'] = $_POST['name'];
        $data['phone'] = $_POST['phone'];
        $data['updated_date'] = date("Y-m-d H:i:s");

        $this->part_salesman->update($where, $data);
        $this->session->set_flashdata("success", "Data salesman berhasil diperbarui");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_salesman()
    {
        $this->part_salesman->delete(array("id" => $_POST['id']));
        $this->session->set_flashdata("success", "Salesman telah dihapus");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function barang_salesman($id_salesman)
    {
        echo json_encode(
            array(
                "data" => $this->salesman_map->get_barang(array("salesman_id" => $id_salesman))->result()
            )
        );
    }

    public function add_salesman_map($id_barang, $id_salesman)
    {
        $this->salesman_map->insert(
            array(
                "salesman_id" => $id_salesman,
                "goods_id" => $id_barang
            )
        );
        echo json_encode(array("message" => "success"));
    }

    public function remove_salesman_map($id_barang, $id_salesman)
    {
        $this->salesman_map->delete(
            array(
                "salesman_id" => $id_salesman,
                "goods_id" => $id_barang
            )
        );
        echo json_encode(array("message" => "success"));
    }

    // Cabang
    public function cabang()
    {
        echo json_encode(array("data" => $this->branch->get_all()->result()));
    }

    public function add_cabang()
    {
        $entry_data = array(
            "name" => $_POST['name'],
            "owner" => $_POST['owner'],
            "code" => $_POST['code'],
            "address" => $_POST['address'],
            "npwp" => $_POST['npwp'],
            "tax_status" => $_POST['tax_status'],
        );

        if ($_FILES['logo']['name']) {
            // upload logo
            $config['upload_path']          = 'attachment/';
            $config['allowed_types']        = ['jpg', 'png', 'jpeg'];
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('logo');

            $uploadData = $this->upload->data();
            $entry_data['logo'] = $uploadData['file_name'];
        }

        $this->branch->insert($entry_data);
        $this->session->set_flashdata("success", "Cabang berhasil tersimpan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit_cabang()
    {
        $where_id['id'] = $_POST['id'];
        $entry_data = array(
            "name" => $_POST['name'],
            "owner" => $_POST['owner'],
            "code" => $_POST['code'],
            "address" => $_POST['address'],
            "npwp" => $_POST['npwp'],
            "tax_status" => $_POST['tax_status'],
        );

        if ($_FILES['logo']['name']) {
            // upload logo
            $config['upload_path']          = 'attachment/';
            $config['allowed_types']        = ['jpg', 'png', 'jpeg'];
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('logo');

            $uploadData = $this->upload->data();
            $entry_data['logo'] = $uploadData['file_name'];
        }
        $this->branch->update($where_id, $entry_data);
        $this->session->set_flashdata("success", "Cabang berhasil tersimpan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_cabang()
    {
        $where_id['id'] = $_POST['id'];
        $this->branch->delete($where_id);
        $this->session->set_flashdata("success", "Cabang berhasil terhapus");
        redirect($_SERVER['HTTP_REFERER']);
    }

    // Gudang
    public function gudang()
    {
        echo json_encode(array("data" => $this->warehouse->get_all()->result()));
    }

    public function gudang_branch($id_branch)
    {
        $data_query = $this->warehouse->get_by_branch(array("p.branch_id" => $id_branch))->result();
        $data['data'] = $data_query;
        echo json_encode($data);
    }

    public function add_gudang()
    {
        $entry_data = array(
            "branch_id" => $_POST['branch_id'],
            "code" => $_POST['code'],
            "name" => $_POST['name'],
            "address" => $_POST['address'],
            "length" => $_POST['length'],
            "width" => $_POST['width'],
            "capacity" => $_POST['capacity'],
            "description" => $_POST['description'],
            "created_by" => $this->session->id
        );
        $this->warehouse->insert($entry_data);
        $this->session->set_flashdata("success", "Gudang berhasil tersimpan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit_gudang()
    {
        $where_id['id'] = $_POST['id'];
        $entry_data = array(
            "code" => $_POST['code'],
            "name" => $_POST['name'],
            "address" => $_POST['address'],
            "length" => $_POST['length'],
            "width" => $_POST['width'],
            "capacity" => $_POST['capacity'],
            "description" => $_POST['description'],
            "updated_by" => $this->session->id,
            "updated_date" => date("Y-m-d H:i:S")
        );
        $this->warehouse->update($where_id, $entry_data);
        $this->session->set_flashdata("success", "Gudang berhasil diubah");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_gudang()
    {
        $where_id['id'] = $_POST['id'];
        $this->warehouse->delete($where_id);
        $this->session->set_flashdata("success", "Gudang berhasil terhapus");
        redirect($_SERVER['HTTP_REFERER']);
    }

    // map
    public function map()
    {
        echo json_encode(array("data" => $this->m_map->get_all()->result()));
    }

    public function add_map()
    {
        $this->m_map->insert($_POST);
        echo json_encode(
            array(
                "message" => "Map berhasil ditambahkan",
                "id" => $this->db->insert_id()
            )
        );
    }

    public function edit_map()
    {
        $where = array(
            "id" => $_POST['id']
        );

        $data = array(
            "partner_type" => $_POST['partner_type'],
            "price_index" => $_POST['price_index']
        );

        $this->m_map->update($where, $data);

        echo json_encode(array("message" => "Map berhasil diubah"));
    }

    public function delete_map()
    {
        $this->m_map->delete($_POST);
        echo json_encode(array("message" => "Map berhasil dihapus"));
    }

    // reference
    public function reference_branch($group_data, $id_branch)
    {
        echo json_encode(
            array(
                "data" => $this->reference->get(
                    array(
                        "group_data" => $group_data,
                        "branch_id" => $id_branch
                    )
                )->result()
            )
        );
    }

    public function add_reference()
    {
        $_POST['updated_by'] = $this->session->id;
        $this->reference->insert($_POST);
        $this->session->set_flashdata("success", "Reference berhasil ditambahkan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit_reference()
    {
        $where = array("id" => $_POST['id']);
        $data = array('detail_data' => $_POST['detail_data']);
        $this->reference->update($where, $data);
        $this->session->set_flashdata("success", "Reference berhasil diubah");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_reference()
    {
        $this->reference->delete($_POST);
        $this->session->set_flashdata("success", "Reference berhasil dihapus");
        redirect($_SERVER['HTTP_REFERER']);
    }

    // order request
    public function get_order_number($id_branch)
    {
        echo json_encode(
            array(
                "data" => $this->or->get_next_no(array("branch_id" => $id_branch))
            )
        );
    }

    public function kirim_order_request()
    {
        $data = array(
            "branch_id" => $_POST['branch_id'],
            "partner_id" => $_POST['partner_id'],
            "partner_name" => $_POST['partner_name'],
            "order_no" => $_POST['order_no'],
            "description" => $_POST['description'],
            "order_date" => date('Y-m-d H:i:s'),
            "created_date" => date('Y-m-d H:i:s'),
            "updated_date" => date('Y-m-d H:i:s'),
            "created_by" => $this->session->id,
            "flag" => 1
        );
        $this->or->insert($data);
        $id_new_or = $this->db->insert_id();

        // loop added goods
        foreach ($_POST['barang'] as $good) {
            $good['total'] = $good['quantity'] * $good['price'] * (1 - $good['discount'] / 100);
            $good['tax'] = 10 * $good['total'] / 100;
            $good['total'] = $good['total'] + $good['tax'];
            $good['order_request_id'] = $id_new_or;
            $good['flag'] = 1;
            $this->or->insert_detail($good);
        }

        $this->session->set_flashdata("success", "Order Request berhasil dicetak");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function order_request($branch_id = '')
    {
        if ($branch_id) {
            echo json_encode(
                array(
                    "data" => $this->or->get(array(
                        "or.branch_id" => $branch_id
                    ))->result()
                )
            );
        } else {
            echo json_encode(
                array(
                    "data" => $this->or->get_all()->result()
                )
            );
        }
    }

    public function delete_order_request()
    {
        $this->or->delete(array("id" => $_POST['id']));
        $this->session->set_flashdata("success", "Order Request berhasil dihapus");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_order_request()
    {
        $where['id'] = $_POST['id'];
        $data = array(
            "description" => $_POST['description'],
        );
        $this->or->update($where, $data);

        // clear details
        $this->or->delete_detail(array("order_request_id" => $_POST['id']));

        // loop added goods
        foreach ($_POST['barang'] as $good) {
            $good['total'] = $good['quantity'] * $good['price'] * (1 - $good['discount'] / 100);
            $good['tax'] = 10 * $good['total'] / 100;
            $good['total'] = $good['total'] + $good['tax'];
            $good['order_request_id'] = $_POST['id'];
            $this->or->insert_detail($good);
        }

        $this->session->set_flashdata("success", "Order Request berhasil diubah");
        redirect($_SERVER['HTTP_REFERER']);
    }

    // Get next invoice number
    public function get_invoice_number($id_branch)
    {
        echo json_encode(
            array(
                "data" => $this->pos->get_next_invoice_no(array("branch_id" => $id_branch))
            )
        );
    }

    public function convert_to_pos($order_request_id)
    {
        // get order request info
        $order_request = $this->or->get_specific($order_request_id);

        // update order_request flag jadi 2
        $where['id'] = $order_request_id;
        $data = array(
            "flag" => 2,
        );
        $this->or->update($where, $data);

        // create POS data
        $pos_data = array(
            "branch_id" => $order_request->branch_id,
            "partner_id" => $order_request->partner_id,
            "partner_name" => $order_request->partner_name,
            "order_no" => $order_request->order_no,
            "invoice_no" => $this->pos->get_next_invoice_no(array("branch_id" => $order_request->branch_id)),
            "tax_no" => null,
            "description" => $order_request->description,
            "pos_date" => date("Y-m-d H:i:s"),

            "created_by" => $this->session->id,
            "flag" => 1
        );

        $this->pos->insert($pos_data);
        $pos_id = $this->db->insert_id();

        $payment_total = 0;

        // get order_request_details
        $order_request_details = $order_request->details;

        foreach ($order_request_details as $or_det) {
            // generate POS detail data
            $total = $or_det->checksheet_qty * $or_det->price * (100 - $or_det->discount) / 100;
            $tax = 10 * $total / 100;
            $total = 110 * $total / 100;
            $payment_total += $total;

            $pos_det_data = array(
                "pos_id" => $pos_id,
                "goods_id" => $or_det->goods_id,

                "goods_name" => $or_det->goods_name,
                "price" => $or_det->price,
                "quantity" => $or_det->checksheet_qty,
                "discount" => $or_det->discount,

                "warehouse_id" => 1, // default dulu buat test

                "discount_code" => isset($or_det->discount_code) ? $or_det->discount_code : null,
                "tax" => $tax,
                "total" => $total,

                "flag" => 1
            );

            $this->pos->insert_detail($pos_det_data);
        }

        // update payment total
        $this->pos->update(array("id" => $pos_id), array("payment_total" => $payment_total));

        $this->session->set_flashdata("success", "Faktur Order Request berhasil dicetak");
        redirect(base_url("/index.php/penjualan/pos"));
    }

    // Update 30 Agustus: tidak update jumlah order request, hanya ubah jumlah stok
    public function save_checksheet($order_request_id)
    {
        // update jumlah
        foreach ($_POST['barang'] as $id_barang => $barang) {
            $this->or->checksheet_update($order_request_id, $id_barang, $barang['quantity']);
            $this->goods->update_quantity_from_checksheet($id_barang, $barang['quantity']);
        }

        $this->session->set_flashdata("success", "Checksheet berhasil disimpan");
        redirect(base_url("/index.php/penjualan/order_request"));
    }

    // Point of Sales
    public function fetch_pos($pos_id)
    {
        echo json_encode(
            array(
                "data" => $this->pos->get_specific($pos_id)
            )
        );
    }

    public function pos($branch_id = '')
    {
        if ($branch_id) {
            echo json_encode(
                array(
                    "data" => $this->pos->get(
                        array(
                            "pos.branch_id" => $branch_id
                        )
                    )->result()
                )
            );
        } else {
            echo json_encode(
                array(
                    "data" => $this->pos->get_all()->result()
                )
            );
        }
    }

    public function get_pos_number($id_branch)
    {
        echo json_encode(
            array(
                "data" => $this->pos->get_next_no(array("branch_id" => $id_branch))
            )
        );
    }

    public function bayar_pos()
    {
        $this->pos->update(
            array(
                "id" => $_POST['id']
            ),
            array(
                "payment_total" => $_POST['payment_total'],
                "payment_method" => $_POST['payment_method'],
                "bank" => $_POST['payment_method'] == "TRANSFER" ? $_POST['bank'] : null,
                "payment_paid" => $_POST['payment_paid'],
                "payment_description" => $_POST['payment_description'],
                "flag" => 2
            )
        );

        $this->session->set_flashdata("success", "Pembayaran berhasil disimpan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function kirim_pos()
    {
        // create POS data
        $pos_data = array(
            "branch_id" => $_POST['branch_id'],
            "partner_name" => $_POST['partner_name'],
            "user_salesman_id" => $_POST['user_salesman_id'],
            "invoice_no" => $_POST['invoice_no'],
            "tax_no" => null,
            "partner_id" => $_POST['partner_id'],
            "order_no" => $_POST['order_no'],
            "description" => $_POST['description'],
            "created_by" => $this->session->id,
            "updated_by" => $this->session->id,
            "pos_date" => date('Y-m-d H:i:s'),
            "created_date" => date('Y-m-d H:i:s'),
            "updated_date" => date('Y-m-d H:i:s'),
            "payment_total" => $_POST['payment_total'],
            "flag" => 1,
        );

        $this->pos->insert($pos_data);
        $id_new_pos = $this->db->insert_id();

        $fullprice = 0;
        $fullend_price = 0;
        // loop added goods
        foreach ($_POST['barang'] as $good) {
            $good['total'] = $good['quantity'] * $good['price'] * (1 - $good['discount'] / 100);
            $fullprice += $good['total'];
            $good['tax'] = 10 * $good['total'] / 100;
            $good['total'] = $good['total'] + $good['tax'];
            $fullend_price += $good['total'];

            // generate POS detail data
            $pos_det_data = array(
                "pos_id" => $id_new_pos,
                "goods_id" => $good['goods_id'],
                "warehouse_id" => 1, // default dulu buat test
                "goods_name" => $good['goods_name'],
                "price" => $good['price'],
                "quantity" => $good['quantity'],
                "discount" => $good['discount'],
                "discount_code" => null,
                "tax" => $good['tax'],
                "total" => $good['total'],
                "flag" => 1,
            );

            $this->pos->insert_detail($pos_det_data);
        }

        $this->session->set_flashdata("success", "Transaksi berhasil disimpan");
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function edit_pos()
    {
        // set POS data
        $pos_data = array(
            "description" => $_POST['description'],
            "updated_by" => $this->session->id,
            "updated_date" => date('Y-m-d H:i:s'),
        );

        $where_pos = array(
            "id" => $_POST['id']
        );

        $this->pos->update($where_pos, $pos_data);

        // delete semua detailnya
        $where_pos_detail = array(
            "pos_id" => $_POST['id']
        );

        $this->pos->delete_detail($where_pos_detail);

        // loop added goods
        foreach ($_POST['barang'] as $good) {
            $good['total'] = $good['quantity'] * $good['price'] * (1 - $good['discount'] / 100);
            $good['tax'] = 10 * $good['total'] / 100;
            $good['total'] = $good['total'] + $good['tax'];

            // generate POS detail data
            $pos_det_data = array(
                "pos_id" => $_POST['id'],
                "goods_id" => $good['goods_id'],
                "warehouse_id" => 1, // default dulu buat test
                "goods_name" => $good['goods_name'],
                "quantity" => $good['quantity'],
                "price" => $good['price'],
                "discount" => $good['discount'],
                "discount_code" => null,
                "tax" => $good['tax'],
                "total" => $good['total'],
                "flag" => 1,
            );

            $this->pos->insert_detail($pos_det_data);
        }

        $this->session->set_flashdata("success", "Transaksi berhasil disimpan");
        redirect(base_url("/index.php/penjualan/pos/view/" . $_POST['id']));
    }

    function partner_type_branch($branch_id)
    {
        echo json_encode(
            array(
                "data" => $this->partner_type->get(
                    array("branch_id" => $branch_id)
                )->result()
            )
        );
    }

    function add_partner_type()
    {
        $this->partner_type->insert($_POST);
        $this->session->set_flashdata("success", "Tipe partner berhasil disimpan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function edit_partner_type()
    {
        $this->partner_type->update(
            array(
                "id" => $_POST['id']
            ),
            array(
                "type" => $_POST['type'],
                "description" => $_POST['description']
            )
        );
        $this->session->set_flashdata("success", "Tipe partner berhasil diperbarui");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function delete_partner_type()
    {
        $this->partner_type->update(
            array(
                "id" => $_POST['id']
            ),
            array(
                "flag" => 99
            )
        );
        $this->session->set_flashdata("success", "Tipe partner berhasil diperbarui");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function m_map_branch()
    {
        echo json_encode(
            array(
                "data" => $this->m_map->get()->result()
            )
        );
    }

    function add_m_map()
    {
        $this->m_map->insert($_POST);
        $this->session->set_flashdata("success", "Map harga berhasil disimpan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function edit_m_map()
    {
        $this->m_map->update(
            array(
                "id" => $_POST['id']
            ),
            array(
                "price_index" => $_POST['price_index'],
            )
        );
        $this->session->set_flashdata("success", "Tipe partner berhasil diperbarui");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function delete_m_map()
    {
        $this->m_map->update(
            array(
                "id" => $_POST['id']
            ),
            array(
                "flag" => 99,
            )
        );
        $this->session->set_flashdata("success", "Tipe partner berhasil diperbarui");
        redirect($_SERVER['HTTP_REFERER']);
    }

    // m_unit
    function m_unit_branch($branch_id)
    {
        echo json_encode(
            array(
                "data" => $this->unit->get(
                    array("branch_id" => $branch_id)
                )->result()
            )
        );
    }

    function add_unit()
    {
        $this->unit->insert($_POST);
        $this->session->set_flashdata("success", "Unit barang berhasil disimpan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function edit_unit()
    {
        $this->unit->update(
            array(
                "id" => $_POST['id']
            ),
            array(
                "initial" => $_POST['initial'],
                "name" => $_POST['name'],
                "quantity" => $_POST['quantity'],
            )
        );
        $this->session->set_flashdata("success", "Unit barang berhasil diperbarui");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function delete_unit()
    {
        $this->unit->update(
            array(
                "id" => $_POST['id']
            ),
            array(
                "flag" => 99,
            )
        );
        $this->session->set_flashdata("success", "Unit barang berhasil dihapus");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function change_password()
    {
        $login_data = array(
            "m_user.id" => $this->session->id,
            "password" => md5($_POST['current_password'])
        );

        // check if login data match in database
        $user_query = $this->user_m->get($login_data);

        if ($user_query->num_rows()) {

            // do change password
            $this->user_m->update($login_data, array(
                "password" => md5($_POST['new_password'])
            ));

            // Logout
            $this->session->sess_destroy();
            $this->session->set_flashdata('success', 'Password berhasil diubah, silahkan login kembali');
            redirect(base_url());
        } else {
            $this->session->set_flashdata('error', 'Current password did not match');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    // user salesman
    function usr_salesman($customer_id)
    {
        echo json_encode(
            array(
                "data" => $this->usr_salesman->get(
                    array(
                        "m_user_salesman.partner_id" => $customer_id
                    )
                )->result()
            )
        );
    }

    function add_usr_salesman()
    {
        $this->usr_salesman->insert($_POST);
        $this->session->set_flashdata("success", "Salesman berhasil didaftarkan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function edit_usr_salesman()
    {
        $this->usr_salesman->update(
            array(
                "id" => $_POST['id']
            ),
            array(
                "employee_id" => $_POST['employee_id'],
                "phone" => $_POST['phone'],
            )
        );
        $this->session->set_flashdata("success", "Salesman berhasil diperbarui");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function delete_usr_salesman()
    {
        $this->usr_salesman->update(
            array(
                "id" => $_POST['id']
            ),
            array(
                "flag" => 99
            )
        );
        $this->session->set_flashdata("success", "Salesman berhasil dihapus");
        redirect($_SERVER['HTTP_REFERER']);
    }

    // employee
    function employee_branch($branch_id)
    {
        echo json_encode(
            array(
                "data" => $this->employee->get(
                    array(
                        "m_employee.branch_id" => $branch_id
                    )
                )->result()
            )
        );
    }

    function add_employee()
    {
        // info branch id untuk tiap record
        $_POST['emp']['branch_id'] = $_POST['branch_id'];
        $_POST['usr']['branch_id'] = $_POST['branch_id'];

        // set as active
        $_POST['emp']['is_active'] = 1;

        // default flag
        $_POST['emp']['flag'] = 1;

        // default role sebagai user
        $_POST['usr']['role_code'] = "ROLE_USER";

        // created by
        $_POST['usr']['created_by'] = $this->session->id;

        // get encrypted default password
        $_POST['usr']['password'] = $this->reference->get_default_password();

        // create user
        $this->user_m->insert($_POST['usr']);
        $_POST['emp']['user_id'] = $this->user_m->get(
            array(
                "m_user.user_id" => $_POST['usr']['user_id'],
                "password" => $_POST['usr']['password']
            )
        )->row()->id;

        // create employee
        $this->employee->insert($_POST['emp']);

        $this->session->set_flashdata("success", "Akun employee berhasil dibuat");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function edit_employee()
    {
        $this->employee->update(array("m_employee.id" => $_POST['id']), $_POST['emp']);
        $this->session->set_flashdata("success", "Data employee berhasil diperbarui");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function delete_employee()
    {
        $this->employee->update(
            array(
                "m_employee.id" => $_POST['id']
            ),
            array(
                "is_active" => 0
            )
        );
        $this->session->set_flashdata("success", "Akun employee berhasil dinonaktifkan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function activate_employee()
    {
        $this->employee->update(
            array(
                "m_employee.id" => $_POST['id']
            ),
            array(
                "is_active" => 1
            )
        );
        $this->session->set_flashdata("success", "Akun employee berhasil diaktifkan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    // kode akun (parameter)
    function account_code_cabang($branch_id)
    {
        echo json_encode(
            array(
                "data" => $this->account->get(
                    array(
                        "branch_id" => $branch_id
                    )
                )->result()
            )
        );
    }

    function add_account()
    {
        $_POST['is_active'] = isset($_POST['is_active']) ? "1" : "0";
        $_POST['inv_required'] = isset($_POST['inv_required']) ? "1" : "0";
        $_POST['created_date'] = date("Y-m-d H:i:s");
        $_POST['created_by'] = $this->session->id;
        $this->account->insert($_POST);

        $this->session->set_flashdata("success", "Akun berhasil didaftarkan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function edit_account()
    {
        $_POST['data']['is_active'] = isset($_POST['data']['is_active']) ? "1" : "0";
        $_POST['data']['inv_required'] = isset($_POST['data']['inv_required']) ? "1" : "0";

        $this->account->update(
            array(
                "id" => $_POST['id']
            ),
            $_POST['data']
        );
        $this->session->set_flashdata("success", "Akun berhasil diperbarui");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function cetak_faktur_pajak($id_pos)
    {
        // cari informasi pos nya
        $pos_target = $this->pos->get_specific($id_pos);

        // update flag pos jadi 10 (faktur pajak tercetak)
        $this->pos->update(
            array(
                "id" => $pos_target->id
            ),
            array(
                "flag" => 10
            )
        );

        // buat nomor jurnal
        $jurnal_no_awal = $this->jurnal->get_next_jurnal_no($pos_target->branch_id);

        $dpp = 0;
        foreach ($pos_target->details as $pos_detail) {
            $dpp += ($pos_detail->price * $pos_detail->quantity * (100 - $pos_detail->discount) / 100);
            // buat detail jurnal untuk tiap barang
            $this->jurnal->insert_detail(
                array(
                    "jurnal_no" => $jurnal_no_awal,
                    "acc_code" => $pos_detail->rekening_no,
                    // "master_id",
                    "invoice_no" => $pos_target->invoice_no,
                    "debit" => 0,
                    "credit" => $pos_detail->total,
                    // "cost_center"
                )
            );
        }

        // buat detail jurnal untuk piutang
        $this->jurnal->insert_detail_piutang(
            $pos_target->branch_id,
            array(
                "jurnal_no" => $jurnal_no_awal,
                // "acc_code" diisi dari dalam model,
                // "master_id",
                "invoice_no" => $pos_target->invoice_no,
                "debit" => $pos_target->payment_total,
                "credit" => 0,
                // "cost_center"
            )
        );

        // buat jurnal awal // TODO: infokan kalau nomor pajak sudah habis
        $this->jurnal->insert(
            array(
                "jurnal_no" => $jurnal_no_awal,
                "branch_id" => $pos_target->branch_id,
                "invoice_no" => $pos_target->invoice_no,
                "jurnal_date" => date("Y-m-d"), // TODO: cek status tutup buku
                // "carry_over",
                "kurs" => 1,
                // "description",
                "flag" => 1,
                "username" => $this->session->username,
                "created_date" => date("Y-m-d H:i:s"),
                // "updated_date",
                // "printed_date",
                // "printed_flag",
                // "registered_date",
                "registered_flag" => "Y",
                // "registered_user",
                // "registered_id",
                // "print_count" => 1,
                // "print_registered_count",
                // "re_printed_date",
                // "re_registered_date",
                "cara_penerimaan" => $pos_target->payment_method,
                "no_seri_pajak_dipungut" => $this->keumod->get_and_use_tax_no($pos_target->branch_id),
                // "no_seri_pajak_ditanggung",
                // "bukti_pendukung",
                // "tanggal_pendukung",
                "dpp_dipungut" => $dpp,
                // "dpp_ditanggung",
                // "tipe_jurnal_id",
                // "mata_uang_id"
            )
        );


        // jika sudah ada pembayaran (payment_paid != 0 atau is not null), buat jurnal baru
        if ($pos_target->payment_paid) {
            // buat nomor jurnal
            $jurnal_no = $this->jurnal->get_next_jurnal_no($pos_target->branch_id);

            $this->jurnal->insert(
                array(
                    "jurnal_no" => $jurnal_no,
                    "branch_id" => $pos_target->branch_id,
                    "invoice_no" => $pos_target->invoice_no,
                    "jurnal_date" => date("Y-m-d"), // TODO: cek status tutup buku
                    // "carry_over",
                    "kurs" => 1,
                    // "description",
                    "flag" => 1,
                    "username" => $this->session->username,
                    "created_date" => date("Y-m-d H:i:s"),
                    // "updated_date",
                    // "printed_date",
                    // "printed_flag",
                    // "registered_date",
                    "registered_flag" => "Y", // flag registered auto Y untuk pembayaran langsung
                    // "registered_user",
                    // "registered_id",
                    // "print_count" => 1,
                    // "print_registered_count",
                    // "re_printed_date",
                    // "re_registered_date",
                    "cara_penerimaan" => $pos_target->payment_method,
                    // "no_seri_pajak_dipungut",
                    // "no_seri_pajak_ditanggung",
                    // "bukti_pendukung",
                    // "tanggal_pendukung",
                    "dpp_dipungut" => $dpp,
                    // "dpp_ditanggung",
                    // "tipe_jurnal_id",
                    // "mata_uang_id"
                )
            );

            // buat detail jurnal untuk pembayaran piutang
            $this->jurnal->insert_detail_piutang(
                $pos_target->branch_id,
                array(
                    "jurnal_no" => $jurnal_no,
                    // "acc_code" diisi dari dalam model,
                    // "master_id",
                    "invoice_no" => $pos_target->invoice_no,
                    "debit" => 0,
                    "credit" => $pos_target->payment_paid,
                    // "cost_center"
                )
            );

            // TODO: sekarang masih semuanya KAS
            $this->jurnal->insert_detail_kas(
                $pos_target->branch_id,
                array(
                    "jurnal_no" => $jurnal_no,
                    // "acc_code" diisi dari dalam model,
                    // "master_id",
                    "invoice_no" => $pos_target->invoice_no,
                    "debit" => $pos_target->payment_paid,
                    "credit" => 0,
                    // "cost_center"
                )
            );
        }

        // jika pembayaran belum lunas (payment_paid != payment_total), buat entry di t_pembayaran_piutang
        if ($pos_target->payment_total != $pos_target->payment_paid) {
            $this->keumod->entry_tagihan_piutang_baru($pos_target->invoice_no, $pos_target->payment_total - $pos_target->payment_paid);
        }

        $this->session->set_flashdata("success", "Faktur pajak berhasil dicetak");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function get_parameter_kode_rekening($branch_id)
    {
        echo json_encode(
            array(
                "data" => $this->jurnal_mapping->get(
                    array(
                        "m_journal_mapping.BRANCH_ID" => $branch_id
                    )
                )->result()
            )
        );
    }

    public function edit_parameter_kode_rekening()
    {
        $this->jurnal_mapping->update(
            array(
                "ID" => $_POST['id']
            ),
            array(
                "ACCOUNT_CODE" => $_POST['ACCOUNT_CODE']
            )
        );

        $this->session->set_flashdata("success", "Parameter Tersimpan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function get_uncomplete_invoice($partner_id)
    {
        echo json_encode(
            array(
                "data" => $this->keumod->get_invoice_customer_with_piutang($partner_id)->result()
            )
        );
    }

    public function get_piutang_data($tpp_id)
    {
        echo json_encode(
            array(
                "data" => $this->keumod->get_piutang_data($tpp_id)
            )
        );
    }

    public function pembayaran_piutang()
    {
        // Get informasi piutang
        $info_piutang = $this->keumod->get_piutang_data($_POST['id']);

        // Informasi cabang
        $branch_id = $this->session->userdata("branch_id");

        // buat nomor jurnal
        $jurnal_no = $this->jurnal->get_next_jurnal_no($branch_id);

        $this->jurnal->insert(
            array(
                "jurnal_no" => $jurnal_no,
                "branch_id" => $branch_id,
                "invoice_no" => $info_piutang->invoice_no,
                "jurnal_date" => date("Y-m-d"), // TODO: cek status tutup buku
                // "carry_over",
                "kurs" => 1,
                // "description",
                "flag" => 1,
                "username" => $this->session->username,
                "created_date" => date("Y-m-d H:i:s"),
                // "updated_date",
                // "printed_date",
                // "printed_flag",
                // "registered_date",
                "registered_flag" => "N", // flag registered N untuk pembayaran di menu keuangan
                // "registered_user",
                // "registered_id",
                // "print_count" => 1,
                // "print_registered_count",
                // "re_printed_date",
                // "re_registered_date",
                // "cara_penerimaan",
                // "no_seri_pajak_dipungut",
                // "no_seri_pajak_ditanggung",
                // "bukti_pendukung",
                // "tanggal_pendukung",
                // "dpp_dipungut",
                // "dpp_ditanggung",
                // "tipe_jurnal_id",
                // "mata_uang_id"
            )
        );

        // buat detail jurnal untuk pembayaran piutang
        $this->jurnal->insert_detail_piutang(
            $branch_id,
            array(
                "jurnal_no" => $jurnal_no,
                // "acc_code" diisi dari dalam model,
                // "master_id",
                "invoice_no" => $info_piutang->invoice_no,
                "debit" => 0,
                "credit" => $_POST['payment'],
                // "cost_center"
            )
        );

        // TODO: sekarang masih semuanya KAS
        $this->jurnal->insert_detail_kas(
            $branch_id,
            array(
                "jurnal_no" => $jurnal_no,
                // "acc_code" diisi dari dalam model,
                // "master_id",
                "invoice_no" => $info_piutang->invoice_no,
                "debit" => $_POST['payment'],
                "credit" => 0,
                // "cost_center"
            )
        );


        // Cek apakah sudah lunas atau belum
        if ($_POST['payment'] == $info_piutang->sisa_tagihan) {
            // Update entry t_pembayaran_piutang
            $this->keumod->update_entry_piutang(
                $_POST['id'],
                array(
                    "flag" => 1,
                    "jurnal_no" => $jurnal_no,
                    "payment_date" => date("Y-m-d h:i:s"),
                    "payment" => $_POST['payment']
                )
            );
        } else {
            // Update entry t_pembayaran_piutang
            $this->keumod->update_entry_piutang(
                $_POST['id'],
                array(
                    "flag" => 1,
                    "jurnal_no" => $jurnal_no,
                    "payment_date" => date("Y-m-d h:i:s"),
                    "payment" => $_POST['payment']
                )
            );

            // jika belum lunas, buat entry baru
            $this->keumod->entry_tagihan_piutang_baru(
                $info_piutang->invoice_no,
                $info_piutang->sisa_tagihan - $_POST['payment']
            );
        }

        $this->session->set_flashdata("success", "Pembayaran telah tersimpan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function trigger_reset_password($employee_id)
    {
        $this->user_m->reset_password($employee_id);
        $this->session->set_flashdata("success", "Reset password employee berhasil");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function get_unregistered_jurnal($branch_id)
    {
        echo json_encode(
            array(
                "data" => $this->jurnal->get_unregistered_jurnal(
                    array(
                        "branch_id" => $branch_id
                    )
                )->result()
            )
        );
    }

    public function register_jurnal($jurnal_no)
    {
        $this->jurnal->register($jurnal_no);
        $this->session->set_flashdata("success", "Registrasi jurnal berhasil");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function preview_tutup_buku($branch_id)
    {
        $date = $_GET['periode'];
        echo json_encode(
            array(
                "data" => $this->jurnal->preview_tutup_buku($branch_id, $date)
            )
        );
    }

    public function tutup_buku($branch_id, $periode)
    {
        $this->jurnal->tutup_buku($branch_id, $periode);
        $this->session->set_flashdata("success", "Tutup buku bulanan telah berhasil");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function parameter_neraca_saldo_akhir_cabang($branch_id)
    {
        echo json_encode(
            array(
                "data" => $this->keumod->get_parameter_neraca_saldo_akhir($branch_id)->result()
            )
        );
    }

    public function add_parameter_neraca_saldo_akhir()
    {
        $this->keumod->add_parameter_neraca_saldo_akhir($_POST['branch_id'], $_POST['acc_code']);
        $this->session->set_flashdata("success", "Parameter neraca saldo akhir berhasil ditambahkan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_parameter_neraca_saldo($id)
    {
        $this->keumod->delete_parameter_neraca_saldo_akhir($id);
        $this->session->set_flashdata("success", "Parameter neraca saldo akhir berhasil dihapus");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function parameter_ikhtisar_saldo_cabang($branch_id)
    {
        echo json_encode(
            array(
                "data" => $this->keumod->get_parameter_ikhtisar_saldo($branch_id)->result()
            )
        );
    }

    public function add_parameter_ikhtisar_saldo()
    {
        $this->keumod->add_parameter_ikhtisar_saldo($_POST['branch_id'], $_POST['acc_code']);
        $this->session->set_flashdata("success", "Parameter ikhtisar saldo berhasil ditambahkan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_parameter_ikhtisar_saldo($id)
    {
        $this->keumod->delete_parameter_ikhtisar_saldo($id);
        $this->session->set_flashdata("success", "Parameter ikhtisar saldo berhasil dihapus");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function parameter_kode_rekening_saldo_cabang($branch_id)
    {
        echo json_encode(
            array(
                "data" => $this->keumod->get_parameter_kode_rekening_saldo($branch_id)->result()
            )
        );
    }

    public function add_parameter_kode_rekening_saldo()
    {
        $this->keumod->add_parameter_kode_rekening_saldo($_POST['branch_id'], $_POST['acc_code']);
        $this->session->set_flashdata("success", "Parameter kode rekening saldo berhasil ditambahkan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_parameter_kode_rekening_saldo($id)
    {
        $this->keumod->delete_parameter_kode_rekening_saldo($id);
        $this->session->set_flashdata("success", "Parameter kode rekening saldo berhasil dihapus");
        redirect($_SERVER['HTTP_REFERER']);
    }

    // Pelunasan Hutang
    public function get_uncomplete_invoice_hutang($partner_id)
    {
        echo json_encode(
            array(
                "data" => $this->keumod->get_invoice_supplier_with_hutang($partner_id)->result()
            )
        );
    }

    public function get_hutang_data($tph_id)
    {
        echo json_encode(
            array(
                "data" => $this->keumod->get_hutang_data($tph_id)
            )
        );
    }

    public function pembayaran_hutang()
    {
        // Get informasi hutang
        $info_hutang = $this->keumod->get_hutang_data($_POST['id']);

        // Informasi cabang
        $branch_id = $this->session->userdata("branch_id");

        // buat nomor jurnal
        $jurnal_no = $this->jurnal->get_next_jurnal_no($branch_id);

        $this->jurnal->insert(
            array(
                "jurnal_no" => $jurnal_no,
                "branch_id" => $branch_id,
                "invoice_no" => $info_hutang->invoice_no,
                "jurnal_date" => date("Y-m-d"), // TODO: cek status tutup buku
                // "carry_over",
                "kurs" => 1,
                // "description",
                "flag" => 1,
                "username" => $this->session->username,
                "created_date" => date("Y-m-d H:i:s"),
                // "updated_date",
                // "printed_date",
                // "printed_flag",
                // "registered_date",
                "registered_flag" => "N", // flag registered N untuk pembayaran di menu keuangan
                // "registered_user",
                // "registered_id",
                // "print_count" => 1,
                // "print_registered_count",
                // "re_printed_date",
                // "re_registered_date",
                // "cara_penerimaan",
                // "no_seri_pajak_dipungut",
                // "no_seri_pajak_ditanggung",
                // "bukti_pendukung",
                // "tanggal_pendukung",
                // "dpp_dipungut",
                // "dpp_ditanggung",
                // "tipe_jurnal_id",
                // "mata_uang_id"
            )
        );

        // buat detail jurnal untuk pembayaran hutang
        $this->jurnal->insert_detail_hutang(
            $branch_id,
            array(
                "jurnal_no" => $jurnal_no,
                // "acc_code" diisi dari dalam model,
                // "master_id",
                "invoice_no" => $info_hutang->invoice_no,
                "debit" => $_POST['payment'],
                "credit" => 0,
                // "cost_center"
            )
        );

        $this->jurnal->insert_detail_kas(
            $branch_id,
            array(
                "jurnal_no" => $jurnal_no,
                // "acc_code" diisi dari dalam model,
                // "master_id",
                "invoice_no" => $info_hutang->invoice_no,
                "debit" => 0,
                "credit" => $_POST['payment'],
                // "cost_center"
            )
        );

        // Cek apakah sudah lunas atau belum
        if ($_POST['payment'] == $info_hutang->sisa_tagihan) {
            // Update entry t_pembayaran_hutang
            $this->keumod->update_entry_hutang(
                $_POST['id'],
                array(
                    "flag" => 1,
                    "jurnal_no" => $jurnal_no,
                    "payment_date" => date("Y-m-d h:i:s"),
                    "payment" => $_POST['payment']
                )
            );
        } else {
            // Update entry t_pembayaran_hutang
            $this->keumod->update_entry_hutang(
                $_POST['id'],
                array(
                    "flag" => 1,
                    "jurnal_no" => $jurnal_no,
                    "payment_date" => date("Y-m-d h:i:s"),
                    "payment" => $_POST['payment']
                )
            );

            // jika belum lunas, buat entry baru
            $this->keumod->entry_tagihan_hutang_baru(
                $info_hutang->invoice_no,
                $info_hutang->sisa_tagihan - $_POST['payment']
            );
        }

        $this->session->set_flashdata("success", "Pembayaran telah tersimpan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function get_tax_no_branch($branch_id)
    {
        echo json_encode(
            array(
                "data" =>  $this->keumod->get_all_tax_no($branch_id)->result()
            )
        );
    }

    function add_tax_no($branch_id)
    {
        $data = array(
            "branch_id" => $branch_id,
            "start_tax" => $_POST['start_tax'],
            "sequence" => 1 - intval($_POST['start_tax']),
            "end_tax" => $_POST['end_tax'],
            "years" => $_POST['years']
        );
        $this->keumod->add_tax_no($data);
        $this->session->set_flashdata("success", "Nomor telah tersimpan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function edit_tax_no()
    {
        $where = array(
            "id" => $_POST['id']
        );

        $data = array(
            "start_tax" => $_POST['start_tax'],
            "sequence" => $_POST['sequence'],
            "end_tax" => $_POST['end_tax'],
            "years" => $_POST['years']
        );
        $this->keumod->edit_tax_no($where, $data);
        $this->session->set_flashdata("success", "Nomor telah tersimpan");
        redirect($_SERVER['HTTP_REFERER']);
    }
}

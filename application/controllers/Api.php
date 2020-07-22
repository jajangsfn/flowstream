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
                "s_reference_model" => "reference",
                "t_order_request_model" => "or",
                "t_pos_model" => "pos"
            )
        );
    }

    public function index()
    {
        echo json_encode($this->session->userdata);
    }

    public function register()
    {
        $signup_data = array(
            "email" => $_POST['email'],
            "user_id" => $_POST['username'],
            "password" => md5($_POST['password'])
        );

        // insert to database
        $user_query = $this->user_m->insert($signup_data);

        // do login
        $this->session->set_userdata(
            array(
                "login" => true,
                "username" => $_POST['username'],
                "name" => $user_query->row()->name,
                "email" => $user_query->row()->email,
                "id" => $user_query->row()->id,
                "branch_id" => $user_query->row()->branch_id,
                "branch_name" => $user_query->row()->branch_name,
                "role_code" => $user_query->row()->role_code
            )
        );

        // report last login
        $this->user_m->login(array("id" => $user_query->row()->id));
        redirect(base_url());
    }

    public function login()
    {
        $login_data = array(
            "m_user.user_id" => $_POST['username'],
            "password" => md5($_POST['password'])
        );

        // check if login data match in database
        $user_query = $this->user_m->get($login_data);

        if ($user_query->num_rows()) {

            if ($user_query->row()->role_code != "ROLE_SUPER_ADMIN") {
                // look for branch info
                $branch_query = $this->branch->get(array("m_branch.id" => $user_query->row()->branch_id))->row();
            }

            // do login
            $this->session->set_userdata(
                array(
                    "login" => true,
                    "username" => $_POST['username'],
                    "name" => $user_query->row()->name,
                    "email" => $user_query->row()->email,
                    "id" => $user_query->row()->id,
                    "branch_id" => $user_query->row()->branch_id,
                    "branch_name" => $user_query->row()->branch_name,
                    "level" => $user_query->row()->level_name,
                    "position" => $user_query->row()->position_name,
                    "role_code" => $user_query->row()->role_code,
                    "branch_obj" => $branch_query,
                    "branch_address" => $user_query->row()->address,
                )
            );
            // report last login
            $this->user_m->login(array("id" => $user_query->row()->id));
        } else {
            $this->session->set_flashdata('error', 'Username and password did not match');
        }
        redirect(base_url());
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

    public function barang_cabang($id_cabang)
    {
        $data_query = $this->goods->get(array("m_goods.branch_id" => $id_cabang))->result();
        $data['data'] = $data_query;
        echo json_encode($data);
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
        );
        $this->goods->update($where_id, $entry_data);
        $this->session->set_flashdata("success", "Barang berhasil tersimpan");
        redirect($_SERVER['HTTP_REFERER']);
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
            "user_salesman_id" => $_POST['user_salesman_id'],
        );
        $this->or->insert($data);
        $id_new_or = $this->db->insert_id();

        // loop added goods
        foreach ($_POST['barang'] as $good) {
            $good['total'] = $good['quantity'] * $good['price'] * (1 - $good['discount'] / 100);
            $good['order_request_id'] = $id_new_or;
            $this->or->insert_detail($good);
        }

        $this->session->set_flashdata("success", "Order Request berhasil dicetak");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function order_request()
    {
        echo json_encode(
            array(
                "data" => $this->or->get_all()->result()
            )
        );
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
            "user_salesman_id" => $order_request->user_salesman_id,
            "order_no" => $order_request->order_no,
            "invoice_no" => $_POST['invoice_no'],
            "tax_no" => null,
            "description" => $order_request->description,
            "created_by" => $this->session->id,
            "updated_by" => $this->session->id
        );

        $this->pos->insert($pos_data);
        $pos_id = $this->db->insert_id();

        // get order_request_details
        $order_request_details = $order_request->details;

        foreach ($order_request_details as $or_det) {
            // generate POS detail data
            $pos_det_data = array(
                "pos_id" => $pos_id,
                "goods_id" => $or_det->goods_id,
                "warehouse_id" => $or_det->warehouse_id,
                "goods_name" => $or_det->goods_name,
                "quantity" => $or_det->quantity,
                "discount" => $or_det->discount,
                "discount_code" => $or_det->discount_code,
                "tax" => $or_det->tax,
                "total" => $or_det->total
            );

            $this->pos->insert_detail($pos_det_data);
        }

        $this->session->set_flashdata("success", "Faktur Order Request berhasil dicetak");
        redirect(base_url("/index.php/penjualan/pos"));
    }

    // Point of Sales
    public function pos()
    {
        echo json_encode(
            array(
                "data" => $this->pos->get_all()->result()
            )
        );
    }

    public function get_pos_number($id_branch)
    {
        echo json_encode(
            array(
                "data" => $this->pos->get_next_no(array("branch_id" => $id_branch))
            )
        );
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
            #"warehouse_id"=>1, // di default dulu
            "flag" => 1,
        );

        $this->pos->insert($pos_data);
        $id_new_pos = $this->db->insert_id();

        // loop added goods
        foreach ($_POST['barang'] as $good) {
            $good['total'] = $good['quantity'] * $good['price'] * (1 - $good['discount'] / 100);

            // generate POS detail data
            $pos_det_data = array(
                "pos_id" => $id_new_pos,
                "goods_id" => $good['goods_id'],
                "warehouse_id" => 1, // default dulu buat test
                "goods_name" => $good['goods_name'],
                "quantity" => $good['quantity'],
                "discount" => $good['discount'],
                "discount_code" => null,
                "tax" => null,
                "total" => $good['total'],

            );

            $this->pos->insert_detail($pos_det_data);
        }

        $this->session->set_flashdata("success", "Transaksi berhasil disimpan");
        redirect($_SERVER['HTTP_REFERER']);
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

    function m_map_branch($branch_id)
    {
        echo json_encode(
            array(
                "data" => $this->m_map->get(
                    array("branch_id" => $branch_id)
                )->result()
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

        // encrypt password
        $_POST['usr']['password'] = md5($_POST['usr']['password']);

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
}

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
                "m_partner_salesman_model" => "part_salesman",
                "m_salesman_map_model" => "salesman_map",
                "m_goods_model" => "goods",
                "m_branch_model" => "branch",
                "m_warehouse_model" => "warehouse"
            )
        );
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
            "brand_description" => $_POST['brand_description'],
            "barcode" => isset($_POST['barcode']) ? $_POST['barcode'] : null,
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
        $this->goods->insert($entry_data);
        $this->session->set_flashdata("success", "Barang berhasil tersimpan");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit_barang()
    {
        $where_id['id'] = $_POST['id'];
        $entry_data = array(
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
}

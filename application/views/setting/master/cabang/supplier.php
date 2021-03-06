<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar Supplier</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_supplier">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="supplier_table">
            <thead>
                <tr>
                    <th width="1">No</th>
                    <th>Nama</th>
                    <th>Tipe Master</th>
                    <th>Kode Partner</th>
                    <th>Alamat 1</th>
                    <th>Alamat 2</th>
                    <th>Kota</th>
                    <th>Provinsi</th>
                    <th>Kode Pos</th>
                    <th>Nomor Telepon</th>
                    <th>Fax</th>
                    <th>Email</th>
                    <th>Pajak</th>
                    <th>Salesman</th>
                    <th>Alamat Pajak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->

<div class="modal fade" id="tambah_supplier" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="<?= base_url("/index.php/api/add_supplier") ?>" method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <input type="hidden" name="branch_id" value="<?= $data_branch->id ?>">
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "name",
                        "type" => "text",
                        "required" => true,

                        "placeholder" => "Nama Supplier",
                        "label" => "Nama Supplier",
                        "help" => "Masukan Nama Supplier",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "email",
                        "type" => "email",
                        "required" => true,

                        "placeholder" => "Email",
                        "label" => "Email",
                        "help" => "Masukan Email Supplier",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "partner_code",
                        "type" => "text",
                        "required" => true,

                        "placeholder" => "Kode Partner",
                        "label" => "Kode Partner",
                        "help" => "Masukan Kode Partner",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_select", array(
                        "name" => "master_code",
                        "title" => "Tipe Master",

                        "list" => $m_master,
                        "identifier" => "code",
                        "showable" => "name",

                        "manage_url" => null,
                        "object_name" => "Master",

                        "selected" => false,
                        "selected_showable" => "Perorangan",
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "address_1",
                        "type" => "textarea",
                        "required" => true,

                        "placeholder" => "Alamat 1",
                        "label" => "Alamat 1",
                        "help" => "Masukan Alamat 1",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "address_2",
                        "type" => "textarea",
                        "required" => true,

                        "placeholder" => "Alamat 2",
                        "label" => "Alamat 2",
                        "help" => "Masukan Alamat 2",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "city",
                        "type" => "text",
                        "required" => true,

                        "placeholder" => "Kota",
                        "label" => "Kota",
                        "help" => "Masukan Kota",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "province",
                        "type" => "text",
                        "required" => true,

                        "placeholder" => "Provinsi",
                        "label" => "Provinsi",
                        "help" => "Masukan Provinsi",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "zip_code",
                        "type" => "text",
                        "required" => true,

                        "placeholder" => "Kode Pos",
                        "label" => "Kode Pos",
                        "help" => "Masukan Kode Pos",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "phone",
                        "type" => "text",
                        "required" => true,

                        "placeholder" => "Nomor Telepon",
                        "label" => "Nomor Telepon",
                        "help" => "Masukan Nomor Telepon",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "fax",
                        "type" => "text",
                        "required" => false,

                        "placeholder" => "Nomor Fax",
                        "label" => "Nomor Fax",
                        "help" => "Masukan Nomor Fax",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "tax_number",
                        "type" => "text",
                        "required" => true,

                        "placeholder" => "Nomor Pajak (NPWP)",
                        "label" => "Nomor Pajak (NPWP)",
                        "help" => "Masukan NPWP",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "tax_address",
                        "type" => "textarea",
                        "required" => false,

                        "placeholder" => "Alamat Pajak",
                        "label" => "Alamat Pajak",
                        "help" => "Masukan Alamat Pajak",

                        "value" => false
                    ), true); ?>
                </div>
                <input type="hidden" name="is_customer" value="0">
                <input type="hidden" name="is_supplier" value="1">
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/button/submit", "", true); ?>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="edit_supplier" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="<?= base_url("/index.php/api/edit_supplier") ?>" method="POST" class="modal-content">
            <input type="hidden" name="id" id="id_edit">
            <div class="modal-header">
                <h5 class="modal-title">Edit Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "name",
                        "type" => "text",
                        "required" => true,

                        "id" => "name_edit",

                        "placeholder" => "Nama Supplier",
                        "label" => "Nama Supplier",
                        "help" => "Masukan Nama Supplier",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "email",
                        "type" => "email",
                        "required" => true,

                        "id" => "email_edit",

                        "placeholder" => "Email",
                        "label" => "Email",
                        "help" => "Masukan Email Supplier",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "partner_code",
                        "type" => "text",
                        "required" => true,

                        "id" => "partner_code_edit",

                        "placeholder" => "Kode Partner",
                        "label" => "Kode Partner",
                        "help" => "Masukan Kode Partner",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_select", array(
                        "name" => "master_code",
                        "title" => "Tipe Master",

                        "list" => $m_master,
                        "identifier" => "code",
                        "showable" => "name",

                        "id" => "master_code_edit",

                        "manage_url" => base_url("/index.php/setting/system/m_master"),
                        "object_name" => "Master",

                        "selected" => false,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "address_1",
                        "type" => "textarea",
                        "required" => true,

                        "id" => "address_1_edit",

                        "placeholder" => "Alamat 1",
                        "label" => "Alamat 1",
                        "help" => "Masukan Alamat 1",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "address_2",
                        "type" => "textarea",
                        "required" => true,

                        "id" => "address_2_edit",

                        "placeholder" => "Alamat 2",
                        "label" => "Alamat 2",
                        "help" => "Masukan Alamat 2",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "city",
                        "type" => "text",
                        "required" => true,

                        "id" => "city_edit",

                        "placeholder" => "Kota",
                        "label" => "Kota",
                        "help" => "Masukan Kota",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "province",
                        "type" => "text",
                        "required" => true,

                        "id" => "province_edit",

                        "placeholder" => "Provinsi",
                        "label" => "Provinsi",
                        "help" => "Masukan Provinsi",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "zip_code",
                        "type" => "text",
                        "required" => true,

                        "id" => "zip_code_edit",

                        "placeholder" => "Kode Pos",
                        "label" => "Kode Pos",
                        "help" => "Masukan Kode Pos",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "phone",
                        "type" => "text",
                        "required" => true,

                        "id" => "phone_edit",

                        "placeholder" => "Nomor Telepon",
                        "label" => "Nomor Telepon",
                        "help" => "Masukan Nomor Telepon",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "fax",
                        "type" => "text",
                        "required" => false,

                        "id" => "fax_edit",

                        "placeholder" => "Nomor Fax",
                        "label" => "Nomor Fax",
                        "help" => "Masukan Nomor Fax",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "tax_number",
                        "type" => "text",
                        "required" => true,

                        "id" => "tax_number_edit",

                        "placeholder" => "Nomor Pajak (NPWP)",
                        "label" => "Nomor Pajak (NPWP)",
                        "help" => "Masukan NPWP",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "tax_address",
                        "type" => "textarea",
                        "required" => false,

                        "id" => "tax_address_edit",

                        "placeholder" => "Alamat Pajak",
                        "label" => "Alamat Pajak",
                        "help" => "Masukan Alamat Pajak",

                        "value" => false
                    ), true); ?>
                </div>
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/button/submit", "", true); ?>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="<?= base_url("/index.php/api/delete_supplier") ?>" method="POST" class="modal-content">
            <input type="hidden" name="id" id="id_delete">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="m-0">anda akan menghapus data supplier <span id="name_delete"></span> (<span id="code_delete"></span>)</p>
                <small class="m-0 text-info">Seluruh data yang terkait dengan supplier ini tidak akan ikut terhapus</small>
            </div>
            <div class="modal-footer">
                <button type="submit" name="delete" class="btn btn-danger mr-2">Hapus</button>
            </div>
        </form>
    </div>
</div>
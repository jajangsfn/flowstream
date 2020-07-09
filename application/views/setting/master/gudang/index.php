<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar Gudang</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_m_warehouse">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="m_warehouse_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cabang</th>
                    <th>Kode Gudang</th>
                    <th>Nama Gudang</th>
                    <th>Alamat</th>
                    <th>Panjang</th>
                    <th>Lebar</th>
                    <th>Kapasitas</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Pembuatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->

<div class="modal fade" id="tambah_m_warehouse" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="<?= base_url("/index.php/api/add_gudang") ?>" method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Gudang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_select", array(
                        "name" => "branch_id",
                        "title" => "Cabang",

                        "list" => $m_branch,
                        "identifier" => "id",
                        "showable" => "name",

                        "manage_url" => base_url("/index.php/setting/master/cabang"),
                        "object_name" => "Cabang",

                        "selected" => false,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "code",
                        "required" => true,
                        "placeholder" => "Masukan Kode Gudang",
                        "type" => "text",
                        "label" => "Kode Gudang:",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "name",
                        "required" => true,
                        "placeholder" => "Masukan Nama Gudang",
                        "type" => "text",
                        "label" => "Nama Gudang:",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "address",
                        "required" => true,
                        "placeholder" => "Masukan Alamat Gudang",
                        "type" => "textarea",
                        "label" => "Alamat Gudang:",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "length",
                        "required" => true,
                        "placeholder" => "Masukan Panjang Gudang",
                        "type" => "number",
                        "label" => "Panjang Gudang:",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "width",
                        "required" => true,
                        "placeholder" => "Masukan Lebar Gudang",
                        "type" => "text",
                        "label" => "Lebar:",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "capacity",
                        "required" => true,
                        "placeholder" => "Masukan Kapasitas Gudang",
                        "type" => "number",
                        "label" => "Kapasitas Gudang:",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "description",
                        "required" => true,
                        "placeholder" => "Masukan Deskripsi Gudang",
                        "type" => "textarea",
                        "label" => "Deskripsi:",

                        "required" => true,
                    ), true); ?>
                </div>
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/button/submit", "", true); ?>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="<?= base_url("/index.php/api/edit_gudang") ?>" method="POST" class="modal-content">
            <input type="hidden" name="id" id="id_edit">
            <div class="modal-header">
                <h5 class="modal-title">Edit Gudang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_select", array(
                        "name" => "branch_id",
                        "title" => "Cabang",

                        "list" => $m_branch,
                        "identifier" => "id",
                        "showable" => "name",
                        
                        "id" => "branch_id_edit",

                        "manage_url" => base_url("/index.php/setting/master/cabang"),
                        "object_name" => "Cabang",

                        "selected" => false,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "code",
                        "required" => true,
                        "placeholder" => "Masukan Kode Gudang",
                        "type" => "text",
                        "label" => "Kode Gudang:",
                        "id" => "code_edit",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "name",
                        "required" => true,
                        "placeholder" => "Masukan Nama Gudang",
                        "type" => "text",
                        "label" => "Nama Gudang:",
                        "id" => "name_edit",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "address",
                        "required" => true,
                        "placeholder" => "Masukan Alamat Gudang",
                        "type" => "textarea",
                        "label" => "Alamat Gudang:",
                        "id" => "address_edit",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "length",
                        "required" => true,
                        "placeholder" => "Masukan Panjang Gudang",
                        "type" => "number",
                        "label" => "Panjang Gudang:",
                        "id" => "length_edit",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "width",
                        "required" => true,
                        "placeholder" => "Masukan Lebar Gudang",
                        "type" => "text",
                        "label" => "Lebar:",
                        "id" => "width_edit",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "capacity",
                        "required" => true,
                        "placeholder" => "Masukan Kapasitas Gudang",
                        "type" => "number",
                        "label" => "Kapasitas Gudang:",
                        "id" => "capacity_edit",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "description",
                        "required" => true,
                        "placeholder" => "Masukan Deskripsi Gudang",
                        "type" => "textarea",
                        "label" => "Deskripsi:",
                        "id" => "description_edit",

                        "required" => true,
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
        <form action="<?= base_url("/index.php/api/delete_gudang") ?>" method="POST" class="modal-content">
            <input type="hidden" name="id" id="id_delete">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Gudang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="m-0">anda akan menghapus data gudang ini</p>
                <small class="m-0 text-info">Seluruh data yang terkait dengan gudang ini tidak akan ikut terhapus</small>
            </div>
            <div class="modal-footer">
                <button type="submit" name="delete" class="btn btn-danger mr-2">Hapus</button>
            </div>
        </form>
    </div>
</div>
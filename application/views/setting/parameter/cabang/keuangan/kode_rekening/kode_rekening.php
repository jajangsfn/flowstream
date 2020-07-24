<!--begin::Card-->
<?php $this->load->view("setting/parameter/cabang/keuangan/component/navigation"); ?>
<div class="card gutter-b card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
                Daftar Akun
            </h3>
        </div>
        <div class="card-toolbar">
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambahAkun">
                <i class="la la-plus"></i>Tambah Akun
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="akun_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Akun</th>
                    <th>Nama Akun</th>
                    <th>Kode Kelompok Akun</th>
                    <th>Akun Parent</th>
                    <th>Tipe Master</th>
                    <th>Membutuhkan Faktur</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->


<div class="modal fade" id="tambahAkun" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form card" method="POST" action="<?= base_url("/index.php/api/add_account") ?>">
                <input type="hidden" name="branch_id" value="<?= $data_branch->id ?>">
                <h3 class="card-header border-0">
                    Tambah Akun
                </h3>
                <div class="card-body row">
                    <div class="col-lg-6">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "acc_code",
                            "type" => "text",
                            "required" => true,

                            "placeholder" => "Kode akun",
                            "label" => "Kode Akun",
                            "help" => "Masukan kode akun",

                            "value" => false
                        ), true); ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "acc_name",
                            "type" => "text",
                            "required" => true,

                            "placeholder" => "Nama akun",
                            "label" => "Nama Akun",
                            "help" => "Masukan nama akun",

                            "value" => false
                        ), true); ?>
                    </div>

                    <div class="col-lg-6">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "group_code",
                            "type" => "text",
                            "required" => true,

                            "placeholder" => "Kelompok kode akun",
                            "label" => "Kelompok kode akun",
                            "help" => "Masukan kelompok kode akun",

                            "value" => false
                        ), true); ?>
                    </div>

                    <div class="col-lg-6">
                        <?= $this->load->view("component/input/flowstream_select", array(
                            "name" => "upr_acc_code",
                            "title" => "Akun Parent",

                            "list" => $parent_accs,
                            "identifier" => "acc_code",
                            "showable" => "acc_code",

                            "manage_url" => false,
                            "object_name" => false,

                            "selected" => false,
                        ), true); ?>
                    </div>

                    <div class="col-12">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "master_type",
                            "type" => "text",
                            "required" => false,

                            "placeholder" => "Tipe Master",
                            "label" => "Masukan tipe master",
                            "help" => "Masukan tipe master",

                            "value" => false
                        ), true); ?>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>Set Aktif</label>
                            <div>
                                <span class="switch">
                                    <label>
                                        <input type="checkbox" checked="checked" name="is_active" />
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Membutuhkan faktur</label>
                            <div>
                                <span class="switch">
                                    <label>
                                        <input type="checkbox" name="inv_required" />
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <?= $this->load->view("component/button/submit", "", true); ?>
                    <?= $this->load->view("component/button/close", "", true); ?>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form card" method="POST" action="<?= base_url("/index.php/api/edit_account") ?>">
                <input type="hidden" name="id" id="id_edit">
                <h3 class="card-header border-0">
                    Ubah Akun
                </h3>
                <div class="card-body row">
                    <div class="col-lg-6">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "data[acc_code]",
                            "type" => "text",
                            "required" => true,

                            "placeholder" => "Kode akun",
                            "label" => "Kode Akun",
                            "help" => "Masukan kode akun",

                            "id" => "acc_code_edit",

                            "value" => false
                        ), true); ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "data[acc_name]",
                            "type" => "text",
                            "required" => true,

                            "placeholder" => "Nama akun",
                            "label" => "Nama Akun",
                            "help" => "Masukan nama akun",

                            "id" => "acc_name_edit",

                            "value" => false
                        ), true); ?>
                    </div>

                    <div class="col-lg-6">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "data[group_code]",
                            "type" => "text",
                            "required" => true,

                            "placeholder" => "Kelompok kode akun",
                            "label" => "Kelompok kode akun",
                            "help" => "Masukan kelompok kode akun",

                            "id" => "group_code_edit",

                            "value" => false
                        ), true); ?>
                    </div>

                    <div class="col-lg-6">
                        <?= $this->load->view("component/input/flowstream_select", array(
                            "name" => "data[upr_acc_code]",
                            "title" => "Akun Parent",

                            "list" => $parent_accs,
                            "identifier" => "acc_code",
                            "showable" => "acc_code",

                            "id" => "upr_acc_code_edit",

                            "manage_url" => false,
                            "object_name" => false,

                            "selected" => false
                        ), true); ?>
                    </div>

                    <div class="col-12">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "data[master_type]",
                            "type" => "text",
                            "required" => false,

                            "placeholder" => "Tipe Master",
                            "label" => "Masukan tipe master",
                            "help" => "Masukan tipe master",

                            "id" => "master_type_edit",

                            "value" => false
                        ), true); ?>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>Set Aktif</label>
                            <div>
                                <span class="switch">
                                    <label>
                                        <input type="checkbox" checked="checked" name="data[is_active]" id="is_active_edit" />
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Membutuhkan faktur</label>
                            <div>
                                <span class="switch">
                                    <label>
                                        <input type="checkbox" name="data[inv_required]" id="inv_required_edit" />
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <?= $this->load->view("component/button/submit", "", true); ?>
                    <?= $this->load->view("component/button/close", "", true); ?>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="<?= base_url("/index.php/api/delete_barang") ?>" method="POST" class="modal-content">
            <input type="hidden" name="id" id="id_hapus">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="m-0">Anda akan menghapus barang <span id="brand_description_hapus"></span></p>
                <small class="m-0 text-info">Data yang menggunakan barang ini tidak akan ikut terhapus</small>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" type="button" data-dismiss="modal">Batalkan</button>
                <button class="btn btn-danger" name="delete" value="delete" type="submit">Konfirmasi</button>
            </div>
        </form>
    </div>
</div>
<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar Cabang</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_m_branch">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="m_branch_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Logo</th>
                    <th>Nama</th>
                    <th>Kode Cabang</th>
                    <th>Pemilik</th>
                    <th>Alamat</th>
                    <th>NPWP</th>
                    <th>Status Pajak</th>
                    <th>Status Online</th>
                    <th class="text-center">Daftar Barang</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->

<div class="modal fade" id="tambah_m_branch" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="<?= base_url("/index.php/api/add_cabang") ?>" method="POST" class="modal-content" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Cabang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-5">
                    <div class="w-100 text-center">
                        <div class="image-input image-input-empty image-input-outline" id="logo" style="background-image: url(<?= base_url("assets/media/users/blank.png") ?>)">
                            <div class="image-input-wrapper"></div>

                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="logo" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="profile_avatar_remove" />
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                        <span class="form-text text-muted">Logo Cabang</span>
                    </div>
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "name",
                        "required" => true,
                        "placeholder" => "Masukan Nama Cabang",
                        "type" => "text",
                        "label" => "Nama:",
                        "id" => "name_add",

                        "required" => true,
                        "value" => false
                    ), true); ?>
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "code",
                        "required" => true,
                        "placeholder" => "Masukan Kode Cabang",
                        "type" => "text",
                        "label" => "Kode Cabang:",
                        "id" => "code_add",

                        "required" => true,
                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-7">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "owner",
                        "required" => true,
                        "placeholder" => "Masukan Pemilik",
                        "type" => "text",
                        "label" => "Pemilik:",
                        "id" => "owner_add",

                        "required" => true,
                        "value" => false
                    ), true); ?>
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "address",
                        "required" => true,
                        "placeholder" => "Masukan Alamat",
                        "type" => "textarea",
                        "label" => "Alamat:",
                        "id" => "address_add",

                        "required" => true,
                        "value" => false
                    ), true); ?>
                    <div class="row">
                        <div class="col">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "npwp",
                                "required" => true,
                                "placeholder" => "Masukan NPWP",
                                "type" => "text",
                                "label" => "NPWP:",
                                "id" => "npwp_add",

                                "required" => true,
                                "value" => false
                            ), true); ?>
                        </div>
                        <div class="col">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "tax_status",
                                "required" => true,
                                "placeholder" => "Masukan Status Pajak",
                                "type" => "number",
                                "label" => "Status Pajak:",
                                "id" => "tax_add",

                                "required" => true,
                                "value" => false
                            ), true); ?>
                        </div>
                    </div>
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
        <form action="<?= base_url("/index.php/api/edit_cabang") ?>" method="POST" class="modal-content" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id_edit">
            <div class="modal-header">
                <h5 class="modal-title">Edit Cabang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-5">
                    <div class="w-100 text-center">
                        <div class="image-input image-input-empty image-input-outline" id="logo_edit" style="background-image: url(<?= base_url("assets/media/users/blank.png") ?>)">
                            <div class="image-input-wrapper" id="logo_placement_edit"></div>

                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="logo" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="profile_avatar_remove" />
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                        <span class="form-text text-muted">Logo Cabang</span>
                    </div>
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "name",
                        "required" => true,
                        "placeholder" => "Masukan Nama Cabang",
                        "type" => "text",
                        "label" => "Nama:",
                        "id" => "name_edit",

                        "required" => true,
                    ), true); ?>
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "code",
                        "required" => true,
                        "placeholder" => "Masukan Kode Cabang",
                        "type" => "text",
                        "label" => "Kode Cabang:",
                        "id" => "code_edit",

                        "required" => true,
                    ), true); ?>
                </div>
                <div class="col-md-7">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "owner",
                        "required" => true,
                        "placeholder" => "Masukan Pemilik Cabang",
                        "type" => "text",
                        "label" => "Pemilik:",
                        "id" => "owner_edit",

                        "required" => true,
                    ), true); ?>
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "address",
                        "required" => true,
                        "placeholder" => "Masukan Alamat Cabang",
                        "type" => "textarea",
                        "label" => "Alamat:",
                        "id" => "address_edit",

                        "required" => true,
                    ), true); ?>
                    <div class="row">
                        <div class="col">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "npwp",
                                "required" => true,
                                "placeholder" => "Masukan NPWP",
                                "type" => "text",
                                "label" => "NPWP:",
                                "id" => "npwp_edit",

                                "required" => true,
                            ), true); ?>
                        </div>
                        <div class="col">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "tax_status",
                                "required" => true,
                                "placeholder" => "Masukan Status Pajak",
                                "type" => "number",
                                "label" => "Status Pajak:",
                                "id" => "tax_edit",

                                "required" => true
                            ), true); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/button/submit", "", true); ?>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="<?= base_url("/index.php/api/delete_cabang") ?>" method="POST" class="modal-content">
            <input type="hidden" name="id" id="id_delete">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus Cabang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="m-0">Anda akan menghapus cabang ini</p>
                <small class="m-0 text-info">Seluruh data yang menggunakan informasi cabang ini tidak akan ikut terhapus</small>
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/input/submit_button", array(
                    "name" => "delete",
                    "variant" => "danger",
                    "text" => "Konfirmasi"
                ), true); ?>
            </div>
        </form>
    </div>
</div>
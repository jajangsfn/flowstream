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
                    <th>Pemilik</th>
                    <th>Alamat</th>
                    <th>NPWP</th>
                    <th>Status Pajak</th>
                    <th>Status Online</th>
                    <th>Tanggal Pembuatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($m_branch); $i++) {
                    $focus = $m_branch[$i]; ?>
                    <tr>
                        <td></td>
                        <td>
                            <img src="<?= base_url("/attachment/$focus->logo") ?>" height="50px" width="50px" class="rounded-circle">
                        </td>
                        <td nowrap="nowrap"><?= $focus->name ?></td>
                        <td><?= $focus->owner ?></td>
                        <td><?= $focus->address ?></td>
                        <td><?= $focus->npwp ?></td>
                        <td><?= $focus->tax_status ?></td>
                        <td><?= $focus->online_status ?></td>
                        <td><?= $focus->created_date ?></td>
                        <td nowrap="nowrap">
                            <?= $this->load->view("component/icon_button/edit", array("id" => $focus->id), true); ?>
                            <?= $this->load->view("component/icon_button/delete", array("id" => $focus->id), true); ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->

<div class="modal fade" id="tambah_m_branch" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content" enctype="multipart/form-data">
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

<?php for ($i = 0; $i < count($m_branch); $i++) {
    $focus = $m_branch[$i]; ?>
    <div class="modal fade" id="edit_<?= $focus->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <form action="<?= current_url() ?>" method="POST" class="modal-content" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $focus->id ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Cabang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-5">
                        <div class="w-100 text-center">
                            <div class="image-input image-input-empty image-input-outline" id="logo_edit_<?= $i ?>" style="background-image: url(<?= base_url("assets/media/users/blank.png") ?>)">
                                <div class="image-input-wrapper" style="background-image: url(<?= base_url("attachment/$focus->logo") ?>)"></div>

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
                            "id" => "name_edit_" . $focus->id,

                            "required" => true,
                            "value" => $focus->name
                        ), true); ?>
                    </div>
                    <div class="col-md-7">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "owner",
                            "required" => true,
                            "placeholder" => "Masukan Pemilik Cabang",
                            "type" => "text",
                            "label" => "Pemilik:",
                            "id" => "owner_edit_" . $focus->id,

                            "required" => true,
                            "value" => $focus->owner
                        ), true); ?>
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "address",
                            "required" => true,
                            "placeholder" => "Masukan Alamat Cabang",
                            "type" => "textarea",
                            "label" => "Alamat:",
                            "id" => "address_edit_" . $focus->id,

                            "required" => true,
                            "value" => $focus->address
                        ), true); ?>
                        <div class="row">
                            <div class="col">
                                <?= $this->load->view("component/input/flowstream_input", array(
                                    "name" => "npwp",
                                    "required" => true,
                                    "placeholder" => "Masukan NPWP",
                                    "type" => "text",
                                    "label" => "NPWP:",
                                    "id" => "npwp_edit_" . $focus->id,

                                    "required" => true,
                                    "value" => $focus->npwp
                                ), true); ?>
                            </div>
                            <div class="col">
                                <?= $this->load->view("component/input/flowstream_input", array(
                                    "name" => "tax_status",
                                    "required" => true,
                                    "placeholder" => "Masukan Status Pajak",
                                    "type" => "number",
                                    "label" => "Status Pajak:",
                                    "id" => "tax_edit_" . $focus->id,

                                    "required" => true,
                                    "value" => $focus->tax_status
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
    <?= $this->load->view("component/modal/delete", array(
        "id" => $focus->id,
        "object_name" => "Branch",
        "detail" => "anda akan menghapus cabang $focus->name",
        "subdetail" => "Seluruh data yang terkait dengan cabang ini tidak akan ikut terhapus"
    ), true); ?>
<?php } ?>
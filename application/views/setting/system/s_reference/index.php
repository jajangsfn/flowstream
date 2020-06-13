<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar S_Reference</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_s_reference">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="s_reference_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Branch</th>
                    <th>Group Data</th>
                    <th>Detail Data</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($s_reference); $i++) {
                    $focus = $s_reference[$i]; ?>
                    <tr>
                        <td></td>
                        <td><?= $focus->branch_name ?></td>
                        <td nowrap="nowrap"><?= $focus->group_data ?></td>
                        <td><?= $focus->detail_data ?></td>
                        <td nowrap="nowrap">
                            <!-- Button trigger modal-->
                            <button type="button" class="btn btn-icon btn-sm btn-light-success" data-toggle="modal" data-target="#edit_<?= $focus->id ?>">
                                <i class="flaticon2-pen"></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-sm btn-light-danger" data-toggle="modal" data-target="#delete_<?= $focus->id ?>">
                                <i class="flaticon2-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->

<div class="modal fade" id="tambah_s_reference" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content">
            <input type="hidden" name="back" value="<?= current_url() ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Reference</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <?= $this->load->view("component/input/flowstream_select", array(
                        "title" => "Branch:",
                        "name" => "branch_id",
                        "list" => $m_branch,
                        "identifier" => "id",
                        "showable" => "name",
                        "manage_url" => base_url("/index.php/setting/system/m_branch"),
                        "object_name" => "Branch",

                        "selected" => false
                    ), true); ?>
                    <div class="form-group">
                        <label>Group Data:</label>
                        <div class="typeahead">
                            <input type="text" name="group_data" class="form-control w-100 group_data_suggest" placeholder="Enter Group Data" required />
                        </div>
                    </div>
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "detail_data",
                        "required" => true,
                        "placeholder" => "Enter Detail Data",
                        "type" => "text",
                        "label" => "Detail Data:",

                        "id" => false,
                    ), true); ?>
                </div>
                <div class="modal-footer">
                    <?= $this->load->view("component/input/submit_button", array(
                        "variant" => "primary",
                        "name" => null,
                        "text" => "Send"
                    ), true); ?>
                </div>
            </div>
        </form>
    </div>
</div>

<?php for ($i = 0; $i < count($s_reference); $i++) {
    $focus = $s_reference[$i]; ?>
    <div class="modal fade" id="edit_<?= $focus->id ?>" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="<?= current_url() ?>" method="POST" class="modal-content">
                <input type="hidden" name="back" value="<?= current_url() ?>">
                <input type="hidden" name="id" value="<?= $focus->id ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Reference</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <?= $this->load->view("component/input/flowstream_select", array(
                            "title" => "Branch:",
                            "name" => "branch_id",
                            "list" => $m_branch,
                            "identifier" => "id",
                            "showable" => "name",
                            "manage_url" => base_url("/index.php/setting/system/m_branch"),
                            "object_name" => "Branch",

                            "selected" => $focus->branch_id,
                            "not_found_value" => $focus->branch_id,
                            "not_found_showable" => $focus->branch_name
                        ), true); ?>
                        <div class="form-group">
                            <label>Group Data:</label>
                            <div class="typeahead">
                                <input type="text" name="group_data" class="form-control w-100 group_data_suggest" placeholder="Enter Group Data" required value="<?= $focus->group_data ?>" />
                            </div>
                        </div>
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "detail_data",
                            "required" => true,
                            "placeholder" => "Enter Detail Data",
                            "type" => "text",
                            "label" => "Detail Data:",
                            "value" => $focus->detail_data
                        ), true); ?>
                    </div>
                    <div class="modal-footer">
                        <?= $this->load->view("component/input/submit_button", array(
                            "variant" => "primary",
                            "name" => null,
                            "text" => "Send"
                        ), true); ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?= $this->load->view("component/modal/delete", array(
        "id" => $focus->id,
        "object_name" => "Reference",
        "detail" => "anda akan menghapus referensi $focus->detail_data",
        "subdetail" => "Seluruh data yang menggunakan referensi ini tidak akan ikut terhapus"
    ), true); ?>
<?php } ?>
<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar purchase_order</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_purchase_order">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="purchase_order_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cabang</th>
                    <th>Salesman</th>
                    <th>Nomor PO</th>
                    <th>Nomor Referensi</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($purchase_order); $i++) {
                    $focus = $purchase_order[$i]; ?>
                    <tr>
                        <td></td>
                        <td nowrap="nowrap"><?= $focus->branch_name ?></td>
                        <td nowrap="nowrap"><?= $focus->salesman_name ?></td>
                        <td><?= $focus->purchase_order_no ?></td>
                        <td><?= $focus->reference_no ?></td>
                        <td><?= $focus->description ?></td>
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

<div class="modal fade" id="tambah_purchase_order" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content">
            <input type="hidden" name="back" value="<?= current_url() ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Purchase Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_select", array(
                        "title" => "Cabang:",
                        "name" => "branch_id",
                        "list" => $m_branch,
                        "identifier" => "id",
                        "showable" => "name",
                        "manage_url" => base_url("/index.php/setting/system/m_branch"),
                        "object_name" => "Branch",

                        "selected" => false,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_select", array(
                        "title" => "Sales:",
                        "name" => "salesman_id",
                        "list" => $m_salesman,
                        "identifier" => "id",
                        "showable" => "name",
                        "manage_url" => base_url("/index.php/setting/system/m_salesman"),
                        "object_name" => "Sales",

                        "selected" => false,
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "purchase_order_no",
                        "required" => true,
                        "placeholder" => "Masukan Nomor PO",
                        "type" => "number",
                        "label" => "Nomor PO:",

                        "value" => false
                    ), true); ?>
                </div>

                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "reference_no",
                        "required" => true,
                        "placeholder" => "Masukan Nomor Referensi",
                        "type" => "number",
                        "label" => "Nomor Referensi:",

                        "value" => false
                    ), true); ?>
                </div>

                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "description",
                        "required" => true,
                        "placeholder" => "Masukan Deskripsi",
                        "type" => "text",
                        "label" => "Deskripsi:",

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

<?php for ($i = 0; $i < count($purchase_order); $i++) {
    $focus = $purchase_order[$i]; ?>
    <div class="modal fade" id="edit_<?= $focus->id ?>" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <form action="<?= current_url() ?>" method="POST" class="modal-content">
                <input type="hidden" name="back" value="<?= current_url() ?>">
                <input type="hidden" name="id" value="<?= $focus->id ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Event Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body row">
                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_select", array(
                                "title" => "Cabang:",
                                "name" => "branch_id",
                                "list" => $m_branch,
                                "identifier" => "id",
                                "showable" => "name",
                                "manage_url" => base_url("/index.php/setting/system/m_branch"),
                                "object_name" => "Branch",

                                "selected" => $focus->branch_id,
                                "not_found_showable" => $focus->branch_name
                            ), true); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_select", array(
                                "title" => "Sales:",
                                "name" => "salesman_id",
                                "list" => $m_salesman,
                                "identifier" => "id",
                                "showable" => "name",
                                "manage_url" => base_url("/index.php/setting/system/m_salesman"),
                                "object_name" => "Sales",

                                "selected" => $focus->salesman_id,
                                "not_found_showable" => $focus->salesman_name
                            ), true); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "purchase_order_no",
                                "required" => true,
                                "placeholder" => "Masukan Nomor PO",
                                "type" => "number",
                                "label" => "Nomor PO:",

                                "value" => $focus->purchase_order_no
                            ), true); ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "reference_no",
                                "required" => true,
                                "placeholder" => "Masukan Nomor Referensi",
                                "type" => "number",
                                "label" => "Nomor Referensi:",

                                "value" => $focus->reference_no
                            ), true); ?>
                        </div>

                        <div class="col-md-12">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "description",
                                "required" => true,
                                "placeholder" => "Masukan Deskripsi",
                                "type" => "text",
                                "label" => "Deskripsi:",

                                "value" => $focus->description
                            ), true); ?>
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
        "object_name" => "PO",
        "detail" => "anda akan menghapus PO ini",
        "subdetail" => "Referensi PO ini pada data lain tidak akan ikut terhapus"
    ), true); ?>

<?php } ?>
<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar M_Unit</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_m_unit">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="m_unit_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($m_unit); $i++) {
                    $focus = $m_unit[$i]; ?>
                    <tr>
                        <td></td>
                        <td nowrap="nowrap"><?= $focus->name ?></td>
                        <td><?= $focus->quantity ?></td>
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

<div class="modal fade" id="tambah_m_unit" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content">
            <input type="hidden" name="back" value="<?= current_url() ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "name",
                        "required" => true,
                        "placeholder" => "Enter Nama Unit",
                        "type" => "text",
                        "label" => "Name:",

                        "required" => true,
                        "value" => false
                    ), true); ?>

                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "quantity",
                        "required" => true,
                        "placeholder" => "Enter Quantity",
                        "type" => "number",
                        "label" => "Quantity:",

                        "required" => true,
                        "value" => false
                    ), true); ?>
                </div>
                <div class="modal-footer">
                    <?= $this->load->view("component/button/submit", "", true); ?>
                </div>
            </div>
        </form>
    </div>
</div>

<?php for ($i = 0; $i < count($m_unit); $i++) {
    $focus = $m_unit[$i]; ?>
    <div class="modal fade" id="edit_<?= $focus->id ?>" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="<?= current_url() ?>" method="POST" class="modal-content">
                <input type="hidden" name="back" value="<?= current_url() ?>">
                <input type="hidden" name="id" value="<?= $focus->id ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "name",
                            "required" => true,
                            "placeholder" => "Enter Nama Unit",
                            "type" => "text",
                            "label" => "Name:",

                            "required" => true,
                            "value" => $focus->name
                        ), true); ?>

                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "quantity",
                            "required" => true,
                            "placeholder" => "Enter Quantity",
                            "type" => "number",
                            "label" => "Quantity:",

                            "required" => true,
                            "value" => $focus->quantity
                        ), true); ?>
                    </div>
                    <div class="modal-footer">
                        <?php $this->load->view("component/input/submit_button", array(
                            "variant" => "danger",
                            "text" => "delete",
                            "name" => false
                        ), true); ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?= $this->load->view("component/modal/delete", array(
        "id" => $focus->id,
        "object_name" => "Unit",
        "detail" => "anda akan menghapus unit $focus->name",
        "subdetail" => "Seluruh data yang menggunakan referensi ini tidak akan ikut terhapus"
    ), true); ?>

<?php } ?>
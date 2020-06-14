<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar delivery_cost</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_delivery_cost">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="delivery_cost_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Delivery Name</th>
                    <th>Delivery Order No</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($delivery_cost); $i++) {
                    $focus = $delivery_cost[$i]; ?>
                    <tr>
                        <td></td>
                        <td nowrap><?= $focus->name ?></td>
                        <td nowrap><?= $focus->delivery_no ?></td>
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

<div class="modal fade" id="tambah_delivery_cost" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content">
            <input type="hidden" name="back" value="<?= current_url() ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Delivery Cost</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-12">
                    <?= $this->load->view("component/input/flowstream_select", array(
                        "title" => "Delivery:",
                        "name" => "delivery_id",
                        "list" => $m_delivery,
                        "identifier" => "id",
                        "showable" => "name",
                        "manage_url" => base_url("/index.php/setting/system/m_delivery"),
                        "object_name" => "Delivery",

                        "selected" => false
                    ), true); ?>
                </div>
                <div class="col-12">
                    <?= $this->load->view("component/input/flowstream_select", array(
                        "title" => "Delivery Order:",
                        "name" => "delivery_order_id",
                        "list" => $delivery_order,
                        "identifier" => "id",
                        "showable" => "delivery_no",
                        "manage_url" => base_url("/index.php/setting/system/delivery_order"),
                        "object_name" => "Delivery Order",

                        "selected" => false
                    ), true); ?>
                </div>
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/button/submit", "", true); ?>
            </div>
        </form>
    </div>
</div>

<?php for ($i = 0; $i < count($delivery_cost); $i++) {
    $focus = $delivery_cost[$i]; ?>
    <div class="modal fade" id="edit_<?= $focus->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <form action="<?= current_url() ?>" method="POST" class="modal-content">
                <input type="hidden" name="back" value="<?= current_url() ?>">
                <input type="hidden" name="id" value="<?= $focus->id ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Salesman Map</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-12">
                        <?= $this->load->view("component/input/flowstream_select", array(
                            "title" => "Delivery:",
                            "name" => "delivery_id",
                            "list" => $m_delivery,
                            "identifier" => "id",
                            "showable" => "name",
                            "manage_url" => base_url("/index.php/setting/system/m_delivery"),
                            "object_name" => "Delivery",

                            "selected" => $focus->delivery_id,
                            "not_found_showable" => $focus->name
                        ), true); ?>
                    </div>
                    <div class="col-12">
                        <?= $this->load->view("component/input/flowstream_select", array(
                            "title" => "Delivery Order:",
                            "name" => "delivery_order_id",
                            "list" => $delivery_order,
                            "identifier" => "id",
                            "showable" => "delivery_no",
                            "manage_url" => base_url("/index.php/setting/system/delivery_order"),
                            "object_name" => "Delivery Order",

                            "selected" => $focus->delivery_order_id,
                            "not_found_showable" => $focus->delivery_no
                        ), true); ?>
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
        "object_name" => "Delivery Order",
        "detail" => "anda akan menghapus delivery order untuk $focus->name",
        "subdetail" => "Seluruh data yang menggunakan delivery order <span class='text-danger'>akan</span> ikut terhapus"
    ), true); ?>

<?php } ?>
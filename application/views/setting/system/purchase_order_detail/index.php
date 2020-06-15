<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar purchase_order_detail</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_purchase_order_detail">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="purchase_order_detail_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor PO</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($purchase_order_detail); $i++) {
                    $focus = $purchase_order_detail[$i]; ?>
                    <tr>
                        <td></td>
                        <td nowrap="nowrap"><?= $focus->po_no ?></td>
                        <td nowrap="nowrap"><?= $focus->goods_name ?></td>
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

<div class="modal fade" id="tambah_purchase_order_detail" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content">
            <input type="hidden" name="back" value="<?= current_url() ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Purchase Order Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_select", array(
                        "title" => "PO:",
                        "name" => "purchase_order_id",
                        "list" => $purchase_order,
                        "identifier" => "id",
                        "showable" => "purchase_order_no",
                        "manage_url" => base_url("/index.php/setting/system/purchase_order"),
                        "object_name" => "PO",

                        "selected" => false,
                    ), true); ?>
                </div>
                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_select", array(
                        "title" => "Barang:",
                        "name" => "goods_id",
                        "list" => $m_goods,
                        "identifier" => "id",
                        "showable" => "name",
                        "manage_url" => base_url("/index.php/setting/system/m_goods"),
                        "object_name" => "Barang",

                        "selected" => false,
                    ), true); ?>
                </div>
                <div class="col-md-12">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "quantity",
                        "required" => true,
                        "placeholder" => "Masukan Jumlah Barang",
                        "type" => "number",
                        "label" => "Jumlah Barang:",

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

<?php for ($i = 0; $i < count($purchase_order_detail); $i++) {
    $focus = $purchase_order_detail[$i]; ?>
    <div class="modal fade" id="edit_<?= $focus->id ?>" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
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
                        <div class="col-md-12">
                            <?= $this->load->view("component/input/flowstream_select", array(
                                "title" => "PO:",
                                "name" => "purchase_order_id",
                                "list" => $purchase_order,
                                "identifier" => "id",
                                "showable" => "purchase_order_no",
                                "manage_url" => base_url("/index.php/setting/system/purchase_order"),
                                "object_name" => "PO",

                                "selected" => $focus->purchase_order_id,
                                "not_found_showable" => $focus->po_no
                            ), true); ?>
                        </div>
                        <div class="col-md-12">
                            <?= $this->load->view("component/input/flowstream_select", array(
                                "title" => "Barang:",
                                "name" => "goods_id",
                                "list" => $m_goods,
                                "identifier" => "id",
                                "showable" => "name",
                                "manage_url" => base_url("/index.php/setting/system/m_goods"),
                                "object_name" => "Barang",

                                "selected" => $focus->goods_id,
                                "not_found_showable" => $focus->goods_name
                            ), true); ?>
                        </div>
                        <div class="col-md-12">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "quantity",
                                "required" => true,
                                "placeholder" => "Masukan Jumlah Barang",
                                "type" => "number",
                                "label" => "Jumlah Barang:",

                                "value" => $focus->quantity
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
        "object_name" => "Detail PO",
        "detail" => "anda akan menghapus Detail PO ini",
        "subdetail" => "Referensi PO ini pada data lain tidak akan ikut terhapus"
    ), true); ?>

<?php } ?>
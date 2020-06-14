<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar m_event_detail</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_m_event_detail">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="m_event_detail_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Event</th>
                    <th>Promo</th>
                    <th>Goods</th>
                    <th>Quantity</th>
                    <th>Multiple Flag</th>
                    <th>Percentage</th>
                    <th>Price</th>
                    <th>Free Goods</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($m_event_detail); $i++) {
                    $focus = $m_event_detail[$i]; ?>
                    <tr>
                        <td></td>
                        <td nowrap="nowrap"><?= $focus->event_name ?></td>
                        <td nowrap="nowrap"><?= $focus->promo_name ?></td>
                        <td><?= $focus->goods_name ?></td>
                        <td><?= $focus->quantity ?></td>
                        <td><?= $focus->multiple_flag ?></td>
                        <td><?= $focus->percentage ?></td>
                        <td><?= $focus->price ?></td>
                        <td><?= $focus->free_goods ?></td>
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

<div class="modal fade" id="tambah_m_event_detail" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content">
            <input type="hidden" name="back" value="<?= current_url() ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Event Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_select", array(
                        "title" => "Event:",
                        "name" => "event_id",
                        "list" => $m_event,
                        "identifier" => "id",
                        "showable" => "name",
                        "manage_url" => base_url("/index.php/setting/system/m_event"),
                        "object_name" => "Event",

                        "selected" => false,
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_select", array(
                        "title" => "Promo:",
                        "name" => "promo_id",
                        "list" => $m_promo,
                        "identifier" => "id",
                        "showable" => "name",
                        "manage_url" => base_url("/index.php/setting/system/m_promo"),
                        "object_name" => "Promo",

                        "selected" => false,
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_select", array(
                        "title" => "Goods:",
                        "name" => "goods_id",
                        "list" => $m_goods,
                        "identifier" => "id",
                        "showable" => "name",
                        "manage_url" => base_url("/index.php/setting/master/barang"),
                        "object_name" => "Goods",

                        "selected" => false,
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "quantity",
                        "required" => true,
                        "placeholder" => "Masukan Quantity",
                        "type" => "number",
                        "label" => "Quantity:",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "multiple_flag",
                        "required" => true,
                        "placeholder" => "Masukan Multiple Flag",
                        "type" => "number",
                        "label" => "Multiple Flag:",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-4">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "percentage",
                        "required" => true,
                        "placeholder" => "Masukan Persentase",
                        "type" => "number",
                        "label" => "Persentase:",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "price",
                        "required" => true,
                        "placeholder" => "Masukan Harga",
                        "type" => "number",
                        "label" => "Harga:",

                        "value" => false
                    ), true); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->load->view("component/input/flowstream_input", array(
                        "name" => "free_goods",
                        "required" => true,
                        "placeholder" => "Masukan Barang Gratis",
                        "type" => "text",
                        "label" => "Barang Gratis:",

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

<?php for ($i = 0; $i < count($m_event_detail); $i++) {
    $focus = $m_event_detail[$i]; ?>
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
                        <div class="col-md-4">
                            <?= $this->load->view("component/input/flowstream_select", array(
                                "title" => "Event:",
                                "name" => "event_id",
                                "list" => $m_event,
                                "identifier" => "id",
                                "showable" => "name",
                                "manage_url" => base_url("/index.php/setting/system/m_event"),
                                "object_name" => "Event",

                                "selected" => $focus->event_id,
                                "not_found_showable" => $focus->event_name
                            ), true); ?>
                        </div>
                        <div class="col-md-4">
                            <?= $this->load->view("component/input/flowstream_select", array(
                                "title" => "Promo:",
                                "name" => "promo_id",
                                "list" => $m_promo,
                                "identifier" => "id",
                                "showable" => "name",
                                "manage_url" => base_url("/index.php/setting/system/m_promo"),
                                "object_name" => "Promo",

                                "selected" => $focus->promo_id,
                                "not_found_showable" => $focus->promo_name
                            ), true); ?>
                        </div>
                        <div class="col-md-4">
                            <?= $this->load->view("component/input/flowstream_select", array(
                                "title" => "Goods:",
                                "name" => "goods_id",
                                "list" => $m_goods,
                                "identifier" => "id",
                                "showable" => "name",
                                "manage_url" => base_url("/index.php/setting/master/barang"),
                                "object_name" => "Goods",

                                "selected" => $focus->goods_id,
                                "not_found_showable" => $focus->goods_name
                            ), true); ?>
                        </div>
                        <div class="col-md-4">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "quantity",
                                "required" => true,
                                "placeholder" => "Masukan Quantity",
                                "type" => "number",
                                "label" => "Quantity:",

                                "value" => $focus->quantity
                            ), true); ?>
                        </div>
                        <div class="col-md-4">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "multiple_flag",
                                "required" => true,
                                "placeholder" => "Masukan Multiple Flag",
                                "type" => "number",
                                "label" => "Multiple Flag:",

                                "value" => $focus->multiple_flag
                            ), true); ?>
                        </div>
                        <div class="col-md-4">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "percentage",
                                "required" => true,
                                "placeholder" => "Masukan Persentase",
                                "type" => "number",
                                "label" => "Persentase:",

                                "value" => $focus->percentage
                            ), true); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "price",
                                "required" => true,
                                "placeholder" => "Masukan Harga",
                                "type" => "number",
                                "label" => "Harga:",

                                "value" => $focus->price
                            ), true); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "free_goods",
                                "required" => true,
                                "placeholder" => "Masukan Barang Gratis",
                                "type" => "text",
                                "label" => "Barang Gratis:",

                                "value" => $focus->free_goods
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
        "object_name" => "Event Detail",
        "detail" => "anda akan menghapus event detail ini",
        "subdetail" => "Referensi event detail ini pada data lain akan ikut terhapus"
    ), true); ?>

<?php } ?>
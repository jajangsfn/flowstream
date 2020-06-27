<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
                <?= $this->lang->line("general_list_goods"); ?>
            </h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambahMasterBarangModal">
                <i class="la la-plus"></i><?= $this->lang->line("general_add"); ?>
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="master_barang_table">
            <thead>
                <tr>
                    <th><?= $this->lang->line("general_number"); ?></th>
                    <th><?= $this->lang->line("general_name"); ?></th>
                    <th><?= $this->lang->line("general_barcode"); ?></th>
                    <th><?= $this->lang->line("general_sku"); ?></th>
                    <th><?= $this->lang->line("general_plu"); ?></th>
                    <th><?= $this->lang->line("general_division"); ?></th>
                    <th><?= $this->lang->line("general_subdivision"); ?></th>
                    <th><?= $this->lang->line("general_category"); ?></th>
                    <th><?= $this->lang->line("general_subcategory"); ?></th>
                    <th><?= $this->lang->line("general_package"); ?></th>
                    <th><?= $this->lang->line("general_color"); ?></th>
                    <th><?= $this->lang->line("general_unit"); ?></th>
                    <th><?= $this->lang->line("general_hpp"); ?></th>
                    <th><?= $this->lang->line("general_quantity"); ?></th>
                    <th><?= $this->lang->line("general_tax"); ?></th>
                    <th><?= $this->lang->line("general_action"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($list_barang); $i++) {
                    $barang = $list_barang[$i]; ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td nowrap="nowrap"><?= $barang->name ?></td>
                        <td><?= $barang->barcode ?></td>
                        <td><?= $barang->sku_code ?></td>
                        <td><?= $barang->plu_code ?></td>
                        <td><?= $barang->division ?></td>
                        <td><?= $barang->sub_division ?></td>
                        <td><?= $barang->category ?></td>
                        <td><?= $barang->sub_category ?></td>
                        <td><?= $barang->package ?></td>
                        <td><?= $barang->color ?></td>
                        <td><?= $barang->unit ?></td>
                        <td><?= $barang->hpp ?></td>
                        <td><?= $barang->quantity ?></td>
                        <td><?= $barang->tax ?></td>
                        <td nowrap="nowrap">
                            <?= $this->load->view("component/icon_button/edit", array("id" => $barang->id), true); ?>
                            <?= $this->load->view("component/icon_button/delete", array("id" => $barang->id), true); ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->

<!-- Modal-->
<div class="modal fade" id="tambahMasterBarangModal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form card" method="POST" action="<?= current_url() ?>">
                <div class="card-header">
                    <?= $this->lang->line("general_add"); ?> Master Data <?= $this->lang->line("object_goods"); ?>
                </div>
                <div class="card-body row">
                    <div class="col-md-6">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "name",
                            "type" => "text",
                            "required" => true,

                            "placeholder" => $this->lang->line("placeholders_add_goods_name"),
                            "label" => $this->lang->line("label_add_goods_name"),
                            "help" => $this->lang->line("help_add_goods_name"),

                            "value" => false
                        ), true); ?>
                    </div>

                    <div class="col-md-6">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "barcode",
                            "type" => "number",
                            "required" => true,

                            "placeholder" => $this->lang->line("placeholders_add_goods_barcode"),
                            "label" => $this->lang->line("label_add_goods_barcode"),
                            "help" => $this->lang->line("help_add_goods_barcode"),

                            "value" => false
                        ), true); ?>
                    </div>

                    <div class="col-md-6">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "sku_code",
                            "type" => "text",
                            "required" => true,

                            "placeholder" => $this->lang->line("placeholders_add_goods_sku"),
                            "label" => $this->lang->line("label_add_goods_sku"),
                            "help" => $this->lang->line("help_add_goods_sku"),

                            "value" => false
                        ), true); ?>
                    </div> 

                    <div class="col-md-6">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "plu_code",
                            "type" => "text",
                            "required" => true,

                            "placeholder" => $this->lang->line("placeholders_add_goods_plu"),
                            "label" => $this->lang->line("label_add_goods_plu"),
                            "help" => $this->lang->line("help_add_goods_plu"),

                            "value" => false
                        ), true); ?>
                    </div>

                    <div class="col-md-12 py-5">
                        <hr />
                    </div>

                    <div class="col-md-6">
                        <?= $this->load->view("component/input/flowstream_select", array(
                            "name" => "division",
                            "title" => $this->lang->line("general_division"),

                            "list" => $division,
                            "identifier" => "id",
                            "showable" => "detail_data",

                            "manage_url" => base_url("/index.php/setting/system/s_reference"),
                            "object_name" => $this->lang->line("general_division"),

                            "selected" => false,
                        ), true); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->load->view("component/input/flowstream_select", array(
                            "name" => "sub_division",
                            "title" => $this->lang->line("general_subdivision"),

                            "list" => $division,
                            "identifier" => "id",
                            "showable" => "detail_data",

                            "manage_url" => base_url("/index.php/setting/system/s_reference"),
                            "object_name" => $this->lang->line("general_division"),

                            "selected" => false,
                        ), true); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->load->view("component/input/flowstream_select", array(
                            "name" => "category",
                            "title" => $this->lang->line("general_category"),

                            "list" => $category,
                            "identifier" => "id",
                            "showable" => "detail_data",

                            "manage_url" => base_url("/index.php/setting/system/s_reference"),
                            "object_name" => $this->lang->line("general_category"),

                            "selected" => false,
                        ), true); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->load->view("component/input/flowstream_select", array(
                            "name" => "sub_category",
                            "title" => $this->lang->line("general_subcategory"),

                            "list" => $category,
                            "identifier" => "id",
                            "showable" => "detail_data",

                            "manage_url" => base_url("/index.php/setting/system/s_reference"),
                            "object_name" => $this->lang->line("general_category"),

                            "selected" => false,
                        ), true); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->load->view("component/input/flowstream_select", array(
                            "name" => "package",
                            "title" => $this->lang->line("general_package"),

                            "list" => $package,
                            "identifier" => "id",
                            "showable" => "detail_data",

                            "manage_url" => base_url("/index.php/setting/system/s_reference"),
                            "object_name" => $this->lang->line("general_package"),

                            "selected" => false,
                        ), true); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->load->view("component/input/flowstream_select", array(
                            "name" => "color",
                            "title" => $this->lang->line("general_color"),

                            "list" => $package,
                            "identifier" => "id",
                            "showable" => "detail_data",

                            "manage_url" => base_url("/index.php/setting/system/s_reference"),
                            "object_name" => $this->lang->line("general_color"),

                            "selected" => false,
                        ), true); ?>
                    </div>

                    <div class="col-md-12 py-5">
                        <hr />
                    </div>

                    <div class="col-md-6">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "hpp",
                            "type" => "number",
                            "required" => true,

                            "placeholder" => $this->lang->line("placeholders_add_goods_hpp"),
                            "label" => $this->lang->line("label_add_goods_hpp"),
                            "help" => $this->lang->line("help_add_goods_hpp"),

                            "value" => false
                        ), true); ?>
                    </div>

                    <div class="col-md-6">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "tax",
                            "type" => "number",
                            "required" => true,

                            "placeholder" => $this->lang->line("placeholders_add_goods_tax"),
                            "label" => $this->lang->line("label_add_goods_tax"),
                            "help" => $this->lang->line("help_add_goods_tax"),

                            "value" => false
                        ), true); ?>
                    </div>

                    <div class="col-md-6">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "quantity",
                            "type" => "number",
                            "required" => true,

                            "placeholder" => $this->lang->line("placeholders_quantity"),
                            "label" => $this->lang->line("label_quantity"),
                            "help" => $this->lang->line("help_quantity"),

                            "value" => false
                        ), true); ?>
                    </div>

                    <div class="col-md-6">
                        <?= $this->load->view("component/input/flowstream_select", array(
                            "name" => "unit",
                            "title" => $this->lang->line("general_unit"),

                            "list" => $unit,
                            "identifier" => "id",
                            "showable" => "name",

                            "manage_url" => base_url("/index.php/setting/system/m_unit"),
                            "object_name" => $this->lang->line("general_unit"),

                            "selected" => false,
                        ), true); ?>
                    </div>

                    <div class="col-md-12">
                        <?= $this->load->view("component/input/flowstream_input", array(
                            "name" => "rekening_no",
                            "type" => "number",
                            "required" => true,

                            "placeholder" => $this->lang->line("placeholders_add_goods_rekening_no"),
                            "label" => $this->lang->line("label_add_goods_rekening_no"),
                            "help" => $this->lang->line("help_add_goods_rekening_no"),

                            "value" => "1"
                        ), true); ?>
                    </div>
                </div>
                <div class="card-footer">
                    <?= $this->load->view("component/button/submit", "", true); ?>
                    <?= $this->load->view("component/button/close", "", true); ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php for ($i = 0; $i < count($list_barang); $i++) {
    $barang = $list_barang[$i]; ?>
    <div class="modal fade" id="edit_<?= $barang->id ?>" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form card" method="POST" action="<?= current_url() ?>">
                    <input type="hidden" value="<?= $barang->id ?>" name="id">
                    <div class="card-header">
                        <?= $this->lang->line("modal_edit_goods") ?>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "name",
                                "type" => "text",
                                "required" => true,

                                "placeholder" => $this->lang->line("placeholders_add_goods_name"),
                                "label" => $this->lang->line("label_add_goods_name"),
                                "help" => $this->lang->line("help_add_goods_name"),

                                "value" => $barang->name
                            ), true); ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "barcode",
                                "type" => "number",
                                "required" => true,

                                "placeholder" => $this->lang->line("placeholders_add_goods_barcode"),
                                "label" => $this->lang->line("label_add_goods_barcode"),
                                "help" => $this->lang->line("help_add_goods_barcode"),

                                "value" => $barang->barcode
                            ), true); ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "sku_code",
                                "type" => "text",
                                "required" => true,

                                "placeholder" => $this->lang->line("placeholders_add_goods_sku"),
                                "label" => $this->lang->line("label_add_goods_sku"),
                                "help" => $this->lang->line("help_add_goods_sku"),

                                "value" => $barang->sku_code
                            ), true); ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "plu_code",
                                "type" => "text",
                                "required" => true,

                                "placeholder" => $this->lang->line("placeholders_add_goods_plu"),
                                "label" => $this->lang->line("label_add_goods_plu"),
                                "help" => $this->lang->line("help_add_goods_plu"),

                                "value" => $barang->plu_code
                            ), true); ?>
                        </div>

                        <div class="col-md-12 py-5">
                            <hr />
                        </div>

                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_select", array(
                                "name" => "division",
                                "title" => $this->lang->line("general_division"),

                                "list" => $division,
                                "identifier" => "id",
                                "showable" => "detail_data",

                                "manage_url" => base_url("/index.php/setting/system/s_reference"),
                                "object_name" => $this->lang->line("general_division"),

                                "selected" => $barang->division_id,
                                "not_found_showable" => $barang->division
                            ), true); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_select", array(
                                "name" => "sub_division",
                                "title" => $this->lang->line("general_subdivision"),

                                "list" => $division,
                                "identifier" => "id",
                                "showable" => "detail_data",

                                "manage_url" => base_url("/index.php/setting/system/s_reference"),
                                "object_name" => $this->lang->line("general_division"),

                                "selected" => $barang->sub_division_id,
                                "not_found_showable" => $barang->sub_division
                            ), true); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_select", array(
                                "name" => "category",
                                "title" => $this->lang->line("general_category"),

                                "list" => $category,
                                "identifier" => "id",
                                "showable" => "detail_data",

                                "manage_url" => base_url("/index.php/setting/system/s_reference"),
                                "object_name" => $this->lang->line("general_category"),

                                "selected" => $barang->category_id,
                                "not_found_showable" => $barang->category
                            ), true); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_select", array(
                                "name" => "sub_category",
                                "title" => $this->lang->line("general_subcategory"),

                                "list" => $category,
                                "identifier" => "id",
                                "showable" => "detail_data",

                                "manage_url" => base_url("/index.php/setting/system/s_reference"),
                                "object_name" => $this->lang->line("general_category"),

                                "selected" => $barang->sub_category_id,
                                "not_found_showable" => $barang->sub_category
                            ), true); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_select", array(
                                "name" => "package",
                                "title" => $this->lang->line("general_package"),

                                "list" => $package,
                                "identifier" => "id",
                                "showable" => "detail_data",

                                "manage_url" => base_url("/index.php/setting/system/s_reference"),
                                "object_name" => $this->lang->line("general_package"),

                                "selected" => $barang->package_id,
                                "not_found_showable" => $barang->package
                            ), true); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_select", array(
                                "name" => "color",
                                "title" => $this->lang->line("general_color"),

                                "list" => $color,
                                "identifier" => "id",
                                "showable" => "detail_data",

                                "manage_url" => base_url("/index.php/setting/system/s_reference"),
                                "object_name" => $this->lang->line("general_color"),

                                "selected" => $barang->color_id,
                                "not_found_showable" => $barang->color
                            ), true); ?>
                        </div>

                        <div class="col-md-12 py-5">
                            <hr />
                        </div>

                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "hpp",
                                "type" => "number",
                                "required" => true,

                                "placeholder" => $this->lang->line("placeholders_add_goods_hpp"),
                                "label" => $this->lang->line("label_add_goods_hpp"),
                                "help" => $this->lang->line("help_add_goods_hpp"),

                                "value" => $barang->hpp
                            ), true); ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "tax",
                                "type" => "number",
                                "required" => true,

                                "placeholder" => $this->lang->line("placeholders_add_goods_tax"),
                                "label" => $this->lang->line("label_add_goods_tax"),
                                "help" => $this->lang->line("help_add_goods_tax"),

                                "value" => $barang->tax
                            ), true); ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "quantity",
                                "type" => "number",
                                "required" => true,

                                "placeholder" => $this->lang->line("placeholders_quantity"),
                                "label" => $this->lang->line("label_quantity"),
                                "help" => $this->lang->line("help_quantity"),

                                "value" => $barang->quantity
                            ), true); ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->load->view("component/input/flowstream_select", array(
                                "name" => "unit",
                                "title" => $this->lang->line("general_unit"),

                                "list" => $unit,
                                "identifier" => "id",
                                "showable" => "name",

                                "manage_url" => base_url("/index.php/setting/system/m_unit"),
                                "object_name" => $this->lang->line("general_unit"),

                                "selected" => $barang->unit_id,
                                "not_found_showable" => $barang->unit
                            ), true); ?>
                        </div>

                        <div class="col-md-12">
                            <?= $this->load->view("component/input/flowstream_input", array(
                                "name" => "rekening_no",
                                "type" => "number",
                                "required" => true,

                                "placeholder" => $this->lang->line("placeholders_add_goods_rekening_no"),
                                "label" => $this->lang->line("label_add_goods_rekening_no"),
                                "help" => $this->lang->line("help_add_goods_rekening_no"),

                                "value" => $barang->rekening_no
                            ), true); ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?= $this->load->view("component/button/submit", "", true); ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?= $this->load->view("component/modal/delete", array(
        "id" => $barang->id,
        "object_name" => $this->lang->line("object_goods"),
        "detail" =>  $this->lang->line("modal_delete_goods_description"),
        "subdetail" =>  $this->lang->line("modal_delete_goods_subdescription")
    ), true); ?>

<?php } ?>
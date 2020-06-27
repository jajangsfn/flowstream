<?php for ($i = 0; $i < count($list_barang); $i++) {
    $barang = $list_barang[$i]; ?>
    <div class="modal fade" id="edit_<?= $barang->id ?>" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <form class="form card modal-content" method="POST" action="<?= current_url() ?>">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Edit Barang
                    </h5>
                </div>
                <div class="modal-body row">
                    <input type="hidden" value="<?= $barang->id ?>" name="id">
                    <div class="col-lg-6">
                        <div class="row">
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
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
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
                            <div class="col-md-12">
                                <?= $this->load->view("component/input/flowstream_select", array(
                                    "name" => "unit",
                                    "title" => $this->lang->line("general_unit"),

                                    "list" => $unit,
                                    "identifier" => "id",
                                    "showable" => "name",

                                    "manage_url" => base_url("/index.php/setting/master/unit"),
                                    "object_name" => $this->lang->line("general_unit"),

                                    "selected" => $barang->unit_id,
                                    "not_found_showable" => $barang->unit
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
        "id" => $barang->id,
        "object_name" => $this->lang->line("object_goods"),
        "detail" =>  $this->lang->line("modal_delete_goods_description"),
        "subdetail" =>  $this->lang->line("modal_delete_goods_subdescription")
    ), true); ?>

    <div class="modal fade" id="edit_harga_<?= $barang->id ?>" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form class="form modal-content" method="POST" action="<?= current_url() ?>">
                <div class="modal-header">
                    <h5>
                        Ubah Harga Jual Barang
                    </h5>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer text-right">
                    <?= $this->load->view("component/button/submit", "", true); ?>
                    <?= $this->load->view("component/button/close", "", true); ?>
                </div>
            </form>
        </div>
    </div>
<?php } ?>
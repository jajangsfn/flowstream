<div class="modal fade" id="tambahMasterBarangModal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form card" method="POST" action="<?= current_url() ?>">
                <div class="card-header">
                    <?= $this->lang->line("general_add"); ?> Master Data <?= $this->lang->line("object_goods"); ?>
                </div>
                <div class="card-body row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
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

                            <div class="col-lg-6">
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

                            <div class="col-lg-6">
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

                            <div class="col-lg-6">
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
                            <div class="col-lg-6">
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

                            <div class="col-lg-6">
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
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
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
                            <div class="col-lg-6">
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
                            <div class="col-lg-6">
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
                            <div class="col-lg-6">
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
                            <div class="col-lg-6">
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
                            <div class="col-lg-6">
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
                            <div class="col-md-12">
                                <?= $this->load->view("component/input/flowstream_select", array(
                                    "name" => "unit",
                                    "title" => $this->lang->line("general_unit"),

                                    "list" => $unit,
                                    "identifier" => "id",
                                    "showable" => "name",

                                    "manage_url" => base_url("/index.php/setting/master/unit"),
                                    "object_name" => $this->lang->line("general_unit"),

                                    "selected" => false,
                                ), true); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <?= $this->load->view("component/button/submit", "", true); ?>
                    <?= $this->load->view("component/button/close", "", true); ?>
                </div>
            </form>
        </div>
    </div>
</div>
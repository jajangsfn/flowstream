<div class="modal fade" id="tambahMasterBarangModal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form card" method="POST" action="<?= current_url() ?>">
                <h3 class="card-header border-0">
                    Tambah Barang
                </h3>
                <div class="card-body row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_input", array(
                                    "name" => "name",
                                    "type" => "text",
                                    "required" => true,

                                    "placeholder" => "Nama barang",
                                    "label" => "Nama barang",
                                    "help" => "Masukan nama barang",

                                    "value" => false
                                ), true); ?>
                            </div>

                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_input", array(
                                    "name" => "barcode",
                                    "type" => "number",
                                    "required" => true,

                                    "placeholder" => "Barcode",
                                    "label" => "Barcode",
                                    "help" => "Masukan kode barcode untuk barang ini",

                                    "value" => false
                                ), true); ?>
                            </div>

                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_input", array(
                                    "name" => "sku_code",
                                    "type" => "text",
                                    "required" => true,

                                    "placeholder" => "Kode SKU",
                                    "label" => "Kode SKU",
                                    "help" => "Masukan kode SKU untuk barang ini",

                                    "value" => false
                                ), true); ?>
                            </div>

                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_input", array(
                                    "name" => "plu_code",
                                    "type" => "text",
                                    "required" => true,

                                    "placeholder" => "Kode PLU",
                                    "label" => "Kode PLU",
                                    "help" => "Masukan kode PLU untuk abrang ini",

                                    "value" => false
                                ), true); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_input", array(
                                    "name" => "tax",
                                    "type" => "number",
                                    "required" => true,

                                    "placeholder" => "Pajak",
                                    "label" => "Pajak",
                                    "help" => "Masukan persen pajak untuk barang ini",

                                    "value" => false
                                ), true); ?>
                            </div>

                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_input", array(
                                    "name" => "quantity",
                                    "type" => "number",
                                    "required" => true,

                                    "placeholder" => "Jumlah",
                                    "label" => "Jumlah",
                                    "help" => "Masukan jumlah awal barang",

                                    "value" => false
                                ), true); ?>
                            </div>
                            <div class="col-md-12">
                                <?= $this->load->view("component/input/flowstream_input", array(
                                    "name" => "rekening_no",
                                    "type" => "number",
                                    "required" => true,

                                    "placeholder" => "Masukan nomor akun untuk barang ini",
                                    "label" => "Nomor Akun",
                                    "help" => "Masukan nomor rekening",

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
                                    "title" => "Divisi",

                                    "list" => $division,
                                    "identifier" => "id",
                                    "showable" => "detail_data",

                                    "manage_url" => base_url("/index.php/setting/system/s_reference"),
                                    "object_name" => "Divisi",

                                    "selected" => false,
                                ), true); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_select", array(
                                    "name" => "sub_division",
                                    "title" => "Subdivisi",

                                    "list" => $division,
                                    "identifier" => "id",
                                    "showable" => "detail_data",

                                    "manage_url" => base_url("/index.php/setting/system/s_reference"),
                                    "object_name" => "Divisi",

                                    "selected" => false,
                                ), true); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_select", array(
                                    "name" => "category",
                                    "title" => "Kategori",

                                    "list" => $category,
                                    "identifier" => "id",
                                    "showable" => "detail_data",

                                    "manage_url" => base_url("/index.php/setting/system/s_reference"),
                                    "object_name" => "Kategori",

                                    "selected" => false,
                                ), true); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_select", array(
                                    "name" => "sub_category",
                                    "title" => "Subkategori",

                                    "list" => $category,
                                    "identifier" => "id",
                                    "showable" => "detail_data",

                                    "manage_url" => base_url("/index.php/setting/system/s_reference"),
                                    "object_name" => "Kategori",

                                    "selected" => false,
                                ), true); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_select", array(
                                    "name" => "package",
                                    "title" => "Paket",

                                    "list" => $package,
                                    "identifier" => "id",
                                    "showable" => "detail_data",

                                    "manage_url" => base_url("/index.php/setting/system/s_reference"),
                                    "object_name" => "Paket",

                                    "selected" => false,
                                ), true); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_select", array(
                                    "name" => "color",
                                    "title" => "Warna",

                                    "list" => $package,
                                    "identifier" => "id",
                                    "showable" => "detail_data",

                                    "manage_url" => base_url("/index.php/setting/system/s_reference"),
                                    "object_name" => "Warna",

                                    "selected" => false,
                                ), true); ?>
                            </div>
                            <div class="col-md-12">
                                <?= $this->load->view("component/input/flowstream_select", array(
                                    "name" => "unit",
                                    "title" => "Unit",

                                    "list" => $unit,
                                    "identifier" => "id",
                                    "showable" => "name",

                                    "manage_url" => base_url("/index.php/setting/master/unit"),
                                    "object_name" => "Unit",

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
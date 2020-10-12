<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
                Daftar Barang
            </h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <a href="<?= base_url("/index.php/setting/master/cabang/$data_branch->id/barang/harga") ?>" class="btn btn-warning mr-3 font-weight-bolder">
                <i class="la la-money"></i>Atur Harga Barang
            </a>
            <a href="<?= base_url("/index.php/setting/master/cabang/$data_branch->id/barang/diskon") ?>" class="btn btn-warning mr-3 font-weight-bolder">
                <i class="la la-percent"></i>Atur Diskon Barang
            </a>
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambahMasterBarangModal">
                <i class="la la-plus"></i>Tambah Barang
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="master_barang_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Barcode</th>
                    <th>SKU</th>
                    <th>PLU</th>
                    <th>Divisi</th>
                    <th>Kategori</th>
                    <th>Paket</th>
                    <th>Warna</th>
                    <th>Unit</th>
                    <th>HPP</th>
                    <th>Jumlah</th>
                    <th>Pajak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->

<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="<?= base_url("/index.php/flowstream_api/v1/goods/delete_barang") ?>" method="POST" class="modal-content">
            <input type="hidden" name="id" id="id_hapus">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="m-0">Anda akan menghapus barang <span id="brand_description_hapus"></span></p>
                <small class="m-0 text-info">Data yang menggunakan barang ini tidak akan ikut terhapus</small>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" type="button" data-dismiss="modal">Batalkan</button>
                <button class="btn btn-danger" name="delete" value="delete" type="submit">Konfirmasi</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="tambahMasterBarangModal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form card" method="POST" action="<?= base_url("/index.php/flowstream_api/v1/goods/add_barang") ?>">
                <input type="hidden" name="branch_id" value="<?= $data_branch->id ?>">
                <h3 class="card-header border-0">
                    Tambah Barang
                </h3>
                <div class="card-body row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_input", array(
                                    "name" => "brand_name",
                                    "type" => "text",
                                    "required" => true,

                                    "placeholder" => "Nama brand",
                                    "label" => "Nama brand",
                                    "help" => "Masukan nama brand",

                                    "value" => false
                                ), true); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_input", array(
                                    "name" => "brand_description",
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
                                    "required" => false,

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
                                    "required" => false,

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
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_select", array(
                                    "name" => "rekening_no",
                                    "title" => "Kode Akun",

                                    "list" => $accounts,
                                    "identifier" => "acc_code",
                                    "showable" => "acc_name",

                                    "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/kode_rekening"),
                                    "object_name" => "kode akun",

                                    "selected" => false,
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

                                    "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/reference/goods_division"),
                                    "object_name" => "divisi",

                                    "selected" => false,
                                ), true); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_select", array(
                                    "name" => "sub_division",
                                    "title" => "Subdivisi",

                                    "list" => $sub_division,
                                    "identifier" => "id",
                                    "showable" => "detail_data",

                                    "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/reference/goods_sub_division"),
                                    "object_name" => "sub divisi",

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

                                    "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/reference/goods_category"),
                                    "object_name" => "kategori",

                                    "selected" => false,
                                ), true); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_select", array(
                                    "name" => "sub_category",
                                    "title" => "Subkategori",

                                    "list" => $sub_category,
                                    "identifier" => "id",
                                    "showable" => "detail_data",

                                    "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/reference/goods_sub_category"),
                                    "object_name" => "sub kategori",

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

                                    "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/reference/goods_package"),
                                    "object_name" => "paket",

                                    "selected" => false,
                                ), true); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_select", array(
                                    "name" => "color",
                                    "title" => "Warna",

                                    "list" => $color,
                                    "identifier" => "id",
                                    "showable" => "detail_data",

                                    "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/reference/goods_color"),
                                    "object_name" => "warna",

                                    "selected" => false,
                                ), true); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_select", array(
                                    "name" => "unit",
                                    "title" => "Unit",

                                    "list" => $unit,
                                    "identifier" => "id",
                                    "showable" => "name",

                                    "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/unit"),
                                    "object_name" => "unit",

                                    "selected" => false,
                                ), true); ?>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group w-100">
                                    <label class="required">Rasio Penjualan</label>
                                    <select class="form-control select2" name="ratio_flag" required>
                                        <option value="1">per Pieces</option>
                                        <option value="0">per Unit</option>
                                    </select>
                                </div>
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


<div class="modal fade" id="edit_barang" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form card" method="POST" action="<?= base_url("/index.php/flowstream_api/v1/goods/edit_barang") ?>">
                <input type="hidden" name="id" id="id_barang_edit">
                <h3 class="card-header border-0">
                    Ubah Barang
                </h3>
                <div class="card-body row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_input", array(
                                    "name" => "brand_name",
                                    "type" => "text",
                                    "required" => true,

                                    "id" => "brand_name_edit",

                                    "placeholder" => "Nama brand",
                                    "label" => "Nama brand",
                                    "help" => "Masukan nama brand",

                                    "value" => false
                                ), true); ?>
                            </div>

                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_input", array(
                                    "name" => "brand_description",
                                    "type" => "text",
                                    "required" => true,

                                    "id" => "brand_description_edit",

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

                                    "id" => "barcode_edit",

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

                                    "id" => "sku_edit",

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
                                    "required" => false,

                                    "id" => "plu_edit",

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

                                    "id" => "tax_edit",

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

                                    "id" => "quantity_edit",

                                    "placeholder" => "Jumlah",
                                    "label" => "Jumlah",
                                    "help" => "Masukan jumlah awal barang",

                                    "value" => false
                                ), true); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_select", array(
                                    "name" => "rekening_no",
                                    "title" => "Kode Akun",

                                    "list" => $accounts,
                                    "identifier" => "acc_code",
                                    "showable" => "acc_name",

                                    "id" => "rekening_no_edit",

                                    "manage_url" => base_url("/index.php/setting/parameter/cabang/$data_branch->id/keuangan/kode_rekening"),
                                    "object_name" => "kode akun",

                                    "selected" => false,
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

                                    "id" => "division_edit",

                                    "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/reference/goods_division"),
                                    "object_name" => "Divisi",

                                    "selected" => false,
                                ), true); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_select", array(
                                    "name" => "sub_division",
                                    "title" => "Subdivisi",

                                    "list" => $sub_division,
                                    "identifier" => "id",
                                    "showable" => "detail_data",

                                    "id" => "sub_division_edit",

                                    "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/reference/goods_sub_division"),
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

                                    "id" => "category_edit",

                                    "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/reference/goods_category"),
                                    "object_name" => "Kategori",

                                    "selected" => false,
                                ), true); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_select", array(
                                    "name" => "sub_category",
                                    "title" => "Subkategori",

                                    "list" => $sub_category,
                                    "identifier" => "id",
                                    "showable" => "detail_data",

                                    "id" => "sub_category_edit",

                                    "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/reference/goods_sub_category"),
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

                                    "id" => "package_edit",

                                    "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/reference/goods_package"),
                                    "object_name" => "Paket",

                                    "selected" => false,
                                ), true); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_select", array(
                                    "name" => "color",
                                    "title" => "Warna",

                                    "list" => $color,
                                    "identifier" => "id",
                                    "showable" => "detail_data",

                                    "id" => "color_edit",

                                    "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/reference/goods_color"),
                                    "object_name" => "Warna",

                                    "selected" => false,
                                ), true); ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $this->load->view("component/input/flowstream_select", array(
                                    "name" => "unit",
                                    "title" => "Unit",

                                    "list" => $unit,
                                    "identifier" => "id",
                                    "showable" => "name",

                                    "id" => "unit_edit",

                                    "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/unit"),
                                    "object_name" => "Unit",

                                    "selected" => false,
                                ), true); ?>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group w-100">
                                    <label class="required">Rasio Penjualan</label>
                                    <select class="form-control select2" name="ratio_flag" id="ratio_flag_edit" required>
                                        <option value="1">per Pieces</option>
                                        <option value="0">per Unit</option>
                                    </select>
                                </div>
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
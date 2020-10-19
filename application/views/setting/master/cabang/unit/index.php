<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Daftar Unit Barang</h3>
                </div>
                <div class="card-toolbar">
                    <!-- Button trigger modal-->
                    <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_unit">
                        <i class="la la-plus"></i>Tambah
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="unit_table">
                    <thead>
                        <tr>
                            <th width="1">No</th>
                            <th>Inisial</th>
                            <th>Nama</th>
                            <th>Jumlah (Quantity)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
    </div>
    <div class="col-lg-2"></div>
</div>

<div class="modal fade" id="tambah_unit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form action="<?= base_url("/index.php/api/add_unit") ?>" method="POST" class="modal-content">
            <input type="hidden" name="updated_by" value="<?= $this->session->id ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Unit Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "initial",
                    "placeholder" => "Masukan Inisial Unit",
                    "type" => "text",
                    "label" => "Inisial:",

                    "required" => true,
                ), true); ?>
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "name",
                    "placeholder" => "Masukan Nama Unit",
                    "type" => "text",
                    "label" => "Nama:",

                    "required" => true,
                ), true); ?>
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "quantity",
                    "placeholder" => "Masukan Jumlah Barang per Unit",
                    "type" => "text",
                    "label" => "Jumlah (Quantity):",

                    "required" => true,
                ), true); ?>
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/button/submit", "", true); ?>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form action="<?= base_url("/index.php/api/edit_unit") ?>" method="POST" class="modal-content">
            <input type="hidden" name="updated_by" value="<?= $this->session->id ?>">
            <input type="hidden" name="id" id="id_edit">
            <div class="modal-header">
                <h5 class="modal-title">Edit Unit Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "initial",
                    "placeholder" => "Masukan Inisial Unit",
                    "type" => "text",
                    "label" => "Inisial:",

                    "id" => "initial_edit",

                    "required" => true,
                ), true); ?>
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "name",
                    "placeholder" => "Masukan Nama Unit",
                    "type" => "text",
                    "label" => "Nama:",

                    "id" => "name_edit",

                    "required" => true,
                ), true); ?>
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "quantity",
                    "placeholder" => "Masukan Jumlah Barang per Unit",
                    "type" => "text",
                    "label" => "Jumlah (Quantity):",

                    "id" => "quantity_edit",

                    "required" => true,
                ), true); ?>
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/button/submit", "", true); ?>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="<?= base_url("/index.php/api/delete_unit") ?>" method="POST" class="modal-content">
            <input type="hidden" name="id" id="id_delete">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Unit Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="m-0">anda akan menghapus unit ini</p>
                <small class="m-0 text-info">Seluruh data yang menggunakan unit ini tidak akan ikut terhapus</small>
            </div>
            <div class="modal-footer">
                <button type="submit" name="delete" class="btn btn-danger mr-2">Hapus</button>
            </div>
        </form>
    </div>
</div>
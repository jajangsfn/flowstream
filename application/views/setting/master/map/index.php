<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar Map</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#add_modal">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="map_table">
            <thead>
                <tr>
                    <th width="1">No</th>
                    <th class="text-center">Tipe Partner</th>
                    <th class="text-center">Indeks Harga</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->

<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form action="<?= base_url("/index.php/api/add_map") ?>" method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Map</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "partner_type",
                    "required" => true,
                    "placeholder" => "Masukan Tipe Partner",
                    "type" => "text",
                    "label" => "Tipe Partner:",

                    "maxlength" => "2",

                    "id" => "partner_type_add",

                    "required" => true,
                ), true); ?>
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "price_index",
                    "required" => true,
                    "placeholder" => "Masukan Indeks Harga",
                    "type" => "number",
                    "label" => "Indeks Harga:",

                    "maxlength" => null,

                    "id" => "price_index_add",

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
        <form action="<?= base_url("/index.php/api/edit_map") ?>" method="POST" class="modal-content">
            <input type="hidden" name="id" id="id_edit">
            <div class="modal-header">
                <h5 class="modal-title">Edit Map</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "partner_type",
                    "required" => true,
                    "placeholder" => "Masukan Tipe Partner",
                    "type" => "text",
                    "label" => "Tipe Partner:",

                    "maxlength" => "2",

                    "id" => "partner_type_edit",

                    "required" => true,
                ), true); ?>
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "price_index",
                    "required" => true,
                    "placeholder" => "Masukan Indeks Harga",
                    "type" => "number",
                    "label" => "Indeks Harga:",

                    "maxlength" => null,

                    "id" => "price_index_edit",

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
        <form action="<?= base_url("/index.php/api/delete_map") ?>" method="POST" class="modal-content">
            <input type="hidden" name="id" id="id_delete">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Map</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="m-0">anda akan menghapus data map ini</p>
                <small class="m-0 text-info">Seluruh data yang terkait dengan map ini tidak akan ikut terhapus</small>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger mr-2">Hapus</button>
            </div>
        </form>
    </div>
</div>
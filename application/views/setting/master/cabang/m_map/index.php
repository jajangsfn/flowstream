<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Daftar Map Harga</h3>
                </div>
                <div class="card-toolbar">
                    <?php if (count($m_partner_type_unmap) > 0) : ?>
                        <!-- Button trigger modal-->
                        <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_map">
                            <i class="la la-plus"></i>Tambah
                        </button>
                    <?php else : ?>
                        Seluruh tipe partner telah memiliki map harga
                    <?php endif ?>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="m_map_table">
                    <thead>
                        <tr>
                            <th width="1">No</th>
                            <th>Tipe Partner</th>
                            <th>Indeks Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>

<div class="modal fade" id="tambah_map" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form action="<?= base_url("/index.php/api/add_m_map") ?>" method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Map Harga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="branch_id" value="<?= $data_branch->id ?>">
                <?= $this->load->view("component/input/flowstream_select", array(
                    "name" => "partner_type",
                    "title" => "Pilih Tipe Partner",

                    "list" => $m_partner_type_unmap,
                    "identifier" => "type",
                    "showable" => "type",

                    "manage_url" => base_url("/index.php/setting/master/cabang/$data_branch->id/partner_type"),
                    "object_name" => "tipe partner",

                    "selected" => false,
                ), true); ?>
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "price_index",
                    "placeholder" => "Masukan Indeks Harga",
                    "type" => "number",
                    "label" => "Indeks Harga:",

                    "required" => false,
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
        <form action="<?= base_url("/index.php/api/edit_m_map") ?>" method="POST" class="modal-content">
            <input type="hidden" name="id" id="id_edit">
            <div class="modal-header">
                <h5 class="modal-title">Edit Map Harga <span id="partner_type_edit"> </span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "price_index",
                    "placeholder" => "Masukan Indeks Harga",
                    "type" => "number",
                    "label" => "Indeks Harga:",

                    "id" => "price_index_edit",

                    "required" => false,
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
        <form action="<?= base_url("/index.php/api/delete_m_map") ?>" method="POST" class="modal-content">
            <input type="hidden" name="id" id="id_delete">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Map Harga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="m-0">anda akan menghapus data map harga ini</p>
                <small class="m-0 text-info">Seluruh data yang terkait dengan map harga ini tidak akan ikut terhapus</small>
            </div>
            <div class="modal-footer">
                <button type="submit" name="delete" class="btn btn-danger mr-2">Hapus</button>
            </div>
        </form>
    </div>
</div>
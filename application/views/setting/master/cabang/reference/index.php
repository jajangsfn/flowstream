<div class="row">
    <div class="col-xl-3 col-lg-2"></div>
    <div class="col-xl-6 col-lg-8">
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Daftar <?= $target ?></h3>
                </div>
                <div class="card-toolbar">
                    <!-- Button trigger modal-->
                    <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_reference">
                        <i class="la la-plus"></i>Tambah
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="reference_table">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Detail Data</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-2"></div>
</div>


<div class="modal fade" id="tambah_reference" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <form action="<?= base_url("/index.php/api/add_reference") ?>" method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $target ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="branch_id" value="<?= $data_branch->id ?>">
                <input type="hidden" name="group_data" value="<?= $data_target ?>">
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "detail_data",
                    "required" => true,
                    "placeholder" => "Masukan Detail Data",
                    "type" => "text",
                    "label" => "Detail Data:",

                    "required" => true,
                ), true); ?>
                <div class="text-center">
                    <?= $this->load->view("component/button/submit", "", true); ?>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <form action="<?= base_url("/index.php/api/edit_reference") ?>" method="POST" class="modal-content">
            <input type="hidden" name="id" id="id_edit">
            <div class="modal-header">
                <h5 class="modal-title">Edit <?= $target ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->load->view("component/input/flowstream_input", array(
                    "name" => "detail_data",
                    "required" => true,
                    "placeholder" => "Masukan Detail Data",
                    "type" => "text",
                    "label" => "Detail Data:",
                    "id" => "detail_data_edit",

                    "required" => true,
                ), true); ?>
                <div class="text-center">
                    <?= $this->load->view("component/button/submit", "", true); ?>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="<?= base_url("/index.php/api/delete_reference") ?>" method="POST" class="modal-content">
            <input type="hidden" name="id" id="id_delete">
            <div class="modal-header">
                <h5 class="modal-title">Hapus <?= $target ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="m-0">anda akan menghapus data <?= $target ?> ini</p>
                <small class="m-0 text-info">Seluruh data yang menggunakan referensi <?= $target ?> ini tidak akan ikut terhapus</small>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger mr-2">Hapus</button>
            </div>
        </form>
    </div>
</div>
<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar S_Reference</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_s_reference">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="s_reference_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Group Data</th>
                    <th>Detail Data</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($s_reference); $i++) {
                    $focus = $s_reference[$i]; ?>
                    <tr>
                        <td></td>
                        <td nowrap="nowrap"><?= $focus->group_data ?></td>
                        <td><?= $focus->detail_data ?></td>
                        <td nowrap="nowrap">
                            <!-- Button trigger modal-->
                            <button type="button" class="btn btn-icon btn-sm btn-light-success" data-toggle="modal" data-target="#edit_<?= $focus->id ?>">
                                <i class="flaticon2-pen"></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-sm btn-light-danger" data-toggle="modal" data-target="#delete_<?= $focus->id ?>">
                                <i class="flaticon2-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->

<div class="modal fade" id="tambah_s_reference" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content">
            <input type="hidden" name="back" value="<?= current_url() ?>">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Reference</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="form-group">
                        <label>Group Data:</label>
                        <div class="typeahead">
                            <input type="text" name="group_data" class="form-control w-100 group_data_suggest" placeholder="Enter Group Data" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Detail Data:</label>
                        <input type="text" name="detail_data" class="form-control" placeholder="Enter Detail Data" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php for ($i = 0; $i < count($s_reference); $i++) {
    $focus = $s_reference[$i]; ?>
    <div class="modal fade" id="edit_<?= $focus->id ?>" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="<?= current_url() ?>" method="POST" class="modal-content">
                <input type="hidden" name="back" value="<?= current_url() ?>">
                <input type="hidden" name="id" value="<?= $focus->id ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Reference</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Group Data:</label>
                            <div class="typeahead">
                                <input type="text" name="group_data" class="form-control w-100 group_data_suggest" placeholder="Enter Group Data" required value="<?= $focus->group_data ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Detail Data:</label>
                            <input type="text" name="detail_data" class="form-control" placeholder="Enter Detail Data" required value="<?= $focus->detail_data ?>" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="delete_<?= $focus->id ?>" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="<?= current_url() ?>" method="POST" class="modal-content">
                <input type="hidden" name="back" value="<?= current_url() ?>">
                <input type="hidden" name="id" value="<?= $focus->id ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Reference</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="m-0">anda akan menghapus referensi <?= $focus->detail_data ?></p>
                    <small class="m-0 text-info">Seluruh data yang menggunakan referensi ini tidak akan ikut terhapus</small>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="delete" class="btn btn-danger mr-2">Delete</button>
                </div>
            </form>
        </div>
    </div>

<?php } ?>
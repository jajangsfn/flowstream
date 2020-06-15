<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar ol_group</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_ol_group">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="ol_group_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Connection ID</th>
                    <th>Maker</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($ol_group); $i++) {
                    $focus = $ol_group[$i]; ?>
                    <tr>
                        <td></td>
                        <td nowrap><?= $focus->connection_id ?></td>
                        <td nowrap><?= $focus->maker_id ?></td>
                        <td nowrap><?= $focus->name ?></td>
                        <td nowrap><?= $focus->description ?></td>
                        <td nowrap="nowrap">
                            <?= $this->load->view("component/icon_button/edit", array("id" => $focus->id), true); ?>
                            <?= $this->load->view("component/icon_button/delete", array("id" => $focus->id), true); ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->

<div class="modal fade" id="tambah_ol_group" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content">
            <input type="hidden" name="back" value="<?= current_url() ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-6">
                    <div class="form-group w-100">
                        <label>Connection:</label>
                        <select class="form-control select2" name="connection_id">
                            <option value="" disabled selected>Choose Connection</option>
                            <?php foreach ($ol_connection as $option) { ?>
                                <option value="<?= $option->id ?>"><?= $option->receive_id ? $option->receive_name : $option->request_id ?> -> <?= $option->receive_id ? $option->receive_status : $option->request_status ?></option>
                            <?php } ?>
                        </select>
                        <a class="text-info" href="<?= base_url("/index.php/setting/system/ol_connection") ?>">
                            <div class="my-2">
                                (Manage Connection)
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group w-100">
                        <label>Maker:</label>
                        <select class="form-control select2" name="maker_id">
                            <option value="1" selected>(Not Implemented)</option>
                        </select>
                        <a class="text-info" href="<?= base_url("/index.php/setting/system/ol_connection") ?>">
                            <div class="my-2">
                                (Manage Connection)
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukan Nama Group" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/button/submit", "", true); ?>
            </div>
        </form>
    </div>
</div>

<?php for ($i = 0; $i < count($ol_group); $i++) {
    $focus = $ol_group[$i]; ?>
    <div class="modal fade" id="edit_<?= $focus->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <form action="<?= current_url() ?>" method="POST" class="modal-content">
                <input type="hidden" name="back" value="<?= current_url() ?>">
                <input type="hidden" name="id" value="<?= $focus->id ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Salesman Map</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6">
                        <div class="form-group w-100">
                            <label>Connection:</label>
                            <select class="form-control select2" name="connection_id">
                                <option value="" disabled selected>Choose Connection</option>
                                <?php $found = false; ?>
                                <?php foreach ($ol_connection as $option) { ?>
                                    <?php if ($focus->connection_id == $option->id) { ?>
                                        <option value="<?= $option->id ?>" selected><?= $option->receive_id ? $option->receive_name : $option->request_id ?> -> <?= $option->receive_id ? $option->receive_status : $option->request_status ?></option>
                                        <?php $found = true; ?>
                                    <?php } else { ?>
                                        <option value="<?= $option->id ?>"><?= $option->receive_id ? $option->receive_name : $option->request_id ?> -> <?= $option->receive_id ? $option->receive_status : $option->request_status ?></option>
                                    <?php } ?>
                                <?php } ?>
                                <?php if (!$found) { ?>
                                    <option value="<?= $focus->connection_id ?>" selected>ID <?= $focus->connection_id ?> <span>(Deleted)</span></option>
                                    <?php $found = false; ?>
                                <?php } ?>
                            </select>
                            <a class="text-info" href="<?= base_url("/index.php/setting/system/ol_connection") ?>">
                                <div class="my-2">
                                    (Manage Connection)
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group w-100">
                            <label>Maker:</label>
                            <select class="form-control select2" name="maker_id">
                                <option value="1" selected>(Not Implemented)</option>
                            </select>
                            <!-- <a class="text-info" href="<?= base_url("/index.php/setting/system/ol_connection") ?>">
                                <div class="my-2">
                                    (Manage Connection)
                                </div>
                            </a> -->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Nama Group" value="<?= $focus->name ?>" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="3"><?= $focus->description ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?= $this->load->view("component/button/submit", "", true); ?>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="delete_<?= $focus->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="<?= current_url() ?>" method="POST" class="modal-content">
                <input type="hidden" name="back" value="<?= current_url() ?>">
                <input type="hidden" name="id" value="<?= $focus->id ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="m-0">anda akan menghapus Group <?= $focus->name ?></p>
                    <small class="m-0 text-info">Seluruh data yang terkait dengan group ini tidak akan ikut terhapus</small>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="delete" class="btn btn-danger mr-2">Delete</button>
                </div>
            </form>
        </div>
    </div>

<?php } ?>
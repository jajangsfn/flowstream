<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar ol_connection</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_ol_connection">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="ol_connection_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Request</th>
                    <th>Receive</th>
                    <th>Request Status</th>
                    <th>Receive Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($ol_connection); $i++) {
                    $focus = $ol_connection[$i]; ?>
                    <tr>
                        <td></td>
                        <td nowrap><?= $focus->request_name ?></td>
                        <td nowrap><?= $focus->receive_name ?></td>
                        <td nowrap><?= $focus->request_status ?></td>
                        <td nowrap><?= $focus->receive_status ?></td>
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

<div class="modal fade" id="tambah_ol_connection" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content">
            <input type="hidden" name="back" value="<?= current_url() ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Connection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-6">
                    <div class="form-group w-100">
                        <label>Request:</label>
                        <select class="form-control select2" name="request_id">
                            <option value="" disabled selected>Choose Request Target</option>
                            <?php foreach ($m_branch as $option) { ?>
                                <option value="<?= $option->id ?>"><?= $option->name ?></option>
                            <?php } ?>
                        </select>
                        <a class="text-info" href="<?= base_url("/index.php/setting/system/m_branch") ?>">
                            <div class="my-2">
                                (Manage Branch)
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group w-100">
                        <label>Receive:</label>
                        <select class="form-control select2" name="receive_id">
                            <option value="" disabled selected>Choose Receive Target</option>
                            <?php foreach ($m_branch as $option) { ?>
                                <option value="<?= $option->id ?>"><?= $option->name ?></option>
                            <?php } ?>
                        </select>
                        <a class="text-info" href="<?= base_url("/index.php/setting/system/m_branch") ?>">
                            <div class="my-2">
                                (Manage Branch)
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Request Status:</label>
                        <input type="text" name="request_status" class="form-control" placeholder="Masukan Status Request" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Receive Status:</label>
                        <input type="text" name="receive_status" class="form-control" placeholder="Masukan Status Receive" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?= $this->load->view("component/button/submit", "", true); ?>
            </div>
        </form>
    </div>
</div>

<?php for ($i = 0; $i < count($ol_connection); $i++) {
    $focus = $ol_connection[$i]; ?>
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
                            <label>Request:</label>
                            <select class="form-control select2" name="request_id">
                                <?php if ($focus->request_id) { ?>
                                    <?php $found = false; ?>
                                    <?php foreach ($m_branch as $option) { ?>
                                        <?php if ($focus->request_id == $option->id) { ?>
                                            <option value="<?= $option->id ?>" selected><?= $option->name ?></option>
                                            <?php $found = true; ?>
                                        <?php } else { ?>
                                            <option value="<?= $option->id ?>"><?= $option->name ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if (!$found) { ?>
                                        <option value="<?= $focus->request_id ?>" selected><?= $focus->request_name ?> <span>(Deleted)</span></option>
                                        <?php $found = false; ?>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" disabled selected>Choose Receive Target</option>
                                    <?php foreach ($m_branch as $option) { ?>
                                        <option value="<?= $option->id ?>"><?= $option->name ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <a class="text-info" href="<?= base_url("/index.php/setting/system/m_branch") ?>">
                                <div class="my-2">
                                    (Manage Branch)
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group w-100">
                            <label>Receive:</label>
                            <select class="form-control select2" name="receive_id">
                                <?php if ($focus->receive_id) { ?>
                                    <?php $found = false; ?>
                                    <?php foreach ($m_branch as $option) { ?>
                                        <?php if ($focus->receive_id == $option->id) { ?>
                                            <option value="<?= $option->id ?>" selected><?= $option->name ?></option>
                                            <?php $found = true; ?>
                                        <?php } else { ?>
                                            <option value="<?= $option->id ?>"><?= $option->name ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if (!$found) { ?>
                                        <option value="<?= $focus->receive_id ?>" selected><?= $focus->request_name ?> <span>(Deleted)</span></option>
                                        <?php $found = false; ?>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" disabled selected>Choose Receive Target</option>
                                    <?php foreach ($m_branch as $option) { ?>
                                        <option value="<?= $option->id ?>"><?= $option->name ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <a class="text-info" href="<?= base_url("/index.php/setting/system/m_branch") ?>">
                                <div class="my-2">
                                    (Manage Branch)
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Request Status:</label>
                            <input type="text" name="request_status" class="form-control" placeholder="Masukan Status Request" value="<?= $focus->request_status ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Receive Status:</label>
                            <input type="text" name="receive_status" class="form-control" placeholder="Masukan Status Receive" value="<?= $focus->receive_status ?>" />
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
                    <h5 class="modal-title">Delete Connection</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="m-0">anda akan menghapus Connection <?= $focus->receive_id ? $focus->receive_name : $focus->request_name ?></p>
                    <small class="m-0 text-info">Seluruh data yang terkait dengan mapping ini tidak akan ikut terhapus</small>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="delete" class="btn btn-danger mr-2">Delete</button>
                </div>
            </form>
        </div>
    </div>

<?php } ?>
<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Daftar ol_group_detail</h3>
        </div>
        <div class="card-toolbar">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#tambah_ol_group_detail">
                <i class="la la-plus"></i>Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="ol_group_detail_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Group</th>
                    <th>Member</th>
                    <th>Is admin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($ol_group_detail); $i++) {
                    $focus = $ol_group_detail[$i]; ?>
                    <tr>
                        <td></td>
                        <td nowrap><?= $focus->group_name ?></td>
                        <td nowrap><?= $focus->branch_name ?></td>
                        <td nowrap><?= $focus->is_admin ? "True" : "False" ?></td>
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

<div class="modal fade" id="tambah_ol_group_detail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <form action="<?= current_url() ?>" method="POST" class="modal-content">
            <input type="hidden" name="back" value="<?= current_url() ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Group Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-6">
                    <div class="form-group w-100">
                        <label>Group:</label>
                        <select class="form-control select2" name="group_id">
                            <option value="" disabled selected>Choose Group</option>
                            <?php foreach ($ol_group as $option) { ?>
                                <option value="<?= $option->id ?>"><?= $option->name ?></option>
                            <?php } ?>
                        </select>
                        <a class="text-info" href="<?= base_url("/index.php/setting/system/ol_group") ?>">
                            <div class="my-2">
                                (Manage Group)
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group w-100">
                        <label>Member:</label>
                        <select class="form-control select2" name="member_id">
                            <option value="" disabled selected>Choose Member</option>
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
                <div class="col-md-12 checkbox-list text-center">
                    <div class="form-group">
                        <label class="checkbox">
                            <input type="checkbox" name="is_admin" /> Mark As Admin
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </div>
        </form>
    </div>
</div>

<?php for ($i = 0; $i < count($ol_group_detail); $i++) {
    $focus = $ol_group_detail[$i]; ?>
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
                            <label>Group:</label>
                            <select class="form-control select2" name="group_id">
                                <?php $found = false; ?>
                                <?php foreach ($ol_group as $option) { ?>
                                    <?php if ($focus->group_id == $option->id) { ?>
                                        <option value="<?= $option->id ?>" selected><?= $option->name ?></option>
                                        <?php $found = true; ?>
                                    <?php } else { ?>
                                        <option value="<?= $option->id ?>"><?= $option->name ?></option>
                                    <?php } ?>
                                <?php } ?>
                                <?php if (!$found) { ?>
                                    <option value="<?= $focus->group_id ?>"><?= $focus->group_name ?></option>
                                    <?php $found = false; ?>
                                <?php } ?>
                            </select>
                            <a class="text-info" href="<?= base_url("/index.php/setting/system/ol_group") ?>">
                                <div class="my-2">
                                    (Manage Group)
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group w-100">
                            <label>Member:</label>
                            <select class="form-control select2" name="member_id">
                                <?php $found = false; ?>
                                <?php foreach ($m_branch as $option) { ?>
                                    <?php if ($focus->member_id == $option->id) { ?>
                                        <option value="<?= $option->id ?>" selected><?= $option->name ?></option>
                                        <?php $found = true; ?>
                                    <?php } else { ?>
                                        <option value="<?= $option->id ?>"><?= $option->name ?></option>
                                    <?php } ?>
                                <?php } ?>
                                <?php if (!$found) { ?>
                                    <option value="<?= $focus->member_id ?>"><?= $focus->branch_name ?></option>
                                    <?php $found = false; ?>
                                <?php } ?>
                            </select>
                            <a class="text-info" href="<?= base_url("/index.php/setting/system/m_branch") ?>">
                                <div class="my-2">
                                    (Manage Branch)
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12 checkbox-list text-center">
                        <div class="form-group">
                            <label class="checkbox">
                                <input type="checkbox" name="is_admin" <?= $focus->is_admin ? "checked" : "" ?> /> Mark As Admin
                                <span></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
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
                    <h5 class="modal-title">Delete Group Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="m-0">anda akan menghapus Group Detail</p>
                    <small class="m-0 text-info">Seluruh data yang terkait dengan detail ini <span class="text-danger">akan</span> ikut terhapus</small>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="delete" class="btn btn-danger mr-2">Delete</button>
                </div>
            </form>
        </div>
    </div>

<?php } ?>